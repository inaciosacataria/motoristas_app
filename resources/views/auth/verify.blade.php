<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificar Email - Motoristas</title>
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
                <i class="fas fa-envelope-open-text text-green-600 mr-2"></i> Verifique o seu email
            </h2>
            <p class="mt-2 text-center text-base text-gray-600">
                Enviámos um link de verificação para o seu endereço de email.  
                Clique no link para ativar a sua conta.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-100 space-y-4">
                @if (session('resent'))
                    <div class="mb-2 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>Um novo link de verificação foi enviado para o seu email.</span>
                    </div>
                @endif

                <p class="text-sm text-gray-700">
                    Se não recebeu o email, pode solicitar um novo link abaixo.
                </p>

                <form method="POST" action="{{ route('verification.resend') }}" class="space-y-4">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200"
                    >
                        <i class="fas fa-redo mr-2"></i> Enviar novo link de verificação
                    </button>
                </form>

                <div class="text-center text-sm text-gray-500 mt-4">
                    <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold">
                        Voltar ao login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
