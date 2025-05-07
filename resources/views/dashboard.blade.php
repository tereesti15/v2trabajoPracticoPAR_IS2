<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>

    <div class="flex p-6" 
         x-data="{ activeComponent: null }" 
         x-on:cambiar-vista.window="activeComponent = $event.detail.vista">

        {{-- Menú lateral --}}
        <div class="w-1/4 pr-4 border-r">
            <h3 class="font-bold mb-4">Bienvenido, {{ Auth::user()->name }}</h3>

            {{-- Empleado --}}
            <div class="mb-2">
                <button @click="activeComponent = 'empleado-crud'" class="text-blue-700 hover:underline">
                    Empleado
                </button>
            </div>

            {{-- Persona --}}
            @if(in_array(Auth::user()->role, ['Encargado RRHH', 'Gerente', 'Administrador']))
                <div class="mb-2">
                    <button @click="activeComponent = 'persona-crud'" class="text-blue-700 hover:underline">
                        Persona
                    </button>
                </div>
                <div class="mb-2">
                    <button @click="activeComponent = 'hijos-crud'" class="text-blue-700 hover:underline">
                        Hijos
                    </button>
                </div>
            @endif

            {{-- Reportes --}}
            @if(in_array(Auth::user()->role, ['Gerente', 'Administrador']))
                <div class="mb-2">
                    <button @click="activeComponent = 'reporte-panel'" class="text-blue-700 hover:underline">
                        Reportes
                    </button>
                </div>
            @endif
        </div>

        {{-- Panel de contenido dinámico --}}
        <div class="w-3/4 pl-6">

            <div x-show="activeComponent === 'empleado-crud'" style="display: none;">
                <livewire:empleado-crud />
            </div>
            <div x-show="activeComponent === 'empleado-create'" style="display: none;">
                <livewire:empleado-create />
            </div>
            <div x-show="activeComponent === 'persona-crud'" style="display: none;">
                <livewire:persona-crud />
            </div>
            <div x-show="activeComponent === 'hijos-crud'" style="display: none;">
                <livewire:hijos-crud />
            </div>
            <div x-show="activeComponent === 'reporte-panel'" style="display: none;">
                <livewire:reporte-panel />
            </div>
            <div x-show="activeComponent === 'persona-create'" style="display: none;">
                <livewire:persona-create />
            </div>
            <div x-show="activeComponent === 'hijo-create'" style="display: none;">
                <livewire:hijo-create />
            </div>
        </div>
    </div>
</x-app-layout>
