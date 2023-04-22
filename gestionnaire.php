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
        $_SESSION['gestionnaire'] = $_SESSION['agent'];
    }
    if(isset($_SESSION['gestionnaire'])){
        require_once("Class/Class.Eleve.php");
        require_once("Class/Class.Agent.php");
        $donnee_gestionnaire = null;
        foreach ($_SESSION['gestionnaire'] as $value) {
            $donnee_gestionnaire = $value;
        }
    ?>
    <!-- debut de nav -->
    <?php require_once('nav_gestionnaire.php') ?>
    <!-- Fin de nav -->
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <!-- en-tete -->                              
                    <?php require_once('tete_gestionnaire.php');?>
                    <!-- fin en-tete -->
                <!-- Partie principale commence ici -->
                <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">TABLEAU DE BORD</p>
                    </div>
                    <div class="card-body no-print">
                        <div class="row">
                            <div>
                                <div class="text-md-left dataTables_filter form-inline" id="dataTable_filter">
                                    
                                    <div class="container col-lg-12 form-inline">
                                        <div class="card col-3 bg-primary text-white">
                                            <?php 
                                            $tab_eleve = Eleve::nombre_eleve_inscrit();
                                            $tab_agent = Agent::nombre_agent();
                                            ?>
                                            Nombre des élèves <?= $tab_eleve['nb_eleve']?><br>
                                            dont <?= $tab_eleve['nb_eleve_fille']." Fille(s) et ".$tab_eleve['nb_eleve_garcon']." Garcçon(s)"?>
                                        </div>
                                        <div class="card col-3 bg-primary text-white">
                                            
                                            Nombre des agent <?= $tab_agent['nb_agent']?><br><i class=""></i>
                                            dont <?= $tab_agent['nb_agent_fille']." Femme(s) et ".$tab_agent['nb_agent_garcon']." Homme(s)"?>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div id="liste_eleve" class="table-responsive  mt-2 col-lg" id="dataTable" role="grid" aria-describedby="dataTable_info">
                          
                        
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