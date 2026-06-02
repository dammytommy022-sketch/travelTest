<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $table = 'transfers';

    protected $fillable = [
        'vehicle_type',       // saloon | suv | van | bus | luxury
        'vehicle_name',       // Saloon | SUV | Mini Van | Bus | Luxury
        'amount',             // final calculated price
        'distance_km',        // calculated route distance
        'pickup_location',    // origin (airport, port, address)
        'dropoff_location',   // destination
        'full_name',
        'email',
        'phone_number',
        'passengers',
        'flight_number',      // optional — flight or vessel number
        'special_requests',   // optional — child seat, extra luggage etc.
        'pickup_date',
        'pickup_time',
        'payment_option',     // budpay | seerbit
        'payment_reference',  // unique reference e.g. TRANSFER-XXXXXXXX
        'payment_status',     // pending | paid | failed
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'amount'      => 'float',
        'distance_km' => 'float',
    ];
}