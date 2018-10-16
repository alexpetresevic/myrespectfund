<?php

namespace App\Http\Controllers;

use App\CampagnUpdate;
use App\Campaign;
use App\File as FileModel;
use App\FuneralHome;
use App\MapPin;
use App\Settings;
use App\Subscription;
use App\Toolkit;
use Carbon\Carbon;
use DateTime;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function PHPSTORM_META\map;

class CampaignController extends Controller
{
    public function create($step = 'step-1', $campaign = null)
    {
        
        if ( ! is_null(auth()->user()) && auth()->user()->campaign()->exists()) {
            $campaign = auth()->user()->campaign;
            $funeralHomes = null;
            
            return view('campaign.step-two', compact('campaign', 'funeralHomes'));
        }
        
        if (auth()->guest()) {
            return redirect()->route('register', ['start-campaign' => 1]);
        }
        
        if ( ! is_null($campaign)) {
            $campaign = Campaign::find(decrypt($campaign));
        }
        
        if (auth()->user()->is('affiliate')) {
            request()->session()->flash('message-error', 'You can\'t create a fundraiser since you are a partner!');
            
            return redirect()->route('home');
        }
        
        $steps = [
            'step-1' => 'one',
            'step-2' => 'two',
            'step-3' => 'three',
            'step-4' => 'four',
            'step-5' => 'five',
            'step-6' => 'six'
        ];
        
        if (is_null($campaign)) {
            if (count(auth()->user()->campaigns) == 0) {
                $campaign = new Campaign();
                //                $campaign->user_id = auth()->user()->id;
                //                $campaign->save();
            }else {
                $campaign = Campaign::where('user_id', auth()->user()->id)->first();
            }
        }
        
        if (array_key_exists($step, $steps)) {
            if ( ! auth()->user()->hasCampaign($campaign->id) || ! auth()->user()->getCampaign($campaign->id)->active) {
                $funeralHomes = null;
                
                return view('campaign.step-' . $steps[$step], compact('campaign', 'funeralHomes'));
            }else {
                return redirect()->route('home')->with('message-error', 'You already have a fundraiser!');
            }
        }
    }
    
    public function update(Request $request, $step, $campaign)
    {
        $campaign = Campaign::find(decrypt($campaign));
        
        $steps = [
            'step-1' => 'stepOne',
            'step-2' => 'stepTwo',
            'step-3' => 'stepThree',
            'step-4' => 'stepFour',
            'step-5' => 'stepFive',
            'step-6' => 'stepSix',
        ];
        
        if (array_key_exists($step, $steps)) {
            if (is_null($campaign)) {
                return $this->{$steps[$step]}($request, null);
            }else {
                return $this->{$steps[$step]}($request, encrypt($campaign->id));
            }
        }
        
        
    }
    
    public function stepOne(Request $request, $campaign)
    {
        
        //        $campaign = Campaign::find(decrypt($campaign));
        $request->validate([
            'first_name'             => 'required',
            'last_name'              => 'required',
            //            'address'                => 'required',
            //            'city'                   => 'required',
            //            'state'                  => 'required',
            'email'                  => 'required',
            //            'campaign_end'           => 'required',
            'phone_number'           => 'required',
            //            'zip_code'               => 'required',
            'social_security_number' => 'required',
            'date_of_birth'          => 'required'
        ]);
        
        $campaign = new Campaign();
        $campaign->user_id = auth()->user()->id;
        $campaign->save();
        
        $campaign->first_name = $request->first_name;
        $campaign->last_name = $request->last_name;
        $campaign->address = $request->address;
        //        $campaign->city = $request->city;
        //        $campaign->state = $request->state;
        $campaign->email = $request->email;
        //        $campaign->campaign_end = $request->campaign_end;
        $campaign->phone_number = $request->phone_number;
        //        $campaign->zip_code = $request->zip_code;
        $campaign->social_security_number = $request->social_security_number;
        $campaign->date_of_birth = $request->date_of_birth;
        
        if ($campaign->steps_completed != 2) {
            $campaign->steps_completed = 1;
        }
        
        $campaign->update();
        
        return redirect()->route('campaign.create', ['step' => 'step-2', 'campaign' => encrypt($campaign->id)]);
    }
    
