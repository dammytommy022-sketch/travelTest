<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceOption extends Model
{
    use HasFactory;

    protected $table = 'insurance_options';

    protected $fillable = [
        'coverage_days',
        'price',
    ];
}
