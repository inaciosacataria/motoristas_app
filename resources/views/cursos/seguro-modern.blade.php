@extends('layouts.modern')

@section('title', 'Seguro para Motoristas')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6">
                <i class="fas fa-shield-alt text-3xl"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Seguro para Motoristas
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                Proteção completa para você e sua família com os melhores planos de seguro
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/inscricaoSeguro" class="inline-flex items-center justify-center bg-white text-blue-600 hover:bg-blue-50 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg shadow-lg">
                    <i class="fas fa-file-contract mr-3"></i> Solicitar Cotação
                </a>
                <a href="#planos" class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg">
                    <i class="fas fa-eye mr-3"></i> Ver Planos
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="bg-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Por que Contratar um Seguro?</h2>
            <p class="text-xl text-gray-600">Proteção e tranquilidade para você e sua família</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6 group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-shield-alt text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Proteção Total</h3>
                <p class="text-gray-600">Cobertura completa para acidentes</p>
            </div>
            
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6 group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-heartbeat text-3xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Assistência Médica</h3>
                <p class="text-gray-600">Atendimento de emergência 24h</p>
            </div>
            
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-6 group-hover:bg-purple-200 transition-colors">
                    <i class="fas fa-users text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Família Protegida</h3>
                <p class="text-gray-600">Cobertura para dependentes</p>
            </div>
            
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-yellow-100 rounded-full mb-6 group-hover:bg-yellow-200 transition-colors">
                    <i class="fas fa-hand-holding-usd text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Preços Acessíveis</h3>
                <p class="text-gray-600">Planos que cabem no seu bolso</p>
            </div>
        </div>
    </div>
</div>

<!-- Insurance Plans -->
<div id="planos" class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Nossos Planos de Seguro</h2>
            <p class="text-xl text-gray-600">Escolha o plano ideal para suas necessidades</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Plano Básico -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 text-white p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                            <i class="fas fa-shield text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Plano Básico</h3>
                        <p class="text-gray-200">Proteção Essencial</p>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="text-4xl font-bold text-gray-900 mb-2">
                            Sob Consulta
                        </div>
                        <p class="text-gray-600">por mês</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Cobertura para acidentes pessoais</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Assistência médica de emergência</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Indenização por invalidez</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Cobertura 24 horas</span>
                        </li>
                    </ul>
                    
                    <a href="/inscricaoSeguro?plano=basico" class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-4 px-6 rounded-lg text-center transition duration-200">
                        Solicitar Cotação
                    </a>
                </div>
            </div>

            <!-- Plano Profissional (Destaque) -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform scale-105 border-4 border-blue-500 relative">
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="bg-blue-500 text-white px-6 py-2 rounded-full text-sm font-bold">
                        MAIS POPULAR
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                            <i class="fas fa-star text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Plano Profissional</h3>
                        <p class="text-blue-200">Proteção Completa</p>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">
                            Sob Consulta
                        </div>
                        <p class="text-gray-600">por mês</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700"><strong>Tudo do Plano Básico</strong></span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Cobertura para dependentes</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Assistência funeral</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Indenização por morte acidental</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Diária por internamento hospitalar</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Suporte prioritário</span>
                        </li>
                    </ul>
                    
                    <a href="/inscricaoSeguro?plano=profissional" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg text-center transition duration-200">
                        Solicitar Cotação
                    </a>
                </div>
            </div>

            <!-- Plano Premium -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                            <i class="fas fa-crown text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Plano Premium</h3>
                        <p class="text-yellow-200">Proteção Máxima</p>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="text-4xl font-bold text-yellow-600 mb-2">
                            Sob Consulta
                        </div>
                        <p class="text-gray-600">por mês</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700"><strong>Tudo do Plano Profissional</strong></span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Cobertura internacional</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Seguro de vida</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Reembolso de despesas médicas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Assessoria jurídica</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-3 mt-1"></i>
                            <span class="text-gray-700">Atendimento VIP</span>
                        </li>
                    </ul>
                    
                    <a href="/inscricaoSeguro?plano=premium" class="block w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg text-center transition duration-200">
                        Solicitar Cotação
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Coverage Details -->
<div class="bg-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center">O que está Coberto?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-8 rounded-2xl border border-blue-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-ambulance text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Acidentes de Trânsito</h3>
                            <p class="text-gray-600">Cobertura completa para acidentes durante o trabalho ou em viagens pessoais</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-green-100 p-8 rounded-2xl border border-green-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-hospital text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Despesas Médicas</h3>
                            <p class="text-gray-600">Reembolso de consultas, exames e procedimentos médicos</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-8 rounded-2xl border border-purple-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-wheelchair text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Invalidez Permanente</h3>
                            <p class="text-gray-600">Indenização em caso de invalidez parcial ou total</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-red-50 to-red-100 p-8 rounded-2xl border border-red-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart-broken text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Morte Acidental</h3>
                            <p class="text-gray-600">Apoio financeiro para a família em caso de fatalidade</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 py-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">
            Proteja seu Futuro e de sua Família
        </h2>
        <p class="text-xl text-blue-100 mb-10">
            Solicite uma cotação gratuita e sem compromisso
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/inscricaoSeguro" class="inline-flex items-center justify-center bg-white text-blue-600 hover:bg-blue-50 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg shadow-lg">
                <i class="fas fa-file-contract mr-3"></i> Solicitar Cotação Grátis
            </a>
            <a href="/formacao" class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-bold py-4 px-8 rounded-lg transition duration-200 text-lg">
                <i class="fas fa-graduation-cap mr-3"></i> Ver Formações
            </a>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center">Perguntas Frequentes</h2>
            
            <div class="space-y-6">
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-question-circle text-blue-600 mr-3"></i> Como funciona o seguro?
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Você paga uma mensalidade e em caso de acidente ou emergência, o seguro cobre os custos conforme o plano contratado.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-question-circle text-blue-600 mr-3"></i> Posso incluir minha família?
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sim! Os planos Profissional e Premium incluem cobertura para dependentes (cônjuge e filhos).
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-question-circle text-blue-600 mr-3"></i> Qual a carência?
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        A carência varia de acordo com o tipo de cobertura. Nossa equipe irá esclarecer todos os detalhes na cotação.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-question-circle text-blue-600 mr-3"></i> Como acionar o seguro?
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Em caso de emergência, ligue para nossa central 24h ou acesse o portal do segurado para abrir um sinistro.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">Tem alguma dúvida?</h3>
            <p class="text-xl text-gray-600 mb-10">
                Entre em contato conosco e nossa equipe terá prazer em ajudá-lo
            </p>
            <div class="flex flex-col sm:flex-row gap-8 justify-center">
                <a href="tel:+258845678901" class="inline-flex items-center justify-center bg-blue-600 text-white hover:bg-blue-700 font-bold py-4 px-8 rounded-lg transition duration-200">
                    <i class="fas fa-phone-alt mr-3"></i> +258 84 567 8901
                </a>
                <a href="mailto:seguros@motoristas.co.mz" class="inline-flex items-center justify-center bg-green-600 text-white hover:bg-green-700 font-bold py-4 px-8 rounded-lg transition duration-200">
                    <i class="fas fa-envelope mr-3"></i> seguros@motoristas.co.mz
                </a>
                <a href="https://wa.me/258845678901" target="_blank" class="inline-flex items-center justify-center bg-green-500 text-white hover:bg-green-600 font-bold py-4 px-8 rounded-lg transition duration-200">
                    <i class="fab fa-whatsapp mr-3"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endsection