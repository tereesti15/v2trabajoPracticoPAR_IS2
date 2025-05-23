<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     schema="DetalleNomina",
 *     title="DetalleNomina",
 *     description="Modelo del detalle de nomina",
 *     type="object",
 *     required={"id_nomina", "id_empleado", "id_concepto", "detalle_concepto", "monto_concepto"},
 *     @OA\Property(property="id_detalle_nomina", type="integer", readOnly=true),
 *     @OA\Property(property="id_nomina", type="integer", example=1),
 *     @OA\Property(property="id_empleado", type="integer", example=1),
 *     @OA\Property(property="id_concepto", type="integer", example=1),
 *     @OA\Property(property="detalle_concepto", type="integer", example=1),
 *     @OA\Property(property="monto_concepto", type="number", format="float", example=2500.75)
 * )
 */

final class DetalleNomina extends Model
{
    use HasFactory;

    protected $table = 'detalle_nomina'; // si tu tabla no es el plural estándar

    protected $primaryKey = 'id_detalle_nomina'; // porque no usas 'id' normal

    public $timestamps = false; // si tu tabla NO tiene created_at y updated_at

    protected $fillable = [
        'id_nomina',
        'id_empleado',
        'id_concepto',
        'detalle_concepto',
        'monto_concepto'
    ];

    public function concepto()
    {
        return $this->belongsTo(ConceptoSalario::class, 'id_concepto');
    }

}