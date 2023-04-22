<?php
if(session_start()==null)session_start();
if(isset($_SESSION['gestionnaire'])){
    require_once('tete_gestionnaire.php');
    require_once("./Class/Class.Fonction.php");
    // require_once("./Class/Class.Qualite.php");
    // require_once("tete_gestionnaire.php");
    
?>
<div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <!-- <div class="flex-grow-1 bg-register" style="background: url(&quot;assets/img/dogs/logo_billingue.jpg&quot;);"></div> -->
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-left">
                                <h4 class="text-dark mb-4">Formulaire d'enregistrement des agents</h4>
                            </div>
                            <div class="col-lg">
                                <form class="user" id="agent" role="form">
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" id="nomag" placeholder="Nom agent" name="nomag" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" id="postnomag" placeholder="Postnom agent" name="postnomag">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" id="prenomag" placeholder="Prénom agent" name="prenomag">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="tel" id="telephone" placeholder="Téléphone" name="telephone">
                                    </div>
                                    <div class="form-group">
                                        <label for="genreag">Genre</label>
                                        <select name="genreag" id="genreag" class="form-control">
                                            <option value="">-------</option>
                                            <option value="Feminin">Féminin</option>
                                            <option value="Masculin">Masculin</option>
                                        </select>
                                    </div>    
                                    <div class="form-group" id="div_fonction">
                                        <label for="fonction">Fonction</label>
                                        <select name="fonction" id="fonction" class="form-control">
                                            <option value="">-------</option>
                                            <?php 
                                            foreach (Fonction::getFonction() as $value) {
                                            ?>
                                                <option value="<?= $value['Numfonction']?>"><?= $value['Libellefonction']?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="password" id="password" placeholder="Mot de passe" name="password">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="password" id="confirm_password" placeholder="Confirmer mot de passe" name="confirm_password">
                                    </div>
                                    <div class="form-group">
                                        <button class="fa fa-save btn btn-primary">&nbsp; Enregistrer</button>
                                        <span id="resultat"></span>
                                    </div>
                                    <div class="form-group" id="resultat"></div>                            
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once('pied.php');
}else{
    header('location:index.php');
}
