@extends('layouts.modern')

@section('title', 'Formação Profissional de Motoristas')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Formação Complementar e de Aperfeiçoamento Profissional de Motoristas
            </h1>
            <p class="text-xl text-green-100 mb-8">
                Desenvolva suas competências e torne-se um motorista profissional certificado
            </p>
            <a href="/inscricao" class="inline-flex items-center bg-white text-green-600 hover:bg-green-50 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg shadow-lg">
                <i class="fas fa-pencil-alt mr-3"></i> Inscrever-se Agora
            </a>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="bg-white py-12 border-b">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-certificate text-2xl text-green-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Certificado Reconhecido</h3>
                <p class="text-gray-600 text-sm">Certificação oficial e reconhecida</p>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i class="fas fa-chalkboard-teacher text-2xl text-blue-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Instrutores Qualificados</h3>
                <p class="text-gray-600 text-sm">Profissionais experientes</p>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                    <i class="fas fa-clock text-2xl text-purple-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Horários Flexíveis</h3>
                <p class="text-gray-600 text-sm">Turmas em vários horários</p>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                    <i class="fas fa-briefcase text-2xl text-yellow-600"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Melhores Oportunidades</h3>
                <p class="text-gray-600 text-sm">Destaque-se no mercado</p>
            </div>
        </div>
    </div>
</div>

<!-- Courses Section -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nossos Cursos de Formação</h2>
            <p class="text-lg text-gray-600">Escolha o curso ideal para o seu desenvolvimento profissional</p>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/2.JPG') }}" alt="Condução Defensiva Carga" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-truck mr-1"></i> Carga
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Condução Defensiva no Transporte de Carga
                    </h3>
                    <p class="text-gray-600 mb-4">
                        A condução defensiva é a melhor forma de evitar acidentes de viação, antecipando problemas e respondendo com antecedência a situações que potencialmente podem causar acidentes.
                    </p>
                    <a href="/formacao1" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/4.JPG') }}" alt="Condução Defensiva Passageiros" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-bus mr-1"></i> Passageiros
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Condução Defensiva no Transporte Coletivo de Passageiros
                    </h3>
                    <p class="text-gray-600 mb-4">
                        A condução defensiva é a melhor forma de evitar acidentes de viação, antecipando problemas e respondendo com antecedência a situações que potencialmente podem causar acidentes.
                    </p>
                    <a href="/formacao2" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/1.JPG') }}" alt="Produtos Perigosos" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Perigosos
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Transporte de Carga/Produtos Perigosos
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Dotar os participantes de conhecimentos de risco inerentes ao transporte de carga perigosa com vista a evitar probabilidades de ocorrência de incidentes.
                    </p>
                    <a href="/formacao3" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/8.jpg') }}" alt="Arrumação de Carga" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-boxes mr-1"></i> Carga
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Arrumação de Carga
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Dotar os participantes de conhecimento de princípios de segurança de carga, cuidados nas operações de carregamento e descarregamento, movimentação de cargas.
                    </p>
                    <a href="/formacao4" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 5 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/7.jpg') }}" alt="Veículos de Emergência" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-ambulance mr-1"></i> Emergência
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Condução de Veículos de Emergência
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Dotar os participantes de conhecimentos teóricos, técnicos e práticos de condução defensiva e dos primeiros socorros.
                    </p>
                    <a href="/formacao5" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 6 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/6.JPG') }}" alt="Psicologia de Trânsito" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-brain mr-1"></i> Psicologia
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Psicologia de Trânsito e Prevenção de Acidentes
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Dotar os participantes/motoristas de conhecimentos para entender as variáveis relacionadas aos acidentes na dinâmica do trânsito.
                    </p>
                    <a href="/formacao6" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 7 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/5.jpg') }}" alt="Primeiros Socorros" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-heartbeat mr-1"></i> Socorros
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Primeiros Socorros
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Primeiros socorros é o tipo de atendimento, temporário e imediato, prestado à vítima de acidente ou mal súbito, antes da chegada do socorro médico especializado.
                    </p>
                    <a href="/formacao7" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Course 8 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('uploads/3.JPG') }}" alt="Higiene e Segurança" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-yellow-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-shield-alt mr-1"></i> Segurança
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Higiene e Segurança no Trabalho - Motoristas
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Dotar os participantes de princípios básicos relativos às questões de higiene e segurança no trabalho.
                    </p>
                    <a href="/formacao8" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                        Ver mais <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-green-600 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            Pronto para começar sua formação profissional?
        </h2>
        <p class="text-xl text-green-100 mb-8">
            Inscreva-se agora e invista no seu futuro profissional
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/inscricao" class="inline-flex items-center justify-center bg-white text-green-600 hover:bg-green-50 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg shadow-lg">
                <i class="fas fa-pencil-alt mr-3"></i> Inscrever-se Agora
            </a>
            <a href="/cursoinfo" class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white hover:bg-white hover:text-green-600 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg">
                <i class="fas fa-info-circle mr-3"></i> Saber Mais
            </a>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Tem alguma dúvida?</h3>
            <p class="text-gray-600 mb-6">
                Entre em contato conosco e nossa equipe terá prazer em ajudá-lo
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="tel:+258845678901" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                    <i class="fas fa-phone-alt mr-2"></i> +258 84 567 8901
                </a>
                <a href="mailto:formacao@motoristas.co.mz" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                    <i class="fas fa-envelope mr-2"></i> formacao@motoristas.co.mz
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

