<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisaForm extends Model
{
    use HasFactory;

    protected $fillable = ['visa_id', 'form_name', 'form_type', 'file_path', 'form_fields'];

    protected $casts = [
        'form_fields' => 'array'
    ];

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }
}
