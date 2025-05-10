<div class="bg-white p-6 rounded shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-blue-800">Crear Nuevo Empleado</h2>
        <button @click="$dispatch('cerrarFormulario')" class="text-red-600 hover:text-red-800">
            &#x2715;
        </button>
    </div>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-semibold">Persona</label>
            <select wire:model="id_persona" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Seleccione una persona</option>
                @foreach($personas as $persona)
                    <option value="{{ $persona->id }}">{{ $persona->nombre }} {{ $persona->apellido }}</option>
                @endforeach
            </select>
            @error('id_persona') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Cargo</label>
            <select wire:model="id_cargo" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Seleccione un cargo</option>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id_cargo }}">{{ $cargo->nombre_cargo }}</option>
                @endforeach
            </select>
            @error('id_cargo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Departamento</label>
            <select wire:model="id_departamento" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Seleccione un departamento</option>
                @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->id }}">{{ $departamento->nombre_departamento }}</option>
                @endforeach
            </select>
            @error('id_departamento') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Salario Base</label>
            <input type="number" wire:model="salario_base" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('salario_base') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Estado</label>
            <input type="text" wire:model="estado_empleado" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('estado_empleado') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar Empleado
        </button>
    </form>
</div>
@if ($errors->has('general'))
    <div class="text-red-600 text-sm mt-2">
        {{ $errors->first('general') }}
    </div>
@endif
@if ($mensaje)
    <x-alert :type="$tipo_alerta" :message="$mensaje" />
@endif
