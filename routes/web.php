<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Api\v1\HijoController;
use App\Http\Controllers\ReporteController;
use App\Http\Livewire\EmpleadoEdit;
use App\Livewire\Personas\Index;
use App\Livewire\Empleados\Index as EmpleadosIndex;
use App\Livewire\Config\SalarioConceptoIndex;
use App\Livewire\Salario\ProcesarIndex;
use App\Livewire\Reporte\PlanillaIndex;
use App\Livewire\Config\Parametro;
use App\Livewire\Reporte\ListaPlanillaIndex;

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
    //Route::resource('empleados', EmpleadoController::class);
    //Route::view('/empleados/create', 'empleados.create')->name('empleados.create');

    Route::get('/personas', Index::class)->name('personas.index');
    Route::get('/empleados', EmpleadosIndex::class)->name('empleados.index');
    Route::get('/config', SalarioConceptoIndex::class)->name('config.salario-concepto-index');
    Route::get('/parametro', Parametro::class)->name('config.parametro');
    Route::get('/salario', ProcesarIndex::class)->name('salario.index');
    Route::get('/reporte', PlanillaIndex::class)->name('reporte.planilla-index');
    Route::get('/reporte', ListaPlanillaIndex::class)->name('reporte.lista-planilla-index');
    
    //Route::resource('hijos', HijoController::class);

    // Reportes
   // Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

    // Livewire: editar empleado
    //Route::get('/empleados/{id}/edit', EmpleadoEdit::class)->name('empleados.edit');
    //Route::view('/empleados/{id}/edit', 'empleados.edit')->middleware('auth')->name('empleados.edit');


    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación (Laravel Breeze)
require __DIR__.'/auth.php';