<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Parametro;

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

    public static function conceptosDisponiblesParaSelect(): \Illuminate\Support\Collection
    {
        $parametros = Parametro::first();

        if (!$parametros) {
            return collect(); // Devuelve colección vacía si no hay registro de parámetros
        }

        $excluirIds = [
            $parametros->id_salario_base,
            $parametros->id_bonificacion_familiar,
            $parametros->id_ips,
        ];

        // Retornar colección de conceptos excluyendo los IDs
        return self::whereNotIn('id_concepto', $excluirIds)->get();
    }

}
