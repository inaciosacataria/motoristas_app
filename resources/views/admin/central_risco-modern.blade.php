@extends('layouts.modern')

@section('title', 'Central de Risco de Motoristas')

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
        background: #dc2626 !important;
        color: white !important;
        border-color: #dc2626 !important;
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
        background-color: #fef2f2;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <nav class="text-sm mb-2">
                    <a href="/admin" class="text-red-100 hover:text-white transition">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <span class="text-red-200 mx-2">/</span>
                    <span class="text-white">Central de Risco</span>
                </nav>
                <h1 class="text-3xl font-bold">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Central de Risco de Motoristas
                </h1>
                <p class="text-red-100 mt-1">Sistema de registro e acompanhamento de denúncias</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold">{{ count($denuncias) }}</div>
                    <div class="text-sm text-red-100">Total de Denúncias</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="max-w-6xl mx-auto mb-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('erro') || session('error'))
        <div class="max-w-6xl mx-auto mb-6">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                    <p class="font-semibold">{{ session('erro') ?? session('error') }}</p>
                </div>
            </div>
        </div>
    @endif
    
    @php
        $confirmadas = collect($denuncias)->where('estado_denuncia', 'Confirmada')->count();
        $naoConfirmadas = collect($denuncias)->where('estado_denuncia', 'Não confirmada')->count();
        $recentes = collect($denuncias)->filter(function($denuncia) {
            return isset($denuncia->created_at) && 
                   \Carbon\Carbon::parse($denuncia->created_at)->isAfter(\Carbon\Carbon::now()->subDays(7));
        })->count();
    @endphp
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Denúncias</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($denuncias) }}</p>
                </div>
                <div class="bg-red-100 rounded-full p-3">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Confirmadas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $confirmadas }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Não Confirmadas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $naoConfirmadas }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Últimos 7 Dias</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $recentes }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
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
                        <i class="fas fa-list text-red-600 mr-2"></i>
                        Lista de Denúncias
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Registros e ocorrências reportadas</p>
                </div>
                <div class="flex gap-2">
                    @if(Auth::check() && (Auth::user()->privilegio == 'empregador' || Auth::user()->privilegio == 'admin'))
                    <button onclick="openDenunciaModal()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors font-semibold">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Denunciar Motorista
                    </button>
                    @endif
                    <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i>
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="p-6 overflow-x-auto">
            <table id="denuncias-table" class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Motorista</th>
                        <th class="text-left">Carta de Condução</th>
                        <th class="text-left">Categoria</th>
                        <th class="text-left">Província</th>
                        <th class="text-left">Infração</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($denuncias as $denuncia)
                    <tr class="border-b border-gray-200 hover:bg-red-50 transition-colors">
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($denuncia->nome_motorista, 0, 1) }}
                                </div>
                                <div>
                                    <a href="{{ route('denuncia', $denuncia->id) }}" 
                                       class="font-semibold text-gray-900 hover:text-red-600 transition-colors">
                                        {{ $denuncia->nome_motorista }}
                                    </a>
                                    @if($denuncia->celular_motorista)
                                        <p class="text-xs text-gray-500">{{ $denuncia->celular_motorista }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">
                                {{ $denuncia->cartadeconducao_motorista ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="py-4 px-2">
                            <span class="text-sm text-gray-700">
                                {{ $denuncia->Categoria_motorista ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="py-4 px-2">
                            <span class="text-sm text-gray-700">
                                {{ $denuncia->provincia_motorista ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="py-4 px-2">
                            <div class="max-w-xs">
                                <p class="text-sm text-gray-900 truncate" title="{{ $denuncia->infracao }}">
                                    {{ $denuncia->infracao ?? 'Não especificada' }}
                                </p>
                            </div>
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($denuncia->estado_denuncia == 'Confirmada')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Confirmada
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Não Confirmada
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($denuncia->created_at)
                                <div class="text-sm">
                                    <p class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($denuncia->created_at)->format('d/m/Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($denuncia->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('denuncia', $denuncia->id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <button onclick="verDetalhesRapidos({{ json_encode($denuncia) }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors"
                                        title="Informações Rápidas">
                                    <i class="fas fa-info-circle"></i>
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

<!-- Modal Denunciar Motorista -->
<div id="denunciaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full my-8 animate-fade-in max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 bg-red-50">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                    Denunciar Motorista
                </h3>
                <button onclick="closeDenunciaModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <p class="text-sm text-gray-600 mt-2">Você pode denunciar motoristas cadastrados ou não cadastrados na plataforma</p>
        </div>
        
        <form action="{{ route('denunciar') }}" method="POST" class="p-6">
            @csrf
            
            <!-- Informações do Motorista -->
            <div class="mb-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user text-red-600 mr-2"></i>
                    Dados do Motorista
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nome_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nome Completo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nome_motorista" id="nome_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               placeholder="Nome completo do motorista" required>
                    </div>
                    
                    <div>
                        <label for="cartadeconducao_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Carta de Condução <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="cartadeconducao_motorista" id="cartadeconducao_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               placeholder="Número da carta de condução" required>
                    </div>
                    
                    <div>
                        <label for="datanascismento_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Data de Nascimento
                        </label>
                        <input type="date" name="datanascismento_motorista" id="datanascismento_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    
                    <div>
                        <label for="celular_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Contacto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="celular_motorista" id="celular_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               placeholder="84XXXXXXX" required>
                    </div>
                    
                    <div>
                        <label for="Categoria_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Categoria
                        </label>
                        <select name="Categoria_motorista" id="Categoria_motorista" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Selecione...</option>
                            <option value="A">A - Motociclo</option>
                            <option value="B">B - Ligeiro</option>
                            <option value="C">C - Pesado</option>
                            <option value="D">D - Passageiros</option>
                            <option value="E">E - Reboque</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="nacionalidade_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nacionalidade
                        </label>
                        <input type="text" name="nacionalidade_motorista" id="nacionalidade_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               placeholder="Ex: Moçambicana">
                    </div>
                    
                    <div>
                        <label for="provincia_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Província
                        </label>
                        <input type="text" name="provincia_motorista" id="provincia_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               placeholder="Ex: Maputo">
                    </div>
                    
                    <div>
                        <label for="endereco_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                            Endereço
                        </label>
                        <input type="text" name="endereco_motorista" id="endereco_motorista" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               placeholder="Endereço completo">
                    </div>
                </div>
            </div>
            
            <!-- Informações da Denúncia -->
            <div class="mb-6 border-t border-gray-200 pt-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                    Detalhes da Denúncia
                </h4>
                
                <div class="mb-4">
                    <label for="funcoes_do_candidato" class="block text-sm font-semibold text-gray-700 mb-2">
                        Funções Desempenhadas
                    </label>
                    <textarea name="funcoes_do_candidato" id="funcoes_do_candidato" rows="3" 
                              class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                              placeholder="Descreva as funções que o motorista desempenhava..."></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="infracao" class="block text-sm font-semibold text-gray-700 mb-2">
                        Infração/Problema Reportado <span class="text-red-500">*</span>
                    </label>
                    <textarea name="infracao" id="infracao" rows="4" 
                              class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                              placeholder="Descreva detalhadamente a infração ou problema ocorrido..." required></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="merece_portunidade" class="block text-sm font-semibold text-gray-700 mb-2">
                            Merece Segunda Oportunidade? <span class="text-red-500">*</span>
                        </label>
                        <select name="merece_portunidade" id="merece_portunidade" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                            <option value="">Selecione...</option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-4">
                    <label for="versao_motorista" class="block text-sm font-semibold text-gray-700 mb-2">
                        Versão do Motorista (se houver)
                    </label>
                    <textarea name="versao_motorista" id="versao_motorista" rows="3" 
                              class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                              placeholder="Versão do motorista sobre o ocorrido (opcional)..."></textarea>
                </div>
            </div>
            
            <!-- Alert -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-yellow-800 font-semibold mb-1">Atenção</p>
                        <p class="text-sm text-yellow-700">Esta denúncia será registrada na Central de Risco e será analisada pelos administradores. Certifique-se de que todas as informações estão corretas.</p>
                    </div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="flex gap-3">
                <button type="button" onclick="closeDenunciaModal()" 
                        class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition-colors">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors">
                    <i class="fas fa-paper-plane mr-2"></i> Enviar Denúncia
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Quick Details Modal -->
<div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full animate-fade-in max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 bg-red-50">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                    Detalhes da Denúncia
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
    $('#denuncias-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json',
        },
        pageLength: 25,
        order: [[6, 'desc']], // Order by date descending
        responsive: true,
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4"lf>rtip',
    });
});

function verDetalhesRapidos(denuncia) {
    const modal = document.getElementById('detailsModal');
    const content = document.getElementById('modalContent');
    
    const statusBadge = denuncia.estado_denuncia === 'Confirmada' 
        ? '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i> Confirmada</span>'
        : '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i> Não Confirmada</span>';
    
    const merecedorBadge = denuncia.merece_portunidade === 'Sim'
        ? '<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Sim</span>'
        : '<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">Não</span>';
    
    content.innerHTML = `
        <div class="space-y-6">
            <!-- Status -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h4 class="font-semibold text-gray-900">Status da Denúncia</h4>
                ${statusBadge}
            </div>
            
            <!-- Informações do Motorista -->
            <div>
                <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-user text-red-600 mr-2"></i>
                    Dados do Motorista
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Nome</p>
                        <p class="font-semibold text-gray-900">${denuncia.nome_motorista}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Carta de Condução</p>
                        <p class="font-mono text-sm text-gray-900">${denuncia.cartadeconducao_motorista || 'N/A'}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Categoria</p>
                        <p class="text-gray-900">${denuncia.Categoria_motorista || 'N/A'}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Província</p>
                        <p class="text-gray-900">${denuncia.provincia_motorista || 'N/A'}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Contacto</p>
                        <p class="text-gray-900">${denuncia.celular_motorista || 'N/A'}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Nacionalidade</p>
                        <p class="text-gray-900">${denuncia.nacionalidade_motorista || 'N/A'}</p>
                    </div>
                </div>
            </div>
            
            <!-- Infração -->
            <div>
                <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                    Infração Reportada
                </h4>
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                    <p class="text-gray-900">${denuncia.infracao || 'Não especificada'}</p>
                </div>
            </div>
            
            <!-- Funções e Avaliação -->
            ${denuncia.funcoes_do_candidato ? `
            <div>
                <h4 class="font-semibold text-gray-900 mb-3">Funções Desempenhadas</h4>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-gray-900">${denuncia.funcoes_do_candidato}</p>
                </div>
            </div>
            ` : ''}
            
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Merece Oportunidade?</p>
                    ${merecedorBadge}
                </div>
            </div>
            
            <!-- Versão do Motorista -->
            ${denuncia.versao_motorista ? `
            <div>
                <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-comment text-blue-600 mr-2"></i>
                    Versão do Motorista
                </h4>
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                    <p class="text-gray-900">${denuncia.versao_motorista}</p>
                </div>
            </div>
            ` : ''}
        </div>
        
        <div class="mt-6 flex gap-3 pt-4 border-t">
            <a href="/denuncia/${denuncia.id}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                <i class="fas fa-eye mr-2"></i>
                Ver Detalhes Completos
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

// Denuncia Modal Functions
function openDenunciaModal() {
    const modal = document.getElementById('denunciaModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDenunciaModal() {
    const modal = document.getElementById('denunciaModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close denuncia modal on ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDenunciaModal();
    }
});

// Close denuncia modal on outside click
document.getElementById('denunciaModal')?.addEventListener('click', function(event) {
    if (event.target === this) {
        closeDenunciaModal();
    }
});
</script>
@endpush

