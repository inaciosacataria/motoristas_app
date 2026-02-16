<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Motoristas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen">
    
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="/" class="flex justify-center mb-8">
                <img src="{{ asset('assets/images/2.png') }}" alt="Logo Motoristas" class="h-20 w-auto object-contain max-w-[200px]">
            </a>
            <h2 class="text-center text-4xl font-bold text-gray-900 mb-2">
                @if (isset($_GET['candidato']))
                    <i class="fas fa-user text-green-600"></i> Login Candidato
                @else
                    <i class="fas fa-building text-green-600"></i> Login Empregador
                @endif
            </h2>
            <p class="mt-2 text-center text-lg text-gray-600">
                Entre com suas credenciais para acessar sua conta
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-100">
                @if (isset($_GET['candidato']))
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="email" id="email_login" />
                        
                        <div>
                            <label for="number" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-green-600 mr-2"></i>Número de Celular <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="number" 
                                id="number"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                                placeholder="84XXXXXXX"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-green-600 mr-2"></i>Senha <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200" 
                                placeholder="••••••••"
                                required
                            >
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700 font-semibold transition duration-200">
                                    Esqueceu a senha?
                                </a>
                            @endif
                        </div>
                        
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i> Entrar
                        </button>
                        
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500 font-medium">ou</span>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="{{ route('register') }}?candidato=1" class="w-full flex justify-center py-3 px-4 border-2 border-green-600 rounded-lg shadow-sm text-lg font-semibold text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                                <i class="fas fa-user-plus mr-2"></i> Criar Conta de Candidato
                            </a>
                            <a href="{{ route('login', 'recrutador') }}" class="w-full flex justify-center py-2 px-4 text-green-600 hover:text-green-700 font-medium transition duration-200">
                                <i class="fas fa-building mr-2"></i> Sou Empregador
                            </a>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-green-600 mr-2"></i>Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200 @error('email') border-red-500 @enderror" 
                                placeholder="seu@email.com"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-green-600 mr-2"></i>Senha <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg transition duration-200 @error('password') border-red-500 @enderror" 
                                placeholder="••••••••"
                                required
                            >
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700 font-semibold transition duration-200">
                                    Esqueceu a senha?
                                </a>
                            @endif
                        </div>
                        
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i> Entrar
                        </button>
                        
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500 font-medium">ou</span>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="{{ route('register') }}" class="w-full flex justify-center py-3 px-4 border-2 border-green-600 rounded-lg shadow-sm text-lg font-semibold text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                                <i class="fas fa-building mr-2"></i> Criar Conta de Empregador
                            </a>
                            <a href="{{ route('login', 'candidato') }}" class="w-full flex justify-center py-2 px-4 text-green-600 hover:text-green-700 font-medium transition duration-200">
                                <i class="fas fa-user mr-2"></i> Sou Candidato
                            </a>
                        </div>
                    </form>
                @endif
            </div>
            
            <!-- Benefits -->
            <div class="mt-8 bg-gradient-to-r from-green-600 to-green-700 text-white py-6 px-6 rounded-2xl shadow-lg">
                @if (isset($_GET['candidato']))
                    <h3 class="text-2xl font-bold mb-4 text-center">
                        <i class="fas fa-star mr-2"></i> Para Candidatos
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Acesso a vagas exclusivas de empresas verificadas</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Perfil profissional completo com CV digital</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Candidatura espontânea para empresas</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Acesso a formações e certificações</span>
                        </li>
                    </ul>
                @else
                    <h3 class="text-2xl font-bold mb-4 text-center">
                        <i class="fas fa-star mr-2"></i> Para Empregadores
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Publique vagas gratuitamente</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Acesso a motoristas qualificados e verificados</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Gestão completa de candidaturas</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle mt-1 flex-shrink-0 text-green-200"></i>
                            <span>Consulta à Central de Risco</span>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        // Auto-gerar email para candidatos a partir do celular
        document.addEventListener('DOMContentLoaded', function() {
            const numberInput = document.getElementById('number');
            const emailInput = document.getElementById('email_login');
            
            if (numberInput && emailInput) {
                numberInput.addEventListener('input', function() {
                    var celular = this.value;
                    emailInput.value = celular + "@motoristas.co.mz";
                });
            }
            
            // Adicionar efeito de foco nos inputs
            const inputs = document.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('transform', 'scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('transform', 'scale-105');
                });
            });
        });
    </script>
</body>
</html>
