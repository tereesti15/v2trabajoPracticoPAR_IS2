<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class NominaPorcentualMinimo extends Model
{
    use HasFactory;

    protected $table = 'nomina_porcentual_minimo';

    protected $fillable = [
        'id_concepto',
        'id_nomina',
        'detalle_concepto',
        'porcentaje',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'id_nomina', 'id_empleado');
    }

    public function concepto()
    {
        return $this->belongsTo(ConceptoSalario::class, 'id_concepto', 'id_concepto');
    }
}