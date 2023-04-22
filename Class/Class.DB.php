<?php
class DB
{
    private static $host = null;
    private static $dbname = null;
    private static $user = null;
    private static $password = null;
    // public function __construct($host, $dbname, $user, $password){
    //     self::$host = $host;
    //     self::$dbname = $dbname;
    //     self::$user = $user;
    //     self::$password = $password;
    // }
// Set DB
    private static function setDB()
    {
        self::$host = "localhost";
        self::$dbname = htmlspecialchars('billingue');
        self::$user = "root";
        self::$password ='';
        try {
            $con = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname,self::$user,self::$password);
            return $con;
        } catch (Exception $th) {
            return('Erreur : '.$th);
        }
    }
    // Get DB
    public static function getDB(){
        return self::setDB();
    }
}