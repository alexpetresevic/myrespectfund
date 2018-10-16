<?php

namespace App\Mail;

use App\Services\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartnerCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $username;
    private $password;

    /**
     * Create a new message instance.
     *
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $settings = Settings::getInstance();
        return $this->markdown('emails.partner-created')->with([
            'username' => $this->username,
            'password' => $this->password,
            'settings' => $settings
        ]);
    }
}
