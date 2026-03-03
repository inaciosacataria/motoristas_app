@extends('layouts.modern')

@section('title', 'Candidaturas da Vaga')

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
                    <a href="/empregador" class="text-green-100 hover:text-white transition">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <span class="text-green-200 mx-2">/</span>
                    <span class="text-white">Candidaturas</span>
                </nav>
                <h1 class="text-3xl font-bold">
                    {{ $anuncio ? $anuncio->titulo : 'Candidaturas da Vaga' }}
                </h1>
                <p class="text-green-100 mt-1">
                    {{ count($candidaturas) }} {{ count($candidaturas) == 1 ? 'candidatura recebida' : 'candidaturas recebidas' }}
                </p>
            </div>
            <div class="hidden md:block">
                <a href="/empregador" class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg font-semibold transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    
    <!-- Stats Cards -->
    @php
        $comCV = collect($candidaturas)->filter(fn($c) => !empty($c->cv))->count();
        $semCV = count($candidaturas) - $comCV;
        $ultimaSemana = collect($candidaturas)->filter(function($c) {
            return isset($c->created_at) && 
                   \Carbon\Carbon::parse($c->created_at)->isAfter(\Carbon\Carbon::now()->subDays(7));
        })->count();
    @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Candidaturas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($candidaturas) }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-users text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Com CV</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $comCV }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-file-pdf text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Sem CV</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $semCV }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-exclamation-triangle text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Última Semana</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $ultimaSemana }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-calendar-week text-2xl text-purple-600"></i>
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
                        Lista de Candidatos
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Visualize todos os candidatos interessados nesta vaga</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('gerarPdfCandidatos', $anuncio->slug ?? $anuncio->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors no-underline">
                        <i class="fas fa-print mr-2"></i>
                        Imprimir / PDF
                    </a>
                    <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i>
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="p-6 overflow-x-auto">
            @if(count($candidaturas) > 0)
                <table id="candidatos-table" class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="text-left">#</th>
                            <th class="text-left">Candidato</th>
                            <th class="text-left">Habilitação</th>
                            <th class="text-center">Idade</th>
                            <th class="text-left">Grau Acadêmico</th>
                            <th class="text-left">Província</th>
                            <th class="text-left">Contacto</th>
                            <th class="text-center">Data Candidatura</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidaturas as $key => $motorista)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-2 text-center font-semibold text-gray-600">
                                {{ $key + 1 }}
                            </td>
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
                                        <p class="text-xs text-gray-500">{{ $motorista->nacionalidade }}</p>
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
                            <td class="py-4 px-2 text-center">
                                <span class="text-gray-700 font-medium">
                                    {{ \Carbon\Carbon::parse($motorista->datanascimento)->age }} anos
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
                            <td class="py-4 px-2 text-center">
                                @if($motorista->created_at)
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($motorista->created_at)->format('d/m/Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($motorista->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('perfil', $motorista->user_id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors"
                                       title="Ver Perfil Completo">
                                        <i class="fas fa-user"></i>
                                    </a>
                                    
                                    @if($motorista->cv)
                                        <a href="/{{ $motorista->cv }}" target="_blank"
                                           class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition-colors"
                                           title="Ver CV">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 bg-gray-300 text-gray-500 text-sm rounded-lg cursor-not-allowed"
                                              title="Sem CV">
                                            <i class="fas fa-file-pdf"></i>
                                        </span>
                                    @endif
                                    
                                    <a href="tel:{{ $motorista->celular }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-purple-500 hover:bg-purple-600 text-white text-sm rounded-lg transition-colors"
                                       title="Ligar">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-users text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhuma candidatura ainda</h3>
                    <p class="text-gray-600 mb-6">Esta vaga ainda não recebeu candidaturas.</p>
                    <a href="/empregador" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar ao Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#candidatos-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json',
        },
        pageLength: 25,
        order: [[7, 'desc']], // Order by date descending
        responsive: true,
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4"lf>rtip',
    });
});
</script>
@endpush

