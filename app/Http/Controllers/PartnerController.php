<?php

namespace App\Http\Controllers;

use App\File;
use App\FuneralHome;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Request as RequestMail;

class PartnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $settings = Settings::where('key', 'like', '%partner_%')->get()->groupBy('key')->toArray();
        
        return view('partner.dashboard.index', compact('user', 'settings'));
    }
    
    public function request()
    {
        $user = Auth::user();
        $settings = Settings::where('key', 'like', '%partner_%')->get()->groupBy('key')->toArray();
    
        if (request()->route()->getName() == 'partner.request-literature'){
            $req = 'literature';
        }
    
        if (request()->route()->getName() == 'partner.request-call'){
            $req = 'a call';
        }
        
        return view('partner.dashboard.request', compact('user', 'req', 'settings'));
    }
    
    public function sendRequest(Request $request)
    {
        $request->validate([
           'call_date' => 'required',
           'call_time' => 'required'
        ]);
        
        $funeralHome= $user = Auth::user()->funeralHome;
    
        Mail::to(['cs@myrespects.com'])->send(new RequestMail($request->call_date, $request->call_time, $request->req, $funeralHome));
        
        return redirect()->route('partner.index')->with('message', 'Your request has been sent!');
    }
    
    public function uploadImage(Request $request, FuneralHome $funeralHome)
    {
        if ($request->hasFile('upload_image')) {
            $file = $request->file('upload_image');
            $filename = uniqid('fh_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/funeral-homes');
        
            $uploaded = $file->move($path, $filename);
        
            if ($funeralHome->image()->exists()){
                $funeralHome->image->filename = $uploaded->getFilename();
                $funeralHome->image->image_url = $uploaded->getPathname();
                $funeralHome->image->update();
                return;
            }
            
            $image = new File();
        
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($funeralHome);
            $image->save();
        }
    }

    public function edit()
    {
        $user        = auth()->user();
        $funeralHome = $user->funeralHome;
        $settings = Settings::where('key', 'like', '%partner_%')->get()->groupBy('key')->toArray();
    
        return view('partner.dashboard.edit', compact('user', 'funeralHome', 'settings'));
    }

    public function update(Request $request)
    {
        $messages = [
            'social.facebook.url' => 'Facebook field needs to be an url',
            'social.twitter.url' => 'Twitter field needs to be an url',
            'social.google_plus.url' => 'Google plus field needs to be an url',
            'social.other.url' => 'This field needs to be an url',
        ];

        $data = $request->validate([
            'name'               => 'required|min:3|max:255',
            'contact_name'       => 'required|min:3|max:255',
            'communities_served' => 'required|min:3|max:255',
            'email'              => 'required|email',
            'phone_number'       => 'required',
            'address'            => 'required|min:3|max:255',
            'zip_code'           => 'required|min:3|max:255',
            'social.*'           => 'sometimes|url',
        ], $messages);

        $funeralHome = $request->user()->funeralHome;

        $funeralHome->name = $data['name'];
        $funeralHome->contact_name = $data['contact_name'];
        $funeralHome->communities_served = $data['communities_served'];
        $funeralHome->email = $data['email'];
        $funeralHome->phone_number = $data['phone_number'];
        $funeralHome->address = $data['address'];
        $funeralHome->zip_code = $data['zip_code'];
        $funeralHome->social_media = $data['social'] ? json_encode($data['social']) : null;

        $funeralHome->save();

        return redirect()->route('partner.index')->with('message', 'Success! Information updated successfully.');
    }
}
