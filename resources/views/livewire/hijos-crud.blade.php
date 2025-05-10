<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-2xl font-bold text-blue-800">Gestión de Hijos</h3>
        <button @click="$dispatch('cambiar-vista', { vista: 'hijo-create' })"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nuevo Hijo</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-2">{{ session('message') }}</div>
    @endif

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Documento</th>
                <th class="border px-4 py-2">Persona</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hijos as $hijo)
                <tr>
                    <td class="border px-4 py-2">{{ $hijo['id'] }}</td>
                    <td class="border px-4 py-2">{{ $hijo['nombre'] }}</td>
                    <td class="border px-4 py-2">{{ $hijo['documento'] }}</td>
                    <td class="border px-4 py-2">
                        {{ $hijo['persona']['apellido'] ?? '' }}, {{ $hijo['persona']['nombre'] ?? '' }}
                    </td>
                    <td class="border px-4 py-2 space-x-2">
                        <button class="text-blue-600 hover:underline">Editar</button>
                        <button wire:click="delete({{ $hijo['id'] }})"
                            class="text-red-600 hover:underline"
                            onclick="confirm('¿Seguro que desea eliminar?') || event.stopImmediatePropagation()">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-2">No hay hijos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
