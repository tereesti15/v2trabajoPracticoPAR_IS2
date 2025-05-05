<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-2xl font-bold text-blue-800">Gestión de Personas</h3>
        <button @click="$dispatch('cambiar-vista', { vista: 'persona-create' })"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nueva Persona</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-2">{{ session('message') }}</div>
    @endif
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">Listado de Personas</h3>
    </div>

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Documento</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($personas as $persona)
                <tr>
                    <td class="border px-4 py-2">{{ $persona['id'] }}</td>
                    <td class="border px-4 py-2">{{ $persona['apellido'] }}, {{ $persona['nombre'] }}</td>
                    <td class="border px-4 py-2">{{ $persona['documento'] }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <button class="text-blue-600 hover:underline">Editar</button>
                        <button wire:click="delete({{ $persona['id'] }})"
                            class="text-red-600 hover:underline"
                            onclick="confirm('¿Seguro que desea eliminar?') || event.stopImmediatePropagation()">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-2">No hay personas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
