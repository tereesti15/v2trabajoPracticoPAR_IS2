<div class="card">
    <div class="card-header">
        {{ $personaId ? 'Editar Persona' : 'Crear Persona' }}
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" wire:model.defer="nombre">
                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Apellido</label>
                <input type="text" class="form-control" wire:model.defer="apellido">
                @error('apellido') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>CI</label>
                <input type="text" class="form-control" wire:model.defer="documento">
                @error('documento') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Correo</label>
                <input type="text" class="form-control" wire:model.defer="email">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Dirección</label>
                <input type="text" class="form-control" wire:model.defer="direccion">
                @error('direccion') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" class="form-control" wire:model.defer="telefono">
                @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>
