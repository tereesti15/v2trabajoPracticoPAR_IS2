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
                <input type="text" class="form-control" wire:model.defer="ci">
                @error('ci') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Fecha de nacimiento</label>
                <input type="date" class="form-control" wire:model.defer="fecha_nacimiento">
                @error('fecha_nacimiento') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Sexo</label>
                <select class="form-control" wire:model.defer="sexo">
                    <option value="">Seleccionar</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                @error('sexo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Dirección</label>
                <input type="text" class="form-control" wire:model.defer="direccion">
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>
