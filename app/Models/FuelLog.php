<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuelLog extends Model
{
    protected $fillable = [
        'vehicle_id',
        'fuel_date',
        'liters',
        'price_per_liter',
        'mileage',
    ];

    protected function casts(): array
    {
        return [
            'fuel_date' => 'date',
            'liters' => 'decimal:2',
            'price_per_liter' => 'decimal:2',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getTotalCostAttribute(): float
    {
        return (float) $this->liters * (float) $this->price_per_liter;
    }
}