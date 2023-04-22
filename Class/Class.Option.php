<?php
require_once('Class.DB.php');
class Option{
    public static function getOption(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM options");
        $select->execute();
        return $select->fetchAll();
    }
}