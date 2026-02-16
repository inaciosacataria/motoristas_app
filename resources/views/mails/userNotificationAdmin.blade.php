@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            motoristas.co.mz
        @endcomponent
    @endslot


    Ola **{{ $name }}**, {{-- use double space for line break --}}

    Seja bem vindo ao portal de motoristas, onde voce publica vagas de motoristas, recebes as candidaturas e faz
    avaliação dos candidatos gratuitamente.
    
    Bem neste momento por questões de segurança a sua conta está em processo de verificação, dentro de algumas horas será
    activada,
    
    Clique a seguir para mais novidades
  
    @component('mail::button', ['url' => $link, 'color' => 'green'])
        Encontre vagas
    @endcomponent

    Conectando as empresas e os motoristas profissionais
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            motoristas.co.mz
        @endcomponent
    @endslot
@endcomponent
