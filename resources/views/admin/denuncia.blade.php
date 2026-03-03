@extends('layouts.appmain')
@section('title')
Denuncia |
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

      <!-- Page-Title -->
      <div class="row">
          <div class="col-sm-12">
              <div class="page-title-box">
                  <div class="row align-items-center">
                      <div class="col-md-12">
                         <div class="esquerda">
                            <span><h4 class="page-title m-0">Perfil do Motorista</h4></span>
                         </div>
                          <section class="navega">
                          <div class="direita">
                            <span><a href="/admin" >Dashboard</a></span> |
                            <span>Central de Risco de Motoristas</span> |
                            <span><a href="#">{{ ucfirst($denuncia->nome_motorista) }}</a><span>
                           </div>
                          </section>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- end page title end breadcrumb -->

        <div class="row meu-curriculum">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                      <h4 class="mt-0 header-title mb-4 text-center">Motorista Denunciado </h4>
                        <div class="text-center">
                            <div class="social-source-icon lg-icon mb-3">
                                <img src="/assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle width-100">
                            </div>
                            <h5 class="font-16"><a href="#" class="text-dark">{{ ucfirst($denuncia->nome_motorista) }}</a></h5>
                            <br>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                              <p><b>Celular: </b>{{ $denuncia->celular_motorista }}</p>
                              <p><b>Habilitacao de condução: </b>{{ $denuncia->Categoria_motorista }}</p>
                              <p><b>Número da carta de ondução: </b>{{ $denuncia->cartadeconducao_motorista }}</p>
                              <p><b>Data de nascimento: </b>{{ Carbon\Carbon::parse($denuncia->datanascismento_motorista)->format('d-M-Y') }}</p>
                              <p><b>Nacionalidade: </b>{{ $denuncia->nacionalidade_motorista }}</p>
                              <p><b>Residência: </b>{{ $denuncia->endereco_motorista }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                      <h4 class="mt-0 header-title mb-4 text-center">Denunciante </h4>
                        <div class="text-center">
                            <div class="social-source-icon lg-icon mb-3">
                            @if($denunciante->foto_url!="none" || $denunciante->foto_url==null)
                               <img src="/assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle width-100">
                             @else
                             <img src="{{ $denunciante->foto_url }}" alt="user" class="rounded-circle width-100" id="image-profile" >
                             @endif
                            </div>
                            <h5 class="font-16"><a href="#" class="text-dark">{{ ucfirst($denunciante->empresa) }}</a></h5>
                            <br>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-12">
                            <p><b>Celular: </b>{{ $denunciante->telefone }}</p>
                            <p><b>Email: </b>{{ $denunciante->email_empregador }}</p>
                            @if($denunciante->sector_actividade=="Outro")
                                @if( $denunciante->sector_especificado==null || $denunciante->sector_especificado=="" )
                                  <p><b>Sector: </b>{{ $denunciante->sector_especificado }}</p>
                                @endif
                            @else
                                <p><b>Sector: </b>{{ $denunciante->sector_actividade }}</p>
                            @endif
                          </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title mb-4">Curriculum Vitae <span class="float-right"><button  class="btn btn-secondary btn-sm waves-effect waves-light"> CURRICULUM PDF &nbsp;<i class="dripicons-download"></i></button></span></h4>-->
                        <div class="row">
                          <div class="col-md-12">
                                <h4 class="title font-16 mt-0"><h4 class="page-title m-0 m-b-2">Informações da denuncia</h4>
                                <hr>
                                  <form class="form-horizontal mt-4" action="{{ route('updateDenuncia') }}" method="post" id="denunciar_form">
                                    @csrf
                                    <input name="id" value="{{ $denuncia->id}}" type="hidden">
                                      <div class="form-group row">
                                          <label for="example-text-input" class="col-sm-12 col-form-label">Funções do motorista na empresa </label>
                                            <div class="col-sm-12">
                                             <input class="form-control" name="funcoes_do_candidato" id="funcoes_do_candidato" value="{{ $denuncia->funcoes_do_candidato}}" type="text" disabled required>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="example-text-input" class="col-sm-12 col-form-label">Descrição da infração</label>
                                            <div class="col-sm-12">
                                              <textarea id="infracao" name="infracao" class="form-control" rows="10" placeholder="Ex: Detalhar a informação da infracção ou crime ..." disabled>{{ $denuncia->infracao }}</textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="example-text-input" class="col-sm-12 col-form-label">Acha que motorista merece outra oportunidade de trabalho? </label>
                                          <div class="col-sm-12">
                                            <input class="form-control" name="merece_portunidade" value="{{ $denuncia->merece_portunidade }}" id="merece_portunidade" type="text"  disabled required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-text-input" class="col-sm-12 col-form-label">Versão do Motorista</label>
                                            <div class="col-sm-12">
                                              <textarea id="versao_motorista" name="versao_motorista" class="form-control" rows="10" placeholder="Ex: Escrever a versão da historia do motorista..." disabled>{{ $denuncia->versao_motorista }}</textarea>
                                          </div>
                                      </div>
                                      <div class="form-group row">

                                            @if(Auth::user()->privilegio=="admin")
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Confirma a denuncia?</label>
                                            <div class="col-sm-9 align-self-end">
                                                <label class="radio-inline">
                                                  <input type="radio" name="merece_portunidade" value="confirmada" @if($denuncia->estado_denuncia == "confirmada") checked @endif>&nbsp; Confirmar &nbsp;&nbsp;
                                                </label>

                                                <label class="radio-inline">
                                                  <input type="radio" name="merece_portunidade" value="Não confirmada" @if($denuncia->estado_denuncia == "Não confirmada") checked @endif> Não confirmar
                                                </label>
                                              </div>

                                            @else
                                             <label for="example-text-input" class="col-sm-12 col-form-label">Estado da denuncia?</label>
                                             <div class="col-sm-9 align-self-end">
                                                @if($denuncia->estado_denuncia == "confirmada")
                                                <label class="radio-inline">
                                                  <input type="radio" name="merece_portunidade" value="confirmada" @if($denuncia->estado_denuncia == "confirmada") checked @endif>&nbsp; Confirmada &nbsp;&nbsp;
                                                </label>
                                                @else
                                                <label class="radio-inline">
                                                  <input type="radio" name="merece_portunidade" value="Não confirmada" @if($denuncia->estado_denuncia == "Não confirmada") checked @endif> Não confirmada
                                                </label>
                                                @endif
                                              </div>
                                            @endif

                                      </div>
                                    <div class="float-right">
                                        @if(Auth::user()->privilegio=="admin")
                                        <button type="button" id="btn_editar" class="btn btn-primary waves-effect waves-light">Editar</button>
                                        <button type="button" id="btn_cancel" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btn_actualizar" class="btn btn-success waves-effect waves-light">Actualizar</button>
                                        @endif
                                    </div>
                                  </form>
                          </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end col -->
            <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->
@section('scripts')
  <script>
    $('#btn_cancel').hide();
    $('#btn_actualizar').hide();

    $('#btn_editar').on('click', function(e) {
          $('#btn_editar').hide();
          $('#btn_cancel').show();
          $('#btn_actualizar').show();
          $('#versao_motorista').prop("disabled", false);
    });
    $('#btn_cancel').on('click', function(e) {
          $('#btn_editar').show();
          $('#btn_cancel').hide();
          $('#btn_actualizar').hide();
          $('#versao_motorista').prop("disabled", true);
    });




  </script>
@endsection
@endsection
