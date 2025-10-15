<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $fullname;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @return void
     */
    public function __construct($email, $fullname, $data)
    {
        //
        $this->email = $email;
        $this->fullname = $fullname;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->from('info@travelwheel.ng', 'Travel Wheel')
        ->subject('TravelWheel, Flight Request')
        ->markdown('emails.request')
        ->with([
            'email' => $this->email,
            'fullname' => $this->fullname,
            'data' => $this->data,
        ]);
    }
}

