<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoaApplication extends Model
{
    use HasFactory;

    protected $table = 'voa_applications';

    // Mass assignable attributes
    protected $fillable = [
        'single_entry_fee',
        'biometrics_fee',
        'service_charge',
        'payment_charge',
        'processing_charge',
        'total_fee',
        'total_people',
        'departure_date',
        'return_date',
        'applicant',
        'email',
        'token',
        'payment_reference',
        'status',
        'visa_document_path',
        'status_updated_at',
        'visa_to'
    ];
    
    protected $casts = [
    'status_updated_at' => 'datetime',
];

}
