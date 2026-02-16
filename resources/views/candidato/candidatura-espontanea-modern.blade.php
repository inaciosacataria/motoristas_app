@extends('layouts.modern')

@section('title', 'Candidatura Espontânea')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Candidatura Espontânea</h1>
                <p class="text-green-100 mt-1">Candidate-se diretamente às empresas que mais lhe interessam</p>
            </div>
            <a href="/candidato" class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg border border-white font-semibold transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Voltar ao Dashboard
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Alerts -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('erro'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                <p class="font-semibold">{{ session('erro') }}</p>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3 text-xl"></i>
                <p class="font-semibold">{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    <!-- Info Box -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-lg">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-2xl text-blue-600 mt-1"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-bold text-blue-900 mb-2">Como funciona a Candidatura Espontânea?</h3>
                <ul class="text-blue-800 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                        <span>Escolha a empresa que mais lhe interessa da lista abaixo</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                        <span>Clique em "Candidatar-me" para enviar seu perfil diretamente para a empresa</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                        <span>A empresa irá avaliar seu perfil e entrar em contato se houver interesse</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <form id="search-form" class="flex gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input 
                        type="text" 
                        id="keyword" 
                        name="keyword" 
                        class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                        placeholder="Pesquise por nome da empresa, setor ou localização..."
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg transition duration-200">
                <i class="fas fa-filter mr-2"></i> Filtrar
            </button>
        </form>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total de Empresas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $empregadores->total() }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-building text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Setores Diversos</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $empregadores->unique('sector_actividade')->count() }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-briefcase text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Províncias</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $empregadores->unique('provincia')->count() }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-map-marker-alt text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Empresas List -->
    <div class="space-y-6">
        @if($empregadores->count() > 0)
            @foreach($empregadores as $empregador)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <!-- Company Info -->
                            <div class="flex items-start space-x-4 flex-1">
                                <!-- Logo -->
                                <div class="flex-shrink-0">
                                    @if($empregador->foto_url && $empregador->foto_url != 'none')
                                        <img src="{{ $empregador->foto_url }}" alt="{{ $empregador->name }}" class="w-20 h-20 rounded-lg object-cover border-2 border-gray-200">
                                    @else
                                        <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white text-2xl font-bold border-2 border-gray-200">
                                            {{ substr($empregador->name, 0, 2) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Company Details -->
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $empregador->name }}</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-briefcase text-green-600 mr-2"></i>
                                            <span class="text-sm"><strong>Setor:</strong> {{ $empregador->sector_actividade }}</span>
                                        </div>
                                        
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                            <span class="text-sm"><strong>Localização:</strong> {{ $empregador->provincia }}</span>
                                        </div>
                                        
                                        @if($empregador->email)
                                            <div class="flex items-center text-gray-600">
                                                <i class="fas fa-envelope text-green-600 mr-2"></i>
                                                <span class="text-sm">{{ $empregador->email }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($empregador->celular)
                                            <div class="flex items-center text-gray-600">
                                                <i class="fas fa-phone text-green-600 mr-2"></i>
                                                <span class="text-sm">{{ $empregador->celular }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if($empregador->sobre)
                                        <p class="text-gray-600 text-sm">{{ Str::limit($empregador->sobre, 150) }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="flex-shrink-0 ml-4">
                                <a href="{{ route('submeter-candidatura-espontanea', $empregador->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 flex items-center whitespace-nowrap">
                                    <i class="fas fa-paper-plane mr-2"></i> Candidatar-me
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-8">
                {{ $empregadores->links() }}
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg p-12 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-building text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhuma empresa encontrada</h3>
                <p class="text-gray-600 mb-6">Não encontramos empresas com os critérios de pesquisa informados.</p>
                <button onclick="document.getElementById('keyword').value = ''; document.getElementById('search-form').submit();" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-redo mr-2"></i> Limpar Filtros
                </button>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('keyword').addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        const cards = document.querySelectorAll('.bg-white.shadow-md.rounded-lg');
        
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            if (text.includes(keyword)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endpush

