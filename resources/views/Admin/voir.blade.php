@include('header')
<section class="section">
    <div class="container">
        <h1 class="title">Les dossiers validés non traités</h1>
        @if(!empty($dossiers))
        <table class="table table is-bordered table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Formation</th>
                    <th>Classique</th>
                    <th>Apprentissage</th>
                    <th>Statut</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dossiers as $dossier)
                <tr>
                    <td style="vertical-align:middle;" class="has-text-centered">{{ $dossier['idDossier'] }}</td>
                    <td style="vertical-align:middle;" class="has-text-centered">{{ $dossier['formation'] }}</td>
                    <td style="vertical-align:middle;" class="has-text-centered">{{ ($dossier['classique']) ? 'Oui' : 'Non' }}</td>
                    <td style="vertical-align:middle;" class="has-text-centered">{{ ($dossier['apprentissage']) ? 'Oui' : 'Non' }}</td>
                    <td style="vertical-align:middle;" class="has-text-centered"><span class="tag is-info is-light">{{ $dossier['statut'] }}</span></td>
                    <td style="vertical-align:middle;" class="has-text-centered"><a href="{{ route('suivreDossier', $dossier['idDossier']) }}" class="button is-primary is-outlined">Voir</a></td>
                    <td style="vertical-align:middle;" class="has-text-centered"><a onclick="return confirm('Souhaitez-vous réellement supprimer ce groupe ?');" href="{{ route('supprimerDossierEnseignant', $dossier['idDossier']) }}" class="button is-danger is-outlined">Annuler</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="has-text-centered">
            <span>Aucun dossier validé non traité pour le moment.</span>
        </div>
        @endif
    </div>
</section>
@include('footer')