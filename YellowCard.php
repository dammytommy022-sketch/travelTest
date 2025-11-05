<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YellowCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type',
        'full_name',
        'data_page',
        'email',
        'home_address',
        'phone_number',
        'delivery_address',
        'price',
    ];
}
