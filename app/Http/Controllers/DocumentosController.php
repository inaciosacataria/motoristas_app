<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentsEmpregador;
use App\Models\Candidatos;
use App\Models\Empregador;
use App\Models\fotoUrl;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Documentos;

class DocumentosController extends Controller
{
  public function create(Request $request)
  {
    $documento = $request->file('documento');

    $documentoName = time() . '-' . $request->tipo . '.' . $documento->getClientOriginalExtension();
    $upload_success = $documento->move('uploads', $documentoName);

    $novoDocumento = new Documentos;
    $novoDocumento->candidato_id = $request->candidato_id;
    $novoDocumento->tipo = $request->tipo;
    $novoDocumento->ficheiro = 'uploads/' . $documentoName; //endereco do file no servidor

    if ($upload_success) {
        if ($novoDocumento->save()) {
            $candidato= Candidatos::find($request->candidato_id);
            $candidato->cv = $novoDocumento->ficheiro;
            $candidato->update();
            return redirect()->back()->with(array('success' => 'Documento adicionado com sucesso!'));
        } else {
            return redirect()->back()->with(array('erro' => 'Ocorreu um erro, tenta novamente!'));
        }

    } else {
        return redirect()->back()->with(array('erro' => 'Ocorreu um erro, tenta novamente!'));
    }

  }


  public function uploadAlldocuments(Request $request){
        try {
            $userId = $request->user_id ?? Auth::user()->id;
            $empregador = Empregador::where('user_id', $userId)->first();
            
            if (!$empregador) {
                return redirect()->back()->with('erro', 'Empregador não encontrado!');
            }

            // Upload de documentos (apenas os que foram enviados)
            if ($request->hasFile('documento_nuit')) {
                self::documentUpload($request->file('documento_nuit'), 'documento_nuit', $request);
            }
            if ($request->hasFile('documento_certidao_empresa')) {
                self::documentUpload($request->file('documento_certidao_empresa'), 'documento_certidao', $request);
            }
            if ($request->hasFile('documento_inicio_actividade')) {
                self::documentUpload($request->file('documento_inicio_actividade'), 'documento_inicio_actividade', $request);
            }

            // Recarregar empregador para pegar os documentos atualizados
            $empregador->refresh();
            $user = User::find($empregador->user_id);
            
            // Verificar se todos os documentos foram enviados
            if($empregador->documento_nuit && $empregador->documento_certidao && $empregador->documento_inicio_actividade) {
                // Se já estava aprovado, manter aprovado mas marcar como pendente para revisão
                if($empregador->estado == 'Aprovado') {
                    $empregador->estado = 'Pendente'; // Volta para pendente para revisão do admin
                    $empregador->update();
                    return redirect()->back()->with('success', 'Documentos atualizados com sucesso! Seu perfil será revisado novamente pelo administrador.');
                } else {
                    // Primeira vez enviando todos os documentos
                    $empregador->estado = 'Pendente';
                    $empregador->update();
                    
                    // Desativar usuário até aprovação (apenas se ainda não estava ativo)
                    if($user->active != 'activo') {
                        $user->active = 'desativado';
                        $user->update();
                    }
                }
            }
            
            // Se já está logado (atualizando documentos), voltar para o perfil
            if (Auth::check() && Auth::user()->id == $userId) {
                return redirect()->route('empregador-perfil', $userId)->with('success', 'Documentos atualizados com sucesso!');
            }
            
            // Se for primeiro cadastro, redirecionar para aguarde
            return redirect()->route('aguarde');
        } catch (\Exception $e) {
            \Log::error('Erro ao fazer upload de documentos: ' . $e->getMessage());
            return redirect()->back()->with('erro', 'Ocorreu um erro ao fazer upload dos documentos. Tente novamente!');
        }
  }
  
