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
                    <span><a href="/empregador"> </a></span> Meus Anuncios |
                    <span><a href="#" class="active">Candidaturas</a></span>
                </section>
                <!-- fitros section -->
                <div class="col-md-12 m_filtro_nav mt-4">
                    <div class="form-group mt-3 row">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; min-width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nr</th>
                                    <th>Perfil</th>
                                    <th>Habilitacao de conducao</th>
                                    <th>Idade</th>
                                    <th>Grau Acadêmico</th>
                                    <th>Contacto</th>
                                    <th>Curriculum</th>
                                 
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $id= 1;
                                @endphp
                                @foreach ($candidaturas as $key => $motorista)
                                    <tr>
                                        <td>{{$id}}</td>
                                        <td><a href="{{ route('perfil', $motorista->user_id) }}">{{ $motorista->name }}</a>
                                        </td>
                                        <td>{{ $motorista->categoria }}</td>
                                               <td>{{ Carbon\Carbon::parse($motorista->datanascimento)->age }}</td>
                   
                    
                                        <td>{{ $motorista->grau_academico }}</td>
                                        <td>{{ $motorista->celular }}</td>

                                        @if($motorista->cv!="")
                                        <td><a href="/{{ $motorista->cv }}"><button
                                                    class="btn btn-info waves-effect waves-light w-100">ver CV</button></a>
                                        </td>
                                        @else
                                          <td>
                                                sem cv
                                          </td>
                                        @endif
                                    </tr>

                                 @php
                                    $id++;
                                @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end fitros section -->
                <!-- anuncios section -->


                <div class="col-md-12 mt-4 m_bd_motoristas">

                    <div class="row">

                       



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
