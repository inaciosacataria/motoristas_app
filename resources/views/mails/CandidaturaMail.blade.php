
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
         motoristas.co.mz
        @endcomponent
    @endslot



Ola **Admin**,  {{-- use double space for line break --}}
A empresa {{$empresa}}  recebeu uma candidatura espontanea
Encontre os seu dados abaixo:

**Nome:** {{$nome}}<br>
**Contacto:** {{$contacto}}<br>
**Email:** {{$email}}<br>
**Cv:** {{$cv_link}}<br>
**empresa o qual se candidatou:** {{$empresa}}<br>


@component('mail::button', ['url' => $cv_link, 'color' => 'green'])
Ver o CV
@endcomponent
Meus cumprimentos,
Motoristas Lda.


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
          {{$footer}}
        @endcomponent
    @endslot
@endcomponent
