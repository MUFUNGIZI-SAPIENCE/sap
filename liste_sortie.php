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
        $donnee_caisse = null;
        foreach ($_SESSION['caisse'] as $value) {
            $donnee_caisse = $value;
        }
        require_once('Class/Class.Sortie.php');
    ?>
    <!-- debut de nav -->
    <?php require_once('nav_caisse.php') ?>
    <!-- Fin de nav -->
            <div class="d-flex flex-column " id="content-wrapper">
                <div id="content">
                    <!-- en-tete -->                              
                    <?php require_once('tete_caisse.php');?>
                    <!-- fin en-tete -->
                <!-- Partie principale commence ici -->
                <div class="container">
                    <div class="card-header bg-primary text-white shadow col-7" onclick="imprimer('liste_sortie')"><i class="btn btn-default fa fa-print text-white text-right" title="Imprimer"></i></div>
                        <div class="row col-7 bordered" role="grid" id="liste_sortie">
                            <table class="table-striped table-bordered table-responsive">
                                <thead class="thead-inverse">
                                    <tr class="text-center"><th colspan="5"><b class="display">LISTE DES SORTIES</b></th></tr>
                                    <tr>
                                        <th>N°</th>
                                        <th class="text-center">DATE</th>
                                        <th class="text-center">IDENTITE DE L'AGENT</th>
                                        <th class="text-center">MONTANT</th>
                                        <th class="text-center">MOTIF</th>
                                    </tr>
                                    </thead>
                                    <tbody  class="text-justify">
                                        <?php 
                                        $num = 0;
                                        foreach (Sortie::listeDeSortie() as $value) {
                                            $num++;
                                        ?>
                                        <tr>
                                            <td scope="row"><?= $num ?></td>
                                            <td><?= $value['Datesortie'] ?></td>
                                            <td><?=strtoupper($value['Nomagent']." ".$value['Postnom'])." ".$value['Prenom'] ?></td>
                                            <td><?= $value['montantsortie']." ".$value['devise'] ?></td>
                                            <td><?= $value['Libellesortie'] ?> </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                            </table>
                        </div>
                    <!-- </div> -->
                </div>
            </div>















                
                <!-- Partie principale se termine ici -->
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <?php require_once("pied.php");
}else{
    header("location:index.php");
}