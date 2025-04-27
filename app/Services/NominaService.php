<?php

namespace App\Services;

use App\Models\Personas;
use App\Models\Empleados;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

final class NominaService
{
    /**
     * Obtener los hijos menores de 18 años por persona
     */
    public function obtenerHijosPorPersona(int $idPersona): ?Collection
    {
        $persona = Personas::find($idPersona);

        if (!$persona) {
            return null; // Persona no encontrada
        }

        // Filtramos los hijos menores de 18 años
        return $persona->hijos->filter(function ($hijo) {
            $fechaNacimiento = Carbon::parse($hijo->fecha_nacimiento);
            return $fechaNacimiento->age < 18; // Filtra a los menores de 18 años
        });
    }

    public function procesarPlanilla(int $mes, int$anho) {
        $allEmployees = Empleados::all();
        foreach ($allEmployees as $empleado) {
            // Aquí puedes acceder a las propiedades del modelo $empleado
            //echo $empleado->nombre;  // Suponiendo que 'nombre' es un campo de tu tabla de empleados
            //echo $empleado->apellido;  // Suponiendo que 'apellido' es otro campo
            $this->calculoSalarioBase($empleado);
        }
    }

    private function calculoSalarioBase(Empleados $data) {
        $datoSalario = $data->getSalarioBase();
    }

    private function calculoBonificacionFamiliar(Empleados $data) {
        $datoHijos = obtenerHijosPorPersona(data->id);
    } 
}
