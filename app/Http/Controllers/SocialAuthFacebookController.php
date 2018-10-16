<?php

namespace App\Http\Controllers;

use App\File;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {
        if (request()->start_campaign) {
            Cookie::queue('startFundraiser', true, 60);
        }
        
        return Socialite::driver('facebook')->redirect();
    }
    
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(Request $request)
    {
        $startFundraiser = Cookie::get('startFundraiser');
        
        if ( ! $request->input('code')) {
            return redirect('login')->with('message-error', 'Login failed');
        }
        $facebookAccount = Socialite::driver('facebook')->user();
        //        dd($facebookAccount->getId());
        $facebookName = explode(' ', $facebookAccount->getName(), 2);
        $user = User::where('email', $facebookAccount->getEmail())->first();
        
        if ( ! is_null($user)) {
            Auth::login($user);
            if ($startFundraiser) {
                Cookie::queue(Cookie::forget('startFundraiser'));
                if ( ! $user->campaign()->exists()) {
                    return redirect()->route('campaign.create');
                }
            }
            
            return redirect()->route('home');
        }
        
        $user = new User();
        
        $user->first_name = $facebookName[0];
        $user->last_name = $facebookName[1];
        $user->role_id = Role::getRoleId('member');
        $user->email = is_null($facebookAccount->getEmail()) ? 'N/A' : $facebookAccount->getEmail();
        $user->facebook_token = $facebookAccount->token;
        $user->facebook_id = $facebookAccount->getId();
        $user->password = bcrypt(str_random(10));
        
        $user->save();
        
        $facebookImage = file_get_contents($facebookAccount->avatar_original);
        
        $filename = uniqid('cam_') . '.jpg';
        $path = public_path('/uploads/users/' . $filename);
        file_put_contents($path, $facebookImage);
        
        $image = new File();
        
        $image->filename = $filename;
        $image->image_url = $path;
        $image->file()->associate($user);
        
        $image->save();
        
        Auth::login($user);
        
        
        if ($startFundraiser) {
            Cookie::queue(Cookie::forget('startFundraiser'));
            
            return redirect()->route('campaign.create');
        }
        
        return redirect()->route('home');
    }
}
