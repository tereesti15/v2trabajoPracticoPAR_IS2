<div class="container py-4">
    @if ($showForm)
        @livewire('personas.form', ['personaId' => $personaIdToEdit], key($personaIdToEdit))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @elseif ($showFormHijos)
        @livewire('personas.index-hijos', ['personaId' => $personaIdToEdit], key($personaIdToEdit))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @else
        <button class="btn btn-primary mb-3" wire:click="create">Agregar Persona</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Documento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $persona->apellido }}</td>
                        <td>{{ $persona->documento }}</td>
                        <td>{{ $persona->direccion }}</td>
                        <td>{{ $persona->telefono }}</td>
                        <td>{{ $persona->email }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" wire:click="abrirHijos({{ $persona->id }})">Hijos</button>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $persona->id }})">Editar</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $persona->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