  public function updateDocument(Request $request)
  {
      try {
          $userId = Auth::user()->id;
          $tipoDocumento = $request->tipo; // 'documento_nuit', 'documento_certidao', 'documento_inicio_actividade'
          
          if (!$request->hasFile('documento')) {
              return redirect()->back()->with('erro', 'Nenhum arquivo selecionado!');
          }
          
          // Validar tipo de arquivo (apenas PDF)
          $file = $request->file('documento');
          $extension = strtolower($file->getClientOriginalExtension());
          if ($extension !== 'pdf') {
              return redirect()->back()->with('erro', 'Apenas arquivos PDF são permitidos!');
          }
          
          $empregador = Empregador::where('user_id', $userId)->first();
          
          if (!$empregador) {
              return redirect()->back()->with('erro', 'Empregador não encontrado!');
          }
          
          // Criar request temporário para usar documentUpload
          $tempRequest = new Request();
          $tempRequest->merge(['user_id' => $userId]);
          
          // Fazer upload do documento
          $uploadSuccess = self::documentUpload($request->file('documento'), $tipoDocumento, $tempRequest);
          
          if (!$uploadSuccess) {
              \Log::error('Falha no upload do documento. Tipo: ' . $tipoDocumento . ', User ID: ' . $userId);
              return redirect()->back()->with('erro', 'Erro ao fazer upload do documento. Verifique se o arquivo é válido e tente novamente!');
          }
          
          // Recarregar empregador para pegar os dados atualizados
          $empregador->refresh();
          
          // Se estava aprovado e atualizou documento, voltar para pendente
          if($empregador->estado == 'Aprovado') {
              $empregador->estado = 'Pendente';
              $empregador->update();
              return redirect()->back()->with('success', 'Documento atualizado com sucesso! Seu perfil será revisado novamente pelo administrador.');
          }
          
          return redirect()->back()->with('success', 'Documento atualizado com sucesso!');
      } catch (\Exception $e) {
          \Log::error('Erro ao atualizar documento: ' . $e->getMessage());
          \Log::error('Stack trace: ' . $e->getTraceAsString());
          return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar o documento: ' . $e->getMessage());
      }
  }

  public function documentUpload($documento,$documentField,$request)
  {
    if (!$documento) {
        return false; // Retorna false se não há documento para fazer upload
    }

    try {
        $userId = $request->user_id ?? Auth::user()->id;
        
        // Buscar o empregador primeiro para obter o ID correto
        $empresa = Empregador::where('user_id', $userId)->first();
        
        if (!$empresa) {
            \Log::error('Empregador não encontrado para user_id: ' . $userId);
            return false;
        }
        
        $documentoName = $userId . '-' . $documentField . '-' . time() . '.' . $documento->getClientOriginalExtension();
        $upload_success = $documento->move('uploads', $documentoName);

        if ($upload_success) {
            // Salvar registro na tabela documents_empregador usando o ID do empregador (não user_id)
            $novoDocumento = new DocumentsEmpregador;
            $novoDocumento->empregador_id = $empresa->id; // Usar o ID do empregador, não o user_id
            $novoDocumento->tipo = $documento->getClientOriginalExtension();
            $novoDocumento->ficheiro = 'uploads/' . $documentoName;
            
            if ($novoDocumento->save()) {
                // Atualizar o campo correspondente na tabela empregadors
                if($documentField == 'documento_nuit'){
                    $empresa->documento_nuit = $novoDocumento->ficheiro;
                } elseif($documentField == 'documento_certidao'){
                    $empresa->documento_certidao = $novoDocumento->ficheiro;
                } elseif($documentField == 'documento_inicio_actividade'){
                    $empresa->documento_inicio_actividade = $novoDocumento->ficheiro;
                }
                
                if ($empresa->update()) {
                    return true;
                } else {
                    \Log::error('Erro ao atualizar documento na tabela empregadors');
                    return false;
                }
            } else {
                \Log::error('Erro ao salvar documento na tabela documents_empregadors');
                return false;
            }
        }
        return false;
    } catch (\Exception $e) {
        \Log::error('Erro no documentUpload: ' . $e->getMessage());
        return false;
    }
  }

