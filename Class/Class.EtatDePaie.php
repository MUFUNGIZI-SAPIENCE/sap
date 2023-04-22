<?php
require_once("Class.DB.php");
require_once("Class.Agent.php");
class EtatDePaie{
    public static function sommeEtatDePaie(){
        $con = DB::getDB();
        $select_etat_paie = $con->prepare("SELECT SUM(q.Montantqualite) AS sommeEtat_de_paie FROM agent a INNER JOIN qualite q ON a.Numqualite=q.Numqualite");
        $select_etat_paie->execute();
        if($select_etat_paie->rowCount()>0){
            $data_etat_paie = $select_etat_paie->fetch();
            return $data_etat_paie['sommeEtat_de_paie'];
        }
    }
    // etat de paie par agent
    public static function EtatDePaie_Par_Agent($Codeagent){
        $con = DB::getDB();
        // selection de l'agent
        $Numagent = null;
        $select_agent = $con->prepare("SELECT Numagent FROM agent WHERE Codeagent=?");
        $select_agent->execute([$Codeagent]);
        if($select_agent->rowCount()>0){
            $data_agent = $select_agent->fetch();
            $Numagent = $data_agent['Numagent'];
        }
        $select_etat_paie = $con->prepare("SELECT * FROM agent a INNER JOIN qualite q ON a.Numqualite=q.Numqualite WHERE a.Numagent=?");
        $select_etat_paie->execute([$Numagent]);
        if($select_etat_paie->rowCount()>0){
            $data_etat_paie = $select_etat_paie->fetch();
            return $data_etat_paie['sommeEtat_de_paie'];
        }
    }
}