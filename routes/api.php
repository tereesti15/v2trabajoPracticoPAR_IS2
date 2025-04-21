<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonasController;
use App\Http\Controllers\API\DepartamentoController;

Route::get('/personas', [PersonasController::class, 'index']); //listar
Route::post('/personas', [PersonasController::class, 'store']); // agregar

// routes/api.php


Route::get('/departamentos', [DepartamentoController::class, 'index']); // listar
Route::post('/departamentos', [DepartamentoController::class, 'store']); // agregar
Route::delete('/departamentos/{id}', [DepartamentoController::class, 'destroy']); // Borrar
Route::put('/departamentos/{id}', [DepartamentoController::class, 'update']); //actualizar
