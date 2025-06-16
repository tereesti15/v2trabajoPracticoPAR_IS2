<div class="container mt-4">
    <h4>{{ $id_registro ? 'Editar Cuota' : 'Nueva Cuota' }}</h4>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $id_registro ? 'editar' : 'grabar' }}">
        <label for="id_empleado" class="form-label">Empleado: {{ $nombre_empleado }}</label>
        
        <div class="mb-3">
            <label for="id_concepto" class="form-label">Concepto</label>
            <select class="form-select" id="id_concepto" wire:model="id_concepto">
                <option value="">-- Seleccione un concepto --</option>
                @foreach($lista_conceptos as $concepto)
                    <option value="{{ $concepto->id_concepto }}">{{ $concepto->nombre_concepto }}</option>
                @endforeach
            </select>
            @error('id_concepto') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="detalle_concepto" class="form-label">Detalle adicional</label>
            <input type="text" class="form-control" id="detalle_concepto" wire:model="detalle_concepto">
            @error('detalle_concepto') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="cant_cuota" class="form-label">Cantidad Cuotas</label>
                <input type="number" class="form-control" id="cant_cuota" wire:model="cant_cuota">
                @error('cant_cuota') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="nro_cuota" class="form-label">Número Cuota</label>
                <input type="number" class="form-control" id="nro_cuota" wire:model="nro_cuota">
                @error('nro_cuota') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="monto_concepto" class="form-label">Monto</label>
                <input type="text" class="form-control" id="monto_concepto" wire:model="monto_concepto">
                @error('monto_concepto') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" wire:model="tipo">
                <option value="">-- Seleccione un tipo --</option>
                @foreach ($lista_tipos as $opcion)
                    <option value="{{ $opcion->value }}">
                        {{ $opcion->label() }}
                    </option>
                @endforeach
            </select>
            @error('tipo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $id_registro ? 'Actualizar' : 'Crear' }}
        </button>
    </form>
</div>
