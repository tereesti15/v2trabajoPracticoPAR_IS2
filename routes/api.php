<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PersonasController as PersonasControllerV1;
use App\Http\Controllers\API\v1\DepartamentoController as DepartamentoControllerV1;
use App\Http\Controllers\Api\v1\HijoController as HijoControlerV1;
use App\Http\Controllers\Api\v1\CargoController as CargoControllerV1;
use App\Http\Controllers\Api\v1\EmpleadoController as EmpleadoControllerV1;
use App\Http\Controllers\Api\v1\NominaController as NominaControllerV1;
use App\Http\Controllers\Api\v1\ConceptoSalarioController as ConceptoSalarioControllerV1;

Route::prefix('v1')->group(function () {
    Route::get('/conceptos-salario', [ConceptoSalarioControllerV1::class, 'index']); //listar
    Route::post('/conceptos-salario', [ConceptoSalarioControllerV1::class, 'store']); // agregar
    Route::get('/conceptos-salario/{id}', [ConceptoSalarioControllerV1::class, 'show']); // listar
    Route::delete('/conceptos-salario/{id}', [ConceptoSalarioControllerV1::class, 'destroy']); // Borrar
    Route::put('/conceptos-salario/{id}', [ConceptoSalarioControllerV1::class, 'update']); //actualizar
});

Route::prefix('v1')->group(function () {
    Route::get('/nomina', [NominaControllerV1::class, 'index']); //listar
    Route::post('/nomina', [NominaControllerV1::class, 'store']); // agregar
    Route::get('/nomina/{id}', [NominaControllerV1::class, 'show']); // listar
    Route::delete('/nomina/{id}', [NominaControllerV1::class, 'destroy']); // Borrar
    Route::put('/nomina/{id}', [NominaControllerV1::class, 'update']); //actualizar
});

Route::prefix('v1')->group(function () {
    Route::get('/empleados', [EmpleadoControllerV1::class, 'index']); //listar
    Route::post('/empleados', [EmpleadoControllerV1::class, 'store']); // agregar
    Route::get('/empleados/{id}', [EmpleadoControllerV1::class, 'show']); // listar
    Route::delete('/empleados/{id}', [EmpleadoControllerV1::class, 'destroy']); // Borrar
    Route::put('/empleados/{id}', [EmpleadoControllerV1::class, 'update']); //actualizar
});

Route::prefix('v1')->group(function () {
    Route::get('/personas', [PersonasControllerV1::class, 'index']); //listar
    Route::post('/personas', [PersonasControllerV1::class, 'store']); // agregar
    Route::delete('/personas/{id}', [PersonasControllerV1::class, 'destroy']); // Borrar
    Route::put('/personas/{id}', [PersonasControllerV1::class, 'update']); //actualizar
});

Route::prefix('v1')->group(function () {
    Route::get('/departamentos', [DepartamentoControllerV1::class, 'index']); // listar
    Route::post('/departamentos', [DepartamentoControllerV1::class, 'store']); // agregar
    Route::delete('/departamentos/{id}', [DepartamentoControllerV1::class, 'destroy']); // Borrar
    Route::put('/departamentos/{id}', [DepartamentoControllerV1::class, 'update']); //actualizar
});

Route::prefix('v1')->group(function () {
    Route::get('/hijos', [HijoControlerV1::class, 'index']); // listar
    Route::post('/hijos', [HijoControlerV1::class, 'store']); // agregar
    Route::delete('/hijos/{id}', [HijoControlerV1::class, 'destroy']); // Borrar
    Route::put('/hijos/{id}', [HijoControlerV1::class, 'update']); //actualizar
});

Route::prefix('v1')->group(function () {
    Route::get('/cargos', [CargoControllerV1::class, 'index']); // listar
    Route::get('/cargos/{id}', [CargoControllerV1::class, 'show']); // listar
    Route::post('/cargos', [CargoControllerV1::class, 'store']); // agregar
    Route::delete('/cargos/{id}', [CargoControllerV1::class, 'destroy']); // Borrar
    Route::put('/cargos/{id}', [CargoControllerV1::class, 'update']); //actualizar
});


/* Queda como ejemplo para v2

use App\Http\Controllers\API\V1\UserController as UserControllerV1;
use App\Http\Controllers\API\V2\UserController as UserControllerV2;

Route::prefix('v1')->group(function () {
    Route::get('/users', [UserControllerV1::class, 'index']);
});

Route::prefix('v2')->group(function () {
    Route::get('/users', [UserControllerV2::class, 'index']);
}); */
