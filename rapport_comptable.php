<?php 
use Componere\Value;
if(session_start()==null)session_start();
    ?>
    <!DOCTYPE html>
    <html>
    <body id="page-top">
        <div id="wrapper">
        <?php 
    // if(session_start()==null)session_start();
    if(isset($_SESSION['agent'])){
        $_SESSION['comptable'] = $_SESSION['agent'];
    }
    if(isset($_SESSION['comptable'])){
        require_once("./Class/Class.Comptabilite.php");
        $donnee_comptable = null;
        foreach ($_SESSION['comptable'] as $value) {
            $donnee_comptable = $value;
        }
    ?>
    <!-- debut de nav -->
    <?php require_once('nav_comptable.php') ?>
    <!-- Fin de nav -->
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <!-- en-tete -->                              
                    <?php require_once('tete_comptable.php');?>
                    <!-- fin en-tete -->
                <!-- Partie principale commence ici -->
                <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">OPERATIONS COMPTABLE</p>
                    </div>
                    <div class="card-body col">
                        <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <div class="col">
                            <!-- RAPPORT COMPTABLE -->
                            <div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><a class="nav-link" href="liste_compte.php"><i class="fas fa-list"></i><span>&nbsp; Liste des comptes</span></a></td>
                                        <td><a class="nav-link" href="journal.php"><i class="fas fa-list"></i><span>&nbsp; Journal des opérations</span></a></td>
                                        <td><a class="nav-link" href="bilan.php"><i class="fas fa-book-open"></i><span>&nbsp; Bilan de l'exercice</span></a></td>
                                        <td><a class="nav-link" id="link_releve" href="#"><i class="fas fa-book"></i><span>&nbsp; Rélevé de compte</span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <!-- RELEVE DE COMPTE -->
                            <table class="">
                                <tbody>
                                    <tr>
                                        <th>
                                            <div id="div_type_releve">
                                                <div class="rows" >
                                                    <label for="">Choisissez une catégorie</label>
                                                    <select class="form-control" name="" id="categorie_releve">
                                                    <option value="">.....................</option>   
                                                    <option value="1">Rélevé de compte pour agent</option>
                                                    <option value="2">Rélevé de compte pour élève</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="div_code_agent">
                                                    <label for=""></label>
                                                    <input type="text" id="code_agent" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Code agent">
                                                </div>
                                                <div class="form-group" id="div_code_eleve">
                                                    <label for=""></label>
                                                    <input type="text" id="code_eleve" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Code élève">
                                                </div>
                                                &nbsp;
                                                <button type="button" id="btn_afficher_releve" class="btn btn-primary"><span class=""></span> Afficher</button>
                                                <span id="resultat"></span>
                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        <div id="div_releve">
                            
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Partie principale se termine ici -->
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <?php require_once("pied.php");
}else{
    header("location:index.php");
}