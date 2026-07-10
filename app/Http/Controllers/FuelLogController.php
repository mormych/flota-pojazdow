<?php

namespace App\Http\Controllers;

use App\Models\FuelLog;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FuelLogController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $fuelLogs = $vehicle->fuelLogs()
            ->orderByDesc('fuel_date')
            ->get();

        return view('fuel_logs.index', compact('vehicle', 'fuelLogs'));
    }

    public function create(Vehicle $vehicle)
    {
        return view('fuel_logs.create', compact('vehicle'));
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'fuel_date' => ['required', 'date'],
            'liters' => ['required', 'numeric', 'min:0.01'],
            'price_per_liter' => ['required', 'numeric', 'min:0.01'],
            'mileage' => ['required', 'integer', 'min:0'],
        ]);

        $vehicle->fuelLogs()->create($validated);

        if ($validated['mileage'] > $vehicle->mileage) {
            $vehicle->update([
                'mileage' => $validated['mileage'],
            ]);
        }

        return redirect()
            ->route('vehicles.fuel-logs.index', $vehicle)
            ->with('success', 'Tankowanie zostało zapisane.');
    }

    public function destroy(Vehicle $vehicle, FuelLog $fuelLog)
    {
        if ($fuelLog->vehicle_id !== $vehicle->id) {
            abort(404);
        }

        $fuelLog->delete();

        return redirect()
            ->route('vehicles.fuel-logs.index', $vehicle)
            ->with('success', 'Tankowanie zostało usunięte.');
    }
}