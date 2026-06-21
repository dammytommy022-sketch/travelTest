<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'car_hire_id',
        'transfer_id',
        'booking_type',
        'car_model',
        'car_colour',
        'plate_number',
        'car_images',
        'notes',
        'email_sent_at',
        'assigned_at',
    ];

    protected $casts = [
        'car_images'    => 'array',   // stored as JSON, accessed as PHP array
        'assigned_at'   => 'datetime',
        'email_sent_at' => 'datetime',
    ];

    // ── Relationships ──────────────────────────────

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function carHire()
    {
        return $this->belongsTo(CarHire::class);
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    // ── Helpers ────────────────────────────────────

    /**
     * Get the booking model regardless of type.
     * Usage: $assignment->booking()
     */
    public function booking()
    {
        return $this->booking_type === 'car_hire'
            ? $this->carHire
            : $this->transfer;
    }

    /**
     * Returns asset URLs for all car images.
     * Usage in blade: @foreach($assignment->carImageUrls() as $url)
     */
    public function carImageUrls(): array
    {
        if (empty($this->car_images)) return [];
        return array_map(fn($path) => asset($path), $this->car_images);
    }

    /**
     * Check whether the assignment email has already been sent.
     */
    public function emailSent(): bool
    {
        return $this->email_sent_at !== null;
    }
}