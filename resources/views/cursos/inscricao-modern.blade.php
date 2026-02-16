@extends('layouts.modern')

@section('title', 'Inscrição para Formações')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Inscrição para Formações</h1>
                <p class="text-green-100 mt-1">Preencha o formulário abaixo para se inscrever</p>
            </div>
            <a href="/formacao" class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg border border-white font-semibold transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Voltar aos Cursos
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Success Message -->
    @if (session('success'))
        <div class="max-w-3xl mx-auto mb-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-3xl mx-auto">
        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-2xl text-blue-600 mt-1"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-blue-900 mb-2">Antes de se inscrever</h3>
                    <ul class="text-blue-800 space-y-2 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                            <span>Preencha todos os campos obrigatórios corretamente</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                            <span>Nossa equipe entrará em contato em até 48 horas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mr-2 mt-1"></i>
                            <span>Valores e datas serão informados por email ou telefone</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white p-6">
                <h2 class="text-2xl font-bold">
                    <i class="fas fa-pencil-alt mr-2"></i> Formulário de Inscrição
                </h2>
            </div>

            <form method="POST" action="{{ route('submeter-inscricao') }}" class="p-6 space-y-6">
                @csrf

                <!-- Tipo de Plano -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-user-tag text-green-600 mr-2"></i>Tipo de Inscrição <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-6">
                        <label class="flex items-center cursor-pointer bg-gray-50 hover:bg-gray-100 p-4 rounded-lg border-2 border-gray-200 transition duration-200 flex-1">
                            <input type="radio" name="plano" value="Empresa" class="h-4 w-4 text-green-600 focus:ring-green-500" required>
                            <div class="ml-3">
                                <span class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-building text-green-600 mr-2"></i> Empresa
                                </span>
                                <span class="text-xs text-gray-600">Para grupos de motoristas</span>
                            </div>
                        </label>
                        <label class="flex items-center cursor-pointer bg-gray-50 hover:bg-gray-100 p-4 rounded-lg border-2 border-gray-200 transition duration-200 flex-1">
                            <input type="radio" name="plano" value="Individual" class="h-4 w-4 text-green-600 focus:ring-green-500" required>
                            <div class="ml-3">
                                <span class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-user text-green-600 mr-2"></i> Individual
                                </span>
                                <span class="text-xs text-gray-600">Para motorista individual</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Dados Pessoais/Empresa -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        <i class="fas fa-user text-green-600 mr-2"></i> Informações Pessoais
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nome" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-green-600 mr-2"></i>Nome Completo / Empresa <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nome" 
                                id="nome"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                                placeholder="João da Silva / Empresa XYZ Lda"
                                required
                            >
                        </div>

                        <div>
                            <label for="contacto" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-green-600 mr-2"></i>Contacto <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                name="contacto" 
                                id="contacto"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                                placeholder="84XXXXXXX"
                                required
                            >
                        </div>

                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-green-600 mr-2"></i>Email <span class="text-gray-500">(Opcional)</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                                placeholder="seu@email.com"
                            >
                        </div>
                    </div>
                </div>

                <!-- Detalhes da Formação -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        <i class="fas fa-graduation-cap text-green-600 mr-2"></i> Detalhes da Formação
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <label for="curso" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-book text-green-600 mr-2"></i>Curso <span class="text-red-500">*</span>
                            </label>
                            <select 
                                name="curso" 
                                id="curso"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200"
                                required
                            >
                                <option value="">Selecione o curso</option>
                                <option value="FORMAÇÃO EM CONDUÇÃO DEFENSIVA NO TRANSPORTE DE CARGA">Condução Defensiva - Transporte de Carga</option>
                                <option value="FORMAÇÃO EM CONDUÇÃO DEFENSIVA NO TRANSPORTE COLETIVO DE PASSAGEIRO">Condução Defensiva - Transporte Coletivo de Passageiros</option>
                                <option value="FORMAÇÃO EM TRANSPORTE DE CARGA/PRODUTOS PERIGOSOS">Transporte de Carga/Produtos Perigosos</option>
                                <option value="FORMAÇÃO EM ARRUMAÇÃO DE CARGA">Arrumação de Carga</option>
                                <option value="FORMAÇÃO EM CONDUÇÃO DE VEÍCULOS DE EMERGÊNCIA">Condução de Veículos de Emergência</option>
                                <option value="PSICOLOGIA DE TRÂNSITO E PREVENÇÃO ACIDENTES">Psicologia de Trânsito e Prevenção de Acidentes</option>
                                <option value="FORMAÇÃO EM PRIMEIROS SOCORROS">Primeiros Socorros</option>
                                <option value="FORMAÇÃO HIGIENE, SEGURANÇA NO TRABALHO-MOTORISTAS">Higiene e Segurança no Trabalho - Motoristas</option>
                            </select>
                        </div>

                        <div>
                            <label for="numerodemotoristas" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-green-600 mr-2"></i>Número de Motoristas <span class="text-gray-500">(Opcional para empresas)</span>
                            </label>
                            <input 
                                type="number" 
                                name="numerodemotoristas" 
                                id="numerodemotoristas"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                                placeholder="Ex: 10"
                                min="1"
                            >
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i> Deixe em branco se for inscrição individual
                            </p>
                        </div>

                        <div>
                            <label for="observacoes" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-comment-alt text-green-600 mr-2"></i>Observações <span class="text-gray-500">(Opcional)</span>
                            </label>
                            <textarea 
                                name="observacoes" 
                                id="observacoes"
                                rows="4"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200"
                                placeholder="Informações adicionais, dúvidas ou requisitos especiais..."
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-gray-200 pt-6 flex gap-4">
                    <a href="/formacao" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-6 rounded-lg transition duration-200 text-center">
                        <i class="fas fa-times mr-2"></i> Cancelar
                    </a>
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                        <i class="fas fa-paper-plane mr-2"></i> Enviar Inscrição
                    </button>
                </div>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 bg-gray-100 rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 text-center">
                <i class="fas fa-headset text-green-600 mr-2"></i> Precisa de Ajuda?
            </h3>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+258845678901" class="inline-flex items-center justify-center text-green-600 hover:text-green-700 font-semibold">
                    <i class="fas fa-phone-alt mr-2"></i> +258 84 567 8901
                </a>
                <a href="mailto:formacao@motoristas.co.mz" class="inline-flex items-center justify-center text-green-600 hover:text-green-700 font-semibold">
                    <i class="fas fa-envelope mr-2"></i> formacao@motoristas.co.mz
                </a>
                <a href="https://wa.me/258845678901" target="_blank" class="inline-flex items-center justify-center text-green-600 hover:text-green-700 font-semibold">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Atualizar label quando selecionar tipo de plano
    document.querySelectorAll('input[name="plano"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const label = this.parentElement;
            document.querySelectorAll('input[name="plano"]').forEach(r => {
                r.parentElement.classList.remove('border-green-500', 'bg-green-50');
                r.parentElement.classList.add('border-gray-200');
            });
            label.classList.remove('border-gray-200');
            label.classList.add('border-green-500', 'bg-green-50');
        });
    });
</script>
@endpush

