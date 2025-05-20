<div>
    @switch($currentView)
        @case('empleados')
            @livewire('crud-empleados') @break
        @case('personas')
            @livewire('crud-personas') @break
        @case('hijos')
            @livewire('crud-hijos') @break
        @case('conceptos')
            @livewire('crud-conceptos-salario') @break
        @case('generar-planilla')
            @livewire('generar-planilla') @break
        @case('confirmar-planilla')
            @livewire('confirmar-planilla') @break
        @case('usuarios')
            @livewire('crud-usuarios') @break
        @case('auditorias')
            @livewire('auditorias') @break
        @default
            <h4>Bienvenido al sistema</h4>
    @endswitch
</div>
