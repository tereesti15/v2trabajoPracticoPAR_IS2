<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class NominaAdicionalFijo extends Model
{
    use HasFactory;

    protected $table = 'nomina_adicional_fijo';

    protected $fillable = [
        'id_concepto',
        'id_nomina',
        'detalle_concepto',
        'importe',
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