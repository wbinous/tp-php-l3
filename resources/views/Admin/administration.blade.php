@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Ajout de comptes enseignants</h1>

                    <form id="registerForm" method="POST" action="{{ route('administrer') }}">
                        @if(isset($failure) & !empty($failure))
                        <div id="notifMsg" class="notification is-danger is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $failure }}
                        </div>
                        @endif
                        @if(isset($success) & !empty($success))
                        <div id="notifMsg" class="notification is-success is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $success }}
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
                            <label class="label">Email de connexion</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="email" class="input" type="email" placeholder="test@fake.com" required>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help">Le mot de passe sera choisi à la première connexion.</p>
                        </div>

                        <div class="columns">
                            <div class="column is-one-third"></div>
                                <div class="field is-grouped column is-one-third">
                                    <div class="control">
                                        <button type="submit" class="button is-link is-large">Créer</button>
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