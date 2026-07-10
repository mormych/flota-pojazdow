@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Historia serwisowa</h1>

        <p class="mb-0">
            {{ $vehicle->brand }}
            {{ $vehicle->model }}
            — {{ $vehicle->registration_number }}
        </p>
    </div>

    <div>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
            Powrót
        </a>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('vehicles.services.create', $vehicle) }}"
               class="btn btn-primary">
                + Dodaj wpis
            </a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Data</th>
            <th>Typ</th>
            <th>Opis</th>
            <th>Koszt</th>
            <th>Przebieg</th>

            @if(auth()->user()->isAdmin())
                <th>Akcja</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @forelse($services as $service)
            <tr>
                <td>{{ $service->service_date->format('d.m.Y') }}</td>
                <td>{{ $service->type }}</td>
                <td>{{ $service->description }}</td>
                <td>{{ number_format($service->cost, 2, ',', ' ') }} zł</td>
                <td>{{ $service->mileage }} km</td>

                @if(auth()->user()->isAdmin())
                    <td>
                        <form
                            action="{{ route('vehicles.services.destroy', [$vehicle, $service]) }}"
                            method="POST"
                            onsubmit="return confirm('Czy na pewno usunąć ten wpis?')"
                        >
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
                <td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}"
                    class="text-center">
                    Brak wpisów serwisowych.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection