<?php 
if(session_start()==null)session_start();
if(isset($_SESSION['agent'])){
    $_SESSION['prefet'] = $_SESSION['agent'];
}
if(isset($_SESSION['prefet'])){
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
            <div class="container-fluid">
                <!-- <h3 class="text-dark mb-1">Blank Page</h3> -->
            </div>
            <!-- Partie principale se termine ici -->
        </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<?php require_once("pied.php");
}else{
    header("location:index.php");
}