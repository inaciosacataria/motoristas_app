<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title></title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        form h1 {
            font-weight: bold;
            margin: 0;
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #04c512;
            background-color: #04c512;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            //align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            //text-align: center;
        }


        input,
        select {
            background-color: #eee;
            padding: 12px 15px;
            margin: 8px 0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            //position: relative;
            overflow: hidden;
            max-width: 100%;
            min-height: 100%;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);

        }

        .sign-up-container {
            left: 0;
            margin-top: 100px;
            height: 120%;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
            height: 130%;
        }

        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #04c512, #04c512);
            background: linear-gradient(to right, #04c512, #04c512);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);

        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
            height: 100%;
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);

        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #04c512;
            text-decoration: none;
        }

        .form-check-label {
            margin-bottom: 7px;
            margin-right: 16px;
        }

        .margin-left-20 {
            margin-left: -20px;
        }

        .btn-create {
            visibility: hidden;
        }

        @media only screen and (max-width: 580px) {
            .sign-in-container {
                width: 100%;
            }

            .overlay {
                visibility: hidden;
            }

            .sign-up-container {
                width: 100%;
                left: -370px;
                height: auto;
            }

            .btn-create {
                visibility: visible;
            }
        }
    </style>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('css/login.css') }}" rel="stylesheet"> -->
</head>

