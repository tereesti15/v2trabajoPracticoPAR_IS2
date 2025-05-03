<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
