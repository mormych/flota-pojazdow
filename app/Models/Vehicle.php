<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'registration_number',
        'vin',
        'mileage',
        'fuel_type',
        'status'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function fuelLogs(): HasMany
    {
        return $this->hasMany(FuelLog::class);
    }
}
