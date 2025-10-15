<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    protected $fillable = [
        'application_id',
        'document_name',
        'description',
        'category',
        'status',
        'requested_at',
        'deadline',
        'uploaded_path',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}