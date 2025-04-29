<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Nomina",
 *     required={"periodo", "fecha_proceso_liquidacion", "estado_nomina"},
 *     @OA\Property(property="periodo", type="string", format="date", example="2025-04-01"),
 *     @OA\Property(property="fecha_proceso_liquidacion", type="string", format="date", example="2025-04-20"),
 *     @OA\Property(property="estado_nomina", type="string", enum={"Modificable", "Confirmada"}, example="Modificable")
 * )
 */

final class Nomina extends Model
{
    use HasFactory;

    protected $table = 'nomina';
    protected $primaryKey = 'id_nomina';

    protected $fillable = [
        'id_nomina',
        'periodo',
        'fecha_proceso_liquidacion',
        'id_empleado',
        'id_concepto',
        'detalle_concepto',
        'monto_concepto'
    ];

    protected $dates = [
        'periodo',
        'fecha_proceso_liquidacion',
    ];
}
