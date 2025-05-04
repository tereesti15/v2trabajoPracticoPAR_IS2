<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>

    <div class="flex p-6" x-data="{ activeComponent: null }">
        {{-- Menú lateral --}}
        <div class="w-1/4 pr-4 border-r">
            <h3 class="font-bold mb-4">Bienvenido, {{ Auth::user()->name }}</h3>

            {{-- Empleado --}}
            <div class="mb-2">
                <button @click="activeComponent = 'empleado-crud'"
                    class="text-blue-700 hover:underline">Empleado</button>
            </div>

            {{-- Persona --}}
            @if(in_array(Auth::user()->role, ['Encargado RRHH', 'Gerente', 'Administrador']))
                <div class="mb-2">
                    <button @click="activeComponent = 'persona-crud'"
                        class="text-blue-700 hover:underline">Persona</button>
                </div>
                <div class="mb-2">
                    <button @click="activeComponent = 'hijos-crud'"
                        class="text-blue-700 hover:underline">Hijos</button>
                </div>
            @endif

            {{-- Reportes --}}
            @if(in_array(Auth::user()->role, ['Gerente', 'Administrador']))
                <div class="mb-2">
                    <button @click="activeComponent = 'reporte-panel'"
                        class="text-blue-700 hover:underline">Reportes</button>
                </div>
            @endif
        </div>

        {{-- Panel de contenido dinámico --}}
        <div class="w-3/4 pl-6">
        <template x-if="activeComponent === 'empleado-crud'">
                <livewire:empleado-crud />
            </template>
            <template x-if="activeComponent === 'persona-crud'">
                <livewire:persona-crud />
            </template>
            <template x-if="activeComponent === 'hijos-crud'">
                <livewire:hijos-crud />
            </template>
            <template x-if="activeComponent === 'reporte-panel'">
                <livewire:reporte-panel />
            </template>
        </div>
    </div>
</x-app-layout>
