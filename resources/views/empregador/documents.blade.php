@extends('layouts.modern')

@section('title', 'Envio de Documentos da Empresa')

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-10">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Validação de Conta de Empregador</h1>
            <p class="text-green-100 text-sm md:text-base">
                Para ativar a sua conta, precisamos validar os documentos da sua empresa.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 md:p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="hidden md:flex items-center justify-center w-14 h-14 rounded-full bg-green-100">
                    <i class="fas fa-file-upload text-green-600 text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Envie os documentos obrigatórios</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Envie os seguintes documentos em formato PDF. A equipa do portal irá validar os dados antes de ativar a sua conta.
                    </p>
                </div>
            </div>

            <form action="{{ route('uploadAlldocuments') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userId }}">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nuit da Empresa <span class="text-red-500">*</span>
                    </label>
                    <input type="file"
                           name="documento_nuit"
                           accept="application/pdf"
                           required
                           class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <p class="mt-1 text-xs text-gray-500">Apenas ficheiros PDF.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Certidão de Registo Comercial <span class="text-red-500">*</span>
                    </label>
                    <input type="file"
                           name="documento_certidao_empresa"
                           accept="application/pdf"
                           required
                           class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <p class="mt-1 text-xs text-gray-500">Documento que comprova o registo da empresa.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Início de Actividades <span class="text-red-500">*</span>
                    </label>
                    <input type="file"
                           name="documento_inicio_actividade"
                           accept="application/pdf"
                           required
                           class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <p class="mt-1 text-xs text-gray-500">Comprovativo de início de actividades emitido pelas Finanças.</p>
                </div>

                <div class="pt-4 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
                    <p class="text-xs text-gray-500">
                        Depois de enviar, a equipa do portal irá rever os documentos. Será notificado por email quando a conta for aprovada.
                    </p>
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <i class="fas fa-check mr-2"></i>
                        Enviar Documentos
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
