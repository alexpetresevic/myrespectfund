<?php

namespace App\Mail;

use App\Services\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThanksForDonating extends Mailable
{
    use Queueable, SerializesModels;
    
    private $campaign;
    
    /**
     * Create a new message instance.
     *
     * @param $campaign
     */
    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Thank you for your donation to ' . $this->campaign->title;
        $settings = Settings::getInstance();
        $data = [
            'title' => $this->campaign->title,
            'campaignStory' => $this->campaign->campaign_story,
            'funeralDate' => $this->campaign->funeral_date,
            'funeralTime' => $this->campaign->funeral_time,
            'address' => $this->campaign->address,
            'settings' => $settings
        ];
        
        return $this->subject($subject)
                    ->markdown('emails.thanks-for-donating')->with($data);
    }
}
