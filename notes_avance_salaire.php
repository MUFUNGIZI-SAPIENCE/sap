<?php 
if(session_start()==null)session_start();
if(isset($_SESSION['agent'])){
    $_SESSION['prefet'] = $_SESSION['agent'];
}
if(isset($_SESSION['prefet'])){
    require_once('./Class/Class.AvanceSalaire.php');
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
            <div class="container shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">AVANCE SUR SALAIRE</p>
                    </div>
                    <div class="card-body">                            
                        <div class="row">
                            <!-- LISTE DES NOTES DU JOUR -->
                            <div class="">
                                <p class="text-primary"><span onclick="imprimer('toute_note_avance')" class=" pull-right btn btn-primary fa fa-print"></span> </p>
                                <div class="card col-12" id="toute_note_avance">
                                    <table class="table-bordered table-hover table-responsive">
                                    <thead class="bg-primary text-center">
                                        <tr><th colspan="5" class="text-center text-white">LES NOTES D'AVANCE SUR SALAIRE</th></tr>
                                        <tr class="text-white text-justify">
                                            <th>No</th>
                                            <th>NUMERO DE LA NOTE</th>
                                            <th>IDENTITE DE L'AGENT</th>
                                            <th>MONTANT</th>
                                            <th>DATE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $num= 0;
                                        foreach (AvanceSalaire::toute_avance_sur_Salaire() as $value) {
                                            $num++;
                                        ?>
                                        <tr class="bg-dark text-white table-hover" onclick="note_avance('<?= $value['Numavance']?>')">
                                            <td><?= $num?></td>
                                            <td><?= $value['Numavance'] ?></td>
                                            <td><?= strtoupper($value['Nomagent']." ".$value['Postnom'])." ".$value['Prenom'] ?></td>
                                            <td><?= $value['Montantavance']." ".$value['devise']?></td>
                                            <td><?= $value['DateAvance'] ?></td>
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