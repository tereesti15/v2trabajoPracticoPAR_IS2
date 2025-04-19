<?php
/*
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;

Route::middleware('api')->group(function () {
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::post('/productos', [ProductoController::class, 'store']);
});
*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonasController;

Route::get('/personas', [PersonasController::class, 'index']);
Route::post('/personas', [PersonasController::class, 'store']);

