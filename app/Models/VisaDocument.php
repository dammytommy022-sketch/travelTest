<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisaDocument extends Model
{
    use HasFactory;

    protected $fillable = ['visa_id', 'document_name', 'category', 'description'];

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }
}
