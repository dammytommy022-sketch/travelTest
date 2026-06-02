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
        'full_name',
        'email',
        'phone_number',
        'passengers',
        'pickup_location',
        'dropoff_location',
        'pickup_date',
        'pickup_time',
        'amount',
        'payment_option',
        'payment_reference',
        'payment_status',   // pending | paid | failed
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'amount'      => 'float',
    ];
}
