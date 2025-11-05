<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraLuggage extends Model
{
    use HasFactory;
    protected $table = 'extra_luggages';

    protected $fillable = [
        'airline',
        'email',
        'contact_number',
        'ticket',
        'data_page',
    ];
}
