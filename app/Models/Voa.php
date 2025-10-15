<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voa extends Model
{
    protected $fillable = ['from_country_id', 'visa_fee', 'is_african_country'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'from_country_id');
    }
}