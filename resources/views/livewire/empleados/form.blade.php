<div class="card">
    <div class="card-header">
        {{ $empleadoId ? 'Editar Empleado' : 'Crear Empleado' }}
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <input type="hidden" class="form-control" wire:model.defer="estado_empleado" value="{{ $estado_empleado }}">
            <div class="mb-3">
                <label for="id_persona" class="form-label">Seleccionar Persona</label>
                <select id="id_persona" class="form-select" wire:model.defer="id_persona">
                    <option value="">-- Selecciona una persona --</option>
                    @foreach ($lista_persona as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombre_completo }}</option>
                    @endforeach
                </select>
                @error('id_persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="id_departamento" class="form-label">Seleccionar Departamento</label>
                <select id="id_departamento" class="form-select" wire:model.defer="id_departamento">
                    <option value="">-- Selecciona un Departamento --</option>
                    @foreach ($lista_departamento as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre_departamento }}</option>
                    @endforeach
                </select>
                @error('id_departamento') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="id_cargo" class="form-label">Seleccionar Cargo</label>
                <select id="id_cargo" class="form-select" wire:model.defer="id_cargo">
                    <option value="">-- Selecciona un Cargo --</option>
                    @foreach ($lista_cargo as $cargo)
                        <option value="{{ $cargo->id_cargo }}">{{ $cargo->nombre_cargo }}</option>
                    @endforeach
                </select>
                @error('id_cargo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Salario Base</label>
                <input type="text" class="form-control" wire:model.defer="salario_base">
                @error('salario_base') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Fecha Ingreso</label>
                <input type="text" class="form-control" wire:model.defer="fecha_ingreso">
                @error('fecha_ingreso') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>