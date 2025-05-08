<div>
    @if($view === 'listado')
        <h3 class="text-xl font-semibold mb-4">Listado de Empleados</h3>

        <button wire:click="mostrarFormularioCreacion"
            class="mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            + Agregar Nuevo Empleado
        </button>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nombre</th>
                    <th class="border px-4 py-2">Salario Base</th>
                    <th class="border px-4 py-2">Estado</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($empleados as $empleado)
                    <tr>
                        <td class="border px-4 py-2">{{ $empleado['id_empleado'] }}</td>
                        <td class="border px-4 py-2">{{ $empleado['persona']['nombre_completo'] ?? 'N/D' }}</td>
                        <td class="border px-4 py-2">{{ $empleado['salario_base'] }}</td>
                        <td class="border px-4 py-2">
                            {{ \App\EstadoEmpleado::tryFrom($empleado['estado_empleado'])?->value ?? 'Desconocido' }}
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ url('/empleados/' . $empleado['id_empleado'] . '/edit') }}" class="text-blue-500">Editar</a>
                            <button wire:click="deleteEmpleado({{ $empleado['id_empleado'] }})"
                                class="text-red-500 ml-2"
                                onclick="confirm('¿Seguro que deseas eliminar?') || event.stopImmediatePropagation()">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
    @elseif($view === 'crear')
        <div class="mb-4 flex items-center">
            <button wire:click="volverAlListado" class="mr-2 text-blue-600 hover:underline">
                ← Volver al Listado
            </button>
            <h3 class="text-2xl font-bold">Crear Nuevo Empleado</h3>
        </div>

        {{-- Aquí va el formulario de creación --}}
        @livewire('empleado-create')
    @endif
</div>
