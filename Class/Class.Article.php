<?php
require_once('Class.DB.php');
require_once('Class.Date.php');
class Article{

    public static function rechercherArticle($Nom_de_l_article){
        $con = DB::getDB();
        $select_article = $con->prepare("SELECT * FROM article WHERE Designationarticle LIKE ?");
        $select_article->execute(["%$Nom_de_l_article%"]);
        // foreach($select_article->fetchAll() as $data){
        //     return $data;
        // }
        $data = $select_article->fetch();
        return $data;
        
    }
}