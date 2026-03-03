<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincias;
use App\Models\Categorias;
use App\Models\Anuncios;
use App\Models\Candidatos;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
      $candidato = DB::table('users')
              ->where('id', Auth::user()->id)
              ->first();

        // $candidato = DB::table('candidatos')
        //         ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
        //         ->join('users', 'candidatos.user_id', '=', 'users.id')
        //         ->where('user_id', Auth::user()->id)
        //         ->select('candidatos.*', 'users.name as nome', 'users.email as email', 'users.privilegio as privilegio', 'provincias.provincia as provincia')
        //         ->first();
      //
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

      //
        // $candidatura_anuncio = DB::table('candidatura_anuncio')
        //          ->join('anuncios', 'candidatura_anuncio.anuncio_id', '=', 'anuncios.id')
        //          ->where('candidato_id', $candidato->id)
        //          ->select('anuncios.*')
        //          ->get();
      //
                if(sizeof($formacoes) < 1) {  $progressFormacao = 0; }else{  $progressFormacao = 15; }
                if(sizeof($experiencias) < 1) { $progressExperiencia = 0; } else { $progressExperiencia = 15; }
                if(sizeof($conhecimentos) < 1) { $progressConhecimento = 0; } else { $progressConhecimento = 15; }
                if(sizeof($idiomas) < 1) { $progressIdioma = 0; } else { $progressIdioma = 15; }
                if(sizeof($documentos) < 1) { $progressDocumento = 0; } else { $progressDocumento = 15; }

        $progress = 25 + $progressFormacao + $progressExperiencia + $progressConhecimento + $progressIdioma + $progressDocumento;
      //
         $candidaturas = DB::table('users')
                              ->where('users.id',Auth::user()->id)
                              ->join('candidaturas_anuncios','candidaturas_anuncios.user_id','=','users.id')
                              ->join('anuncios','anuncios.id','=','candidaturas_anuncios.anuncio_id')
                              ->select('users.*','anuncios.titulo as titulo', 'anuncios.slug as anuncio_path')
                              ->orderBy('id', 'DESC')
                              ->get();



        return view('candidato.dashboard-modern', array('candidato' => $candidato, 'formacoes' => $formacoes, 'idiomas' => $idiomas,
      'documentos' => $documentos, 'conhecimentos' => $conhecimentos, 'experiencias' => $experiencias, 'progress' => $progress, 'candidaturas' =>$candidaturas));
    //  'candidatura_anuncio' => $candidatura_anuncio));

    //  return view('candidato.candidato', array('candidato' => $candidato));
      }

      public function perfil($id){
        // $motorista = DB::table('candidatos')
        //         ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
        //         ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
        //         ->join('users', 'candidatos.user_id', '=', 'users.id')
        //         ->where('users.id', $id)
        //         ->select('candidatos.*', 'users.name as nome', 'users.email as email', 'users.privilegio as privilegio', 'provincias.name as provincia',
        //         'categorias.categoria as categoria')
        //         ->first();

        // print_r($candidato);
        // die();

        $candidato = DB::table('candidatos')
                ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
                ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                ->join('users', 'candidatos.user_id', '=', 'users.id')
                ->where('candidatos.user_id', $id)
                ->select('candidatos.*', 'candidatos.id as candidato_id', 'users.name as nome', 'users.email as email', 'users.privilegio as privilegio',
                 'provincias.name as provincia','users.foto_url as foto_url', 'users.celular as celular',
                'categorias.categoria as categoria')
                ->first();

        $idiomas = DB::table('idiomas')
                ->where('candidato_id', $candidato->candidato_id)
                ->get();

        $documentos = DB::table('documentos')
                ->where('candidato_id', $candidato->candidato_id)
                ->get();

        $experiencias = DB::table('experiencias')
                ->where('candidato_id', $candidato->candidato_id)
                ->get();


                if(sizeof($experiencias) < 1) { $progressExperiencia = 0; } else { $progressExperiencia = 20; }
                if(sizeof($idiomas) < 1) { $progressIdioma = 0; } else { $progressIdioma = 20; }
                if(sizeof($documentos) < 1) { $progressDocumento = 0; } else { $progressDocumento = 20; }

        $progress = 40 + $progressExperiencia + $progressIdioma + $progressDocumento;

        return view('candidato.perfil-modern', array('candidato' => $candidato, 'idiomas' => $idiomas,
      'documentos' => $documentos, 'experiencias' => $experiencias, 'progress' => $progress ));

      //  return view('candidato.perfil', compact('motorista'));
      }

      public function cv()
      {
        $candidato = DB::table('candidatos')
                ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
                ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                ->join('users', 'candidatos.user_id', '=', 'users.id')
                ->where('candidatos.user_id', Auth::user()->id)
                ->select('candidatos.*', 'users.name as nome', 'users.foto_url as foto_url','users.email as email', 'users.privilegio as privilegio', 'provincias.name as provincia',
                'categorias.categoria as categoria')
                ->first();

        if (!$candidato) {
            $provinciaId = DB::table('provincias')->value('id') ?? 1;
            $categoriaId = DB::table('categorias')->value('id') ?? 1;
            $candidatoId = DB::table('candidatos')->insertGetId([
                'user_id' => Auth::id(),
                'datanascimento' => now()->subYears(30),
                'endereco' => 'A preencher',
                'provincia_id' => $provinciaId,
                'categoria_id' => $categoriaId,
                'sexo' => 'Não especificado',
                'nacionalidade' => 'Moçambicana',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $candidato = DB::table('candidatos')
                ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
                ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                ->join('users', 'candidatos.user_id', '=', 'users.id')
                ->where('candidatos.id', $candidatoId)
                ->select('candidatos.*', 'users.name as nome', 'users.foto_url as foto_url','users.email as email', 'users.privilegio as privilegio', 'provincias.name as provincia',
                'categorias.categoria as categoria')
                ->first();
        }

        $idiomas = DB::table('idiomas')
                ->where('candidato_id', $candidato->id)
                ->get();

        $documentos = DB::table('documentos')
                ->where('candidato_id', $candidato->id)
                ->get();

        $experiencias = DB::table('experiencias')
                ->where('candidato_id', $candidato->id)
                ->get();


                if(sizeof($experiencias) < 1) { $progressExperiencia = 0; } else { $progressExperiencia = 20; }
                if(sizeof($idiomas) < 1) { $progressIdioma = 0; } else { $progressIdioma = 20; }
                if(sizeof($documentos) < 1) { $progressDocumento = 0; } else { $progressDocumento = 20; }

        $progress = 40 + $progressExperiencia + $progressIdioma + $progressDocumento;

        return view('candidato.meu-cv-modern', array('candidato' => $candidato, 'idiomas' => $idiomas,
      'documentos' => $documentos, 'experiencias' => $experiencias, 'progress' => $progress ));
      }


      public function novo(Request $request) // criar novo candidato
      {
        $password;
        if($request->password == $request->password_confirmation){
          $password = $request->password;
        } else {
          return redirect()->back()->with('erro', 'Ocorreu erro, password diferente!');
        }
      
        $email = $request->celular . "@motoristas.co.mz";  

        $user = new User;
        $user->name = $request->name;
        $user->email = $email;
        $user->active= "Activo";
        $user->celular = $request->celular;
        $user->privilegio = $request->privilegio;
        $user->is_premium = "no";
        $user->password = Hash::make($password);



        if(User::where('celular', '=', $user->celular)->count() <= 0){
        if ($user->save()) {
          if (Auth::attempt(['email' => $email, 'password' => $password])) {
              $candidato = new Candidatos;
              $candidato->user_id = Auth::user()->id;
              $candidato->datanascimento = $request->data_nascimento;
              $candidato->telefone_alt = $request->telefone_alt;
              $candidato->endereco = $request->endereco;
              $candidato->provincia_id = $request->provincia_id;
              $candidato->sexo = $request->sexo;
              $candidato->categoria_id = $request->categoria_id;
              $candidato->numero_carta_conducao = $request->numero_carta_conducao;
              $candidato->validade_conducao = $request->validade_conducao; // sim, nao
              $candidato->inibicao_anterior = $request->inibicao_anterior; // sim, nao
              $candidato->inibicao_motivo = $request->inibicao_motivo; // motivo de inibicao
              $candidato->envolvimento_acidente = $request->envolvimento_acidente; // Já se envolveu em acidente de
              $candidato->acidente_descricao = $request->acidente_descricao; // descricao do acidente
              $candidato->grau_academico = $request->grau_academico;
              $candidato->nacionalidade = $request->nacionalidade;

                if ($candidato->save()) {
                    return redirect('/candidato')->with('success', 'Conta criada com sucesso!');
                } else {
                    return redirect()->back()->with('error', 'Ocorreu erro, tenta novamente!');
                }

              } else {
                  return redirect()->back()->with('error', 'Ocorreu erro, tenta novamente!');
              }

          } else {
              return redirect()->back()->with(array('loginErro' => 'Essas credenciais não correspondem aos nossos registros.!', 'loginFormModal' => 'ok'));
          }

          }else{
     return redirect()->route("error2");
  }
}

public function error2(){
    return view('empregador.celularexiste');
  }

    public function candidaturaEspontanea(){
      $empregadores = DB::table('empregadors')
                  ->join('users', 'empregadors.user_id','=','users.id')
                  ->join('provincias', 'empregadors.provincia_id','=','provincias.id')
                  ->select('empregadors.*','users.name as name','users.foto_url as foto_url','provincias.name as provincia', 'users.email as email','users.celular as celular')
                  ->where('users.active', 'activo')
                  ->orderBy('empregadors.id', 'DESC')
                  ->paginate(12);


     return view('candidato.candidatura-espontanea-modern',compact('empregadores'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
