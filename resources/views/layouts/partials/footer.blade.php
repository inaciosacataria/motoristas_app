<footer class="bg-secondary-900 text-white mt-auto">
    <div class="container-custom py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div class="col-span-1 md:col-span-2">
                <img src="{{ asset('assets/images/2.png') }}" alt="Logo Motoristas" class="h-12 mb-4 brightness-0 invert">
                <p class="text-gray-400 mb-4">
                    Plataforma líder em conexão entre motoristas profissionais e empregadores em Moçambique.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Links -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Links Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-400 hover:text-primary-500 transition-colors">Início</a></li>
                    <li><a href="/formacao" class="text-gray-400 hover:text-primary-500 transition-colors">Formações</a></li>
                    <li><a href="/sobre-nos" class="text-gray-400 hover:text-primary-500 transition-colors">Sobre Nós</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Contacto</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><i class="fas fa-phone mr-2"></i> +258 84 123 4567</li>
                    <li><i class="fas fa-envelope mr-2"></i> info@motoristas.co.mz</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Maputo, Moçambique</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Motoristas. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

