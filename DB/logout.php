<?php 
include_once("connection.php");
session_start();
if(isset($_SESSION["loggedin"]) && isset($_SESSION['email']) && isset($_SESSION['iduser']) && isset($_SESSION['droit'])){
    $email = $_SESSION['email'];
    $loggedin = $_SESSION['loggedin'];
    $iduser = $_SESSION['iduser'];
    $droit = $_SESSION['droit'];
    $_SESSION = array('iduser'=> $iduser,'email'=> $email,'loggedin'=> $loggedin,'droit'=> $droit);
    session_destroy();
    header('Location:login.php');
    
}
