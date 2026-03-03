<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', function () {
    return redirect('/');
});

Route::get('/command',function(){
  $exitcode = Artisan::call('schedule:run');
  $code = Artisan::call('npm run dev');


  return "Comand runned";
});

Route::get('/teste33',function(){



  return "ola rota";
});



Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/concluir', function () {
     if (!Auth::check()) {
         return redirect('/login');
     }
     if(Auth::user()->privilegio == 'empregador'){
       if(Auth::user()->active == 'desativado'){
           return redirect('/aguarde');
       }else{
          return redirect('/empregador');
       }
     }elseif (Auth::user()->privilegio == 'candidato') {
       return redirect('/candidato');
     }elseif (Auth::user()->privilegio == 'admin') {
       return redirect('/admin');
     }
     return redirect('/');
});


//auth
Auth::routes();

// Notificações (utilizador autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/count', [App\Http\Controllers\NotificationController::class, 'count'])->name('notifications.count');
    Route::get('/notifications/json', [App\Http\Controllers\NotificationController::class, 'getUnread'])->name('notifications.getUnread');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

Route::get('/test', function (){
  return view('test');
});
Route::get('/ ', [App\Http\Controllers\InicioController::class, 'index'])->name('index');



Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


//@TODO anyone
Route::get('/anuncio/{slug}', [App\Http\Controllers\AnunciosController::class, 'verAnuncio'])->name('verAnuncio');
Route::get('/search', [App\Http\Controllers\AnunciosController::class, 'search'])->name('search');



// @TODO empregador
Route::post('/newempregador', [App\Http\Controllers\EmpregadorController::class, 'registarEmpregador'])->name('newempregador');
Route::get('/error', [App\Http\Controllers\EmpregadorController::class, 'error'])->name('error');
Route::get('/error2', [App\Http\Controllers\CandidatoController::class, 'error2'])->name('error2');
Route::get('/empregador', [App\Http\Controllers\EmpregadorController::class, 'index'])->name('empregador')->middleware('empregador');
Route::get('/empregador-perfil/{id}', [App\Http\Controllers\EmpregadorController::class, 'getEmpregador'])->name('empregador-perfil');
Route::post('/logotipo', [App\Http\Controllers\DocumentosController::class, 'fotoPerfil'])->name('fotoPerfilEmpregador')->middleware('empregador');
// Envio inicial de documentos do empregador (apenas empregador/admin logado)
Route::get('/documents', [App\Http\Controllers\EmpregadorController::class, 'documents'])->name('documents')->middleware('empregador');
Route::post('/upload-documents', [App\Http\Controllers\DocumentosController::class, 'uploadAlldocuments'])->name('uploadAlldocuments')->middleware('empregador');
Route::post('/update-document', [App\Http\Controllers\DocumentosController::class, 'updateDocument'])->name('updateDocument')->middleware('empregador');
Route::get('/aguarde', [App\Http\Controllers\EmpregadorController::class, 'aguarde'])->name('aguarde');

// @TODO empregador previlegios
Route::get('/procurar-motorista', [App\Http\Controllers\EmpregadorController::class, 'procurarMotorista'])->name('procurarMotorista')->middleware('empregador');
Route::get('/get-motorista', [App\Http\Controllers\EmpregadorController::class, 'getMotorista'])->name('getMotorista')->middleware('empregador');
Route::post('/criarAnuncio', [App\Http\Controllers\AnunciosController::class, 'criarAnuncio'])->name('criarAnuncio')->middleware('empregador');
Route::post('/editarAnuncio', [App\Http\Controllers\AnunciosController::class, 'editarAnuncio'])->name('editarAnuncio')->middleware('empregador');
Route::post('/apagarAnuncio/{id}', [App\Http\Controllers\AnunciosController::class, 'apagarAnuncio'])->name('apagarAnuncio');
Route::get('/candidatos-anuncio/{slug}', [App\Http\Controllers\CandidaturasAnunciosController::class, 'verCandidatosDeUmAnuncio'])->name('verCandidatosDeUmAnuncio')->middleware('empregador');
Route::get('/gerar-pdf-candidatos/{slug}', [App\Http\Controllers\CandidaturasAnunciosController::class, 'gerarPdfCandidatos'])->name('gerarPdfCandidatos')->middleware('empregador');
Route::post('/editar-perfil-empregador', [App\Http\Controllers\EmpregadorController::class, 'editarPerfil'])->name('editarPerfilEmpregador')->middleware('empregador');
Route::post('/upload-logotipo', [App\Http\Controllers\DocumentosController::class, 'uploadLogotipo'])->name('uploadLogotipo')->middleware('empregador');
// Central de Risco desativado
// Route::post('/denunciarMotorista', [App\Http\Controllers\CentralDeRiscoController::class, 'create'])->name('denunciar')->middleware('empregador');


