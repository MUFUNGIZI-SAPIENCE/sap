<?php
require_once("../Class/Class.DB.php");
require_once("../Class/Class.Agent.php");
if(isset($_POST['codeAgent']) && isset($_POST['password'])){
    if(session_start()==null) session_start();
    $con = DB::getDB();
    $codeAgent = htmlspecialchars($_POST['codeAgent']);
    $password = htmlspecialchars($_POST['password']);
    $password = md5(sha1($password));
    if(Agent::connexionAgent($codeAgent,$password) == false)
        echo false;
    else{
        // echo Agent::connexionAgent($codeAgent,$password);
        foreach (Agent::connexionAgent($codeAgent,$password) as $value) {
            if($password == $value['Mot_de_passe']){
                $fonction_agent = $value['Numfonction'];
                echo $fonction_agent;
                $_SESSION['agent'] = Agent::connexionAgent($codeAgent,$password);
            }
        }
    }
}