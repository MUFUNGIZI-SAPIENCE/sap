<?php
if(isset($_GET['Numagent']) && !empty($_GET['Numagent'])){
    require_once("../Class/Class.Comptabilite.php");
    $num_agent = htmlspecialchars($_GET['Numagent']);
    Comptabilite::creerCompte_Agent($num_agent);
    header('location:../creer_compte.php');
}
if(isset($_GET['Numeleve']) && !empty($_GET['Numeleve'])){
    require_once("../Class/Class.Comptabilite.php");
    $num_eleve = htmlspecialchars($_GET['Numeleve']);
    Comptabilite::creerCompte_Eleve($num_eleve);
    header('location:../creer_compte.php');
}