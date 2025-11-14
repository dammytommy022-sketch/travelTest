<?php

namespace App\Mail;

use App\Models\YellowCard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YellowCardSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(YellowCard $support)
    {
        $this->support = $support;
    }
    public function build()
    {
    $serviceTypeMap = [
        'standard' => 'Standard (3 Days)',
        'fasttrack' => 'Fast Track (24 Hours)',
    ];
    $timelineMap = [
        'standard' => '3 business days',
        'fasttrack' => '24 hours',
    ];

    $serviceTypeDisplay = $serviceTypeMap[$this->support->service_type] ?? $this->support->service_type;
    $timeline = $timelineMap[$this->support->service_type] ?? 'shortly';

    return $this->subject('Your Yellow Card Application is Confirmed!')
                ->view('emails.yellow_card_success') 
                ->with([
                    'name' => $this->support->full_name ?? 'Customer',
                    'service_type_display' => $serviceTypeDisplay,
                    'delivery_address' => $this->support->delivery_address,
                    'timeline' => $timeline,
                    'amount' => $this->support->amount,
                    'reference' => $this->support->payment_reference,
                ]);
    }
}
