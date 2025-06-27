<div class="card">
    <div class="card-header">
        Conceptos Temporales
    </div>
    <small class="text-muted d-block mt-2">
        Estos conceptos son temporales, o variables, debe indicar el mes y año en que debe procesarse el registro, 
        en caso de ser varios puede ingresar varios registros
    </small>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Concepto</label>
                <select class="form-select" wire:model.defer="id_concepto">
                    <option value="">-- Seleccione un concepto --</option>
                    @foreach($lista_concepto as $concepto)
                        <option value="{{ $concepto->id_concepto }}">{{ $concepto->nombre_concepto }} - {{ $concepto->tipo }}</option>
                    @endforeach
                </select>
                @error('id_concepto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Detalle</label>
                <input type="text" class="form-control" wire:model.defer="detalle_concepto">
                @error('detalle_concepto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Año a procesar</label>
                <input type="text" class="form-control" wire:model.defer="anho_proceso">
                @error('anho_proceso') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="mes" class="form-label">Mes a procesar</label>
                <select wire:model="mesSeleccionado" id="mes" class="form-select" wire:model.defer="mes_proceso">
                    <option value="">-- Selecciona un mes --</option>
                    @foreach ($meses as $numero => $nombre)
                        <option value="{{ $numero }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                @error('mes_proceso') <small class="text-danger">{{ $message }}</small> @enderror
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