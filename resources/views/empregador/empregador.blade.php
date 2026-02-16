@extends('layouts.appmain')
@section('title')
Perfil |
@endsection
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="motoristas">
    <meta name="description" content="">
    <title>Perfil</title>
    <link rel="stylesheet" href="{{asset('css/nicepage.css')}}" media="screen">
<link rel="stylesheet" href="{{asset('css/empregador.css')}}" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.21.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">


    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
    <meta name="theme-color" content="#e2eef1">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">
  </head>
  <body  style="background-color:#e2eef1" class="u-body u-xl-mode" data-lang="en"><header class="u-clearfix u-grey-5 u-header u-header" id="sec-3ee6"><div class="u-clearfix u-sheet u-sheet-1"></div></header>
    <section class="u-clearfix u-grey-5 u-section-1" id="carousel_7d44" style="background-color:#e2eef1">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">

              @foreach ($empregadors as $empregador)
              <div class="u-container-style u-layout-cell u-size-22 u-white u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1">
                  <div class="u-image u-image-circle u-image-1" alt="{{asset('assets/images/1.png')}}" data-image-width="1500" data-image-height="1000"></div>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-38 u-white u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2">
                  <h5 class="u-align-center u-custom-font u-font-montserrat u-text u-text-default-lg u-text-default-md u-text-default-xl u-text-1">{{$empregador->nome}}</h5>
                  <p class="u-align-center u-hidden-xs u-text u-text-default u-text-2">Documents:</p>
                  <!-- <p class="u-align-center u-text u-text-default u-text-3">Nuit:</p>
                  <p class="u-align-center u-text u-text-default u-text-4">$empregador->nuit</p> -->
                  <p class="u-align-center u-text u-text-default u-text-5">{{$empregador->sector_actividade}}</p>
                  <p class="u-align-center u-text u-text-default u-text-6">Ramo de Actividade:</p>
                  <p class="u-align-center u-hidden-xs u-text u-text-custom-color-1 u-text-default u-text-7"><a href="https://motoristas.co.mz/{{$empregador->documento_certidao}}">certidao de empresa.pdf</a></p>
                  <p class="u-align-center u-text u-text-default u-text-8">Website:</p>
                  <p class="u-align-center u-text u-text-default u-text-9">{{$empregador->website}}</p>
                  <p class="u-align-center u-hidden-xs u-text u-text-custom-color-1 u-text-default u-text-10"><a href="https://motoristas.co.mz/{{$empregador->documento_inicio_actividade}}">inicio de actividades.pdf</a></p>
                  <p class="u-align-center u-hidden-xs u-text u-text-custom-color-1 u-text-default u-text-11"><a href="https://motoristas.co.mz/{{$empregador->documento_nuit}}">nuit.pdf</a></p>
                  <p class="u-align-center u-text u-text-default u-text-12">{{$empregador->email}}</p>
                  <p class="u-align-center u-text u-text-default u-text-13">Email:</p>
                  <p class="u-align-center u-text u-text-default u-text-14">Contacto:</p>
                  <p class="u-align-center u-text u-text-default u-text-15">{{$empregador->celular}}</p>
                  <p class="u-align-center u-text u-text-default u-text-16">Endereço:</p>
                  <p class="u-align-center-lg u-align-center-md u-align-center-xl u-align-left-sm u-align-left-xs u-text u-text-17">{{$empregador->endereco}}</p>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        @if($empregador->active=="desativado" && Auth::user()->privilegio=="admin")
        <h6 class="u-align-center u-custom-font u-font-montserrat u-text u-text-palette-2-base u-text-18"><button class="btn btn-primary"><a href="{{route('activeUser',$empregador->user_id)}}">Activar conta</a></button></h6>
        @elseif($empregador->active!="desativado" && Auth::user()->privilegio=="admin")
          <h6 class="u-align-center u-custom-font u-font-montserrat u-text u-text-palette-2-base u-text-18"><button class="btn btn-primary"><a href="{{route('desactiveUser',$empregador->user_id)}}">Desativar conta</a></button></h6>
        @endif
        @if(count($anuncios)<0)
        <h6 class="u-align-center u-custom-font u-font-montserrat u-text u-text-palette-2-base u-text-18">Vagas disponiveis</h6>
        <p class="u-align-center u-text u-text-19">Nenhuma vaga publicada</p>
        @endif
      </div>
    </section>



    <div class="wrapper" style="background-color:#e2eef1">
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
    <div class="col-md-12 mt-4 m_anunicios_home">
      <div class="row">

        @foreach ($anuncios as $anuncio)
        <div class="col-md-3">
          <div class="card m-b-30">
                <div class="card-body">
                  <div class="imagem" >
                    @if($anuncio->foto!="none")
                    <img src="{{ $anuncio->foto }}" class="img-fluid" style="max-width:100px"/>
                    @else
                    <img src="{{asset('assets/images/2.png')}}" class="img-fluid" style="margin-top: 35px;" />
                    @endif
                  </div>
                  <h4 class="mt-4"><a href="/anuncio/{{$anuncio->id}}">{{ $anuncio->titulo }}</a></h4>
                    <p>{{$anuncio->empresa}}</>
                    <p>

                      @php
                       global $i, $prov;
                       $i = 0;

                      @endphp

                    @foreach ($anuncios_provincias as $anuncio_provincia)
                      @if($anuncio_provincia->anuncio_id==$anuncio->id)
                          @foreach ($provincias as $provincia)
                            @if($anuncio_provincia->provincia_id==$provincia->id)

                            @php
                             $i++;
                             $prov = $provincia->name;
                            @endphp

                            @endif
                          @endforeach
                      @endif
                    @endforeach

                    @if($i>1)
                       Varios locais
                    @else
                      {{ $prov }}
                    @endif
                     </p>

              </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
    <!-- end anuncios section -->


            </div>
            <!-- end page title end breadcrumb -->
                    <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

</body></html>
