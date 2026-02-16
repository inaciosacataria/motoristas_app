@extends('layouts.modern')

@section('title', 'Gestão de Contas Premium')

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
<div class="bg-gradient-to-r from-yellow-600 to-yellow-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <nav class="text-sm mb-2">
                    <a href="/admin" class="text-yellow-100 hover:text-white transition">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <span class="text-yellow-200 mx-2">/</span>
                    <span class="text-white">Gestão de Contas Premium</span>
                </nav>
                <h1 class="text-3xl font-bold">
                    <i class="fas fa-crown mr-2"></i>
                    Gestão de Contas Premium
                </h1>
                <p class="text-yellow-100 mt-1">Gerencie assinaturas e benefícios premium</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold">{{ count($users) }}</div>
                    <div class="text-sm text-yellow-100">Total de Empresas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    
    @php
        $premiumUsers = collect($users)->filter(fn($user) => $user->is_premium === 'yes')->count();
        $freeUsers = collect($users)->filter(fn($user) => $user->is_premium !== 'yes')->count();
        $premiumRecent = collect($users)->filter(function($user) {
            return $user->is_premium === 'yes' && 
                   isset($user->premium_date) && 
                   \Carbon\Carbon::parse($user->premium_date)->isAfter(\Carbon\Carbon::now()->subDays(30));
        })->count();
    @endphp
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Contas Premium</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $premiumUsers }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-crown text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Contas Gratuitas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $freeUsers }}</p>
                </div>
                <div class="bg-gray-100 rounded-full p-3">
                    <i class="fas fa-user text-2xl text-gray-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Novos Premium (30d)</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $premiumRecent }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-arrow-up text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Taxa Conversão</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ count($users) > 0 ? round(($premiumUsers / count($users)) * 100, 1) : 0 }}%
                    </p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-chart-line text-2xl text-blue-600"></i>
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
                        <i class="fas fa-building text-yellow-600 mr-2"></i>
                        Lista de Empresas
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Gerencie o status premium das empresas cadastradas</p>
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
            <table id="premium-table" class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Empresa</th>
                        <th class="text-left">Email</th>
                        <th class="text-center">Status Conta</th>
                        <th class="text-center">Data Premium</th>
                        <th class="text-center">Créditos</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                @if($user->foto_url && $user->foto_url != 'none')
                                    <img src="{{ $user->foto_url }}" alt="{{ $user->name }}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('empregador-perfil', $user->user_id) }}" 
                                       class="font-semibold text-gray-900 hover:text-yellow-600 transition-colors">
                                        {{ $user->name }}
                                    </a>
                                    <p class="text-xs text-gray-500">ID: {{ $user->user_id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <a href="mailto:{{ $user->email }}" class="text-green-600 hover:text-green-700">
                                <i class="fas fa-envelope mr-1"></i>
                                {{ $user->email }}
                            </a>
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($user->is_premium == 'yes')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-crown mr-1"></i>
                                    Premium
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-700">
                                    <i class="fas fa-user mr-1"></i>
                                    Gratuito
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($user->is_premium == 'yes' && $user->premium_date)
                                <div class="text-sm">
                                    <p class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($user->premium_date)->format('d/m/Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($user->premium_date)->diffForHumans() }}
                                    </p>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($user->is_premium == 'yes')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $user->premium_count ?? 0 }} créditos
                                </span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('empregador-perfil', $user->user_id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors"
                                   title="Ver Perfil">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($user->is_premium == 'yes')
                                    <button onclick="alterarPlano({{ $user->user_id }}, '{{ $user->name }}', 'desativar')"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors"
                                            title="Remover Premium">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                @else
                                    <button onclick="alterarPlano({{ $user->user_id }}, '{{ $user->name }}', 'ativar')"
                                            class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-lg transition-colors"
                                            title="Ativar Premium">
                                        <i class="fas fa-crown"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Change Plan Modal -->
<div id="planModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full animate-fade-in">
        <div class="p-6">
            <div id="modalIcon" class="flex items-center justify-center w-12 h-12 mx-auto rounded-full mb-4">
                <i id="modalIconClass" class="text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2" id="modalTitle"></h3>
            <p class="text-center text-gray-600 mb-6" id="modalMessage"></p>
            <div class="flex gap-3">
                <button onclick="closePlanModal()" 
                        class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancelar
                </button>
                <form id="planForm" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="id" id="userId">
                    <button type="submit" id="modalButton"
                            class="w-full px-4 py-2 text-white rounded-lg transition-colors">
                        Confirmar
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
    $('#premium-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json',
        },
        pageLength: 25,
        order: [[2, 'desc']], // Order by status (premium first)
        responsive: true,
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4"lf>rtip',
    });
});

function alterarPlano(userId, userName, action) {
    const modal = document.getElementById('planModal');
    const form = document.getElementById('planForm');
    const userIdInput = document.getElementById('userId');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalIcon = document.getElementById('modalIcon');
    const modalIconClass = document.getElementById('modalIconClass');
    const modalButton = document.getElementById('modalButton');
    
    userIdInput.value = userId;
    
    if (action === 'ativar') {
        form.action = '{{ route("activarcontapremium") }}';
        modalTitle.textContent = 'Ativar Conta Premium';
        modalMessage.textContent = `Deseja ativar o plano Premium para "${userName}"? A empresa terá acesso a todos os recursos premium.`;
        modalIcon.className = 'flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full mb-4';
        modalIconClass.className = 'fas fa-crown text-2xl text-yellow-600';
        modalButton.className = 'w-full px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors';
        modalButton.textContent = 'Ativar Premium';
    } else {
        form.action = '{{ route("desativarpremiumconta") }}';
        modalTitle.textContent = 'Remover Conta Premium';
        modalMessage.textContent = `Deseja remover o plano Premium de "${userName}"? A empresa perderá o acesso aos recursos premium.`;
        modalIcon.className = 'flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4';
        modalIconClass.className = 'fas fa-exclamation-triangle text-2xl text-red-600';
        modalButton.className = 'w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors';
        modalButton.textContent = 'Remover Premium';
    }
    
    modal.classList.remove('hidden');
}

function closePlanModal() {
    const modal = document.getElementById('planModal');
    modal.classList.add('hidden');
}

// Close modal on ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closePlanModal();
    }
});

// Close modal on outside click
document.getElementById('planModal')?.addEventListener('click', function(event) {
    if (event.target === this) {
        closePlanModal();
    }
});
</script>
@endpush

