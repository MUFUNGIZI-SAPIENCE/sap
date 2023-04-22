<?php
require_once("Class.DB.php");
require_once("Class.Date.php");
require_once("Class.Taux.php");
require_once("Class.Eleve.php");
require_once("Class.Comptabilite.php");
require_once("Class.AnneeScolaire.php");
class Paiement{
    private static $Matricule,$Numeleve,$compte_client;

    public static function paiementCollation($Matricule, $motifPaiement,$devise,$montant){
        new Date();
        if($devise =="CDF"){
            $montant = $montant/Taux::getTaux();
        }
        self::$Matricule = $Matricule;
        $montant_debite = null;
        $mois = null;
        $montant_paye = null;
        $anneeScolaire = AnneeScolaire::getAnneeScolaire();
        
        // Selection des eleves
        $con = DB::getDB();

        foreach (Evele::getEleve_Par_Matricule(self::$Matricule) as $value) {
            self::$Numeleve = $value['Numeleve'];
        } 
        self::$compte_client = (41).".".self::$Numeleve;
        foreach (Comptabilite::compteClient_Dediter(self::$compte_client) as $value) {
            self::$compte_client = $value['compteDebitDefaut'];
            $mois = $value['Mois'];
            $montant_debite = $value['Montant'];
            if($value['DeviseCollation'] == "USD" && $devise=="CDF"){
                $montant = $montant/Taux::getTaux();
            }
            if($value['DeviseCollation'] == "CDF" && $devise=="USD"){
                $montant = $montant*Taux::getTaux();
            }
        }
        // Paiement proprement dit de la collation
        if($montant == $montant_debite){
             $motifPaiement = "	Paiement collation et frais de bus";
            $insert_paiement = $con->prepare("INSERT INTO paiement SET Datepaiement=NOW(),
            Motifpaiement=?,MontantPaye=?,compteDebitPaiement=?,compteCreditPaiement=?,Mois=?,Devise=?,IdAnneeScolaire=?");
            if($insert_paiement->execute([$motifPaiement,$montant,'57',self::$compte_client,$mois,$devise,$anneeScolaire])){
                Caisse::genererMontant_Caisse($montant);
                if(Comptabilite::sommePaiement(self::$compte_client,$mois)==$montant_debite){
                    $update_paiement = $con->prepare("UPDATE paiement SET solde=1 WHERE solde=0 AND compteDebitDefaut=? LIMIT 1");
                    if($update_paiement->execute([self::$compte_client])){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                return true;
            }else{
                return false;
            }
        }
        else if($montant >= Comptabilite::sommePaiement(self::$compte_client,$mois)||Comptabilite::sommePaiement(self::$compte_client,$mois)<$montant_debite){
           $insert_paiement = $con->prepare("INSERT INTO paiement SET Datepaiement=NOW(),
           Motifpaiement=?,MontantPaye=?,compteDebitPaiement=?,compteCreditPaiement=?,Mois=?,Devise=?,IdAnneeScolaire=?");
           if($insert_paiement->execute([$motifPaiement,$montant,'57',self::$compte_client,$mois,$devise,$anneeScolaire])){
            if(Comptabilite::sommePaiement(self::$compte_client,$mois)>=$montant_debite){
                $update_paiement = $con->prepare("UPDATE paiement SET solde=1 WHERE solde=0 AND compteDebitDefaut=? LIMIT 1");
                if($update_paiement->execute([self::$compte_client])){
                    return true;
                }
                else{
                    return false;
                }
            }
               return true;
           }else{
               return false;
           }
       }
       else if(Comptabilite::sommePaiement(self::$compte_client,$mois)>$montant_debite){
           $montant += Comptabilite::sommePaiement(self::$compte_client,$mois)-$montant_debite;
           $mois = Date::valeur_Mois_en_Chiffre(Date::moisEnChiffre()+1);
           $insert_paiement = $con->prepare("INSERT INTO paiement SET Datepaiement=NOW(),
           Motifpaiement=?,MontantPaye=?,compteDebitPaiement=?,compteCreditPaiement=?,Mois=?,Devise=?,IdAnneeScolaire=?");
           if($insert_paiement->execute([$motifPaiement,$montant,'57',self::$compte_client,$mois,$devise,$anneeScolaire])){
               return true;
           }else{
               return false;
           }
       }

        if(Comptabilite::sommePaiement(self::$compte_client,$mois)==$montant_debite){
            $update_paiement = $con->prepare("UPDATE paiement SET solde=1 WHERE solde=0 AND compteDebitDefaut=? LIMIT 1");
            if($update_paiement->execute([self::$compte_client])){
                return true;
            }
            else{
                return false;
            }
        }
    }
    // Recuperation de la liste de paiement
    public static function liste_des_entrees(){
        
    }
}