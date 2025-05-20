<div class="card">
    <div class="card-header">
        Conceptos fijos
    </div>
    <small class="text-muted d-block mt-2">
        Estos conceptos son fijos, que el trabajador cobrará cada mes, ejemplo 
    </small>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Concepto</label>
                <select class="form-select" wire:model.defer="id_concepto">
                    <option value="">-- Seleccione un concepto --</option>
                    @foreach($conceptos as $concepto)
                        <option value="{{ $concepto->id_concepto }}">{{ $concepto->nombre_concepto }} - {{ $concepto->tipo }}</option>
                    @endforeach
                </select>
                @error('id_concepto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Concepto</label>
                <input type="text" class="form-control" wire:model.defer="concepto">
                @error('concepto') <small class="text-danger">{{ $message }}</small> @enderror
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