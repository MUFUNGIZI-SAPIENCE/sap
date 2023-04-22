<?php
require_once('Class.DB.php');
require_once('Class.Date.php');
require_once('Class.Agent.php');
require_once('Class.Eleve.php');
class Comptabilite{

    // Methode de creation de compte des eleves
    /**
     * @param int $Num_eleve_Inscrit : Recupere le numéro de l'élève inscrit
     */
    public static function creerCompte_Eleve($Num_eleve_Inscrit){
        $con = DB::getDB();
        $num_compte_eleve = (41).".".$Num_eleve_Inscrit;
        $id_compte = self::ID_compte(41);
        $insert_sous_compte = $con->prepare("INSERT INTO sous_compte SET IdCompte=?, Num_sous_compte=?, Identifiant=?");
        if($insert_sous_compte->execute([$id_compte,$num_compte_eleve,$Num_eleve_Inscrit])){
            $update_agent = $con->prepare("UPDATE inscription SET compte_cree=? WHERE Numeleve=?");
            $update_agent->execute([1,$Num_eleve_Inscrit]);
            return true;
        }else{
            return false;
        }
    }
    // Methode d'ajout des compte
    public static function ajouterCompte($sous_type_compte,$num_compte_ajout,$libelle_num_compte){
        $con = DB::getDB();
        if(self::getCompte_par_NumeroCompte($num_compte_ajout) == null){
            $insert_compte = $con->prepare("INSERT INTO compte SET Numcompte=?, Libellecompte=?, Num_sous_type_compte=?");
            if($insert_compte->execute([$num_compte_ajout,$libelle_num_compte,$sous_type_compte])){
                return true;
            }else{
                return false;
            }
        }
        else
            return 2;
    }
    // Modificatiion d'un compte
    public static function modifierCompte($sous_type_compte,$num_compte_ajout,$libelle_num_compte,$Idcompte){
        $con = DB::getDB();
        $insert_compte = $con->prepare("UPDATE compte SET Numcompte=?, Libellecompte=?, Num_sous_type_compte=? WHERE Idcompte=?");
        if($insert_compte->execute([$num_compte_ajout,$libelle_num_compte,$sous_type_compte,$Idcompte])){
            return true;
        }else{
            return false;
        }
    }
    // recuperation du compter son numero
    public static function getCompte_par_NumeroCompte($Numero_compte){
        $con = DB::getDB();
        $select_compte = $con->prepare("SELECT * FROM compte c INNER JOIN sous_type_compte stc ON c.Num_sous_type_compte=stc.Num_sous_type_compte INNER JOIN type_compte tc ON stc.NumTypeCompte=tc.Numtypecompte WHERE c.Numcompte=?");
        $select_compte->execute([$Numero_compte]);
        if($select_compte->rowCount()>0){
           $data_num_compte = $select_compte->fetch();
            return $data_num_compte['Numcompte'];
        }else{
            return null;
        }
    }
    // Retour de libelle de compte selon le numero de compte
    public static function getLibelleCompte_par_NumeroCompte($Numero_compte){
        $con = DB::getDB();
        $select_compte = $con->prepare("SELECT * FROM compte c INNER JOIN sous_type_compte stc ON c.Num_sous_type_compte=stc.Num_sous_type_compte INNER JOIN type_compte tc ON stc.NumTypeCompte=tc.Numtypecompte WHERE c.Numcompte=?");
        $select_compte->execute([$Numero_compte]);
        if($select_compte->rowCount()>0){
           $data_num_compte = $select_compte->fetch();
            return $data_num_compte['Libellecompte'];
        }else{
            return null;
        }
    }
    // recuperation du compter son id
    public static function getCompte_par_ID_Compte($Idcompte ){
        $con = DB::getDB();
        $select_compte = $con->prepare("SELECT * FROM compte c INNER JOIN sous_type_compte stc ON c.Num_sous_type_compte=stc.Num_sous_type_compte INNER JOIN type_compte tc ON stc.NumTypeCompte=tc.Numtypecompte WHERE c.Idcompte =?");
        $select_compte->execute([$Idcompte ]);
        if($select_compte->rowCount()>0){
           return $select_compte->fetchAll();
        }else{
            return array();
        }
    }
    // Liste des compte
    public static function liste_des_Comptes(){
        $con = DB::getDB();
        $select_compte = $con->prepare("SELECT * FROM compte c INNER JOIN sous_type_compte stc ON c.Num_sous_type_compte=stc.Num_sous_type_compte INNER JOIN type_compte tc ON stc.NumTypeCompte=tc.Numtypecompte ORDER BY c.Numcompte ASC");
        $select_compte->execute();
        if($select_compte->rowCount()>0){
            return $select_compte->fetchAll();
        }else{
            return array();
        }
    }
    // Recuperation des type de compte
    public static function get_type_compte(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM type_compte");
        $select->execute();
        if($select->rowCount()>0){
            return $select->fetchAll();
        }else{
            return array();
        }
    }
    // Recuperation des sous type de compte
    public static function get_sous_type_compte($Num_type_compte){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM sous_type_compte WHERE NumTypeCompte=?");
        $select->execute([$Num_type_compte]);
        if($select->rowCount()>0){
            return $select->fetchAll();
        }else{
            return array();
        }
    }
    // Liste des eleves sans compte cree
    public static function liste_Eleve_Sans_compte_cree(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM inscription i INNER JOIN eleve e ON i.Numeleve=e.Numeleve INNER JOIN classe c ON c.Numclasse=i.Numclasse LEFT JOIN options o ON i.Numoption=o.NumOption OR i.Numoption IS NULL INNER JOIN annee_scolaire a ON i.Numannee=a.IdAnneeScolaire WHERE i.compte_cree=?");
        $select->execute([0]);
        return $select->fetchAll();
    }
    // Liste des eleves avec compte cree
    public static function liste_Eleve_Avec_compte_cree(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM inscription i INNER JOIN eleve e ON i.Numeleve=e.Numeleve INNER JOIN classe c ON c.Numclasse=i.Numclasse LEFT JOIN options o ON i.Numoption=o.NumOption OR i.Numoption IS NULL INNER JOIN annee_scolaire a ON i.Numannee=a.IdAnneeScolaire WHERE i.compte_cree=?");
        $select->execute([1]);
        return $select->fetchAll();
    }
    // Methode de creation de compte des agents
    /**
     * @param int $Num_agent : Recupere le numéro de l'agent enregistré
     */
    public static function creerCompte_Agent($Num_agent){
        $con = DB::getDB();
        $num_compte_agent = (42).".".$Num_agent;
        $id_compte = self::ID_compte(42);
        $insert_sous_compte = $con->prepare("INSERT INTO sous_compte SET IdCompte=?, Num_sous_compte=?, Identifiant=?");
        if($insert_sous_compte->execute([$id_compte,$num_compte_agent,$Num_agent])){
            $update_agent = $con->prepare("UPDATE agent SET compte_cree=? WHERE Numagent=?");
            $update_agent->execute([1,$Num_agent]);
            return true;
        }else{
            return false;
        }
    }
    // Liste des agents sans compte cree
    public static function liste_Agent_Sans_compte_cree(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM agent a INNER JOIN fonction f ON a.Numfonction=f.Numfonction WHERE a.compte_cree=?");
        $select->execute([0]);
        return $select->fetchAll();
    }
    // Liste des eleves avec compte cree
    public static function liste_Agent_Avec_compte_cree(){
        $con = DB::getDB();
        $select = $con->prepare("SELECT * FROM agent a INNER JOIN fonction f ON a.Numfonction=f.Numfonction WHERE a.compte_cree=?");
        $select->execute([1]);
        return $select->fetchAll();
    }
    // Recuperation de l'ID du compte par le numero compte
    public static function ID_compte($num_compte){
        $con = DB::getDB();
        $select_ID_compte = $con->prepare("SELECT Idcompte  FROM compte WHERE Numcompte=?");
        $select_ID_compte->execute([$num_compte]);
        if($select_ID_compte->rowCount()>0){
            $data_ID_compte = $select_ID_compte->fetch();
            return $data_ID_compte['Idcompte'];
        }else{
            return array();
        }
    }
    // Les comptes des eleves a crediter et debiter par defaut
    public static function crediterDebiterCompteEleve_par_Defaut(){
        $con = DB::getDB();
        new Date();
        $mois = Date::moisEnLettre();
        $valeur_Mois_en_Chiffre = Date::moisEnChiffre() !=1 ? Date::moisEnChiffre()-1:Date::moisEnChiffre();
        $mois_precedent = Date::valeur_Mois_en_Chiffre($valeur_Mois_en_Chiffre);
        $mois_suivant_en_chiffre = Date::moisEnChiffre() !=12 ? Date::moisEnChiffre()+1:Date::moisEnChiffre()-11;
        $mois_precedent_en_chiffre = Date::moisEnChiffre() !=1 ? Date::moisEnChiffre()-1:Date::moisEnChiffre()+11;
        // Recuperation de la collation 
        $select_collation = $con->prepare("SELECT * FROM collation c INNER JOIN anneescolaire a ON c.IdAnneeScolaire=a.IdAnneeScolaire ORDER BY a.IdAnneeScolaire DESC");
        $select_collation->execute();
        $data_collation = $select_collation->fetch();
        $montant_a_debiter = $data_collation['MontantCollation']+$data_collation['MontantBus'];
        $IdAnneeScolaire = $data_collation['IdAnneeScolaire'];
        // Selection des eleves
        $select_eleve = $con->prepare("SELECT * FROM eleve");
        $select_eleve->execute();
        if($select_eleve->rowCount()>0){
            foreach ($select_eleve->fetchAll() as $data_ele) {
                $compte_eleve = (41).".".$data_ele['Numeleve'];
               // Recuperation de la situation des comptes de chaque eleve depuis la table paiement
                $select_paiement = $con->prepare("SELECT * FROM paiement WHERE compteDebitDefaut=? AND Mois=?");
                $select_paiement->execute([$compte_eleve,$mois]);
                $mois_paiement = null;
                if($select_paiement->rowCount()>0){
                    foreach ($select_paiement->fetchAll() as $value){
                        if($value['solde']==1 && $value['Mois']!=$mois && ($mois_suivant_en_chiffre-Date::moisEnChiffre())==1){
                            $insert = $con->prepare("INSERT INTO paiement SET compteDebitDefaut=?,compteCreditDefaut=?,Montant=?,IdAnneeScolaire=?,Mois=?");
                            if($insert->execute([$value['Num_sous_compte'],'706',$montant_a_debiter,$IdAnneeScolaire,$mois]))
                                return true;
                            else
                                return false;
                        }
                        else if($value['solde']==0 && $value['Mois']!=$mois && (Date::moisEnChiffre()-Date::mois_de_Lettre_en_Chiffre($value['Mois']))==1){
                            $solde = $montant_a_debiter - self::sommePaiement($compte_eleve,$mois_precedent);
                            $montant_a_debiter += $solde;
                            $insert = $con->prepare("INSERT INTO paiement SET compteDebitDefaut=?,compteCreditDefaut=?,Montant=?,IdAnneeScolaire=?,Mois=?");
                            if($insert->execute([$value['Num_sous_compte'],'706',$montant_a_debiter,$IdAnneeScolaire,$mois]))
                                return true;
                            else
                                return false;
                        }else{
                            return;
                        }
                    }
                }else{
                    $insert = $con->prepare("INSERT INTO paiement SET compteDebitDefaut=?,compteCreditDefaut=?,Montant=?,IdAnneeScolaire=?,Mois=?");
                    if($insert->execute([$compte_eleve,'706',$montant_a_debiter,$IdAnneeScolaire,$mois])){
                        continue;
                    }
                    // else{
                    //     return false;
                    // }                        
                } 
            }
        }
        
    }
    // Methode qui credite et debite le compte des personnel par defaut
    public static function crediterDebiterComptePersonnel_par_Defaut()
    {
        new Date();
        $mois = Date::moisEnLettre();
        $valeur_Mois_en_Chiffre = Date::moisEnChiffre() !=1 ? Date::moisEnChiffre()-1:Date::moisEnChiffre();
        $mois_precedent = Date::valeur_Mois_en_Chiffre($valeur_Mois_en_Chiffre);
        $mois_suivant_en_chiffre = Date::moisEnChiffre() !=12 ? Date::moisEnChiffre()+1:Date::moisEnChiffre()-11;
        $mois_precedent_en_chiffre = Date::moisEnChiffre() !=1 ? Date::moisEnChiffre()-1:Date::moisEnChiffre()+11;
        $con = DB::getDB();
        // Selection des agents
        $select_agent = $con->prepare("SELECT * FROM agent a INNER JOIN qualite q ON a.Numqualite=q.Numqualite");
        $select_agent->execute();
        $compte_agent = null;
        $montant_de_remuneration = null;
        $montant_solde = 0;
        $select_anneeScolaire = $con->prepare("SELECT IdAnneeScolaire FROM anneescolaire ORDER BY IdAnneeScolaire DESC");
        $select_anneeScolaire->execute();
        $data_anneeScolaire = $select_anneeScolaire->fetch();
        $IdAnneeScolaire = $data_anneeScolaire['IdAnneeScolaire'];
        if($select_agent->rowCount()>0){
            foreach ($select_agent->fetchAll() as $value) {
                $compte_agent = (42).".".$value['Numagent'];
                $montant_de_remuneration = $value['Montantqualite'];
                // Recuperation des donnees depuis la table remuneration
                $select_remuneration = $con->prepare("SELECT * FROM remuneration WHERE compteCreditDefaut=? AND Mois=?");
                $select_remuneration->execute([$compte_agent,$mois]);
                if($select_remuneration->rowCount()>0){
                    $data_remurenation = $select_remuneration->fetch();
                    if($data_remurenation['solde']==1 && ($mois_suivant_en_chiffre-Date::moisEnChiffre()==1) && $value['Mois']!=$mois){
                        $insert = $con->prepare("INSERT INTO remuneration SET Numagent=?,compteDebitDefaut=?,compteCreditDefaut=?,Montant=?,IdAnneeScolaire=?,Mois=?");
                        if($insert->execute([$value['Numagent'],'66',$compte_agent,$montant_de_remuneration,$IdAnneeScolaire,$mois])){
                            continue;
                        }
                        // else{
                        //     return false;
                        // }
                    }
                    
                }else{
                    $insert = $con->prepare("INSERT INTO remuneration SET Numagent=?,compteDebitDefaut=?,compteCreditDefaut=?,Montant=?,IdAnneeScolaire=?,Mois=?");
                    if($insert->execute([$value['Numagent'],'66',$compte_agent,$montant_de_remuneration,$IdAnneeScolaire,$mois])){
                        continue;
                    }
                    // else{
                    //     return false;
                    // }
                }
            }
            
        }
    }
    // Recuperation des clients dont le compte est debite (qui ont de dette)
    public static function compteClient_Dediter($compteClient){
        $con = DB::getDB();
        $select_client_debiter = $con->prepare("SELECT * FROM paiement p INNER JOIN anneescolaire a ON p.IdAnneeScolaire=a.IdAnneeScolaire WHERE p.compteDebitDefaut=? AND p.solde=0");
        $select_client_debiter->execute([$compteClient]);
        if($select_client_debiter->rowCount()>0){
            return $select_client_debiter->fetchAll();
        }
    }
    // Somme de montant payé 
    public static function sommePaiement($compte_client,$mois){
        $con = DB::getDB();
        $somme = $con->prepare("SELECT SUM(MontantPaye) AS sommeMontantPaye FROM paiement WHERE compteCreditPaiement=? AND Mois=?");
        $somme->execute([$compte_client,$mois]);
        if($somme->rowCount()>0){
            $data = $somme->fetch();
            $resultat = $data['sommeMontantPaye'];
            return $resultat;
        }else
            return 0;
    }
    // Fonction de journalisation
    public static function journalisation(){
        $con = DB::getDB();
        $journal_jour = $con->prepare("SELECT * FROM operation o INNER JOIN compte c ON o.debit=c.Numcompte INNER JOIN typeoperation top ON o.NumTypeOperation=top.Num_type_operation");
        $journal_jour->execute();
        if($journal_jour->rowCount()>0){
            return $journal_jour->fetchAll();
        }else{
            return array();
        }
    }
    // Fonction du bilan
    public static function bilan(){
        $con = DB::getDB();
        $bilan = $con->prepare("SELECT *, c.Numcompte, SUM(montant) as debit, SUM(montant) as credit FROM operation o INNER JOIN compte c ON o.debit=c.Numcompte OR o.credit=c.Numcompte INNER JOIN sous_type_compte stc ON stc.Num_sous_type_compte=c.Num_sous_type_compte WHERE c.Num_sous_type_compte=1 OR c.Num_sous_type_compte=2 GROUP BY c.Numcompte");
        $bilan->execute();
        if($bilan->rowCount()>0){
            return $bilan;
        }else{
            return array();
        }
    }
    // Liste des entrees
    public static function liste_entree(){
        $con = DB::getDB();
        $select_operation = $con->prepare("SELECT * FROM operation o INNER JOIN typeoperation tyo ON o.NumTypeOperation=tyo.Num_type_operation WHERE o.debit=57");
        $select_operation->execute();
        if($select_operation->rowCount()>0){
            return $select_operation->fetchAll();
        }else{
            return array();
        }
    }
    // Liste des sorties
    public static function liste_sortie(){
        $con = DB::getDB();
        $select_operation = $con->prepare("");
        $select_operation->execute();
        if($select_operation->rowCount()>0){
            return $select_operation->fetchAll();
        }else{
            return array();
        }
    }
    // Releve de compte agent
    public static function releveDE_compte_agent($Numagent){
        $con = DB::getDB();
        // $Numagent = null;
        // foreach (Agent::getAgent($code_agent) as $value) {
        //     $Numagent = $value['Numagent'];
        // }
        $select_releve_agent = $con->prepare("SELECT * FROM operation o INNER JOIN typeoperation top ON o.NumTypeOperation=top.Num_type_operation INNER JOIN agent a ON o.Codeagent=a.Codeagent INNER JOIN annee_scolaire an ON o.IdAnneeScolaire WHERE a.Codeagent=?");
        $select_releve_agent->execute([$Numagent]);
        if($select_releve_agent->rowCount()>0){
            return $select_releve_agent->fetchAll();
        }else{
            return array();
        }  
    }
    // Releve de compte eleve
    public static function releveDE_compte_Eleve($CodeEleve){
        $con = DB::getDB();
        $Numeleve =01;
        $select_eleve = $con->prepare("SELECT Numeleve FROM eleve WHERE Matriceleve=?");
        $select_eleve->execute([$CodeEleve]);
        if($data_eleve = $select_eleve->fetch())
            $Numeleve = $data_eleve['Numeleve'];
        // $Numeleve = null;
        // foreach (Eleve::getEleve_Par_Matricule($code_eleve) as $value) {
        //     $Numeleve = $value['Numeleve'];
        // }
        $select_releve_eleve = $con->prepare("SELECT * FROM operation o INNER JOIN typeoperation top ON o.NumTypeOperation=top.Num_type_operation INNER JOIN eleve e ON o.Matriceleve=e.Matriceleve INNER JOIN annee_scolaire an ON o.IdAnneeScolaire WHERE e.Matriceleve=?");
        $select_releve_eleve->execute(array($CodeEleve));
        if($select_releve_eleve->rowCount()>0){
            return $select_releve_eleve->fetchAll();
        }else{
            return array();
        }  
    }
    // Carnet d'avance sur salire
    public static function carnetAvance_sur_salaire(){
        $con = DB::getDB();
        $carnet_avance = $con->prepare("SELECT * FROM operation o INNER JOIN typeoperation tyop ON o.NumTypeOperation = tyop.Num_type_operation INNER JOIN agent a ON a.Codeagent=o.Codeagent");
        $carnet_avance->execute();
        if($carnet_avance->rowCount()>0){
            return $carnet_avance->fetchAll();
        }else{
            return array();
        } 
    }
}