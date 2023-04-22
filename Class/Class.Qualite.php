<?php
require_once('Class.DB.php');
class Qualite{
    public static function getQualite(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM qualite");
        $select->execute();
        return $select->fetchAll();
    }
}