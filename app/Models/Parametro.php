<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametros';
    protected $primaryKey = 'id_parametro';

    protected $fillable = ['salario_minimo'];

    // Hacemos que este atributo virtual se incluya en el JSON automáticamente
    protected $appends = ['ultimo_salario_minimo'];

    // Accessor virtual: retorna el salario mínimo del último registro
    public function getUltimoSalarioMinimoAttribute(): ?int
    {
        $ultimo = self::latest('created_at')->first();
        return $ultimo?->salario_minimo;
    }
}
