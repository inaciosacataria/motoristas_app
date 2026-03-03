<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Anuncios;
use App\Models\Candidatos;
use Auth;
use App\Mail\AcountActivate;
use App\Mail\UserNotification;
use App\Mail\UserNotificationAccountActivated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
  {
    $motoristas = DB::table('candidatos')
                 ->join('users', 'candidatos.user_id', '=', 'users.id')
                  ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                  ->join('provincias',  'candidatos.provincia_id', '=', 'provincias.id')
                 ->select('candidatos.*','users.id as user_id', 'users.name as name','users.celular as celular',
                 'categorias.categoria as categoria','provincias.name as provincia')
                 ->orderBy('id', 'DESC')
                 ->paginate(5);


    $empregadores = DB::table('empregadors')
                ->join('users', 'empregadors.user_id','=','users.id')
                ->select('empregadors.*','users.name as name' ,'users.active as active' ,'users.is_premium as accounttype', 'users.premium_count as premium_count','users.email as email','users.celular as celular')
                ->orderBy('id', 'DESC')
                ->paginate(5);




    $last30motoristas = DB::table("users")
                ->select('id')
                ->where('privilegio', 'candidato')
                ->where('created_at', '>', now()->subDays(30)->endOfDay())
                ->count();

    $last30empregador = DB::table("empregadors")
                      ->select('id')
                      ->where('created_at', '>', now()->subDays(30)->endOfDay())
                      ->count();

    $anunciosDentroDoPrazo = DB::table("anuncios")
                      ->select('id')
                      ->where('validade', '>', now())
                      ->count();

    $countMotoritas = DB::table('users')->where('privilegio', 'candidato')->count();
    $countEmpregador = DB::table('empregadors')->count();
    $countAnuncios = DB::table('anuncios')->count();


   return view('admin.dashboard-modern',compact('motoristas','empregadores',
   'last30motoristas','last30empregador','anunciosDentroDoPrazo',
   'countMotoritas', 'countAnuncios', 'countEmpregador'));

  }

  public function motoristas()
  {
    $motoristas = DB::table('candidatos')
                 ->join('users', 'candidatos.user_id', '=', 'users.id')
                 ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                 ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
                 ->select('candidatos.*', 'users.name as name','users.foto_url as foto_url','users.celular as celular','categorias.categoria as categoria',
                 'provincias.name as provincia')
                 ->get();


   return view('admin.bd_motoristas', compact('motoristas'));
 }

  /**
   * Descarregar lista de motoristas em CSV
   */
  public function downloadMotoristasCsv()
  {
    $motoristas = DB::table('candidatos')
                 ->join('users', 'candidatos.user_id', '=', 'users.id')
                 ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                 ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
                 ->select('candidatos.*', 'users.name as name', 'users.email as email', 'users.celular as celular',
                 'categorias.categoria as categoria', 'provincias.name as provincia')
                 ->orderBy('users.name', 'ASC')
                 ->get();

    $filename = 'lista-motoristas-' . date('Y-m-d-His') . '.csv';
    $headers = [
      'Content-Type' => 'text/csv; charset=UTF-8',
      'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    $callback = function () use ($motoristas) {
      $file = fopen('php://output', 'w');
      fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
      fputcsv($file, ['Nome', 'Email', 'Contacto', 'Categoria / Habilitação', 'Grau Académico', 'Província', 'Nacionalidade', 'Data Nascimento'], ';');
      foreach ($motoristas as $m) {
        fputcsv($file, [
          $m->name ?? '',
          $m->email ?? '',
          $m->celular ?? '',
          $m->categoria ?? '',
          $m->grau_academico ?? 'N/A',
          $m->provincia ?? '',
          $m->nacionalidade ?? 'N/A',
          isset($m->datanascimento) ? \Carbon\Carbon::parse($m->datanascimento)->format('d/m/Y') : 'N/A',
        ], ';');
      }
      fclose($file);
    };

    return response()->stream($callback, 200, $headers);
  }

  /**
   * Página só com a lista de motoristas para imprimir ou guardar como PDF
   */
  public function listaMotoristasImpressao()
  {
    $motoristas = DB::table('candidatos')
                 ->join('users', 'candidatos.user_id', '=', 'users.id')
                 ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
                 ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
                 ->select('candidatos.*', 'users.name as name', 'users.email as email', 'users.celular as celular',
                 'categorias.categoria as categoria', 'provincias.name as provincia')
                 ->orderBy('users.name', 'ASC')
                 ->get();

    return view('admin.lista-motoristas-impressao', compact('motoristas'));
  }

 public function anuncios(){
     $anuncios = DB::table('anuncios')
                ->join('empregadors', 'empregadors.user_id','=','anuncios.user_id')
                ->join('users', 'anuncios.user_id','=','users.id')
                ->select('anuncios.*', 'users.name as empresa', 'users.celular as celular')
                ->orderBy('anuncios.validade', 'DESC')
                ->get();

      $candidaturas = DB::table('candidaturas_anuncios')
                      ->get();

      return view ('admin.bd_vagas', compact('anuncios','candidaturas'));
 }

 public function empregadores()
 {
   $empregadores = DB::table('empregadors')
               ->join('users', 'empregadors.user_id','=','users.id')
               ->select('empregadors.*','users.id as user_id','users.name as name','users.active as active','users.foto_url as foto_url','users.email as email','users.celular as celular','users.is_premium as accounttype','users.premium_count as premium_count')
               ->orderBy('id', 'DESC')
               ->paginate(25);


  return view('admin.bd_empregadores-modern', compact('empregadores'));
 }


 public function activeEmpregador($id){
   $user = User::find($id);
   $user->active="activo";
   if($user->update()){
      $link = "https://motoristas.co.mz";
      Mail::to($user->email)->send(new  UserNotificationAccountActivated($user->name, $link));
      return redirect()->back()->with('success', 'Conta Activada');
   }else{
      return redirect()->back()->with('error', 'Ocorreu um erro');
   }
 }


 public function desativeEmpregador($id){
   $user = User::find($id);
   $user->active="desativado";
   if($user->update()){
      return redirect()->back()->with('success', 'Conta Desativada');
   }else{
      return redirect()->back()->with('error', 'Ocorreu um erro');
   }
 }

 public function aprovarEmpregador($id){
   $user = User::find($id);
   $empregador = \App\Models\Empregador::where('user_id', $id)->first();
   
   if($empregador && $empregador->documento_nuit && $empregador->documento_certidao && $empregador->documento_inicio_actividade) {
       $user->active = "activo";
       $empregador->estado = "Aprovado";
       
       if($user->update() && $empregador->update()){
           $link = "https://motoristas.co.mz";
           Mail::to($user->email)->send(new UserNotificationAccountActivated($user->name, $link));
           return redirect()->back()->with('success', 'Empresa aprovada com sucesso!');
       }else{
           return redirect()->back()->with('error', 'Ocorreu um erro');
       }
   } else {
       return redirect()->back()->with('error', 'Empresa não possui todos os documentos necessários');
   }
 }

 public function rejeitarEmpregador($id){
   $user = User::find($id);
   $empregador = \App\Models\Empregador::where('user_id', $id)->first();
   
   if($empregador) {
       $user->active = "desativado";
       $empregador->estado = "Rejeitado";
       
       if($user->update() && $empregador->update()){
           return redirect()->back()->with('success', 'Empresa rejeitada');
       }else{
           return redirect()->back()->with('error', 'Ocorreu um erro');
       }
   } else {
       return redirect()->back()->with('error', 'Empresa não encontrada');
   }
 }


 public function sendAdminNotification($id){

   $user = User::find($id);
   $link = "https://motoristas.co.mz/empregador-perfil/".$user->id;
   Mail::to('info@motoristas.co.mz')->send(new AcountActivate($user->name, $link));
   Mail::to($user->email)->send(new UserNotification($user->name));
   return redirect()->route('aguarde');
 }



}
