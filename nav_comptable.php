<?php 
// if(session_start()===null)session_start();
$donnee_comptable = null;
if(isset($_SESSION['comptable'])){
    foreach ($_SESSION['comptable'] as $value) {
        $donnee_comptable = $value;
    }
}
?>
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon "><img style="width: 70%; height: 80%;" src="assets/img/dogs/logo_billingue.jpg" alt="" srcset=""></div>
                    <div class="sidebar-brand-text mx-3"><span><?= $donnee_comptable['Libellefonction']?></span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="comptabilite.php"><i class="fas fa-tachometer-alt"></i><span>Accueil</span></a></li>
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li> -->
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="creer_compte.php"><i class="fas fa-table"></i><span>Créer un compte élève ou agent</span></a></li> -->
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="ajout_compte.php"><i class="fas fa-table"></i><span>Ajouter des comptes</span></a></li> -->
                    <li class="nav-item" role="presentation"><a class="nav-link" href="rapport_comptable.php"><i class="fas fa-book"></i><span>Rapport</span></a></li>
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="register.php"><i class="fas fa-shopping-basket"></i><span>Etat des besoins</span></a></li> -->
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="register.php"><i class="fas fa-book"></i><span>Note d'avance sur salaire</span></a></li> -->
                    
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="journal.php"><i class="fas fa-table"></i><span>Journal des opérations</span></a></li> -->
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="bilan.php"><i class="fas fa-table"></i><span>Bilan de l'exercice</span></a></li> -->
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>