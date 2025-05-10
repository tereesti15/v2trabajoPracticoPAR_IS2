@props(['type' => 'success', 'message', 'dismissible' => false])

@php
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'warning' => 'yellow',
        'info' => 'blue',
    ];

    $icon = [
        'success' => '✓',
        'error' => '✖',
        'warning' => '⚠',
        'info' => 'ℹ',
    ];

    $color = $colors[$type] ?? 'blue';
    $iconChar = $icon[$type] ?? 'ℹ';
@endphp

<div 
    x-data="{ show: true }" 
    x-init="setTimeout(() => { if (!@json($dismissible)) show = false }, 3000)" 
    x-show="show"
    x-transition
    class="flex items-center justify-between p-4 mb-4 text-sm text-{{ $color }}-800 bg-{{ $color }}-100 rounded-lg shadow-md"
    role="alert"
>
    <div class="flex items-center">
        <span class="text-lg mr-2">{{ $iconChar }}</span>
        <span>{{ $message }}</span>
    </div>

    @if ($dismissible)
        <button @click="show = false" class="ml-4 text-{{ $color }}-800 hover:text-{{ $color }}-900 font-bold">×</button>
    @endif
</div>
