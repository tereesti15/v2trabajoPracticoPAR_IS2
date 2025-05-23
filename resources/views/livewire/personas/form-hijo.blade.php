<div class="card">
    <div class="card-header">
        {{ $hijoId ? 'Editar Hijo' : 'Crear Hijo' }}
    </div>
    <div class="card-body">

        {{--  Alerta de éxito --}}
        @if ($successMessage)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $successMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        {{-- Alerta de error inesperado --}}
        @if ($errorMessage)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errorMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <form wire:submit.prevent="save">
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
            {{--<div class="mb-3">
                <label>Discapacitado</label>
                <input type="text" class="form-control" wire:model.defer="discapacitado">
                @error('discapacitado') <small class="text-danger">{{ $message }}</small> @enderror
            </div>--}}

            {{-- Discapacitado --}}
            <div class="mb-3">
                <label for="discapacitado" class="form-label">Discapacitado</label>
                <select id="discapacitado" wire:model.defer="discapacitado" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                @error('discapacitado') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>

