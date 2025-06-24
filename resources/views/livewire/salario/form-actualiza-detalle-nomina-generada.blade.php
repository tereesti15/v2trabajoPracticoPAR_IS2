<div class="card">
    <div class="card-header">
        Editar detalle nomina generada
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Descripcion concepto: <strong>{{ $nombre_concepto }}</strong> -> Tipo de concepto <strong>{{ $tipo_concepto }}</strong></label>
            </div>
            <div class="mb-3">
                <label>{{ $detalle_concepto }}</label>
            </div>
            <div class="mb-3">
                <label>Detalle concepto</label>
                <input type="text" class="form-control" wire:model.defer="detalle_concepto">
                @error('detalle_concepto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Importe</label>
                <input type="text" class="form-control" wire:model.defer="monto_concepto">
                @error('monto_concepto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>