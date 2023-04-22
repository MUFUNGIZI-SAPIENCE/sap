<?php
require_once("Class.DB.php");
class AnneeScolaire{
    /**
     *@method int getAnneeScolaire() cette methode retourne l'identifiant d'une annee scolaire
     */
    public static function getAnneeScolaire(){
        $con = DB::getDB();
        $select_annee_scolaire = $con->prepare("SELECT * FROM annee_scolaire ORDER BY IdAnneeScolaire DESC");
        $select_annee_scolaire->execute();
        if($select_annee_scolaire->rowCount()>0){
            $data_annee_scolaire = $select_annee_scolaire->fetch();
            $AnneeScolaire = $data_annee_scolaire['IdAnneeScolaire']; 
            return $AnneeScolaire;
        }
    }
}