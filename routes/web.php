<?php

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

/* Guest */
Route::group(['middleware' => ['guest']], function () {
    Route::post('/inscription', 'EtudiantController@inscrire')->name('inscriptionEtudiant');
    Route::post('/connexion', 'EtudiantController@connecter')->name('connexionEtudiant');
    Route::get('/inscription',  function() {
        return view('Etudiant/inscrire');
    })->name('inscriptionEtudiant');

    Route::get('/connexion',  function() {
        return view('Etudiant/connecter');
    })->name('connexionEtudiant');
});

/* Authenticated */
Route::group(['middleware' => ['auth']], function () {
    Route::post('/etudiant/modifier', 'EtudiantController@modifier')->name('modifierEtudiant');
    Route::post('/dossier/creer', 'DossierController@creer')->name('creerDossier');
    Route::post('/dossier/gerer', 'DossierController@gerer')->name('gererDossier');
    Route::post('/administration', 'AdminController@administration')->name('administrer');
    Route::post('/enseignant/modifierStatut/{id}', 'AdminController@modifierStatut')->name('changerStatut');

    Route::get('/etudiant/modifier',  function() {
        return view('Etudiant/modifier');
    })->name('modifierEtudiant');
    
    Route::get('/telecharger/{root}/{dossier?}/{fichier?}', function($root = NULL, $dossier = NULL, $fichier = NULL){
        $file_path = storage_path() .'/app/storage/'.$dossier.'/'. $fichier;
        if (file_exists($file_path)){
            return Response::download($file_path, $fichier, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
    })->where('fichier', '[A-Za-z0-9\-\_\.]+')->name('telechargerFichier');
    Route::get('/dossier', 'DossierController@show')->name('voirDossiers');
    Route::get('/dossier/gerer', 'DossierController@gerer')->name('gererDossier');
    Route::get('/dossier/supprimer', 'DossierController@supprimer')->name('supprimerDossier');
    Route::get('/dossier/creer', 'DossierController@creer')->name('creerDossier');
    Route::get('/', 'EtudiantController@index')->name('index');
    Route::get('/deconnexion', 'EtudiantController@deconnecter')->name('deconnexionEtudiant');

    Route::get('/enseignant/supprimer/{id}', 'AdminController@supprimer')->name('supprimerDossierEnseignant');
    Route::get('/enseignant/suivi/{id}', 'AdminController@suivre')->name('suivreDossier');
    Route::get('/administration', 'AdminController@administration')->name('administrer');
    Route::get('/enseignant/voir', 'AdminController@voirDossiers')->name('voirDossiersEnseignant');
});