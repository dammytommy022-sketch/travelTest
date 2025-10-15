<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoaRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_type',
        'requirement_name',
        'description',
    ];
}
