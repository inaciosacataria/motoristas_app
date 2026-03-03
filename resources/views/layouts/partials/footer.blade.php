<footer class="bg-secondary-900 text-white mt-auto">
    <div class="container-custom py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- About -->
            <div class="col-span-1 md:col-span-2">
                <img src="{{ asset('assets/images/2.png') }}" alt="Logo Motoristas" class="h-10 mb-3 brightness-0 invert">
                <p class="text-gray-400 mb-3 text-sm">
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
            
            <!-- Serviços -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Solicite os nossos serviços</h3>
                <ul class="space-y-1.5 text-gray-400 text-sm">
                    <li>Recrutamento e selecção de motoristas</li>
                    <li>Formação avançada de motoristas</li>
                    <li>Terceirização de motoristas</li>
                    <li>Serviços de delivery</li>
                    <li>Legalização de empresas de transporte e logística</li>
                    <li>Tramitação de licenças, alvarás e permits</li>
                </ul>
                <p class="mt-3 text-gray-400 text-sm">
                    Através de 
                    <a href="mailto:moz@motoristas.co.mz" class="text-primary-400 hover:text-primary-300 underline">
                        moz@motoristas.co.mz
                    </a>
                </p>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Contacto</h3>
                <ul class="space-y-1.5 text-gray-400 text-sm">
                    <li><i class="fas fa-phone mr-2"></i> +258 84 123 4567</li>
                    <li><i class="fas fa-envelope mr-2"></i> info@motoristas.co.mz</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Maputo, Moçambique</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-6 pt-4 text-center text-gray-500 text-xs">
            <p>&copy; {{ date('Y') }} Motoristas. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

