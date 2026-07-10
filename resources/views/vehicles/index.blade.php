@extends('layouts.app')


@section('content')

<h1 class="mb-4">
    Lista pojazdów
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('vehicles.index') }}" method="GET" class="row g-2 mb-3">

    <div class="col-md-8">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Szukaj po marce, modelu, numerze rejestracyjnym lub VIN"
            value="{{ $search ?? '' }}"
        >
    </div>

    <div class="col-md-auto">
        <button type="submit" class="btn btn-primary">
            Szukaj
        </button>
    </div>

    <div class="col-md-auto">
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
            Wyczyść
        </a>
    </div>

</form>


@auth

@if(auth()->user()->isAdmin())

<a href="/vehicles/create" class="btn btn-primary mb-3">
    + Dodaj pojazd
</a>

@endif

@endauth


<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>
    <th>Marka</th>
    <th>Model</th>
    <th>Rok</th>
    <th>Rejestracja</th>
    <th>VIN</th>
    <th>Przebieg</th>
    <th>Paliwo</th>
    <th>Status</th>
    <th>Akcja</th>
</tr>

</thead>


<tbody>

@foreach($vehicles as $vehicle)

<tr>

<td>{{ $vehicle->brand }}</td>

<td>{{ $vehicle->model }}</td>

<td>{{ $vehicle->year }}</td>

<td>{{ $vehicle->registration_number }}</td>

<td>{{ $vehicle->vin }}</td>

<td>{{ $vehicle->mileage }} km</td>

<td>{{ $vehicle->fuel_type }}</td>

<td>
    <span class="badge bg-success">
        {{ $vehicle->status }}
    </span>
</td>

<td>

<a href="{{ route('vehicles.services.index', $vehicle) }}"
   class="btn btn-info btn-sm">
    Serwisy
</a>

<a href="{{ route('vehicles.fuel-logs.index',$vehicle) }}"
    class="btn btn-success btn-sm">
Tankowania
</a>

@if(auth()->user()->isAdmin())

<a href="/vehicles/{{ $vehicle->id }}/edit" 
   class="btn btn-warning btn-sm">
    Edytuj
</a>

<form action="/vehicles/{{ $vehicle->id }}" 
      method="POST" 
      style="display:inline">

    @csrf
    @method('DELETE')

    <button class="btn btn-danger btn-sm">
        Usuń
    </button>

</form>

@endif

</td>

</tr>

@endforeach


</tbody>

</table>


@endsection 