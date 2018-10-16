<?php

namespace App\Http\Controllers\Admin;

use App\FuneralHome;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        
        return view('admin.user.index', compact('users'));
    }
    
    public function create()
    {
        $roles = Role::all();
        
        return view('admin.user.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users',
            'role_id'    => 'required',
            'password'   => 'required|confirmed'
        ]);
        
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];
        $user->password = bcrypt($data['password']);
        
        $user->save();
        
        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'User created successfully.']);
    }
    
    public function show($id)
    {
        abort(404);
    }
    
    public function addUsers()
    {
        ini_set('max_execution_time', 0);
        $funeralHomes = FuneralHome::all();
        
        foreach ($funeralHomes as $funeralHome) {
            if ( ! $funeralHome->user()->exists()) {
                $user = new User();
                
                if (is_null($funeralHome->email) || $funeralHome->email == 'N/A') {
                    $email = uniqid('fake_email_') . '@myrespects.com';
                    $userExists = false;
                }else {
                    $email = $funeralHome->email;
                    $userExists = User::where('email', $email)->exists();
                }
                if ( ! $userExists) {
                    if ($funeralHome->contact_name == 'N/A') {
                        $user->first_name = 'Call for Details';
                        $user->last_name = 'N/A';
                    }else {
                        $name = explode(' ', $funeralHome->contact_name, 2);
                        $user->first_name = $name[0];
                        $user->last_name = isset($name[1]) ? $name[1] : '';
                    }
                    
                    $role = Role::where('code', 'affiliate')->first();
                    $user->role_id = $role->id;
                    $user->password = bcrypt(str_random(8));
                    $user->email = $email;
                    $user->save();
                    
                    $funeralHome->user_id = $user->id;
                    $funeralHome->update();
                }
            }
        }
        
        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'Users added successfully.']);
    }
    
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|confirmed'
        ]);
        
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        
        if (isset($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        
        $user->update();
        
        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'User updated successfully.']);
    }
    
    public function destroy(User $user)
    {
        if ($user->campaigns()->exists()) {
            $user->campaigns()->delete();
        }
        
        if ($user->funeralHomes()->exists()) {
            $user->funeralHomes()->delete();
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'User deleted successfully.']);
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->paginate(20);
        
        return view('admin.user.index', compact('users'));
    }
}
