<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Donation;
use App\Subscription;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        
        return view('donation.index', compact('campaign'));
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'campaign_id'    => 'required|exists:campaigns,id',
            'amount'         => 'required|numeric',
            'tip'            => 'required|numeric',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'country'        => 'required',
            'postal_code'    => 'required',
            'email'          => 'required|email',
            'comment'        => 'nullable',
            'get_updates'    => 'boolean',
            'anonymous'      => 'boolean',
            'create_account' => 'boolean',
        ]);
        
        $donation = $this->createDonation($data, Donation::DONATION_TYPE_FUND, $data['amount']);
        
        if ($data['get_updates']) {
            $subscription = new Subscription();
            $subscription->campaign_id = $data['campaign_id'];
            $subscription->email = $data['email'];
            $subscription->save();
        }
        
        if ($data['tip'] > 0) {
            $tip = $this->createDonation($data, Donation::DONATION_TYPE_TIP, $data['tip']);
            
            return redirect()->route('payment.index', ['donation' => encrypt($donation->id), 'tip' => encrypt($tip->id)]);
        }
        
        return redirect()->route('payment.index', ['donation' => encrypt($donation->id)]);
    }
    
    private function createDonation($data, $type, $amount)
    {
        $donation = new Donation();
        
        $donation->campaign_id = $data['campaign_id'];
        
        $donation->type = $type;
        $donation->amount = $amount;
        $donation->first_name = $data['first_name'];
        $donation->last_name = $data['last_name'];
        $donation->country = $data['country'];
        $donation->postal_code = $data['postal_code'];
        $donation->email = $data['email'];
        $donation->comment = $data['comment'];
        if (isset($data['anonymous'])) {
            $donation->anonymous = $data['anonymous'];
        }
        
        $donation->save();
        
        return $donation;
    }
    
    public function leaveTip(Request $request)
    {
        $data = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'tip'         => 'required|numeric|min:1',
            'first_name'  => 'required',
            'last_name'   => 'required',
            'country'     => 'required',
            'postal_code' => 'required',
            'email'       => 'required|email',
            'comment'     => 'nullable',
        ]);
        
        $donation = $this->createDonation($data, Donation::DONATION_TYPE_TIP, $data['tip']);
        
        return redirect()->route('payment.leave-tip', ['donation' => encrypt($donation->id)]);
    }
}
