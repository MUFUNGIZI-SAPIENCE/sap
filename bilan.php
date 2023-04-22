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
                            <table class="table-bordered">
                                <thead>
                                    <tr><th colspan="2" class="text-center">BILAN DE L'EXERCICE</th></tr>
                                    <tr><th class="text-center" colspan="3">ACTIF</th></tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sommeActif = 0;
                                        $sommePassif = 0;
                                        foreach (Comptabilite::bilan() as $value) {
                                            // ACTIF DU BILAN
                                            if($value['Num_sous_type_compte']==1){
                                                $sommeActif += $value['montant'];
                                                ?>
                                                    <tr><td><?= $value['Numcompte']." ".Comptabilite::getLibelleCompte_par_NumeroCompte($value['Numcompte'])." ". $value['debit']." ". $value['devise']?></td></tr>
                                                <?php    
                                            }
                                        }
                                    ?>
                                    <tr><th class="" colspan="3">TOTAL ACTIF : <?= $sommeActif?></th></tr>
                                    <thead>
                                        <tr><th class="text-center" colspan="3">PASSIF</th></tr>
                                    </thead>
                                    <?php
                                        $sommeActif = 0;
                                        $sommePassif = 0;
                                        foreach (Comptabilite::bilan() as $value) {
                                            // ACTIF DU BILAN
                                            if($value['Num_sous_type_compte']==2){
                                                $sommePassif += $value['montant'];
                                                if($sommePassif == 0){
                                                    ?>
                                                    <tr><td>SOLDE DEBITEUR : <?= $sommeActif?></td></tr>
                                                    <?php
                                                }else if($sommePassif<$sommeActif){
                                                    ?>
                                                    <tr><td>SOLDE DEBITEUR : <?= $sommeActif-$sommePassif?></td></tr>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <tr><td><?= $value['Numcompte']." ".Comptabilite::getLibelleCompte_par_NumeroCompte($value['Numcompte'])." ". $value['debit']." ". $value['devise']?></td></tr>
                                                   <?php 
                                                }
                                                ?>
                                                    
                                                <?php    
                                            }
                                        }
                                    ?>
                                <tr><th class="" colspan="3">TOTAL PASSIF : <?= $sommePassif?> </th></tr>
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