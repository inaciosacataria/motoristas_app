@extends('layouts.appmain')
@section('title')
    Área do Empregador |
@endsection
@section('content')
    <div class="wrapper">

        <div class="container-fluid">
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
            @if (session('status'))
                <div class="mt-4 alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-check"></i> {{ session('status') }}</p>
                </div>
            @endif

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="page-title m-0">Área do Empregador</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Anúncios de vaga <span class="float-right">
                                    <button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal"
                                        data-target="#anuncio" <i class="dripicons-plus">
                                        </i>&nbsp;Nova vaga</button>
                                </span></h4>
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Título da vaga</th>
                                        <th>Data da Publicação</th>
                                        <th>Validade</th>
                                        <th>Estado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($anuncios as $key => $anuncio)
                                        <tr>
                                            <td><a href="{{ route('verAnuncio', $anuncio->slug ?? $anuncio->id) }}"
                                                    target="_blank">{{ $anuncio->titulo }}</a></td>
                                            <td>{{ Carbon\Carbon::parse($anuncio->created_at)->format('d-M-Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($anuncio->validade)->format('d-M-Y') }}</td>
                                            <td>{{ $anuncio->estado_anuncio }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('verCandidatosDeUmAnuncio', $anuncio->slug ?? $anuncio->id) }}"
                                                    class="btn btn-sm btn-success waves-effect waves-light"><i
                                                        class="fa fa-users"></i> Candidaturas recebidas</a>

                                                @php
                                                    $anuncio_obj = json_encode((array) $anuncio);
                                                @endphp
                                                <button href="#"
                                                    class="btn btn-sm btn-primary waves-effect waves-light"
                                                    data-toggle="modal" data-target="#editarAnuncio"
                                                    onclick="loadData('{{ $anuncio_obj }}')"><i
                                                        class="fa fa-edit"></i></button>

                                               <form method="post" style="display: inline; color: white;" action="{{ route('apagarAnuncio', $anuncio->id) }}">
    @csrf <!-- Include CSRF token -->
    <button type="button" onclick="confirmDelete('{{ __('Tem certeza que pretende eliminar este anuncio?') }}')" class="btn btn-sm btn-danger waves-effect waves-light white">
        <i class="far fa-trash-alt"></i>
    </button>
</form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>


                            <div id="anuncio" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form class="form-horizontal m-t-20" action="{{ route('criarAnuncio') }}"
                                            method="post" id="add_anuncio">
                                            @csrf
                                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myModalLabel">Anúncios de vaga</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Titulo
                                                        do anúncio</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="titulo" id="titulo"
                                                            type="text" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Categoria </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="categoria_id" id="categoria"
                                                            required>
                                                            <option selected>Seleccione a Categoria...</option>
                                                            @foreach ($categorias as $key => $categoria)
                                                                <option value="{{ $categoria->id }}">
                                                                    {{ $categoria->categoria }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Província </label>
                                                    <div class="col-sm-9">
                                                        <ul class="varias-provincias" id="varias_provincias">
                                                            @foreach ($provincias as $provincia)
                                                                <li>
                                                                    <input class="form-check-input provincia"
                                                                        type="checkbox" name="provincias[]"
                                                                        value="{{ $provincia->id }}">
                                                                    <label class="form-check-label" for="provincia">
                                                                        {{ $provincia->name }}
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Descrição</label>
                                                    <div class="col-sm-9">
                                                        <textarea id="descricao" name="descricao" class="form-control" rows="6"
                                                            placeholder="Ex: Escreve aqui a descrição do anúncio..."></textarea>
                                                    </div>
                                                </div>




                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Forma
                                                        de candidatura</label>
                                                    <div class="col-sm-9">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="forma_de_candidatura"
                                                                value="Portal" checked>No Portal
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="forma_de_candidatura"
                                                                value="Outro meio">Outro meio
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Validade</label>
                                                    <div class="col-sm-5">
                                                        <input class="form-control" name="validade" id="validade"
                                                            type="date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">Publicar</button>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


                            <div id="editarAnuncio" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form class="form-horizontal m-t-20" action="{{ route('editarAnuncio') }}"
                                            method="post" id="add_anuncio">
                                            @csrf
                                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                            <input name="id" id="anuncioIdEdit" type="hidden">

                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myModalLabel">Editar Anúncios de vaga
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Titulo
                                                        do anúncio</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="title" id="title"
                                                            type="text" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Categoria </label>
                                                    <div class="col-sm-9">


                                                        <select class="form-control" name="categoria_id" id="categoria"
                                                            required>
                                                            <option selected>Seleccione a Categoria...</option>

                                                            @foreach ($categorias as $key => $categoria)
                                                                <option value="{{ $categoria->id }}">
                                                                    {{ $categoria->categoria }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Província </label>
                                                    <div class="col-sm-9">
                                                        <ul class="varias-provincias" id="varias_provincias">
                                                            @foreach ($provincias as $provincia)
                                                                <li>
                                                                    <input class="form-check-input provincia"
                                                                        type="checkbox" name="provincias[]"
                                                                        value="{{ $provincia->id }}">
                                                                    <label class="form-check-label" for="provincia">
                                                                        {{ $provincia->name }}
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Descrição</label>
                                                    <div class="col-sm-9">
                                                        <textarea id="descriptionEdit" name="descricao" class="form-control" rows="6"
                                                            placeholder="Ex: Escreve aqui a descrição do anúncio..."></textarea>
                                                    </div>
                                                </div>




                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Forma
                                                        de candidatura</label>
                                                    <div class="col-sm-9">
                                                        <label class="radio-inline">
                                                            <input type="radio" id="inlineRadio1"
                                                                name="forma_de_candidatura" value="Portal" checked>No
                                                            Portal
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" id="inlineRadio2"
                                                                name="forma_de_candidatura" value="Outro meio">Outro meio
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-sm-3 col-form-label">Validade</label>
                                                    <div class="col-sm-5">
                                                        <input class="form-control" name="validade" id="validade"
                                                            type="date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">Publicar</button>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="social-source-icon lg-icon mb-3">
                                    @if (Auth::user()->foto_url == 'none')
                                        <img src="assets/images/users/avatar-6.jpg" alt="user"
                                            class="rounded-circle width-100" id="image-profile" data-toggle="modal"
                                            data-target="#logo">
                                    @else
                                        <img src="{{ Auth::user()->foto_url }}" alt="user"
                                            class="rounded-circle width-100" id="image-profile" data-toggle="modal"
                                            data-target="#logo">
                                    @endif
                                </div>
                                <h5 class="font-16"><a href="#"
                                        class="text-dark">{{ ucfirst(Auth::user()->name) }}</a></h5>
                                <p class="text-center"><b><a
                                            href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></b></p>
                                <p class="text-center"><b><a href=""></a></b></p>
                                <p class="text-center"></p>
                                <hr>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <p>Anúncios <span class="badge badge-warning float-right">
                                            {{ $anuncios->count() }}</span></p>
                                </div>
                                <hr>
                                <!-- Central de Risco removido -->
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end col -->
                <!-- end col -->
            </div>

            <!-- Central de Risco removido -->
            <!--  <div id="denunciarMotorista" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                      <div class="modal-dialog modal-lg">
                                                                          <div class="modal-content">
                                                                            <form class="form-horizontal m-t-20" action="#" method="post" id="denunciar_form">
                                                                              @csrf
                                                                              <div class="modal-header">
                                                                                  <h5 class="modal-title mt-0" id="myModalLabel">Denunciar Motorista</h5>
                                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                  </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Procurar Motorista</label>
                                                                                      <div class="col-sm-9">
                                                                                        <div class="input-group">
                                                                                          <input type="text" class="form-control" name="nome_pesquisa" id="nome_pesquisa" type="text" placeholder="Nome completo do motorista" required>
                                                                                          <span class="input-group-btn">
                                                                                            <a class="btn btn-default">
                                                                                                <i class="fa fa-search"></i>
                                                                                            </a>
                                                                                          </span>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Seleccione o Motorista</label>
                                                                                      <div class="col-sm-9">
                                                                                        <select class="form-control" name="candidato_id" id="resul_pesquisa" disabled required>
                                                                                          <option>Seleccione o motorista...</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Dados do motorista</label>
                                                                                      <div class="col-sm-9">
                                                                                        <div id="info_motorista" class="fundo-gray" id="fundo-gray">
                                                                                          <span id="seleted_motorista"></span>
                                                                                         </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Funções do motorista na empresa </label>
                                                                                      <div class="col-sm-9">
                                                                                       <input class="form-control" name="funcoes_do_candidato" id="funcoes_do_candidato" type="text" required>
                                                                                    </div>
                                                                                </div>

                                                                                  <div class="form-group row">
                                                                                      <label for="example-text-input" class="col-sm-3 col-form-label">Descrição da infração</label>
                                                                                        <div class="col-sm-9">
                                                                                          <textarea id="infracao" name="infracao" class="form-control" rows="6"
                                                                                              placeholder="Ex: Detalhar a informação da infracção ou crime ..."></textarea>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="form-group row justify-content-end">
                                                                                      <label for="example-text-input" class="col-sm-12 col-form-label">Acha que motorista merece outra oportunidade de trabalho? </label>
                                                                                      <div class="col-sm-9 align-self-end">
                                                                                        <label class="radio-inline">
                                                                                          <input type="radio" name="merece_portunidade" value="Sim" checked>&nbsp; Sim &nbsp;&nbsp;
                                                                                        </label>
                                                                                        <label class="radio-inline">
                                                                                          <input type="radio" name="merece_portunidade" value="Não">&nbsp; Não
                                                                                        </label>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                                                                                  <button type="submit" class="btn btn-primary waves-effect waves-light">Enviar</button>
                                                                              </div>
                                                                            </form>
                                                                          </div><!-- /.modal-content -->
            <!--</div>-->
            <!-- /.modal-dialog -->
            <!--</div>-->
            <!--fim modal denunciar motorista-->


            <!-- /inicio modal denunciar motorista  2-->
            <div id="denunciarMotorista" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="form-horizontal m-t-20" action="#" method="post"
                            id="denunciar_form">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Denunciar Motorista</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Dado do
                                        Motorista</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="nome_motorista"
                                                id="nome_motorista" type="text"
                                                placeholder="Nome completo do motorista" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <label for="example-text-input" class="col-sm-3 col-form-label"
                                                style="min-width:160px;color:gray">Data de nascimento:</label>

                                            <input type="date" class="form-control" name="datanascismento_motorista"
                                                id="datanascismento_motorista" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <input type="number" class="form-control" name="celular_motorista"
                                                id="celular_motorista" placeholder="Celular">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <input type="text" class="form-control" name="nacionalidade_motorista"
                                                id="nacionalidade_motorista" placeholder="Nacionalidade">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <select class="form-control" name="provincia_motorista" id="provincia"
                                                required>
                                                @php
                                                    $provincias = App\Models\Provincias::all();
                                                @endphp
                                                <option selected>Seleccione a Provincia</option>
                                                @foreach ($provincias as $key => $provincia)
                                                    <option value="{{ $provincia->name }}">{{ $provincia->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <input type="text" class="form-control" name="endereco_motorista"
                                                id="endereco_motorista" placeholder="Endereço">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <select class="form-control" name="Categoria_motorista" id="categoria"
                                                required>
                                                @php
                                                    $provincias = App\Models\Categorias::all();
                                                @endphp
                                                <option selected>Seleccione a Categoria</option>
                                                @foreach ($categorias as $key => $categoria)
                                                    <option value="{{ $categoria->categoria }}">
                                                        {{ $categoria->categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-9" style="margin-left:200px">
                                        <div class="input-group ">
                                            <input type="text" class="form-control" name="cartadeconducao_motorista"
                                                id="cartadeconducao_motorista"
                                                placeholder="Numero de carta de condução (opicional)">
                                        </div>
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Funções do motorista
                                        na empresa</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="funcoes_do_candidato" id="funcoes_do_candidato"
                                            type="text" placeholder="Ex: transporte de mercadorias..." required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Descrição da
                                        infração</label>
                                    <div class="col-sm-9">
                                        <textarea id="infracao" name="infracao" class="form-control" rows="6"
                                            placeholder="Ex: Detalhar a informação da infracção ou crime ..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-end">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Acha que motorista
                                        merece outra oportunidade de trabalho? </label>
                                    <div class="col-sm-9 align-self-end">
                                        <label class="radio-inline">
                                            <input type="radio" name="merece_portunidade" value="Sim" checked>&nbsp;
                                            Sim &nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="merece_portunidade" value="Não">&nbsp; Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect"
                                    data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modaldenunciar motorista -->
            <!--fim modal denunciar motorista-->

            <!-- /.modal-content central de risco-->
            <div style="backgroundColor:white"class="modal fade bs-central-risco-modal-center" tabindex="-1"
                role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered text-center">
                    <div class="modal-content">
                        <div class="btn-especial-close">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mb-4">
                            <h4 class="mb-4">Central de Risco de Motoristas</h4>
        
                            <p>Para ter o acesso contacte, +258 87 12 200 22 ou por email info@motoristas.co.mz</p>
                            {{-- <a href="tel:+258875474495" class="mt-4 btn btn-primary waves-effect waves-light">Ligar
                                Agora</a> --}}
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="logo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form-horizontal m-t-20" action="/logotipo" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Logotipo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Logotipo</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="documento" type="file"
                                            onchange="readURL(this);" accept="application/pdf" required>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="modal fade bs-central-risco-modal-center" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered text-center">
                    <div class="modal-content">
                        <div class="btn-especial-close">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mb-4">
                            <h4 class="mb-4">Central de Risco de Motoristas</h4>
                            <p>Central de risco de motoristas, é uma lista de motoristas que cometeram crimes rodoviários,
                                acidentes com culpa, desvio de mercadoria /combustível, condução danosa etc. <br>Para ter
                                acesso contacte o administrador.</p>
                            <a href="tel:+258875474495" class="mt-4 btn btn-primary waves-effect waves-light">Ligar
                                Agora</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div> <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->
@section('scripts')
    <script>
        $('#seleted_motorista').hide();
        $('#nome_pesquisa').on('change', function(e) {
            e.preventDefault();
            var keyword = $(this).val();
            var inscricao_id = $('#inscricao_id').val();
            var data = 'keyword=' + keyword;
            $.ajax({ //create an ajax request to display.php
                data: data,
                url: '/procurar-motorista',
                type: "get",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.error === 'error') {
                        console.log('error');
                        $('#resul_pesquisa').prop("disabled", true);
                    }
                    $('.resul_class').remove();
                    $('#seleted_motorista').hide();
                    $.each(data.msg, function(key, value) {

                        $('#resul_pesquisa').append($("<option></option>").attr("value", value
                            .id).addClass("resul_class").text(value.name));
                    });
                    $('#resul_pesquisa').prop("disabled", false);
                }
            });

        });

        $('#resul_pesquisa').on('change', function(e) {
            e.preventDefault();
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;

            var data = 'id=' + valueSelected;
            $.ajax({ //create an ajax request to display.php
                data: data,
                url: '/get-motorista',
                type: "get",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.error === 'error') {
                        console.log('error');
                    }
                    $('#seleted_motorista').html(" ");
                    console.log(data.msg.nome);
                    var conteudo = '<p><b>Nome completo: </b>' + data.msg.nome + '</p>' +
                        '<p><b>Data de nascimento: </b>' + data.msg.datanascimento + '</p>' +
                        '<p><b>Celular: </b>' + data.msg.celular + '</p>' +
                        '<p><b>Endereço: </b>' + data.msg.endereco + '</p>' +
                        '<p><b>Provincia: </b>' + data.msg.provincia + '</p>' +
                        '<p><b>Categoria da carta de condução: </b>' + data.msg.categoria + '</p>' +
                        '<p><b>Número da carta de condução: </b>' + data.msg.numero_carta_conducao +
                        '</p>';
                    $(conteudo).appendTo('#seleted_motorista');

                    $('#seleted_motorista').show();

                }
            });
        });

        $("div.id_100 select").val("val2").change();



        function loadData(json) {
            var anuncio = JSON.parse(json)
            console.log(anuncio);
            $('#title').val(anuncio.titulo);
            $('#descriptionEdit').val(anuncio.descricao);
            $('#anuncioIdEdit').val(anuncio.id)
            if (anuncio.forma_de_candidatura == "Portal") {
                $('#inlineRadio1').attr('checked', 'checked');
            } else {
                $('#inlineRadio2').attr('checked', 'checked');
            }

        }
    </script>
    <script>
    function confirmDelete(message) {
        if (confirm(message)) {
            document.querySelector('form').submit(); // Submit the form if confirmed
        }
    }
</script>
@endsection
@endsection
