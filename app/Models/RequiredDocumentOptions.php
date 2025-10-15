<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequiredDocumentOptions extends Model
{
    use HasFactory;
    protected $table = 'required_documents_option';

    protected $fillable = ['document_name'];
}
