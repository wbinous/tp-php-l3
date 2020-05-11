<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;
use App\Dossiers;
use App\Etudiants;
use Illuminate\Http\UploadedFile;
use Auth;
use Redirect;

class DossierController extends Controller
{
    public function show() {
        if(Auth::user()->estEnseignant) return redirect()->route('voirDossiersEnseignant');
        $etudiant = Etudiants::find(Auth::user()->idEtudiant);
        $data['dossiers'] = Dossiers::find($etudiant->dossier);
        if(!empty($data['dossiers'])) $data['dossiers'] = [$data['dossiers']->toArray()];
        return view('Dossier/show', $data);
    }

    public function creer(Request $request) {
        $data['formations'] = Formation::all();
        $etudiant = Etudiants::find(Auth::user()->idEtudiant);
        if(!empty($etudiant->dossier)) return redirect()->back();
        if(!empty($request->all())) {
            try {
                $dossier = new Dossiers();
                $dossier->apprentissage = $request->input('apprentissage') ?? 0;
                $dossier->classique = $request->input('classique') ?? 0;
                $dossier->formation = $request->input('formation');
                $dossier->statut = 'Reçu incomplet en attente de complément';
                $dossier->save();
                $etudiant->dossier = $dossier->idDossier;
                $etudiant->save();
                return redirect()->route('gererDossier', $dossier->idDossier);
            } catch (\Illuminate\Database\QueryException $e) {
                $data['failure'] = 'Le dossier n\'a pu être créé, veuillez réessayer.';
                return view('Dossier/creer', $data);
            }
        }
        return view('Dossier/creer', $data);
    }

    public function gerer(Request $request) {
        $data['dossier'] = Dossiers::find(Auth::user()->dossier);
        if($request->method() == 'POST' && $data['dossier']->statut === "Reçu incomplet en attente de complément") {
            try {
                foreach($request->all() as $key => $champ) {
                    if($key == '_token' || $key == 'valider') continue;
                    if($request->hasFile($key)) {
                        $data['dossier']->$key = $champ->storeAs('storage/dossier_'.Auth::user()->dossier, $key.'.'.$champ->extension());
                    }
                }
                if(!empty($request->input('valider')) && $request->input('valider') == 'valider') $data['dossier']->statut = 'Reçu';
                if(!empty($request->input('message'))) $data['dossier']->commentaire = $request->input('message');
                $data['dossier']->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back();
            }
        }
        if(!empty($data['dossier'])) $data['dossier'] = $data['dossier']->toArray();
        return view('Dossier/gerer', $data);
    }

    public function supprimer() {
        /* On ne supprime aucun dossier. 
         On supprime juste la relation étudiant-dossier. 
         Les dossiers restent en base par securité. 
         On peut imaginer qu'un script tourne et supprimer tous les mois les anciens dossiers.
        */
        try {
            $user = Etudiants::where('dossier', Auth::user()->dossier)->first();
            $user->dossier = NULL; 
            $user->save();
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
        }
    }
}
