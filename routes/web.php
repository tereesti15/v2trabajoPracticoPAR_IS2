<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\PersonasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vista/departamentos', function () {
    return view('departamentos.api-index');
});
