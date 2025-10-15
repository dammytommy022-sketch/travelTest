<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoPackagePrice extends Model
{
    use HasFactory;

    protected $table = 'cargo_package_price';

    protected $fillable = [
        'zone_id', 
        'weight_0_5', 
        'weight_1_0', 
        'weight_1_5', 
        'weight_2_0', 
        'weight_2_5', 
        'weight_3_0', 
        'weight_3_5', 
        'weight_4_0', 
        'weight_4_5', 
        'weight_5_0'
    ];

    public function zone()
    {
        return $this->belongsTo(ShippingZone::class, 'zone_id');
    }
}

