<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PorteurController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\PersonnelacadController;
use App\Http\Controllers\ExperimentationController;
use App\Http\Controllers\ThematiqueController;
use App\Models\Thematique;

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
    return view('auth/login');
})->name("goHome");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/attente', function () {return view('attente');})->name('goAttente');

Route::get('/etablissement2', function () {return view('etablissementRecherche');})->name("goEtablissement2");

Route::get('/carte', [EtablissementController::class, 'show2'])->name("goCarte");

Route::get('/etablissement',[EtablissementController::class, 'show'])->name("goEtablissement");

Route::get('/etablissement/ajouter',[EtablissementController::class, 'create'])->name("goEtablissementAjouter");

Route::post('/etablissement/ajouter',[EtablissementController::class, 'store'])->name("goEtablissementAjouter");

Route::get('/etablissement/{etablissement}',[EtablissementController::class, 'edit'])->name("goEtablissementModifier");

Route::put('/etablissement/{etablissement}',[EtablissementController::class, 'update'])->name("goEtablissementModifier");

Route::delete('/etablissement/{etablissement}',[EtablissementController::class, 'delete'])->name("goEtablissementSupprimer");

Route::get('/etablissement/{etablissement}/affichage', [EtablissementController::class, 'affiche'])->name("goEtablissementAffichage");

Route::get('search1', [EtablissementController::class, 'search'])->name("goEtablissementSearch");

Route::get('/filtre', [EtablissementController::class, 'filtre'])->name("goEtablissementFiltre");

Route::get('/recherche2', [EtablissementController::class, 'recherche'])->name("goEtablissementRecherche");

Route::get('/etablissement/{etablissement}/telechargement1-pdf', [EtablissementController::class, 'telechargerPdf'])->name("goEtablissementPDF");



Route::get('/porteur2', function () {return view('porteurRecherche');})->name("goPorteur2");

Route::get('/porteur',[PorteurController::class, 'show'])->name("goPorteur");

Route::get('/porteurMail',[PorteurController::class, 'show2'])->name("goPorteurMail");

Route::get('/porteur/ajouter',[PorteurController::class, 'create'])->name("goPorteurAjouter");

Route::post('/porteur/ajouter',[PorteurController::class, 'store'])->name("goPorteurAjouter");

Route::get('/porteur/{porteur}',[PorteurController::class, 'edit'])->name("goPorteurModifier");

Route::put('/porteur/{porteur}',[PorteurController::class, 'update'])->name("goPorteurModifier");

Route::delete('/porteur/{porteur}',[PorteurController::class, 'delete'])->name("goPorteurSupprimer");

Route::get('/porteur/{porteur}/affichage', [PorteurController::class, 'affiche'])->name("goPorteurAffichage");

Route::get('search2', [PorteurController::class, 'search'])->name("goPorteurSearch");

Route::get('/recherche3', [PorteurController::class, 'recherche'])->name("goPorteurRecherche");

Route::get('/porteur/{porteur}/telechargement2-pdf', [PorteurController::class, 'telechargerPdf'])->name("goPorteurPDF");



Route::get('/personnelacad2', function () {return view('personnelacadRecherche');})->name("goPersonnelacad2");

Route::get('/personnelacad',[PersonnelacadController::class, 'show'])->name("goPersonnelacad");

Route::get('/personnelacadMail',[PersonnelacadController::class, 'show2'])->name("goPersonnelacadMail");

Route::get('/personnelacad/ajouter',[PersonnelacadController::class, 'create'])->name("goPersonnelacadAjouter");

Route::post('/personnelacad/ajouter',[PersonnelacadController::class, 'store'])->name("goPersonnelacadAjouter");

Route::get('/personnelacad/{personnelacad}',[PersonnelacadController::class, 'edit'])->name("goPersonnelacadModifier");

Route::put('/personnelacad/{personnelacad}',[PersonnelacadController::class, 'update'])->name("goPersonnelacadModifier");

Route::delete('/personnelacad/{personnelacad}',[PersonnelacadController::class, 'delete'])->name("goPersonnelacadSupprimer");

Route::get('/personnelacad/{personnelacad}/affichage', [PersonnelacadController::class, 'affiche'])->name("goPersonnelacadAffichage");

Route::get('search3', [PersonnelacadController::class, 'search'])->name("goPersonnelacadSearch");

Route::get('/recherche4', [PersonnelacadController::class, 'recherche'])->name("goPersonnelacadRecherche");

Route::get('/personnelacad/{personnelacad}/telechargement2-pdf', [PersonnelacadController::class, 'telechargerPdf'])->name("goPersonnelacadPDF");



Route::get('/experimentation2', function () {return view('experimentationRecherche');})->name("goExperimentation2");

Route::get('/experimentation',[ExperimentationController::class, 'show'])->name("goExperimentation");

Route::get('/experimentation/ajouter',[ExperimentationController::class, 'create'])->name("goExperimentationAjouter");

Route::post('/experimentation/ajouter',[ExperimentationController::class, 'store'])->name("goExperimentationAjouter");

Route::get('/experimentation/{experimentation}',[ExperimentationController::class, 'edit'])->name("goExperimentationModifier");

Route::put('/experimentation/{experimentation}',[ExperimentationController::class, 'update'])->name("goExperimentationModifier");

Route::delete('/experimentation/{experimentation}',[ExperimentationController::class, 'delete'])->name("goExperimentationSupprimer");

Route::get('/experimentation/{experimentation}/affichage', [ExperimentationController::class, 'affiche'])->name("goExperimentationAffichage");

Route::get('/search4', [ExperimentationController::class, 'search'])->name("goExperimentationSearch");



Route::get('/recherche', [ExperimentationController::class, 'recherche'])->name("goExperimentationRecherche");

Route::get('/experimentation/{experimentation}/telechargement4-pdf', [ExperimentationController::class, 'telechargerPdf'])->name("goExperimentationPDF");

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('private', function() {
        return "Bonjour admin";
    });
});

Route::get('/user',[UsersController::class, 'show'])->name("goUser");

Route::get('/user/ajouter',[UsersController::class, 'create'])->name("goUserAjouter");

Route::post('/user/ajouter',[UsersController::class, 'store'])->name("goUserAjouter");

Route::get('/user/{user}',[UsersController::class, 'edit'])->name("goUserModifier");

Route::put('/user/{user}',[UsersController::class, 'update'])->name("goUserModifier");

Route::delete('/user/{user}',[UsersController::class, 'delete'])->name("goUserSupprimer");

Route::get('/user/{user}/affichage', [UsersController::class, 'affiche'])->name("goUserAffichage");

Route::get('search', [UsersController::class, 'search'])->name("goUserSearch");

Route::get('/filtre1', [UsersController::class, 'filtre'])->name("goUserFiltre");

Route::get('/recherche2', [UsersController::class, 'recherche'])->name("goUserRecherche");

Route::get('/thematique/ajouter',[ThematiqueController::class, 'create'])->name("goThematiqueAjouter");

Route::post('/thematique/ajouter',[ThematiqueController::class, 'store'])->name("goThematiqueAjouter");

Route::get('/etablissementtest', [EtablissementController::class, 'fake']);
