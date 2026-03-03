<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincias;
use App\Models\Categorias;
use App\Models\Anuncios;
use App\Models\fotoUrl;
use App\Models\User;
use App\Models\Empregador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmpregadorCadastroEmail;

class EmpregadorController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {

    $user = Auth::user();

    if($user->privilegio=='empregador'){
       // Verificar se a conta está ativa
       if($user->active == 'desativado') {
           return redirect()->route('aguarde');
       }
       
       $categorias = Categorias::all();
       $provincias = Provincias::all();
       
       // Buscar vagas do empregador - usar LEFT JOIN para não perder resultados
       $anuncios = DB::table('anuncios')
               ->leftJoin('users', 'anuncios.user_id', '=', 'users.id')
               ->leftJoin('empregadors', 'anuncios.user_id', '=', 'empregadors.user_id')
               ->select('anuncios.*', 'users.name as recrutador', DB::raw('COALESCE(empregadors.logotipo, users.foto_url, "none") as foto'), 'empregadors.logotipo as logotipo')
               ->where('anuncios.user_id', $user->id)
               ->orderBy('anuncios.id', 'DESC')
               ->paginate(10);

       // Contar total de candidaturas de todas as vagas do empregador
       $totalCandidaturas = DB::table('candidaturas_anuncios')
           ->join('anuncios', 'candidaturas_anuncios.anuncio_id', '=', 'anuncios.id')
           ->where('anuncios.user_id', $user->id)
           ->count();

       // Contar vagas ativas e expirando para estatísticas
       $vagasAtivas = DB::table('anuncios')
           ->where('user_id', $user->id)
           ->where('estado_anuncio', 'Publicado')
           ->count();
           
       $vagasExpirando = DB::table('anuncios')
           ->where('user_id', $user->id)
           ->where('validade', '<', now()->addDays(7))
           ->where('validade', '>=', now())
           ->count();

       // Buscar publicidades ativas para a página do empregador
       // Buscar banners que estão habilitados e podem ser exibidos na página do empregador
       // Limitado a 2 banners (superior e inferior)
       $publicidades = DB::table('smart_ads')
           ->where('enabled', 1)
           ->orderBy('created_at', 'DESC')
           ->limit(2)
           ->get();

       // Estado de aprovação do empregador (só pode publicar vagas se estado === 'Aprovado')
       $empregador = DB::table('empregadors')->where('user_id', $user->id)->first();
       $empregadorAprovado = $empregador && $empregador->estado === 'Aprovado';
       $estadoEmpregador = $empregador ? ($empregador->estado ?? 'Pendente') : 'Pendente';

       // Para disposição das vagas igual à home/perfil (localização por anúncio)
       $anuncios_provincias = DB::table('anuncios_provincias')->get();

       return view('empregador.dashboard-modern', array( 
           'anuncios' => $anuncios, 
           'categorias' => $categorias, 
           'provincias' => $provincias,
           'anuncios_provincias' => $anuncios_provincias,
           'totalCandidaturas' => $totalCandidaturas,
           'vagasAtivas' => $vagasAtivas,
           'vagasExpirando' => $vagasExpirando,
           'publicidades' => $publicidades,
           'empregadorAprovado' => $empregadorAprovado,
           'estadoEmpregador' => $estadoEmpregador
       ));
    }
  }

  public function getEmpregador($id)
  {
    // Permitir acesso para qualquer usuário autenticado ou não autenticado (página pública)
    // Não aplicar restrições de middleware aqui - esta é uma página pública
    
    try {
        $categorias = DB::table('categorias')->get();
        $provincias = DB::table('provincias')->get();
        $anuncios_provincias = DB::table('anuncios_provincias')->get();

        // Verificar se o usuário existe
        $user = DB::table('users')->where('id', $id)->first();
        
        if (!$user) {
            return redirect('/')->with('erro', 'Usuário não encontrado!');
        }
        
        // Verificar se o usuário é realmente um empregador
        if ($user->privilegio !== 'empregador') {
            \Log::warning('Tentativa de acessar perfil de empregador com usuário não-empregador', [
                'user_id' => $id,
                'privilegio' => $user->privilegio
            ]);
            // Não bloquear, apenas logar
        }

        // Buscar empregador - usar first() ao invés de paginate() já que é um único registro
        $empregador = DB::table('empregadors')
                ->join('users', 'empregadors.user_id', '=', 'users.id')
                ->where('empregadors.user_id', $id)
                ->select('empregadors.*', 'users.name as nome', 'users.foto_url as foto','users.celular as celular','users.active as active','users.email as email')
                ->first();
        
        // Se não encontrar empregador, criar um objeto básico com dados do usuário
        if (!$empregador) {
            $empregador = (object) [
                'user_id' => $user->id,
                'empresa' => $user->name,
                'nome' => $user->name,
                'foto' => ($user->foto_url && $user->foto_url != 'none') ? $user->foto_url : null,
                'logotipo' => null,
                'celular' => $user->celular,
                'active' => $user->active,
                'email' => $user->email,
                'sector_actividade' => 'Não especificado',
                'endereco' => null,
                'website' => null,
                'sobre' => null,
                'documento_nuit' => null,
                'documento_certidao' => null,
                'documento_inicio_actividade' => null,
            ];
        } else {
            // Priorizar logotipo sobre foto_url, mas usar foto_url se logotipo não existir
            $logoEmpregador = data_get($empregador, 'logotipo');
            if ($logoEmpregador && $logoEmpregador != 'none') {
                $empregador->foto = $logoEmpregador;
            } elseif (!$empregador->foto || $empregador->foto == 'none') {
                // Se não tem foto_url válida, deixar null para mostrar inicial
                $empregador->foto = null;
            }
        }

        $anuncios = DB::table('anuncios')
                ->leftJoin('empregadors', 'anuncios.user_id', '=', 'empregadors.user_id')
                ->leftJoin('users', 'anuncios.user_id', '=', 'users.id')
                ->where('anuncios.user_id', $id)
                ->select('anuncios.*', 'users.name as nome','empregadors.empresa as empresa', DB::raw('COALESCE(empregadors.logotipo, users.foto_url, "none") as foto'),'users.celular as celular','users.active as active',
                        'empregadors.empresa as website' ,  'empregadors.endereco as endereco', 'empregadors.sector_actividade as sector_actividade','empregadors.documento_nuit as documento_nuit',
                         'empregadors.documento_certidao as documento_certidao','empregadors.documento_inicio_actividade as documento_inicio_actividade', 'empregadors.logotipo as logotipo')
                ->orderBy('anuncios.id', 'DESC')
                ->get();

        // Buscar dados completos do empregador (sempre buscar para ter acesso ao logotipo)
        $empregadorCompleto = Empregador::where('user_id', $id)->first();
        
        // Se não encontrou pelo modelo, usar os dados já buscados
        if (!$empregadorCompleto && $empregador) {
            $empregadorCompleto = $empregador;
        }

        return view('empregador.empregador-modern', compact('provincias', 'categorias', 'anuncios', 'anuncios_provincias', 'empregador', 'id', 'empregadorCompleto'));
    } catch (\Exception $e) {
        \Log::error('Erro ao buscar empregador: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return redirect('/')->with('erro', 'Erro ao carregar perfil do empregador: ' . $e->getMessage());
    }
  }


public function registarEmpregador(Request $request)
    {
        $password;
        if($request->password == $request->password_confirmation){
          $password = $request->password;
        } else {
          return redirect()->back()->with('erro', 'Ocorreu erro, password diferente!');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->newemail;
        $user->foto_url="none";
        $user->premium_count=0;
        $user->active="activo";
        $user->celular = $request->telefone;
        $user->privilegio = $request->privilegio;
        $user->is_premium = "no";
        $user->password = Hash::make($password);

     
          

        if(User::where('email', '=', $user->email)->count() <= 0 && User::where('celular', '=', $user->celular)->count() <= 0){
        if($user->save()){
            $empregador = new Empregador;
            $empregador->user_id =$user->id;

            $empregador->sector_actividade=$request->sector_actividade;
            if($request->sector_actividade=='Outro')
            $empregador->sector_actividade=$request->sector_especificado;
            $empregador->telefone = $request->telefone;
            $empregador->telefone_alt = $request->telefone_alt;
            $empregador->website = $request->website;
            $empregador->endereco = $request->endereco;
            $empregador->provincia_id = $request->provincia_id;
            $empregador->representante = $request->representante;
            $empregador->sobre = $request->sobre;
            $empregador->estado = 'Pendente'; // Mudado de 'Aberto' para 'Pendente' - aguardando aprovação
            $empregador->empresa = $request->name;

         if ($empregador->save()) {
            // Iniciar sessão automaticamente com o novo empregador
            Auth::login($user);
            // Enviar email de confirmação de cadastro
            try {
                Mail::to($user->email)->send(new EmpregadorCadastroEmail($user->name, $user->email));
            } catch (\Exception $e) {
                \Log::error('Erro ao enviar email de cadastro: ' . $e->getMessage());
            }

            // Redirecionar para página de envio de documentos (usa Auth para obter o user atual)
            return redirect()->route('documents');

          }else{

             return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
     }
   }else{
     return redirect()->back()->with('erro', 'Este email ja existe!');
   }
  }else{
     return redirect()->route("error");
  }
  }

  public function error(){
    return view('empregador.emailexiste');
  }

  public function procurarMotorista(Request $request)
  {
     $motorista = DB::table('users')
             ->where('users.name', $request->keyword)
             ->orWhere('users.name', 'like', '%' . $request->keyword . '%')
             ->where('users.privilegio', 'candidato')
             ->get();

         if (!empty($motorista)) {
             return response(['msg' => $motorista]);
         } else {
             return response(['msg' => 'Ocorreu erro, tenta novamente!', 'error' => '500']);
         }
  }


public function aguarde(){
    return view('empregador.aguarde');
}



  public function getMotorista(Request $request)
  {
     $motorista = DB::table('candidatos')
             ->where('candidatos.user_id', $request->id)
             ->where('users.privilegio', 'candidato')
             ->join('provincias', 'candidatos.provincia_id', '=', 'provincias.id')
             ->join('categorias', 'candidatos.categoria_id', '=', 'categorias.id')
             ->join('users', 'candidatos.user_id', '=', 'users.id')
             ->select('candidatos.*', 'users.name as nome','users.foto_url as foto_url', 'users.email as email', 'users.privilegio as privilegio',
              'provincias.name as provincia', 'users.celular as celular',
             'categorias.categoria as categoria')
             ->first();

         if (!empty($motorista)) {
             return response(['msg' => $motorista]);
         } else {
             return response(['msg' => 'Ocorreu erro, tenta novamente!', 'error' => '500']);
         }
  }


  public function documents (){
    // Página simples para upload inicial de documentos do empregador (apenas para usuário logado)
    $userId = Auth::id();
    return view('empregador.documents', ['userId' => $userId]);
  }

  public function editarPerfil(Request $request)
  {
      try {
          $user = Auth::user();
          $empregador = Empregador::where('user_id', $user->id)->first();

          if (!$empregador) {
              return redirect()->back()->with('erro', 'Empregador não encontrado!');
          }

          // Validação básica
          $validator = Validator::make($request->all(), [
              'name' => 'sometimes|required|string|max:255',
              'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
              'celular' => 'sometimes|nullable|string|max:20',
              'empresa' => 'sometimes|required|string|max:255',
              'sector_actividade' => 'sometimes|nullable|string|max:255',
              'nuit' => 'sometimes|nullable|string|max:50',
              'representante' => 'sometimes|nullable|string|max:255',
              'telefone' => 'sometimes|nullable|string|max:20',
              'telefone_alt' => 'sometimes|nullable|string|max:20',
              'website' => 'sometimes|nullable|url|max:255',
              'endereco' => 'sometimes|nullable|string|max:500',
              'provincia_id' => 'sometimes|nullable|integer|exists:provincias,id',
              'sobre' => 'sometimes|nullable|string|max:2000',
          ]);

          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator)->withInput();
          }

          // Atualizar dados do usuário
          $user->name = $request->input('name', $user->name);
          $user->email = $request->input('email', $user->email);
          $user->celular = $request->input('celular', $user->celular);

          // Atualizar dados do empregador
          $empregador->empresa = $request->input('empresa', $empregador->empresa);
          $empregador->sector_actividade = $request->input('sector_actividade', $empregador->sector_actividade);
          $empregador->nuit = $request->input('nuit', $empregador->nuit);
          $empregador->representante = $request->input('representante', $empregador->representante);
          $empregador->telefone = $request->input('telefone', $empregador->telefone);
          $empregador->telefone_alt = $request->input('telefone_alt', $empregador->telefone_alt);
          $empregador->website = $request->input('website', $empregador->website);
          $empregador->endereco = $request->input('endereco', $empregador->endereco);
          $empregador->provincia_id = $request->input('provincia_id', $empregador->provincia_id);
          $empregador->sobre = $request->input('sobre', $empregador->sobre);

          if ($user->update() && $empregador->update()) {
              return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
          } else {
              return redirect()->back()->with('erro', 'Ocorreu erro ao atualizar o perfil!');
          }
      } catch (\Exception $e) {
          \Log::error('Erro ao editar perfil do empregador: ' . $e->getMessage());
          return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar o perfil. Tente novamente!');
      }
  }


  // public function criarAnuncio(Request $request){
  //
  //       $anuncio = new Anuncios();
  //
  //       $anuncio -> titulo = $request->titulo;
  //       $anuncio -> user_id = $request-> user_id;
  //       $anuncio -> validade = $request->validade;
  //       $anuncio -> descricao = $request->descricao;
  //       $anuncio -> estado_anuncio = "Disponivel";
  //       $anuncio -> forma_de_candidatura = $request->forma_de_candidatura;
  //       $anuncio -> categoria_id = $request->categoria_id;
  //
  //       if($anuncio->save()){
  //            return redirect()->back()->with('success','Formulario Preenchido');
  //       }else{
  //            return redirect()->back()->with('error','Ocorrou um erro, tente novamente');
  //       }
  // }
}