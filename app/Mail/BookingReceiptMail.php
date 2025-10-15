<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails;
    public $pdfData;
    public $reference;

    public function __construct($bookingDetails, $pdfData, $reference)
    {
        $this->bookingDetails = $bookingDetails;
        $this->pdfData = $pdfData;
        $this->reference = $reference;
    }

    public function build()
    {
        return $this->view('air.hotel.emails.receipt')
                    ->with([
                        'bookingDetails' => $this->bookingDetails,
                        'reference' => $this->reference,
                    ])
                    ->attachData($this->pdfData, 'BookingReceipt.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
