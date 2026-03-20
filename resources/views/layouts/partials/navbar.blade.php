<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('assets/images/2.png') }}" alt="Logo Motoristas" class="h-10 object-contain max-w-[150px]">
                </a>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="nav-link @if(request()->is('/')) nav-link-active @else nav-link-inactive @endif">
                    <i class="fas fa-home mr-1"></i> Início
                </a>
                <a href="/formacao" class="nav-link nav-link-inactive">
                    <i class="fas fa-graduation-cap mr-1"></i> Formações
                </a>
                <button type="button" onclick="document.getElementById('modal-base-dados').classList.remove('hidden')" class="nav-link nav-link-inactive border-0 bg-transparent cursor-pointer p-0">
                    <i class="fas fa-database mr-1"></i> Base de Dados
                </button>
                <button type="button" onclick="document.getElementById('modal-central-risco').classList.remove('hidden')" class="nav-link nav-link-inactive border-0 bg-transparent cursor-pointer p-0">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Central de Risco
                </button>
            </div>
            
            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Notifications dropdown -->
                    <div class="relative" x-data="notificationDropdown({{ (int)($notificationCount ?? 0) }})">
                        <button @click="toggle(); load()" type="button" class="relative p-2 text-gray-600 hover:text-primary-600 transition-colors" title="Notificações">
                            <i class="fas fa-bell text-xl"></i>
                            <template x-if="count > 0">
                                <span class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-xs rounded-full flex items-center justify-center" x-text="count > 99 ? '99+' : count"></span>
                            </template>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 mt-2 w-96 max-h-[85vh] bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden z-50 flex flex-col"
                             style="display: none;">
                            <div class="p-3 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                                <span class="font-semibold text-gray-800">Notificações</span>
                                <template x-if="notifications.length > 0">
                                    <button type="button" @click="markAllRead()" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                        Marcar todas como lidas
                                    </button>
                                </template>
                            </div>
                            <div class="overflow-y-auto flex-1 min-h-0">
                                <template x-if="loading">
                                    <div class="p-6 text-center text-gray-500"><i class="fas fa-spinner fa-spin"></i> A carregar...</div>
                                </template>
                                <template x-if="!loading && notifications.length === 0">
                                    <div class="p-6 text-center text-gray-500"><i class="fas fa-bell-slash text-2xl mb-2 block text-gray-300"></i>Sem notificações novas.</div>
                                </template>
                                <template x-if="!loading && notifications.length > 0">
                                    <ul class="divide-y divide-gray-100">
                                        <template x-for="n in notifications" :key="n.id">
                                            <li class="hover:bg-gray-50 transition-colors">
                                                <a :href="n.data && n.data.url ? n.data.url : '#'" class="block px-4 py-3 flex gap-3 items-start group" @click="open = false">
                                                    <span class="flex-shrink-0 w-9 h-9 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center mt-0.5">
                                                        <i class="fas" :class="(n.data && n.data.icon) || 'fa-bell'"></i>
                                                    </span>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="font-medium text-gray-900 group-hover:text-primary-600" x-text="n.data && n.data.title ? n.data.title : 'Notificação'"></p>
                                                        <p class="text-sm text-gray-600 mt-0.5" x-text="n.data && n.data.message ? n.data.message : ''"></p>
                                                        <p class="text-xs text-gray-400 mt-1" x-text="n.created_at_human"></p>
                                                    </div>
                                                    <button type="button" @click.prevent="markRead(n.id)" class="flex-shrink-0 p-2 text-gray-400 hover:text-primary-600" title="Marcar como lida">
                                                        <i class="fas fa-check text-sm"></i>
                                                    </button>
                                                </a>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        @php
                            $avatarUrl = null;
                            if (Auth::user()->privilegio === 'empregador') {
                                $avatarUrl = \App\Models\Empregador::where('user_id', Auth::id())->value('logotipo');
                            }
                            if (!$avatarUrl || $avatarUrl === 'none') {
                                $avatarUrl = Auth::user()->foto_url && Auth::user()->foto_url !== 'none'
                                    ? Auth::user()->foto_url
                                    : null;
                            }
                        @endphp
                        <button @click="open = !open" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            @if($avatarUrl)
                                <img src="{{ asset($avatarUrl) }}" alt="{{ Auth::user()->name }}" class="avatar avatar-sm object-cover">
                            @else
                                <div class="avatar avatar-sm bg-primary-500 flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="hidden sm:block font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-sm text-gray-500"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50" style="display: none;">
                            @if(Auth::user()->privilegio === 'candidato')
                                <a href="/candidato" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i> Meu Perfil
                                </a>
                                <a href="/meu-cv" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-file-alt mr-2"></i> Meu CV
                                </a>
                            @elseif(Auth::user()->privilegio === 'empregador')
                                <a href="/empregador" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                </a>
                                <a href="/empregador-perfil/{{ Auth::user()->id }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-building mr-2"></i> Perfil da Empresa
                                </a>
                            @elseif(Auth::user()->privilegio === 'admin')
                                <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                                </a>
                            @endif
                            <hr class="my-1">
                            <a href="/logout" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i> Sair
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Hide login buttons on mobile; they live in #mobile-menu -->
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="{{ route('login', 'candidato') }}" class="btn-ghost text-sm">
                            <i class="fas fa-user mr-1"></i> Sou Candidato
                        </a>
                        <a href="{{ route('login', 'recrutador') }}" class="btn-primary text-sm">
                            <i class="fas fa-building mr-1"></i> Sou Empregador
                        </a>
                    </div>
                @endauth
                
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 text-gray-600" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
        <div class="py-2 space-y-1">
            <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-home mr-2"></i> Início
            </a>
            <a href="/formacao" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-graduation-cap mr-2"></i> Formações
            </a>
            <button type="button" onclick="document.getElementById('modal-base-dados').classList.remove('hidden')" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100 border-0 bg-transparent">
                <i class="fas fa-database mr-2"></i> Base de Dados
            </button>
            <button type="button" onclick="document.getElementById('modal-central-risco').classList.remove('hidden')" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100 border-0 bg-transparent">
                <i class="fas fa-exclamation-triangle mr-2"></i> Central de Risco
            </button>

            @guest
                <hr class="my-1">
                <a href="{{ route('login', 'candidato') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user mr-2"></i> Sou Candidato
                </a>
                <a href="{{ route('login', 'recrutador') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-building mr-2"></i> Sou Empregador
                </a>
            @endguest
        </div>
    </div>
