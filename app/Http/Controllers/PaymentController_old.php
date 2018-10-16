<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Mail\ThanksForDonating;
use App\Services\WepayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use WePay;

class PaymentController extends Controller
{
    public function index($donation, $tip = null)
    {
        $donation = decrypt($donation);
        $donation = Donation::find($donation);
        
        if ($tip) {
            $tip = decrypt($tip);
            $tip = Donation::find($tip);
        }
        
        return view('payment.index', compact('donation', 'tip'));
    }
    
    public function store(Request $request, Donation $donation, Donation $tip = null)
    {
//                $campaignWepayAccount = $donation->campaign->user->wepayAccount;
        //
//                $wepayService = new WepayService();
        
        $donation->credit_card_id = $request->creditCardId;
        $donation->approved = 1;
        $donation->update();
        
        
        
        $tipAmount = is_null($tip) ? 0 : $tip->amount;
        // charge tip
        if ($tipAmount) {
            $tip->credit_card_id = $request->creditCardId;
            $tip->approved = 1;
            $tip->update();
        }
        
        return $donation;
        
        // charge donation
//                $donationResponce = $wepayService->sendRequest($campaignWepayAccount->access_token, $donation->amount, $campaignWepayAccount->account_id, $request->creditCardId);
        //
        //        if (is_string($donationResponce)){
        //            return response()->json([
        //                'error' => $donationResponce
        //            ]);
        //        }else{
        //            $donation->update();
        //        }
        //
        //
        //        $tipAmount = is_null($tip) ? 0 : $tip->amount;
        //        // charge tip
        //        if ($tipAmount) {
        //            $wepayService->sendRequest(null, $tipAmount, null, $request->creditCardId);
        //        }
    }
    
    public function success($donation)
    {
        $donation = decrypt($donation);
        $donation = Donation::find($donation);

        Mail::to($donation->email)->send(new ThanksForDonating($donation->campaign));

        // For Testing
        //$donation = Donation::find(1);

        return view('payment.success', compact('donation'));
    }
    
    public function leaveTip($donation)
    {
        $donation = decrypt($donation);
        $donation = Donation::find($donation);
        
        return view('payment.tip', compact('donation'));
    }
    
    public function storeTip(Request $request, Donation $donation)
    {
        $donation->credit_card_id = $request->creditCardId;
        $donation->approved = 1;
        $donation->update();
    
        $wepayService = new WepayService();
    
        $donationResponse = $wepayService->sendRequest(null, [$donation], null);
    
        return $donationResponse;
    }
    
    public function successTip($donation)
    {
        $donation = decrypt($donation);
        $donation = Donation::find($donation);
    
        return view('payment.tip-success', compact('donation'));
    }
}
