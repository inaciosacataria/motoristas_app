@extends('layouts.modern')

@section('title', 'Inscrição para Seguro')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6">
                <i class="fas fa-shield-alt text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Inscrição para Seguro</h1>
            <p class="text-xl text-blue-100 mb-6">Preencha o formulário abaixo para solicitar uma cotação</p>
            <a href="/seguro" class="inline-flex items-center justify-center bg-white text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg font-semibold transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Voltar aos Planos
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Success Message -->
    @if (session('success'))
        <div class="max-w-3xl mx-auto mb-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-3xl mx-auto">
        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-2xl text-blue-600 mt-1"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-blue-900 mb-2">Antes de solicitar a cotação</h3>
                    <ul class="text-blue-800 space-y-2 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                            <span>Preencha todos os campos obrigatórios corretamente</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                            <span>Nossa equipe entrará em contato em até 24 horas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                            <span>Valores e condições serão informados por email ou telefone</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                <h2 class="text-2xl font-bold">
                    <i class="fas fa-file-contract mr-2"></i> Formulário de Solicitação de Cotação
                </h2>
            </div>

            <form method="POST" action="{{ route('submeter-seguro') }}" class="p-8 space-y-6">
                @csrf

                <!-- Tipo de Plano -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-user-tag text-blue-600 mr-2"></i>Tipo de Contratação <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex flex-col items-center justify-center p-6 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition duration-200 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                            <input type="radio" name="plano" id="plano-empresa" value="Empresa" class="hidden" {{ request('plano') == 'basico' || request('plano') == 'profissional' || request('plano') == 'premium' ? '' : 'checked' }}>
                            <i class="fas fa-building text-4xl text-gray-600 has-[:checked]:text-blue-600 mb-3"></i>
                            <span class="text-lg font-semibold text-gray-800 has-[:checked]:text-blue-800">Empresa</span>
                            <p class="text-sm text-gray-500 text-center mt-1">Para grupos de motoristas</p>
                        </label>
                        <label class="flex flex-col items-center justify-center p-6 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition duration-200 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                            <input type="radio" name="plano" id="plano-individual" value="Individual" class="hidden">
                            <i class="fas fa-user text-4xl text-gray-600 has-[:checked]:text-blue-600 mb-3"></i>
                            <span class="text-lg font-semibold text-gray-800 has-[:checked]:text-blue-800">Individual</span>
                            <p class="text-sm text-gray-500 text-center mt-1">Para motorista individual</p>
                        </label>
                    </div>
                </div>

                <!-- Dados Pessoais/Empresa -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-user text-blue-600 mr-3"></i> Dados de Contato
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nome" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-blue-600 mr-2"></i>Nome Completo <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nome" 
                                id="nome" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition duration-200" 
                                placeholder="João da Silva"
                                required
                            >
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-blue-600 mr-2"></i>Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition duration-200" 
                                placeholder="joao@exemplo.com"
                                required
                            >
                        </div>
                        <div>
                            <label for="contacto" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-blue-600 mr-2"></i>Contacto <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="contacto" 
                                id="contacto" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition duration-200" 
                                placeholder="84XXXXXXX"
                                required
                            >
                        </div>
                        <div>
                            <label for="numerodemotoristas" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-blue-600 mr-2"></i>Número de Motoristas
                            </label>
                            <input 
                                type="number" 
                                name="numerodemotoristas" 
                                id="numerodemotoristas" 
                                min="1"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition duration-200" 
                                placeholder="1"
                            >
                            <p class="text-xs text-gray-500 mt-1">Deixe em branco se for individual</p>
                        </div>
                    </div>
                </div>

                <!-- Plano de Seguro -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-shield-alt text-blue-600 mr-3"></i> Plano de Seguro
                    </h3>
                    <div>
                        <label for="seguro" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-list text-blue-600 mr-2"></i>Selecione o Plano <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="seguro" 
                            id="seguro" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition duration-200 bg-white"
                            required
                        >
                            @php
                                $planoSelecionado = request('plano');
                                $opcoes = [
                                    'basico' => 'Pacote Básico',
                                    'profissional' => 'Pacote Profissional',
                                    'premium' => 'Pacote Premium'
                                ];
                            @endphp
                            <option value="">Selecione um plano...</option>
                            <option value="Seguro de motorista - Pacote Básico" {{ $planoSelecionado == 'basico' ? 'selected' : '' }}>
                                Pacote Básico
                            </option>
                            <option value="Seguro de motorista - Pacote Profissional" {{ $planoSelecionado == 'profissional' ? 'selected' : '' }}>
                                Pacote Profissional
                            </option>
                            <option value="Seguro de motorista - Pacote Premium" {{ $planoSelecionado == 'premium' ? 'selected' : '' }}>
                                Pacote Premium
                            </option>
                        </select>
                        @if($planoSelecionado && isset($opcoes[$planoSelecionado]))
                            <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-sm text-blue-800">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Você está solicitando cotação para o <strong>{{ $opcoes[$planoSelecionado] }}</strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Observações -->
                <div class="border-t border-gray-200 pt-6">
                    <label for="observacoes" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-blue-600 mr-2"></i>Observações <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="observacoes" 
                        id="observacoes" 
                        rows="5"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition duration-200 resize-none" 
                        placeholder="Descreva suas necessidades, dúvidas ou informações adicionais..."
                        required
                    ></textarea>
                    <p class="text-xs text-gray-500 mt-1">Forneça informações adicionais que possam nos ajudar a preparar a melhor cotação para você</p>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-gray-200 pt-6">
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition duration-200 text-lg flex items-center justify-center"
                    >
                        <i class="fas fa-paper-plane mr-3"></i>
                        Enviar Solicitação de Cotação
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-4">
                        <i class="fas fa-lock mr-1"></i>
                        Seus dados estão seguros e serão usados apenas para contato
                    </p>
                </div>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-headset text-blue-600 mr-2"></i> Precisa de Ajuda?
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div class="flex items-center">
                    <i class="fas fa-phone text-blue-600 mr-3"></i>
                    <span>Ligue-nos: <strong>+258 84 XXX XXXX</strong></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-blue-600 mr-3"></i>
                    <span>Email: <strong>seguros@motoristas.co.mz</strong></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Adicionar efeito de foco nos inputs
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('transform', 'scale-105');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('transform', 'scale-105');
        });
    });

    // Atualizar visual dos radio buttons
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Remover checked de todos
            radioButtons.forEach(function(r) {
                r.closest('label').classList.remove('border-blue-600', 'bg-blue-50');
            });
            // Adicionar ao selecionado
            if (this.checked) {
                this.closest('label').classList.add('border-blue-600', 'bg-blue-50');
            }
        });
    });
});
</script>
@endsection

