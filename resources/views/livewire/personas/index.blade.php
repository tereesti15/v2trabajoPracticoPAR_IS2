<div class="container py-4">
    <h2 class="mb-4">Personas</h2>

    @if ($showForm)
        @livewire('personas.form', ['personaId' => $personaIdToEdit], key($personaIdToEdit))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @else
        <button class="btn btn-primary mb-3" wire:click="create">Agregar Persona</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>CI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $persona->apellido }}</td>
                        <td>{{ $persona->ci }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $persona->id }})">Editar</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $persona->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
