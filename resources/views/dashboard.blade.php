@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Bienvenido al Sistema de Nómina</h1>

    @livewire('dashboard-content') {{-- Este componente puede mostrar estadísticas, alertas, etc. --}}
@endsection
