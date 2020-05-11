<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Etudiants;
use Redirect;
use Auth;

class EtudiantController extends Controller
{
    public function index() {
        return view('Etudiant/index');
    }

    public function inscrire(Request $request) {
        if($request->method() == 'POST' && !empty($request->input('email'))) { // check si le form a été soumis
            
            // On vérifie l'unicité de l'email
            try {
                $doublons = Etudiants::where('mail', $request->input('email'))->get();
                if(!$doublons->isEmpty()) return view('Etudiant/inscrire', ['failure' => 'Votre email a déjà été utilisée.']);

                $nouvelEtudiant = new Etudiants();
                $nouvelEtudiant->nom = $request->input('nom');
                $nouvelEtudiant->prenom = $request->input('prenom');
                $nouvelEtudiant->numeroIdentite = $request->input('numeroIdentite');
                $nouvelEtudiant->dateNaissance = $request->input('dateNaissance');
                $nouvelEtudiant->adressePostale = $request->input('adressePostale');
                $nouvelEtudiant->tel = $request->input('tel');
                $nouvelEtudiant->mail = $request->input('email');
                $isSaved = $nouvelEtudiant->save();
            } catch(\Exception $e) {
                return view('Etudiant/inscrire', ['failure' => 'Echec de la création de votre compte. Veuillez réessayer.']);
            }
            if($isSaved) return Redirect::route('connexionEtudiant');
        }
        return view('Etudiant/inscrire', ['failure' => 'Echec, veuillez vérifier vos informations et réessayer.']);
    }

    public function connecter(Request $request) {
        if($request->method() == 'POST' && !empty($request->input('login')) && !empty($request->input('motDePasse'))) { // check si le form a été soumis
            
            // On vérifie que l'utilisateur existe... 
            $utilisateur = Etudiants::where('mail', $request->input('login'))->first();
            if(empty($utilisateur)) return view('Etudiant/connecter', ['failure' => 'L\'utilisateur est introuvable.']);
            // Que le mot de passe respecte la règle html de longueur minimum...
            if(strlen($request->input('motDePasse')) < 6) return view('Etudiant/connecter', ['failure' => 'Le mot de passe est trop court.']);

            if(empty($utilisateur->motDePasse)) { // On ajoute le mot de passe du nouvel utilisateur
                $utilisateur->motDePasse = Hash::make($request->input('motDePasse'));
                $utilisateur->save();
            }

            // faire la session
            if (Auth::attempt(['mail' => $request->input('login'), 'password' => $request->input('motDePasse')], $request->input('remember_me') ?? false)) {
                return redirect()->route('voirDossiers');
            } else {
                return view('Etudiant/connecter', ['failure' => 'Le mot de passe est incorrect']);
            }
        }
        return back();
    }

    public function modifier(Request $request) {
        if($request->method() == 'POST') { // check si le form a été soumis
            // On vérifie l'unicité de l'email
            try {
                $nouvelEtudiant = Etudiants::find(Auth::user()->idEtudiant);
                $nouvelEtudiant->nom = $request->input('nom');
                $nouvelEtudiant->prenom = $request->input('prenom');
                $nouvelEtudiant->numeroIdentite = $request->input('numeroIdentite');
                $nouvelEtudiant->dateNaissance = $request->input('dateNaissance');
                $nouvelEtudiant->adressePostale = $request->input('adressePostale');
                $nouvelEtudiant->tel = $request->input('tel');
                $isSaved = $nouvelEtudiant->save();
            } catch(\Exception $e) {
                return view('Etudiant/modifier', ['failure' => 'Echec de la mise à jour de votre compte. Veuillez réessayer.']);
            }
            if($isSaved) return Redirect::back();
        }
        return view('Etudiant/modifier', ['failure' => 'Echec, veuillez vérifier vos informations et réessayer.']);
    }
    
    public function deconnecter() {
        Auth::logout();
        return Redirect::route('index');
    }
}
