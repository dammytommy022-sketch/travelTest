<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

  
    
    public function visas()
    {
        return $this->hasMany(Visa::class);
    }

    public function voas()
    {
        return $this->hasMany(Voa::class, 'from_country_id');
    }
}
