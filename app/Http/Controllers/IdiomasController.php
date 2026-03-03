<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idiomas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class IdiomasController extends Controller
{
  public function create(Request $request)
  {
    $idioma = new Idiomas;
    $idioma->idioma = $request->idioma;
    // Compatibilidade: formulário antigo envia nivel_idioma, o novo envia nivel
    $idioma->nivel = $request->nivel_idioma ?? $request->nivel;
    $idioma->candidato_id = $request->candidato_id;

      if ($idioma->save()) {
          return redirect()->back()->with('success', 'Idioma adicionada com sucesso!');
      } else {
          return redirect()->back()->with('erro', 'Ocorreu erro, tenta novamente!');
      }
  }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
     //
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
     //
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
