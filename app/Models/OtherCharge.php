<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtherCharge extends Model
{
    use HasFactory;

    protected $fillable = ['visa_id', 'charge_name', 'amount', 'note', 'pay_to_embassy', 'traveler_type'];

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }
}
