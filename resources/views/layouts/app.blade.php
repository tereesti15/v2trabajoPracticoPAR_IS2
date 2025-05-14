{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    @auth
        <div class="d-flex">
            @include('layouts.sidebar') <!-- Carga el menú lateral solo si hay usuario logueado -->

            <div class="flex-grow-1 p-4">
                @isset($header)
                    <div class="mb-4">
                        {{ $header }}
                    </div>
                @endisset

                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    @endauth

    @guest
        {{-- Para páginas públicas como login, register, etc. --}}
        <main class="py-4 container">
            @yield('content')
        </main>
    @endguest

    @livewireScripts
</body>
</html>
