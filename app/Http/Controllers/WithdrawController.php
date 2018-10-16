<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Mail\ThankYou;
use App\Services\WepayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use WePay;

class WithdrawController extends Controller
{
    
    public function index()
    {
       
        $campaign = Auth::user()->campaign;
     
        if ($campaign->active && strtotime(is_null($campaign->campaign_end) ? date('Ydm') : $campaign->campaign_end) < time()) { 

            return view('withdraw.withdraw-one', compact('campaign'));

        }else{
            return redirect()->route('campaign.dashboard')->with('message-error', 'You are unable to withdraw funds at this time!');
        }
        
    }
    
    public function stepTwo()
    {       
        $campaign = Auth::user()->campaign;
        $campaign->active = 0;
        $campaign->update();
        
        request()->session()->flash('message', 'Withdraw successful!');
        
        return view('withdraw.withdraw-two', compact('campaign'));
    }
    
    public function stepThree()
    {
        $campaign = Auth::user()->campaign;
        
        return view('withdraw.withdraw-three', compact('campaign'));
    }
    
    public function stepFour(Request $request)
    {
        $campaign = Auth::user()->campaign;
        
        $this->sendEmail($request, $campaign);
        
        return view('withdraw.withdraw-four', compact('campaign'));
    }
    
    public function withdraw()
    {
        $user = Auth::user();

        $campaignWepayAccount = $user->wepayAccount;

        $wepayService = new WepayService();
        
        $donations = $user->campaign->allApprovedDonations()->where('charged', 0)->get();

        $tips = $user->campaign->allTips()->where('charged', 0)->get();
        
        $donationWithdraw = $wepayService->sendRequest($campaignWepayAccount->access_token, $donations, $campaignWepayAccount->account_id);
        
        $tipWithdraw = $wepayService->sendRequest(null, $tips, null);
        
        if (is_string($donationWithdraw)) {
            return response()->json([
                'error' => $donationWithdraw
            ], 400);
        }
        
        return response()->json([
            'donation' => $donationWithdraw,
            'tip'      => $tipWithdraw
        ]);
    }
    
    public function leaveTip(Request $request)
    {
        $user = Auth::user();
        $campaign = $user->campaign;
        
        if ($user->testimonial()->exists()) {
            $this->sendEmail($request, $campaign);
        }
        
        return view('withdraw.withdraw-donate', compact('campaign'));
    }
    
    /**
     * @param Request  $request
     * @param Campaign $campaign
     */
    private function sendEmail($request, $campaign)
    {
        $title = $request->thank_you_title;
        $text = $request->thank_you_text;
        $info = '';
        if ($request->send_info == 'on') {
            $info = 'Funeral date: ' . $campaign->funeral_date . ' at ' . $campaign->funeral_time;
        }
        
        if ( ! is_null($title) && ! is_null($text)) {
            foreach ($campaign->donations as $donation) {
                Mail::to($donation->email)->send(new ThankYou($campaign, $title, $text, $info));
            }
        }
    }
}
