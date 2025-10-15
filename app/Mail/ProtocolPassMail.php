<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProtocolPassMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    public $fullname;
    public $amount;
    public $trans_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $fullname, $amount, $trans_id)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->amount = $amount;
        $this->trans_id = $trans_id;
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
        ->markdown('emails.protocolpass')
        ->with([
            'email' => $this->email,
            'fullname' => $this->fullname,
            'amount' => $this->amount,
            'trans_id' => $this->trans_id,
        ]);
 }
}
