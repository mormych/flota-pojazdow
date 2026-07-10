<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FuelLogController;

Route::get('/', function () {
    return redirect()->route('vehicles.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/vehicles', [VehicleController::class, 'index'])
        ->name('vehicles.index');

    Route::get('/vehicles/{vehicle}/services', [ServiceController::class, 'index'])
    ->name('vehicles.services.index');

    Route::get('/vehicles/{vehicle}/fuel-logs', [FuelLogController::class, 'index'])
    ->name('vehicles.fuel-logs.index');


    Route::middleware(['admin'])->group(function () {

        Route::get('/vehicles/create', [VehicleController::class, 'create'])
            ->name('vehicles.create');

        Route::post('/vehicles', [VehicleController::class, 'store'])
            ->name('vehicles.store');

        Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])
            ->name('vehicles.edit');

        Route::put('/vehicles/{id}', [VehicleController::class, 'update'])
            ->name('vehicles.update');

        Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])
            ->name('vehicles.destroy');

        Route::get('/vehicles/{vehicle}/services/create', [ServiceController::class, 'create'])
            ->name('vehicles.services.create');

        Route::post('/vehicles/{vehicle}/services', [ServiceController::class, 'store'])
            ->name('vehicles.services.store');

        Route::delete('/vehicles/{vehicle}/services/{service}', [ServiceController::class, 'destroy'])
            ->name('vehicles.services.destroy');

        Route::get('/vehicles/{vehicle}/fuel-logs/create', [FuelLogController::class, 'create'])
            ->name('vehicles.fuel-logs.create');

        Route::post('/vehicles/{vehicle}/fuel-logs', [FuelLogController::class, 'store'])
            ->name('vehicles.fuel-logs.store');

        Route::delete('/vehicles/{vehicle}/fuel-logs/{fuelLog}', [FuelLogController::class, 'destroy'])
            ->name('vehicles.fuel-logs.destroy');

    });

});

require __DIR__.'/auth.php';
