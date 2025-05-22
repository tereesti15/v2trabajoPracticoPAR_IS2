<div class="card">
    <div class="card-header">
        Generar nomina según parametros
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Año</label>
                <input type="text" class="form-control" wire:model.defer="anho">
                @error('anho') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="mes" class="form-label">Seleccionar Mes</label>
                <select wire:model="mesSeleccionado" id="mes" class="form-select" wire:model.defer="mes">
                    <option value="">-- Selecciona un mes --</option>
                    @foreach ($meses as $numero => $nombre)
                        <option value="{{ $numero }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Procesar</button>
        </form>
    </div>
</div>