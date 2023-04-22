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
                        <p class="text-white m-0 font-weight-bold ">OPERATION COMPTABLE</p>
                    </div>
                    <div class="card-body col">
                        <div id="" class="table-responsive  mt-2 col-lg card py-3" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <p class="text-primary">Formulaire d'ajout d'un numéro de compte</p>
                        <div class="row col">
                            <div>
                                <table class="">
                                    <tbody>
                                       <form role="form" id="form_ajout_compte">
                                           <tr>
                                               <td><label for="type_compte">Type de compe</label></td>
                                               <td>
                                                   <div class="form-group">
                                                     <select class="form-control" name="type_compte" id="type_compte">
                                                         <option value="" selected>.........</option>
                                                         <?php 
                                                            foreach (Comptabilite::get_type_compte() as $value) {
                                                                ?>
                                                            <option value="<?= $value['Numtypecompte']?>"><?= $value['Libelletypecompte']?></option>
                                                            <?php
                                                            }
                                                         ?>
                                                    </select>
                                                   </div>
                                               </td>
                                               <td><label for="sous_type_compte">Sous type de compe</label></td>
                                               <td>
                                                    <div class="form-group">
                                                     <select class="form-control" name="sous_type_compte" id="sous_type_compte">                                                     
                                                    </select>
                                                   </div>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td><label for="num_compte_ajout">Numéro du compte</label></td>
                                               <td><div class="form-group col-5"><input type="text" class="form-control" name="num_compte_ajout" id="num_compte_ajout"></div></td>
                                               <td><label for="libelle_num_compte">Libellé du compte</label></td>
                                               <td><div class="form-group col"><input type="text" class="form-control" name="libelle_num_compte" id="libelle_num_compte"></div></td>
                                           </tr>
                                           <tr>
                                               <td><div class="form-group"><button class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp; Ajouter</button></div></td>
                                           </tr>
                                           <span id="resultat"></span>
                                       </form>
                                    </tbody>
                                </table>
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