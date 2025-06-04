<div class="container py-4">
    @if ($showForm)
        @livewire('config.salario-concepto-form', ['id_concepto' => $configToEdit], key($configToEdit))
        <button class="btn btn-secondary mt-3" wire:click="closeForm">Volver</button>
    @else
        <button class="btn btn-primary mb-3" wire:click="create">Agregar Concepto</button>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Agrupador</th>
                    <th>Orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conceptosSalariales as $concepto)
                    <tr>
                        <td>{{ $concepto->nombre_concepto }}</td>
                        <td>{{ $concepto->tipo }}</td>
                        <td>{{ $concepto->agrupador }}</td>
                        <td>{{ $concepto->nro_orden }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $concepto->id_concepto }})">Editar</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $concepto->id_concepto }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
