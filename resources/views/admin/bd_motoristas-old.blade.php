@extends('layouts.appmain')
@section('title')
Base de Dados de Motoristas |
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
            <span><a href="#" class="active">Base de dados de Motoristas</a></span>
          </section>
          <!-- fitros section -->
          <!-- <div class="col-md-12 m_filtro_nav mt-4">
            <div class="form-group mt-3 row">
                <div class="col-sm-4">
                    <input class="form-control" type="text" id="keyword"  name="keyword" placeholder="Pesquisa...">
                </div>
                <div class="col-sm-3">
                    <select class="form-control">
                        <option value="null">Categoria</option>
                        <option>A-Motociclo</option>
                        <option>B-Ligeiro</option>
                        <option>C-Pesado</option>
                        <option>G-Profissional</option>
                        <option>P-Serviços Públicos</option>
                      </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control">
                        <option>Localização</option>
                        <option>Maputo</option>
                        <option>Gaza</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-info waves-effect waves-light w-100">Filtrar</button>
                </div>
            </div>
          </div> -->
          <!-- end fitros section -->
          <!-- anuncios section -->


          <div class="col-md-12 mt-4 m_bd_motoristas">

            <div class="row">
              <div class="card">
                  <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Motoristas<span class="float-right">
                      <button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#anuncio"
                      <i class="dripicons-plus">
                      </i>&nbsp;Nova vaga</button>
                    </span></h4>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; min-width: 100%;">
                   <thead>
                   <tr>
                       <th>Nome</th>
                       <th>Habilitacao de conducao</th>
                       <th>Grau Acadêmico</th>
                       <th>Contacto</th>
                       <th>Curriculum</th>
                      <th>Accoes</th>
                   </tr>
                   </thead>

                   <tbody>

                     @foreach ($motoristas as $key => $motorista)
                       <tr>
                           <td><a href="{{route('perfil', $motorista->user_id )}}">{{ $motorista->name }}</a></td>
                           <td>{{$motorista->categoria}}</td>
                           <td>{{$motorista->grau_academico}}</td>
                           <td>{{ $motorista->celular }}</td>
                            <td><a href="/{{ $motorista->cv }}"><button class="btn btn-info waves-effect waves-light w-100">ver CV</button></a></td>
                           <td class="text-center">

                             <form method="post" style="display: inline; color: white;" action="{{ route('deleteCandidato', $motorista->user_id) }}">
                               {{ csrf_field() }}
                               <a onclick="confirm('{{ __("Tem certeza que pretende eliminar este anuncio?") }}') ? this.parentElement.submit() : ''" class="btn btn-sm btn-danger waves-effect waves-light white">
                                 <i class="far fa-trash-alt"></i>
                               </a>
                            </form>
                           </td>
                       </tr>

                    @endforeach

                   </tbody>
               </table>



             </div>
           </div>

                <!-- @foreach($motoristas as $motorista)


             <div class="col-md-12">
                <div class="card m-b-30">
                      <div class="card-body">
                        <div class="row perfil">
                          <div class="col-md-4">
                            @if($motorista->foto_url=="none" || $motorista->foto_url==null)
                           <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle width-100" >
                           @else
                           <img src="{{ $motorista->foto_url }}" alt="user" class="rounded-circle width-100" id="image-profile" >
                           @endif
                            <span class="nome_motoritsa"><a href="{{route('perfil', $motorista->user_id )}}">{{ $motorista ->name}}</a></span>
                          </div>
                          <div class="col-md-4">

                              <p>Categoria de Carta: <b>{{$motorista->categoria}}</b></p>
                              <p>Provincia: <b>{{$motorista->provincia}}</b></p>
                          </div>

                          <div class="col-md-4">
                            <p>Contacto: <b> {{$motorista->celular}}</b></p>
                            <p>Nacionalidade: <b> {{$motorista->nacionalidade}}</b></p>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              @endforeach -->



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
