<?php

namespace App\Http\Controllers;

use App\Mail\PartnerCreated;
use App\FuneralHome;
use App\File;
use App\MapPin;
use App\Page;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function PHPSTORM_META\map;

class FuneralHomeController extends Controller
{
    public function index()
    {
        return view('funeral-home.index');
    }
    
    public function create()
    {
        $page = Page::where('slug', 'list-your-funeral-home')->first();
        $partnership = Page::where('slug', 'partnership-program')->first();
        
        return view('funeral-home.create', compact('page', 'partnership'));
    }
    
    public function store(Request $request)
    {
        $messages = [
            'social.facebook.url'    => 'Facebook field needs to be an url',
            'social.twitter.url'     => 'Twitter field needs to be an url',
            'social.google_plus.url' => 'Google plus field needs to be an url',
            'social.other.url'       => 'This field needs to be an url',
            'upload_image.max'       => 'Image size can\'t be greater then 5.5mb'
        ];
        
        $data = $request->validate([
            'name'               => 'required|min:3|max:255',
            'contact_name'       => 'required|min:3|max:255',
            'communities_served' => 'required|min:3|max:255',
            'email'              => 'required|email|unique:users,email',
            'phone_number'       => 'required',
            'address'            => 'required|min:3|max:255',
            'zip_code'           => 'required|min:3|max:255',
            'social.*'           => 'nullable|url',
            'upload_image'       => 'sometimes|image|max:5500',
            'website_url'        => 'sometimes',
        ], $messages);
        
        
        $funeralHomeExists = FuneralHome::where('address', $data['address'])->where('zip_code', $data['zip_code'])->where('phone_number', $data['phone_number'])->exists();
        
        if ($funeralHomeExists) {
            return redirect()->back()->withInput()->with('message-error', 'There is a funeral home on that address with the same phone number!');
        }
        
        $funeralHome = new FuneralHome();
        
        //        if ($request->has('become_partner')) {
        $name = explode(' ', $data['contact_name'], 2);
        
        $user = new User;
        $role = Role::where('code', 'affiliate')->first();
        
        $user->role_id = $role->id;
        $user->first_name = $name[0];
        $user->last_name = isset($name[1]) ? $name[1] : '';
        $user->email = $data['email'];
        
        $password = str_random(8);
        $user->password = bcrypt($password);
        
        $user->save();
        
        $funeralHome->is_partner = true;
        $funeralHome->user_id = $user->id;
        
        Mail::to($user->email)->send(new PartnerCreated($user->email, $password));
        
        auth()->login($user);
        //        }
        
        
        $funeralHome->name = $data['name'];
        $funeralHome->contact_name = $data['contact_name'];
        $funeralHome->communities_served = $data['communities_served'];
        $funeralHome->email = $data['email'];
        $funeralHome->website_url = $data['website_url'];
        $funeralHome->phone_number = $data['phone_number'];
        $funeralHome->address = $data['address'];
        $funeralHome->zip_code = $data['zip_code'];
        $funeralHome->social_media = $data['social'] ? json_encode($data['social']) : null;
        
        $funeralHome->save();
        
        $mapPin = new MapPin();
        
        $mapPin->entity_id = $funeralHome->id;
        $mapPin->entity = FuneralHome::class;
        $mapPin->longitude = $request->longitude;
        $mapPin->latitude = $request->latitude;
        
        $mapPin->save();
        
        if ($request->hasFile('upload_image')) {
            $file = $request->file('upload_image');
            $filename = uniqid('fh_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/funeral-homes');
            
            $uploaded = $file->move($path, $filename);
            
            $image = new File();
            
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($funeralHome);
            $image->save();
        }
        
        if ($request->has('become_partner')) {
            return redirect()->route('partner.index');
        }
        
        return redirect()->route('home');
    }

    public function search()
    {
        return view('funeral-home.search');
    }
}
