<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $bilgiler;

    public function __construct($gonder)
    {
        $this->bilgiler = $gonder;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('hello@company.com')
            ->markdown('backend.company.emails.SendInvite')
            ->subject('You\'ve been invited!');
    }
}
