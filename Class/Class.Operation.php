<?php
require_once('Class.DB.php');
require_once('Class.Eleve.php');
require_once('Class.Agent.php');
require_once('Class.AnneeScolaire.php');
class Operation{
    public static function get_type_operation(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM typeoperation");
        $select->execute();
        if($select->rowCount()>0){
            return $select->fetchAll();
        }else{
            return array();
        }
    }
    // Ajout des operations
    public static function ajoutOperation($typeOperation,$code,$devise,$montant){
        $con = DB::getDB();
        // Selection de la personne concernee
        $Numagent = 0;
        $Numeleve = 0;       

        $annee_scolaire = AnneeScolaire::getAnneeScolaire();
        $num_sous_compte = null;
        if($typeOperation==1 || $typeOperation == 2 || $typeOperation == 3){
            foreach (Eleve::getEleve_Par_Matricule($code) as $value) {
                $Numeleve = $value['Numeleve'];
            }
            if($Numeleve!=0){
                $num_sous_compte = (41);            
                $insert = $con->prepare("INSERT INTO operation SET Matriceleve=?, DateOperation=CURRENT_DATE(), montant=?, devise=?, NumTypeOperation=?, IdAnneeScolaire=?,debit=?, credit=?");
                if($insert->execute([$code,$montant,$devise,$typeOperation,$annee_scolaire,57,$num_sous_compte]))
                    return true;
                else
                    return false;
            }else{
                return 2;
            }
        }else if($typeOperation==5){
            foreach (Agent::getAgent($code) as $value) {
                $Numagent = $value['Numagent'];
            }
            $num_sous_compte = (4211) ;
            if($Numagent !=0){
                $insert = $con->prepare("INSERT INTO operation SET Codeagent=?, DateOperation=CURRENT_DATE(), montant=?, devise=?, NumTypeOperation=?, IdAnneeScolaire=?,debit=?, credit=?");
                if($insert->execute([$code,$montant,$devise,$typeOperation,$annee_scolaire,$num_sous_compte,57]))
                    return true;
                else
                    return false;
            }else{
                return 3;
            }         
            
        }else if($typeOperation==6){
            foreach (Agent::getAgent($code) as $value) {
                $Numagent = $value['Numagent'];
            }
            $num_sous_compte = (421) ;
            if($Numagent !=0){
                $insert = $con->prepare("INSERT INTO operation SET Codeagent=?, DateOperation=CURRENT_DATE(), montant=?, devise=?, NumTypeOperation=?, IdAnneeScolaire=?,debit=?, credit=?");
                if($insert->execute([$code,$montant,$devise,$typeOperation,$annee_scolaire,$num_sous_compte,57]))
                    return true;
                else
                    return false;
            }else{
                return 3;
            } 
        }
        else if($typeOperation==4){
            $insert = $con->prepare("INSERT INTO operation SET DateOperation=CURRENT_DATE(), montant=?, devise=?, NumTypeOperation=?, IdAnneeScolaire=?,debit=?, credit=?");
            if($insert->execute([$montant,$devise,$typeOperation,$annee_scolaire,57,14]))
                return true;
            else
                return false;
        }
        else{
            $insert = $con->prepare("INSERT INTO operation SET DateOperation=CURRENT_DATE(), montant=?, devise=?, NumTypeOperation=?, IdAnneeScolaire=?,debit=?, credit=?");
            if($insert->execute([$montant,$devise,$typeOperation,$annee_scolaire,33,57]))
                return true;
            else
                return false;
        }
        
    }
}