@extends('layouts.modern')

@section('title', 'Base de Dados de Motoristas')

@push('styles')
<!-- DataTables with Tailwind styling -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Custom DataTable styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 0.75rem;
        margin: 0 0.125rem;
        border-radius: 0.375rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #059669 !important;
        color: white !important;
        border-color: #059669 !important;
    }
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem;
    }
    table.dataTable thead th {
        background: #f9fafb;
        font-weight: 600;
        color: #374151;
        padding: 1rem;
    }
    table.dataTable tbody tr:hover {
        background-color: #f9fafb;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <nav class="text-sm mb-2">
                    <a href="/admin" class="text-green-100 hover:text-white transition">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <span class="text-green-200 mx-2">/</span>
                    <span class="text-white">Base de Dados de Motoristas</span>
                </nav>
                <h1 class="text-3xl font-bold">Base de Dados de Motoristas</h1>
                <p class="text-green-100 mt-1">Gestão completa de todos os motoristas registrados</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold">{{ count($motoristas) }}</div>
                    <div class="text-sm text-green-100">Total de Motoristas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Categoria A</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $motoristas->where('categoria', 'A-Motociclo')->count() }}
                    </p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-motorcycle text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Categoria B</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $motoristas->where('categoria', 'B-Ligeiro')->count() }}
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-car text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Categoria C</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $motoristas->where('categoria', 'C-Pesado')->count() }}
                    </p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-truck text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Profissional</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $motoristas->whereIn('categoria', ['G-Profissional', 'P-Serviços Públicos'])->count() }}
                    </p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-bus text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-users text-green-600 mr-2"></i>
                        Lista de Motoristas
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Visualize e gerencie todos os motoristas cadastrados</p>
                </div>
                <div class="flex gap-2">
                    <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i>
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="p-6 overflow-x-auto">
            <table id="motoristas-table" class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Motorista</th>
                        <th class="text-left">Habilitação</th>
                        <th class="text-left">Grau Acadêmico</th>
                        <th class="text-left">Província</th>
                        <th class="text-left">Contacto</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motoristas as $motorista)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                @if($motorista->foto_url && $motorista->foto_url != 'none')
                                    <img src="{{ $motorista->foto_url }}" alt="{{ $motorista->name }}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($motorista->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('perfil', $motorista->user_id) }}" 
                                       class="font-semibold text-gray-900 hover:text-green-600 transition-colors">
                                        {{ $motorista->name }}
                                    </a>
                                    <p class="text-xs text-gray-500">ID: {{ $motorista->user_id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                @if(str_contains($motorista->categoria, 'Motociclo')) bg-blue-100 text-blue-800
                                @elseif(str_contains($motorista->categoria, 'Ligeiro')) bg-green-100 text-green-800
                                @elseif(str_contains($motorista->categoria, 'Pesado')) bg-purple-100 text-purple-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ $motorista->categoria }}
                            </span>
                        </td>
                        <td class="py-4 px-2">
                            <span class="text-gray-700">{{ $motorista->grau_academico ?? 'N/A' }}</span>
                        </td>
                        <td class="py-4 px-2">
                            <span class="text-gray-700">{{ $motorista->provincia }}</span>
                        </td>
                        <td class="py-4 px-2">
                            <a href="tel:{{ $motorista->celular }}" class="text-green-600 hover:text-green-700 font-medium">
                                <i class="fas fa-phone mr-1"></i>
                                {{ $motorista->celular }}
                            </a>
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('perfil', $motorista->user_id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver Perfil">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($motorista->cv)
                                <a href="/{{ $motorista->cv }}" target="_blank"
                                   class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver CV">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @endif
                                
                                <button onclick="deletarMotorista({{ $motorista->user_id }}, '{{ $motorista->name }}')"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors"
                                        title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full animate-fade-in">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Confirmar Eliminação</h3>
            <p class="text-center text-gray-600 mb-6" id="deleteMessage"></p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#motoristas-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json',
        },
        pageLength: 25,
        order: [[0, 'asc']],
        responsive: true,
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4"lf>rtip',
    });
});

function deletarMotorista(userId, userName) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const message = document.getElementById('deleteMessage');
    
    message.textContent = `Tem certeza que deseja eliminar o motorista "${userName}"? Esta ação não pode ser desfeita.`;
    form.action = `/deleteCandidato/${userId}`;
    
    modal.classList.remove('hidden');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
}

// Close modal on ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});

// Close modal on outside click
document.getElementById('deleteModal')?.addEventListener('click', function(event) {
    if (event.target === this) {
        closeDeleteModal();
    }
});
</script>
@endpush

