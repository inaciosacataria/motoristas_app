<?php

namespace App\Http\Controllers;
use App\Models\CentralDeRisco;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;


class CentralDeRiscoController extends Controller
{

  public function index(){
      $denuncias = DB::table('central_de_riscos')
              ->orderBy('created_at', 'DESC')
              ->get();

           return view('admin.central_risco-modern',compact('denuncias'));
    }


    public function search(Request $request){

        if($request->keyword!=""){
          $denuncias = DB::table('central_de_riscos')
                  ->where('central_de_riscos.nome_motorista', $request->keyword)
                  ->orWhere('central_de_riscos.nome_motorista', 'like', '%' .$request->keyword . '%')
                  ->orderBy('created_at', 'DESC')
                  ->get();
     }elseif($request->numero_carta_conducao!=""){
          $denuncias = DB::table('central_de_riscos')
                  ->where('central_de_riscos.cartadeconducao_motorista', $request->numero_carta_conducao)
                  ->orWhere('central_de_riscos.cartadeconducao_motorista', 'like', '%' .$request->numero_carta_conducao . '%')
                  ->orderBy('created_at', 'DESC')
                  ->get();
       }else{
         $denuncias = DB::table('central_de_riscos')
                 ->orderBy('created_at', 'DESC')
                 ->get();
     }

        return view('admin.central_risco-modern',compact('denuncias'));
      }


  public function create(Request $request){


          $centralRisco = new CentralDeRisco;
          $centralRisco->empregador_id = Auth::user()->id;

          $centralRisco->nome_motorista = $request->nome_motorista;
          $centralRisco->datanascismento_motorista = $request->datanascismento_motorista;
          $centralRisco->celular_motorista = $request->celular_motorista;
          $centralRisco->endereco_motorista = $request->endereco_motorista;
          $centralRisco->provincia_motorista = $request->provincia_motorista;
          $centralRisco->Categoria_motorista = $request->Categoria_motorista;
          $centralRisco->cartadeconducao_motorista = $request->cartadeconducao_motorista;
          $centralRisco->nacionalidade_motorista = $request->nacionalidade_motorista;

          $centralRisco->funcoes_do_candidato=$request->funcoes_do_candidato;
          $centralRisco->infracao=$request->infracao;
          $centralRisco->merece_portunidade = $request->merece_portunidade;
          $centralRisco->versao_motorista = $request->versao_motorista;
          $centralRisco->estado_denuncia = 'Não confirmada';

        if($centralRisco->save()){

         return redirect()->back()->with('success', 'Motorista denunciado, os Admininstradores cuidaram do resto!');
       }else{
        return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
        }

    }

    public function denuncia($id){

      $denuncia = DB::table('central_de_riscos')
              ->where('central_de_riscos.id', $id)
              ->first();

      $denunciante = DB::table('empregadors')
              ->join('users', 'empregadors.user_id', '=', 'users.id')
              ->join('central_de_riscos', 'empregadors.user_id', '=', 'central_de_riscos.empregador_id')
              ->select('empregadors.*','users.foto_url as foto_url' ,'users.name as empresa', 'users.email as email_empregador',
              'users.celular as celular_empregador')
              ->first();

         return view('admin.denuncia',compact('denuncia', 'denunciante'));
   }


  //   public function verCentralDeRisco(){
  //
  //
  //           $centralRisco = DB::table('central_de_riscos')
  //                         ->join('recrutadores', 'central_de_riscos.empregador_id','=','recrutadores.id')
  //                         ->join('candidatos', 'central_de_riscos.candidato_id','=','candidatos.id')
  //                         ->join('users', 'candidatos.user_id','=','users.id')
  //                         ->select('central_de_riscos.*','users.id as user_id', 'users.name as name','users.celular as celular')->get();
  //
  //
  //
  //         return view('centralRisco',compact('centralRisco'));
  //   }
  //
  //
  //   public function deletarCentralDeRisdco($id){
  //
  //       $centralRisco = CentralDeRisco::find($id);
  //       if($centralRisco->delete()){
  //          return redirect()->back()->with('success', 'Motorista removido da central de Risco!');
  //       }else {
  //           return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
  //       }
  //
  //   }
  //
  //
    public function updateCentralDeRisco(Request $request){

          $centralRisco = CentralDeRisco::find($request->id);
          $centralRisco->merece_portunidade=$request->merece_portunidade;
          $centralRisco->versao_motorista=$request->versao_motorista;
          $centralRisco->estado_denuncia=$request->estado_denuncia;


        if($centralRisco->update()){

         return redirect()->back()->with('success', 'Denuncia actualizada!');
       }else{
         
        return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');

        }
    }
}
