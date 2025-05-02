<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametros';
    protected $primaryKey = 'id_parametro';

    protected $fillable = ['salario_minimo', 
    'bonificacion_familiar_max_salario_minimo', 'bonificacion_familiar_porcentaje',];

    // Hacemos que este atributo virtual se incluya en el JSON automáticamente
    //protected $appends = ['salario_minimo',
    //'bonificacion_familiar_max_salario_minimo', 'bonificacion_familiar_porcentaje',];

    protected $appends = [];
    // Accessor virtual: retorna el salario mínimo del último registro
    public function getSalarioMinimoAttribute(): ?int
    {
        $ultimo = self::latest('created_at')->first();
        return $ultimo?->salario_minimo;
    }

    public function getBonificacionFamiliarMaxSalarioMinimoAttribute(): ?int
    {
        $ultimo = self::latest('created_at')->first();
        return $ultimo?->bonificacion_familiar_max_salario_minimo;
    }

    public function getBonificacionFamiliarPorcentajeAttribute(): ?float
    {
        $ultimo = self::latest('created_at')->first();
        return $ultimo?->bonificacion_familiar_porcentaje;
    }
}
