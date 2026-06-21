<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FleetCar extends Model
{
    protected $fillable = [
        'service_type',
        'vehicle_type',
        'category',
        'car_name',
        'passengers',
        'features',
        'images',
        'is_active',
    ];

    protected $casts = [
        'features'  => 'array',
        'images'    => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForHire($query)
    {
        return $query->where('service_type', 'car_hire');
    }

    public function scopeForTransfer($query)
    {
        return $query->where('service_type', 'transfer');
    }

    /**
     * Returns public URLs for all stored images.
     */
    public function imageUrls(): array
    {
        return collect($this->images ?? [])
            ->map(fn($f) => asset('storage/fleet/' . $f))
            ->all();
    }
}