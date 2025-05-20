<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class NominaPorcentajeSalarioBase extends Model
{
    use HasFactory;

    protected $table = 'nomina_porcentaje_salario_base';

    protected $fillable = [
        'id_concepto',
        'id_nomina',
        'detalle_concepto',
        'porcentaje',
    ];

    // Relación con ConceptoSalario
    public function concepto()
    {
        return $this->belongsTo(ConceptoSalario::class, 'id_concepto', 'id_concepto');
    }

    // Relación con Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_nomina', 'id_empleado');
    }

}
