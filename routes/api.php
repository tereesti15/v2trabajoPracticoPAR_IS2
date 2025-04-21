<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PersonasController as PersonasControllerV1;
use App\Http\Controllers\API\v1\DepartamentoController as DepartamentoControllerV1;

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

/* Queda como ejemplo para v2

use App\Http\Controllers\API\V1\UserController as UserControllerV1;
use App\Http\Controllers\API\V2\UserController as UserControllerV2;

Route::prefix('v1')->group(function () {
    Route::get('/users', [UserControllerV1::class, 'index']);
});

Route::prefix('v2')->group(function () {
    Route::get('/users', [UserControllerV2::class, 'index']);
}); */
