<div class="container py-4">
    @if ($showForm)
        @livewire('personas.form-hijo', ['hijoId' => $hijoIdActualizar, 'personaId' => $personaId], key($hijoIdActualizar))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @else
        <button class="btn btn-primary mb-3" wire:click="create">Agregar Hijo</button>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>Documento</th>
                    <th>Discapacitado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listaHijos as $hijo)
                    <tr>
                        <td>{{ $hijo->nombre }}</td>
                        {{-- Formatea la fecha de nacimiento al formato dd/mm/yyyy --}}
                        <td>{{ \Carbon\Carbon::parse($hijo->fecha_nacimiento)->format('d/m/Y') }}</td>
                        <td>{{ $hijo->documento }}</td>
                        <td>{{ $hijo->discapacitado }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $hijo->id }})">Editar</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $hijo->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    Livewire.on('personaUpdated', () => {
        setTimeout(() => {
            const tabla = document.querySelector('table');
            if (tabla) {
                tabla.scrollIntoView({ behavior: 'smooth' });
            }
        }, 300); // Esperamos un poco para que se renderice
    });
</script>

