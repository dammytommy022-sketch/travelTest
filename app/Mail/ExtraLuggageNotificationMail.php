<?php

namespace App\Mail;

use App\Models\ExtraLuggage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExtraLuggageNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(ExtraLuggage $support, $attachments)
    {
        $this->support = $support;
        $this->attachments = $attachments;
    }

    /**
     * Build the message.
     */
    public function build()
   {
    $clientName = $this->support->full_name ?? $this->support->email ?? 'Client';
    
    return $this->subject('New Extra Luggage Payment - ' . $clientName)
                ->view('emails.extra_notification') 
                ->with([
                    'name' => $clientName,
                    'email' => $this->support->email,
                    'phone' => $this->support->contact_number, 
                    
                    'service' => 'Extra Luggage Request', 
                    'booking_source' => $this->support->booking_source ?? 'Extra Luggage Form',
                    'amount' => $this->support->amount,
                    'reference' => $this->support->payment_reference,
                    'additional_info' => $this->support->additional_info ?? 'N/A', 
                    'airline' => $this->support->airline,
                    'data_page' => $this->support->data_page,
                    'ticket' => $this->support->ticket,      
                ]);
                foreach ($this->attachments as $path) {
                    $email->attach($path);
                }
                return $email;
}
}