<ul class="list-group list-group-flush">
    @if ($user->hasRole(['administrador', 'gerente', 'encargado rrhh']))
        <li class="list-group-item">
            Empleados
            <ul class="ps-3">
                <li wire:click="$emit('navigate', 'empleados')">CRUD Empleados</li>
                <li wire:click="$emit('navigate', 'personas')">CRUD Personas</li>
                <li wire:click="$emit('navigate', 'hijos')">CRUD Hijos</li>
            </ul>
        </li>

        <li class="list-group-item">
            Salario
            <ul class="ps-3">
                <li wire:click="$emit('navigate', 'conceptos')">Conceptos de Salario</li>
                <li wire:click="$emit('navigate', 'generar-planilla')">Generar Planilla</li>
                @if ($user->hasRole(['administrador', 'gerente']))
                    <li wire:click="$emit('navigate', 'confirmar-planilla')">Confirmar Planilla</li>
                @endif
            </ul>
        </li>
    @endif

    @if ($user->hasRole('administrador'))
        <li class="list-group-item">
            Administrador
            <ul class="ps-3">
                <li wire:click="$emit('navigate', 'usuarios')">Gestión de Usuarios</li>
                <li wire:click="$emit('navigate', 'auditorias')">Auditorías</li>
            </ul>
        </li>
    @endif
</ul>

