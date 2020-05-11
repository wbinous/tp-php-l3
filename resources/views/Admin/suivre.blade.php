@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Dossier étudiant</h1>
                    <form id="dossierForm" enctype="multipart/form-data" method="POST" action="{{ route('changerStatut', $dossier['idDossier']) }}">
                        @if(isset($failure) & !empty($failure))
                        <div id="notifMsg" class="notification is-danger is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $failure }}
                        </div>
                        @endif
                        {!! csrf_field() !!} 
                        <div style="margin:10px;">
                            <span style="vertical-align: middle;vertical-align: -webkit-baseline-middle;">Statut : </span><div class="select">
                                <select name="statut">
                                    <option selected disabled>Choisir...</option>
                                    <option {{ ($dossier['statut'] == "Reçu") ? 'selected' : null }}>Reçu</option>
                                    <option {{ ($dossier['statut'] == "Reçu incomplet en attente de complément") ? 'selected' : null }}>Reçu incomplet en attente de complément</option>
                                    <option {{ ($dossier['statut'] == "Liste d’attente") ? 'selected' : null }}>Liste d’attente</option>
                                    <option {{ ($dossier['statut'] == "Validé complet") ? 'selected' : null }}>Validé complet</option>
                                    <option {{ ($dossier['statut'] == "Entretien") ? 'selected' : null }}>Entretien</option>
                                    <option {{ ($dossier['statut'] == "Accepté") ? 'selected' : null }}>Accepté</option>
                                    <option {{ ($dossier['statut'] == "Refusé") ? 'selected' : null }}>Refusé</option>
                                </select>
                                </div>
                            
                            <div style="margin: 10px;" class="columns">
                                <div class="column"><p>Classique : {{ ($dossier['classique']) ? 'Oui' : 'Non' }}</p></div>
                                <div class="column"><p style="text-align:right;">Apprentissage : {{ ($dossier['apprentissage']) ? 'Oui' : 'Non' }}</p></div>
                            </div>
                        </div>

                        <h2 class="title is-3 has-text-info">Pièces du dossier</h2>

                        <table class="table is-bordered is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        CV
                                    </td>
                                    <td style="vertical-align: middle;">
                                    <p>{{ explode('/',$dossier['cv'])[2] }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['cv'])) href="{{ route('telechargerFichier', $dossier['cv']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['cv'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Lettre de motivation
                                    </td>
                                    <td style="vertical-align: middle;">
                                    <p>{{ explode('/',$dossier['lettreMotivation'])[2] }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['lettreMotivation'])) href="{{ route('telechargerFichier', $dossier['lettreMotivation']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['lettreMotivation'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Relevés de notes de l’année précédente
                                    </td>
                                    <td style="vertical-align: middle;">
                                    <p>{{ explode('/', $dossier['releveNotes'])[2] }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['releveNotes'])) href="{{ route('telechargerFichier', $dossier['releveNotes']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['releveNotes'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Imprime écran de l’ENT de l’année en cours
                                    </td>
                                    <td style="vertical-align: middle;">
                                    <p>{{ explode('/',$dossier['imprimeEcranENT'])[2] }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['imprimeEcranENT'])) href="{{ route('telechargerFichier', $dossier['imprimeEcranENT']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['imprimeEcranENT'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Formulaire d’inscription rempli
                                    </td>
                                    <td style="vertical-align: middle;">
                                    <p>{{ explode('/',$dossier['formulaireInscription'])[2] }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['formulaireInscription'])) href="{{ route('telechargerFichier', $dossier['formulaireInscription']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['formulaireInscription'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Pièce d’identité en cours de validité
                                    </td>
                                    <td style="vertical-align: middle;">
                                    <p>{{ explode('/',$dossier['pieceIdentite'])[2] }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['pieceIdentite'])) href="{{ route('telechargerFichier', $dossier['pieceIdentite']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['pieceIdentite'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h2 class="title is-3 has-text-info">Message</h2>
                        <article class="message is-info">
                            <div class="message-body">
                                @if(empty($dossier['commentaire']))
                                    L'étudiant n'a pas laissé de message.
                                @else
                                    {{ $dossier['commentaire'] }}
                                @endif
                            </div>
                        </article>
                        
                        <div class="columns">
                            <div class="column is-one-third"></div>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button type="submit" class="button is-link is-large">Changer le statut</button>
                                </div>
                            </div>
                            <div class="column is-one-third"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="column is-one-quarter"></div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#btnDelete').click(function(event) {
            event.preventDefault();
            $('#notifMsg').toggle();
        });

        $('.file-input').change(function(event) {
            $(this).closest('tr').children().find('.deletePj').first()[0].disabled = false;
        });

        $('.deletePj').click(function(event) {
            event.preventDefault();
            $(this).closest('tr').children().find('.file-input').first().val('');
            $(this)[0].disabled = true;
        });
    });
</script>
@include('footer')