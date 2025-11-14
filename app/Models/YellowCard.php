<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YellowCard extends Model
{
    use HasFactory;
    protected $table = 'yellow_cards'; 

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'service_type',
        'data_page', 
        'home_address',
        'delivery_address',
        'amount',           
        'payment_reference',
        'status', 
        'product_type',
        'payment_option',  
    ];

}
