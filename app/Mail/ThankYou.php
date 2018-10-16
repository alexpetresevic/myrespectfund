<?php

namespace App\Mail;

use App\Services\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThankYou extends Mailable
{
    use Queueable, SerializesModels;
    
    private $campaign;
    private $title;
    private $text;
    private $info;
    
    /**
     * Create a new message instance.
     *
     * @param $title
     * @param $text
     * @param $info
     */
    public function __construct($campaign, $title, $text, $info)
    {
        $this->campaign = $campaign;
        $this->title = $title;
        $this->text = $text;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Thank you from ' . $this->campaign->title;
        $settings = Settings::getInstance();
        $data = [
            'title' => $this->title,
            'text' => $this->text,
            'info' => $this->info,
            'settings' => $settings
        ];
        
        return $this->subject($subject)
                    ->markdown('emails.thank-you')->with($data);
    }
}
