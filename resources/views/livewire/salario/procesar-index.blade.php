<div class="container py-4">
    @if ($showForm)
        @livewire('salario.procesar-nomina-form')
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @else
        <button class="btn btn-primary mb-3" wire:click="create">Generar planilla</button>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lista_planilla as $planilla)
                    <tr>
                        <td>{{ $planilla->periodo_formateado }}</td>
                        <td>{{ $planilla->estado_nomina }}</td>
                        <td>
                            @if ($planilla_procesada)
                                <p>PROCESADA</p>
                            @else
                                @if (Auth::user()->role === 'Administrador')
                                    <button class="btn btn-sm btn-danger" wire:click="confirma({{ $planilla->id }})">Confirmar</button>
                                @endif
                            @endif
                            <button class="btn btn-sm btn-secondary" wire:click="visualizar({{ $planilla->id }})">Visualizar</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $planilla->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
