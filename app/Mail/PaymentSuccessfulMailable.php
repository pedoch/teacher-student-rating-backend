<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessfulMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $refNo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $refNo)
    {
        $this->name = $name;
        $this->refNo = $refNo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.paymentSuccess')
            ->subject('Payment Successful')->from('info@somstores.com');
    }
}
