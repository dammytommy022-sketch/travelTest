<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\SupportRequest;

class SupportNotificationMail extends Mailable
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
        return $this->subject('New Support Request Payment - ' . ($this->support->name_on_ticket ?? 'Client'))
                    ->view('emails.support_notification')
                    ->with([
                        'name' => $this->support->name_on_ticket ?? 'N/A',
                        'email' => $this->support->email,
                        'phone' => $this->support->phone,
                        'service' => ucfirst(str_replace('_', ' ', $this->support->request_type)),
                        'booking_source' => ucfirst($this->support->booking_source),
                        'amount' => $this->support->amount,
                        'reference' => $this->support->payment_reference,
                        'additional_info' => $this->support->additional_info,
                    ]);
    }
}
