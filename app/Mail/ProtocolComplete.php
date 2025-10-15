<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProtocolMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $dataform;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public function __construct($data, $dataform)
    {
        $this->data = $data;
        $this->dataform = $dataform;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@travelwheel.ng', 'Travel Wheel')
                    ->subject('Transaction Completed')
                    ->view('emails.protocolComplete')
                    ->cc('reservation@travelwheel.ng');
    }
}
