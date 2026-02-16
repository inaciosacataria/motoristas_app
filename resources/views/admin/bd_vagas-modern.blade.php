@extends('layouts.modern')

@section('title', 'Gestão de Vagas')

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
                    <span class="text-white">Gestão de Vagas</span>
                </nav>
                <h1 class="text-3xl font-bold">Gestão de Vagas</h1>
                <p class="text-green-100 mt-1">Visualize e gerencie todas as vagas publicadas</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold">{{ count($anuncios) }}</div>
                    <div class="text-sm text-green-100">Total de Vagas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    
    @php
        $vagasAtivas = collect($anuncios)->filter(function($anuncio) {
            return \Carbon\Carbon::parse($anuncio->validade)->isFuture();
        })->count();
        
        $vagasExpiradas = collect($anuncios)->filter(function($anuncio) {
            return \Carbon\Carbon::parse($anuncio->validade)->isPast();
        })->count();
        
        $totalCandidaturas = count($candidaturas);
        
        $mediaCandidaturas = count($anuncios) > 0 ? round($totalCandidaturas / count($anuncios), 1) : 0;
    @endphp
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Vagas Ativas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $vagasAtivas }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Vagas Expiradas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $vagasExpiradas }}</p>
                </div>
                <div class="bg-red-100 rounded-full p-3">
                    <i class="fas fa-times-circle text-2xl text-red-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Candidaturas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCandidaturas }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Média Candidaturas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $mediaCandidaturas }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-chart-line text-2xl text-purple-600"></i>
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
                        <i class="fas fa-briefcase text-green-600 mr-2"></i>
                        Lista de Vagas
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Visualize e gerencie todos os anúncios de emprego</p>
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
            <table id="vagas-table" class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Vaga</th>
                        <th class="text-left">Empresa</th>
                        <th class="text-left">Contacto</th>
                        <th class="text-center">Candidaturas</th>
                        <th class="text-center">Validade</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anuncios as $anuncio)
                    @php
                        $count = collect($candidaturas)->where('anuncio_id', $anuncio->id)->count();
                        $isActive = \Carbon\Carbon::parse($anuncio->validade)->isFuture();
                        $diasRestantes = \Carbon\Carbon::now()->diffInDays($anuncio->validade, false);
                    @endphp
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-2">
                            <div>
                                <a href="/anuncio/{{ $anuncio->id }}" 
                                   class="font-semibold text-gray-900 hover:text-green-600 transition-colors">
                                    {{ $anuncio->titulo }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $anuncio->local ?? 'Localização não especificada' }}
                                </p>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <div>
                                <p class="font-medium text-gray-900">{{ $anuncio->empresa }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $anuncio->user_id }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <a href="tel:{{ $anuncio->celular }}" class="text-green-600 hover:text-green-700 font-medium">
                                <i class="fas fa-phone mr-1"></i>
                                {{ $anuncio->celular }}
                            </a>
                        </td>
                        <td class="py-4 px-2 text-center">
                            <a href="/candidatos-anuncio/{{ $anuncio->id }}" 
                               class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                               @if($count == 0) bg-gray-100 text-gray-800
                               @elseif($count < 5) bg-blue-100 text-blue-800
                               @elseif($count < 10) bg-green-100 text-green-800
                               @else bg-purple-100 text-purple-800
                               @endif
                               hover:shadow-md transition-shadow">
                                <i class="fas fa-users mr-1"></i>
                                {{ $count }} {{ $count == 1 ? 'candidatura' : 'candidaturas' }}
                            </a>
                        </td>
                        <td class="py-4 px-2 text-center">
                            <div class="text-sm">
                                <p class="font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($anuncio->validade)->format('d/m/Y') }}
                                </p>
                                @if($isActive)
                                    <p class="text-xs text-green-600">
                                        @if($diasRestantes > 0)
                                            {{ $diasRestantes }} {{ $diasRestantes == 1 ? 'dia' : 'dias' }} restantes
                                        @else
                                            Expira hoje
                                        @endif
                                    </p>
                                @else
                                    <p class="text-xs text-red-600">
                                        Expirada há {{ abs($diasRestantes) }} {{ abs($diasRestantes) == 1 ? 'dia' : 'dias' }}
                                    </p>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($isActive)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Ativa
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Expirada
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-center gap-2">
                                <a href="/anuncio/{{ $anuncio->id }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="/candidatos-anuncio/{{ $anuncio->id }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver Candidatos">
                                    <i class="fas fa-users"></i>
                                </a>
                                
                                <button onclick="apagarAnuncio({{ $anuncio->id }}, '{{ $anuncio->titulo }}')"
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
    $('#vagas-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json',
        },
        pageLength: 25,
        order: [[4, 'desc']], // Order by validade (date) descending
        responsive: true,
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4"lf>rtip',
    });
});

function apagarAnuncio(anuncioId, titulo) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const message = document.getElementById('deleteMessage');
    
    message.textContent = `Tem certeza que deseja eliminar a vaga "${titulo}"? Esta ação não pode ser desfeita e todas as candidaturas associadas serão perdidas.`;
    form.action = `/apagarAnuncio/${anuncioId}`;
    
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

