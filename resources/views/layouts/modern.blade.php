<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Motoristas') - Portal de Empregos</title>

    @php
        $defaultOgImage = asset('assets/images/motoristas.png');
        $defaultOgDescription = 'O portal de emprego e formação de motoristas';
    @endphp

    <!-- SEO / Share (OpenGraph + Twitter) -->
    <meta name="description" content="@yield('meta_description', $defaultOgDescription)">

    <meta property="og:title" content="@yield('meta_title', 'Motoristas - Portal de Empregos')">
    <meta property="og:description" content="@yield('meta_description', $defaultOgDescription)">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('meta_og_image', $defaultOgImage)">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', 'Motoristas - Portal de Empregos')">
    <meta name="twitter:description" content="@yield('meta_description', $defaultOgDescription)">
    <meta name="twitter:image" content="@yield('meta_og_image', $defaultOgImage)">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Navigation -->
    @include('layouts.partials.navbar')
    
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('layouts.partials.footer')
    
    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        // Toast notification function
        function showToast(message, type = 'success') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };
            
            const icons = {
                success: 'fa-check-circle',
                error: 'fa-times-circle',
                warning: 'fa-exclamation-triangle',
                info: 'fa-info-circle'
            };
            
            const toast = $(`
                <div class="flex items-center gap-3 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg animate-slide-down max-w-md">
                    <i class="fas ${icons[type]} text-xl"></i>
                    <p class="font-medium">${message}</p>
                    <button onclick="$(this).parent().remove()" class="ml-auto">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
            
            $('#toast-container').append(toast);
            
            setTimeout(() => toast.fadeOut(() => toast.remove()), 5000);
        }
        
        // Show session messages
        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif
        
        @if(session('erro') || session('error'))
            showToast("{{ session('erro') ?? session('error') }}", 'error');
        @endif
        
        @if(session('warning'))
            showToast("{{ session('warning') }}", 'warning');
        @endif
        
        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast("{{ $error }}", 'error');
            @endforeach
        @endif
    </script>
    
    @stack('scripts')
</body>
</html>

