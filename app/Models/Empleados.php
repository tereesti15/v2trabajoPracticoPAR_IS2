<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Empleado",
 *     title="Empleado",
 *     description="Modelo del empleado",
 *     type="object",
 *     required={"id_persona", "id_cargo", "id_departamento", "fecha_ingreso", "salario_base", "estado_empleado"},
 *     @OA\Property(property="id_empleados", type="integer", readOnly=true),
 *     @OA\Property(property="id_persona", type="integer", example=1),
 *     @OA\Property(property="id_cargo", type="integer", example=2),
 *     @OA\Property(property="id_departamento", type="integer", example=3),
 *     @OA\Property(property="fecha_ingreso", type="string", format="date", example="2023-05-10"),
 *     @OA\Property(property="salario_base", type="number", format="float", example=2500.75),
 *     @OA\Property(property="estado_empleado", type="string", example="Activo"),
 *     @OA\Property(property="fecha_egreso", type="string", format="date", nullable=true, example="2024-12-31")
 * )
 */


class Empleados extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'id_persona',
        'id_cargo',
        'id_departamento',
        'fecha_ingreso',
        'salario_base',
        'estado_empleado',
        'fecha_egreso',
    ];
}

