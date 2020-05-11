@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Connexion</h1>

                    <form method="POST" action="{{ route('connexionEtudiant') }}">
                        @if(isset($failure) & !empty($failure))
                        <div id="notifMsg" class="notification is-danger is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $failure }}
                        </div>
                        @endif
                        {!! csrf_field() !!}

                        <div class="field">
                            <label class="label">Identifiant</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="login" class="input" type="email" placeholder="test@fake.com" required>
                                <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Mot de passe</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="motDePasse" class="input" type="password" minlength="6" required>
                                <span class="icon is-small is-left"><i class="fas fa-unlock"></i></span>
                            </div>
                            <p class="help">Si c'est votre première connexion, le mot de passe entré sera votre nouveau mot de passe.</p>
                        </div>


                        <label class="checkbox"><input name="remember_me" value="true" type="checkbox">Remember me</label>
                        
                        <div class="columns">
                            <div class="column is-one-third"></div>
                                <div class="field is-grouped column is-one-third">
                                    <div class="control">
                                        <button type="submit" class="button is-link">Se connecter</button>
                                    </div>
                                    <div class="control">
                                        <a href="{{ route('inscriptionEtudiant') }}" class="button is-primary is-light">S'inscrire</a>
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