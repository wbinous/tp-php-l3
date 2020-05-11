@include('header')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column">
                <div class="box">
                    <h1 class="title has-text-centered">Création d'un dossier étudiant</h1>
                    <form id="dossierForm" method="POST" action="{{ route('creerDossier') }}">
                        @if(isset($failure) & !empty($failure))
                        <div id="notifMsg" class="notification is-danger is-light">
                            <button id="btnDelete" class="delete"></button>
                            {{ $failure }}
                        </div>
                        @endif
                        {!! csrf_field() !!} 
                        
                        <div class="columns">
                            <div class="column has-text-centered"><label class="checkbox" for="classique"><input id="classique" name="classique" value="1" type="checkbox" @if(false) checked @endif>Classique</label></div>
                            <div class="column"></div>
                            <div class="column has-text-centered"><label class="checkbox" for="apprentissage"><input id="apprentissage" name="apprentissage" value="1" type="checkbox" @if(false) checked @endif>Apprentissage</label></div>
                        </div>

                        <div class="field">
                            <label for="formation">Formation</label>
                            <div class="control">
                                <div class="select">
                                    <select id="formation" name="formation">
                                        <option value="0" disabled selected>Selectionnez une formation...</option>
                                    @foreach($formations as $formation)
                                        <option value="{{ $formation->idFormation }}">{{ $formation->libelle }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-one-third"></div>
                                <div class="field is-grouped column is-one-third">
                                    <div class="control">
                                        <button type="submit" class="button is-link is-large">Déposer un dossier</button>
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
        $('#formation').change(function(event) {
            $('#formation').parent('.select').removeClass('is-danger');
        });

        $( "#dossierForm" ).submit(function(event) {
            event.preventDefault();
            let valid = true;

            if(this.formation.value == 0) {
                $('#formation').parent('.select').addClass('is-danger');
                valid = false;
            } else {
                $('#formation').parent('.select').removeClass('is-danger');
            }

            if(!(this.classique.checked || this.apprentissage.checked)) {
                alert('Veuillez choisir au moins un parcours !');
                valid = false;
            }

            if(valid) {
                this.submit();
            }
        });
    });
</script>
@include('footer')