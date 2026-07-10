@extends('layouts.app')

@section('content')

<h1 class="mb-4">Edytuj pojazd</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Marka</label>
        <input
            type="text"
            name="brand"
            class="form-control"
            value="{{ old('brand', $vehicle->brand) }}"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Model</label>
        <input
            type="text"
            name="model"
            class="form-control"
            value="{{ old('model', $vehicle->model) }}"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Rok produkcji</label>
        <input
            type="number"
            name="year"
            class="form-control"
            value="{{ old('year', $vehicle->year) }}"
            min="1900"
            max="{{ date('Y') }}"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Numer rejestracyjny</label>
        <input
            type="text"
            name="registration_number"
            class="form-control"
            value="{{ old('registration_number', $vehicle->registration_number) }}"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">VIN</label>
        <input
            type="text"
            name="vin"
            class="form-control"
            value="{{ old('vin', $vehicle->vin) }}"
            maxlength="17"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Przebieg</label>
        <input
            type="number"
            name="mileage"
            class="form-control"
            value="{{ old('mileage', $vehicle->mileage) }}"
            min="0"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Rodzaj paliwa</label>

        <select name="fuel_type" class="form-select" required>
            @foreach(['Benzyna', 'Diesel', 'Elektryczny', 'Hybryda'] as $fuel)
                <option
                    value="{{ $fuel }}"
                    @selected(old('fuel_type', $vehicle->fuel_type) === $fuel)
                >
                    {{ $fuel }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>
            @foreach(['Aktywny', 'Serwis', 'Wycofany'] as $status)
                <option
                    value="{{ $status }}"
                    @selected(old('status', $vehicle->status) === $status)
                >
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">
        Zapisz zmiany
    </button>

    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
        Anuluj
    </a>

</form>

@endsection