<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaConfirmation extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'payment_option',
        'visa_file',
        'phone_number',
        'additional_info',
        'payment_reference',
        'payment_status',
        'amount',
        'seerbit_ref',
    ];
}

