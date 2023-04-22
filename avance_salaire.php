<?php 
if(session_start()==null)session_start();
if(isset($_SESSION['agent'])){
    $_SESSION['prefet'] = $_SESSION['agent'];
}
if(isset($_SESSION['prefet'])){
    require_once('Class/Class.AvanceSalaire.php');
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
                        <div class="row col-12">
                            <div class="col-4">
                                <p class="text-primary">Formulaire d'enregistrement d'avance sur salaire</p>
                                <form id="formAvance">
                                <table class="">
                                    <tr>
                                        <td> <label for="codeAgent">Code agent &nbsp;</label> </td>
                                        <td>
                                            <div class="form-group"><input class="form-control" type="text" name="codeAgent" id="codeAgent" placeholder="Tapez le code agent..." autofocus></div>
                                        </td>
                                    </tr>
                                        <div id="resultat_recherche_article">
                                            <tr></tr>
                                        </div>
                                    <tr>
                                        <td><label for="montantDemande">Montant demandé &nbsp;</label></td>
                                        <td>
                                            <div class="form-group"><input class="form-control" type="text" name="montantDemande" id="montantDemande" placeholder="Montant..."></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="libelleAvance">Motif &nbsp;</label></td>
                                        <td>
                                            <div class="form-group"><div class="form-group">
                                              <textarea class="form-control" name="libelleAvance" id="libelleAvance" rows="3"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="deviseAvance">Devise &nbsp;</label></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="deviseAvance" id="deviseAvance">
                                                    <option value="">---------</option>
                                                    <option value="CDF">CDF</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group"><button type="submit" class="btn btn-primary fa fa-save">&nbsp;Enregistrer</button></div>
                                        </td>
                                        <div id="resultat"></div>
                                    </tr>
                                 </table>
                                </form>
                            </div>
                            <!-- LISTE DES NOTES DU JOUR -->
                            <div class="card col-8">
                                <p class="text-primary">Les notes d'avance sur salaire du jour
                                    <br><strong>CLIQUEZ SUR UNE LIGNE POUR AFFICHER LA NOTE ET PROCEDER A L'IMPRESSION</strong>
                                </p>
                                <table class="table-bordered table-hover table-responsive">
                                    <thead class="bg-primary text-center">
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
                                        foreach (AvanceSalaire::avanceSalaireDu_Jour() as $value) {
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
                <!-- NOTE D'AVANCE SUR SALAIRE PROPREMENT DIT -->
                <div id="note_avance" class="col card">&nbsp;
                   <div id="close"><a href="" class="text-white pull-right btn btn-danger">X</a></div>
                    <div class="text-white" id="note_"></div>
                </div>
            </div>
            <!-- Partie principale se termine ici -->
        </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<?php require_once("pied.php");
}else{
    header("location:index.php");
}