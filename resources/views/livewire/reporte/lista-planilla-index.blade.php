<div class="container py-4">
    @if ($showRecibo)
        @livewire('reporte.lista-recibos', ['id_nomina' => $id_planilla_procesada], key('salario-'.$id_planilla_procesada))
        <button class="btn btn-secondary mt-3" wire:click="closeListaRecibo">Volver</button>
    @elseif ($verificarPlanilla)
        @livewire('reporte.planilla-index', ['id_nomina' => $id_planilla_procesada], key('salario-'.$id_planilla_procesada))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @else

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lista_planilla as $planilla)
                    <tr>
                        <td>{{ $planilla->periodo_formateado }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary" wire:click="visualizar({{ $planilla->id_nomina }})">Planilla</button>
                            <button class="btn btn-sm btn-danger" wire:click="recibos({{ $planilla->id_nomina }})">Recibos</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
