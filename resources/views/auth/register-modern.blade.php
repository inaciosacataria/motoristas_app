<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Criar Conta - Motoristas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen py-8">
    
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-block">
                <img src="{{ asset('assets/images/2.png') }}" alt="Logo Motoristas" class="h-20 mx-auto mb-4 object-contain max-w-[200px]">
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                @if (isset($_GET['candidato']))
                    <i class="fas fa-user-plus text-green-600"></i> Criar Conta de Candidato
                @else
                    <i class="fas fa-building text-green-600"></i> Criar Conta de Empregador
                @endif
            </h1>
            <p class="text-lg text-gray-600 mt-2">Preencha o formulário para criar sua conta</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
                <div class="p-8">
                    @if (isset($_GET['candidato']))
                        <!-- Formulário Candidato -->
                        <form method="POST" action="{{ route('newCandidato') }}" class="space-y-8">
                            @csrf
                            <input type="hidden" name="privilegio" value="candidato" />
                            
                            <!-- Informações Pessoais -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-user text-green-600 mr-3"></i> Informações Pessoais
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-user text-green-600 mr-2"></i>Nome Completo <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="João da Silva" required>
                                    </div>
                                    <div>
                                        <label for="celular" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-phone text-green-600 mr-2"></i>Celular <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="celular" id="celular" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="84XXXXXXX" required>
                                    </div>
                                    <div>
                                        <label for="data_nascimento" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-calendar text-green-600 mr-2"></i>Data de Nascimento <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" name="data_nascimento" id="data_nascimento" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                    </div>
                                    <div>
                                        <label for="nacionalidade" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-flag text-green-600 mr-2"></i>Nacionalidade <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="nacionalidade" id="nacionalidade" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Moçambicana" required>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-venus-mars text-green-600 mr-2"></i> Sexo <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex gap-6">
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" name="sexo" value="Masculino" class="h-4 w-4 text-green-600 focus:ring-green-500" required>
                                            <span class="ml-2 text-gray-700 font-medium">Masculino</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" name="sexo" value="Feminino" class="h-4 w-4 text-green-600 focus:ring-green-500">
                                            <span class="ml-2 text-gray-700 font-medium">Feminino</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Educação -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-graduation-cap text-green-600 mr-3"></i> Educação
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="nivel" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-book text-green-600 mr-2"></i>Nível Académico <span class="text-red-500">*</span>
                                        </label>
                                        <select name="nivel" id="nivel" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                            <option value="">Selecione o nível</option>
                                            <option value="Escolar">Escolar</option>
                                            <option value="Tecnico-Profissional">Técnico-Profissional</option>
                                            <option value="Superior">Superior</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="grau_academico" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-award text-green-600 mr-2"></i>Grau <span class="text-red-500">*</span>
                                        </label>
                                        <select name="grau_academico" id="grau_academico" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                            <option value="">Selecione o grau</option>
                                            <option value="1ª à 5ª Classe">1ª à 5ª Classe</option>
                                            <option value="6ª à 7ª Classe">6ª à 7ª Classe</option>
                                            <option value="8ª à 10ª Classe">8ª à 10ª Classe</option>
                                            <option value="11ª à 12ª Classe">11ª à 12ª Classe</option>
                                            <option value="Tecnico Básico">Técnico Básico</option>
                                            <option value="Licenciatura">Licenciatura</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Localização -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-map-marker-alt text-green-600 mr-3"></i> Localização
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @php $provincias = App\Models\Provincias::all(); @endphp
                                    <div>
                                        <label for="provincia_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-map text-green-600 mr-2"></i>Província <span class="text-red-500">*</span>
                                        </label>
                                        <select name="provincia_id" id="provincia_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                            <option value="">Selecione a província</option>
                                            @foreach ($provincias as $provincia)
                                                <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="endereco" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-home text-green-600 mr-2"></i> Endereço <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="endereco" id="endereco" rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Bairro, Rua, Quarteirão..." required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Habilitação -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-id-card text-green-600 mr-3"></i> Carta de Condução
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @php $categorias = App\Models\Categorias::all(); @endphp
                                    <div>
                                        <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-car text-green-600 mr-2"></i>Categoria <span class="text-red-500">*</span>
                                        </label>
                                        <select name="categoria_id" id="categoria_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                            <option value="">Selecione a categoria</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="numero_carta_conducao" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-hashtag text-green-600 mr-2"></i>Número da Carta (Opcional)
                                        </label>
                                        <input type="text" name="numero_carta_conducao" id="numero_carta_conducao" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="12345678">
                                    </div>
                                </div>
                                
                                <div class="mt-6 space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">Carta dentro da validade?</label>
                                        <div class="flex gap-6">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="validade_conducao" value="Sim" class="h-4 w-4 text-green-600 focus:ring-green-500">
                                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="validade_conducao" value="Não" class="h-4 w-4 text-green-600 focus:ring-green-500">
                                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">Já foi inibido de conduzir?</label>
                                        <div class="flex gap-6">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="inibicao_anterior" value="Sim" class="h-4 w-4 text-green-600 focus:ring-green-500" onchange="document.getElementById('inibicao_motivo').classList.remove('hidden')">
                                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="inibicao_anterior" value="Não" class="h-4 w-4 text-green-600 focus:ring-green-500" onchange="document.getElementById('inibicao_motivo').classList.add('hidden')">
                                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div id="inibicao_motivo" class="hidden">
                                        <textarea name="inibicao_motivo" rows="2" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Motivo da inibição..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Segurança -->
                            <div class="pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-lock text-green-600 mr-3"></i> Segurança
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-lock text-green-600 mr-2"></i>Senha <span class="text-red-500">*</span>
                                        </label>
                                        <input type="password" name="password" id="password" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Mínimo 8 caracteres" required>
                                    </div>
                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-lock text-green-600 mr-2"></i>Confirmar Senha <span class="text-red-500">*</span>
                                        </label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Repita a senha" required>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i> A senha deve ter no mínimo 8 caracteres
                                </p>
                            </div>

                            <!-- Submit -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                                <a href="{{ route('login', 'candidato') }}" class="flex-1 flex justify-center py-3 px-4 border-2 border-gray-300 rounded-lg shadow-sm text-lg font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200">
                                    <i class="fas fa-arrow-left mr-2"></i> Voltar
                                </a>
                                <button type="submit" class="flex-1 flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                                    <i class="fas fa-user-plus mr-2"></i> Criar Conta
                                </button>
                            </div>
                        </form>
                    @else
                        <!-- Formulário Empregador -->
                        <form method="POST" action="{{ route('newempregador') }}" class="space-y-8">
                            @csrf
                            <input type="hidden" name="privilegio" value="empregador" />
                            
                            <!-- Informações da Empresa -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-building text-green-600 mr-3"></i> Informações da Empresa
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-building text-green-600 mr-2"></i>Nome da Empresa <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Transportes XYZ Lda" required>
                                    </div>
                                    <div>
                                        <label for="newemail" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-envelope text-green-600 mr-2"></i>Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" name="newemail" id="newemail" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="empresa@email.com" required>
                                    </div>
                                    <div>
                                        <label for="nuit" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-hashtag text-green-600 mr-2"></i>NUIT <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="nuit" id="nuit" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="400123456" required>
                                    </div>
                                    
                                    <div>
                                        <label for="sector_actividade" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-briefcase text-green-600 mr-2"></i>Sector de Atividade <span class="text-red-500">*</span>
                                        </label>
                                        <select name="sector_actividade" id="sector_actividade" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                            <option value="">Selecione o sector</option>
                                            <option value="transporte">Transporte e Logística</option>
                                            <option value="comercio">Comércio</option>
                                            <option value="industria">Indústria</option>
                                            <option value="turismo">Turismo</option>
                                            <option value="agricultura">Agricultura</option>
                                            <option value="mineração">Mineração</option>
                                            <option value="ONG">ONG</option>
                                            <option value="instituição publica">Instituição Pública</option>
                                            <option value="Outro">Outro</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mt-6" id="sector_especificado_container" style="display: none;">
                                    <label for="sector_especificado" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-info text-green-600 mr-2"></i>Especifique o Setor
                                    </label>
                                    <input type="text" name="sector_especificado" id="sector_especificado" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Digite o setor...">
                                </div>
                            </div>

                            <!-- Representante e Contactos -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-user-tie text-green-600 mr-3"></i> Representante e Contactos
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="representante" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-user text-green-600 mr-2"></i>Nome do Representante <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="representante" id="representante" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Nome completo" required>
                                    </div>
                                    <div>
                                        <label for="telefone" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-phone text-green-600 mr-2"></i>Telefone <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="telefone" id="telefone" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="84XXXXXXX" required>
                                    </div>
                                    <div>
                                        <label for="telefone_alt" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-phone text-green-600 mr-2"></i>Telefone Alternativo
                                        </label>
                                        <input type="number" name="telefone_alt" id="telefone_alt" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="82XXXXXXX (opcional)">
                                    </div>
                                    <div>
                                        <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-globe text-green-600 mr-2"></i>Website
                                        </label>
                                        <input type="url" name="website" id="website" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="https://empresa.com (opcional)">
                                    </div>
                                </div>
                            </div>

                            <!-- Localização -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-map-marker-alt text-green-600 mr-3"></i> Localização
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @php $provincias = App\Models\Provincias::all(); @endphp
                                    <div>
                                        <label for="provincia_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-map text-green-600 mr-2"></i>Província <span class="text-red-500">*</span>
                                        </label>
                                        <select name="provincia_id" id="provincia_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" required>
                                            <option value="">Selecione a província</option>
                                            @foreach ($provincias as $provincia)
                                                <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="endereco" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-home text-green-600 mr-2"></i> Endereço <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="endereco" id="endereco" rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Av. Julius Nyerere, 1234..." required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Sobre a Empresa -->
                            <div class="border-b border-gray-200 pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-info-circle text-green-600 mr-3"></i> Sobre a Empresa
                                </h3>
                                <textarea name="sobre" id="sobre" rows="4" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Conte um pouco sobre sua empresa... (opcional)"></textarea>
                            </div>

                            <!-- Segurança -->
                            <div class="pb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-shield-alt text-green-600 mr-3"></i> Criar Senha
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-lock text-green-600 mr-2"></i>Senha <span class="text-red-500">*</span>
                                        </label>
                                        <input type="password" name="password" id="password" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Mínimo 8 caracteres" required>
                                    </div>
                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-lock text-green-600 mr-2"></i>Confirmar Senha <span class="text-red-500">*</span>
                                        </label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" placeholder="Repita a senha" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                                <a href="{{ route('login', 'recrutador') }}" class="flex-1 flex justify-center py-3 px-4 border-2 border-gray-300 rounded-lg shadow-sm text-lg font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200">
                                    <i class="fas fa-arrow-left mr-2"></i> Voltar ao Login
                                </a>
                                <button type="submit" class="flex-1 flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                                    <i class="fas fa-check mr-2"></i> Criar Conta
                                </button>
                            </div>
                            
                            <p class="text-center text-sm text-gray-600 mt-6">
                                Ao criar uma conta, você concorda com nossos 
                                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Termos de Serviço</a> e 
                                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Política de Privacidade</a>
                            </p>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // Auto-gerar email para candidatos
        $('input[name="celular"]').on('input', function() {
            var celular = $(this).val();
            $('input[name="email"]').val(celular + "@motoristas.co.mz");
        });
        
        // Mostrar/esconder campo sector_especificado
        $('select[name="sector_actividade"]').on('change', function() {
            if ($(this).val() === 'Outro') {
                $('#sector_especificado_container').slideDown();
            } else {
                $('#sector_especificado_container').slideUp();
            }
        });
        
        // Adicionar efeito de foco nos inputs
        $('input, select, textarea').on('focus', function() {
            $(this).parent().addClass('transform scale-105');
        }).on('blur', function() {
            $(this).parent().removeClass('transform scale-105');
        });
    </script>
</body>
</html>

