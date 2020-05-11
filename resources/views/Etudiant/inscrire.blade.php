@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Inscription étudiant</h1>

                    <form id="registerForm" method="POST" action="{{ route('inscriptionEtudiant') }}">
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
                                <input name="nom" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Prenom</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="prenom" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="email" class="input" type="email" placeholder="test@fake.com" required>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help">Cet email sera votre identifiant de connexion, il doit être unique.</p>
                        </div>

                        <div class="field">
                            <label class="label">Numero d'identité</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="numeroIdentite" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-address-card"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Date de naissance</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="dateNaissance" class="input" type="date" value="2000-01-01" min="1900-01-01" max="2002-01-01" required>
                                <span class="icon is-small is-left"><i class="fas fa-birthday-cake"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Adresse postale</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="adressePostale" class="input" type="text" required>
                                <span class="icon is-small is-left"><i class="fas fa-home"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Téléphone</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="tel" name="tel" class="input" type="text" maxlength="10" required>
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

        $("#registerForm").submit(function(event) {
            event.preventDefault();
            let valid = true;

            if(!/^\d+$/.test(this.tel.value)) {
                $('#tel').addClass('is-danger');
                valid = false;
            } else {
                $('#tel').removeClass('is-danger');
            }

            if(valid) {
                this.submit();
            }
        });
    });
</script>
@include('footer')