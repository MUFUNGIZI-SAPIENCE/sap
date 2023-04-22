<?php 
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
        require_once("Class/Class.Agent.php");
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
                        <p class="text-white m-0 font-weight-bold ">OPERATION COMPTABLE</p>
                    </div>
                    <div class="card-body col">
                        <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <div class="row col">
                            <div>
                                <table class="">
                                    <tbody>
                                        <tr>
                                        <td><a class="nav-link" href="ajout_compte.php"><i class="fas fa-table"></i><span>&nbsp; Ajouter des comptes</span></a></td>
                                            <td><a class="nav-link" href="creer_compte.php"><i class="fas fa-user"></i><span>&nbsp; Créer un compte élève ou agent</span></a></td>
                                            <td><a class="nav-link" href="" id="link_charger_compte_agent"><i class="fa fa-money-bill-alt"></i><span>&nbsp;Charger le compte des agents</span></a></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- PARTIE DU TABLEAU POUR ALIMENTER LE COMPTE DES AGENTS -->
                        <div role="grid" id="div_charger_compte_agent">
                            <table class="table-stripted table-bordered table-hover">
                                <thead>
                                <tr class="bg-dark text-white text-center"><th colspan="5">LISTE DES AGENTS</th></tr>
                                    <tr class="bg-dark text-white text-center">
                                        <th>N°</th>
                                        <th>IDENTITE</th>
                                        <th>FONCTION</th>
                                        <th>CODE AGENT</th>
                                        <th>MONTANT A CHARGER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $num = 0;
                                    foreach (Agent::listeAgent() as $value) {
                                        $num++;
                                    ?>
                                    <tr>
                                        <td><?=$num?></td>
                                        <td><?= strtoupper($value['Nomagent']." ".$value['Postnom'])." ".$value['Prenom']?></td>
                                        <td><?= $value['Libellefonction']?></td>
                                        <td><?= $value['Codeagent']?></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control input-col-md-3" name="montant<?=$value['Numagent']?>" aria-describedby="helpId" placeholder="Montant ici">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                   
                                </tbody>
                            </table>
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