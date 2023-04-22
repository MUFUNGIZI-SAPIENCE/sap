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
                        <p class="text-white m-0 font-weight-bold ">CREER UN NUMERO DE COMPTE POUR LES AGENTS OU ELEVES</p>
                    </div>
                    <div class="card-body col">
                        <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <div class="row col-lg-9">
                            <p class="text-info text-justify">
                                <strong>Cette opéraration permet de créer un compte d'agent ou d'élève. Ci-dessous une liste des agents et des élèves sans un compte</strong>
                            </p>
                        </div> 
                        <div class="col">
                            <div>
                                <table class="table-hover table-bordered table-striped">
                                    <thead class="bg-dark text-white">
                                        <tr><th colspan="7" class="text-center">LISTE DES AGENTS SANS UN COMPTE</th></tr>
                                        <tr>
                                            <th>N°</th>
                                            <th>NOM</th>
                                            <th>POSTNOM</th>
                                            <th>PRENOM</th>
                                            <th>GENRE</th>
                                            <th>FONCTION</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $num = 0;
                                        foreach (Comptabilite::liste_Agent_Sans_compte_cree() as $value) {
                                            $num++;
                                        ?>
                                            <tr>
                                                <td><?= $num?></td>
                                                <td><?= strtoupper($value['Nomagent'])?></td>
                                                <td><?= strtoupper($value['Postnom'])?></td>
                                                <td><?= $value['Prenom']?></td>
                                                <td><?= $value['Genreagent']?></td>
                                                <td><?= $value['Libellefonction']?></td>
                                                <td class="bg-primary">
                                                    <div class="btn-group">
                                                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-align-justify text-white"></i> 
                                                            <i class="caret text-white"></i>
                                                        </button>
                                                        <ul class="dropdown-menu"> 
                                                            <li><a id="modif_eleve_link" href="./fonctions/creer_compte.php?Numagent=<?=$value['Numagent']?>"><i class="fa fa-edit"></i>&nbsp;Créer compte</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>&nbsp;
                            <!-- LISTE DES ELEVES SANS UN COMPTE -->
                            <div>
                            <table class="table-hover table-bordered table-striped">
                                    <thead  class="bg-dark text-white">
                                        <tr><th colspan="8" class="text-center">LISTE DES ELEVES SANS UN COMPTE</th></tr>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>NOM</th>
                                            <th>POSTNOM</th>
                                            <th>PRENOM</th>
                                            <th>GENRE</th>
                                            <th>CLASSE</th>
                                            <th>ANNEE SCOLAIRE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $num = 0;
                                        foreach (Comptabilite::liste_Eleve_Sans_compte_cree() as $value) {
                                            $num++;
                                        ?>
                                            <tr>
                                                <td><?= $num?></td>
                                                <td><?= strtoupper($value['Nomeleve'])?></td>
                                                <td><?= strtoupper($value['Postnomeleve'])?></td>
                                                <td><?= $value['Prenomeleve']?></td>
                                                <td><?= $value['Sexeeleve']?></td>
                                                <td>
                                                    <?php
                                                    if($value['degre']==1){
                                                        echo $value['degre']." ère ".$value['Libelleclasse']." ".$value['LibelleOption'];
                                                    }else{
                                                        echo $value['degre']." ème ".$value['Libelleclasse']." ".$value['LibelleOption'];
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $value['AnneeScolaire']?></td>
                                                <td class="bg-primary">
                                                    <div class="btn-group">
                                                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-align-justify text-white"></i> 
                                                            <i class="caret text-white"></i>
                                                        </button>
                                                        <ul class="dropdown-menu"> 
                                                            <li><a id="modif_eleve_link" href="./fonctions/creer_compte.php?Numeleve=<?=$value['Numeleve']?>"><i class="fa fa-edit"></i>&nbsp;Créer compte</a></li>
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