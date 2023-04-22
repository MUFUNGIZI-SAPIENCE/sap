<?php
require_once('Class.DB.php');
require_once('Class.Date.php');
class AvanceSalaire{
    private static $codeAgent,$Montant;
public static function ajouterAvanceSalaire($codeAgent,$Montant,$devise,$libelle){
    $con = DB::getDB();
    self::$codeAgent = $codeAgent;
    self::$Montant = $Montant;
    // Recuperation de l'agent
    $select_agent = $con->prepare("SELECT Numagent FROM agent WHERE Codeagent=?");
    $select_agent->execute([self::$codeAgent]);
    $data_agent = $select_agent->fetch();
    $Numagent = $data_agent['Numagent'];
    // Selection de l'annee scolaire
    $select_anneeScolaire = $con->prepare("SELECT IdAnneeScolaire FROM annee_scolaire ORDER BY IdAnneeScolaire DESC");
    $select_anneeScolaire->execute();
    $data_anneeScolaire = $select_anneeScolaire->fetch();
    $IdAnneeScolaire = $data_anneeScolaire['IdAnneeScolaire'];
        new Date();
        $mois = Date::moisEnLettre();
        $insert_avance = $con->prepare("INSERT INTO avance SET Dateavance=NOW(),Montantavance=?,devise=?,Libelleavance=?,Numagent=?,Mois=?,IdAnneeScolaire=?");
        if($insert_avance->execute([self::$Montant,$devise,$libelle,$Numagent,$mois,$IdAnneeScolaire]))
            return true;
        else 
            return false;
     
}
// recuperation de la somme des avance d'un mois
public static function sommeAvance_du_Mois($Numagent){
    $con = DB::getDB();
    $select_somme_avance = $con->prepare("SELECT SUM(Montantavance) AS sommeAvance FROM avance WHERE Numagent=?");
    $select_somme_avance->execute([$Numagent]);
    if($select_somme_avance->rowCount()>0){
        $data_somme_avance = $select_somme_avance->fetch();
        $SommeAvance = $data_somme_avance['sommeAvance'];
        return $SommeAvance;    
    }else{
        return 0;
    }
}
// Avance salaire du jour
public static function avanceSalaireDu_Jour(){
    $con = DB::getDB();
    $select_avance_du_jour = $con->prepare("SELECT *, DATE_FORMAT(av.Dateavance,'%d/%m/%Y') AS DateAvance FROM avance av INNER JOIN agent ag ON av.Numagent=ag.Numagent WHERE av.Dateavance=CURRENT_DATE()");
    $select_avance_du_jour->execute();
    if($select_avance_du_jour->rowCount()>0){
        return $select_avance_du_jour->fetchAll();
    }else{
        return array();
    }
}
// Avance salaire du jour
public static function avanceSalaireDu_Jour_Par_Id_avance($id_avance){
    $con = DB::getDB();
    $select_avance_du_jour = $con->prepare("SELECT *, DATE_FORMAT(av.Dateavance,'%d/%m/%Y') AS DateAvance FROM avance av INNER JOIN agent ag ON av.Numagent=ag.Numagent WHERE av.Dateavance=CURRENT_DATE() AND av.Numavance=?");
    $select_avance_du_jour->execute([$id_avance]);
    if($select_avance_du_jour->rowCount()>0){
        return $select_avance_du_jour->fetchAll();
    }else{
        return array();
    }
}
// Toutes les notes d'avance sur salaire
public static function toute_avance_sur_Salaire(){
    $con = DB::getDB();
    $select_avance_du_jour = $con->prepare("SELECT *, DATE_FORMAT(av.Dateavance,'%d/%m/%Y') AS DateAvance FROM avance av INNER JOIN agent ag ON av.Numagent=ag.Numagent");
    $select_avance_du_jour->execute();
    if($select_avance_du_jour->rowCount()>0){
        return $select_avance_du_jour->fetchAll();
    }else{
        return array();
    }
}
// Les notes d'avance sur salaire que le caissier peut voir
public static function note_Avance_sur_Salaire_Non_servie($Numavance ){
    $con = DB::getDB();
    $select_avance_du_jour = $con->prepare("SELECT *, DATE_FORMAT(av.Dateavance,'%d/%m/%Y') AS DateAvance FROM avance av INNER JOIN agent ag ON av.Numagent=ag.Numagent WHERE av.etat=? AND av.Numavance=?");
    $select_avance_du_jour->execute([0,$Numavance]);
    if($select_avance_du_jour->rowCount()>0){
        return $select_avance_du_jour->fetchAll();
    }else{
        return array();
    }
}

}