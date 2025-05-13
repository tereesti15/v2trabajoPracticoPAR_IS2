@extends('layouts.app')

@section('content')
<div class="d-flex">
    <div style="width: 250px;" class="bg-light border-end">
        @livewire('sidebar-navigation')
    </div>
    <div class="flex-grow-1 p-4">
        @livewire('dashboard-content')
    </div>
</div>
@endsection