<body>

    <h2><a href="/"><img src="{{ asset('assets/images/logo-blue.png') }}" alt="logo motoristas"
                height="60"></a></h2>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            @if (isset($_GET['candidato']))

                <form method="POST" action="{{ route('newCandidato') }}" class="formulario">
                    <h1>Criar conta candidato!</h1>
                    <p class="text-center">Use as suas credenciais para registrar a sua conta</p>
                    @csrf
                    <input type="hidden" name="privilegio" value="candidato" />
                    <input id="name" type="text"
                        class="form-control required @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input id="celular" type="number" class="form-control @error('celular') is-invalid @enderror"
                        name="celular" value="{{ old('celular') }}" required autocomplete="email" placeholder="Celular">
                    @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" />

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Senha">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirmar Senha">

                    <input id="data_nascimento" type="date" class="form-control" name="data_nascimento" required
                        placeholder="Data de Nascimento">
                    <input id="nacionalidade" type="text" class="form-control" name="nacionalidade" required
                        placeholder="Nacionalidade">

                    <div class="form-check">
                        <label class="form-check-label margin-left-20">Sexo: </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="sexo" type="radio" id="inlineCheckbox1"
                                value="Masculino">
                            <label class="form-check-label" for="inlineCheckbox1">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="sexo" type="radio" id="inlineCheckbox2"
                                value="Feminino">
                            <label class="form-check-label" for="inlineCheckbox2">Feminino</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-12 col-form-label">Nível Académico</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="nivel_de_ensino" name="nivel">
                                <option>Nível</option>
                                <option value="Escolar">Escolar</option>
                                <option value="Tecnico-Profissional">Técnico-Profissional</option>
                                <option value="Superior">Superior</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="grau_academico">
                                <option>Grau</option>
                                <option class="escolar" value="1ª à 5ª Classe">1ª à 5ª Classe</option>
                                <option class="escolar" value="6ª à 7ª Classe">6ª à 7ª Classe</option>
                                <option class="escolar" value="8ª à 10ª Classe">8ª à 10ª Classe</option>
                                <option class="escolar" value="11ª à 12ª Classe">11ª à 12ª Classe</option>
                                <option class="tecnico" value="Tecnico Básico">Básico</option>
                                <option class="tecnico" value="Tecnico Elementar">Elementar</option>
                                <option class="tecnico" value="Tecnico Médio">Médio</option>
                                <option class="superior" value="Bacharelato">Bacharelato</option>
                                <option class="superior" value="Licenciatura">Licenciatura</option>
                                <option class="superior" value="Mestrado">Mestrado</option>
                                <option class="superior" value="Doutoramento">Doutoramento</option>
                                <option class="superior" value="Pós-Doutoramento">Pós-Doutoramento</option>
                            </select>
                        </div>
                    </div>

                    <select class="form-control" name="provincia_id" id="provincia" required>
                        @php
                            $provincias = App\Models\Provincias::all();
                        @endphp
                        <option selected required>Seleccione a Provincia</option>
                        @foreach ($provincias as $key => $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                        @endforeach
                    </select>
                    <textarea class="form-control" name="endereco" id="endereco" rows="3" placeholder="Residência..."></textarea>
                    <select class="form-control" name="categoria_id" id="categoria" required>
                        @php
                            $categorias = App\Models\Categorias::all();
                        @endphp
                        <option selected>Habilitacao de Condução</option>
                        @foreach ($categorias as $key => $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                        @endforeach
                    </select>

                    <input id="numero_carta_conducao" type="text" class="form-control"
                        name="numero_carta_conducao" placeholder="Número da Carta de Condução (opcional) ">
                    <div class="form-check">
                        <label class="form-check-label margin-left-20">A sua carta de condução está dentro da validade?
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="validade_conducao" type="radio"
                                id="inlineCheckboxValidadeConducao1" value="Sim">
                            <label class="form-check-label" for="inlineCheckboxValidadeConducao1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="validade_conducao" type="radio"
                                id="inlineCheckboxValidadeConducao2" value="Não">
                            <label class="form-check-label" for="inlineCheckboxValidadeConducao2">Não</label>
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label margin-left-20">Já foi inibido de conduzir? </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="inibicao_anterior" type="radio"
                                id="inlineCheckboxInibicao1" value="Sim">
                            <label class="form-check-label" for="inlineCheckboxInibicao1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="inibicao_anterior" type="radio"
                                id="inlineCheckboxInibicao2" value="Não">
                            <label class="form-check-label" for="inlineCheckboxInibicao2">Não</label>
                        </div>
                    </div>
                    <input hidden class="form-check-input" name="envolvimento_acidente" type="radio"
                        id="inlineCheckboxInibicao2" value="Não">
                    <textarea class="form-control" name="inibicao_motivo" id="inibicao_motivo" rows="3"
                        placeholder="Motivo da Inibição..."></textarea>


                    <textarea class="form-control" name="acidente_descricao" id="acidente_descricao" rows="3"
                        placeholder="Descreve o acidente..."></textarea>

                    <button class="mt-5" type="submit"> {{ __('Cadastrar') }}</button>
                    <a class="btn btn-link" href="{{ route('login', 'recrutador') }}">
                        {{ __('Sou empregador') }}
                    </a>
                </form>
            @else
                <form method="POST" action="{{ route('newempregador') }}">
                    @csrf
                    <h1>Criar conta Empregador!</h1><br>

                    <input type="hidden" name="privilegio" value="empregador" />
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Empresa">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <select class="form-control" id="sector_actividade" name="sector_actividade">
                        <option selected value="null">Sector de actividade</option>
                        <option value="transporte">Transporte e Logística</option>
                        <option value="comercio">Comercio </option>
                        <option value="industria">Industria </option>
                        <option value="turismo">Turismo </option>
                        <option value="agricultura">Agricultura </option>
                        <option value="mineração">Mineração </option>
                        <option value="ONG">ONG</option>
                        <option value="instituição publica">Instituição pública</option>
                        <option value="Outro">Outro...</option>
                    </select>


                    <input class="form-control" name="sector_especificado" id="sector_especificado"
                        placeholder="Especifique o seu sector de actividade...">

                    <input id="nuit" type="number" class="form-control @error('nuit') is-invalid @enderror"
                        name="nuit" value="{{ old('nuit') }}" required autocomplete="nuit" placeholder="nuit">
                    @error('nuit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="newemail" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="newemail" value="{{ old('newemail') }}" required autocomplete="email"
                        placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="representante" type="text"
                        class="form-control @error('representante') is-invalid @enderror" name="representante"
                        value="{{ old('representante') }}" required autocomplete="representante" autofocus
                        placeholder="Representante">
                    @error('representante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="telefone" type="number" class="form-control @error('telefone') is-invalid @enderror"
                        name="telefone" value="{{ old('celular') }}" required autocomplete="celular"
                        placeholder="Telefone">
                    @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="telefone_alt" type="number"
                        class="form-control @error('telefone_alt') is-invalid @enderror" name="telefone_alt"
                        value="{{ old('telefone_alt') }}" autocomplete="telefone_alt"
                        placeholder="Telefone altermativo">
                    @error('telefone_alt')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                        name="website" value="{{ old('website') }}" autocomplete="website" placeholder="Website">
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="endereco" type="text"
                        class="form-control @error('Endereco') is-invalid @enderror" name="endereco"
                        value="{{ old('endereco') }}" required autocomplete="Endereco" placeholder="Endereço">
                    @error('Endereco')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <select class="form-control" name="provincia_id" id="provincia">
                        @php
                            $provincias = App\Models\Provincias::all();
                        @endphp
                        <option selected value="1">Seleccione a Provincia</option>
                        @foreach ($provincias as $key => $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                    <textarea class="form-control" name="sobre" id="sobre" rows="3"
                        class="form-control @error('sobre') is-invalid @enderror" name="sobre" value="{{ old('sobre') }}"
                        autocomplete="sobre"placeholder="Sobre a empresa..."></textarea>
                    @error('sobre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="newpassword" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password" placeholder="Senha">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm Password">
                    <br><button type="submit"> {{ __('Cadastrar') }}</button>
                </form>


            @endif

        </div>


        <div class="form-container sign-in-container">
            @if (isset($_GET['candidato']))
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 style="">Candidato</h1>
                    <span>use as suas credenciais para entrar</span>
                    <input type="hidden" name="email" id="email_login" />
                    <input id="celular_login" type="number" min="9" maxlength="13"
                        class="form-control @error('number') is-invalid @enderror" name="number"
                        placeholder="Celular" required autocomplete="number" autofocus>
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @if (Route::has('password.request'))
                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}"> -->
                        <a class="btn btn-link">
                            {{ __('Esqueceu-se da senha?') }}
                        </a>
                    @endif
                    <button class="" type="submit">Entrar</button>
                    <a class="btn btn-link" href="{{ route('login', 'recrutador') }}">
                        {{ __('Sou empregador') }}
                    </a>
                    <a class="btn btn-link btn-create" id="btn-create">
                        {{ __('Criar conta') }}
                    </a>
                </form>
            @else
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 style="">Empregador</h1>
                    <span>use sua a conta para entrar</span><br>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">

                            {{ __('Esqueceu-se da senha?') }}
                        </a>
                    @endif
                    <button type="submit">Entrar</button><br>
                    <a class="btn btn-link" href="{{ route('login', 'candidato') }}">
                        {{ __('Sou candidato') }}
                    </a>

                    <a class="btn btn-link btn-create" id="btn-create">
                        {{ __('Criar conta') }}
                    </a>
                </form>
            @endif
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>É um prazer te ver de volta!</h1>
                    <p>Para se connectar ao portal e ver as vagas disponiveis use os suas credenciais</p>
                    <button class="ghost" id="signIn">Entrar</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Seja Bem-vindo, Candidato/Empregador!</h1>
                    <br>
                    <h3>Ao candidato
                    </h3>
                    <b>
                        <p>• Crie uma conta e tenha acesso as melhores vagas de emprego de motoristas disponíveis no
                            mercado
                        </p>
                        <p>• Envie uma candidatura espontânea para empresa do seu interesse. </p>
                      
                    </b>
                    <br>
                    <h3>Ao Empregador
                    </h3><b>
                        <p>• Crie uma conta da sua empresa, publique vagas e recebes as candidaturas e faz avaliação dos
                            candidatos gratuitamente dentro do portal, cadastre e consulte os motoristas na central
                            de risco.
                        </p>
                       
                    </b>

                    <button class="ghost" id="signUp">Criar conta</button>
                </div>
            </div>
        </div>
    </div>

    <!--  -->



    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $('#celular').on('input', function() {
            var email = $('#celular').val();
            $('#email_number').val(email + "@motoristas.co.mz");
        });

        $('#celular_login').on('input', function() {
            var email = $('#celular_login').val();
            $('#email_login').val(email + "@motoristas.co.mz");
        });

        $('#sector_especificado').hide();

        $('#sector_actividade').on('change', function() {
            if (this.value === 'Outro')
                $('#sector_especificado').show().val();
            else
                $('#sector_especificado').hide();
        });

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

        $('#inibicao_motivo').hide();
        $('#inlineCheckboxInibicao1').change(function() {
            if (this.checked) {
                $('#inibicao_motivo').show();
            }
        });

        $('#inlineCheckboxInibicao2').change(function() {
            if (this.checked) {
                $('#inibicao_motivo').hide();
            }
        });

        $('#acidente_descricao').hide();
        $('#inlineCheckboxenvolvimentoAcidente1').change(function() {
            if (this.checked) {
                $('#acidente_descricao').show();
            }
        });

        $('#inlineCheckboxenvolvimentoAcidente2').change(function() {
            if (this.checked) {
                $('#acidente_descricao').hide();
            }
        });
    </script>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        const createButton = document.getElementById('btn-create');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        createButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>

</html>
