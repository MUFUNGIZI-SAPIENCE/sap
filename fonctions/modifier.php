<?php
require_once("../Class/Class.Eleve.php");
require_once("../Class/Class.Comptabilite.php");
if(isset($_GET['matricule_eleveModification']) && !empty($_GET['matricule_eleveModification'])){
    foreach (Eleve::getEleve_Par_Matricule($_GET['matricule_eleveModification']) as $value) {
        echo json_encode($value);     
    }
   
}
// Modification de l'eleve
if(isset($_POST['nom'])&&isset($_POST['postnom'])&&isset($_POST['prenom'])&&isset($_POST['genre'])&&isset($_POST['classe'])&&isset($_POST['degre'])&&isset($_POST['option'])){
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $classe = htmlspecialchars($_POST['classe']);
    $degre = htmlspecialchars($_POST['degre']);
    $option = htmlspecialchars($_POST['option']);
    $matricule = htmlspecialchars($_POST['matriculeEleve']);
    $eleve = new Eleve($nom,$postnom,$prenom,$genre,$classe,$degre,$option);
    echo $eleve->modifierEvele($matricule);
}
// Modification d'un compte
if(isset($_POST['type_compte']) && isset($_POST['sous_type_compte']) && isset($_POST['num_compte_ajout']) && isset($_POST['libelle_num_compte'])){
    $Idcompte = htmlspecialchars($_POST['Idcompte']);
    $sous_type_compte = htmlspecialchars($_POST['sous_type_compte']);
    $num_compte_ajout = htmlspecialchars($_POST['num_compte_ajout']);
    $libelle_num_compte = htmlspecialchars($_POST['libelle_num_compte']);
    echo Comptabilite::modifierCompte($sous_type_compte,$num_compte_ajout,$libelle_num_compte,$Idcompte);
}