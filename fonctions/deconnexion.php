<?php
if(session_start()===null)session_start();
if(isset($_SESSION['agent'])){
    unset($_SESSION['agent']);
    session_destroy();
    header('location:../index.php');
}