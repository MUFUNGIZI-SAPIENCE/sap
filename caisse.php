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
        require_once("./Class/Class.Operation.php");
        $donnee_caisse = null;
        foreach ($_SESSION['caisse'] as $value) {
            $donnee_caisse = $value;
        }
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
                <div class="card shadow">
                <div class="card-body row">
                    <div class="col-lg">
                        <strong class="text-primary">Passe une opération</strong>
                        <div class="form-group col-lg-8" role="form">
                            <form id="operation">
                                <div class="form-group">
                                    <label for="">Matricule de l'élève ou code de l'agent</label>
                                    <input type="text" autofocus class="form-control" name="matricule" id="matricule" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="form-group">
                                <label for="type_operation">Sélectionner un type d'opération</label>
                                    <select name="type_operation" id="type_operation" class="form-control">
                                        <option value="">.........</option>
                                        <?php
                                        foreach (Operation::get_type_operation() as  $value) {
                                            ?>
                                            <option value="<?= $value['Num_type_operation']?>"><?= $value['LibelleTypeOperation']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="devise">Sélectionner une dévise</label>
                                    <select class="form-control" name="devise" id="devise">
                                        <option value="">........</option>
                                        <option value="CDF">CDF</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input name="montantPaiement" id="montantPaiement" type="text" placeholder="Montant..." class="form-control">
                                </div>
                                <div class="form-group">
                                    <button id="btn_enregis_paiement" class="btn btn-primary fa fa-save" type="submit">&nbsp; Enregistrer</button>
                                </div>
                                <span id="resultat"></span>
                            </form>
                        </div>
                    </div>
                    <div class="col" id="div_num_note_avance">
                    <strong class="text-primary">Veuillez saisir le numéro de la note pour vérifier son existance</strong>
                        <div class="" role="form">
                            <div class="form-inline">
                                <input class="form-control col-sm-4" id="num_note" placeholder="Numéro de note" type="text">
                                &nbsp;<button id="btn_avance_salaire" type="button" class="form-control btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <span id="resultat_avance"></span>
                </div>
                </div>
                <!-- NOTE D'AVANCE SUR SALAIRE -->
                <div id="noteDavance" class="col">&nbsp;
                   <div id="close"><a href="" class="text-white pull-right btn btn-danger">X</a></div>
                    <div class="text-white" id="note"></div>
                </div>
            </div>















                
                <!-- Partie principale se termine ici -->
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <?php require_once("pied.php");
}else{
    header("location:index.php");
}