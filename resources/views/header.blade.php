<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion des dossiers étudiants</title>
        <meta name="description" content="TP PHP de Wassim Binous">
        <meta name="author" content="Wassim Binous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>

    <body>
        <nav class="navbar is-info" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="mainNavBar">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="mainNavBar" class="navbar-menu">
                <div class="navbar-start">
                    @if(Auth::check())
                        @if(Auth::user()->estAdministrateur) <a href="{{ route('administrer') }}" class="navbar-item">Administration</a> @endif
                        @if(Auth::user()->estAdministrateur || Auth::user()->estEnseignant) <a href="{{ route('voirDossiersEnseignant') }}" class="navbar-item">Enseignant</a> @endif
                        @if(!(Auth::user()->estAdministrateur || Auth::user()->estEnseignant))
                        <a href="{{ route('voirDossiers') }}" class="navbar-item">Voir mes dossiers</a>
                        <a href="{{ route('modifierEtudiant') }}" class="navbar-item">Editer le profile</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        @if(Auth::guest())
                        <a href="{{ route('inscriptionEtudiant') }}" class="button is-primary"><strong>S'inscrire</strong></a>
                        <a href="{{ route('connexionEtudiant') }}" class="button is-light">Se connecter</a>
                        @else
                            <a href="{{ route('deconnexionEtudiant') }}" class="button is-light">Deconnexion</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>