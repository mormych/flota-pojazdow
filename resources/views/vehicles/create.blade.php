@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Dodaj pojazd</h4>
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Popraw poniższe błędy:</strong>

                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="brand" class="form-label">Marka</label>

                        <input
                            type="text"
                            id="brand"
                            name="brand"
                            class="form-control"
                            value="{{ old('brand') }}"
                            placeholder="Np. Toyota"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>

                        <input
                            type="text"
                            id="model"
                            name="model"
                            class="form-control"
                            value="{{ old('model') }}"
                            placeholder="Np. Corolla"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Rok produkcji</label>

                        <input
                            type="number"
                            id="year"
                            name="year"
                            class="form-control"
                            value="{{ old('year') }}"
                            min="1900"
                            max="{{ date('Y') }}"
                            placeholder="Np. 2021"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="registration_number" class="form-label">
                            Numer rejestracyjny
                        </label>

                        <input
                            type="text"
                            id="registration_number"
                            name="registration_number"
                            class="form-control"
                            value="{{ old('registration_number') }}"
                            placeholder="Np. SWD12345"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="vin" class="form-label">VIN</label>

                        <input
                            type="text"
                            id="vin"
                            name="vin"
                            class="form-control"
                            value="{{ old('vin') }}"
                            minlength="17"
                            maxlength="17"
                            placeholder="17 znaków"
                            required
                        >

                        <div class="form-text">
                            Numer VIN musi mieć dokładnie 17 znaków.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mileage" class="form-label">Przebieg</label>

                        <div class="input-group">
                            <input
                                type="number"
                                id="mileage"
                                name="mileage"
                                class="form-control"
                                value="{{ old('mileage') }}"
                                min="0"
                                placeholder="Np. 120000"
                                required
                            >

                            <span class="input-group-text">km</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fuel_type" class="form-label">
                            Rodzaj paliwa
                        </label>

                        <select
                            id="fuel_type"
                            name="fuel_type"
                            class="form-select"
                            required
                        >
                            <option value="Benzyna"
                                @selected(old('fuel_type') === 'Benzyna')>
                                Benzyna
                            </option>

                            <option value="Diesel"
                                @selected(old('fuel_type') === 'Diesel')>
                                Diesel
                            </option>

                            <option value="Hybryda"
                                @selected(old('fuel_type') === 'Hybryda')>
                                Hybryda
                            </option>

                            <option value="Elektryczny"
                                @selected(old('fuel_type') === 'Elektryczny')>
                                Elektryczny
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status</label>

                        <select
                            id="status"
                            name="status"
                            class="form-select"
                            required
                        >
                            <option value="Aktywny"
                                @selected(old('status') === 'Aktywny')>
                                Aktywny
                            </option>

                            <option value="Serwis"
                                @selected(old('status') === 'Serwis')>
                                Serwis
                            </option>

                            <option value="Wycofany"
                                @selected(old('status') === 'Wycofany')>
                                Wycofany
                            </option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            Zapisz pojazd
                        </button>

                        <a href="{{ route('vehicles.index') }}"
                           class="btn btn-secondary">
                            Anuluj
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection