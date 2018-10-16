<?php

namespace App\Http\Controllers\Admin;

use App\FuneralHome;
use App\MapPin;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class FuneralHomeController extends Controller
{
    private $allRows = 0;
    private $noLoader = false;
    
    public function index(Request $request)
    {

        $filter = $request->get('filter', false);
        $order = $request->get('order', 'name');
        $sort = $request->get('sort', 'asc');

        if ($filter) {
            if ($request->get('filter') === 'partners') {
                $items = FuneralHome::whereNotNull('user_id')->orderBy($order, $sort)->paginate(20);
            }
        }else {
            $items = FuneralHome::orderBy($order, $sort)->paginate(20);
        }
    // dd($filter);
        return view('admin.funeral-home.index', compact('items', 'filter', 'order', 'sort'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit(FuneralHome $funeralHome)
    {
        return view('admin.funeral-home.edit', compact('funeralHome'));
    }
    
    public function update(Request $request, FuneralHome $funeralHome)
    {
        $data = $request->validate([
            'name'               => 'required',
            'contact_name'       => 'required',
            'communities_served' => 'required',
            'email'              => 'required|email',
            'phone_number'       => 'required',
            'address'            => 'required',
            'zip_code'           => 'required',
        ]);
        
        $funeralHome->name = $data['name'];
        $funeralHome->contact_name = $data['contact_name'];
        $funeralHome->communities_served = $data['communities_served'];
        $funeralHome->email = $data['email'];
        $funeralHome->phone_number = $data['phone_number'];
        $funeralHome->address = $data['address'];
        $funeralHome->zip_code = $data['zip_code'];
        
        $funeralHome->save();
        
        MapPin::updateMapPin($funeralHome, $request->longitude, $request->latitude);
        
        if (isset($request->limit_exceeded)) {
            return redirect()->route('admin.funeral-homes.index')->with('status', ['type' => 'warning', 'message' => 'Funeral home updated successfully \n Pin was not added since daily limit has been exceeded!']);
        }else {
            return redirect()->route('admin.funeral-homes.index')->with('status', ['type' => 'success', 'message' => 'Funeral home updated successfully']);
        }
    }
    
    public function destroy(FuneralHome $funeralHome)
    {
        if (isset($funeralHome->location)) {
            $funeralHome->location->delete();
        }
        
        if (isset($funeralHome->user)) {
            $funeralHome->user->delete();
        }
        
        $funeralHome->delete();
        
        return redirect()->route('admin.funeral-homes.index')->with('status', ['type' => 'success', 'message' => 'Funeral home deleted successfully.']);
        
    }
    
    public function saveImportFile(Request $request)
    {
        Cache::forget('currentRow');
        Cache::forget('idList');
        Cache::forget('cancel');
        
        $file = $request->file('file');
        $filename = uniqid('fh-import_') . '.' . $file->getClientOriginalExtension();
        $path = public_path('/uploads/fh-imports');
        
        $file->move($path, $filename);
        chmod($path . '/' . $filename, 0777);
        
        if ($this->allRows === 0) {
            try{
                $filePath = public_path('/uploads/fh-imports/' . $filename);
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $this->allRows = $worksheet->getHighestRow();
            }catch (\Exception $e){
                //                unlink(public_path('/uploads/fh-imports/' . $filename));
                //                return response()->json([
                //                    'message' => $e->getMessage()
                //                ], 500);
                $this->noLoader = true;
            }
        }
        
        return response()->json([
            'allRows'  => (int)$this->allRows,
            'noLoader' => $this->noLoader,
            'filename' => $filename
        ]);
    }
    
    public function getCurrentRow()
    {
        if ( ! is_null(Cache::get('currentRow'))) {
            return Cache::get('currentRow');
        }else {
            return 0;
        }
    }
    
    public function importExcel(Request $request)
    {
        ini_set('max_execution_time', 0);
        //        Excel::load('public/uploads/fh-imports/' . $request->path, function ($reader) use ($takeRows, $skipRows){
        Excel::filter('chunk')->load('public/uploads/fh-imports/' . $request->path)->chunk(1000, function ($result){
            
            $rowsArray = $result->toArray();
            
            foreach ($rowsArray as $key => $row) {
                if ( ! is_null(Cache::get('cancel'))) {
                    exit;
                }
                
                $stateAndZip = !is_null($row['hidden_value_4']) ? $row['hidden_value_4'] : '';
                
                $funeralHomeExists = DB::table('funeral_homes');
                try{
                    if ( ! is_null($row['address'])) {
                        $funeralHomeExists->where('address', '=', $row['address']);
                    }else if ( ! is_null($row['zip_code'])) {
                        $funeralHomeExists->where('zip_code', '=', $row['zip_code']);
                    }else if ( ! is_null($row['fh_phone_number'])) {
                        $funeralHomeExists->where('phone_number', '=', $row['fh_phone_number']);
                    }
                }catch (\Exception $e){
                    Log::error($e->getMessage());
                    throw new \Exception('Error in file');
                }
                
                if ( ! $funeralHomeExists->exists()) {
                    $user = $this->addUser($row);
                    
                    $funeralHome = FuneralHome::saveFuneralHome($row, $user);
                    
                    if (isset($funeralHome)) {
                        if (is_null(Cache::get('idList'))) {
                            $ids = [$funeralHome->id];
                            Cache::forever('idList', $ids);
                        }else {
                            $ids = Cache::get('idList');
                            if ( ! in_array($funeralHome->id, $ids)) {
                                array_push($ids, $funeralHome->id);
                            }
                            Cache::forever('idList', $ids);
                        }
                    }
                    MapPin::saveMapPin($funeralHome, $stateAndZip);
                }
                
                if (is_null(Cache::get('currentRow'))) {
                    Cache::forever('currentRow', 1);
                }else {
                    Cache::forever('currentRow', Cache::get('currentRow') + 1);
                }
            }
        });
    }
    
    public function cancelImport()
    {
        Cache::forever('cancel', true);
        Cache::forget('currentRow', true);
        $idList = Cache::get('idList');
        if (isset($idList)) {
            foreach (Cache::get('idList') as $id) {
                $funeralHome = FuneralHome::find($id);
                if (isset($funeralHome->location)) {
                    $funeralHome->location->delete();
                }
                $funeralHome->user->delete();
                $funeralHome->delete();
            }
        }
    }
    
    public function sendPasswordResetEmail(User $user)
    {
        Password::sendResetLink(['email' => $user->email]);
        
        return redirect()->back()->with('status', ['type' => 'success', 'message' => 'Password reset email send successfully.']);
    }
    
    public function search(Request $request)
    {
        if ($request->no_pins) {
            $items = FuneralHome::with('location')->whereDoesntHave('location')->paginate(20);
            
            return view('admin.funeral-home.index', compact('items'));
        }

        $filter = $request->get('filter', false);
        $order = $request->get('order', 'name');
        $sort = $request->get('sort', 'asc');
        
        $search = $request->search;
        $items = FuneralHome::where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->paginate(20);
        
        return view('admin.funeral-home.index', compact('items', 'filter', 'order', 'sort'));
    }
    
    /**
     * @param $row
     *
     * @return User
     */
    private function addUser($row)
    {
        if(is_null($row['email'])){
            $email = uniqid('fake_email_') . '@myrespects.com';
            $userExists = false;
        }else{
            $email = $row['email'];
            $userExists = User::where('email', $email)->exists();
        }
        
        if (!$userExists){
            $user = new User();
            //
            if (isset($row['contact_name'])) {
                $name = explode(' ', $row['contact_name'], 2);
                $user->first_name = $name[0];
                $user->last_name = isset($name[1]) ? $name[1] : '';
            }else {
                $user->first_name = 'Call for Details';
                $user->last_name = 'N/A';
            }
    
            $role = Role::where('code', 'affiliate')->first();
            $user->role_id = $role->id;
            $user->password = bcrypt(str_random(8));
            $user->email = $email;
            $user->save();
    
            return $user;
        }else{
            return null;
        }
        
        
    }
}
