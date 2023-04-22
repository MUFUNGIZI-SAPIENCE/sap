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
        $donnee_comptable = null;
        foreach ($_SESSION['comptable'] as $value) {
            $donnee_comptable = $value;
        }
    ?>
    <!-- debut de nav -->
    <?php
        require_once('Class/Class.Comptabilite.php');
        require_once('Class/Class.Taux.php');
    ?>
    <?php require_once('nav_comptable.php');?>
    <!-- Fin de nav -->
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <!-- en-tete -->                              
                    <?php require_once('tete_comptable.php');?>
                    <!-- fin en-tete -->
                <!-- Partie principale commence ici -->
                <div class="container">
                    <div class="shadow col-12">
                        <div class="card-header py-3 bg-primary">
                            <p class="text-white m-0 font-weight-bold ">JOURNAL DES OPERATIONS</p>
                        </div>
                        <div class="col-9">
                            <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <div>
                                <p class="text-primary"><span onclick="imprimer('journal')" class="fa fa-print"></span></p>
                            </div>
                            <div class="">
                                <div id="journal">
                                    <table class="table-responsive table-bordered ">
                                        <thead>
                                             <tr><th colspan="5" class="text-center">JOURNAL DES OPERATIONS DU </th></tr>
                                            <tr>
                                                <th class="text-center" colspan="2">COMPTE</th>
                                                <th></th>
                                                <th  class="text-center" colspan="2">MONTANT</th>
                                            </tr>
                                             <tr>
                                                <th  class="text-center">DEBIT</th>
                                                <th  class="text-center">CREDIT</th>
                                                <th>LIBELLE D'OPERATION</th>
                                                <th  class="text-center">DEBIT</th>
                                                <th  class="text-center">CREDIT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sommeAffectation = 0;
                                        $sommeAffectationUSD = 0;
                                        $sommeAffectationCDF = 0;
                                        $sommePaye = 0;
                                        foreach (Comptabilite::journalisation() as $value) {
                                            if($value['devise']=="USD"){
                                                $sommeAffectationCDF = $value['montant']*Taux::getTaux();
                                            }else{
                                                $sommeAffectationCDF +=  $sommeAffectationCDF;
                                            }
                                            $sommeAffectation += $sommeAffectationCDF ;
                                            if($value['debit']==57){
                                            ?>
                                                <tr>
                                                    <td><?= $value['debit']." &nbsp;".Comptabilite::getLibelleCompte_par_NumeroCompte($value['debit']) ?></td>
                                                    <td></td>
                                                    <td colspan="2" class="text-right"><?= $value['montant']." ".$value['devise'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><?= $value['credit']." ".Comptabilite::getLibelleCompte_par_NumeroCompte($value['credit']) ?> &nbsp;</td>
                                                    <td></td>
                                                    <td colspan="4" class="text-right"><?= $value['montant']." ".$value['devise'] ?></td>
                                                </tr>
                                                <tr><td class="text-center" colspan="5"><?= $value['LibelleTypeOperation'] ?></td></tr>
                                                <?php
                                            }else if($value['credit']==57){
                                                ?>
                                                <tr>
                                                    <td><?= $value['debit']." &nbsp;".Comptabilite::getLibelleCompte_par_NumeroCompte($value['debit']) ?></td>
                                                    <td></td>
                                                    <td colspan="2" class="text-right"><?= $value['montant']." ".$value['devise'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><?= $value['credit']." ".Comptabilite::getLibelleCompte_par_NumeroCompte($value['credit']) ?> &nbsp;</td>
                                                    <td></td>
                                                    <td colspan="4" class="text-right"><?= $value['montant']." ".$value['devise'] ?></td>
                                                </tr>
                                                <tr><td class="text-center" colspan="5"><?= $value['LibelleTypeOperation'] ?></td></tr>
                                                <?php
                                            }
                                           
                                    ?>                                                      
                                <?php
                                }                                        
                                ?>
                                <tr>
                                    <td colspan="3">TOTAL</td>
                                    <td class="text-center"><?= $sommeAffectation." CDF"?></td>
                                    <td class="text-center"><?= $sommeAffectation ." CDF"?></td>
                                </tr>                                         
                                </tbody>
                            </table>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- TOUTES LES OPERATIONS -->
                        <div class="card-body col-6">
                            <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <div>
                                <p class="text-primary">Toute opération</p>
                            </div>
                            <div class="">
                                <div>
                                    
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