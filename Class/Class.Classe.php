<?php
require_once("Class.DB.php");
class GETClass{
    public static function getClass(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM classe");
        $select->execute();
        return $select->fetchAll();

    }
}