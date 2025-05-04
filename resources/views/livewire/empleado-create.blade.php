<div class="max-w-xl mx-auto bg-white p-4 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Crear Nuevo Empleado</h2>

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="guardar" class="space-y-4">
        <div>
            <label class="block font-semibold">Nombre</label>
            <input type="text" wire:model="nombre" class="w-full border rounded p-2" />
            @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2" />
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('dashboard') }}" class="text-gray-600 underline">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
