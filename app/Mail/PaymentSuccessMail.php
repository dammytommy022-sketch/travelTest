<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\SupportRequest;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(SupportRequest $support)
    {
        $this->support = $support;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Payment Successful - Support Request Received')
                    ->view('emails.support_success')
                    ->with([
                        'name' => $this->support->name_on_ticket ?? 'Customer',
                        'service' => ucfirst(str_replace('_', ' ', $this->support->request_type)),
                        'amount' => $this->support->amount,
                        'reference' => $this->support->payment_reference,
                    ]);
    }
}
