@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Modifier le profile</h1>

                    <form method="POST" action="{{ route('modifierEtudiant') }}">
                        @if(isset($failure) & !empty($failure))
                        <div id="notifMsg" class="notification is-danger is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $failure }}
                        </div>
                        @endif
                        {!! csrf_field() !!}
                        <div class="field">
                            <label class="label">Nom</label>
                            <div class="control has-icons-left has-icons-right">
                                <input value="{{ Auth::user()->nom }}" name="nom" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Prenom</label>
                            <div class="control has-icons-left has-icons-right">
                                <input value="{{ Auth::user()->prenom }}" name="prenom" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                            </div>
                        </div>

                        <fieldset disabled>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input value="{{ Auth::user()->mail }}" name="email" class="input" type="email" placeholder="test@fake.com" required readonly>
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help">Ce champ est unique, il ne peut être modifié.</p>
                            </div>
                        </fieldset>
                        <div class="field">
                            <label class="label">Numero d'identité</label>
                            <div class="control has-icons-left has-icons-right">
                                <input value="{{ Auth::user()->numeroIdentite }}" name="numeroIdentite" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-address-card"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Date de naissance</label>
                            <div class="control has-icons-left has-icons-right">
                                <input value="{{ Auth::user()->dateNaissance }}" name="dateNaissance" class="input" type="date" min="{{ date('Y-m-d', strtotime('-100 year')) }}" max="{{ date('Y-m-d', strtotime('-16 year')) }}" required>
                                <span class="icon is-small is-left"><i class="fas fa-birthday-cake"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Adresse postale</label>
                            <div class="control has-icons-left has-icons-right">
                                <input value="{{ Auth::user()->adressePostale }}" name="adressePostale" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-home"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Téléphone</label>
                            <div class="control has-icons-left has-icons-right">
                                <input value="{{ Auth::user()->tel }}" name="tel" class="input" type="text" maxlength="10" required>
                                <span class="icon is-small is-left"><i class="fas fa-phone"></i></span>
                            </div>
                        </div>

                        
                        <div class="columns">
                            <div class="column is-one-third"></div>
                                <div class="field is-grouped column is-one-third">
                                    <div class="control">
                                        <button type="submit" class="button is-link is-large">Valider</button>
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
    });
</script>
@include('footer')