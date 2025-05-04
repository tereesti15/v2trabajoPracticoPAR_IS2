<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

final class EmpleadoCreate extends Component
{
    public $nombre;
    public $email;

    public function guardar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $response = Http::post(url('/api/v1/empleados'), [
            'nombre' => $this->nombre,
            'email' => $this->email,
        ]);

        if ($response->successful()) {
            session()->flash('message', 'Empleado creado exitosamente.');
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Error al crear el empleado.');
        }
    }

    public function render()
    {
        return view('livewire.empleado-create');
    }
}
