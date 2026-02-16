@extends('layouts.modern')

@section('title', 'Resultados da Pesquisa')

@section('content')
<!-- Search Header -->
<div class="bg-white shadow-sm border-b border-gray-200">
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

<!-- Results -->
<div class="container-custom py-12">
    <!-- Results Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Resultados da Pesquisa</h1>
        @if(request('keyword') || request('categoria') != 'null' || request('provincia') != 'null')
            <div class="flex flex-wrap gap-2 items-center">
                <span class="text-gray-600">Filtros ativos:</span>
                @if(request('keyword'))
                    <span class="badge badge-info">
                        <i class="fas fa-search mr-1"></i> "{{ request('keyword') }}"
                        <a href="{{ route('search', array_filter(request()->except('keyword'))) }}" class="ml-2">×</a>
                    </span>
                @endif
                @if(request('categoria') && request('categoria') != 'null')
                    @php $cat = $categorias->find(request('categoria')); @endphp
                    @if($cat)
                        <span class="badge badge-info">
                            <i class="fas fa-car mr-1"></i> {{ $cat->categoria }}
                            <a href="{{ route('search', array_filter(request()->except('categoria'))) }}" class="ml-2">×</a>
                        </span>
                    @endif
                @endif
                @if(request('provincia') && request('provincia') != 'null')
                    @php $prov = $provincias->find(request('provincia')); @endphp
                    @if($prov)
                        <span class="badge badge-info">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $prov->name }}
                            <a href="{{ route('search', array_filter(request()->except('provincia'))) }}" class="ml-2">×</a>
                        </span>
                    @endif
                @endif
                <a href="{{ route('search') }}" class="text-sm text-red-600 hover:text-red-700 ml-2">
                    <i class="fas fa-times-circle mr-1"></i> Limpar filtros
                </a>
            </div>
        @endif
        <p class="text-gray-600 mt-2">{{ $anuncios->total() }} {{ $anuncios->total() == 1 ? 'vaga encontrada' : 'vagas encontradas' }}</p>
    </div>
    
    <!-- Job Cards -->
    @if($anuncios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach ($anuncios as $anuncio)
                <x-job-card 
                    :anuncio="$anuncio" 
                    :provincias="$provincias" 
                    :anunciosProvincias="$anuncios_provincias"
                />
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $anuncios->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                <i class="fas fa-search text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Nenhuma vaga encontrada</h3>
            <p class="text-gray-600 mb-6">Tente ajustar seus filtros de pesquisa ou explore outras opções</p>
            <div class="flex justify-center gap-4">
                <a href="/" class="btn-primary">
                    <i class="fas fa-redo mr-2"></i> Ver Todas as Vagas
                </a>
                <a href="/formacao" class="btn-outline">
                    <i class="fas fa-graduation-cap mr-2"></i> Ver Formações
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

