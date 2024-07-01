<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\ProfilController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Procedure\ProcedureController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Models\User\User;
use App\Http\Controllers\Developeur\ActionController;
use App\Http\Controllers\Developeur\MenuController;
use App\Http\Controllers\MenuPromoteur\MenuPromoteurController;
use App\Http\Controllers\Params\LocaliteController;
use App\Http\Controllers\Params\SecteurController;
use App\Http\Controllers\Params\FiliereController;
use App\Http\Controllers\Params\SpecialitesController;
use App\Http\Controllers\Params\TypeEnseignementController;
use App\Http\Controllers\Params\TypeDocumentController;
use App\Http\Controllers\Params\TypePromoteurController;
use App\Http\Controllers\Params\DocumentController;


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

Route::get('/', function () {
    return view('welcome');
    
});

Route::get('/acceuil', function () {
    return view('detailsproc');
})->name('details');

// Les ressources
Route::resource('user',UserController::class);
Route::resource('profil',ProfilController::class);
Route::resource('menu',MenuController::class);
Route::resource('action', ActionController::class);
Route::resource('localite', LocaliteController::class);
Route::resource('procedure', ProcedureController::class);
Route::resource('secteur', SecteurController::class);
Route::resource('filiere', FiliereController::class);
Route::resource('specialite', SpecialitesController::class);
Route::resource('enseignement', TypeEnseignementController::class);
Route::resource('typeDocument', TypeDocumentController::class);
Route::resource('typePromoteur', TypePromoteurController::class);
Route::resource('document', DocumentController::class);

//Route::get('/create', [ProcedureController::class, 'createProcedure'])->name('procedure.create');
//Route::get('/acceuil', [ProcedureController::class, 'acceuilProcedure'])->name('acceuilProcedure');
//Route::post('/procedure/save', [ProcedureController::class, 'store'])->name('procedure.save');

