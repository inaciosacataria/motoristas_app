@extends('layouts.modern')

@section('title', $anuncio->titulo)

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 border-b border-gray-200">
    <div class="container-custom py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li>
                    <a href="/" class="text-gray-600 hover:text-primary-600 transition-colors">
                        <i class="fas fa-home"></i> Início
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="text-gray-900 font-medium truncate max-w-md">{{ $anuncio->titulo }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-custom py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Job Header Card -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-start gap-4">
                        <!-- Company Logo -->
                        <div class="flex-shrink-0">
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
                                <img src="{{ asset($logoEmpresa) }}" alt="{{ $anuncio->empresa }}" 
                                     class="w-20 h-20 rounded-xl object-contain border border-gray-200" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center" style="display: none;">
                                    <span class="text-white text-2xl font-bold">{{ substr($anuncio->empresa ?? 'E', 0, 1) }}</span>
                                </div>
                            @else
                                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ substr($anuncio->empresa ?? 'E', 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $anuncio->titulo }}</h1>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600">
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-building text-primary-600"></i>
                                    <strong>{{ $anuncio->empresa }}</strong>
                                </span>
                                @if($anuncio->categoria)
                                    <span class="flex items-center gap-2">
                                        <i class="fas fa-car text-primary-600"></i>
                                        Categoria {{ $anuncio->categoria }}
                                    </span>
                                @endif
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-clock text-primary-600"></i>
                                    Publicado {{ \Carbon\Carbon::parse($anuncio->created_at)->diffForHumans() }}
                                </span>
                            </div>
                            
                            <!-- Badges -->
                            <div class="flex flex-wrap gap-2 mt-4">
                                @if(\Carbon\Carbon::parse($anuncio->created_at)->diffInDays() < 7)
                                    <span class="badge badge-success">
                                        <i class="fas fa-star mr-1"></i> Nova Vaga
                                    </span>
                                @endif
                                @if(\Carbon\Carbon::parse($anuncio->validade)->diffInDays() < 7)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock mr-1"></i> Expira em {{ \Carbon\Carbon::parse($anuncio->validade)->diffForHumans() }}
                                    </span>
                                @endif
                                <span class="badge badge-info">
                                    <i class="fas fa-laptop mr-1"></i> {{ ucfirst($anuncio->forma_de_candidatura) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-file-alt text-primary-600 mr-2"></i> Descrição da Vaga
                    </h2>
                </div>
                <div class="card-body prose max-w-none space-y-4">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $anuncio->descricao }}</p>

                    @if($anuncio->forma_de_candidatura === 'online')
                        <div class="mt-2 p-4 bg-primary-50 border border-primary-100 rounded-lg text-sm text-primary-800">
                            <p class="font-semibold mb-1">Como candidatar-se</p>
                            <p>
                                Candidatura através da conta no portal: aceda à sua conta de candidato ou cadastre-se para enviar a candidatura online.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Location -->
            @if($anuncios_provincias->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i> Localização
                    </h2>
                </div>
                <div class="card-body">
                    <div class="flex flex-wrap gap-2">
                        @php
                            // Evitar localidades duplicadas (ex. Maputo repetido)
                            $provinciasIndex = [];
                            foreach ($provincias as $provincia) {
                                $provinciasIndex[$provincia->id] = $provincia->name;
                            }
                            $printedProvIds = [];
                        @endphp

                        @foreach($anuncios_provincias as $ap)
                            @if(isset($provinciasIndex[$ap->provincia_id]) && !in_array($ap->provincia_id, $printedProvIds))
                                @php $printedProvIds[] = $ap->provincia_id; @endphp
                                <span class="inline-flex items-center px-4 py-2 bg-primary-50 text-primary-700 rounded-lg border border-primary-200">
                                    <i class="fas fa-map-pin mr-2"></i> {{ $provinciasIndex[$ap->provincia_id] }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-4 space-y-6">
                @if($anuncio->forma_de_candidatura === 'online')
                    <!-- Apply Card (apenas para candidaturas online pelo sistema) -->
                    <div class="card bg-gradient-to-br from-primary-600 to-primary-700 text-white">
                        <div class="card-body">
                            <h3 class="text-xl font-bold mb-4">Candidatar-se</h3>
                            <p class="text-primary-100 mb-6">
                                Interessado nesta oportunidade? Candidate-se agora pelo portal.
                            </p>
                            
                            @auth
                                @if(Auth::user()->privilegio === 'candidato')
                                    @if(!empty($jaCandidatou))
                                        <p class="text-primary-100 text-sm mb-2">
                                            <i class="fas fa-check-circle mr-2"></i> Já se candidatou a esta vaga.
                                        </p>
                                        <button type="button" disabled class="w-full bg-white/50 text-primary-600 font-bold py-3 px-6 rounded-lg cursor-not-allowed opacity-75">
                                            <i class="fas fa-paper-plane mr-2"></i> Candidatura enviada
                                        </button>
                                    @else
                                        <form action="{{ route('candidatar') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="w-full bg-white text-primary-600 hover:bg-gray-100 font-bold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                                <i class="fas fa-paper-plane mr-2"></i> Candidatar-me
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <p class="text-primary-100 text-sm">Apenas candidatos podem se candidatar a vagas.</p>
                                @endif
                            @else
                                <a href="{{ route('login', 'candidato') }}" class="block w-full bg-white text-primary-600 hover:bg-gray-100 font-bold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl text-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Entrar para Candidatar
                                </a>
                                <p class="text-primary-100 text-sm mt-3 text-center">
                                    Não tem conta? <a href="{{ route('register') }}?candidato=1" class="text-white underline font-semibold">Criar conta</a>
                                </p>
                            @endauth
                        </div>
                    </div>
                @endif

                <!-- Company Info -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="font-bold text-gray-900">
                            <i class="fas fa-building text-primary-600 mr-2"></i> Sobre a Empresa
                        </h3>
                    </div>
                    <div class="card-body space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Empresa</p>
                            <p class="font-semibold text-gray-900">{{ $anuncio->empresa }}</p>
                        </div>
                        
                        @if($anuncio->email)
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            @if($anuncio->forma_de_candidatura === 'online')
                                <span class="inline-flex items-center font-semibold text-primary-600 select-none" style="filter: blur(5px); user-select: none; pointer-events: none;">
                                    <i class="fas fa-envelope mr-1" style="filter: blur(5px);"></i>
                                    <span style="filter: blur(5px);">{{ $anuncio->email }}</span>
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Candidatando-se à vaga poderá aceder aos contactos.</p>
                            @else
                                <a href="mailto:{{ $anuncio->email }}" class="inline-flex items-center font-semibold text-primary-600 hover:text-primary-700">
                                    <i class="fas fa-envelope mr-1"></i>
                                    <span>{{ $anuncio->email }}</span>
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    Utilize este email para enviar a sua candidatura.
                                </p>
                            @endif
                        </div>
                        @endif
                        
                        @if($anuncio->celular && $anuncio->celular != 'N/A')
                        <div>
                            <p class="text-sm text-gray-600">Telefone</p>
                            @if($anuncio->forma_de_candidatura === 'online')
                                <span class="inline-flex items-center font-semibold text-primary-600 select-none" style="filter: blur(5px); user-select: none; pointer-events: none;">
                                    <i class="fas fa-phone mr-1" style="filter: blur(5px);"></i>
                                    <span style="filter: blur(5px);">{{ $anuncio->celular }}</span>
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Candidatando-se à vaga poderá aceder aos contactos.</p>
                            @else
                                @php
                                    $foneLimpo = preg_replace('/\D+/', '', $anuncio->celular);
                                @endphp
                                <a href="tel:{{ $foneLimpo ?: $anuncio->celular }}" class="inline-flex items-center font-semibold text-primary-600 hover:text-primary-700">
                                    <i class="fas fa-phone mr-1"></i>
                                    <span>{{ $anuncio->celular }}</span>
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    Utilize este telefone para combinar a candidatura.
                                </p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Job Details -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="font-bold text-gray-900">
                            <i class="fas fa-info-circle text-primary-600 mr-2"></i> Detalhes da Vaga
                        </h3>
                    </div>
                    <div class="card-body space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">
                                <i class="fas fa-calendar mr-2 text-primary-600"></i> Validade
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($anuncio->validade)->format('d/m/Y') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">
                                <i class="fas fa-car mr-2 text-primary-600"></i> Categoria
                            </span>
                            <span class="font-semibold text-gray-900">{{ $anuncio->categoria }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-600">
                                <i class="fas fa-laptop mr-2 text-primary-600"></i> Candidatura
                            </span>
                            <span class="font-semibold text-gray-900">{{ ucfirst($anuncio->forma_de_candidatura) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Share -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-bold text-gray-900 mb-3">
                            <i class="fas fa-share-alt text-primary-600 mr-2"></i> Compartilhar
                        </h3>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded-lg transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $anuncio->titulo }}" target="_blank"
                               class="flex-1 bg-sky-500 hover:bg-sky-600 text-white text-center py-2 rounded-lg transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ $anuncio->titulo }} {{ url()->current() }}" target="_blank"
                               class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-lg transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank"
                               class="flex-1 bg-blue-700 hover:bg-blue-800 text-white text-center py-2 rounded-lg transition-colors">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Similar Jobs -->
<div class="bg-gray-50 py-12">
    <div class="container-custom">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            <i class="fas fa-briefcase text-primary-600 mr-2"></i> Vagas Similares
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Aqui você pode adicionar vagas similares -->
            <div class="text-center py-8 col-span-full text-gray-500">
                Em breve: sistema de recomendação de vagas similares
            </div>
        </div>
    </div>
</div>
@endsection

