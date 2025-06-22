<!-- resources/views/layouts/sidebar.blade.php -->
@auth
<div class="p-3" style="min-width: 250px; height: 100vh; background-color: #0d1b2a; color: #ffd700;">

    <h5 style="color: #ffd700;">🧾 Nómina</h5>
    <hr style="border-color: #ffd700;">
   {{-- <hr> --}}

    <form action="{{ route('logout') }}" method="POST">
        @csrf
         {{--<button type="submit" class="btn btn-danger">Cerrar sesión</button>--}}
        <button type="submit"
            style="background-color: #8b0000; color: #fff; border: none; padding: 8px 16px; border-radius: 5px;"
         onmouseover="this.style.backgroundColor='#b22222';"
         onmouseout="this.style.backgroundColor='#8b0000';">
            Cerrar sesión
        </button>

    </form>
    <hr style="border-color: #ffd700;">

    {{-- Mostrar roles --}}
    <div style="color: #ffd700;">
        {{ Auth::user()->role }}
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" 
            class="nav-link" 
            style="color: #ffd700;"
            onmouseover="this.style.color='#fffacd';"
            onmouseout="this.style.color='#ffd700';">
            Inicio
            </a>
        </li>

        {{-- Empleados --}}
        {{--@if(in_array(Auth::user()->role, ['Administrador', 'Gerente', 'Encargado_rrhh']))
            <li class="nav-item">
                <a href="#empleadosSubmenu" class="nav-link text-white" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="empleadosSubmenu">
                    👥 Empleados
                </a>
                <ul id="empleadosSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('personas.index') }}" class="nav-link text-white">CRUD Personas</a></li>
                    <li><a href="{{ route('empleados.index') }}" class="nav-link text-white">CRUD Empleados</a></li>
                </ul>
            </li>
        @endif--}}

        {{-- Empleados --}}
        @if(in_array(Auth::user()->role, ['Administrador', 'Gerente', 'Encargado_rrhh']))
            <li class="nav-item">
                <a href="#empleadosSubmenu" class="nav-link" 
                style="color: #ffd700;" data-bs-toggle="collapse" 
                role="button" 
                aria-expanded="false" 
                aria-controls="empleadosSubmenu"
                onmouseover="this.style.color='#fffacd';"
                onmouseout="this.style.color='#ffd700';">  
                    Empleados
                </a>
                <ul id="empleadosSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('personas.index') }}" 
                    class="nav-link" 
                    style="color: #ffd700;" 
                    onmouseover="this.style.color='#fffacd';"
                    onmouseout="this.style.color='#ffd700';">
                    CRUD Personas</a></li>
                    <li><a href="{{ route('empleados.index') }}" 
                    class="nav-link" 
                    style="color: #ffd700;"
                    onmouseover="this.style.color='#fffacd';"
                    onmouseout="this.style.color='#ffd700';">
                    CRUD Empleados</a></li>
                </ul>
            </li>
        @endif

        {{-- Salarios --}}
        {{--@if(in_array(Auth::user()->role, ['Administrador', 'Gerente', 'Encargado_rrhh']))
            <li class="nav-item">
                <a href="#salarioSubmenu" class="nav-link text-white" data-bs-toggle="collapse" role="button" 
                aria-expanded="false" aria-controls="salarioSubmenu">
                    Procesos Mensuales
                </a>
                <ul id="salarioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('salario.index') }}" class="nav-link text-white">Generar Planilla</a></li>
                </ul>
                <ul id="salarioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('reporte.planilla-index') }}" class="nav-link text-white">Imprimir Planilla</a></li>
                </ul>
            </li>
        @endif --}}

         {{-- Salarios --}}
        @if(in_array(Auth::user()->role, ['Administrador', 'Gerente', 'Encargado_rrhh']))
            <li class="nav-item">
                <a href="#salarioSubmenu" 
                class="nav-link" 
                style="color: #ffd700;" 
                data-bs-toggle="collapse" 
                role="button" 
                aria-expanded="false" 
                aria-controls="salarioSubmenu"
                onmouseover="this.style.color='#fffacd';"
                onmouseout="this.style.color='#ffd700';">
                    {{-- Procesos Mensuales --}}
                    Gestión de Nómina
                </a>
                <ul id="salarioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('salario.index') }}" 
                    class="nav-link" 
                    style="color: #ffd700;"
                    onmouseover="this.style.color='#fffacd';"
                    onmouseout="this.style.color='#ffd700';">
                    Generar Planilla</a></li>
                    <li><a href="{{ route('reporte.planilla-index') }}" 
                    class="nav-link" 
                    style="color: #ffd700;"
                    onmouseover="this.style.color='#fffacd';"
                    onmouseout="this.style.color='#ffd700';">
                    Imprimir Planilla</a></li>
                </ul>
            </li>
        @endif

        {{-- Administración (Solo para administradores) --}}
        {{--@if(Auth::user()->role === 'Administrador')
            <li class="nav-item">
                <a href="#configuracioSubmenu" class="nav-link text-white" data-bs-toggle="collapse" role="button" 
                aria-expanded="false" aria-controls="configuracioSubmenu">
                    Configuración
                </a>
                <ul id="configuracioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('config.salario-concepto-index') }}" class="nav-link text-white">CRUD Concepto Salario</a></li>
                </ul>
                <ul id="configuracioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('config.parametro') }}" class="nav-link text-white">Parametro</a></li>
                </ul>
            </li>
        @endif--}}

         {{-- Configuración --}}
        @if(Auth::user()->role === 'Administrador')
            <li class="nav-item">
                <a href="#configuracioSubmenu" 
                class="nav-link" 
                style="color: #ffd700;" 
                data-bs-toggle="collapse" 
                role="button" 
                aria-expanded="false" 
                aria-controls="configuracioSubmenu"
                onmouseover="this.style.color='#fffacd';"
                onmouseout="this.style.color='#ffd700';">
                    Configuración
                </a>
                <ul id="configuracioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('config.salario-concepto-index') }}" 
                    class="nav-link" 
                    style="color: #ffd700;"
                    onmouseover="this.style.color='#fffacd';"
                    onmouseout="this.style.color='#ffd700';">
                    CRUD Concepto Salario</a></li>
                </ul>
                <ul id="configuracioSubmenu" class="collapse ps-3">
                    <li><a href="{{ route('config.parametro') }}" 
                    class="nav-link" 
                    style="color: #ffd700;"
                    onmouseover="this.style.color='#fffacd';"
                    onmouseout="this.style.color='#ffd700';">
                    Parametro</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
@endauth
