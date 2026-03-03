@extends('layouts.modern')

@section('title', 'Perfil da Empresa')

@section('content')
@if(session('erro'))
    <div class="container mx-auto px-4 py-8">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            <p class="font-semibold">{{ session('erro') }}</p>
        </div>
    </div>
@endif

@if(isset($empregador) && $empregador)
<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <!-- Logo/Foto da Empresa -->
                <div class="flex-shrink-0 relative group">
                    @php
                        $fotoPerfil = null;
                        // Usar data_get para evitar erros de propriedade indefinida em stdClass
                        $logoCompleto = data_get($empregadorCompleto ?? null, 'logotipo');
                        $logoEmpregador = data_get($empregador ?? null, 'logotipo');
                        $fotoUser = data_get($empregador ?? null, 'foto');

                        // Prioridade: 1) logotipo do empregador completo, 2) logotipo do empregador, 3) foto do usuário
                        if ($logoCompleto && $logoCompleto !== 'none') {
                            $fotoPerfil = $logoCompleto;
                        } elseif ($logoEmpregador && $logoEmpregador !== 'none') {
                            $fotoPerfil = $logoEmpregador;
                        } elseif ($fotoUser && $fotoUser !== 'none') {
                            $fotoPerfil = $fotoUser;
                        }
                    @endphp
                    
                    @if($fotoPerfil)
                        <img src="{{ asset($fotoPerfil) }}" alt="{{ $empregador->empresa ?? $empregador->nome }}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-32 h-32 rounded-full bg-white flex items-center justify-center text-green-600 text-4xl font-bold border-4 border-white shadow-lg" style="display: none;">
                            {{ substr($empregador->empresa ?? $empregador->nome ?? 'E', 0, 1) }}
                        </div>
                    @else
                        <div class="w-32 h-32 rounded-full bg-white flex items-center justify-center text-green-600 text-4xl font-bold border-4 border-white shadow-lg">
                            {{ substr($empregador->empresa ?? $empregador->nome ?? 'E', 0, 1) }}
                        </div>
                    @endif
                    @if(Auth::check() && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
                        <button onclick="openModal('foto-perfil-modal')" class="absolute bottom-0 right-0 bg-green-600 hover:bg-green-700 text-white rounded-full p-2 shadow-lg transition duration-200 opacity-90 hover:opacity-100" title="Atualizar Foto">
                            <i class="fas fa-camera text-sm"></i>
                        </button>
                    @endif
                </div>
                
                <!-- Informações Principais -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $empregador->empresa ?? $empregador->nome ?? 'Empresa' }}</h1>
                    <p class="text-xl text-green-100 mb-4">
                        <i class="fas fa-industry mr-2"></i>{{ $empregador->sector_actividade ?? 'Não especificado' }}
                    </p>
                    
                    <!-- Status Badge -->
                    @if(isset($empregador->active) && ($empregador->active == 'Activo' || $empregador->active == 'activo'))
                        <span class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-full text-sm font-semibold mb-4">
                            <i class="fas fa-check-circle mr-2"></i> Conta Ativa
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-full text-sm font-semibold mb-4">
                            <i class="fas fa-exclamation-circle mr-2"></i> Cadastro Incompleto
                        </span>
                    @endif
                    
                    <!-- Ações Admin -->
                    @if(Auth::check() && Auth::user()->privilegio == 'admin')
                        <div class="mt-4">
                            @if(isset($empregador->active) && $empregador->active == 'desativado')
                                <a href="{{ route('activeUser', $empregador->user_id ?? $id) }}" class="inline-flex items-center px-6 py-3 bg-white text-green-600 hover:bg-green-50 rounded-lg font-semibold transition duration-200 mr-3">
                                    <i class="fas fa-check mr-2"></i> Ativar Conta
                                </a>
                            @elseif(isset($empregador->active))
                                <a href="{{ route('desactiveUser', $empregador->user_id ?? $id) }}" class="inline-flex items-center px-6 py-3 bg-red-500 text-white hover:bg-red-600 rounded-lg font-semibold transition duration-200">
                                    <i class="fas fa-ban mr-2"></i> Desativar Conta
                                </a>
                            @endif
                        </div>
                    @endif
                    
                    <!-- Aviso de cadastro incompleto -->
                    @if(!isset($empregador->documento_nuit) || !$empregador->documento_nuit)
                        <div class="mt-4">
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-3 rounded">
                                <p class="text-sm"><i class="fas fa-exclamation-triangle mr-2"></i>Cadastro incompleto. Complete o cadastro para usar todas as funcionalidades.</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Botão Editar Perfil -->
                    @if(Auth::check() && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
                        <div class="mt-4">
                            <button onclick="openModal('editar-perfil-modal')" class="w-full inline-flex items-center justify-center px-6 py-3 bg-white text-green-600 hover:bg-green-50 rounded-lg font-semibold transition duration-200 border-2 border-green-600">
                                <i class="fas fa-edit mr-2"></i> Editar Perfil
                            </button>
                        </div>
                    @endif
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

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar - Informações da Empresa -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-4">
                    <!-- Informações de Contato -->
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-green-600 mr-2"></i> Informações
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Email</p>
                                <p class="text-gray-900 font-medium flex items-center">
                                    <i class="fas fa-envelope text-green-600 mr-2 text-sm"></i>
                                    <a href="mailto:{{ $empregador->email }}" class="hover:text-green-600 transition">{{ $empregador->email }}</a>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Contacto</p>
                                <p class="text-gray-900 font-medium flex items-center">
                                    <i class="fas fa-phone text-green-600 mr-2 text-sm"></i>
                                    <a href="tel:{{ $empregador->celular }}" class="hover:text-green-600 transition">{{ $empregador->celular }}</a>
                                </p>
                            </div>
                            @if(isset($empregador->endereco) && $empregador->endereco)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Endereço</p>
                                <p class="text-gray-900 font-medium flex items-start">
                                    <i class="fas fa-map-marker-alt text-green-600 mr-2 text-sm mt-1"></i>
                                    <span>{{ $empregador->endereco }}</span>
                                </p>
                            </div>
                            @endif
                            @if(isset($empregador->website) && $empregador->website)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Website</p>
                                <p class="text-gray-900 font-medium flex items-center">
                                    <i class="fas fa-globe text-green-600 mr-2 text-sm"></i>
                                    <a href="{{ $empregador->website }}" target="_blank" rel="noopener noreferrer" class="hover:text-green-600 transition break-all">{{ $empregador->website }}</a>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Documentos -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <i class="fas fa-file-alt text-green-600 mr-2"></i> Documentos
                            </h3>
                            @if(Auth::check() && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
                                <button onclick="openModal('upload-documentos-modal')" class="text-sm text-green-600 hover:text-green-700 font-medium">
                                    <i class="fas fa-upload mr-1"></i> Atualizar
                                </button>
                            @endif
                        </div>
                        <div class="space-y-3">
                            <!-- NUIT -->
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-red-600 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-700">NUIT</span>
                                    </div>
                                    @if(Auth::check() && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
                                        <button onclick="openModal('update-document-modal-nuit')" class="text-xs text-green-600 hover:text-green-700" title="Atualizar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif
                                </div>
                                @if(isset($empregador->documento_nuit) && $empregador->documento_nuit)
                                    <a href="{{ asset($empregador->documento_nuit) }}" target="_blank" class="text-xs text-gray-600 hover:text-green-600 flex items-center">
                                        <i class="fas fa-download mr-1"></i> Ver documento
                                    </a>
                                @else
                                    <p class="text-xs text-gray-500 italic">Não enviado</p>
                                @endif
                            </div>
                            
                            <!-- Certidão de Empresa -->
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-red-600 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-700">Certidão de Empresa</span>
                                    </div>
                                    @if(Auth::check() && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
                                        <button onclick="openModal('update-document-modal-certidao')" class="text-xs text-green-600 hover:text-green-700" title="Atualizar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif
                                </div>
                                @if(isset($empregador->documento_certidao) && $empregador->documento_certidao)
                                    <a href="{{ asset($empregador->documento_certidao) }}" target="_blank" class="text-xs text-gray-600 hover:text-green-600 flex items-center">
                                        <i class="fas fa-download mr-1"></i> Ver documento
                                    </a>
                                @else
                                    <p class="text-xs text-gray-500 italic">Não enviado</p>
                                @endif
                            </div>
                            
                            <!-- Início de Actividades -->
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-red-600 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-700">Início de Actividades</span>
                                    </div>
                                    @if(Auth::check() && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
                                        <button onclick="openModal('update-document-modal-inicio')" class="text-xs text-green-600 hover:text-green-700" title="Atualizar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif
                                </div>
                                @if(isset($empregador->documento_inicio_actividade) && $empregador->documento_inicio_actividade)
                                    <a href="{{ asset($empregador->documento_inicio_actividade) }}" target="_blank" class="text-xs text-gray-600 hover:text-green-600 flex items-center">
                                        <i class="fas fa-download mr-1"></i> Ver documento
                                    </a>
                                @else
                                    <p class="text-xs text-gray-500 italic">Não enviado</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content - Vagas Publicadas -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-briefcase text-green-600 mr-3"></i> Vagas Publicadas
                        </h2>
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ count($anuncios) }} {{ count($anuncios) == 1 ? 'vaga' : 'vagas' }}
                        </span>
                    </div>

                    @if(count($anuncios) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($anuncios as $anuncio)
                                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="p-6">
                                        <!-- Logo/Foto -->
                                        <div class="flex items-start mb-4">
                                            @php
                                                $logoVaga = null;
                                                // Verificar se há logotipo no empregador completo primeiro (usar data_get para evitar erro de propriedade indefinida)
                                                $logoCompletoVaga = data_get($empregadorCompleto ?? null, 'logotipo');
                                                if ($logoCompletoVaga && $logoCompletoVaga !== 'none') {
                                                    $logoVaga = $logoCompletoVaga;
                                                } elseif (isset($anuncio->foto) && $anuncio->foto && $anuncio->foto != 'none') {
                                                    $logoVaga = $anuncio->foto;
                                                }
                                            @endphp
                                            
                                            @if($logoVaga)
                                                <img src="{{ asset($logoVaga) }}" alt="{{ $anuncio->empresa }}" class="w-16 h-16 rounded-full object-cover mr-4" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl font-bold mr-4" style="display: none;">
                                                    {{ substr($anuncio->empresa ?? 'E', 0, 1) }}
                                                </div>
                                            @else
                                                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl font-bold mr-4">
                                                    {{ substr($anuncio->empresa ?? 'E', 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                                    <a href="{{ route('verAnuncio', $anuncio->slug ?? $anuncio->id) }}" class="hover:text-green-600 transition">
                                                        {{ $anuncio->titulo }}
                                                    </a>
                                                </h3>
                                                <p class="text-sm text-gray-600 mb-2">{{ $anuncio->empresa }}</p>
                                                
                                                <!-- Província -->
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    @php
                                                        $provinciasAnuncio = [];
                                                        foreach ($anuncios_provincias as $ap) {
                                                            if ($ap->anuncio_id == $anuncio->id) {
                                                                foreach ($provincias as $prov) {
                                                                    if ($ap->provincia_id == $prov->id) {
                                                                        $provinciasAnuncio[] = $prov->name;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    @if(count($provinciasAnuncio) > 1)
                                                        <span>Vários locais</span>
                                                    @elseif(count($provinciasAnuncio) == 1)
                                                        <span>{{ $provinciasAnuncio[0] }}</span>
                                                    @else
                                                        <span>Não especificado</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Validade -->
                                        @if($anuncio->validade)
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <p class="text-xs text-gray-500">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                Válido até: {{ \Carbon\Carbon::parse($anuncio->validade)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        @endif
                                        
                                        <!-- Botão Ver Detalhes -->
                                        <div class="mt-4">
                                            <a href="{{ route('verAnuncio', $anuncio->slug ?? $anuncio->id) }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                                <i class="fas fa-eye mr-2"></i> Ver Detalhes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    @else
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                <i class="fas fa-briefcase text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Nenhuma vaga publicada</h3>
                            <p class="text-gray-600">Esta empresa ainda não publicou nenhuma vaga.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mx-auto px-4 py-8">
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
        <p class="font-semibold">Empregador não encontrado!</p>
    </div>
</div>
@endif

<!-- Modal Atualizar Foto de Perfil -->
@if(Auth::check() && isset($empregador) && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
<div id="foto-perfil-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900">Atualizar Foto de Perfil</h3>
                <button onclick="closeModal('foto-perfil-modal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded">
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif
            
            @if(session('erro'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded">
                    <p class="text-sm">{{ session('erro') }}</p>
                </div>
            @endif
            
            <form action="{{ route('fotoPerfilEmpregador') }}" method="POST" enctype="multipart/form-data" id="foto-perfil-form">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selecione uma foto</label>
                    <input type="file" name="documento" id="foto-input" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    <p class="mt-2 text-xs text-gray-500">Formatos aceitos: JPG, PNG, GIF, WEBP (máx. 5MB)</p>
                </div>
                
                <div class="mb-4" id="preview-container" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                    <img id="preview-image" src="" alt="Preview" class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 mx-auto">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('foto-perfil-modal')" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                        <i class="fas fa-upload mr-2"></i> Atualizar Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Limpar preview ao fechar
    document.getElementById('preview-container').style.display = 'none';
    document.getElementById('foto-input').value = '';
}

// Preview da imagem antes de enviar
document.getElementById('foto-input')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// Fechar modal ao clicar fora
document.getElementById('foto-perfil-modal')?.addEventListener('click', function(e) {
    if (e.target.id === 'foto-perfil-modal') {
        closeModal('foto-perfil-modal');
    }
});
</script>
@endif

<!-- Modal Editar Perfil -->
@if(Auth::check() && isset($empregador) && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
<div id="editar-perfil-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full my-8">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Editar Perfil da Empresa</h3>
                <button onclick="closeModal('editar-perfil-modal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            @if($errors->any())
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('editarPerfilEmpregador') }}" method="POST" id="editar-perfil-form">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Dados do Usuário -->
                    <div class="md:col-span-2">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Dados de Acesso</h4>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo *</label>
                        <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Celular</label>
                        <input type="text" name="celular" value="{{ Auth::user()->celular ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <!-- Dados da Empresa -->
                    <div class="md:col-span-2 mt-4">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Dados da Empresa</h4>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nome da Empresa *</label>
                        <input type="text" name="empresa" value="{{ $empregadorCompleto->empresa ?? $empregador->empresa ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NUIT</label>
                        <input type="text" name="nuit" value="{{ $empregadorCompleto->nuit ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Setor de Atividade</label>
                        <input type="text" name="sector_actividade" value="{{ $empregadorCompleto->sector_actividade ?? $empregador->sector_actividade ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Representante Legal</label>
                        <input type="text" name="representante" value="{{ $empregadorCompleto->representante ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telefone Principal</label>
                        <input type="text" name="telefone" value="{{ $empregadorCompleto->telefone ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telefone Alternativo</label>
                        <input type="text" name="telefone_alt" value="{{ $empregadorCompleto->telefone_alt ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" name="website" value="{{ $empregadorCompleto->website ?? $empregador->website ?? '' }}" placeholder="https://exemplo.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Província</label>
                        <select name="provincia_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Selecione uma província</option>
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id }}" {{ ($empregadorCompleto->provincia_id ?? '') == $provincia->id ? 'selected' : '' }}>
                                    {{ $provincia->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Endereço</label>
                        <textarea name="endereco" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $empregadorCompleto->endereco ?? $empregador->endereco ?? '' }}</textarea>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sobre a Empresa</label>
                        <textarea name="sobre" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Descreva sua empresa...">{{ $empregadorCompleto->sobre ?? '' }}</textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeModal('editar-perfil-modal')" class="px-6 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                        <i class="fas fa-save mr-2"></i> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Fechar modal de editar perfil ao clicar fora
document.getElementById('editar-perfil-modal')?.addEventListener('click', function(e) {
    if (e.target.id === 'editar-perfil-modal') {
        closeModal('editar-perfil-modal');
    }
});
</script>
@endif

<!-- Modais para Atualização de Documentos Individuais -->
@if(Auth::check() && isset($empregador) && (Auth::user()->id == ($empregador->user_id ?? $id) || Auth::user()->privilegio == 'admin'))
<!-- Modal Atualizar NUIT -->
<div id="update-document-modal-nuit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900">Atualizar NUIT</h3>
                <button onclick="closeModal('update-document-modal-nuit')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('updateDocument') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipo" value="documento_nuit">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selecione o documento NUIT (PDF)</label>
                    <input type="file" name="documento" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    <p class="mt-2 text-xs text-gray-500">Apenas arquivos PDF são aceitos</p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('update-document-modal-nuit')" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                        <i class="fas fa-upload mr-2"></i> Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Atualizar Certidão de Empresa -->
<div id="update-document-modal-certidao" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900">Atualizar Certidão de Empresa</h3>
                <button onclick="closeModal('update-document-modal-certidao')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('updateDocument') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipo" value="documento_certidao">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selecione a Certidão de Empresa (PDF)</label>
                    <input type="file" name="documento" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    <p class="mt-2 text-xs text-gray-500">Apenas arquivos PDF são aceitos</p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('update-document-modal-certidao')" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                        <i class="fas fa-upload mr-2"></i> Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Atualizar Início de Actividades -->
<div id="update-document-modal-inicio" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900">Atualizar Início de Actividades</h3>
                <button onclick="closeModal('update-document-modal-inicio')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('updateDocument') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipo" value="documento_inicio_actividade">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selecione o documento de Início de Actividades (PDF)</label>
                    <input type="file" name="documento" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    <p class="mt-2 text-xs text-gray-500">Apenas arquivos PDF são aceitos</p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('update-document-modal-inicio')" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                        <i class="fas fa-upload mr-2"></i> Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Fechar modais de documentos ao clicar fora
document.getElementById('update-document-modal-nuit')?.addEventListener('click', function(e) {
    if (e.target.id === 'update-document-modal-nuit') {
        closeModal('update-document-modal-nuit');
    }
});

document.getElementById('update-document-modal-certidao')?.addEventListener('click', function(e) {
    if (e.target.id === 'update-document-modal-certidao') {
        closeModal('update-document-modal-certidao');
    }
});

document.getElementById('update-document-modal-inicio')?.addEventListener('click', function(e) {
    if (e.target.id === 'update-document-modal-inicio') {
        closeModal('update-document-modal-inicio');
    }
});
</script>
@endif

@endsection

