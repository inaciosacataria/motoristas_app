@extends('layouts.modern')

@section('title', 'Dashboard do Candidato')

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Bem-vindo, {{ Auth::user()->name }}!</h1>
                <p class="text-green-100 mt-1">Gerencie seu perfil e candidaturas</p>
            </div>
            <a href="/meu-cv" class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg border border-white font-semibold transition duration-200">
                <i class="fas fa-edit mr-2"></i> Editar Perfil
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6 text-center">
                    <!-- Profile Photo -->
                    <div class="relative inline-block mb-4">
                        @if(Auth::user()->foto_url && Auth::user()->foto_url != 'none')
                            <img src="{{ Auth::user()->foto_url }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-full mx-auto border-4 border-green-500 object-cover">
                        @else
                            <div class="w-24 h-24 rounded-full mx-auto bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white text-3xl font-bold border-4 border-green-100">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <button 
                            onclick="document.getElementById('foto-modal').classList.remove('hidden')"
                            class="absolute bottom-0 right-0 bg-green-600 hover:bg-green-700 text-white rounded-full p-2 shadow-lg transition-colors"
                        >
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600 mb-2"><i class="fas fa-phone mr-1"></i> {{ Auth::user()->celular }}</p>
                    
                    <!-- Profile Progress -->
                    <div class="mt-6 mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Perfil Completo</span>
                            <span class="text-sm font-bold text-green-600">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    
                    <!-- Profile Checklist -->
                    <div class="text-left space-y-2 mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-700"><i class="fas fa-user mr-2"></i> Dados pessoais</span>
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-700"><i class="fas fa-phone mr-2"></i> Contactos</span>
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-700"><i class="fas fa-briefcase mr-2"></i> Experiências</span>
                            @if(sizeof($experiencias) < 1)
                                <i class="fas fa-times-circle text-red-500"></i>
                            @else
                                <i class="fas fa-check-circle text-green-600"></i>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-700"><i class="fas fa-language mr-2"></i> Idiomas</span>
                            @if(sizeof($idiomas) < 1)
                                <i class="fas fa-times-circle text-red-500"></i>
                            @else
                                <i class="fas fa-check-circle text-green-600"></i>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-700"><i class="fas fa-file-alt mr-2"></i> Documentos</span>
                            @if(sizeof($documentos) < 1)
                                <i class="fas fa-times-circle text-red-500"></i>
                            @else
                                <i class="fas fa-check-circle text-green-600"></i>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="mt-6 space-y-2">
                        <a href="/meu-cv" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-edit mr-2"></i> Editar Perfil
                        </a>
                        <a href="/candidatura-espontanea" class="w-full bg-white border-2 border-green-600 text-green-600 hover:bg-green-50 font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Candidatura Espontânea
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Candidaturas</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $candidaturas->count() }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="fas fa-paper-plane text-2xl text-green-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Experiências</p>
                            <p class="text-3xl font-bold text-gray-900">{{ sizeof($experiencias) }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-briefcase text-2xl text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Documentos</p>
                            <p class="text-3xl font-bold text-gray-900">{{ sizeof($documentos) }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="fas fa-file-alt text-2xl text-green-600"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Applications -->
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-paper-plane text-green-600 mr-2"></i> Minhas Candidaturas
                        </h2>
                        <a href="/" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            Ver todas vagas <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    @if($candidaturas->count() > 0)
                        <div class="space-y-4">
                            @foreach($candidaturas->take(5) as $candidatura)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-1">
                                        <a href="{{ route('verAnuncio', $candidatura->anuncio_path) }}" class="font-semibold text-gray-900 hover:text-green-600">
                                            {{ $candidatura->titulo }}
                                        </a>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            Candidatura enviada em {{ \Carbon\Carbon::parse($candidatura->created_at)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        <i class="fas fa-clock mr-1"></i> Pendente
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                <i class="fas fa-inbox text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhuma candidatura ainda</h3>
                            <p class="text-gray-600 mb-4">Comece a candidatar-se para vagas disponíveis</p>
                            <a href="/" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i> Ver Vagas
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Photo Upload Modal -->
<div id="foto-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <form action="/fotoPerfil" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-lg font-bold">Atualizar Foto de Perfil</h3>
                <button type="button" onclick="document.getElementById('foto-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-image mr-1"></i> Escolha uma foto
                </label>
                <input 
                    type="file" 
                    name="documento" 
                    accept="image/*" 
                    required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200"
                >
                <p class="text-sm text-gray-500 mt-2">Formato: JPG, PNG. Tamanho máximo: 2MB</p>
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="document.getElementById('foto-modal').classList.add('hidden')" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg transition duration-200">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-upload mr-2"></i> Carregar Foto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

