<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraLuggage extends Model
{
    protected $table = 'extra_luggage_requests';
    use HasFactory;

    protected $fillable = [
        'full_name',
        'airline_category',
        'data_page',
        'ticket',
        'contact_number',
        'email',
        'payment_option',
        'airline',
        'payment_reference',
        'payment_status',
        'amount',
    ];
}

