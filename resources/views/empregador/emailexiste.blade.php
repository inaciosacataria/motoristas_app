@extends('layouts.modern')

@section('title', 'Email já registado')

@section('content')
<div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-10">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Email já possui uma conta</h1>
            <p class="text-red-100 text-sm md:text-base">
                Encontrámos uma conta existente com este email. Se esqueceu a sua senha ou está com dificuldades de acesso, veja as opções abaixo.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 md:p-8">
            <div class="flex items-start gap-4 mb-4">
                <div class="hidden md:flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Este email já está registado</h2>
                    <p class="text-sm text-gray-700">
                        Para proteger a sua conta, não é possível criar um novo registo com o mesmo email.
                    </p>
                </div>
            </div>

            <div class="space-y-4 text-sm text-gray-700">
                <p>
                    - Se já possui conta, tente fazer login usando o botão <strong>“Sou Empregador”</strong> no topo da página inicial.
                </p>
                <p>
                    - Se esqueceu a senha, utilize a opção de recuperação de senha na página de login.
                </p>
                <p>
                    - Se achar que isto é um erro, contacte a nossa equipa de suporte.
                </p>
            </div>

            <div class="mt-6 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
                <div class="text-xs text-gray-500">
                    Em caso de dúvidas, envie um email para <strong>info@motoristas.co.mz</strong>.
                </div>
                <div class="flex gap-3 justify-end">
                    <a href="/" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 text-sm hover:bg-gray-50 transition-colors">
                        <i class="fas fa-home mr-1"></i> Página inicial
                    </a>
                    <a href="mailto:info@motoristas.co.mz" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm hover:bg-red-700 transition-colors">
                        <i class="fas fa-envelope mr-1"></i> Contactar suporte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
