<?php

namespace App\Services;

use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Exception;

class EmpleadoService
{
    public function crearEmpleado(array $data): Empleado
    {
        // Verificar si la persona ya está registrada como empleado
        if (Empleado::where('id_persona', $data['id_persona'])->exists()) {
            throw new Exception('Esta persona ya tiene un registro de empleado.');
        }

        // Crear el empleado dentro de una transacción por seguridad
        return DB::transaction(function () use ($data) {
            return Empleado::create($data);
        });
    }

    public function borrarEmpleado(int $id_empleado): void
    {
        $empleado = Empleado::findOrFail($id_empleado);
        $empleado->delete();
    }

    public function actualizarEmpleado(int $id_empleado, array $data): Empleado
    {
        $empleado = Empleado::findOrFail($id_empleado);

        if (isset($data['id_persona']) && $data['id_persona'] != $empleado->id_persona) {
            throw new Exception('No está permitido modificar el id_persona de un empleado.');
        }

        unset($data['id_persona']);

        $empleado->update($data);

        return $empleado;
    }
}
