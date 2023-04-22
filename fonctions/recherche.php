<?php
require_once('../Class/Class.AvanceSalaire.php');
require_once('../Class/Class.Comptabilite.php');
require_once('../Class/Class.Agent.php');
require_once('../Class/Class.Eleve.php');

function releveAgent($CodeAgent){
    ?>
&nbsp;
    <table class="table-bordered table-striped table-inverse table-responsive">
        <thead class="thead-inverse text-white bg-dark">
            <?php
            $identite_membre = null;
            $Numagent = 0;
                foreach (Agent::getAgent($CodeAgent) as $value) {
                    $identite_membre = strtoupper($value['Nomagent']." ".$value['Postnom'])." ".$value['Prenom'];
                    $Numagent = $value['Numagent'];
                }
            ?>
            <tr>
                <th colspan="4"><span class="text-center">RELEVE DE COMPTE</span><br>
                    <strong class="text-left"><?= "De : ".$identite_membre?></strong>
                </th>
            </tr>
            <tr  class="text-center">
                <th>DATE</th>
                <th>OPERATION EFFECTUEE</th>
                <th>MONTANT</th>
                <th>ANNEE SCOLAIRE</th>
            </tr>
            </thead>
            <tbody class="bg-primary text-white">
                <?php 
                foreach (Comptabilite::releveDE_compte_agent($Numagent) as $value) {
                    ?>
                
                <tr>
                    <td><?=$value['DateOperation']?></td>
                    <td><?= $value['LibelleTypeOperation']?></td>
                    <td><?= $value['montant']." ".$value['devise'] ?></td>
                    <td><?= $value['AnneeScolaire']?></td>
                </tr>
                    <?php
                }
                ?>
            </tbody>
    </table>
    <?php
}
// releve eleve
function releveEleve($CodeEleve){
    ?>
&nbsp;
    <table class="table-bordered table-striped table-inverse table-responsive">
        <thead class="thead-inverse text-white bg-dark">
            <?php
            $identite_membre = null;
            $Numeleve = 0;
                foreach (Eleve::getEleve_Par_Matricule($CodeEleve) as $value) {
                    $identite_membre = strtoupper($value['Nomeleve']." ".$value['Postnomeleve'])." ".$value['Prenomeleve'];
                    
                }
            ?>
            <tr>
                <th colspan="4"><span class="text-center">RELEVE DE COMPTE</span><br>
                    <strong class="text-left"><?= "De : ".$identite_membre?></strong>
                </th>
            </tr>
            <tr  class="text-center">
                <th>DATE</th>
                <th>OPERATION EFFECTUEE</th>
                <th>MONTANT</th>
                <th>ANNEE SCOLAIRE</th>
            </tr>
            </thead>
            <tbody class="bg-primary text-white">
                <?php 
                foreach (Comptabilite::releveDE_compte_Eleve($CodeEleve) as $value) {
                    ?>
                
                <tr>
                    <td><?=$value['DateOperation']?></td>
                    <td><?= $value['LibelleTypeOperation']?></td>
                    <td><?= $value['montant']." ".$value['devise'] ?></td>
                    <td><?= $value['AnneeScolaire']?></td>
                </tr>
                    <?php
                }
                ?>
            </tbody>
    </table>
    <?php
}


