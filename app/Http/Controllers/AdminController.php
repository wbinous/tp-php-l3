<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;
use App\Dossiers;
use App\Etudiants;
use Illuminate\Http\UploadedFile;
use Auth;
use Redirect;

class AdminController extends Controller
{
    public function voirDossiers(Request $request) {
        $numDossiers = Etudiants::where('dossier', '!=', NULL)->pluck('dossier');
        if(!empty($dossiers)) $dossiers->toArray();
        $data['dossiers'] = Dossiers::whereIn('idDossier', $numDossiers)->where('statut', '!=', 'Reçu incomplet en attente de complément')->where('statut', '!=', 'Accepté')->where('statut', '!=', 'Refusé')->get();
        if(!empty($data['dossiers'])) $data['dossiers']->toArray();
        return view('Admin/voir', $data);
    }

    public function suivre($idDossier) {
        $data['dossier'] = Dossiers::find($idDossier);
        return view('Admin/suivre', $data);
    }

    public function modifierStatut(Request $request, $idDossier) {
        $dossier = Dossiers::find($idDossier);
        $dossier->statut = $request->input('statut');
        $dossier->save();
        return redirect()->back();
    }

    public function supprimer($idDossier) {
        /* On ne supprime aucun dossier. 
         On supprime juste la relation étudiant-dossier. 
         Les dossiers restent en base par securité. 
         On peut imaginer qu'un script tourne et supprimer tous les mois les anciens dossiers.
        */
        try {
            $user = Etudiants::where('dossier', $idDossier)->first();
            $user->dossier = NULL; 
            $user->save();
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
        }
    }

    public function administration(Request $request) {
        if($request->method() == 'POST') {
            try {
                $doublons = Etudiants::where('mail', $request->input('email'))->get();
                if(!$doublons->isEmpty()) return view('Etudiant/inscrire', ['failure' => 'L\'email a déjà été utilisé.']);
                $nouvelEtudiant = new Etudiants();
                $nouvelEtudiant->mail = $request->input('email');
                $nouvelEtudiant->nom = $request->input('nom');
                $nouvelEtudiant->prenom = $request->input('prenom');
                $nouvelEtudiant->numeroIdentite = '0';
                $nouvelEtudiant->dateNaissance = '1999-01-01';
                $nouvelEtudiant->adressePostale = '0';
                $nouvelEtudiant->tel = '0';
                $nouvelEtudiant->estEnseignant = true;
                $nouvelEtudiant->save();
                return view('Admin/administration', ['success' => 'Le compte a été ajouté avec succès !']);
            } catch(\Exception $e) {
                return view('Admin/administration', ['failure' => 'Echec de la création du compte. Veuillez réessayer.']);
            }
        }
        return view('Admin/administration');
    }
}
