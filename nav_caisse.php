<?php 
// if(session_start()===null)session_start();
$donnee_caisse = null;
if(isset($_SESSION['caisse'])){
    foreach ($_SESSION['caisse'] as $value) {
        $donnee_caisse = $value;
    }
}
?>
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon"><img style="width: 70%; height: 80%;" src="assets/img/dogs/logo_billingue.jpg" alt="" srcset=""></div>
                    <div class="sidebar-brand-text mx-3"><span><?= $donnee_caisse['Libellefonction']?></span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="caisse.php"><i class="fas fa-tachometer-alt"></i><span>Tableau de bord</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="liste_entrees.php"><i class="fas fa-money-bill"></i><span>Liste des entrées</span></a></li>
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="liste_sortie.php"><i class="fas fa-share"></i><span>Liste de sortie</span></a></li> -->
                    <li class="nav-item" role="presentation"><a class="nav-link" href="carnet_avance_salaire.php"><i class="fas fa-book"></i><span>Carnet d'avance sur salaire</span></a></li>
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="register.php"><i class="fas fa-book"></i><span>Note d'avance sur salaire</span></a></li> -->
                    
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="liste_agent.php"><i class="fas fa-table"></i><span>Liste des agent</span></a></li> -->
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>