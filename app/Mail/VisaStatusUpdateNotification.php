<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaStatusUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function build()
    {
        $subject = 'Visa Application Status Update - ' . $this->application->token;
        $view = $this->application->status === 'Issued' && $this->application->visa_document_path
            ? $this->view('emails.visa_status_update')
                ->subject($subject)
                ->attach(storage_path('app' . str_replace('/storage', '', $this->application->visa_document_path)))
            : $this->view('emails.visa_status_update')
                ->subject($subject);

        return $view;
    }
}