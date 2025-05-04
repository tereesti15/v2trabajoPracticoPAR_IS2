<div>
    <h3 class="text-lg font-bold mb-4">Listado de Empleados</h3>

    {{-- Botón para crear nuevo empleado --}}
    <div class="mb-4">
        <a href="{{ url('/empleados/create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Nuevo Empleado
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-2">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nombre Completo</th>
                <th class="border px-4 py-2">Salario Base</th>
                <th class="border px-4 py-2">Estado</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($empleados as $empleado)
                <tr>
                    <td class="border px-4 py-2">{{ $empleado['id_empleado'] }}</td>
                    <td class="border px-4 py-2">{{ $empleado['nombre_completo'] }}</td>
                    <td class="border px-4 py-2">{{ $empleado['salario_base'] }}</td>
                    <td class="border px-4 py-2">{{ $empleado['estado_empleado'] }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ url('/empleados/' . $empleado['id_empleado'] . '/edit') }}" class="text-blue-500 hover:underline">Editar</a>
                        <button wire:click="deleteEmpleado({{ $empleado['id_empleado'] }})"
                                class="text-red-500 hover:underline"
                                onclick="confirm('¿Estás seguro que deseas eliminar?') || event.stopImmediatePropagation()">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">No hay empleados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
