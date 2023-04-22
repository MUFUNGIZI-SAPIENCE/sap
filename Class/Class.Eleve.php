<?php
require_once('Class.DB.php');
require_once('Class.AnneeScolaire.php');
class Eleve{
    private static $nom;
    private static $postnom;
    private static $prenom;
    private static $AnneeScolaire;
    private static $genre;
    private static $classe;
    private static $degre;
    private static $option;
    public function __construct($nom,$postnom,$prenom,$genre,$classe,$degre,$option=null){
        self::$nom = $nom;
        self::$postnom = $postnom;
        self::$prenom = $prenom;
        self::$genre = $genre;
        self::$classe = $classe;
        self::$degre = $degre;
        self::$option = $option;
    }
    // Methode d'insertion
    public static function insertEvele(){
        $con = DB::getDB();
        $insert = $con->prepare("INSERT INTO eleve SET Matriceleve=?, Nomeleve=?, Postnomeleve=?, Prenomeleve=?, Sexeeleve=?, Numclasse=?,degre=?,options=?");
        if($insert->execute(['NULL',self::$nom,self::$postnom,self::$prenom,self::$genre,self::$classe,self::$degre,self::$option])){
            self::genererMatriculeEleve();
            self::inscrireEleve(self::ID_dernier_eleve_Inscrit());
            return true;
        }else
            return false;

    }
    // Methode de l'inscription des eleves
    public static function inscrireEleve($Numeleve){
        $con = DB::getDB();
        self::$AnneeScolaire = AnneeScolaire::getAnneeScolaire();
        $insert = $con->prepare("INSERT INTO inscription SET DateInscription=CURRENT_DATE(), Numeleve=?, Numclasse=?, Numoption=?, Numannee=?");
        if($insert->execute([$Numeleve,self::$classe,self::$option,self::$AnneeScolaire])){
            return true;
        }else
            return false;
    }
    // Recuperation du dernier ID de l'eleve inscrit
    public static function ID_dernier_eleve_Inscrit(){
        $con = DB::getDB();
        $select_eleve = $con->prepare("SELECT Numeleve FROM eleve ORDER BY Numeleve DESC");
        $select_eleve->execute();
        if($select_eleve->rowCount()>0){
            if($data = $select_eleve->fetch()){
                return $data['Numeleve'];
            }
        }
    }
    // Methode de modification
    public static function modifierEvele($maticule){
        $con = DB::getDB();
        $update = $con->prepare("UPDATE eleve SET Matriceleve=?, Nomeleve=?, Postnomeleve=?, Prenomeleve=?, Sexeeleve=?, Numclasse=?,degre=?,options=? WHERE Matriceleve=? LIMIT 1");
        if($update->execute(["NULL",self::$nom,self::$postnom,self::$prenom,self::$genre,self::$classe,self::$degre,self::$option, $maticule])){
            self::genererMatriculeEleve();
            return true;
        }else
            return false;

    }
    // Methode de suppression 
    public static function deleteEvele($IdEleve){
        $con = DB::getDB();
        $insert = $con->prepare("DELETE FROM eleve WHERE Numeleve=? LIMIT 1");
        if($insert->execute([$IdEleve])){
            return true;
        }else
            return false;

    }
    // Methode de generation du matricule de l'eleve
    public static function genererMatriculeEleve(){
        $con = DB::getDB();
        $generer = $con->prepare("SELECT * FROM eleve WHERE Matriceleve =?");
        $generer->execute(['NULL']);
        $new_matricule = null;
        foreach ($generer->fetchAll() as $value) {
            $new_matricule = strtoupper($value['Sexeeleve'][0]."".$value['Numeleve']."ELV");
            $update = $con->prepare("UPDATE eleve SET Matriceleve=? WHERE Numeleve=?");
            $update->execute([$new_matricule,$value['Numeleve']]);
        }
    }
    // Methode de recuperation de la liste des eleves
    public static function listeEleve(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM eleve e INNER JOIN classe c ON e.Numclasse=c.Numclasse LEFT JOIN options o ON e.options=o.NumOption OR e.options=NULL INNER JOIN inscription i ON e.Numeleve=i.Numeleve");
        $select->execute();
        return $select->fetchAll();
    }
    // Recuperer l'eleve par son matricule
    public static function getEleve_Par_Matricule($Matricule){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM eleve e INNER JOIN classe c ON e.Numclasse=c.Numclasse LEFT JOIN options o ON e.options=o.NumOption OR e.options=NULL INNER JOIN inscription i ON e.Numeleve=i.Numeleve WHERE e.Matriceleve=?");
        $select->execute([$Matricule]);
        // if($select->rowCount()>0)
            return $select->fetchAll();
        // else
        //     return array();
    }
    // Recuperation de nombre d'eleve inscrit
    public static function nombre_eleve_inscrit(){
        $con = DB::getDB();
        $select_nb = $con->prepare("SELECT COUNT(*) AS nombre_eleve_inscrit FROM eleve");
        $select_nb->execute();
        // Recup nombre d'eleve fille
        $select_nb_fille = $con->prepare("SELECT COUNT(*) AS nombre_eleve_fille FROM eleve WHERE Sexeeleve=?");
        $select_nb_fille->execute(["Feminin"]);
        // Recup nombre d'eleve garcon
        $select_nb_garcon = $con->prepare("SELECT COUNT(*) AS nombre_eleve_garcon FROM eleve WHERE Sexeeleve=?");
        $select_nb_garcon->execute(["Masculin"]);

        $nombre_eleve_inscrit = 0;
        $nombre_eleve_fille = 0;
        $nombre_eleve_garcon = 0;
        $tab_eleve = [];
        if($data_eleve = $select_nb->fetch())
            $nombre_eleve_inscrit = $data_eleve['nombre_eleve_inscrit'];
        if($data_eleve = $select_nb_fille->fetch())
            $nombre_eleve_fille = $data_eleve['nombre_eleve_fille'];
        if($data_eleve = $select_nb_garcon->fetch())
        $nombre_eleve_garcon = $data_eleve['nombre_eleve_garcon'];
        $tab_eleve = [
            'nb_eleve'=>$nombre_eleve_inscrit,
            'nb_eleve_fille'=>$nombre_eleve_fille,
            'nb_eleve_garcon'=>$nombre_eleve_garcon
        ];
        return $tab_eleve;
    }
}