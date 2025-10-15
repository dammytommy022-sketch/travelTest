<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails;

    /**
     * Create a new message instance.
     *
     * @param array $bookingDetails
     */
    public function __construct($bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Hotel Booking Notification')
                    ->view('air.hotel.emails.booking_notification') // reference to the email blade template
                    ->with([
                        'bookingDetails' => $this->bookingDetails
                    ]);
    }
}
