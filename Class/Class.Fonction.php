<?php
require_once('Class.DB.php');
class Fonction{
    public static function getFonction(){
        if(session_start()===null)session_start();
        $Numfonction = null;
        foreach ($_SESSION['agent'] as $value) {
            $Numfonction = $value['Numfonction'];
        }
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM fonction WHERE Numfonction!=?");
        $select->execute([$Numfonction]);
        return $select->fetchAll();
    }
}