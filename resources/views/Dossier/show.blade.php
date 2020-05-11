@include('header')

<section class="section">
    <div class="container">
        <h1 class="title">Mes dossiers</h1>
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
                    <td style="vertical-align:middle;" class="has-text-centered"><a href="{{ route('gererDossier') }}" class="button is-primary is-outlined">Gérer</a></td>
                    <td style="vertical-align:middle;" class="has-text-centered"><a @if($dossier['statut'] == 'Reçu incomplet en attente de complément') onclick="return confirm('Souhaitez-vous réellement supprimer ce groupe ?');" href="{{ route('supprimerDossier') }}" @endif class="button is-danger is-outlined" @if(!($dossier['statut'] == 'Reçu incomplet en attente de complément')) disabled @endif>Annuler</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="has-text-centered">
            <span>Vous n'avez aucun dossier pour le moment.</span>
        </div>
        <a href="{{ route('creerDossier') }}" class="inline-block button is-info">Déposer un nouveau dossier</a>
        @endif
    </div>
</section>
@include('footer')