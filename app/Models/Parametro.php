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
    ];

    protected $appends = [];

    /*
    public function getSalarioMinimoAttribute(): ?int
    {
        // Recuperar el primer registro de la tabla
        $parametro = self::first();
        \Log::info('DATOS DE PARAMETRO EN getSalarioMinimoAttribute ' . $parametro->salario_minimo);
        // Verificar si el registro existe y retornar el valor
        return $parametro ? $parametro->salario_minimo : null;
    }
    
    public function getBonificacionFamiliarMaxSalarioMinimoAttribute(): ?int
    {
        // Recuperar el primer registro de la tabla
        $parametro = self::first();
        \Log::info('DATOS DE PARAMETRO EN getBonificacionFamiliarMaxSalarioMinimoAttribute ' . $parametro->bonificacion_familiar_max_salario_minimo);
        return $parametro ? $parametro->bonificacion_familiar_max_salario_minimo : null;
    }
    
    public function getBonificacionFamiliarPorcentajeAttribute(): ?float
    {
        // Recuperar el primer registro de la tabla
        $parametro = self::first();
        \Log::info('DATOS DE PARAMETRO EN getBonificacionFamiliarPorcentajeAttribute ' . $parametro->bonificacion_familiar_porcentaje);
        return $parametro ? $parametro->bonificacion_familiar_porcentaje : null;
    }
        /*/
    public function getSalarioMinimoAttribute(): ?int
    {
        // En lugar de hacer la consulta a la base de datos, devolvemos un valor fijo
        return 2_000_000; // Valor de prueba (valor en duro)
    }

    public function getBonificacionFamiliarMaxSalarioMinimoAttribute(): ?int
    {
        // Devolvemos un valor fijo para el máximo salario mínimo
        return 2; // Valor de prueba
    }

    public function getBonificacionFamiliarPorcentajeAttribute(): ?float
    {
        // Devolvemos un valor fijo para el porcentaje
        return 0.05; // Valor de prueba
    }
}
