<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $vehicles = Vehicle::query()
            ->when($search, function ($query, $search) {
                $query->where('brand', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhere('registration_number', 'like', '%' . $search . '%')
                    ->orWhere('vin', 'like', '%' . $search . '%');
            })
            ->orderBy('brand')
            ->get();

        return view('vehicles.index', compact('vehicles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'brand' => ['required', 'string', 'max:100'],
        'model' => ['required', 'string', 'max:100'],
        'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'registration_number' => [
            'required',
            'string',
            'max:20',
            'unique:vehicles,registration_number'
        ],
        'vin' => [
            'required',
            'string',
            'size:17',
            'unique:vehicles,vin'
        ],
        'mileage' => ['required', 'integer', 'min:0'],
        'fuel_type' => ['required', 'in:Benzyna,Diesel,Elektryczny,Hybryda'],
        'status' => ['required', 'in:Aktywny,Serwis,Wycofany'],
    ]);

    Vehicle::create($validated);

    return redirect()
        ->route('vehicles.index')
        ->with('success', 'Pojazd został dodany.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);

    $validated = $request->validate([
        'brand' => ['required', 'string', 'max:100'],
        'model' => ['required', 'string', 'max:100'],
        'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'registration_number' => [
            'required',
            'string',
            'max:20',
            'unique:vehicles,registration_number,' . $vehicle->id
        ],
        'vin' => [
            'required',
            'string',
            'size:17',
            'unique:vehicles,vin,' . $vehicle->id
        ],
        'mileage' => ['required', 'integer', 'min:0'],
        'fuel_type' => ['required', 'in:Benzyna,Diesel,Elektryczny,Hybryda'],
        'status' => ['required', 'in:Aktywny,Serwis,Wycofany'],
    ]);

    $vehicle->update($validated);

    return redirect()
        ->route('vehicles.index')
        ->with('success', 'Dane pojazdu zostały zaktualizowane.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();

        return redirect('/vehicles');
    }
}
