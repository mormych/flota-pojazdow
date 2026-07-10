@extends('layouts.app')

@section('content')

<h1 class="mb-4">
    Dodaj wpis serwisowy
</h1>

<p>
    Pojazd:
    <strong>
        {{ $vehicle->brand }}
        {{ $vehicle->model }}
        — {{ $vehicle->registration_number }}
    </strong>
</p>

<form action="{{ route('vehicles.services.store', $vehicle) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Data serwisu</label>

        <input
            type="date"
            name="service_date"
            class="form-control"
            value="{{ old('service_date') }}"
            required
        >

        @error('service_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Typ</label>

        <select name="type" class="form-select" required>
            <option value="">Wybierz typ</option>
            <option value="Przegląd">Przegląd</option>
            <option value="Naprawa">Naprawa</option>
            <option value="Wymiana oleju">Wymiana oleju</option>
            <option value="Wymiana opon">Wymiana opon</option>
            <option value="Inne">Inne</option>
        </select>

        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Opis</label>

        <textarea
            name="description"
            class="form-control"
            rows="4"
            required
        >{{ old('description') }}</textarea>

        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Koszt</label>

        <input
            type="number"
            name="cost"
            class="form-control"
            step="0.01"
            min="0"
            value="{{ old('cost') }}"
            required
        >

        @error('cost')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Przebieg</label>

        <input
            type="number"
            name="mileage"
            class="form-control"
            min="0"
            value="{{ old('mileage', $vehicle->mileage) }}"
            required
        >

        @error('mileage')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success">
        Zapisz wpis
    </button>

    <a href="{{ route('vehicles.services.index', $vehicle) }}"
       class="btn btn-secondary">
        Anuluj
    </a>
</form>

@endsection