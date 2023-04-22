<?php
require_once("Class.DB.php");
class Taux{
    private static $taux;

    public static function getTaux(){
        $con = DB::getDB();
        $taux = $con->prepare("SELECT CoursDeChange FROM taux");
        $taux->execute();
        $data = $taux->fetch();
        $valeur_taux = $data['CoursDeChange'];
        return $valeur_taux;
    }
}