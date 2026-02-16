<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserNotification;
use App\Mail\SeguroMailNotification;
use App\Mail\FormacaoMailNotification;
use Illuminate\Support\Facades\Mail;

class CursosController extends Controller
{
    function getCursos(){
      return view('cursos.cursos-modern');
    }

    function getCursoInfo(){
      return view('cursos.cursoinfo');
    }


    function inscricaoForm(){
       return view('cursos.inscricao-modern');
    }

    function submeterInscricao(Request $request){
      $plano = $request->plano;
      $nome = $request->nome;
      $contacto = $request->contacto;
      $email = $request->email;
      $curso= $request->curso;
      $numerodemotoristas = $request->numerodemotoristas;
      $observacoes = $request->observacoes;
      $footer = '© Copyright 2023 - motoristas.co.mz';


      Mail::to('domingosmachavaa@gmail.com')->send(new FormacaoMailNotification($plano, $nome,$contacto,$email,$curso, $numerodemotoristas,$observacoes,$footer));
      return redirect()->back()->with('success', 'A sua solicitação foi enviada, com sucesso!');

    }



    function getSegurosInfo(){
      return view('cursos.seguro-modern');
    }

    function getSeguroForm(){
      return view('cursos.inscricaoSeguro-modern');
    }

    function submeterInscricaoSeguro(Request $request ){

      $plano = $request->plano;
      $nome = $request->nome;
      $contacto = $request->contacto;
      $email = $request->email;
      $seguro= $request->seguro;
      $numerodemotoristas = $request->numerodemotoristas;
      $observacoes = $request->observacoes;
      $footer = '© Copyright 2023 - motoristas.co.mz';


      Mail::to('domingosmachavaa@gmail.com')->send(new SeguroMailNotification($plano, $nome,$contacto,$email,$seguro, $numerodemotoristas,$observacoes,$footer));
      return redirect()->back()->with('success', 'A sua solicitação foi enviada, com sucesso!');
    }


}
