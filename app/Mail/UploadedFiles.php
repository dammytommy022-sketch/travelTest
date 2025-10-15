<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadedFiles extends Mailable
{
    use Queueable, SerializesModels;

    public $filePaths;
    public $mail;
    public $visa;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filePaths, $mail)
    {
        $this->filePaths = $filePaths;
       
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Transform file paths into public URLs
        $imageLinks = [];
        foreach ($this->filePaths as $filePath) {
            // Remove the leading "/storage" if present
            $filePath = ltrim($filePath, '/storage');

            // Construct the full URL to the file in the public directory
            $imageUrl = asset('storage/app/public/' . $filePath);

            // Add the image URL to the array
            $imageLinks[] = $imageUrl;
        }

        // Build the email with image links
        return $this->view('emails.uploaded_files')
            ->subject('Uploaded Files')
            ->with(['imageLinks' => $imageLinks, 
                        'email' => $this->mail
            ]);
    }
}