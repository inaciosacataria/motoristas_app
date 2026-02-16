@extends('layouts.modern')

@section('title', 'Dashboard Empregador')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Bem-vindo, {{ Auth::user()->name }}!</h1>
                <p class="text-green-100 mt-1">Gerencie suas vagas e candidatos</p>
            </div>
            <button onclick="openModal('criar-vaga-modal')" class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg border border-white font-semibold transition duration-200">
                <i class="fas fa-plus mr-2"></i> Criar Nova Vaga
            </button>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Área de Publicidade - Banner Horizontal Superior -->
    @if(isset($publicidades) && $publicidades->count() > 0)
        @foreach($publicidades->take(1) as $publicidade)
            @if($publicidade->adType == 'IMAGE' && $publicidade->image)
                <div class="mb-6 rounded-lg overflow-hidden shadow-md">
                    <a href="{{ $publicidade->imageUrl ?? '#' }}" target="_blank" rel="noopener noreferrer" onclick="trackAdClick('{{ $publicidade->slug }}')">
                        <img src="{{ asset('storage/' . $publicidade->image) }}" alt="{{ $publicidade->imageAlt ?? 'Publicidade' }}" class="w-full h-auto object-cover" style="max-height: 150px;">
                    </a>
                </div>
            @elseif($publicidade->adType == 'HTML' && $publicidade->body)
                <div class="mb-6">
                    {!! $publicidade->body !!}
                </div>
            @endif
        @endforeach
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total de Vagas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $anuncios ? $anuncios->total() : 0 }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-briefcase text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Candidaturas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCandidaturas ?? 0 }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Vagas Ativas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $vagasAtivas ?? 0 }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Expirando</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $vagasExpirando ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Minhas Vagas -->
    <div class="bg-white shadow-md rounded-lg mb-8">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-briefcase text-green-600 mr-2"></i> Minhas Vagas Publicadas
                </h2>
                <a href="/procurar-motorista" class="text-green-600 hover:text-green-700 text-sm font-medium">
                    <i class="fas fa-search mr-1"></i> Procurar Motoristas
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($anuncios && $anuncios->count() > 0)
                <div class="space-y-4">
                    @foreach($anuncios as $anuncio)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <!-- Logo da Empresa -->
                                <div class="flex-shrink-0 mr-4">
                                    @php
                                        $logoVaga = null;
                                        if (isset($anuncio->logotipo) && $anuncio->logotipo && $anuncio->logotipo != 'none') {
                                            $logoVaga = $anuncio->logotipo;
                                        } elseif (isset($anuncio->foto) && $anuncio->foto && $anuncio->foto != 'none') {
                                            $logoVaga = $anuncio->foto;
                                        }
                                    @endphp
                                    
                                    @if($logoVaga)
                                        <img src="{{ asset($logoVaga) }}" alt="{{ $anuncio->empresa ?? 'Empresa' }}" class="w-16 h-16 rounded-lg object-contain border border-gray-200" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="w-16 h-16 rounded-lg bg-green-100 flex items-center justify-center text-green-600 text-xl font-bold border border-gray-200" style="display: none;">
                                            {{ substr($anuncio->empresa ?? 'E', 0, 1) }}
                                        </div>
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-green-100 flex items-center justify-center text-green-600 text-xl font-bold border border-gray-200">
                                            {{ substr($anuncio->empresa ?? 'E', 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $anuncio->titulo }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($anuncio->descricao, 150) }}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-1"></i>
                                            Válido até: {{ \Carbon\Carbon::parse($anuncio->validade)->format('d/m/Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1"></i>
                                            {{ $anuncio->recrutador }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-laptop mr-1"></i>
                                            {{ ucfirst($anuncio->forma_de_candidatura) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    @if($anuncio->estado_anuncio === 'Publicado')
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Ativo</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Inativo</span>
                                    @endif
                                    <a href="/candidatos-anuncio/{{ $anuncio->id }}" class="text-green-600 hover:text-green-700 text-sm" title="Ver Candidatos">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <button onclick="editarVaga({{ json_encode($anuncio) }})" class="text-blue-600 hover:text-blue-700 text-sm" title="Editar Vaga">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $anuncios->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-briefcase text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhuma vaga publicada ainda</h3>
                    <p class="text-gray-600 mb-6">Comece publicando sua primeira vaga e encontre motoristas qualificados</p>
                    <button onclick="openModal('criar-vaga-modal')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-plus mr-2"></i> Criar Primeira Vaga
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Área de Publicidade - Banner Horizontal Inferior -->
    @if(isset($publicidades) && $publicidades->count() > 1)
        @foreach($publicidades->skip(1)->take(1) as $publicidade)
            @if($publicidade->adType == 'IMAGE' && $publicidade->image)
                <div class="mb-6 rounded-lg overflow-hidden shadow-md">
                    <a href="{{ $publicidade->imageUrl ?? '#' }}" target="_blank" rel="noopener noreferrer" onclick="trackAdClick('{{ $publicidade->slug }}')">
                        <img src="{{ asset('storage/' . $publicidade->image) }}" alt="{{ $publicidade->imageAlt ?? 'Publicidade' }}" class="w-full h-auto object-cover" style="max-height: 120px;">
                    </a>
                </div>
            @elseif($publicidade->adType == 'HTML' && $publicidade->body)
                <div class="mb-6">
                    {!! $publicidade->body !!}
                </div>
            @endif
        @endforeach
    @endif

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="/procurar-motorista" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-search text-2xl text-green-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Procurar Motoristas</h3>
                <p class="text-gray-600 text-sm">Encontre motoristas qualificados</p>
            </div>
        </a>

        <a href="/centralRisco" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Central de Risco</h3>
                <p class="text-gray-600 text-sm">Consultar e registrar denúncias</p>
            </div>
        </a>

        <a href="/empregador-perfil/{{ Auth::user()->id }}" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i class="fas fa-building text-2xl text-blue-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Perfil da Empresa</h3>
                <p class="text-gray-600 text-sm">Editar informações</p>
            </div>
        </a>
    </div>
</div>

<!-- Modal Criar Vaga -->
<div id="criar-vaga-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold">Criar Nova Vaga</h3>
            <button onclick="closeModal('criar-vaga-modal')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form action="{{ route('criarAnuncio') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="titulo" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-briefcase text-green-600 mr-2"></i>Título da Vaga <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="titulo" 
                        id="titulo"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                        placeholder="Ex: Motorista de Táxi Executivo"
                        required
                    >
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-car text-green-600 mr-2"></i>Categoria <span class="text-red-500">*</span>
                        </label>
                        <select name="categoria_id" id="categoria_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                            <option value="">Selecione a categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="validade" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar text-green-600 mr-2"></i>Data de Validade <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="validade" 
                            id="validade"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                            required
                        >
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-green-600 mr-2"></i> Províncias <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto p-4 border border-gray-300 rounded-lg">
                        @foreach($provincias as $provincia)
                            <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                                <input type="checkbox" name="provincias[]" value="{{ $provincia->id }}" class="rounded text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-700">{{ $provincia->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div>
                    <label for="forma_de_candidatura" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-laptop text-green-600 mr-2"></i>Forma de Candidatura <span class="text-red-500">*</span>
                    </label>
                    <select name="forma_de_candidatura" id="forma_de_candidatura" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                        <option value="">Selecione a forma</option>
                        <option value="online">Online</option>
                        <option value="email">Email</option>
                        <option value="presencial">Presencial</option>
                    </select>
                </div>
                
                <div>
                    <label for="descricao" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-green-600 mr-2"></i> Descrição <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="descricao" 
                        id="descricao"
                        rows="6" 
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200"
                        placeholder="Descreva os requisitos, responsabilidades e benefícios da vaga..."
                        required
                    ></textarea>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal('criar-vaga-modal')" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-check mr-2"></i> Publicar Vaga
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- Modal Editar Vaga -->
<div id="editar-vaga-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold">Editar Vaga</h3>
            <button onclick="closeModal('editar-vaga-modal')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form action="{{ route('editarAnuncio') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="edit-anuncio-id">
                
                <div>
                    <label for="edit-titulo" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-briefcase text-green-600 mr-2"></i>Título da Vaga <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="edit-titulo"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                        required
                    >
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="edit-categoria_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-car text-green-600 mr-2"></i>Categoria <span class="text-red-500">*</span>
                        </label>
                        <select name="categoria_id" id="edit-categoria_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                            <option value="">Selecione a categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="edit-validade" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar text-green-600 mr-2"></i>Data de Validade <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="validade" 
                            id="edit-validade"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                            required
                        >
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-green-600 mr-2"></i> Províncias <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto p-4 border border-gray-300 rounded-lg" id="edit-provincias-container">
                        @foreach($provincias as $provincia)
                            <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                                <input type="checkbox" name="provincias[]" value="{{ $provincia->id }}" class="rounded text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-700">{{ $provincia->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div>
                    <label for="edit-forma_de_candidatura" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-laptop text-green-600 mr-2"></i>Forma de Candidatura <span class="text-red-500">*</span>
                    </label>
                    <select name="forma_de_candidatura" id="edit-forma_de_candidatura" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                        <option value="">Selecione a forma</option>
                        <option value="online">Online</option>
                        <option value="email">Email</option>
                        <option value="presencial">Presencial</option>
                    </select>
                </div>
                
                <div>
                    <label for="edit-descricao" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-green-600 mr-2"></i> Descrição <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="descricao" 
                        id="edit-descricao"
                        rows="6" 
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200"
                        required
                    ></textarea>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal('editar-vaga-modal')" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-check mr-2"></i> Atualizar Vaga
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Função para rastrear cliques em publicidade
    function trackAdClick(slug) {
        fetch('/smart-banner-update-clicks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin',
            body: JSON.stringify({ slug: slug })
        }).catch(function(error) {
            console.log('Erro ao rastrear clique:', error);
        });
    }

    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    
    function editarVaga(anuncio) {
        document.getElementById('edit-anuncio-id').value = anuncio.id;
        document.getElementById('edit-titulo').value = anuncio.titulo;
        document.getElementById('edit-validade').value = anuncio.validade ? anuncio.validade.split(' ')[0] : '';
        document.getElementById('edit-descricao').value = anuncio.descricao || '';
        document.getElementById('edit-categoria_id').value = anuncio.categoria_id || '';
        document.getElementById('edit-forma_de_candidatura').value = anuncio.forma_de_candidatura || '';
        
        // Limpar checkboxes anteriores
        document.querySelectorAll('#edit-provincias-container input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
        });
        
        openModal('editar-vaga-modal');
    }
    
    // Fechar modal ao clicar fora
    window.onclick = function(event) {
        const modals = document.querySelectorAll('[id$="-modal"]');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }
</script>
@endpush

