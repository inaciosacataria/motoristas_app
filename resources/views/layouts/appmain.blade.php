<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title') motoristas.co.mz</title>

    <meta name="description" content="O portal de emprego e formação de motoristas">
    <meta name="keywords"
        content="emprego, jobs, estagio, estágio,  concursos, moçambique, negócio, oportunidade, serviço, mozambique, maputo, contratação, higiene, limpeza, informática, carro, transporte, automoveis, turismo, manutenção, reparação">
    <meta content="Microitc Lda" name="author" />


    <meta property="og:url" content="motoristas.co.mz">
    <meta property="og:title" content="Portal de Emprego e Formação de motoristas | motoristas.co.mz">
    <meta property="og:description" content="O portal de emprego e formação de motoristas">
   <meta property="og:image" content="{{ asset('assets/images/motoristas.png') }}">
    <meta property="og:image:alt" content="texto_alternativo_da_imagem" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- morris css -->
    <!--  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}"> -->
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/searchbar.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/courses_pages.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/courses_pages2.css') }}" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="courses.js" defer=""></script>
    <script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
    </div>

    <div class="header-bg">
        <!-- Navigation Bar-->
        <header id="topnav">
            <nav class="navbar navbar-expand-lg navbar-custom" style=" background-color: #04c512;">

                <!-- Logo-->
                <div>
                    <a href="/" class="logo navbar-brand">
                        <img src="{{ asset('assets/images/2.png') }}" alt="logo motoristas" height="23">
                    </a>
                </div>
                <!-- End Logo-->


                <button class="navbar-toggler navbar-toggle nav-link" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="list-inline ml-auto mb-0 navbar-nav mr-auto">

                        <li class="list-inline-item dropdown notification-list nav-user nav-item">
                            @guest
                                <a class="nav-link" href="#" data-toggle="modal"
                                    data-target=".bs-base-dados-modal-center" style="color:#fff">
                                    <i class="bi bi-car-front"></i> Base de dados
                                </a>
                            @else
                                @if (Auth::user()->privilegio == 'admin')
                                    <a class="nav-link" href="/bd-motoristas" style="color:#fff">
                                        <i class="bi bi-car-front"></i> Base de dados
                                    </a>
                                @else
                                    <a class="nav-link" href="#" data-toggle="modal"
                                        data-target=".bs-base-dados-modal-center" style="color:#fff">
                                        <i class="bi bi-car-front"></i> Base de dados
                                    </a>
                                @endif

                            @endguest
                        </li>

                        <!-- Central de Risco removido -->

                        <li class="list-inline-item dropdown notification-list nav-user nav-item">
                            @guest
                                <a class="nav-link" href="/cursos" style="color:#fff">
                                    <i class="bi bi-car-front"></i> Formação de motoristas
                                </a>
                            @else
                                @if (Auth::user()->privilegio == 'admin')
                                    <a class="nav-link" href="/cursos" style="color:#fff">
                                        <i class="bi bi-car-front"></i> Formação de motoristas
                                    </a>
                                @else
                                    <a class="nav-link" href="/cursos" style="color:#fff">
                                        <i class="bi bi-car-front"></i> Formação de motoristas
                                    </a>
                                @endif

                            @endguest
                        </li>

                        <!-- User-->
                        @guest
                            <li class="list-inline-item dropdown notification-list nav-item">
                                <a class="nav-link" href="{{ route('login', 'candidato') }}" style="color:#fff">
                                    <i class="dripicons-user"></i> Candidato
                                </a>
                            </li>
                            <li class="list-inline-item dropdown notification-list nav-user nav-item">
                                <a class="nav-link" href="{{ route('login', 'recrutador') }}" style="color:#fff">
                                    <i class="fas fa-hospital"></i>&nbsp;Empregador
                                </a>
                            </li>
                        @else
                            @if (Auth::user()->privilegio == 'empregador')
                                <li class="list-inline-item dropdown notification-list nav-user nav-item">
                                    <a class="nav-link" href="/empregador" style="color:#fff">
                                        <i class="fas fa-hospital"></i>&nbsp; Perfil
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->privilegio == 'candidato')
                                <li class="list-inline-item dropdown notification-list nav-item">
                                    <a class="nav-link" href="/candidato" style="color:#fff">
                                        <i class="dripicons-user"></i>&nbsp; Perfil
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->privilegio == 'admin')
                                <li class="list-inline-item dropdown notification-list nav-item">
                                    <a class="nav-link" href="/admin" style="color:#fff">
                                        <i class="mdi mdi-view-dashboard"></i>&nbsp; Dashboard
                                    </a>
                                </li>
                            @endif

                            <li class="list-inline-item dropdown notification-list nav-user nav-item  dropdown ">
                                <a class="nnav-link dropdown-toggle arrow-none waves-effect" href="#"
                                    id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <!--  <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle"> -->
                                    <span class="d-none d-md-inline-block ml-1">{{ Auth::user()->name }} <i
                                            class="mdi mdi-chevron-down"></i> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown"
                                    aria-labelledby="navbarDropdownMenuLink">
                                    <!--    <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                                                                                      <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> My Wallet</a>
                                                                                      <a class="dropdown-item" href="#"><span class="badge badge-success float-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a>
                                                                                      <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a>
                                                                                      <div class="dropdown-divider"></div> -->
                                    <a class="dropdown-item" href="/logout"><i
                                            class="dripicons-exit text-muted"></i>Logout</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>


            </nav>

        </header>
        <!-- End Navigation Bar-->

    </div>
    <!-- header-bg -->

    @yield('content')
    <!-- /.modal-content base de dados-->
    <div class="modal fade bs-base-dados-modal-center" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content">
                <div class="btn-especial-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-4">
                    <h4 class="mb-4">Base de dados</h4>A Base de dados de motoristas ė uma rede de mais 2600+ motoristas profissionais que actuam em diferentes empresas e organizações, incluindo motoristas em busca de emprego, as empresas e organizações afins, parceiras deste portal podem os contactar para efeitos de contratação. </p>
                    <a href="tel:+258871220022" class="mt-4 btn btn-primary waves-effect waves-light">Contactar</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade lista-formacao-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content">
                <div class="btn-especial-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-4">
                    <h4 class="mb-4">Formação de Motorista</h4>
                    <p>Lista de motorista com Formação Complementada e aperfeçoada em condução defensiva, nos ramos de
                        transportes de mercadorias e passageiros. <br>Para ter acesso a estes dados, contacte o
                        administrador.</p>
                    <a href="tel:+258871220022" class="mt-4 btn btn-primary waves-effect waves-light">Ligar Agora</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- /.modal-content central de risco-->
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
                    <h4 class="mb-4">Central de Risco</h4>
                    <p>Para ter o acesso as informações constantes na central de risco, cadastre-se e contacte, +258 87
                        12 200 22 ou por email info@motoristas.co.mz</p>
                    <a href="tel:+258871220022" class="mt-4 btn btn-primary waves-effect waves-light">Ligar Agora</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © Copyright {{ now()->year }} - motoristas.co.mz. Todos os Direitos Reservados
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

    <!--Morris Chart
       <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
