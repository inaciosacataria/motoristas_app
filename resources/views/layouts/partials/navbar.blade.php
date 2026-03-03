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
            </div>
            
            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-primary-600 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                    </button>
                    
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
                                    <i class="fas fa-building mr-2"></i> Dashboard
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
                    <a href="{{ route('login', 'candidato') }}" class="btn-ghost text-sm">
                        <i class="fas fa-user mr-1"></i> Sou Candidato
                    </a>
                    <a href="{{ route('login', 'recrutador') }}" class="btn-primary text-sm">
                        <i class="fas fa-building mr-1"></i> Sou Empregador
                    </a>
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
        </div>
    </div>
</nav>

<!-- Alpine.js for dropdowns -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>

