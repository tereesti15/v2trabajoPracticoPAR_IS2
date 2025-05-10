<?php

namespace App\Services;

use App\Models\Empleados;
use Illuminate\Support\Facades\DB;
use Exception;

final class EmpleadoService
{

    public function index(): \Illuminate\Support\Collection
    {
        /*
        return Empleados::with(['persona']) // si tienes relación con Persona
            ->orderBy('id_empleado', 'desc')
            ->get();
        */
        return Empleados::orderBy('id_empleado', 'desc')->get();
    }

    public function show(int $id): Empleados
    {
        $empleado = Empleados::find($id);

        if (!$empleado) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Empleado no encontrado");
        }

        return $empleado;
    }

    public function store(array $data): Empleados
    {
        // Verificar si la persona ya está registrada como empleado
        if (Empleados::where('id_persona', $data['id_persona'])->exists()) {
            throw new Exception('Esta persona ya tiene un registro de empleado.');
        }

        // Crear el empleado dentro de una transacción por seguridad
        return DB::transaction(function () use ($data) {
            return Empleados::create($data);
        });
    }

    public function delete(int $id_empleado): void
    {
        $empleado = Empleados::findOrFail($id_empleado);
        $empleado->delete();
    }

    public function update(int $id_empleado, array $data): Empleados
    {
        $empleado = Empleados::findOrFail($id_empleado);

        if (isset($data['id_persona']) && $data['id_persona'] != $empleado->id_persona) {
            throw new Exception('No está permitido modificar el id_persona de un empleado.');
        }

        unset($data['id_persona']);

        $empleado->update($data);

        return $empleado;
    }
}
