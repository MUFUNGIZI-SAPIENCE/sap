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
                        <p class="text-white m-0 font-weight-bold ">LISTE DES COMPTES</p>
                    </div>
                    <div class="card-body col">
                        <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <div class="col">
                            <!-- RAPPORT COMPTABLE -->
                            <div>
                            <table class="table-bordered table-striped table-hover">
                                <thead class="text-center bg-dark text-white">
                                    <tr><th colspan="6">LISTE DES COMPTE</th></tr>
                                 <tr>
                                     <th>N°</th>
                                     <th>NUM COMPTE</th>
                                     <th>LIBELLE</th>
                                     <th>TYPE</th>
                                     <th>SOUS TYPE</th>
                                     <th>ACTION</th>
                                 </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $num = 0;
                                    foreach (Comptabilite::liste_des_Comptes() as $value) {
                                        $num++;
                                    ?>
                                    <tr>
                                        <td><?= $num ?></a></td>
                                        <td><?= $value['Numcompte'] ?></a></td>
                                        <td><?= strtoupper($value['Libellecompte']) ?></td>
                                        <td><?= $value['Libelletypecompte'] ?></a></td>
                                        <td><?= $value['Libelle_sous_type_compte'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle input-group-lg-2" data-toggle="dropdown">
                                                    <i class="fa fa-align-justify text-white"></i> 
                                                    <i class="caret text-white"></i>
                                                </button>
                                                <ul class="dropdown-menu"> 
                                                    <li><a id="modif_eleve_link" href="modifier.php?modif_NumCompte=<?=$value['Idcompte']?>"><i class="fa fa-edit"></i>&nbsp;Modifier</a></li>
                                                    <li><a id="modif_eleve_link" href="supprimer.php?supp_NumCompte=<?=$value['Idcompte']?>"><i class="fa fa-trash text-danger "></i>&nbsp;Supprimer</a></li>
                                                </ul>
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