<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-2xl font-bold text-gray-700">➕ Nueva Persona</h3>
        <button class="text-blue-600 hover:underline" wire:click="$emitUp('goBack')">
            ← Volver
        </button>
    </div>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm font-semibold">Nombre</label>
            <input type="text" wire:model="nombre" class="w-full border rounded p-2">
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-sm font-semibold">Apellido</label>
            <input type="text" wire:model="apellido" class="w-full border rounded p-2">
            @error('apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <!-- Agrega los demás campos de forma similar -->

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>
</div>