//@ TODO Candidatos
Route::post('/new-candidato', [App\Http\Controllers\CandidatoController::class, 'novo'])->name('newCandidato');
Route::get('/candidato', [App\Http\Controllers\CandidatoController::class, 'index'])->name('candidato')->middleware('candidato');


//@ TODO privilegio candidato
Route::get('/meu-cv', [App\Http\Controllers\CandidatoController::class, 'cv'])->name('meuCv');
Route::post('/add-idioma', [App\Http\Controllers\IdiomasController::class, 'create'])->name('addIdioma')->middleware('candidato');
Route::post('/add-documento', [App\Http\Controllers\DocumentosController::class, 'create'])->name('addDocumento')->middleware('candidato');
Route::post('/fotoPerfil', [App\Http\Controllers\DocumentosController::class, 'fotoPerfil'])->name('fotoPerfil')->middleware('candidato');
//Route::post('/add-conhecimento', [App\Http\Controllers\ConhecimentosController::class, 'create'])->name('addConhecimento')->middleware('candidato');
Route::post('/add-experiencia', [App\Http\Controllers\ExperienciasController::class, 'create'])->name('addExperiencia')->middleware('candidato');
Route::post('/candidatar', [App\Http\Controllers\CandidaturasAnunciosController::class, 'create'])->name('candidatar')->middleware('candidato');
Route::get('/candidatura-espontanea', [App\Http\Controllers\CandidatoController::class, 'candidaturaEspontanea'])->name('candidatura-espontanea')->middleware('candidato');
Route::get('/submeter-candidatura-espontanea/{id}', [App\Http\Controllers\CandidaturasAnunciosController::class, 'candidaturaExpontanea'])->name('submeter-candidatura-espontanea')->middleware('candidato');



