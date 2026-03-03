@extends('layouts.appmain')
@section('title')
Base de Dados de Motoristas |
@endsection
@section('content')
@php
 use Carbon\Carbon;
@endphp

<div class="wrapper">
    <div class="container-fluid">
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
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">Dashboard</h4>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">Motoristas</h6>
                            <h4 class="mb-3 mt-0 float-right">{{ $countMotoritas }}</h4>
                        </div>
                        <div>
                            <span class="badge badge-light text-info"> {{$last30motoristas}} </span>
                             <span class="ml-2">Inscritos nos últimos 30 dias</span>
                        </div>
                      </div>
                </div>
            </div>

            <!-- Central de Risco removido -->
            <div class="col-xl-3 col-md-6">
                <div class="card  bg-info mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">Empregadores</h6>
                            <h4 class="mb-3 mt-0 float-right">{{ $countEmpregador }}</h4>
                        </div>
                        <div>
                            <span class="badge badge-light text-primary"> {{$last30empregador}} </span>
                             <span class="ml-2">Inscritos nos últimos 30 dias</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success mini-stat text-white">
                  <a href="/anuncios">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">Vagas</h6>
                            <h4 class="mb-3 mt-0 float-right" style="color:#fff">{{ $countAnuncios }}</h4>
                        </div>
                        <div>
                            <span class="badge badge-light text-info"> {{$anunciosDentroDoPrazo}} </span>
                            <span class="ml-2" style="color:#fff">Dentro de validade</span>
                        </div>
                    </div>
                  </a>
                </div>
            </div>

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Motoristas</h4>
                        <div class="latest-massage">

                          @foreach($motoristas as $motorista)
                            <a href="#" class="latest-message-list ">
                                <div class="border-bottom position-relative mt-3">
                                    <div class="float-left user mr-3">
                                        <h5 class="bg-primary text-center rounded-circle text-white mt-0">{{$motorista->name[0]}}</h5>
                                    </div>
                                    <div class="message-time">
                                        <p class="m-0 text-muted">{{ $motorista->provincia }}</p>
                                    </div>
                                    <div class="massage-desc">
                                      <a href="{{route('perfil', $motorista->user_id )}}">
                                        <h5 class="font-14 mt-0 text-dark">{{$motorista->name}}</h5>
                                      </a>
                                        <p class="text-muted">{{$motorista->categoria}}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach

                        </div>
                        <hr>
                        <div class="text-center mt-3">
                          <a href="/bd-motoristas">ver mais</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end col -->

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Central de Risco removido -->
                        <div class="latest-massage">

                           @foreach($denuncias as $denuncia)
                            <a href="#" class="latest-message-list">
                                <div class="border-bottom position-relative mt-3">
                                    <div class="float-left user mr-3">
                                        <h5 class="bg-pink text-center rounded-circle text-white mt-0">{{$denuncia->nome_motorista[0]}}</h5>
                                    </div>
                                    <div class="message-time">
                                        <p class="m-0 text-muted">{{ $denuncia->estado_denuncia }}</p>
                                    </div>
                                    <div class="massage-desc">
                                        <h5 class="font-14 mt-0 text-dark">{{$denuncia->nome_motorista}}</h5>
                                        <p class="text-muted">{{$denuncia->infracao}}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <hr>
                        <!-- Link para Central de Risco removido -->
                    </div>
                </div>

            </div>
            <!-- end col -->

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Empregadores</h4>
                        <div class="latest-massage">
                            @foreach($empregadores as $empregador)
                            <a href="#" class="latest-message-list">
                                <div class="border-bottom position-relative mt-3">
                                    <div class="float-left user mr-3">
                                        <h5 class="bg-info text-center rounded-circle text-white mt-0">{{$empregador->empresa[0]}}</h5>
                                    </div>
                                    <div class="message-time">
                                      @if($empregador->active == "desativado")
                                      <span class="badge badge-warning mt-4 font-12">Desativo</span>
                                      @elseif($empregador->active != "desativado")
                                      <span class="badge badge-warning mt-4 font-12">Activo</span>
                                      @endif
                                    </div>
                                    <div class="massage-desc">
                                        <h5 class="font-14 mt-0 text-dark">{{$empregador->empresa}}</h5>
                                        <p class="text-muted">{{$empregador->email}}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach


                        </div>
                        <hr>
                        <div class="text-center mt-3">
                          <a href="/bd-empregadores">ver mais</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->


@endsection
