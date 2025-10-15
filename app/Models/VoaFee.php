<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoaFee extends Model
{
    // Table name (optional if Laravel's pluralization handles it)
    protected $table = 'voa_fees';

    // Mass assignable attributes
    protected $fillable = [
        'fee_type',
        'amount_african',
        'amount_non_african',
    ];

    // Cast fields to proper types
    protected $casts = [
        'amount_african' => 'decimal:2',
        'amount_non_african' => 'decimal:2',
    ];

    // Timestamps are true by default, no need to specify unless disabling
    public $timestamps = true;

    // If you want to guard certain attributes instead of using fillable:
    // protected $guarded = ['id'];
}