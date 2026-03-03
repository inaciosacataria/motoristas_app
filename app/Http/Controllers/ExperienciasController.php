<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencias;
use Illuminate\Support\Facades\DB;
use Auth;

class ExperienciasController extends Controller
{
  public function create(Request $request)
  {
    $experiencia = new Experiencias;
    $experiencia->candidato_id = $request->candidato_id;
    $experiencia->empresa = $request->empresa;
    $experiencia->cargo = $request->cargo;
    // Compatibilidade entre formulário antigo (/meu-cv) e novo (/meu-cv-modern)
    $experiencia->actividades_exercidas = $request->actividades_exercidas ?? $request->descricao;
    $experiencia->pais = $request->pais;
    $experiencia->cidade = $request->cidade;
    $experiencia->inicio = $request->inicio ?? $request->data_inicio;
    $experiencia->fim = $request->fim ?? $request->data_fim;
    $experiencia->trabalha_ate_agora = $request->trabalha_ate_agora;
    $experiencia->tipo_de_contrato = $request->tipo_de_contrato;
    $experiencia->ultimo_salario = $request->ultimo_salario;
    $experiencia->motivo_de_saida = $request->motivo_de_saida;

      if ($experiencia->save()) {
          return redirect()->back()->with('success', 'Experiência adicionada com sucesso!');
      } else {
          return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
      }
  }
}
