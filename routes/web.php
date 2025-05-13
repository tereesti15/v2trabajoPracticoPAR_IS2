<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\HijoController;
use App\Http\Controllers\ReporteController;
use App\Http\Livewire\EmpleadoEdit;

//TEMPORAL
/*
Route::get('/test-persona', function () {
    return view('test-persona');
});
*/

// Redirigir raíz al login o dashboard
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Grupo con autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // CRUD clásicos (puedes combinar con Livewire si no hay conflicto de rutas)
    Route::resource('empleados', EmpleadoController::class);
    Route::view('/empleados/create', 'empleados.create')->name('empleados.create');

    Route::resource('personas', PersonaController::class);
    Route::resource('hijos', HijoController::class);

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

    // Livewire: editar empleado
    //Route::get('/empleados/{id}/edit', EmpleadoEdit::class)->name('empleados.edit');
    Route::view('/empleados/{id}/edit', 'empleados.edit')->middleware('auth')->name('empleados.edit');


    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación (Laravel Breeze)
require __DIR__.'/auth.php';
