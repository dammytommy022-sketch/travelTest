<?php

namespace App\Mail;

// 🛑 CORRECTED IMPORT: Import the Model instead of the Controller
use App\Models\VisaConfirmation; 

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaConfirmationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(VisaConfirmation $support, $attachments) 
    {
        $this->support = $support;
        $this->attachments = $attachments;
    }

    /**
     * Build the message.
     */
    // In App\Mail\VisaConfirmationNotificationMail.php

    public function build()
    {
    return $this->subject('New Visa Confirmation Payment - ' . ($this->support->full_name ?? $this->support->email ?? 'Client'))
                
                ->view('emails.visa_notification') 
                ->with([
                    'name' => $this->support->full_name ?? $this->support->email ?? 'Client',
                    'email' => $this->support->email,
                    'phone' => $this->support->phone_number, 
                    'visa_file' => $this->support->visa_file, 
                    'service' => 'Visa Confirmation Request', 
                    'booking_source' => $this->support->booking_source ?? 'Form Submission',
                    'amount' => $this->support->amount,
                    'reference' => $this->support->payment_reference,
                    'additional_info' => $this->support->additional_info ?? 'N/A', 
                ]);

                foreach ($this->attachments as $path) {
                    $email->attach($path);
                }
                return $email;
}
}
