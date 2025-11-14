<?php

namespace App\Mail;

use App\Models\VisaConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaConfirmationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(VisaConfirmation $support)
    {
        $this->support = $support;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Visa Confirmation Payment Was Successful!')
                    ->view('emails.visa_success') 
                    ->with([
                        'name' => $this->support->full_name ?? 'Customer',
                        'amount' => $this->support->amount,
                        'reference' => $this->support->payment_reference,
                    ]);
    }
}
