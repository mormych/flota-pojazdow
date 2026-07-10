@extends('layouts.app')

@section('content')

<h1>Dodaj tankowanie</h1>

<p>

<strong>

{{ $vehicle->brand }}
{{ $vehicle->model }}

</strong>

</p>

<form action="{{ route('vehicles.fuel-logs.store',$vehicle) }}"
method="POST">

@csrf

<div class="mb-3">

<label>Data</label>

<input
type="date"
name="fuel_date"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Litry</label>

<input
type="number"
step="0.01"
name="liters"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Cena za litr</label>

<input
type="number"
step="0.01"
name="price_per_liter"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Przebieg</label>

<input
type="number"
name="mileage"
class="form-control"
value="{{ $vehicle->mileage }}"
required>

</div>

<button class="btn btn-success">

Zapisz

</button>

<a href="{{ route('vehicles.fuel-logs.index',$vehicle) }}"
class="btn btn-secondary">

Anuluj

</a>

</form>

@endsection