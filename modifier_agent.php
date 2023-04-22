<?php
if(session_start()===null)session_start();
?>
<!DOCTYPE html>
<html>
<body id="page-top">
    <div id="wrapper">
        <!-- debut de nav -->
        <?php require_once('nav_gestionnaire.php') ?>
        <?php
if(isset($_SESSION['gestionnaire']))
{
    require_once('Class/Class.Agent.php');
    require_once("./Class/Class.Fonction.php");
        ?>
        <!-- Fin de nav -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- en-tete -->                              
        <?php require_once('tete_gestionnaire.php') ?>
                <!-- fin en-tete -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">FORMULAIRE DE MODIFICATION DES AGENTS</p>
                    </div>
                    <div class="card-body no-print">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="col-lg" style="overflow: scroll; height:80%">
                            <?php
                                $data_agent = null;
                                if(isset($_GET['Numagent']) && !empty($_GET['Numagent']) && is_int((int)$_GET['Numagent'])){
                                    $num_agent = htmlspecialchars($_GET['Numagent']);
                                    foreach (Agent::getAgent($_GET['Numagent']) as $value) {
                                    ?>
                                    <form class="user" id="agent" role="form">
                                            <div class="form-group">
                                                <input class="form-control form-control-user" value="<?= $value['Nomagent']?>" type="text" id="nomag" placeholder="Nom agent" name="nomag" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-user" value="<?= $value['Postnom']?>" type="text" id="postnomag" placeholder="Postnom agent" name="postnomag">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-user" value="<?= $value['Prenom']?>" type="text" id="prenomag" placeholder="Prénom agent" name="prenomag">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-user" value="<?= $value['Phoneagent']?>" type="tel" id="telephone" placeholder="Téléphone" name="telephone">
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
                                                <button class="fa fa-edit btn btn-primary">&nbsp; Modifier</button>
                                                <span id="resultat"></span>
                                            </div>
                                            <div class="form-group" id="resultat"></div>                            
                                        </form>
                                    <?php
                                    }
                                }
                                
                            ?>
                                
                            </div>
                            </div>
                        </div>
                        <div id="liste_eleve" class="table-responsive  mt-2 col-lg" id="dataTable" role="grid" aria-describedby="dataTable_info">
                         
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