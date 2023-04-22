<?php
require_once('Class.DB.php');
require_once('Class.Date.php');
class Agent{
    private static $nom;
    private static $postnom;
    private static $prenom;
    private static $phone;
    private static $matricule;
    private static $genre;
    private static $fonction;
    private static $qualite;
    private static $password;
    public function __construct($nom,$postnom,$prenom,$phone,$genre,$fonction,$password){
        self::$nom = $nom;
        self::$postnom = $postnom;
        self::$prenom = $prenom;
        self::$phone = $phone;
        self::$genre = $genre;
        self::$fonction = $fonction;
        self::$password = md5($password);
    }
    public static function filtrerFonctionAgent($Numfonction){
        $con = DB::getDB();
        $select_fonction = $con->prepare("SELECT Numfonction FROM agent WHERE Numfonction=?");
        $select_fonction->execute([$Numfonction]);
        if($select_fonction->rowCount()>0){
            $data_fonction = $select_fonction->fetch();
            $fonction= $data_fonction['Numfonction'];
            return $fonction;
        }else{
            return false;
        }
    }
    // Methode d'insertion
    public static function insertAgent(){
        $con = DB::getDB();
        $compte_agent = null;
        $num_compte = null;

        // Selection du compte
        $select_compte = $con->prepare("SELECT Numcompte FROM compte WHERE Numcompte=?");
        $select_compte->execute([42]);
        if($select_compte->rowCount()>0){
            $data = $select_compte->fetch();
            $num_compte = $data['Numcompte'];
        }
        $insert = $con->prepare("INSERT INTO agent SET Nomagent=?, Postnom=?, Prenom=?, Phoneagent=?, Genreagent=?, Numfonction=?, Codeagent=?, Mot_de_passe=?");
        if($insert->execute([self::$nom,self::$postnom,self::$prenom,self::$phone,self::$genre,self::$fonction,'NULL',self::$password])){
            self::genererMatriculeAgent();
            // Selection des agent
            $select_agent = $con->prepare("SELECT Numagent FROM agent ORDER BY Numagent DESC");
            $select_agent->execute();
            if($select_agent->rowCount()>0){
            $data = $select_agent->fetch();
            $num_agent = $data['Numagent'];
            }
            // Concatenation du compte 42 avec le numero de l'agent
            $compte_agent = $num_compte.".".$num_agent;
            $insert_sous_compte = $con->prepare("INSERT INTO sous_compte SET Num_sous_compte=?");
            if($insert_sous_compte->execute([$compte_agent]))
                return true;
        }else
            return false;
        

    }
    // Methode de modification des agents
    public static function updateAgent($IdAgent){
        $con = DB::getDB();
        $insert = $con->prepare("UPDATE agent SET Nomagent=?, Postnom=?, Prenom=?, Phoneagent=?, Genreagent=?, Numfonction=?, Numqualite=?, Codeagent=? WHERE Numagent LIMIT 1");
        if($insert->execute([self::$nom,self::$postnom,self::$prenom,self::$phone,self::$genre,self::$fonction,self::$qualite,'NULL',$IdAgent])){
            self::genererMatriculeAgent();
            return true;
        }else
            return false;

    }
    // Methode de suppression 
    public static function deleteAgent($IdAgent){
        $con = DB::getDB();
        $insert = $con->prepare("DELETE FROM agent WHERE Numagent=? LIMIT 1");
        if($insert->execute([$IdAgent])){
            return true;
        }else
            return false;

    }
    // Generation du code agent
    public static function genererMatriculeAgent(){
        $con = DB::getDB();
        $generer = $con->prepare("SELECT * FROM agent WHERE Codeagent=?");
        $generer->execute(['NULL']);
        $new_code = null;
        foreach ($generer->fetchAll() as $value) {
            $new_code = strtoupper($value['Genreagent'][0]."".$value['Numagent']."AG".$value['Numfonction']);
            $update = $con->prepare("UPDATE agent SET Codeagent=? WHERE Numagent=?");
            $update->execute([$new_code,$value['Numagent']]);
        }
    }
    // Methode de connexion de l'agent
    public static function connexionAgent($codeAgent,$Password){
        // $Con_password = md5($Password);
        $con = DB::getDB();
        $connexion = $con->prepare("SELECT * FROM agent a INNER JOIN fonction f ON a.Numfonction=f.Numfonction WHERE a.Codeagent=?");
        $connexion->execute([$codeAgent]);
        if($connexion->rowCount()>0){
           return $connexion->fetchAll();
        }else{
            return false;
        }      
    }
    // Liste des agents
    public static function listeAgent(){
        // $Con_password = md5($Password);
        $con = DB::getDB();
        $connexion = $con->prepare("SELECT * FROM agent a INNER JOIN fonction f ON a.Numfonction=f.Numfonction");
        $connexion->execute();
        if($connexion->rowCount()>0){
           return $connexion->fetchAll();
        }else{
            return array();
        }      
    }
    // RECUPERATION DE L'AGENT PAR NUM AGENT
    public static function getAgent($Codeagent){
        // $Con_password = md5($Password);
        $con = DB::getDB();
        $select_agent = $con->prepare("SELECT * FROM agent a INNER JOIN fonction f ON a.Numfonction=f.Numfonction WHERE a.Codeagent=?");
        $select_agent->execute([$Codeagent]);
        if($select_agent->rowCount()>0){
           return $select_agent->fetchAll();
        }else{
            return array();
        }      
    }
    // Nombre des agent
    public static function nombre_agent(){
        $con = DB::getDB();
        $select_nb = $con->prepare("SELECT COUNT(*) AS nombre_agent FROM agent");
        $select_nb->execute();
        // Recup nombre d'agent fille
        $select_nb_fille = $con->prepare("SELECT COUNT(*) AS nombre_agent_fille FROM agent WHERE Genreagent=?");
        $select_nb_fille->execute(["Feminin"]);
        // Recup nombre d'agent garcon
        $select_nb_garcon = $con->prepare("SELECT COUNT(*) AS nombre_agent_garcon FROM agent WHERE Genreagent=?");
        $select_nb_garcon->execute(["Masculin"]);

        $nombre_agent = 0;
        $nombre_agent_fille = 0;
        $nombre_agent_garcon = 0;
        $tab_agent = [];
        if($data_agent = $select_nb->fetch())
            $nombre_agent = $data_agent['nombre_agent'];
        if($data_agent = $select_nb_fille->fetch())
            $nombre_agent_fille = $data_agent['nombre_agent_fille'];
        if($data_agent = $select_nb_garcon->fetch())
            $nombre_agent_garcon = $data_agent['nombre_agent_garcon'];
        $tab_agent = [
            'nb_agent'=>$nombre_agent,
            'nb_agent_fille'=>$nombre_agent_fille,
            'nb_agent_garcon'=>$nombre_agent_garcon
        ];
        return $tab_agent;
    }
    // chargement du compte agent d'un montant chaque mois
    public static function chargerCompteAgent($identifiant){
        $con = DB::getDB();
        $mois = Date::moisEnLettre();
        $mois_predend = Date::moisEnLettre();
        // Recuperation de la situation de compte des agents
        $select_compte_agent = $con->prepare("SELECT * FROM compte_agent WHERE Numagent=? AND mois=?");
        $select_compte_agent->execute([$identifiant,$mois]);
        if($select_compte_agent->rowCount()>0){
            // $update_compte = $con->prepare("UPDATE ")
        }
    }
}