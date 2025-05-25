<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class ConceptoSalario extends Model
{
    use HasFactory;

    protected $table = 'concepto_salario';
    protected $primaryKey = 'id_concepto';

    protected $fillable = [
        'nombre_concepto',
        'tipo',
        'agrupador',
        'nro_orden',
    ];
}
