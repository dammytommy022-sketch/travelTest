<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class VoaApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $visaPdfPath;  // Changed variable name for clarity
    public $uploadedFiles;  // Changed variable name for clarity
     public $reference;

    public function __construct($pdfPath, $attachments, $reference)
    {
        $this->visaPdfPath = $pdfPath;  // Store the PDF path
        $this->uploadedFiles = $attachments;  // Store the attachments array
        
        $this->reference = $reference;   
    }

    public function build()
    {
        $email = $this->view('emails.voa_application', [
        'pdfPath' => $this->visaPdfPath,
        'reference' => $this->reference
        ])->subject('Visa on Arrival Application');

        // Attach the main visa PDF
        $pdfFullPath = storage_path('app/' . $this->visaPdfPath);
        if (file_exists($pdfFullPath)) {
            $email->attach($pdfFullPath, [
                'as' => 'visa_application.pdf'
            ]);
        }

        // Attach all additional uploaded files
        foreach ($this->uploadedFiles as $filePath) {
            if (file_exists($filePath)) {
                $email->attach($filePath, [
                    'as' => basename($filePath)
                ]);
            }
        }

        return $email;
    }
}