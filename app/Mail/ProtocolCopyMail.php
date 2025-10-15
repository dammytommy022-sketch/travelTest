<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProtocolCopyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    public $fullname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $fullname)
    {
        $this->email = $email;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@travelwheel.ng', 'TravelWheel')
        ->subject('Protocol Service')
        ->markdown('emails.protocol')
        ->with([
            'email' => $this->email,
            'fullname' => $this->fullname,
        ]);
 }
}
