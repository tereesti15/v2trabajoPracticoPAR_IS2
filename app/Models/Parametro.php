<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

final class Parametro extends Model
{
    protected $table = 'parametros';
    protected $primaryKey = 'id_parametro';

    protected $fillable = [
        'salario_minimo', 
        'bonificacion_familiar_max_salario_minimo', 
        'bonificacion_familiar_porcentaje',
        'nombre_empresa',
        'ruc',
        'id_salario_base',
        'id_bonificacion_familiar',
        'id_ips',
    ];

    protected $appends = [];
}
