<?php 

if(!isset($_GET['action'])){
    $_GET['action'] = '';
}

$action = $_GET['action'];

switch($action) {
    case 'Administrateur': 
        if($_SESSION["role"] == "Administrateur") {
            include('vues/v_admin.php');

        } else {
            include('vues/v_sommaire.php');
            $_GET["uc"] = "connexion";
            $_GET['action'] = "valideConnexion";
        }
        
        break;
}
?>