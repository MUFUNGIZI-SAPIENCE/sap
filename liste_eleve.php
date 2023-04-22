<?php
require_once('Class/Class.Eleve.php');
require_once('Class/Class.Classe.php');
require_once("./Class/Class.Option.php");
if(session_start()===null)session_start();
?>
<!DOCTYPE html>
<html>
<body id="page-top">
    <div id="wrapper">
        <!-- debut de nav -->
        <?php require_once('nav_prefecture.php') ?>
        <?php
if(isset($_SESSION['prefet']))
{
        ?>
        <!-- Fin de nav -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- en-tete -->                              
        <?php require_once('tete_prefecture.php') ?>
                <!-- fin en-tete -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">LISTE DES ELEVES</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-md-left dataTables_filter form-inline" id="dataTable_filter">
                                    <span class="btn-group form-control-md">
                                        <input type="search" class="form-control" aria-controls="dataTable" placeholder="Recherche...">
                                        <button class="form-control  fa fa-search btn btn-primary" type="button"></button>
                                    </span>
                                    &nbsp;                                   
                                    <button onclick="imprimer('liste_eleve')" class="form-control form-control-sm fa fa-print btn btn-primary" type="button"></button>
                                </div>
                            </div>
                        </div>
                        <div id="liste_eleve" class="table-responsive  mt-2 col-lg" id="dataTable" role="grid" aria-describedby="dataTable_info">
                          
                        <table class="table-bordered table-hover table-responsive dataTable my-0 table-responsive" id="dataTable">
                                <thead class="bg-primary text-center text-white">
                                    <tr>
                                        <th colspan="7">LISTE DES ELEVES</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>NOM</th>
                                        <th>POSTNOM</th>
                                        <th>PRENOM</th>
                                        <th>CLASSE</th>
                                        <th>GENRE</th>
                                        <th>MATRICULE</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-dark text-white text-justify">
                                    <?php
                                    foreach (Eleve::listeEleve() as $key => $value) {
                                    ?>
                                    <tr>
                                        <td>
                                        <div class="btn-group">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-align-justify text-white"></i> 
                                                <i class="caret text-white"></i>
                                            </button>
                                                <ul class="dropdown-menu"> 
                                                    <li><a id="modif_eleve_link" onclick="get_data_modif('<?= $value['Matriceleve']?>')" href="#"><i class="fa fa-edit"></i>&nbsp;Modifier</a></li>
                                                </ul>
                                        </div>

                                        </td>
                                        <td><?= strtoupper($value['Nomeleve'])?></td>
                                        <td><?= strtoupper($value['Postnomeleve'])?></td>
                                        <td><?= $value['Prenomeleve']?></td>
                                        <td>
                                            <?php 
                                                if($value['degre']==1)
                                                    echo $value['degre']." ère ".$value['Libelleclasse']." ".$value['LibelleOption'];
                                                else
                                                echo $value['degre']." ème ".$value['Libelleclasse']." ".$value['LibelleOption'];
                                            ?>
                                        </td>
                                        <td><?= $value['Sexeeleve']?></td>
                                        <td><?= $value['Matriceleve']?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>                                
                                    
                                </tbody>
                            </table>
                        </div>
                                <!-- FORMULAIRE DE MODIFICATION DES ELEVES -->
                    <div id="form_modif_eleve" class="col-lg-7 card" >
                        <a class="pull-right" id="close" href="#">Fermer</a>
                    <div class="text-left card-heading">
                        <h4 class="text-default">Formulaire de modification</h4>
                    </div>
                        <div class="">
                            <div class="col-lg-9">
                                <form class="user" id="modif_eleve" role="form">
                                    <input type="hidden" name="matriculeEleve" id="matriculeEleve">
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
                                        <button type="submit" class="fa fa-edit btn btn-primary">&nbsp; Modifier</button>
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