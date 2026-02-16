@extends('layouts.modern')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Painel Administrativo</h1>
        <p class="text-green-100 mt-1">Gestão completa do sistema</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total de Motoristas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $countMotoritas }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total de Empresas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $countEmpregador }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-building text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Vagas Ativas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $anunciosDentroDoPrazo }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-briefcase text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Central de Risco</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $countCentralRisco }}</p>
                </div>
                <div class="bg-red-100 rounded-full p-3">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="/bd-motoristas" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-all hover:-translate-y-1">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Gestão de Motoristas</h3>
                <p class="text-gray-600 text-sm">Ver e gerenciar todos os motoristas</p>
            </div>
        </a>

        <a href="/bd-empregadores" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-all hover:-translate-y-1">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-building text-2xl text-green-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Gestão de Empresas</h3>
                <p class="text-gray-600 text-sm">Aprovar e gerenciar empregadores</p>
            </div>
        </a>

        <a href="/anuncios" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-all hover:-translate-y-1">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-briefcase text-2xl text-green-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Gestão de Vagas</h3>
                <p class="text-gray-600 text-sm">Moderar e gerenciar anúncios</p>
            </div>
        </a>

        <a href="/premium" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-all hover:-translate-y-1">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                    <i class="fas fa-crown text-2xl text-yellow-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Contas Premium</h3>
                <p class="text-gray-600 text-sm">Gerenciar assinaturas premium</p>
            </div>
        </a>

        <a href="/centralRisco" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-all hover:-translate-y-1">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Central de Risco</h3>
                <p class="text-gray-600 text-sm">Ver denúncias e ocorrências</p>
            </div>
        </a>

        <a href="/" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-all hover:-translate-y-1">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                    <i class="fas fa-globe text-2xl text-purple-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Ver Portal</h3>
                <p class="text-gray-600 text-sm">Ver como usuário</p>
            </div>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Latest Motoristas -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-user-clock text-green-600 mr-2"></i> Motoristas Recentes
                    </h2>
                    <a href="/bd-motoristas" class="text-green-600 hover:text-green-700 text-sm font-medium">
                        Ver todos <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($motoristas->count() > 0)
                    <div class="space-y-3">
                        @foreach($motoristas as $candidato)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($candidato->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $candidato->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $candidato->categoria }} - {{ $candidato->provincia }}</p>
                                </div>
                                <a href="/perfil/{{ $candidato->user_id }}" class="text-green-600 hover:text-green-700">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-4">Nenhum motorista registrado</p>
                @endif
            </div>
        </div>

        <!-- Latest Empresas -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-building text-green-600 mr-2"></i> Empresas Recentes
                    </h2>
                    <a href="/bd-empregadores" class="text-green-600 hover:text-green-700 text-sm font-medium">
                        Ver todas <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($empregadores->count() > 0)
                    <div class="space-y-3">
                        @foreach($empregadores as $empregador)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $empregador->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $empregador->email }}</p>
                                </div>
                                @if($empregador->active === 'desativado')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Pendente</span>
                                @else
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Ativo</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-4">Nenhuma empresa registrada</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="mt-8 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">
            <i class="fas fa-chart-bar text-green-600 mr-2"></i> Estatísticas dos Últimos 30 Dias
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $last30motoristas }}</div>
                <div class="text-sm text-gray-600">Novos Motoristas</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $last30empregador }}</div>
                <div class="text-sm text-gray-600">Novas Empresas</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-red-600">{{ $last30denuncias }}</div>
                <div class="text-sm text-gray-600">Denúncias</div>
            </div>
        </div>
    </div>
</div>
@endsection

