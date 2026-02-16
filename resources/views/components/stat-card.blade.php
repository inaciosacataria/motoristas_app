@props(['title', 'value', 'icon', 'color' => 'primary'])

@php
    $colorClasses = [
        'primary' => 'bg-primary-100 text-primary-600',
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'red' => 'bg-red-100 text-red-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'stat-card']) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600 text-sm">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900">{{ $value }}</p>
            @isset($subtitle)
                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
            @endisset
        </div>
        <div class="{{ $colorClasses[$color] }} rounded-full p-3">
            <i class="fas fa-{{ $icon }} text-2xl"></i>
        </div>
    </div>
</div>