//@TODO Admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('admin');
Route::get('/bd-motoristas', [App\Http\Controllers\AdminController::class, 'motoristas'])->name('bd-motoristas')->middleware('admin');
Route::get('/bd-motoristas/download-csv', [App\Http\Controllers\AdminController::class, 'downloadMotoristasCsv'])->name('downloadMotoristasCsv')->middleware('admin');
Route::get('/bd-motoristas/lista-impressao', [App\Http\Controllers\AdminController::class, 'listaMotoristasImpressao'])->name('listaMotoristasImpressao')->middleware('admin');
Route::get('/bd-empregadores', [App\Http\Controllers\AdminController::class, 'empregadores'])->name('bd-empregadores')->middleware('admin');
// Gestão de Publicidade (apenas admin)
Route::get('/smart-ads', [App\Http\Controllers\SmartAdsController::class, 'index'])->name('smart-ads.index')->middleware('admin');
Route::post('/smart-ads', [App\Http\Controllers\SmartAdsController::class, 'store'])->name('smart-ads.store')->middleware('admin');
Route::post('/smart-ads/{id}', [App\Http\Controllers\SmartAdsController::class, 'update'])->name('smart-ads.update')->middleware('admin');
Route::post('/smart-ads/{id}/toggle', [App\Http\Controllers\SmartAdsController::class, 'toggle'])->name('smart-ads.toggle')->middleware('admin');
Route::post('/smart-ads/{id}/delete', [App\Http\Controllers\SmartAdsController::class, 'destroy'])->name('smart-ads.destroy')->middleware('admin');
Route::get('/perfil/{id}', [App\Http\Controllers\CandidatoController::class, 'perfil'])->name('perfil');
// Route::post('/updateDenuncia', [App\Http\Controllers\CentralDeRiscoController::class, 'updateCentralDeRisco'])->name('updateDenuncia')->middleware('admin');
Route::get('/activeUser/{id}', [App\Http\Controllers\AdminController::class, 'activeEmpregador'])->name('activeUser')->middleware('admin');
Route::get('/desactiveUser/{id}', [App\Http\Controllers\AdminController::class, 'desativeEmpregador'])->name('desactiveUser')->middleware('admin');
Route::get('/aprovar-empregador/{id}', [App\Http\Controllers\AdminController::class, 'aprovarEmpregador'])->name('aprovarEmpregador')->middleware('admin');
Route::get('/rejeitar-empregador/{id}', [App\Http\Controllers\AdminController::class, 'rejeitarEmpregador'])->name('rejeitarEmpregador')->middleware('admin');
Route::get('/sendAdminNotification/{id}', [App\Http\Controllers\AdminController::class, 'sendAdminNotification'])->name('sendAdminNotification');


//@TODO admin privilegios
Route::post('/deleteCandidato/{id}',[App\Http\Controllers\CanditadoController::class,'deleteCandidato'])->name('deleteCandidato')->middleware('admin');
Route::get('/anuncios',[App\Http\Controllers\AdminController::class,'anuncios'])->name('anuncios')->middleware('admin');

//@TODO bothCanSee - Privilegios para admin e empregador (Central de Risco removido)
// Route::get('/denuncia/{id}', [App\Http\Controllers\CentralDeRiscoController::class, 'denuncia'])->name('denuncia')->middleware('bothCanSee');
// Route::get('/centralRisco', [App\Http\Controllers\CentralDeRiscoController::class, 'index'])->name('centralRisco')->middleware('bothCanSee');
// Route::get('/searchDenuncias', [App\Http\Controllers\CentralDeRiscoController::class, 'search'])->name('searchDenuncias')->middleware('bothCanSee');


//@TODO cursos
Route::get('/formacao', [App\Http\Controllers\CursosController::class, 'getCursos'])->name('formacao');
Route::get('/formacaoinfo', [App\Http\Controllers\CursosController::class, 'getCursoInfo'])->name('cursoinfo');
Route::get('/inscricao', [App\Http\Controllers\CursosController::class, 'inscricaoForm'])->name('inscricao');
Route::post('/submeter-inscricao', [App\Http\Controllers\CursosController::class, 'submeterInscricao'])->name('submeter-inscricao');

Route::get('/formacao1', function (){
  return view('cursos.formacao1');
});

Route::get('/formacao2', function (){
  return view('cursos.formacao2');
});

Route::get('/formacao3', function (){
  return view('cursos.formacao3');
});

Route::get('/formacao4', function (){
  return view('cursos.formacao4');
});

Route::get('/formacao5', function (){
  return view('cursos.formacao5');
});

Route::get('/formacao6', function (){
  return view('cursos.formacao6');
});

Route::get('/formacao7', function (){
  return view('cursos.formacao7');
});

Route::get('/formacao8', function (){
  return view('cursos.formacao8');
});

Route::get('/formacao9', function (){
  return view('cursos.formacao9');
});

// Rota para servir banners de smart-ads quando o /storage não aponta para a pasta pública (ex: cPanel com root diferente)
Route::get('/storage/smart-ads/{filename}', function ($filename) {
    $path = 'smart-ads/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return Storage::disk('public')->response($path);
})->where('filename', '.*');