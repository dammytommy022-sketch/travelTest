<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_id',
        'voa_id',
        'email',
        'user_details',
        'form_data',
        'status',
        'payment_status',
        'application_id',
        'flight_hotel_insurance',
        'visa_document_path',
        'status_updated_at',
    ];

    protected $casts = [
        'user_details' => 'array',
        'form_data' => 'array',
    ];

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }
    public function document_requests()
    {
        return $this->hasMany(DocumentRequest::class, 'application_id');
    }
}

