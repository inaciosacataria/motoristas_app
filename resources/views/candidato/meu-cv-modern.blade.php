@extends('layouts.modern')

@section('title', 'Meu CV')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-8">
    <div class="container-custom">
        <h1 class="text-3xl font-bold">Meu Currículo</h1>
        <p class="text-primary-100 mt-1">Mantenha seu perfil atualizado para aumentar suas chances</p>
    </div>
</div>

<div class="container-custom py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Progress -->
        <div class="lg:col-span-1">
            <div class="card sticky top-4">
                <div class="card-body text-center">
                    <div class="relative inline-block mb-4">
                        @if(Auth::user()->foto_url && Auth::user()->foto_url != 'none')
                            <img src="{{ Auth::user()->foto_url }}" alt="{{ $candidato->nome }}" class="avatar avatar-xl mx-auto ring-4 ring-primary-100">
                        @else
                            <div class="avatar avatar-xl mx-auto bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white text-3xl font-bold ring-4 ring-primary-100">
                                {{ substr($candidato->nome, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="font-bold text-gray-900">{{ $candidato->nome }}</h3>
                    <p class="text-sm text-gray-600">{{ $candidato->categoria }}</p>
                    
                    <!-- Progress -->
                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Completude</span>
                            <span class="text-sm font-bold text-primary-600">{{ $progress }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    
                    <!-- Checklist -->
                    <div class="text-left space-y-2 mt-6 text-sm">
                        <div class="flex items-center justify-between">
                            <span><i class="fas fa-user mr-2 text-primary-600"></i> Dados</span>
                            <i class="fas fa-check-circle text-primary-600"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <span><i class="fas fa-briefcase mr-2 text-primary-600"></i> Experiência</span>
                            @if($experiencias->count() > 0)
                                <i class="fas fa-check-circle text-primary-600"></i>
                            @else
                                <i class="fas fa-times-circle text-red-500"></i>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span><i class="fas fa-language mr-2 text-primary-600"></i> Idiomas</span>
                            @if($idiomas->count() > 0)
                                <i class="fas fa-check-circle text-primary-600"></i>
                            @else
                                <i class="fas fa-times-circle text-red-500"></i>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span><i class="fas fa-file-alt mr-2 text-primary-600"></i> Documentos</span>
                            @if($documentos->count() > 0)
                                <i class="fas fa-check-circle text-primary-600"></i>
                            @else
                                <i class="fas fa-times-circle text-red-500"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Adicionar Experiência -->
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-briefcase text-primary-600 mr-2"></i> Experiência Profissional
                        </h2>
                        <button onclick="openModal('add-experiencia-modal')" class="btn-primary text-sm">
                            <i class="fas fa-plus mr-1"></i> Adicionar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($experiencias->count() > 0)
                        <div class="space-y-4">
                            @foreach($experiencias as $exp)
                                @php
                                    // Compatibilidade entre estrutura antiga (inicio/fim/actividades_exercidas)
                                    // e a nova (data_inicio/data_fim/descricao)
                                    $inicio = $exp->data_inicio ?? $exp->inicio ?? null;
                                    $fim = $exp->data_fim ?? $exp->fim ?? null;
                                    $descricao = $exp->descricao ?? $exp->actividades_exercidas ?? null;
                                @endphp
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="font-semibold text-gray-900">{{ $exp->cargo ?? 'Motorista' }}</h4>
                                    <p class="text-gray-600">{{ $exp->empresa ?? 'Empresa' }}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $inicio ? \Carbon\Carbon::parse($inicio)->format('M Y') : 'N/A' }} -
                                        {{ $fim ? \Carbon\Carbon::parse($fim)->format('M Y') : 'Atual' }}
                                    </p>
                                    @if($descricao)
                                        <p class="text-gray-700 mt-2 text-sm">{{ $descricao }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-briefcase text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-600 mb-4">Adicione suas experiências profissionais</p>
                            <button onclick="openModal('add-experiencia-modal')" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i> Adicionar Experiência
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Adicionar Idioma -->
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-language text-primary-600 mr-2"></i> Idiomas
                        </h2>
                        <button onclick="openModal('add-idioma-modal')" class="btn-primary text-sm">
                            <i class="fas fa-plus mr-1"></i> Adicionar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($idiomas->count() > 0)
                        <div class="flex flex-wrap gap-3">
                            @foreach($idiomas as $idioma)
                                <span class="badge badge-info text-base py-2 px-4">
                                    {{ $idioma->idioma }} ({{ $idioma->nivel ?? 'Fluente' }})
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-language text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-600 mb-4">Adicione os idiomas que você fala</p>
                            <button onclick="openModal('add-idioma-modal')" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i> Adicionar Idioma
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Adicionar Documento -->
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-file-alt text-primary-600 mr-2"></i> Documentos
                        </h2>
                        <button onclick="openModal('add-documento-modal')" class="btn-primary text-sm">
                            <i class="fas fa-plus mr-1"></i> Adicionar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($documentos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($documentos as $doc)
                                @php
                                    // Campo correcto na BD é "ficheiro"; alguns registos antigos podem usar "documento"
                                    $path = $doc->ficheiro ?? $doc->documento ?? null;
                                @endphp
                                @if($path)
                                    <a href="{{ asset($path) }}" target="_blank" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-file-pdf text-2xl text-red-600"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-gray-900 truncate">{{ $doc->tipo ?? 'Documento' }}</p>
                                        </div>
                                    </a>
                                @else
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg opacity-60">
                                        <i class="fas fa-file-pdf text-2xl text-red-600"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-gray-900 truncate">{{ $doc->tipo ?? 'Documento' }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-file-alt text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-600 mb-4">Adicione seus documentos (CNH, BI, etc)</p>
                            <button onclick="openModal('add-documento-modal')" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i> Adicionar Documento
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adicionar Experiência -->
<x-modal id="add-experiencia-modal" title="Adicionar Experiência" size="lg">
    <form action="{{ route('addExperiencia') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
        
        <x-form.input name="empresa" label="Empresa" icon="building" placeholder="Nome da empresa" required />
        <x-form.input name="cargo" label="Cargo" icon="briefcase" placeholder="Ex: Motorista de Transporte" required />
        
        <div class="grid grid-cols-2 gap-4">
            <x-form.input name="data_inicio" label="Data Início" type="date" icon="calendar" required />
            <x-form.input name="data_fim" label="Data Fim" type="date" icon="calendar" />
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
            <textarea name="descricao" rows="3" class="input" placeholder="Descreva suas responsabilidades..."></textarea>
        </div>
        
        <div class="flex gap-3">
            <button type="button" onclick="closeModal('add-experiencia-modal')" class="btn-outline flex-1">Cancelar</button>
            <button type="submit" class="btn-primary flex-1"><i class="fas fa-check mr-2"></i> Salvar</button>
        </div>
    </form>
</x-modal>

<!-- Modal Adicionar Idioma -->
<x-modal id="add-idioma-modal" title="Adicionar Idioma">
    <form action="{{ route('addIdioma') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
        
        <x-form.input name="idioma" label="Idioma" icon="language" placeholder="Ex: Inglês" required />
        <x-form.select 
            name="nivel" 
            label="Nível" 
            icon="star"
            :options="['Básico' => 'Básico', 'Intermediário' => 'Intermediário', 'Avançado' => 'Avançado', 'Fluente' => 'Fluente']"
            required
        />
        
        <div class="flex gap-3">
            <button type="button" onclick="closeModal('add-idioma-modal')" class="btn-outline flex-1">Cancelar</button>
            <button type="submit" class="btn-primary flex-1"><i class="fas fa-check mr-2"></i> Salvar</button>
        </div>
    </form>
</x-modal>

<!-- Modal Adicionar Documento -->
<x-modal id="add-documento-modal" title="Adicionar Documento">
    <form action="{{ route('addDocumento') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
        
        <x-form.select 
            name="tipo" 
            label="Tipo de Documento" 
            icon="file-alt"
            :options="[
                'CNH' => 'Carta de Condução (CNH)', 
                'BI' => 'Bilhete de Identidade', 
                'CV' => 'Curriculum Vitae',
                'Certificado' => 'Certificado',
                'Outro' => 'Outro'
            ]"
            required
        />
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-upload mr-1"></i> Arquivo (PDF)
            </label>
            <input type="file" name="documento" accept="application/pdf" class="input" required>
            <p class="text-xs text-gray-500 mt-1">Tamanho máximo: 5MB</p>
        </div>
        
        <div class="flex gap-3">
            <button type="button" onclick="closeModal('add-documento-modal')" class="btn-outline flex-1">Cancelar</button>
            <button type="submit" class="btn-primary flex-1"><i class="fas fa-upload mr-2"></i> Enviar</button>
        </div>
    </form>
</x-modal>
@endsection

