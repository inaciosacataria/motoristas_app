@extends('layouts.modern')

@section('title', 'Gestão de Publicidade')

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-8">
    <div class="container-custom">
        <div class="flex items-center justify-between">
            <div>
                <nav class="text-sm mb-2">
                    <a href="/admin" class="text-green-100 hover:text-white transition">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <span class="text-green-200 mx-2">/</span>
                    <span class="text-white">Gestão de Publicidade</span>
                </nav>
                <h1 class="text-3xl font-bold">Gestão de Publicidade</h1>
                <p class="text-green-100 mt-1">Administrar banners exibidos nas páginas (ex.: Empregador)</p>
            </div>
        </div>
    </div>
</div>

<div class="container-custom py-8">
    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
            <span class="font-semibold">Sucesso:</span> {{ session('success') }}
        </div>
    @endif
    @if(session('erro'))
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3">
            <span class="font-semibold">Erro:</span> {{ session('erro') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Formulário Nova Publicidade -->
        <div class="lg:col-span-1 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                <i class="fas fa-plus-circle text-green-600 mr-2"></i>
                Nova Publicidade
            </h2>
            <form action="{{ route('smart-ads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nome Interno <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="input w-full" placeholder="Ex.: Banner Superior Empregador" required>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Slug / Identificador <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="slug" value="{{ old('slug') }}"
                           class="input w-full" placeholder="Ex.: banner-empregador-top" required>
                    @error('slug')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Tipo de Banner
                    </label>
                    <select name="adType" id="adType" class="input w-full">
                        <option value="IMAGE" selected>Imagem (recomendado)</option>
                        <option value="HTML">HTML avançado</option>
                    </select>
                </div>
                <!-- Campos para Imagem -->
                <div id="imageFields" class="space-y-3">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Imagem do Banner <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="image" accept="image/*" class="input w-full">
                        @error('image')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Formatos recomendados: JPG, PNG ou WEBP. Tamanho máximo 4MB.
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Link de destino (opcional)
                        </label>
                        <input type="url" name="imageUrl" value="{{ old('imageUrl') }}" class="input w-full" placeholder="https://exemplo.com">
                        @error('imageUrl')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Texto alternativo (acessibilidade)
                        </label>
                        <input type="text" name="imageAlt" value="{{ old('imageAlt') }}" class="input w-full" placeholder="Descrição curta da imagem">
                        @error('imageAlt')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Campos para HTML -->
                <div id="htmlFields" class="space-y-2 hidden">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        HTML do Banner
                    </label>
                    <textarea name="body" rows="6" class="input w-full" placeholder="<div>...html do banner...</div>">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">
                        Para utilizadores avançados: pode colar um bloco HTML completo.
                    </p>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="enabled" name="enabled" value="1" class="rounded text-green-600" checked>
                    <label for="enabled" class="ml-2 text-sm text-gray-700">Ativo</label>
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full">
                        <i class="fas fa-save mr-2"></i> Guardar Publicidade
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de Publicidades -->
        <div class="lg:col-span-2 bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-bullhorn text-green-600 mr-2"></i>
                        Publicidades Cadastradas
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Apenas publicidades com <span class="font-semibold">Ativo = Sim</span> podem ser exibidas nas páginas.
                    </p>
                </div>
            </div>
            <div class="p-6 overflow-x-auto">
                @if($ads->count() > 0)
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="text-left py-2 px-2 text-sm font-semibold text-gray-600">Nome</th>
                                <th class="text-left py-2 px-2 text-sm font-semibold text-gray-600">Slug</th>
                                <th class="text-center py-2 px-2 text-sm font-semibold text-gray-600">Tipo</th>
                                <th class="text-center py-2 px-2 text-sm font-semibold text-gray-600">Ativo</th>
                                <th class="text-center py-2 px-2 text-sm font-semibold text-gray-600">Views / Clicks</th>
                                <th class="text-center py-2 px-2 text-sm font-semibold text-gray-600">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ads as $ad)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-2">
                                    <div class="font-semibold text-gray-900">{{ $ad->name }}</div>
                                </td>
                                <td class="py-3 px-2">
                                    <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">{{ $ad->slug }}</span>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    @if($ad->adType === 'IMAGE')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-image mr-1"></i> Imagem
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-code mr-1"></i> HTML
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <form action="{{ route('smart-ads.toggle', $ad->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold {{ $ad->enabled ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                            <i class="fas {{ $ad->enabled ? 'fa-toggle-on' : 'fa-toggle-off' }} mr-1"></i>
                                            {{ $ad->enabled ? 'Ativo' : 'Inativo' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3 px-2 text-center text-xs text-gray-600">
                                    {{ $ad->views }} / {{ $ad->clicks }}
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                                onclick="openEditModal({{ $ad->id }}, @js($ad->name), @js($ad->slug), @js($ad->body), '{{ $ad->adType }}', {{ $ad->enabled ? 'true' : 'false' }}, @js($ad->imageUrl), @js($ad->imageAlt))"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs rounded-lg transition-colors">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </button>
                                        <form action="{{ route('smart-ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta publicidade?');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs rounded-lg transition-colors">
                                                <i class="fas fa-trash mr-1"></i> Apagar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-500">Nenhuma publicidade cadastrada.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Publicidade -->
<div id="editAdModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">
                <i class="fas fa-edit text-green-600 mr-2"></i> Editar Publicidade
            </h3>
            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="editAdForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <input type="hidden" id="editAdId">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nome Interno
                </label>
                <input type="text" id="editName" name="name" class="input w-full" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Slug / Identificador
                </label>
                <input type="text" id="editSlug" name="slug" class="input w-full" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Tipo de Banner
                </label>
                <select name="adType" id="editAdType" class="input w-full">
                    <option value="IMAGE">Imagem</option>
                    <option value="HTML">HTML avançado</option>
                </select>
            </div>
            <!-- Campos imagem (editar) -->
            <div id="editImageFields" class="space-y-3">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Imagem do Banner (deixe em branco para manter a atual)
                    </label>
                    <input type="file" name="image" accept="image/*" class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Link de destino (opcional)
                    </label>
                    <input type="url" id="editImageUrl" name="imageUrl" class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Texto alternativo
                    </label>
                    <input type="text" id="editImageAlt" name="imageAlt" class="input w-full">
                </div>
            </div>
            <!-- Campos HTML (editar) -->
            <div id="editHtmlFields" class="space-y-2 hidden">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    HTML do Banner
                </label>
                <textarea id="editBody" name="body" rows="6" class="input w-full"></textarea>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="editEnabled" name="enabled" value="1" class="rounded text-green-600">
                <label for="editEnabled" class="ml-2 text-sm text-gray-700">Ativo</label>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm">
                    Cancelar
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                    Guardar Alterações
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleTypeFields(selectEl, imageWrapperId, htmlWrapperId) {
        const type = selectEl.value;
        const imageWrapper = document.getElementById(imageWrapperId);
        const htmlWrapper = document.getElementById(htmlWrapperId);
        if (type === 'IMAGE') {
            imageWrapper.classList.remove('hidden');
            htmlWrapper.classList.add('hidden');
        } else {
            imageWrapper.classList.add('hidden');
            htmlWrapper.classList.remove('hidden');
        }
    }

    // Toggle inicial no formulário de criação
    document.addEventListener('DOMContentLoaded', function () {
        const adTypeSelect = document.getElementById('adType');
        if (adTypeSelect) {
            toggleTypeFields(adTypeSelect, 'imageFields', 'htmlFields');
            adTypeSelect.addEventListener('change', function () {
                toggleTypeFields(this, 'imageFields', 'htmlFields');
            });
        }
    });

    function openEditModal(id, name, slug, body, adType, enabled, imageUrl, imageAlt) {
        const modal = document.getElementById('editAdModal');
        const form = document.getElementById('editAdForm');
        document.getElementById('editAdId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editSlug').value = slug;
        document.getElementById('editBody').value = body || '';
        const typeSelect = document.getElementById('editAdType');
        typeSelect.value = adType || 'IMAGE';
        document.getElementById('editImageUrl').value = imageUrl || '';
        document.getElementById('editImageAlt').value = imageAlt || '';
        toggleTypeFields(typeSelect, 'editImageFields', 'editHtmlFields');
        typeSelect.addEventListener('change', function () {
            toggleTypeFields(this, 'editImageFields', 'editHtmlFields');
        });
        document.getElementById('editEnabled').checked = !!enabled;
        form.action = '/smart-ads/' + id;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editAdModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush

@endsection

