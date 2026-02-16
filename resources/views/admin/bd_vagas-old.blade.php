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
            <span><a href="#" class="active">Vagas disponiveis</a></span>
          </section>



          <div class="col-md-12 mt-4 m_bd_motoristas">

            <div class="row">
              <div class="card">
                  <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Vagas<span class="float-right">

                    </span></h4>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; min-width: 100%;">
                   <thead>
                   <tr>
                       <th>Titulo</th>
                       <th>Empresa</th>
                       <th>Contacto</th>
                       <th>Candidaturas</th>
                      <th>Accoes</th>
                   </tr>
                   </thead>

                   <tbody>

                     @foreach ($anuncios as  $anuncio)
                       <tr>
                           <td><a href="/anuncio/{{$anuncio->id}}">{{ $anuncio->titulo }}</a></td>
                           <td>{{ $anuncio->empresa }}</td>
                           <td>{{ $anuncio->celular }}</td>
                           @php
                              $count = 0;

                           foreach($candidaturas as $candidatura){
                              if($candidatura->anuncio_id==$anuncio->id){
                                $count++;
                              }
                           }
                          @endphp
                           <td>{{ $count }}</td>
                           <td class="text-center">

                             <form method="post" style="display: inline; color: white;" action="{{ route('apagarAnuncio', $anuncio->id) }}">
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
