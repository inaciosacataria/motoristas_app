@extends('layouts.modern')

@section('title', 'Base de Dados de Empregadores')

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
                    <span class="text-white">Base de Dados de Empregadores</span>
                </nav>
                <h1 class="text-3xl font-bold">Base de Dados de Empregadores</h1>
                <p class="text-green-100 mt-1">Gestão completa de todas as empresas registradas</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold">{{ $empregadores->total() }}</div>
                    <div class="text-sm text-green-100">Total de Empresas</div>
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
                    <p class="text-gray-600 text-sm">Contas Ativas</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $empregadores->where('active', 'activo')->count() }}
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Pendentes</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $empregadores->where('active', 'desativado')->count() }}
                    </p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Geral</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $empregadores->total() }}
                    </p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-building text-2xl text-blue-600"></i>
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
                        <i class="fas fa-building text-green-600 mr-2"></i>
                        Lista de Empregadores
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Visualize e gerencie todas as empresas cadastradas</p>
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
            <table id="empregadores-table" class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Empresa</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Contacto</th>
                        <th class="text-left">Website</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empregadores as $empregador)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                @if($empregador->foto_url && $empregador->foto_url != 'none')
                                    <img src="{{ $empregador->foto_url }}" alt="{{ $empregador->name }}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($empregador->name ?? $empregador->empresa, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $empregador->name ?? $empregador->empresa }}
                                    </p>
                                    @if($empregador->empresa && $empregador->name != $empregador->empresa)
                                        <p class="text-xs text-gray-500">{{ $empregador->empresa }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <a href="mailto:{{ $empregador->email }}" class="text-green-600 hover:text-green-700">
                                <i class="fas fa-envelope mr-1"></i>
                                {{ $empregador->email }}
                            </a>
                        </td>
                        <td class="py-4 px-2">
                            <a href="tel:{{ $empregador->celular }}" class="text-green-600 hover:text-green-700 font-medium">
                                <i class="fas fa-phone mr-1"></i>
                                {{ $empregador->celular }}
                            </a>
                        </td>
                        <td class="py-4 px-2">
                            @if($empregador->website)
                                <a href="{{ $empregador->website }}" target="_blank" class="text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-globe mr-1"></i>
                                    <span class="text-sm">Visitar</span>
                                </a>
                            @else
                                <span class="text-gray-400 text-sm">N/A</span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-center">
                            @php $estaAprovado = ($empregador->estado ?? '') === 'Aprovado'; @endphp
                            @if($estaAprovado && $empregador->active == 'activo')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Aprovado
                                </span>
                            @elseif(($empregador->estado ?? '') === 'Rejeitado')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Rejeitado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Pendente aprovação
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-center gap-2">
                                @if(($empregador->estado ?? 'Pendente') !== 'Aprovado')
                                    <a href="{{ route('aprovarEmpregador', $empregador->user_id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition-colors"
                                       title="Aprovar Empresa"
                                       onclick="return confirm('Tem certeza que deseja aprovar esta empresa?')">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="{{ route('rejeitarEmpregador', $empregador->user_id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors"
                                       title="Rejeitar Empresa"
                                       onclick="return confirm('Tem certeza que deseja rejeitar esta empresa?')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @else
                                    <a href="{{ route('desactiveUser', $empregador->user_id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-lg transition-colors"
                                       title="Desativar Conta">
                                        <i class="fas fa-pause"></i>
                                    </a>
                                @endif
                                
                                <a href="{{ route('empregador-perfil', $empregador->user_id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver Perfil">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <button onclick="verDetalhes({{ json_encode($empregador) }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-purple-500 hover:bg-purple-600 text-white text-sm rounded-lg transition-colors"
                                        title="Ver Detalhes">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $empregadores->links() }}
        </div>
    </div>
</div>

<!-- Details Modal -->
<div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full animate-fade-in max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-building text-green-600 mr-2"></i>
                    Detalhes da Empresa
                </h3>
                <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div class="p-6" id="modalContent">
            <!-- Content will be injected here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#empregadores-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json',
        },
        pageLength: 25,
        order: [[0, 'asc']],
        responsive: true,
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4"lf>rtip',
    });
});

function verDetalhes(empregador) {
    const modal = document.getElementById('detailsModal');
    const content = document.getElementById('modalContent');
    
    const logoHtml = empregador.foto_url && empregador.foto_url !== 'none' 
        ? `<img src="${empregador.foto_url}" alt="${empregador.name}" class="w-24 h-24 rounded-full object-cover mx-auto mb-4">`
        : `<div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4">${empregador.name.charAt(0)}</div>`;
    
    content.innerHTML = `
        <div class="text-center mb-6">
            ${logoHtml}
            <h4 class="text-2xl font-bold text-gray-900">${empregador.name || empregador.empresa}</h4>
            ${empregador.accounttype === 'yes' ? '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 mt-2"><i class="fas fa-crown mr-1"></i> Premium</span>' : ''}
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Email</p>
                <p class="font-semibold text-gray-900">${empregador.email}</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Contacto</p>
                <p class="font-semibold text-gray-900">${empregador.celular}</p>
            </div>
            
            ${empregador.website ? `
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Website</p>
                <a href="${empregador.website}" target="_blank" class="font-semibold text-green-600 hover:text-green-700">${empregador.website}</a>
            </div>
            ` : ''}
            
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Status</p>
                <p class="font-semibold ${empregador.active === 'activo' ? 'text-green-600' : 'text-yellow-600'}">
                    ${empregador.active === 'activo' ? 'Ativo' : 'Pendente'}
                </p>
            </div>
            
            ${empregador.accounttype === 'yes' && empregador.premium_count ? `
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Créditos Premium</p>
                <p class="font-semibold text-gray-900">${empregador.premium_count}</p>
            </div>
            ` : ''}
        </div>
        
        ${empregador.sobre ? `
        <div class="mt-6 bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-600 mb-2">Sobre a Empresa</p>
            <p class="text-gray-900">${empregador.sobre}</p>
        </div>
        ` : ''}
        
        <div class="mt-6 flex gap-3">
            <a href="/empregador-perfil/${empregador.user_id}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                <i class="fas fa-eye mr-2"></i>
                Ver Perfil Completo
            </a>
            <button onclick="closeDetailsModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                Fechar
            </button>
        </div>
    `;
    
    modal.classList.remove('hidden');
}

function closeDetailsModal() {
    const modal = document.getElementById('detailsModal');
    modal.classList.add('hidden');
}

// Close modal on ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDetailsModal();
    }
});

// Close modal on outside click
document.getElementById('detailsModal')?.addEventListener('click', function(event) {
    if (event.target === this) {
        closeDetailsModal();
    }
});
</script>
@endpush

