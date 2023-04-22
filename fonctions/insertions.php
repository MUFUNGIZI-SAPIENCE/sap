<?php
require_once("../Class/Class.Eleve.php");
require_once("../Class/Class.Agent.php");
require_once("../Class/Class.Paiement.php");
require_once("../Class/Class.AvanceSalaire.php");
require_once("../Class/Class.Sortie.php");
require_once("../Class/Class.Comptabilite.php");
require_once("../Class/Class.Operation.php");

// Insertion des eleves
if(isset($_POST['nom'])&&isset($_POST['postnom'])&&isset($_POST['prenom'])&&isset($_POST['genre'])&&isset($_POST['classe'])&&isset($_POST['degre'])&&isset($_POST['option'])){
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $classe = htmlspecialchars($_POST['classe']);
    $degre = htmlspecialchars($_POST['degre']);
    $option = htmlspecialchars($_POST['option']);
    $eleve = new Eleve($nom,$postnom,$prenom,$genre,$classe,$degre,$option);
    echo $eleve->insertEvele();
}
// Insertion des agents
if(isset($_POST['nomag'])&&isset($_POST['postnomag'])&&isset($_POST['prenomag'])&&isset($_POST['telephone'])&&isset($_POST['genreag'])&&isset($_POST['fonction'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])){
    $nom = htmlspecialchars($_POST['nomag']);
    $postnom = htmlspecialchars($_POST['postnomag']);
    $prenom = htmlspecialchars($_POST['prenomag']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $genre = htmlspecialchars($_POST['genreag']);
    $fonction = htmlspecialchars($_POST['fonction']);
    $password = sha1(htmlspecialchars($_POST['confirm_password']));
    $agent = new Agent($nom,$postnom,$prenom,$telephone,$genre,$fonction,$password);
    echo $agent->insertAgent();
}
// Insertion des operations 
if(isset($_POST['matricule'])&&isset($_POST['type_operation'])&&isset($_POST['devise'])&&isset($_POST['montantPaiement'])){
    $matricule = htmlspecialchars($_POST['matricule']);
    $type_operation = htmlspecialchars($_POST['type_operation']);
    $devise = htmlspecialchars($_POST['devise']);
    $montantPaiement = htmlspecialchars($_POST['montantPaiement']);
    echo Operation::ajoutOperation($type_operation,$matricule,$devise,$montantPaiement);
}
// Insertion de l'avance sur salaire
if(isset($_POST['codeAgent'])&&isset($_POST['montantDemande'])&&isset($_POST['deviseAvance'])){
    $codeAgent = htmlspecialchars($_POST['codeAgent']);
    $montantDemande = htmlspecialchars($_POST['montantDemande']);
    $deviseAvance = htmlspecialchars($_POST['deviseAvance']);
    $libelle = htmlspecialchars($_POST['libelleAvance']);
    echo AvanceSalaire::ajouterAvanceSalaire($codeAgent,$montantDemande,$deviseAvance,$libelle);
}
// Insertion du montant sortie a cause d'avance sur salaire
if(isset($_GET['Numavance'])){
    new Sortie("Avance sur salaire",$_GET['Numavance']);
    echo Sortie::sortieFonds_Avance();
}
// Insertion des nouveaux comptes
if(isset($_POST['type_compte']) && isset($_POST['sous_type_compte']) && isset($_POST['num_compte_ajout']) && isset($_POST['libelle_num_compte'])){
    $sous_type_compte = htmlspecialchars($_POST['sous_type_compte']);
    $num_compte_ajout = htmlspecialchars($_POST['num_compte_ajout']);
    $libelle_num_compte = htmlspecialchars($_POST['libelle_num_compte']);
    echo Comptabilite::ajouterCompte($sous_type_compte,$num_compte_ajout,$libelle_num_compte);
}