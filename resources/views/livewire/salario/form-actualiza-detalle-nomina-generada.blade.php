<div class="card">
    <div class="card-header">
        Editar detalle nomina generada
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>{{ $nombre_concepto }}</label>
            </div>
            <div class="mb-3">
                <label>{{ $detalle_concepto }}</label>
            </div>
            <div class="mb-3">
                <label>{{ $tipo_concepto }}</label>
            </div>
            <div class="mb-3">
                <label>Importe</label>
                <input type="text" class="form-control" wire:model.defer="importe">
                @error('importe') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>