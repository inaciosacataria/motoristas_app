@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            motoristas.co.mz
        @endcomponent
    @endslot


    Ola **{{ $name }}**, {{-- use double space for line break --}}
    A sua conta foi activada, já podes fazer o uso do portal gratuitamente, publicar vagas de motoristas /operadores de
    máquinas, receber e fazer avaliação de candidaturas, solicitar formações para os seus motoristas e o seguro de proteção
    de motoristas.

    Para aceder o portal use email e senha do seu cadastro.

    Para ter mais serviços e vantagens, evolui a sua conta para o premium.

   
    @component('mail::button', ['url' => $link, 'color' => 'green'])
        Motoristas.co.mz
    @endcomponent

    Conectando as empresas e os motoristas profissionais
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            motoristas.co.mz
        @endcomponent
    @endslot
@endcomponent
