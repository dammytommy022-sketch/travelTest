<?php

namespace App\Mail;

use App\Models\ExtraLuggage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExtraLuggageSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(ExtraLuggage $support)
    {
        $this->support = $support;
    }

    /**
     * Build the message.
     */

public function build()
{
    return $this->subject('Your Extra Luggage Payment Was Successful!')
                ->view('emails.extra_success') 
                ->with([
                    'name' => $this->support->full_name ?? 'Customer',
                    'airline' => $this->support->airline ?? 'Selected Airline',
                    'amount' => $this->support->amount,
                    'reference' => $this->support->payment_reference,
                    'service' => 'Extra Luggage Request',
                ]);
}
}
