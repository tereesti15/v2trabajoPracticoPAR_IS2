<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Parametrica extends Model
{
    protected $table = 'parametros';  // Nombre explícito de la tabla
    protected $fillable = ['salario_minimo'];  // Los campos que se pueden llenar
}
