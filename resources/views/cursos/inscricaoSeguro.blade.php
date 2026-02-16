@extends('layouts.appmain')
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Inscrição para formações">
    <meta name="description" content="">
    <title>Inscricao</title>

    <link rel="stylesheet" href="{{ asset('css/inscricao.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/inscricao2.css') }}" media="screen">

    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.21.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">
</head>

<body class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header u-header" id="sec-3ee6">
        <div class="u-clearfix u-sheet u-sheet-1"></div>
    </header>
    <section class="u-align-center u-clearfix u-section-1" id="sec-895f">
        <div class="u-clearfix u-sheet u-sheet-1">
            <h2 class="u-subtitle u-text u-text-default u-text-1">Inscrição para Seguro de Motorista/Condutor</h2>
            <div class="u-form u-form-1">
                <form method="post" action="{{ route('submeter-seguro') }}"
                    class="u-clearfix u-form-spacing-15 u-form-vertical u-inner-form" style="padding: 15px;"
                    source="email" name="form">
                    @csrf
                    <div class="form-group" style="margin-inline-start:8px">
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="plano" id="plano1"
                                    value="Empresa">
                                <label class="form-check-label" for="inlineRadio1">Empresa</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="plano" id="plano2"
                                    value="Individual">
                                <label class="form-check-label" for="inlineRadio2">Individual</label>
                            </div>
                        </div>
                    </div>


                    <div class="u-form-group u-form-name u-label-none">
                        <label for="name-6797" class="u-label">Name</label>
                        <input type="text" placeholder="Nome" id="name-6797" name="nome"
                            class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
                    </div>



                    <div class="u-form-email u-form-group u-label-none">
                        <label for="email-6797" class="u-label">Email</label>
                        <input type="email" placeholder="Email" id="email" name="email"
                            class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                    </div>

                    <div class="u-form-group u-label-none">
                        <label for="text-355e" class="u-label">Contactos</label>
                        <input type="text" placeholder="Contactos" id="text-355e" name="contacto"
                            class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                    </div>

                    <div class="u-form-group u-form-select u-label-none">
                        <label for="select-027c" class="u-label">Seguro</label>
                        <div class="u-form-select-wrapper">
                            <select id="select-027c" name="seguro"
                                class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                                <option value="Seguro de motorista">Pacote Basico</option>
                                <option value="Seguro de motorista">Pacote Classic</option>
                                <option value="Seguro de motorista">Pacote Premium</option>
                            </select>
                            <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"
                                style="fill:currentColor;" xml:space="preserve">
                                <polygon class="st0" points="8,12 2,4 14,4 "></polygon>
                            </svg>
                        </div>
                    </div>

                    <div class="u-form-group u-label-none">
                        <label for="text-6be2" class="u-label">Numero de motoristas</label>
                        <input type="text" placeholder="Numero de  motoristas" id="text-6be2"
                            name="numerodemotoristas" class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                    </div>
                    <div class="u-form-group u-form-message u-label-none">
                        <label for="message-6797" class="u-label">Observações</label>
                        <textarea placeholder="Observacoes" rows="4" cols="50" id="message-6797" name="observacoes"
                            class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required=""></textarea>
                    </div>
                   <div class="u-align-left u-form-group u-form-submit">
                        <button type="submit"
                            class="u-border-none u-btn u-btn-submit u-button-style u-custom-color-1 u-btn-1">Inscrever
                            se<br> </button>
                        <input type="submit" value="submit" class="u-form-control-hidden">
                    </div>
                    <div class="u-form-send-message u-form-send-success">Thank you! Your message has been sent.</div>
                    <div class="u-form-send-error u-form-send-message">Unable to send your message. Please fix errors
                        then try again.</div>
                    <input type="hidden" value="" name="recaptchaResponse">
                    <input type="hidden" name="formServices" value="4ab70c084715913ca531db8083552465">
                </form>
            </div>
        </div>
    </section>
</body>

</html>

