<?php

namespace App\Mail;

use App\Services\Settings;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class CampaignUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $campaign;

    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    public function build()
    {
        $subject = $this->campaign->title . ' is updated.';
        $settings = Settings::getInstance();
        return $this->subject($subject)
            ->markdown('emails.campaign-update-notification', ['campaign' => $this->campaign, 'settings' => $settings]);
    }

}