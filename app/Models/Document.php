<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'required_documents';

    protected $fillable = [
        'country_id',
        'document_name'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
