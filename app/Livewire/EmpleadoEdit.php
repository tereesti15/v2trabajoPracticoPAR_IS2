<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

final class EmpleadoEdit extends Component
{
    public $empleadoId;
    public $nombre;
    public $email;

    public function mount($id)
    {
        $this->empleadoId = $id;

        $response = Http::get(url("/api/v1/empleados/{$id}"));

        if ($response->successful()) {
            $data = $response->json();
            $this->nombre = $data['nombre'] ?? '';
            $this->email = $data['email'] ?? '';
        } else {
            session()->flash('error', 'No se pudo cargar el empleado.');
            return redirect()->to('/dashboard');
        }
    }

    public function actualizar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $response = Http::put(url("/api/v1/empleados/{$this->empleadoId}"), [
            'nombre' => $this->nombre,
            'email' => $this->email,
        ]);

        if ($response->successful()) {
            session()->flash('message', 'Empleado actualizado correctamente.');
            return redirect()->to('/dashboard');
        } else {
            session()->flash('error', 'Error al actualizar el empleado.');
        }
    }

    public function render()
    {
        return view('livewire.empleado-edit');
    }
}
