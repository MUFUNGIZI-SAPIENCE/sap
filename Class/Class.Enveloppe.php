<?php
require_once("Class.DB.php");
require_once("Class.Date.php");
require_once("Class.Agent.php");
require_once("Class.EtatDePaie.php");

class Enveloppe{
    public static function genererEnveloppe(){
        new Date();
        $mois = Date::moisEnLettre();
        $con = DB::getDB();
        $sommePaiement = 0;
        $anneeScolaire = null;
        $mois_paie = null;
        // Selection du paiement de chaque mois
        $select_paiement = $con->prepare("SELECT * FROM paiement p INNER JOIN anneescolaire a ON a.IdAnneeScolaire=p.IdAnneeScolaire WHERE compteDebitPaiement=? AND Mois=?");
        $select_paiement->execute([57,$mois]);
        if($select_paiement->rowCount()>0){
            foreach ($select_paiement->fetchAll() as $value) {
                $sommePaiement += $value['MontantPaye'];
                $anneeScolaire = $value['IdAnneeScolaire'];
                $mois_paie =  $value['Mois'];
            }
        }
        // Selection du montant de l'enveloppe de chaque mois
        $select_enveloppe = $con->prepare("SELECT * FROM enveloppe WHERE Mois=?");
        $select_enveloppe->execute([$mois_paie]);
        $montantEnveloppe = 0;
        if($select_enveloppe->rowCount()>0){
            $data_enveloppe = $select_enveloppe->fetch();
            $mois_enveloppe = $data_enveloppe['Mois'];
            if($mois_paie != $mois_enveloppe){
                $montantEnveloppe = ($sommePaiement*60)/100;
                if($montantEnveloppe >= EtatDePaie::sommeEtatDePaie()){
                    $montantEnveloppe = EtatDePaie::sommeEtatDePaie();
                    if($mois_paie != $mois){
                        $insert_enveloppe = $con->prepare("INSERT INTO enveloppe SET Montenveloppe=?,Mois=?,AnneeScolaire=?");
                        $insert_enveloppe->execute([$montantEnveloppe,$mois_paie,$anneeScolaire]);
                    }
                }
            }
        }else{
            if($sommePaiement >= EtatDePaie::sommeEtatDePaie()){
                $montantEnveloppe = EtatDePaie::sommeEtatDePaie();
                    $insert_enveloppe = $con->prepare("INSERT INTO enveloppe SET Montenveloppe=?,Mois=?,AnneeScolaire=?");
                    $insert_enveloppe->execute([$montantEnveloppe,$mois_paie,$anneeScolaire]);
                
            }
        }
        
    }

}