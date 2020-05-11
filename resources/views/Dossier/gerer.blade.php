@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Dossier étudiant</h1>
                    <form id="dossierForm" enctype="multipart/form-data" method="POST" action="{{ route('gererDossier') }}">
                        @if(isset($failure) & !empty($failure))
                        <div id="notifMsg" class="notification is-danger is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $failure }}
                        </div>
                        @endif
                        {!! csrf_field() !!} 
                        <div style="margin:10px;">
                            <p>Statut : <span class="tag is-info is-light">{{ $dossier['statut'] }}</span></p>
                            <div class="columns">
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
                                    @if($dossier['statut'] === 'Reçu incomplet en attente de complément')
                                        <div class="field">
                                            <div class="file is-small is-boxed">
                                                <label class="file-label">
                                                    <input accept=".odt, .doc, .docx,application/pdf, image/*" class="file-input" type="file" name="cv">
                                                    <span class="file-cta">
                                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                        <span class="file-label">Choisir un fichier...</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                    <p>{{ explode('/',$dossier['cv'])[2] }}</p>
                                    @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['cv'])) href="{{ route('telechargerFichier', $dossier['cv']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['cv'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="button is-danger is-outlined is-small deletePj" disabled>
                                            <span>Supprimer</span><span class="icon is-small"><i class="fas fa-times"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Lettre de motivation
                                    </td>
                                    <td style="vertical-align: middle;">
                                    @if($dossier['statut'] === 'Reçu incomplet en attente de complément')
                                        <div class="field">
                                            <div class="file is-small is-boxed">
                                                <label class="file-label">
                                                    <input accept=".odt, .doc, .docx,application/pdf, image/*" class="file-input" type="file" name="lettreMotivation">
                                                    <span class="file-cta">
                                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                        <span class="file-label">Choisir un fichier...</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                    <p>{{ explode('/',$dossier['lettreMotivation'])[2] }}</p>
                                    @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['lettreMotivation'])) href="{{ route('telechargerFichier', $dossier['lettreMotivation']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['lettreMotivation'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="button is-danger is-outlined is-small deletePj" disabled>
                                            <span>Supprimer</span><span class="icon is-small"><i class="fas fa-times"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Relevés de notes de l’année précédente
                                    </td>
                                    <td style="vertical-align: middle;">
                                    @if($dossier['statut'] === 'Reçu incomplet en attente de complément')
                                        <div class="field">
                                            <div class="file is-small is-boxed">
                                                <label class="file-label">
                                                    <input accept=".odt, .doc, .docx,application/pdf, image/*" class="file-input" type="file" name="releveNotes">
                                                    <span class="file-cta">
                                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                        <span class="file-label">Choisir un fichier...</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                    <p>{{ explode('/', $dossier['releveNotes'])[2] }}</p>
                                    @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['releveNotes'])) href="{{ route('telechargerFichier', $dossier['releveNotes']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['releveNotes'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="button is-danger is-outlined is-small deletePj" disabled>
                                            <span>Supprimer</span><span class="icon is-small"><i class="fas fa-times"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Imprime écran de l’ENT de l’année en cours
                                    </td>
                                    <td style="vertical-align: middle;">
                                    @if($dossier['statut'] === 'Reçu incomplet en attente de complément')
                                        <div class="field">
                                            <div class="file is-small is-boxed">
                                                <label class="file-label">
                                                    <input accept=".odt, .doc, .docx,application/pdf, image/*" class="file-input" type="file" name="imprimeEcranENT">
                                                    <span class="file-cta">
                                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                        <span class="file-label">Choisir un fichier...</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                    <p>{{ explode('/',$dossier['imprimeEcranENT'])[2] }}</p>
                                    @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['imprimeEcranENT'])) href="{{ route('telechargerFichier', $dossier['imprimeEcranENT']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['imprimeEcranENT'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="button is-danger is-outlined is-small deletePj" disabled>
                                            <span>Supprimer</span><span class="icon is-small"><i class="fas fa-times"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Formulaire d’inscription rempli
                                    </td>
                                    <td style="vertical-align: middle;">
                                    @if($dossier['statut'] === 'Reçu incomplet en attente de complément')
                                        <div class="field">
                                            <div class="file is-small is-boxed">
                                                <label class="file-label">
                                                    <input accept=".odt, .doc, .docx,application/pdf, image/*" class="file-input" type="file" name="formulaireInscription">
                                                    <span class="file-cta">
                                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                        <span class="file-label">Choisir un fichier...</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                    <p>{{ explode('/',$dossier['formulaireInscription'])[2] }}</p>
                                    @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['formulaireInscription'])) href="{{ route('telechargerFichier', $dossier['formulaireInscription']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['formulaireInscription'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="button is-danger is-outlined is-small deletePj" disabled>
                                            <span>Supprimer</span><span class="icon is-small"><i class="fas fa-times"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        Pièce d’identité en cours de validité
                                    </td>
                                    <td style="vertical-align: middle;">
                                    @if($dossier['statut'] === 'Reçu incomplet en attente de complément')
                                        <div class="field">
                                            <div class="file is-small is-boxed">
                                                <label class="file-label">
                                                    <input accept=".odt, .doc, .docx,application/pdf, image/*" class="file-input" type="file" name="pieceIdentite">
                                                    <span class="file-cta">
                                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                        <span class="file-label">Choisir un fichier...</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                    <p>{{ explode('/',$dossier['pieceIdentite'])[2] }}</p>
                                    @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a @if(!empty($dossier['pieceIdentite'])) href="{{ route('telechargerFichier', $dossier['pieceIdentite']) }}" @endif class="button is-primary is-outlined is-small" @if(empty($dossier['pieceIdentite'])) disabled @endif>
                                            <span class="icon"><i class="fas fa-eye"></i></span>
                                            <span>Voir</span>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="button is-danger is-outlined is-small deletePj" disabled>
                                            <span>Supprimer</span><span class="icon is-small"><i class="fas fa-times"></i></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h2 class="title is-3 has-text-info">Message</h2>
                        <article class="message is-info">
                            <div class="message-body">
                                @if(empty($dossier['commentaire']))
                                    Vous n'avez pas écrit de message.
                                @else
                                    {{ $dossier['commentaire'] }}
                                @endif
                            </div>
                        </article>
                        @if($dossier['statut'] == 'Reçu incomplet en attente de complément')
                        <div class="field">
                            <div class="control">
                                <textarea name="message" class="textarea is-info" placeholder="Laissez un message..."></textarea>
                            </div>
                        </div>
                        <div class="columns">
                            @if(!empty($dossier['cv']) && !empty($dossier['lettreMotivation']) && !empty($dossier['releveNotes']) && !empty($dossier['imprimeEcranENT']) && !empty($dossier['formulaireInscription']) && !empty($dossier['pieceIdentite']))
                                <div class="column is-one-quarter"></div>
                                <div class="field is-grouped column is-one-quarter">
                                    <div class="control">
                                        <button type="submit" class="button is-link is-large">Modifier</button>
                                    </div>
                                </div>
                                <div class="field is-grouped column is-one-quarter">
                                    <div class="control">
                                        <button name="valider" value="valider" type="submit" class="button is-success is-large">Valider</button>
                                    </div>
                                </div>
                                <div class="column is-one-quarter"></div>
                            @else
                                <div class="column is-one-third"></div>
                                <div class="field is-grouped column is-one-third">
                                    <div class="control">
                                        <button type="submit" class="button is-link is-large">Modifier</button>
                                    </div>
                                </div>
                                <div class="column is-one-third"></div>
                            @endif
                        </div>
                        @else
                        <div>
                            <p class="has-text-centered">Le dossier a été validé, il ne peut plus être modifié.</p>
                        </div>
                        @endif
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