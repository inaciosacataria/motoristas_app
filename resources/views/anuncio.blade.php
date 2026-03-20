@extends('layouts.appmainanuncio')

<head>
    @section('title')
        {{ $anuncio->titulo }} | {{ $anuncio->nome }}
    @endsection
    @section('image')
        @php
            $logo = null;
            if (isset($anuncio->logotipo) && $anuncio->logotipo && $anuncio->logotipo !== 'none') {
                $logo = $anuncio->logotipo;
            } elseif (isset($anuncio->foto_url) && $anuncio->foto_url && $anuncio->foto_url !== 'none') {
                $logo = $anuncio->foto_url;
            }
        @endphp
        @if ($logo)
            https://motoristas.co.mz/{{ ltrim($logo, '/') }}
        @else
            https://motoristas.co.mz/uploads/80.jpg
        @endif
    @endsection
    @section('content')
        @php
            use Carbon\Carbon;
        @endphp

        <div class="wrapper">
            <div class="container-fluid homepage">
                <div class="container">
                    @if (session('success'))
                        <div class="mt-4 alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="icon fa fa-check"></i> {{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('erro'))
                        <div class="mt-4 alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="icon fa fa-check"></i> {{ session('erro') }}</p>
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="mt-4 alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p><i class="icon fa fa-check"></i> {{ session('warning') }}</p>
                        </div>
                    @endif

                </div>

                <!-- Page-Title -->
                <div class="row">

                    <!-- anuncios section -->
                    <div class="col-md-9 anunciopage postedList">

                        <div class="card m-b-30 card-body">
                            <section class="navega">
                                <span><a href="javascript:history.back();">≪ Voltar</a></span> |
                                <span>Categoria:
                                    <a href="#">
                                        {{ $anuncio->categoria }}
                                    </a>
                                </span>
                            </section>

                            <h2>{{ $anuncio->titulo }} </h2>
                            <p class="nomeInst">{{ $anuncio->empresa }}</p>
                            <section class="infoJob clearfix">
                                <p>
                                    <span
                                        class="badge badge-default">{{ Carbon::parse($anuncio->created_at)->format('d-M-Y') }}
                                    </span>
                                    <span
                                        class="badge badge-default">{{ Carbon::parse($anuncio->validade)->format('d-M-Y') }}</span>
                                </p>

                                <p class="local">Local: <span>
                                        @foreach ($anuncios_provincias as $anuncio_provincia)
                                            @if ($anuncio_provincia->anuncio_id == $anuncio->id)
                                                @foreach ($provincias as $provincia)
                                                    @if ($anuncio_provincia->provincia_id == $provincia->id)
                                                        {{ $provincia->name }} ,
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </span> </p>

                                <div class="anuncio-descricao">

                                    {!! $anuncio->descricao !!}
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="col-md-3 postedList">
                        <div class="card m-b-30 card-body">
                            <h2 class="detalhesC">Informação Adcional</h2>
                            <p><b>Data da Publicação: </b><span
                                    class="float-right">{{ Carbon::parse($anuncio->created_at)->format('d-M-Y') }}</span>
                            </p>
                            <p><b>Válido até: </b><span
                                    class="float-right">{{ Carbon::parse($anuncio->validade)->format('d-M-Y') }}</span></p>
                            <!-- <p><b>Email:  </b><span class="float-right"><a href="{{ $anuncio->email }}">{{ $anuncio->email }} </a></span></p> -->

                            <hr>

                            @guest
                                @if ($anuncio->forma_de_candidatura == 'Portal')
                                    <hr>
                                    <p><a href="{{ route('login', 'candidato') }}">Cria uma conta</a> ou faz <a
                                            href="{{ route('login', 'candidato') }}">login</a> para candidatar-se </p>
                                @endif
                            @else
                                @if (Auth::user()->privilegio == 'candidato')
                                    @if ($anuncio->forma_de_candidatura == 'Portal')
                                        @php
                                            $candidaturas_anuncios = DB::table('candidaturas_anuncios')
                                                ->join('users', 'candidaturas_anuncios.user_id', '=', 'users.id')
                                                ->where('users.id', Auth::user()->id)
                                                ->where('candidaturas_anuncios.anuncio_id', $anuncio->id)
                                                ->first();
                                        @endphp
                                        @if (empty($candidaturas_anuncios))
                                            <form method="post" style="display: inline;" action="/candidatar">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $anuncio->id }}" name="anuncio_id" />
                                                <button
                                                    class="btn btn-block btn-success waves-effect waves-light">Candidatar-me</button>
                                            </form>
                                        @else
                                            <p class="text-center mt-4"><span class="badge badge-info"> Já se candidatou a essa
                                                    vaga!</span></p>
                                        @endif
                                    @endif
                                @else
                                    <a class="btn btn-block btn-info waves-effect waves-light" href="/empregador"
                                        style="color: #ffffff !important;">Gerir candidaturas</a>
                                @endif

                            @endguest
                        </div>

                        <div class="card m-b-30 card-body">
                            <h2 class="detalhesC">Sobre o Recrutador</h2>
                            <p>{{ $anuncio->empresa }}</p>
                        </div>
                    </div>
                    <!-- end anuncios section -->

                </div>
                <!-- end page title end breadcrumb -->
                <!-- end row -->
            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->

    @endsection