-->
    <!-- dashboard js -->
    <!--   <script src="{{ asset('assets/pages/dashboard.int.js') }}"></script> -->

    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>

    <!--tinymce js-->
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>




    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_NTMHZDMlgP99BvsMJvrzd31pni_5yz0"></script> -->
    <script>
        $(".escolar").hide();
        $(".tecnico").hide();
        $(".superior").hide();

        $('#nivel_de_ensino').on('change', function() {

            if (this.value === 'Escolar') {
                $(".escolar").show();
            } else {
                $(".escolar").hide();
            }

            if (this.value === 'Tecnico-Profissional') {
                $(".tecnico").show();
            } else {
                $(".tecnico").hide();
            }

            if (this.value === 'Superior') {
                $(".superior").show();
            } else {
                $(".superior").hide();
            }


        });

        $(".info-utente").click(function(e) { // get dados pessoais do utente
            e.preventDefault();
            $(".sp-loading").show();
            $(".contentUtente").load($(this).attr('href'));
            $(".sp-loading").hide();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Init separadamente para evitar incompatibilidades com selector múltiplo.
            if ($("#descricao").length > 0) {
                tinymce.init({
                    selector: "textarea#descricao",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                            title: 'Bold text',
                            inline: 'b'
                        },
                        {
                            title: 'Red text',
                            inline: 'span',
                            styles: {
                                color: '#ff0000'
                            }
                        },
                        {
                            title: 'Red header',
                            block: 'h1',
                            styles: {
                                color: '#ff0000'
                            }
                        },
                        {
                            title: 'Example 1',
                            inline: 'span',
                            classes: 'example1'
                        },
                        {
                            title: 'Example 2',
                            inline: 'span',
                            classes: 'example2'
                        },
                        {
                            title: 'Table styles'
                        },
                        {
                            title: 'Table row 1',
                            selector: 'tr',
                            classes: 'tablerow1'
                        }
                    ]
                });
            }

            if ($("#descriptionEdit").length > 0) {
                tinymce.init({
                    selector: "textarea#descriptionEdit",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                            title: 'Bold text',
                            inline: 'b'
                        },
                        {
                            title: 'Red text',
                            inline: 'span',
                            styles: {
                                color: '#ff0000'
                            }
                        },
                        {
                            title: 'Red header',
                            block: 'h1',
                            styles: {
                                color: '#ff0000'
                            }
                        },
                        {
                            title: 'Example 1',
                            inline: 'span',
                            classes: 'example1'
                        },
                        {
                            title: 'Example 2',
                            inline: 'span',
                            classes: 'example2'
                        },
                        {
                            title: 'Table styles'
                        },
                        {
                            title: 'Table row 1',
                            selector: 'tr',
                            classes: 'tablerow1'
                        }
                    ]
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</ht
