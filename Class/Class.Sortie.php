<?php
require_once('Class.DB.php');
class Sortie{

    private static $Montant, $libelle,$Id_causse_sortie;
/**
 * @param int $Id_causse_sortie : Prend la valeur de l'identifiant qui cause la sortie d'argent. Par exemple avance sur 
 * salaire, remuneration du personnel et un etat des besoins.
 */
    public function __construct($libelle,$Id_causse_sortie)
    {
        // self::$Montant = $Montant;
        self::$libelle = $libelle;
        self::$Id_causse_sortie = $Id_causse_sortie;
    }
// Sortie de fonds pour avance
    public static function sortieFonds_Avance(){
        $con = DB::getDB();
        $select_avance = $con->prepare("SELECT * FROM avance WHERE etat=0 OR etat=1 AND Numavance=?");
        if($select_avance->execute([self::$Id_causse_sortie])){
            $data_avance = $select_avance->fetch();
            self::$Montant = $data_avance['Montantavance'];
            // Selection de l'avance de salaire depuis la table
            $select_avance_deja_sortie = $con->prepare("SELECT * FROM sortie s INNER JOIN avance av ON s.NumnoteAvance=av.Numavance");
            $select_avance_deja_sortie->execute();
            if($select_avance_deja_sortie->rowCount()>0){
                return 2;
            }else{
                $insert_avance = $con->prepare("INSERT INTO sortie SET Datesortie=CURRENT_DATE(),Libellesortie,montantsortie=?,NumnoteAvance=?");
                if($insert_avance->execute([self::$libelle,self::$Montant,self::$Id_causse_sortie]))
                    $update_avance = $con->prepare("UPDATE avance SET etat=? WHERE etat=? AND Numavance=? LIMIT 1");
                    if($update_avance->execute([1,0,self::$Id_causse_sortie]))
                        return true;
            }
        }
    }
// Sortie de fonds pour remuneration des agents
public static function sortieFonds_Remuneration(){
    $con = DB::getDB();
    $select_avance = $con->prepare("SELECT * FROM remuneration WHERE MontantRemunere!=? AND Numavance=?");
    if($select_avance->execute([0,self::$Id_causse_sortie])){
        $insert_avance = $con->prepare("INSERT INTO sortie SET montantsortie=?,NumnoteAvance=?");
        if($insert_avance->execute([self::$Montant,self::$Id_causse_sortie]))
            return true;
    }
}
// Liste des sorties 
public static function listeDeSortie(){
    $con = DB::getDB();
    $select_sortie = $con->prepare("SELECT * FROM sortie s LEFT JOIN remuneration r ON s.NumREM=r.NumREM OR s.NumREM IS NULL LEFT JOIN etatdebesoin etb ON etb.NumEB=s.NumEB OR s.NumEB IS NULL LEFT JOIN avance av ON av.Numavance=s.NumnoteAvance OR s.NumnoteAvance IS NULL INNER JOIN agent ag ON ag.Numagent=av.Numagent ORDER BY s.Numsortie DESC");
    $select_sortie->execute();
    if($select_sortie->rowCount()>0){
        return $select_sortie->fetchAll();
    }else{
        return array();
    }
}
}