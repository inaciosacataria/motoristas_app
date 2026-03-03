<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirmar Senha - Motoristas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="/" class="flex justify-center mb-8">
                <img src="{{ asset('assets/images/2.png') }}" alt="Logo Motoristas" class="h-16 w-auto object-contain max-w-[200px]">
            </a>
            <h2 class="text-center text-3xl font-bold text-gray-900 mb-2">
                <i class="fas fa-lock text-green-600 mr-2"></i> Confirmar Senha
            </h2>
            <p class="mt-2 text-center text-base text-gray-600">
                Por favor, confirme a sua senha antes de continuar.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-100">
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key text-green-600 mr-2"></i>Senha
                        </label>
                        <input 
                            id="password" 
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 text-base transition duration-200 @error('password') border-red-500 @enderror"
                        >
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200"
                    >
                        <i class="fas fa-check mr-2"></i> Confirmar Senha
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-center text-sm text-gray-500 mt-4">
                            <a href="{{ route('password.request') }}" class="text-green-600 hover:text-green-700 font-semibold">
                                Esqueceu a senha?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>
</html>
