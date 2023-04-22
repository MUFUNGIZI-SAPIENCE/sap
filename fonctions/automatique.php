<?php
require_once("../Class/Class.Comptabilite.php");
require_once("../Class/Class.Enveloppe.php");
if(isset($_GET['crediterDebiter'])){
    if($_GET['crediterDebiter'] == 41){
        echo Comptabilite::crediterDebiterCompteEleve_par_Defaut();
    }
    if($_GET['crediterDebiter'] == 42){
        echo Comptabilite::crediterDebiterComptePersonnel_par_Defaut();
    }
}
// Generation de l'enveloppe
if(isset($_GET['genererEnveloppe'])){
    Enveloppe::genererEnveloppe();
}