  public function fotoPerfil(Request $request)
  {
    try {
        // Validar se há arquivo
        if (!$request->hasFile('documento')) {
            return redirect()->back()->with('erro', 'Nenhuma foto selecionada!');
        }

        $foto = $request->file('documento');
        
        // Validar tipo de arquivo
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower($foto->getClientOriginalExtension());
        
        if (!in_array($extension, $allowedExtensions)) {
            return redirect()->back()->with('erro', 'Formato de arquivo não permitido! Use JPG, PNG, GIF ou WEBP.');
        }

        // Validar tamanho (máximo 5MB)
        if ($foto->getSize() > 5 * 1024 * 1024) {
            return redirect()->back()->with('erro', 'Arquivo muito grande! Tamanho máximo: 5MB.');
        }

        // Usar Auth::user()->id para segurança (não confiar no request)
        $userId = Auth::user()->id;
        $fotoName = 'foto-' . $userId . '-' . time() . '.' . $extension;
        $upload_success = $foto->move('uploads', $fotoName);

        if ($upload_success) {
            // Salvar registro na tabela foto_urls
            $foto_urls = new fotoUrl;
            $foto_urls->user_id = $userId;
            $foto_urls->tipo = $extension;
            $foto_urls->ficheiro = 'uploads/' . $fotoName;
            
            if ($foto_urls->save()) {
                // Atualizar foto_url do usuário
                $user = User::find($userId);
                $user->foto_url = $foto_urls->ficheiro;

                if ($user->update()) {
                    // Se for empregador, também atualizar logotipo se existir
                    $empregador = Empregador::where('user_id', $userId)->first();
                    if ($empregador) {
                        $empregador->logotipo = $foto_urls->ficheiro;
                        $empregador->update();
                    }
                    
                    return redirect()->back()->with('success', 'Foto de perfil atualizada com sucesso!');
                } else {
                    return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar o perfil!');
                }
            } else {
                return redirect()->back()->with('erro', 'Ocorreu um erro ao salvar a foto!');
            }
        } else {
            return redirect()->back()->with('erro', 'Ocorreu um erro ao fazer upload do arquivo!');
        }
    } catch (\Exception $e) {
        \Log::error('Erro ao atualizar foto de perfil: ' . $e->getMessage());
        return redirect()->back()->with('erro', 'Ocorreu um erro inesperado. Tente novamente!');
    }
  }

  public function uploadLogotipo(Request $request)
  {
      $logotipo = $request->file('logotipo');
      
      if (!$logotipo) {
          return redirect()->back()->with('erro', 'Nenhum arquivo selecionado!');
      }

      $logotipoName = 'logo-' . Auth::user()->id . '-' . time() . '.' . $logotipo->getClientOriginalExtension();
      $upload_success = $logotipo->move('uploads', $logotipoName);

      if ($upload_success) {
          $empregador = Empregador::where('user_id', Auth::user()->id)->first();
          
          if ($empregador) {
              // Se já existe um logotipo antigo, pode deletar aqui se necessário
              $empregador->logotipo = 'uploads/' . $logotipoName;
              
              if ($empregador->update()) {
                  // Também atualizar foto_url do usuário para usar como logotipo
                  $user = User::find(Auth::user()->id);
                  $user->foto_url = 'uploads/' . $logotipoName;
                  $user->update();
                  
                  return redirect()->back()->with('success', 'Logotipo atualizado com sucesso!');
              } else {
                  return redirect()->back()->with('erro', 'Ocorreu um erro ao salvar o logotipo!');
              }
          } else {
              return redirect()->back()->with('erro', 'Empregador não encontrado!');
          }
      } else {
          return redirect()->back()->with('erro', 'Ocorreu um erro ao fazer upload do arquivo!');
      }
  }
}
