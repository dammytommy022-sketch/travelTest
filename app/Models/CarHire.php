<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarHire extends Model
{
    use HasFactory;

    protected $table = 'car_hires';

    protected $fillable = [
        'car_type',
        'category',
        'car_model',
        'full_name',
        'email',
        'phone_number',
        'passengers',
        'pickup_location',
        'dropoff_location',
        'pickup_date',
        'pickup_time',
        'distance_km',      // ← was missing — caused toArray() to exclude it
        'rental_hours',     // ← was missing — caused toArray() to exclude it
        'amount',
        'payment_option',
        'payment_reference',
        'payment_status',
        'driver_assigned',
    ];

    protected $casts = [
        // Keep as string so it serialises as "2025-06-25" in JSON, not a Carbon object
        // If you want date helpers elsewhere, use Carbon::parse($model->pickup_date) manually
        'pickup_date'     => 'string',
        'amount'          => 'float',
        'distance_km'     => 'float',
        'rental_hours'    => 'float',
        'driver_assigned' => 'boolean',
    ];
}