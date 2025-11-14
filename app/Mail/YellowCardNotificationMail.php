<?php

namespace App\Mail;

use App\Models\YellowCard;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class YellowCardNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(YellowCard $support, $attachments)
    {
        $this->support = $support;
        $this->attachments = $attachments;
    }


    public function build()
    {
    // Logic to translate service type for display
    $serviceTypeMap = [
        'standard' => 'Standard (3 Days)',
        'fasttrack' => 'Fast Track (24 Hours)',
    ];
    $serviceTypeDisplay = $serviceTypeMap[$this->support->service_type] ?? $this->support->service_type;

    return $this->subject('New Yellow Card Application - ' . ($this->support->full_name ?? $this->support->email))
                ->view('emails.yellow_card_notification') 
                ->with([
                    'name' => $this->support->full_name,
                    'email' => $this->support->email,
                    'phone' => $this->support->phone_number, 
                    'service_type_display' => $serviceTypeDisplay,
                    'data_page' => $this->support->data_page, 
                    'home_address' => $this->support->home_address, 
                    'delivery_address' => $this->support->delivery_address, 
                    'amount' => $this->support->amount,
                    'reference' => $this->support->payment_reference,
                ]);
                foreach ($this->attachments as $path) {
                    $email->attach($path);
                }
                return $email;
}
}
