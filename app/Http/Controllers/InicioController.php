<?php

namespace App\Http\Controllers;
use App\Models\Provincias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class InicioController extends Controller
{


    public function index()
    {
      $categorias = DB::table('categorias')->get();
      $provincias = DB::table('provincias')->get();
      $anuncios_provincias = DB::table('anuncios_provincias')->get();
      // Total de empresas (empregadores) registadas
      $totalEmpresas = DB::table('empregadors')->count();

      // Publicidades ativas para a home (por enquanto, os mesmos banners gerais)
      $publicidades = DB::table('smart_ads')
          ->where('enabled', 1)
          ->orderBy('created_at', 'DESC')
          ->limit(2)
          ->get();

      $anuncios = DB::table('anuncios')
              ->leftJoin('empregadors', 'anuncios.user_id', '=', 'empregadors.user_id')
              ->leftJoin('users', 'anuncios.user_id', '=', 'users.id')
              ->select(
                  'anuncios.*', 
                  'users.name as nome',
                  DB::raw('COALESCE(empregadors.empresa, users.name, "Empresa") as empresa'), 
                  DB::raw('COALESCE(empregadors.logotipo, users.foto_url, "none") as foto_url'),
                  'empregadors.logotipo as logotipo'
              )
              ->where('anuncios.estado_anuncio', 'Publicado')
              // Trazer todas as vagas publicadas (ativas e expiradas); o estado visual é tratado na view
              ->orderBy('anuncios.created_at', 'DESC')
              ->paginate(12);

       return view('index-modern',  compact('provincias' ,'categorias', 'anuncios','anuncios_provincias', 'totalEmpresas', 'publicidades'));
    }


    public function search($query,$categor)
    {
      $categorias = DB::table('categorias')->get();
      $provincias = DB::table('provincias')->get();

      $anuncios = DB::table('anuncios')
          //    ->join('recrutadores', 'anuncios.user_id', '=', 'recrutadores.id')
              ->join('users', 'anuncios.user_id', '=', 'users.id')
              ->select('anuncios.*',  'users.name as recrutador', 'users.foto_url as foto_url')
              ->orderBy('created_at', 'DESC')
              ->paginate(10);

      // $arraySearch[];
      //
      // foreach ($anuncios as $value) {
      //     if($value)
      // }



       return view('index',  compact('provincias' ,'categorias', 'anuncios'));
    }




    public function anuncio()
    {
       // $anuncios = DB::table('anuncios')
       //     //    ->join('recrutadores', 'anuncios.user_id', '=', 'recrutadores.id')
       //         ->join('users', 'anuncios.user_id', '=', 'users.id')
       //         ->select('anuncios.*', 'users.name as recrutador')
       //         ->orderBy('created_at', 'DESC')
       //         ->paginate(10);

       return view('anuncio');
    }




}
