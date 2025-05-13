<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-2xl font-bold text-gray-700">👶 Nuevo Hijo</h3>
        <button class="text-blue-600 hover:underline" wire:click="$emitUp('goBack')">
            ← Volver
        </button>
    </div>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm font-semibold">Persona (Padre/Madre)</label>
            <select wire:model="persona_id" class="w-full border rounded p-2">
                <option value="">-- Seleccionar --</option>
                @foreach ($personas as $persona)
                    <option value="{{ $persona->id }}">{{ $persona->apellido }}, {{ $persona->nombre }}</option>
                @endforeach
            </select>
            @error('persona_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold">Nombre del hijo</label>
            <input type="text" wire:model="nombre" class="w-full border rounded p-2">
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold">Fecha de nacimiento</label>
            <input type="date" wire:model="fecha_nacimiento" class="w-full border rounded p-2">
            @error('fecha_nacimiento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold">Documento</label>
            <input type="text" wire:model="documento" class="w-full border rounded p-2">
            @error('documento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="discapacitado" class="mr-2">
                <span class="text-sm">¿Discapacitado?</span>
            </label>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Guardar
        </button>
    </form>
</div>
