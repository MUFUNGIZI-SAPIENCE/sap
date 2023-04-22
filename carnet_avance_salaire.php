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
        $_SESSION['caisse'] = $_SESSION['agent'];
    }
    if(isset($_SESSION['caisse'])){
        require_once("./Class/Class.Comptabilite.php");
        $donnee_comptable = null;
        foreach ($_SESSION['caisse'] as $value) {
            $donnee_comptable = $value;
        }
    ?>
    <!-- debut de nav -->
    <?php require_once('nav_caisse.php') ?>
    <!-- Fin de nav -->
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <!-- en-tete -->                              
                    <?php require_once('tete_caisse.php');?>
                    <!-- fin en-tete -->
                <!-- Partie principale commence ici -->
                <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">CARNET D'AVANCE SUR SALAIRE</p>
                    </div>
                    <div class="card-body col">
                        <span class="fa fa-print" onclick="imprimer('liste_avance')"></span>
                        <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <div class="col">
                            <!-- RAPPORT COMPTABLE -->
                            <div id="liste_avance">
                            <table class="table-bordered table-striped table-hover">
                                <thead class="text-center bg-dark text-white">
                                    <tr><th colspan="6">LISTE DES AVANCES</th></tr>
                                 <tr>
                                     <th>N°</th>
                                     <th>DATE</th>
                                     <th>IDENTITE</th>
                                     <th>OPERATION</th>
                                     <th>MONTANT</th>
                                 </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $num = 0;
                                    foreach (Comptabilite::carnetAvance_sur_salaire() as $value) {
                                        $num++;
                                    ?>
                                    <tr>
                                        <td><?= $num ?></a></td>
                                        <td><?= $value['DateOperation'] ?></a></td>
                                        <td><?=  strtoupper($value['Nomagent']." ".$value['Postnom'])." ".$value['Prenom']?></td>
                                        <td><?= $value['LibelleTypeOperation'] ?></a></td>
                                        <td><?= $value['montant']." ".$value['devise'] ?></td>
                                       
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
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