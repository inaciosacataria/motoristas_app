@props(['type' => 'info', 'dismissible' => true])

@php
    $classes = [
        'success' => 'alert-success',
        'error' => 'alert-error',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
    ];
    
    $icons = [
        'success' => 'fa-check-circle',
        'error' => 'fa-times-circle',
        'warning' => 'fa-exclamation-triangle',
        'info' => 'fa-info-circle',
    ];
@endphp

<div {{ $attributes->merge(['class' => "alert {$classes[$type]}"]) }} role="alert">
    <div class="flex items-start flex-1">
        <i class="fas {{ $icons[$type] }} text-xl mr-3"></i>
        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>
    
    @if($dismissible)
        <button type="button" onclick="this.parentElement.remove()" class="ml-auto">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>

