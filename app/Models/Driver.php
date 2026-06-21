<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'photo',
        'license_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Relationships ──────────────────────────────

    public function assignments()
    {
        return $this->hasMany(DriverAssignment::class);
    }

    // ── Helpers ────────────────────────────────────

    /**
     * Returns the full asset URL for the driver photo.
     * Usage in blade: {{ $driver->photoUrl() }}
     */
    public function photoUrl(): string
    {
        return $this->photo
            ? asset($this->photo)
            : asset('assets/img/drivers/default.png');
    }

    /**
     * Scope to only active drivers — use in admin dropdowns.
     * Usage: Driver::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
