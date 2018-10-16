<?php

namespace App\Observers;

use App\CampagnUpdate;
use App\Campaign;
use App\Mail\CampaignUpdateNotification;
use App\Subscription;
use Illuminate\Support\Facades\Mail;

class CampaignUpdateObserver
{
    public function created(CampagnUpdate $model)
    {
        $campaign = Campaign::where('id', $model->campaign_id)->first();


        $subscribers = Subscription::select('email')->where('campaign_id', $campaign->id)->get()->toArray();

        if (count($subscribers)) {
            foreach ($subscribers as $email) {
                Mail::to($email)->send(new CampaignUpdateNotification($campaign));
            }
        }
    }
}