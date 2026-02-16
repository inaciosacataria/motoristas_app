@props([
    'name',
    'label' => null,
    'type' => 'text',
    'icon' => null,
    'required' => false,
    'placeholder' => '',
    'value' => '',
])

<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            @if($icon)
                <i class="fas fa-{{ $icon }} mr-1"></i>
            @endif
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        @if($icon)
            <i class="fas fa-{{ $icon }} absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        @endif
        
        <input 
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'input' . ($icon ? ' pl-10' : '') . ($errors->has($name) ? ' input-error' : '')]) }}
        >
    </div>
    
    @error($name)
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

