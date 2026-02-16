@extends('layouts.modern')

@section('title', 'Perfil do Candidato')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-16">
    <div class="container-custom">
        <div class="flex items-center gap-6">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                @if($candidato->foto_url && $candidato->foto_url != 'none')
                    <img src="{{ $candidato->foto_url }}" alt="{{ $candidato->nome }}" 
                         class="w-32 h-32 rounded-full ring-4 ring-white shadow-xl object-cover">
                @else
                    <div class="w-32 h-32 rounded-full ring-4 ring-white shadow-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <span class="text-5xl font-bold">{{ substr($candidato->nome, 0, 1) }}</span>
                    </div>
                @endif
            </div>
            
            <div class="flex-1">
                <h1 class="text-4xl font-bold mb-2">{{ $candidato->nome }}</h1>
                <div class="flex flex-wrap gap-4 text-primary-100">
                    <span><i class="fas fa-car mr-2"></i>{{ $candidato->categoria }}</span>
                    <span><i class="fas fa-map-marker-alt mr-2"></i>{{ $candidato->provincia }}</span>
                    <span><i class="fas fa-phone mr-2"></i>{{ $candidato->celular }}</span>
                    <span><i class="fas fa-envelope mr-2"></i>{{ $candidato->email }}</span>
                </div>
                
                <!-- Progress Bar -->
                <div class="mt-4 max-w-md">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-primary-100">Perfil Completo</span>
                        <span class="text-sm font-bold">{{ $progress }}%</span>
                    </div>
                    <div class="h-3 bg-white/20 rounded-full overflow-hidden">
                        <div class="h-full bg-white rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-custom py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Contact Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-900">
                        <i class="fas fa-user text-primary-600 mr-2"></i> Informações Pessoais
                    </h3>
                </div>
                <div class="card-body space-y-3 text-sm">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-phone text-primary-600 mt-1"></i>
                        <div>
                            <p class="text-gray-600">Celular</p>
                            <p class="font-semibold text-gray-900">{{ $candidato->celular }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-envelope text-primary-600 mt-1"></i>
                        <div>
                            <p class="text-gray-600">Email</p>
                            <p class="font-semibold text-gray-900">{{ $candidato->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-primary-600 mt-1"></i>
                        <div>
                            <p class="text-gray-600">Localização</p>
                            <p class="font-semibold text-gray-900">{{ $candidato->provincia }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-car text-primary-600 mt-1"></i>
                        <div>
                            <p class="text-gray-600">Categoria</p>
                            <p class="font-semibold text-gray-900">{{ $candidato->categoria }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-body space-y-2">
                    <a href="/" class="btn-primary w-full">
                        <i class="fas fa-search mr-2"></i> Ver Vagas Disponíveis
                    </a>
                    @auth
                        @if(Auth::user()->privilegio === 'empregador')
                            <button onclick="openModal('denunciar-modal-{{ $candidato->candidato_id }}')" class="btn-outline w-full border-red-500 text-red-600 hover:bg-red-50">
                                <i class="fas fa-flag mr-2"></i> Reportar
                            </button>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Experiências -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-briefcase text-primary-600 mr-2"></i> Experiência Profissional
                    </h2>
                </div>
                <div class="card-body">
                    @if($experiencias->count() > 0)
                        <div class="space-y-4">
                            @foreach($experiencias as $exp)
                                <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0">
                                    <div class="flex-shrink-0 w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-building text-primary-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">{{ $exp->cargo ?? 'Motorista' }}</h4>
                                        <p class="text-gray-600">{{ $exp->empresa ?? 'Empresa' }}</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $exp->data_inicio ? \Carbon\Carbon::parse($exp->data_inicio)->format('Y') : 'N/A' }} - 
                                            {{ $exp->data_fim ? \Carbon\Carbon::parse($exp->data_fim)->format('Y') : 'Presente' }}
                                        </p>
                                        @if($exp->descricao)
                                            <p class="text-gray-700 mt-2 text-sm">{{ $exp->descricao }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-briefcase text-4xl mb-2 opacity-50"></i>
                            <p>Nenhuma experiência registrada</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Idiomas -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-language text-primary-600 mr-2"></i> Idiomas
                    </h2>
                </div>
                <div class="card-body">
                    @if($idiomas->count() > 0)
                        <div class="flex flex-wrap gap-3">
                            @foreach($idiomas as $idioma)
                                <span class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg border border-blue-200">
                                    <i class="fas fa-comment mr-2"></i>
                                    {{ $idioma->idioma }} <span class="ml-2 text-xs">({{ $idioma->nivel ?? 'Fluente' }})</span>
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-language text-4xl mb-2 opacity-50"></i>
                            <p>Nenhum idioma registrado</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Documentos -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-file-alt text-primary-600 mr-2"></i> Documentos
                    </h2>
                </div>
                <div class="card-body">
                    @if($documentos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($documentos as $doc)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-file-pdf text-red-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-900 truncate">{{ $doc->tipo ?? 'Documento' }}</p>
                                        <p class="text-xs text-gray-500">PDF</p>
                                    </div>
                                    @if($doc->documento)
                                        <a href="{{ asset($doc->documento) }}" target="_blank" class="btn-ghost text-sm py-1 px-3">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-file-alt text-4xl mb-2 opacity-50"></i>
                            <p>Nenhum documento enviado</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Denúncia -->
@auth
    @if(Auth::user()->privilegio === 'empregador')
        <x-modal id="denunciar-modal-{{ $candidato->candidato_id }}" title="Reportar Motorista" size="md">
            <form action="{{ route('denunciar') }}" method="POST">
                @csrf
                <input type="hidden" name="candidato_id" value="{{ $candidato->candidato_id }}">
                <input type="hidden" name="empregador_id" value="{{ Auth::user()->id }}">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Motivo</label>
                        <textarea name="motivo" rows="4" class="input" placeholder="Descreva o motivo da denúncia..." required></textarea>
                    </div>
                    
                    <x-alert type="warning">
                        Esta ação será registrada na Central de Risco e poderá afetar a reputação do motorista.
                    </x-alert>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal('denunciar-modal-{{ $candidato->candidato_id }}')" class="btn-outline flex-1">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-6 rounded-lg flex-1">
                            <i class="fas fa-flag mr-2"></i> Enviar Denúncia
                        </button>
                    </div>
                </div>
            </form>
        </x-modal>
    @endif
@endauth
@endsection

