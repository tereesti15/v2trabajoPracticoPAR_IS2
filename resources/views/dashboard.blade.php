@extends('layouts.app')

@section('content')
   <center><h1 class="mb-4">Bienvenido al Sistema de Nóminas</h1></center>

    @livewire('dashboard-content') {{-- Este componente puede mostrar estadísticas, alertas, etc. --}}
@endsection
