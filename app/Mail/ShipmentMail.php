<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ShipmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;
    public $filename;

    public function __construct($shipment, $filename)
    {
        $this->shipment = $shipment;
        $this->filename = $filename;
    }

    public function build()
    {
        return $this->from('info@travelwheel.ng', 'Travel Wheel')
            ->cc('support@travelwheel.ng') 
            ->subject('TravelWheel, Air Cargo Shipment')
            ->markdown('emails.shipment')
            ->with([
                'shipment' => $this->shipment,
            ])
            ->attach(Storage::path('public/shipments/' . $this->filename));
    }
}