<?php
require_once("Class.DB.php");
class Caisse{

    public static function genererMontant_Caisse($Montant){
        $con = DB::getDB();
        // Selection du montant de la caisse
        $select_montant_caisse = $con->prepare("SELECT MontantCaisse FROM caisse");
        $select_montant_caisse->execute();
        if($select_montant_caisse->rowCount()>0){
            $data_caisse = $select_montant_caisse->fetch();
            $Montant += $data_caisse['MontantCaisse'];
            $update_caisse = $con->prepare("UPDATE caisse SET MontantCaisse=?");
            $update_caisse->execute([$Montant]);
        }else{
            $insert_montant_caisse = $con->prepare("INSERT INTO caisse SET MontantCaisse=?");
            $insert_montant_caisse->execute([$Montant]);
        }
    }
}