function note_avance($id_avance){
    ?>
<table class="">
    <thead  class="text-white">
    <?php foreach (AvanceSalaire::avanceSalaireDu_Jour_Par_Id_avance($id_avance) as $v) {
    ?>
        <tr>
            <th colspan="4"class="text-center"><span >NOTE D'AVANCE SUR SALAIRE</span> <br>
                
            </th>
        </tr>
        <tr>
            <th><span class="text-left">No : &nbsp;&nbsp;<?= $v['Numavance']?></span></th>
        </tr>
        <tr>
            
            <th>Identité : <?= strtoupper($v['Nomagent']." ".$v['Postnom'])." ".$v['Prenom'] ?></th>
            <th colspan="2" class="text-right">DATE : <?= $v['DateAvance']?></th>
                <?php
                }
            ?>
            
        </tr>
    </thead>
    <tbody>
    <?php
    foreach (AvanceSalaire::avanceSalaireDu_Jour_Par_Id_avance($id_avance) as $value) {
        ?>
         <!-- <tr class="text-white">
        </tr> -->
        <tr class="text-white">
            <td colspan="5">
                <?php 
                if($value['Genreagent'] == "Masculin"){
                    ?>
    <p class="text-justify">Le monsieur dont l'identité est susmentionnée est autorisé de passer à la caisse soutirer la somme de <?= $v['Montantavance']." ".$v['devise']?> sur sa rémunération.</p>
                    <?php
                    }else{
                    ?>
    <p class="text-justify">La dame dont l'identité est susmentionnée est autorisé de passer à la caisse soutirer la somme de <?= $v['Montantavance']." ".$v['devise']?> sur sa rémunération.</p>
                <?php
                }
                ?>
            </td>
            <td><div class="no-print" onclick="imprimer('note_avance')" id="remurer_avance"><a href="" class="text-white pull-right btn btn-info fa fa-print" title="Imprimer"></a></div></td>
        </tr>
     <?php   
    }?> 
    </tbody>
    </table>
    <?php
}
// Affichage de releve des agents
if(isset($_GET['codeAgent_releve'])){
    releveAgent($_GET['codeAgent_releve']);
}
// Affichage du releve des eleves
if(isset($_GET['codeEleve_releve'])){
    releveEleve($_GET['codeEleve_releve']);
}
// Affichage de la note d'avance sur salaire pour impression a la prefecture
if(isset($_GET['id_avance'])){
    note_avance($_GET['id_avance']);
}

// Recherche de la note d'avance sur salaire a la caisse
if(isset($_GET['NumnoteRechercher']) && $_GET['NumnoteRechercher']!=''){
    ?>
    <table class="">
    <thead  class="text-white">
    <?php foreach (AvanceSalaire::note_Avance_sur_Salaire_Non_servie($_GET['NumnoteRechercher']) as $v) {
    ?>
        <tr>
            <th colspan="4"class="text-center"><span >NOTE D'AVANCE SUR SALAIRE</span> <br>
                
            </th>
        </tr>
        <tr>
            <th><span class="text-left">No : &nbsp;&nbsp;<?= $v['Numavance']?></span></th>
        </tr>
        <tr>
            
            <th>Identité : <?= strtoupper($v['Nomagent']." ".$v['Postnom'])." ".$v['Prenom'] ?></th>
            <th colspan="2" class="text-right">DATE : <?= $v['DateAvance']?></th>
                <?php
                }
            ?>
            
        </tr>
    </thead>
    <tbody>
    <?php
    foreach (AvanceSalaire::note_Avance_sur_Salaire_Non_servie($_GET['NumnoteRechercher']) as $value) {
        ?>
         <!-- <tr class="text-white">
        </tr> -->
        <tr class="text-white">
            <td colspan="5">
                <?php 
                if($value['Genreagent'] == "Masculin"){
                    ?>
    <p class="text-justify">Le monsieur dont l'identité est susmentionnée est autorisé de passer à la caisse soutirer la somme de <?= $v['Montantavance']." ".$v['devise']?> sur sa rémunération.</p>
                    <?php
                    }else{
                    ?>
    <p class="text-justify">La dame dont l'identité est susmentionnée est autorisée de passer à la caisse soutirer la somme de <?= $v['Montantavance']." ".$v['devise']?> sur sa rémunération.</p>
                <?php
                }
                ?>
            </td>
            <td><div onclick="soutirer('<?=$value['Numavance'] ?>')" id="remurer_avance"><button class="text-white pull-right btn btn-info">Soutirer</button></div></td>
        </tr>
     <?php   
    }?> 
    </tbody>
    </table>
    <?php
}