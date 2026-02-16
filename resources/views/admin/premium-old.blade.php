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
            <span><a href="#" class="active">Contas</a></span>
          </section>
          <!-- fitros section -->

          <div class="col-md-12 m_filtro_nav mt-4">
            <form method="GET" action="{{ route('searchEmpresas') }}">
            @csrf
            <div class="form-group mt-3 row">

                <div class="col-sm-10">
                    <input class="form-control" type="text" id="keyword" style="" name="keyword" @if(isset($_GET['keyword'])) value="{{$_GET['keyword']}}"  @endif placeholder="Empresa..." >
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
              @foreach($users as $user)
                  <div class="col-md-4">
                    <div class="card m-b-30">
                          <div class="card-body">
                            <div class="row perfil">
                              <div class="col-md-8">
                                <img src="{{asset('/assets/images/users/user.png')}}" class="rounded-circle"/>
                                <span class="nome_motoritsa"><a href="{{route('empregador-perfil',$user->user_id)}}">{{ $user->name}}</a></span>
                              </div>

                              <form method="post" action=" @if($user->is_premium=='no') {{ route('activarcontapremium') }} @else {{ route('desativarpremiumconta') }} @endif">
                              @csrf
                                  <input hidden value="{{$user->user_id}}" name="id"/>
                                  <div class="col-md-4">
                                    @if($user->is_premium == 'no')
                                        <button  class="badge badge-warning mt-4 font-12" type="submit" id="btnChangeState" >Free plan</button>
                                      @else
                                         <button class="badge badge-success mt-4 font-12" type="submit" id="btnChangeState"  >Premium</button>
                                      @endif
                                 </div>
                              </form>

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
<script>


$(function () {
    $("#click-me").click(function () {
        document.getElementById('btnChangeState').style.backgroundColor = "red";
        return false;
    });
});

</script>
@endsection
