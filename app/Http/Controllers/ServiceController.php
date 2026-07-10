<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $services = $vehicle->services()
            ->orderByDesc('service_date')
            ->get();

        return view('services.index', compact('vehicle', 'services'));
    }

    public function create(Vehicle $vehicle)
    {
        return view('services.create', compact('vehicle'));
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'service_date' => ['required', 'date'],
            'type' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'cost' => ['required', 'numeric', 'min:0'],
            'mileage' => ['required', 'integer', 'min:0'],
        ]);

        $vehicle->services()->create($validated);

        return redirect()
            ->route('vehicles.services.index', $vehicle)
            ->with('success', 'Wpis serwisowy został dodany.');
    }

    public function destroy(Vehicle $vehicle, Service $service)
    {
        if ($service->vehicle_id !== $vehicle->id) {
            abort(404);
        }

        $service->delete();

        return redirect()
            ->route('vehicles.services.index', $vehicle)
            ->with('success', 'Wpis serwisowy został usunięty.');
    }
}