Route::get('/showLoginForm', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
/*Route::get('/connexion', function () {
    return view('user.login');
})->name('connexion' );*/


//Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
//Route::post('/users/save', [UserController::class, 'store'])->name('user.save');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

/**
 * espace ajax
 */
Route::get('getListeLocalite/{idReg}/{idProv}',[AjaxController::class,'getListeLocalite']);
Route::get('getLocalitesFils/{idParent}',[AjaxController::class,'getLocalitesFils']);
Route::get('getFilieres/{idSecteur}',[AjaxController::class,'getFilieres']);
Route::get('getSpecialites/{idFiliere}',[AjaxController::class,'getSpecialites']);
Route::get('getStructure/{idLocalite}',[AjaxController::class,'getStructure']);
//-------------------------------------------------------------------------

//les routes

//User
Route::get('user/{rub}/{srub}',[UserController::class,'index']);
Route::get('user/create/{rub}/{srub}',[UserController::class,'create']);
Route::get('user/{id}/edit/{rub}/{srub}', [UserController::class,'edit']);
Route::get('comptenonactif/{rub}/{srub}', [UserController::class,'compteNonValide']);
Route::get('comptenonactif', [UserController::class, 'compteNonValide'])->name('comptenonactif');
Route::get('acceuilUser', [UserController::class, 'acceuilUser']);
Route::get('acceuilAdmin', [UserController::class, 'acceuilAdmin']);

//Profil
Route::get('profil/{rub}/{srub}',[ProfilController::class,'index']);
Route::get('profil/create/{rub}/{srub}',[ProfilController::class,'create']);
Route::get('profil/{id}/edit/{rub}/{srub}',[ProfilController::class, 'edit']);

//Action
Route::get('action/{rub}/{srub}',[ActionController::class,'index']);
Route::get('action/create/{rub}/{srub}',[ActionController::class,'create']);
Route::get('action/{id}/edit/{rub}/{srub}',[ActionController::class,'edit']);

//Menu
Route::get('menu/{rub}/{srub}',[MenuController::class,'index']);
Route::get('menu/create/{rub}/{srub}',[MenuController::class,'create']);
Route::get('menu/{id}/edit/{rub}/{srub}',[MenuController::class,'edit']);

// Localite
Route::post('/import_localite',[LocaliteController::class,'import']);
Route::get('/importLocalite',[LocaliteController::class,'formImport']);
Route::get('localite/{rub}/{srub}',[LocaliteController::class,'index']);
Route::get('localite/create/{loc}/{rub}/{srub}',[LocaliteController::class,'create']);
Route::get('localite/{id}/edit/{rub}/{srub}',[LocaliteController::class,'edit']);

// Secteur
Route::get('secteur/{rub}/{srub}',[SecteurController::class,'index']);
Route::get('secteur/create/{rub}/{srub}',[SecteurController::class,'create']);
Route::get('secteur/{id}/edit/{rub}/{srub}',[SecteurController::class,'edit']);

// filiere
Route::get('filiere/{rub}/{srub}',[FiliereController::class,'index']);
Route::get('filiere/create/{rub}/{srub}',[FiliereController::class,'create']);
Route::get('filiere/{id}/edit/{rub}/{srub}',[FiliereController::class,'edit']);

// specialite
Route::get('specialite/{rub}/{srub}',[SpecialitesController::class,'index']);
Route::get('specialite/create/{rub}/{srub}',[SpecialitesController::class,'create']);
Route::get('specialite/{id}/edit/{rub}/{srub}',[SpecialitesController::class,'edit']);

// Type Enseignement
Route::get('enseignement/{rub}/{srub}',[TypeEnseignementController::class,'index']);
Route::get('enseignement/create/{rub}/{srub}',[TypeEnseignementController::class,'create']);
Route::get('enseignement/{id}/edit/{rub}/{srub}',[TypeEnseignementController::class,'edit']);

// Type Documents
Route::get('typeDocument/{rub}/{srub}',[TypeDocumentController::class,'index']);
Route::get('typeDocument/create/{rub}/{srub}',[TypeDocumentController::class,'create']);
Route::get('typeDocument/{id}/edit/{rub}/{srub}',[TypeDocumentController::class,'edit']);

// Type Promoteurs
Route::get('typePromoteur/{rub}/{srub}',[TypePromoteurController::class,'index']);
Route::get('typePromoteur/create/{rub}/{srub}',[TypePromoteurController::class,'create']);
Route::get('typePromoteur/{id}/edit/{rub}/{srub}',[TypePromoteurController::class,'edit']);

// filiere
Route::get('document/{rub}/{srub}',[DocumentController::class,'index']);
Route::get('document/create/{rub}/{srub}',[DocumentController::class,'create']);
Route::get('document/{id}/edit/{rub}/{srub}',[DocumentController::class,'edit']);

// Procedure
Route::get('procedure/{rub}/{srub}',[ProcedureController::class,'index']);
Route::get('procedure/create/{rub}/{srub}',[ProcedureController::class,'create']);
Route::get('procedure/{id}/edit/{rub}/{srub}',[ProcedureController::class,'edit']); 
Route::post('procedure/{id}/updateStatut/',[ProcedureController::class,'updateStatut'])->name('procedure.updateStatut');
Route::post('procedure/{id}/updateMouvement/',[ProcedureController::class,'updateMouvement'])->name('procedure.updateMouvement');
Route::get('procedure/show/{id}',[ProcedureController::class,'show']);
// Route::get('/show-pdf/{pdfUrl}', [PdfController::class, 'showPdf'])->name('pdf.show');
Route::post('genererAutorisation/{id}',[ProcedureController::class,'genererAutorisationAvec']);
Route::get('genererAutorisation/{id}',[ProcedureController::class,'genererAutorisation']);

// Menu Promoteurs

Route::get('acceuil/makeRequest', [MenuPromoteurController::class, 'makeRequest'])->name('makeRequest')->middleware('auth');
Route::get('acceuil/followRequest', [MenuPromoteurController::class, 'followRequest'])->name('followRequest');
Route::post('acceuil/findFollowRequest', [MenuPromoteurController::class, 'findFollowRequest'])->name('findFollowRequest');

//Compteurs demandes traitees, en cours, totales, à modifier
Route::get('acceuil/contacts', [MenuPromoteurController::class, 'countRequestTreat'])->name('contacts');
Route::get('acceuil/contacts', [MenuPromoteurController::class, 'countRequestProgress'])->name('contacts');
Route::get('acceuil/contacts', [MenuPromoteurController::class, 'countRequestTotal'])->name('contacts');
Route::get('acceuil/contacts', [MenuPromoteurController::class, 'countRequestEdit'])->name('contacts');





