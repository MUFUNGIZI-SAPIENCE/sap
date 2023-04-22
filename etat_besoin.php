<?php
require_once('Class/Class.Eleve.php');
if(session_start()===null)session_start();
?>
<!DOCTYPE html>
<html>
<body id="page-top">
    <div id="wrapper">
        <!-- debut de nav -->
        <?php require_once('nav_prefecture.php') ?>
        <?php
if(isset($_SESSION['prefet']))
{
        ?>
        <!-- Fin de nav -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- en-tete -->                              
        <?php require_once('tete_prefecture.php') ?>
                <!-- fin en-tete -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">ETAT DES BESOINS</p>
                    </div>
                    <div class="card-body">
                        <div id="etat_besoin" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <div>
                            <p class="text-primary">Formulaire d'enregistrement de l'état des besoins</p>
                        </div>    
                        <div class="row col">
                            <div>
                                <form >
                                <table class="">
                                    <tr>
                                        <td> <label for="article">Article &nbsp;</label> </td>
                                        <td>
                                            <div class="form-group"><input class="form-control" type="text" name="article" id="article" placeholder="Tapez un nom d'article..." autofocus></div>
                                        </td>
                                    </tr>
                                        <div id="resultat_recherche_article">
                                            <tr></tr>
                                        </div>
                                    <tr>
                                        <td><label for="quantite">Quantité/Unité &nbsp;</label></td>
                                        <td>
                                            <div class="form-group"><input class="form-control" type="text" name="quantite" id="quantite" placeholder="Quantité..."></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="prix_unitaire">Prix unitaire &nbsp;</label></td>
                                        <td>
                                            <div class="form-group"><input class="form-control" type="text" name="prix_unitaire" id="prix_unitaire" placeholder="Prix unitaire..."></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group"><button type="submit" class="btn btn-primary fa fa-plus">&nbsp;Ajouter</button></div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div>hdgdgdgd</div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once('pied.php');
}else{
    header('location:index.php');
}