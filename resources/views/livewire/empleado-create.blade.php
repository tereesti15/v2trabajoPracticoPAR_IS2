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
