<div class="container py-4">
    @if ($showForm)
        @livewire('empleados.form', ['empleadoId' => $empleadoIdToEdit], key($empleadoIdToEdit))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @elseif ($showSalary)
        @livewire('salario.nomina-empleado', ['empleadoId' => $empleadoIdForSalary], key('salario-'.$empleadoIdForSalary))
        <button class="btn btn-secondary mt-3" wire:click="closeSalaryView">Volver</button>
    @else
        <button class="btn btn-primary mb-3" wire:click="create">Agregar Empleado</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nombre_persona }}</td>
                        <td>{{ number_format($empleado->salario_base, 0, ',', '.') }}</td>
                        <td>{{ $empleado->nombre_departamento }}</td>
                        <td>{{ $empleado->nombre_cargo }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" wire:click="editSalaryParameter({{ $empleado->id_empleado }})">Salario</button>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $empleado->id_empleado }})">Editar</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $empleado->id_empleado }})">Eliminar</button>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
