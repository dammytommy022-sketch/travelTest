<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
  

    public function __construct($data)
    {
        $this->data = $data;

        // Process image links
       $imageLinks = [];
        foreach ($data['filePaths'] as $filePath) {
            // Remove the leading "/storage" if present
            $filePath = ltrim($filePath, '/storage');

            // Construct the full URL to the file in the public directory
            $imageUrl = asset('storage/app/public/' . $filePath);

            // Add the image URL to the array
            $this->imageLinks[] = $imageUrl;
        }
    }

    public function build()
    {
        $email = $this->view('emails.visa_application_notification')
            ->with([
                'data' => $this->data,
                'imageLinks' => $this->imageLinks
            ]);

        // Attach the KYC PDF
        if (!empty($this->data['pdfFilePath'])) {
            $email->attach($this->data['pdfFilePath']);
        }

        return $email;
    }
}
