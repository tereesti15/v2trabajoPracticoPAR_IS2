<div class="card">
    <div class="card-header">
        {{ $id_concepto ? 'Editar Concepto' : 'Crear Concepto' }}
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Nombre Concepto</label>
                <input type="text" class="form-control" wire:model.defer="nombre_concepto">
                @error('nombre_concepto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Tipo</label>
                <select id="tipoConcepto" wire:model="tipo" class="form-select">
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach($tipo_concepto as $valor => $etiqueta)
                        <option value="{{ $valor }}">{{ $etiqueta }}</option>
                    @endforeach
                </select>
                @error('tipo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Agrupador</label>
                <input type="text" class="form-control" wire:model.defer="agrupador">
                @error('agrupador') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>N&uacute;mero de orden (Min = 0, Max = 100)</label>
                <input type="text" class="form-control" wire:model.defer="nro_orden">
                @error('nro_orden') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>