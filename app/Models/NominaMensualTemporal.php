<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class NominaMensualTemporal extends Model
{
    // Se utiliza para registrar los conceptos que
    // pueden ser temporales o varian todos los meses

    use HasFactory;

    protected $table = 'nomina_mensual_temporal';
    //protected $primaryKey = 'id';

    protected $fillable = [
        'id_concepto',
        'id_empleado',
        'detalle_concepto',
        'mes_proceso',
        'anho_proceso',
        'procesado',
        'monto_concepto',
    ];

    public function concepto()
    {
        return $this->belongsTo(ConceptoSalario::class, 'id_concepto');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}