    public function stepTwo(Request $request, $campaign)
    {
        $campaign = Campaign::find(decrypt($campaign));
        $request->validate([
            'goal'           => 'required',
            'zip_code'       => 'required',
            'title'          => 'required',
            'campaign_story' => 'required',
            'address'        => 'required',
            'funeral_date'   => 'date_format:"m/d/Y"|nullable',
            'funeral_time'   => 'date_format:"h:i A"|nullable',
            'campaign_end'   => 'date_format:"m/d/Y"|nullable',
            'private'        => 'boolean',
        ]);
        
        $date = isset($request->funeral_date) ? (new Carbon($request->funeral_date))->format('Y-m-d') : null;
        
        $campaign->funeral_home_id = $request->funeral_home_id;
        $campaign->goal = $request->goal;
        $campaign->title = $request->title;
        $campaign->address = $request->address;
        $campaign->zip_code = $request->zip_code;
        $campaign->campaign_story = $request->campaign_story;
        $campaign->funeral_date = $date;
        $campaign->funeral_time = isset($request->funeral_time) ? $request->funeral_time : null;
        $campaign->campaign_end = isset($request->campaign_end) ? (new Carbon($request->campaign_end))->format('Y-m-d') : (new Carbon())->format('Y-m-d');
        //        dd($campaign);
        
        $campaign->steps_completed = 2;
        $campaign->active = 1;

        $campaign->private = $request->private;

        $campaign->update();
        

        // TODO: add message
        return redirect()->route('campaign.dashboard')->with('campaign_completed', true);
    }
    
    public function uploadImageAxios(Request $request, Campaign $campaign)
    {
        $messages = [
            'image.max' => 'Image size can\'t be greater then 5.5mb'
        ];
        
        $request->validate([
            'image' => 'required|image|max:5500',
        ], $messages);
        
        $file = $request->file('image');
        $filename = uniqid('cam_') . '.' . $file->getClientOriginalExtension();
        $path = public_path('/uploads/campaigns');
        
        $uploaded = $file->move($path, $filename);
        
        if (is_null($campaign->image)) {
            $image = new FileModel();
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($campaign);
            $image->save();
        }else {
            unlink($path . '/' . $campaign->image->filename);
            $campaign->image->filename = $uploaded->getFilename();
            $campaign->image->image_url = $uploaded->getPathname();
            $campaign->image->update();
        }
    }
    
    // Campaign dashboard
    public function dashboard(Request $request)
    {
        $campaign = Campaign::where('user_id', auth()->user()->id)->first();
        $settings = Settings::where('key', 'like', '%campaign_%')->get()->groupBy('key')->toArray();
        $campaign_completed = $request->session()->get('campaign_completed');
        
        if ($campaign->user_id != auth()->user()->id) {
            abort(403);
        }
        
        return view('campaign.dashboard.index', compact('campaign', 'settings', 'campaign_completed'));
    }
    
    public function postUpdate(Request $request, Campaign $campaign)
    {
        $request->validate([
            'campaign_id' => 'required|integer',
            'body'        => 'required',
            'image'       => 'sometimes|nullable|image',
        ]);
        
        $campaignUpdate = new CampagnUpdate();
        
        //        $campaignUpdate->date = (new Carbon($request->date))->format('Y-m-d H:i:s');
        
        $campaignUpdate->campaign_id = $request->campaign_id;
        $campaignUpdate->body = $request->body;
        //        $campaignUpdate->time        = $request->time;
        
        $campaignUpdate->save();
        
        if ($request->has('image')) {
            FileModel::saveFileToModel($request, $campaignUpdate, '/uploads/updates', 'upd');
        }
        
        return redirect()->back()->with('message', 'Update posted successfully');
    }
    
    public function toolkit()
    {
        abort(404);
        $campaign = Campaign::where('user_id', auth()->user()->id)->first();
        $settings = Settings::where('key', 'like', '%campaign_%')->get()->groupBy('key')->toArray();
        
        $items = Toolkit::all();
        
        return view('campaign.dashboard.toolkit', compact('campaign', 'items', 'settings'));
    }
    
    public function funeralDetails()
    {
        $campaign = Campaign::where('user_id', auth()->user()->id)->first();
        $settings = Settings::where('key', 'like', '%campaign_%')->get()->groupBy('key')->toArray();
        
        $funeralHome = $campaign->funeralHome;
        
        $funeralHomes = [];
        if (is_null($funeralHome)) {
            $funeralHomes = FuneralHome::all();
        }
        
        //        if (is_null($funeralHome)) {
        //            request()->session()->flash('message', 'You don\'t have a funeral home selected!');
        //
        //            return view('campaign.dashboard.index', compact('campaign'));
        //        }
        
        return view('campaign.dashboard.funeral-details', compact('campaign', 'funeralHome', 'funeralHomes', 'settings'));
    }
    
    //search
    public function search(Request $request)
    {
        $term      = $request->search;
        $campaigns = Campaign::where('title', 'like', '%' . $term . '%')->orWhere('first_name', 'like',
            '%' . $term . '%')->orWhere('last_name', 'like', '%' . $term . '%')->having('active', 1)->having('private',
            0)->get();

        return view('campaign.search.result')->with('campaigns', $campaigns);
    }
    
