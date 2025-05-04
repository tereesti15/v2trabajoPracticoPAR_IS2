<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @OA\Schema(
 *     schema="NominaDetalleCuota",
 *     title="NominaDetalleCuota",
 *     description="Detalle de cuotas asociadas a conceptos de nómina",
 *     type="object",
 *     required={
 *         "id_concepto",
 *         "id_nomina",
 *         "detalle_concepto",
 *         "cant_cuota",
 *         "monto_concepto",
 *         "tipo"
 *     },
 *     @OA\Property(property="id", type="integer", readOnly=true, example=1),
 *     @OA\Property(property="id_concepto", type="integer", example=5),
 *     @OA\Property(property="id_nomina", type="integer", example=12),
 *     @OA\Property(property="detalle_concepto", type="string", example="Préstamo personal"),
 *     @OA\Property(property="cant_cuota", type="integer", example=12, description="Cantidad total de cuotas"),
 *     @OA\Property(property="nro_cuota", type="integer", example=3, description="Número actual de cuota"),
 *     @OA\Property(property="monto_concepto", type="integer", example=50000),
 *     @OA\Property(
 *         property="tipo",
 *         type="string",
 *         enum={"ACREDITACION", "DESCUENTO"},
 *         example="DESCUENTO"
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
 * )
 */

final class NominaDetalleCuota extends Model
{
    use HasFactory;

    protected $table = 'nomina_detalle_cuotas';

    protected $fillable = [
        'id_concepto',
        'id_nomina',
        'detalle_concepto',
        'cant_cuota',
        'nro_cuota',
        'monto_concepto',
        'tipo',
    ];

    public function concepto()
    {
        return $this->belongsTo(ConceptoSalario::class, 'id_concepto');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_nomina');
    }

    protected function conceptoCuotaDescripcion(): Attribute
    {
        return Attribute::get(function () {
            $detalle = $this->detalle_concepto;
            $nro = $this->nro_cuota;
            $total = $this->cant_cuota;

            if (in_array($total, [0, 1, 999])) {
                return $detalle;
            }

            return "{$detalle} ({$nro}/{$total})";
        });
    }

    protected function importeConcepto(): Attribute
    {
        return Attribute::get(function () {
            return $this->concepto?->codigo_concepto;
        });
    }

    protected function codigoConcepto(): Attribute
    {
        return Attribute::get(function () {
            return $this->concepto?->monto_concepto;
        });
    }

    public function avanzarCuota(): void
    {
        if ($this->cant_cuota > 1 && $this->nro_cuota < $this->cant_cuota) {
            $this->nro_cuota++;
            $this->save();
        }
    }

    public function retrocederCuota(): void
    {
        if ($this->nro_cuota > 1) {
            $this->nro_cuota--;
            $this->save();
        }
    }
}
