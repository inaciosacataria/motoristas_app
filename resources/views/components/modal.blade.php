@props(['id', 'title', 'size' => 'md'])

@php
    $sizeClasses = [
        'sm' => 'max-w-md',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
    ];
@endphp

<div id="{{ $id }}" class="modal-overlay hidden" onclick="if(event.target === this) closeModal('{{ $id }}')">
    <div class="modal-container">
        <div class="modal-content {{ $sizeClasses[$size] }} w-full">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900">{{ $title }}</h3>
                    <button type="button" onclick="closeModal('{{ $id }}')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="p-6">
                {{ $slot }}
            </div>
            
            <!-- Footer (if provided) -->
            @isset($footer)
                <div class="p-6 border-t border-gray-200">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>

@once
    @push('scripts')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
    @endpush
@endonce

