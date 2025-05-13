<div class="flex p-6">
    {{-- Menú lateral --}}
    <div class="w-1/4 pr-4 border-r">
        <h3 class="font-bold mb-4">Bienvenido HOLA, {{ Auth::user()->name }}</h3>

        <div class="mb-2">
            <button wire:click="$set('activeComponent', 'empleado-crud')" class="text-blue-700 hover:underline">Empleado</button>
        </div>

        @if(in_array(Auth::user()->role, ['Encargado RRHH', 'Gerente', 'Administrador']))
            <div class="mb-2">
                <button wire:click="$set('activeComponent', 'persona-crud')" class="text-blue-700 hover:underline">Persona</button>
            </div>

            <div class="mb-2">
                <button wire:click="$set('activeComponent', 'hijos-crud')" class="text-blue-700 hover:underline">Hijos</button>
            </div>
        @endif

        @if(in_array(Auth::user()->role, ['Gerente', 'Administrador']))
            <div class="mb-2">
                <button wire:click="$set('activeComponent', 'reporte-panel')" class="text-blue-700 hover:underline">Reportes</button>
            </div>
        @endif
    </div>

    {{-- Panel de contenido dinámico --}}
    <div class="w-3/4 pl-6">

        {{-- ✅ Alerta global --}}
        @if ($this->mensaje)
            <x-alert :type="$this->tipo_alerta" :message="$this->mensaje" />
        @endif

        {{-- ✅ Renderizado dinámico de componentes Livewire --}}
        @switch($activeComponent)
            @case('empleado-crud')
                <livewire:empleado-crud />
                @break

            @case('persona-crud')
                <livewire:persona-crud />
                @break

            @case('persona-create')
                <livewire:persona-create />
                @break

            @case('hijos-crud')
                <livewire:hijos-crud />
                @break

            @case('hijo-create')
                <livewire:hijo-create />
                @break

            @case('reporte-panel')
                <livewire:reporte-panel />
                @break
        @endswitch

    </div>
</div>