</nav>

<!-- Modal Base de Dados -->
<div id="modal-base-dados" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex min-h-full items-start justify-center p-4 pt-24">
        <div class="fixed inset-0 bg-black/50" onclick="document.getElementById('modal-base-dados').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex items-center gap-3 mb-4">
                <span class="flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-600">
                    <i class="fas fa-database text-xl"></i>
                </span>
                <h3 class="text-lg font-semibold text-gray-900">Base de Dados</h3>
            </div>
            <p class="text-gray-600 mb-6">
                A Base de dados de motoristas é uma rede de mais 2600+ motoristas profissionais que actuam em diferentes empresas e organizações, incluindo motoristas em busca de emprego, as empresas e organizações afins, parceiras deste portal podem os contactar para efeitos de contratação. Para ter acesso à base de dados contacte <a href="mailto:info@motoristas.co.mz" class="text-primary-600 hover:underline font-medium">info@motoristas.co.mz</a> ou ligue para <a href="tel:+258871220022" class="text-primary-600 hover:underline font-medium">+258 87 12 200 22</a>.
            </p>
            <button type="button" onclick="document.getElementById('modal-base-dados').classList.add('hidden')" class="w-full btn-primary">
                Fechar
            </button>
        </div>
    </div>
</div>

<!-- Modal Central de Risco -->
<div id="modal-central-risco" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex min-h-full items-start justify-center p-4 pt-24">
        <div class="fixed inset-0 bg-black/50" onclick="document.getElementById('modal-central-risco').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex items-center gap-3 mb-4">
                <span class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </span>
                <h3 class="text-lg font-semibold text-gray-900">Central de Risco</h3>
            </div>
            <p class="text-gray-600 mb-6">
               Para ter acesso
                à Central de Risco contacte <a href="mailto:info@motoristas.co.mz" class="text-primary-600 hover:underline font-medium">info@motoristas.co.mz</a>
                ou ligue para <a href="tel:+258871220022" class="text-primary-600 hover:underline font-medium">+258 87 12 200 22</a>.
            </p>
            <button type="button" onclick="document.getElementById('modal-central-risco').classList.add('hidden')" class="w-full btn-primary">
                Fechar
            </button>
        </div>
    </div>
</div>

<!-- Alpine.js for dropdowns -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    document.addEventListener('alpine:init', function() {
        Alpine.data('notificationDropdown', function(initialCount) {
            return {
                open: false,
                count: initialCount,
                notifications: [],
                loading: false,
                toggle() { this.open = !this.open; },
                async load() {
                    if (!this.open) return;
                    this.loading = true;
                    try {
                        const r = await fetch('{{ route("notifications.getUnread") }}', { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
                        const data = await r.json();
                        if (data.success) {
                            this.notifications = data.notifications || [];
                            this.count = data.count ?? 0;
                        }
                    } catch (e) { this.notifications = []; }
                    this.loading = false;
                },
                async markRead(id) {
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
                    await fetch('{{ url("/notifications") }}/' + id + '/read', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf || '', 'Accept': 'application/json', 'Content-Type': 'application/json' } });
                    this.notifications = this.notifications.filter(n => n.id != id);
                    if (this.count > 0) this.count--;
                },
                async markAllRead() {
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
                    await fetch('{{ route("notifications.markAllAsRead") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf || '', 'Accept': 'application/json' } });
                    this.notifications = [];
                    this.count = 0;
                }
            };
        });
    });
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>

