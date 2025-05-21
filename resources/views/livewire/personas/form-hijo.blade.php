<div class="card">
    <div class="card-header">
        {{ $hijoId ? 'Editar Hijo' : 'Crear Hijo' }}
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <input type="hidden" class="form-control" wire:model.defer="persona_id" value={{ $persona_id }}>
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" wire:model.defer="nombre">
                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Fecha de Nacimiento</label>
                <input type="text" class="form-control" wire:model.defer="fecha_nacimiento">
                @error('fecha_nacimiento') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Documento</label>
                <input type="text" class="form-control" wire:model.defer="documento">
                @error('documento') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Discapacitado</label>
                <input type="text" class="form-control" wire:model.defer="discapacitado">
                @error('discapacitado') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>

