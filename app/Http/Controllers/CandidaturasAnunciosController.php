<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidaturas_anuncios;
use App\Models\Anuncios;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use App\Mail\AcountActivate;
use App\Mail\CandidaturaEspontanea;
use Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

class CandidaturasAnunciosController extends Controller
{

  public function create(Request $request)
  {
    $userId = Auth::id();
    $anuncioId = (int) $request->anuncio_id;

    // Evitar candidatura duplicada (mesmo utilizador + mesma vaga)
    $jaExiste = DB::table('candidaturas_anuncios')
        ->where('user_id', $userId)
        ->where('anuncio_id', $anuncioId)
        ->exists();

    if ($jaExiste) {
        return redirect()->back()->with('erro', 'Já se candidatou a esta vaga. Não pode enviar mais de uma candidatura por vaga.');
    }

    $candidatura = new Candidaturas_anuncios;
    $candidatura->user_id = $userId;
    $candidatura->anuncio_id = $anuncioId;

    if ($candidatura->save()) {
        // Notificar o empregador (dono do anúncio) sobre a nova candidatura
        $anuncio = Anuncios::find($anuncioId);
        if ($anuncio) {
            try {
                app(NotificationService::class)->notifyNewCandidatura(
                    $anuncio->user_id,
                    $anuncioId,
                    Auth::user()->name ?? 'Um candidato'
                );
            } catch (\Throwable $e) {
                \Log::warning('Falha ao criar notificação de candidatura: ' . $e->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Candidatura enviada com sucesso!');
    }

    return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
  }


  public function verCandidatosDeUmAnuncio($slug)
  {
    $anuncio = DB::table('anuncios')
                  ->where(function ($q) use ($slug) {
                      $q->where('anuncios.slug', $slug);
                      if (is_numeric($slug)) {
                          $q->orWhere('anuncios.id', (int) $slug);
                      }
                  })
                  ->first();
    if (!$anuncio) {
      abort(404);
    }
    $anuncioId = $anuncio->id;

    $candidaturas = DB::table('candidaturas_anuncios')
                  ->where('candidaturas_anuncios.anuncio_id',$anuncioId)
                  ->join('users','candidaturas_anuncios.user_id','=','users.id')
                  ->join('candidatos','candidatos.user_id','=','users.id')
                  ->join('provincias','provincias.id','=','candidatos.provincia_id')
                  ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                  ->select('candidaturas_anuncios.*','candidatos.nacionalidade as nacionalidade','users.foto_url as foto_url','users.name as name','users.celular as celular','candidatos.datanascimento as datanascimento','candidatos.grau_academico as grau_academico','categorias.categoria as categoria', 'provincias.name as provincia', 'candidatos.cv as cv',)
                  ->orderBy('candidaturas_anuncios.created_at', 'DESC')
                  ->get();

    return view('empregador.candidaturas',compact('candidaturas', 'anuncio'));
  }


public function candidaturaExpontanea($id){
    
      $user = Auth::user();
     $empresa = DB::table('empregadors')
     ->where('empregadors.id',$id)
     ->first();



     $candidato = DB::table('candidatos')
     ->where('candidatos.user_id',$user->id)
     ->first();

     $nome=$user->name;
     $contacto=$user->celular;
     $email=$user->email;
     $cv_link=$candidato->cv;


     Mail::to('info@motoristas.co.mz')->send(new CandidaturaEspontanea( $user->name, $contacto, $email, $cv_link, $empresa->empresa));
           return redirect()->back()->with('success', 'Candidatura enviada com sucesso!');
     
}

public function gerarPdfCandidatos($slug)
{
    $anuncio = DB::table('anuncios')
                  ->where(function ($q) use ($slug) {
                      $q->where('anuncios.slug', $slug);
                      if (is_numeric($slug)) {
                          $q->orWhere('anuncios.id', (int) $slug);
                      }
                  })
                  ->first();
    if (!$anuncio) {
      abort(404);
    }
    $anuncioId = $anuncio->id;

    $candidaturas = DB::table('candidaturas_anuncios')
                  ->where('candidaturas_anuncios.anuncio_id',$anuncioId)
                  ->join('users','candidaturas_anuncios.user_id','=','users.id')
                  ->join('candidatos','candidatos.user_id','=','users.id')
                  ->join('provincias','provincias.id','=','candidatos.provincia_id')
                  ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                  ->select('candidaturas_anuncios.*','candidatos.nacionalidade as nacionalidade','users.foto_url as foto_url','users.name as name','users.celular as celular','candidatos.datanascimento as datanascimento','candidatos.grau_academico as grau_academico','categorias.categoria as categoria', 'provincias.name as provincia', 'candidatos.cv as cv')
                  ->orderBy('candidaturas_anuncios.created_at', 'DESC')
                  ->get();

    // Usar uma biblioteca PDF simples ou criar HTML para impressão
    // Por enquanto, vamos usar uma view HTML que pode ser impressa
    return view('empregador.pdf-candidatos', compact('candidaturas', 'anuncio'));
}

}
