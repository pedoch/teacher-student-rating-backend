<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyAccountMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $confirmID;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $confirmID)
    {
        $this->name = $name;
        $this->confirmID = $confirmID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verifyAccount')
        ->subject('Confirm account')->from('info@somstores.com');
    }
}
