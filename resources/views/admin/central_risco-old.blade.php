@extends('layouts.appmain')
@section('title')
Central de Risco de Motoristas |
@endsection
@section('content')

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
          <section class="col-md-12 navega">
            <span><a href="/admin"> Dashboard</a></span> |
            <span><a href="#" class="active">Central de Risco de Motoristas</a></span>
          </section>
          <!-- fitros section -->
          <div class="col-md-12 m_filtro_nav mt-4">
            <form method="GET" action="{{ route('searchDenuncias') }}">
            @csrf
            <div class="form-group mt-3 row">

                <div class="col-sm-6">
                    <input class="form-control" type="text" id="keyword"  name="keyword" @if(isset($_GET['keyword'])) value="{{$_GET['keyword']}}"  @endif placeholder="Nome de motorista..." >
                </div>
                <div class="col-sm-4">
                    <input class="form-control" type="text" id="numero_carta_conducao"  name="numero_carta_conducao" placeholder="Número da carta de condução">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info waves-effect waves-light w-100">Filtrar</button>
                </div>

            </div>
            </from>
          </div>
          <!-- end fitros section -->
          <!-- anuncios section -->


          <div class="col-md-12 mt-4 m_bd_motoristas">

            <div class="row">
              @foreach($denuncias as $denuncia)
                  <div class="col-md-4">
                    <div class="card m-b-30">
                          <div class="card-body">
                            <div class="row perfil">
                              <div class="col-md-8">
                                <img src="{{asset('/assets/images/users/user.png')}}" class="rounded-circle"/>
                                <span class="nome_motoritsa"><a href="{{route('denuncia', $denuncia->id )}}">{{ $denuncia->nome_motorista}}</a></span>
                              </div>
                              <div class="col-md-4">
                                @if($denuncia->estado_denuncia == 'Não confirmada')
                                <span class="badge badge-warning mt-4 font-12">Não confirmada</span>
                                @else
                                <span class="badge badge-success mt-4 font-12">Confirmada</span>
                                @endif
                              </div>
                            </div>
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
<!-- end wrapper -->

@endsection
