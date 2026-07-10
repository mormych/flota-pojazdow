@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1>Historia tankowań</h1>

        <p>
            <strong>
                {{ $vehicle->brand }}
                {{ $vehicle->model }}
                ({{ $vehicle->registration_number }})
            </strong>
        </p>
    </div>

    <div>

        <a href="{{ route('vehicles.index') }}"
           class="btn btn-secondary">
            Powrót
        </a>

        @if(auth()->user()->isAdmin())

        <a href="{{ route('vehicles.fuel-logs.create',$vehicle) }}"
           class="btn btn-primary">
            + Dodaj tankowanie
        </a>

        @endif

    </div>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<table class="table table-striped table-bordered">

<thead class="table-dark">

<tr>

<th>Data</th>
<th>Litry</th>
<th>Cena/l</th>
<th>Koszt</th>
<th>Przebieg</th>

@if(auth()->user()->isAdmin())
<th>Akcja</th>
@endif

</tr>

</thead>

<tbody>

@forelse($fuelLogs as $fuel)

<tr>

<td>{{ $fuel->fuel_date->format('d.m.Y') }}</td>

<td>{{ $fuel->liters }} l</td>

<td>{{ number_format($fuel->price_per_liter,2,',',' ') }} zł</td>

<td>{{ number_format($fuel->total_cost,2,',',' ') }} zł</td>

<td>{{ $fuel->mileage }} km</td>

@if(auth()->user()->isAdmin())

<td>

<form action="{{ route('vehicles.fuel-logs.destroy',[$vehicle,$fuel]) }}"
method="POST">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">

Usuń

</button>

</form>

</td>

@endif

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

Brak tankowań.

</td>

</tr>

@endforelse

</tbody>

</table>

@endsection