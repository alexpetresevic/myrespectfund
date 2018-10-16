<?php

namespace App\Mail;

use App\Services\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Request extends Mailable
{
    use Queueable, SerializesModels;
    
    private $date;
    private $time;
    private $req;
    private $funeralHome;
    
    /**
     * Create a new message instance.
     *
     * @param $date
     * @param $time
     * @param $req
     * @param $funeralHome
     */
    public function __construct($date, $time, $req, $funeralHome)
    {
        $this->date = $date;
        $this->time = $time;
        $this->req = $req;
        $this->funeralHome = $funeralHome;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $settings = Settings::getInstance();
        return $this->markdown('emails.request')->with([
            'date'     => $this->date,
            'time'     => $this->time,
            'req'      => $this->req,
            'funeralHome' => $this->funeralHome,
            'settings' => $settings
        ]);
    }
}
