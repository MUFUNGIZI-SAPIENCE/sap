<?php 
if(session_start()==null)session_start();
require_once("./Class/Class.Classe.php");
require_once("./Class/Class.Option.php");
if(isset($_SESSION['agent'])){
    $_SESSION['prefet'] = $_SESSION['agent'];
}
if(isset($_SESSION['prefet'])){
    $donnee_prefet = null;
    foreach ($_SESSION['prefet'] as $value) {
        $donnee_prefet = $value;
    }
?>
<!DOCTYPE html>
<html>
<body id="page-top">
    <div id="wrapper">
<!-- debut de nav -->
<?php require_once('nav_prefecture.php') ?>
<!-- Fin de nav -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- en-tete -->                              
                <?php require_once('tete_prefecture.php');?>
                <!-- fin en-tete -->
            <!-- Partie principale commence ici -->
            <div class="container">
            <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/dogs/logo_billingue.jpg&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                        <div class="text-left card-heading">
                            <h4 class="text-primary">Formulaire d'inscription des élèves</h4>
                        </div>
                            <div class="">
                            <form class="" id="eleve" role="form">
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" id="nom" placeholder="Nom" name="nom">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" id="postnom" placeholder="Postnom" name="postnom">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" id="prenom" placeholder="Prénom" name="prenom">
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <select name="genre" id="genre" class="form-control">
                                            <option value="">-------</option>
                                            <option value="Feminin">Féminin</option>
                                            <option value="Masculin">Masculin</option>
                                        </select>
                                    </div>    
                                    <div class="form-group">
                                        <label for="classe">Classe</label>                                        
                                        <select name="classe" id="classe" class="form-control">
                                            <option value="">-------</option>
                                            <?php 
                                            foreach (GETClass::getClass() as $value) {
                                            ?>
                                                <option value="<?= $value['Numclasse']?>"><?= $value['Libelleclasse']?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="degre">Degré</label>
                                        <select name="degre" id="degre" class="form-control">
                                            <option value="">-------</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="div_option">
                                        <label for="option">Option</label>
                                        <select name="option" id="option" class="form-control">
                                            <option value="">-------</option>
                                            <?php 
                                            foreach (Option::getOption() as $value) {
                                            ?>
                                                <option value="<?= $value['NumOption']?>"><?= $value['LibelleOption']?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="fa fa-save btn btn-primary">&nbsp; Enregistrer</button>
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
            <!-- Partie principale se termine ici -->
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<?php require_once("pied.php");
}else{
    header("location:index.php");
}