    public function show($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        
        return view('campaign.show', compact('campaign'));
    }
    
    public function donors()
    {
        $campaign = Campaign::where('user_id', auth()->user()->id)->first();
        $settings = Settings::where('key', 'like', '%campaign_%')->get()->groupBy('key')->toArray();
        
        return view('campaign.dashboard.donors', compact('campaign', 'settings'));
    }
    
    public function addFuneralHome(Request $request, Campaign $campaign)
    {
        $campaign->funeral_home_id = $request->funeral_home_id;
        $campaign->update();
        
        return redirect()->route('campaign.dashboard.funeral-details');
    }
    
    public function deleteImageAjax(Campaign $campaign)
    {
        $campaign->image->delete();
    }
    
    public function edit()
    {
        $campaign = auth()->user()->campaign;
        $settings = Settings::where('key', 'like', '%campaign_%')->get()->groupBy('key')->toArray();
        
        return view('campaign.dashboard.edit', compact('campaign', 'settings'));
    }
    
    public function campaignUpdate(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'phone_number'   => 'required',
            'campaign_story' => 'required',
            'funeral_date'   => 'date_format:"m/d/Y"|nullable',
            'funeral_time'   => 'date_format:"h:i A"|nullable',
            'campaign_end'   => 'date_format:"m/d/Y"|nullable',
            'goal'           => 'required',
            'private'        => 'boolean',
        ]);
        
        $campaign = auth()->user()->campaign;
        
        $campaign->title = $data['title'];
        $campaign->first_name = $data['first_name'];
        $campaign->last_name = $data['last_name'];
        $campaign->phone_number = $data['phone_number'];
        $campaign->campaign_story = $data['campaign_story'];
        $campaign->active = 1;
        $campaign->goal = $data['goal'];
        $campaign->funeral_date = isset($data['funeral_date']) ? (new Carbon($data['funeral_date']))->format('Y-m-d') : new Carbon();
        $campaign->funeral_time = isset($data['funeral_time']) ? $data['funeral_time'] : (new Carbon())->format('H:i');
        //        $campaign->campaign_end = isset($data['campaign_end']) ? $data['campaign_end'] : (new Carbon())->format('H:i');
        //        dd($campaign);
        $campaign->private = $data['private'];
        $campaign->save();
        
        return redirect()->route('campaign.dashboard')->with('message', 'Fundraiser updated successfully');
    }
    
    public function confirmDelete()
    {
        return view('campaign.dashboard.delete');
    }
    
    public function destroy(Request $request)
    {
        $data = $request->validate(['password' => 'required']);
        
        if (Hash::check($data['password'], auth()->user()->getAuthPassword())) {
            if (auth()->user()->campaign->image()->exists()){
                auth()->user()->campaign->image->delete();
            }
            auth()->user()->campaign()->delete();
            
            return redirect()->route('home')->with('message', 'Fundraiser deleted successfully');
        }
        
        return redirect()->back()->with('message-error', 'Invalid password');
    }
    
    public function signUpForUpdates(Request $request)
    {
        $response['status'] = true;
        
        $data = $request->validate([
            'email'       => 'required|email',
            'campaign_id' => 'required',
        ]);
        
        if ( ! Subscription::where('campaign_id', $data['campaign_id'])->where('email', $data['email'])->exists()) {
            $response['status'] = true;
            $request['message-error'] = 'You have already subscribed to this fundraiser.';
            
            $subscription = new Subscription();
            $subscription->campaign_id = $data['campaign_id'];
            $subscription->email = $data['email'];
            $subscription->save();
        }
        
        return $response;
    }
    
    public function loadMapPins(Request $request)
    {
        $distanceInKm = 100;
        
        $query = '
            SELECT mp.id AS mp_id, mp.entity_id AS mp_entity_id, mp.longitude AS mp_longitude, mp.latitude AS mp_latitude, fh.id AS fh_id, fh.name AS fh_name, fh.phone_number AS fh_phone, fh.email AS fh_email, fil.filename AS fil_filename, 
                ( 6371 * acos( cos( radians(' . $request->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $request->longitude . ') ) + sin( radians(' . $request->latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance 
            FROM map_pins AS mp 
            INNER JOIN funeral_homes AS fh ON mp.entity_id = fh.id 
            LEFT JOIN files AS fil ON fil.file_id = fh.id AND fil.file_type LIKE "%FuneralHome" 
            HAVING distance < ' . $distanceInKm . ';';
        
        $mapPins = DB::select($query);
        
        return $mapPins;
    }
}
