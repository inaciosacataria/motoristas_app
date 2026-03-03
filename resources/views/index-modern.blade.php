@extends('layouts.modern')

@section('title', 'Vagas de Emprego')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16">
    <div class="container-custom">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in">
                Encontre Seu Próximo Emprego
            </h1>
            <p class="text-xl text-primary-100 mb-8 animate-slide-up">
                As melhores oportunidades para motoristas profissionais em Moçambique
            </p>
            <div class="flex justify-center gap-4 animate-slide-up" style="animation-delay: 0.2s;">
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                    <i class="fas fa-briefcase text-2xl"></i>
                    <div class="text-left">
                        <p class="text-sm text-primary-100">Vagas Ativas</p>
                        <p class="text-2xl font-bold">{{ $anuncios->total() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                    <i class="fas fa-building text-2xl"></i>
                    <div class="text-left">
                        <p class="text-sm text-primary-100">Empresas</p>
                        <p class="text-2xl font-bold">{{ $totalEmpresas ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Home Banner / Publicidade -->
@if(isset($publicidades) && $publicidades->count() > 0)
    @foreach($publicidades->take(1) as $publicidade)
        @if($publicidade->adType === 'IMAGE' && $publicidade->image)
            <div class="bg-gray-50">
                <div class="container-custom pt-6">
                    <div class="rounded-lg overflow-hidden shadow-md mb-4">
                        <a href="{{ $publicidade->imageUrl ?? '#' }}" target="_blank" rel="noopener noreferrer" onclick="trackAdClick('{{ $publicidade->slug }}')">
                            <img src="{{ asset('storage/' . $publicidade->image) }}" alt="{{ $publicidade->imageAlt ?? 'Publicidade' }}" class="w-full h-auto object-cover" style="max-height: 180px;">
                        </a>
                    </div>
                </div>
            </div>
        @elseif($publicidade->adType === 'HTML' && $publicidade->body)
            <div class="bg-gray-50">
                <div class="container-custom pt-6">
                    <div class="mb-4">
                        {!! $publicidade->body !!}
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif

<!-- Search Section -->
<div class="bg-white shadow-md -mt-8 relative z-10">
    <div class="container-custom py-6">
        <form method="GET" action="{{ route('search') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf
            
            <div class="md:col-span-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        name="keyword" 
                        value="{{ request('keyword') }}"
                        placeholder="Pesquisar vagas..." 
                        class="input pl-10"
                    >
                </div>
            </div>
            
            <div class="md:col-span-1">
                <div class="relative">
                    <i class="fas fa-car absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="categoria" class="input pl-10">
                        <option value="null">Todas Categorias</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" 
                                {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="md:col-span-1">
                <div class="relative">
                    <i class="fas fa-map-marker-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="provincia" class="input pl-10">
                        <option value="null">Todas Localizações</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ request('provincia') == $provincia->id ? 'selected' : '' }}>
                                {{ $provincia->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="md:col-span-1">
                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-filter mr-2"></i> Filtrar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Results Section -->
<div class="container-custom py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Vagas Disponíveis</h2>
            <p class="text-gray-600">{{ $anuncios->total() }} vagas encontradas</p>
        </div>
        
        <div class="flex gap-2">
            <button class="p-2 border rounded-lg hover:bg-gray-50" title="Grid View">
                <i class="fas fa-th-large text-gray-600"></i>
            </button>
            <button class="p-2 border rounded-lg hover:bg-gray-50" title="List View">
                <i class="fas fa-list text-gray-600"></i>
            </button>
        </div>
    </div>
    
    @if($anuncios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach ($anuncios as $anuncio)
                <a href="{{ route('verAnuncio', $anuncio->slug ?? $anuncio->id) }}" class="job-card">
                    <div class="p-6">
                        <!-- Company Logo -->
                        <div class="flex justify-center mb-4">
                            @php
                                $logoEmpresa = null;
                                // Priorizar logotipo sobre foto_url
                                if (isset($anuncio->logotipo) && $anuncio->logotipo && $anuncio->logotipo != 'none') {
                                    $logoEmpresa = $anuncio->logotipo;
                                } elseif (isset($anuncio->foto_url) && $anuncio->foto_url && $anuncio->foto_url != 'none') {
                                    $logoEmpresa = $anuncio->foto_url;
                                }
                            @endphp
                            
                            @if($logoEmpresa)
                                <img src="{{ asset($logoEmpresa) }}" alt="{{ $anuncio->empresa }}" class="h-16 w-16 object-contain rounded-lg" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="h-16 w-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center" style="display: none;">
                                    <span class="text-white text-xl font-bold">{{ substr($anuncio->empresa ?? 'E', 0, 1) }}</span>
                                </div>
                            @else
                                <div class="h-16 w-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white text-xl font-bold">{{ substr($anuncio->empresa ?? 'E', 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Job Title -->
                        <h3 class="font-semibold text-lg text-gray-900 mb-2 line-clamp-2 hover:text-primary-600 transition-colors">
                            {{ $anuncio->titulo }}
                        </h3>
                        
                        <!-- Company Name -->
                        <p class="text-gray-600 text-sm mb-3 flex items-center gap-2">
                            <i class="fas fa-building text-primary-600"></i>
                            {{ $anuncio->empresa }}
                        </p>
                        
                        <!-- Location -->
                        <p class="text-gray-600 text-sm mb-4 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-primary-600"></i>
                            @php
                                $locais = [];
                                foreach ($anuncios_provincias as $ap) {
                                    if($ap->anuncio_id == $anuncio->id) {
                                        foreach ($provincias as $prov) {
                                            if($ap->provincia_id == $prov->id) {
                                                $locais[] = $prov->name;
                                            }
                                        }
                                    }
                                }
                                echo count($locais) > 1 ? 'Vários locais' : ($locais[0] ?? 'Não especificado');
                            @endphp
                        </p>
                        
                        <!-- Footer -->
                        @php
                            $ehExpirado = isset($anuncio->validade) && \Carbon\Carbon::parse($anuncio->validade)->isPast();
                        @endphp
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            @if($ehExpirado)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    <i class="fas fa-hourglass-end mr-1"></i> Expirado
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <i class="fas fa-clock mr-1"></i> Ativo
                                </span>
                            @endif
                            <i class="fas fa-arrow-right text-primary-600"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $anuncios->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fas fa-search text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Nenhuma vaga encontrada</h3>
            <p class="text-gray-600 mb-6">Tente ajustar seus filtros de pesquisa</p>
            <a href="/" class="btn-primary">
                <i class="fas fa-redo mr-2"></i> Ver todas as vagas
            </a>
        </div>
    @endif
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-16">
    <div class="container-custom text-center">
        <h2 class="text-3xl font-bold mb-4">Pronto para começar sua carreira?</h2>
        <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
            Junte-se a milhares de motoristas que já encontraram emprego através da nossa plataforma
        </p>
        <div class="flex justify-center gap-4">
            @guest
                <a href="{{ route('register') }}?candidato=1" class="bg-white text-primary-600 hover:bg-gray-100 font-medium py-3 px-8 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i> Criar Conta
                </a>
                <a href="/formacao" class="bg-primary-800 hover:bg-primary-900 text-white font-medium py-3 px-8 rounded-lg transition-all duration-200">
                    <i class="fas fa-graduation-cap mr-2"></i> Ver Formações
                </a>
            @endguest
            @auth
                <a href="{{ Auth::user()->privilegio === 'candidato' ? '/candidato' : '/empregador' }}" class="bg-white text-primary-600 hover:bg-gray-100 font-medium py-3 px-8 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-tachometer-alt mr-2"></i> Meu Dashboard
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
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
        }).catch(function (error) {
            console.log('Erro ao rastrear clique:', error);
        });
    }
</script>
@endpush

