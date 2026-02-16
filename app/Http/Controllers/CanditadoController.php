<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CanditadoController extends Controller
{


    public function index()
   {

       $candidato = DB::table('candidatos')
               ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
               ->join('users', 'candidatos.user_id', '=', 'users.id')
               ->where('user_id', Auth::user()->id)
               ->select('candidatos.*', 'users.name as nome','users.foto_url as foto_url', 'users.email as email', 'users.privilegio as privilegio', 'provincias.provincia as provincia')
               ->first();

       $formacoes = DB::table('formacoes')
               ->where('candidato_id', $candidato->id)
               ->get();


       $idiomas = DB::table('idiomas')
               ->where('candidato_id', $candidato->id)
               ->get();

       $documentos = DB::table('documentos')
               ->where('candidato_id', $candidato->id)
               ->get();

       $conhecimentos = DB::table('conhecimentos')
               ->where('candidato_id', $candidato->id)
               ->get();

       $experiencias = DB::table('experiencias')
               ->where('candidato_id', $candidato->id)
               ->get();

       $provas = DB::table('inscricao')
                 ->join('exames', 'inscricao.exame_id', '=', 'exames.id')
                 ->where('candidato_id', $candidato->id)
                 ->where('inscricao.estado', 'Não Resolvido')
                 ->select('inscricao.*', 'exames.nome as nome', 'exames.duracao as duracao')
                 ->get();

       $candidatura_anuncio = DB::table('candidatura_anuncio')
                ->join('anuncios', 'candidatura_anuncio.anuncio_id', '=', 'anuncios.id')
                ->where('candidato_id', $candidato->id)
                ->select('anuncios.*')
                ->get();

               if(sizeof($formacoes) < 1) {  $progressFormacao = 0; }else{  $progressFormacao = 15; }
               if(sizeof($experiencias) < 1) { $progressExperiencia = 0; } else { $progressExperiencia = 15; }
               if(sizeof($conhecimentos) < 1) { $progressConhecimento = 0; } else { $progressConhecimento = 15; }
               if(sizeof($idiomas) < 1) { $progressIdioma = 0; } else { $progressIdioma = 15; }
               if(sizeof($documentos) < 1) { $progressDocumento = 0; } else { $progressDocumento = 15; }

       $progress = 25 + $progressFormacao + $progressExperiencia + $progressConhecimento + $progressIdioma + $progressDocumento;

       return view('candidato.perfil', array('candidato' => $candidato, 'formacoes' => $formacoes, 'idiomas' => $idiomas,
     'documentos' => $documentos, 'conhecimentos' => $conhecimentos, 'experiencias' => $experiencias, 'progress' => $progress,
     'provas' => $provas, 'candidaturas' => $candidatura_anuncio ));
     }


   public function cv()
   {

     $candidato = DB::table('candidatos')
             ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
             ->join('users', 'candidatos.user_id', '=', 'users.id')
             ->where('user_id', Auth::user()->id)
             ->select('candidatos.*', 'users.name as nome','users.foto_url as foto_url', 'users.email as email', 'users.privilegio as privilegio', 'provincias.provincia as provincia')
             ->first();

     $formacoes = DB::table('formacoes')
             ->where('candidato_id', $candidato->id)
             ->get();


     $idiomas = DB::table('idiomas')
             ->where('candidato_id', $candidato->id)
             ->get();

     $documentos = DB::table('documentos')
             ->where('candidato_id', $candidato->id)
             ->get();

     $conhecimentos = DB::table('conhecimentos')
             ->where('candidato_id', $candidato->id)
             ->get();

     $experiencias = DB::table('experiencias')
             ->where('candidato_id', $candidato->id)
             ->get();

             if(sizeof($formacoes) < 1) {  $progressFormacao = 0; }else{  $progressFormacao = 15; }
             if(sizeof($experiencias) < 1) { $progressExperiencia = 0; } else { $progressExperiencia = 15; }
             if(sizeof($conhecimentos) < 1) { $progressConhecimento = 0; } else { $progressConhecimento = 15; }
             if(sizeof($idiomas) < 1) { $progressIdioma = 0; } else { $progressIdioma = 15; }
             if(sizeof($documentos) < 1) { $progressDocumento = 0; } else { $progressDocumento = 15; }

     $progress = 25 + $progressFormacao + $progressExperiencia + $progressConhecimento + $progressIdioma + $progressDocumento;

     return view('backend.meu-cv', array('candidato' => $candidato, 'formacoes' => $formacoes, 'idiomas' => $idiomas,
   'documentos' => $documentos, 'conhecimentos' => $conhecimentos, 'experiencias' => $experiencias, 'progress' => $progress ));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function criarUser(Request $request)
   {

     $user = new User;
     $user->name = $request->nome;
     $user->email = $request->email;
     $user->privilegio = $request->privilegio;
       $user->premium_count=0;
     $user->password = Hash::make($request->password);

     
     if ($user->save()) {

         $candidato = new Candidato;
         $candidato->user_id = $user->id;
         $candidato->datanascimento = $request->datanascimento;
         $candidato->telefone = $request->telefone;
         $candidato->telefone_alt = $request->telefone_alt;
         $candidato->endereco = $request->endereco;
         $candidato->provincia_id = $request->provincia_id;
         $candidato->sexo = $request->sexo;
         $candidato->perfil = $request->perfil;
         $candidato->ano_experiencia = $request->ano_experiencia;
         $candidato->nacionalidade = $request->nacionalidade;
         $candidato->resumo = $request->resumo;

           if ($candidato->save()) {
               return redirect('/login')->with('success', 'candidato registrado com sucesso!');
           } else {
               return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
           }

       } else {
           return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
       }

 
}
}


 public function deleteCandidato($id){
    $user = User::find($id);
    if($user->delete()){
         return redirect()->back()->with('success', 'candidato removido do sistema com sucesso!');
    }else{
        return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
    }
 }




    // @param  int  $id
    // @return \Illuminate\Http\Response
    public function editContacto(Request $request)
    {
      $contacto = Candidato::find($request->candidato_id);
      $contacto->telefone = $request->telefone;
      $contacto->telefone_alt = $request->telefone_alt;

        if($contacto->update()) {
          return redirect()->back()->with(array('success' => 'Contactos actualizados com sucesso!'));
        } else {
          return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
      }
    }

    public function editPerfil(Request $request)
    {

      $perfil = Candidato::find($request->candidato_id);
      $user = User::find($perfil->user_id);
      $user->name = $request->nome;

      if($user->update()) {
        $perfil->perfil = $request->perfil;
        $perfil->ano_experiencia = $request->ano_experiencia;
        $perfil->grau_academico = $request->grau_academico;
        $perfil->resumo = $request->resumo;

          if($perfil->update()) {
            return redirect()->back()->with(array('success' => 'Perfil actualizado com sucesso!'));
          } else {
            return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
        }

      }

    }

    public function editPessoais(Request $request)
    {
      $perfil = Candidato::find($request->candidato_id);

      $perfil->datanascimento = $request->datanascimento;
      $perfil->sexo = $request->sexo;
      $perfil->nacionalidade = $request->nacionalidade;
      $perfil->endereco = $request->endereco;

        if($perfil->update()) {
          return redirect()->back()->with(array('success' => 'Dados pessoais actualizados com sucesso!'));
        } else {
          return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
      }

  }
}
