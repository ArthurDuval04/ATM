<?php
if(!isset($_GET['action'])){
	$_GET['action'] = 'voirLesProduits';
    
}
$action = $_GET['action'];
switch($action){
	
	case 'voirLesProduits':{
        if($_SESSION["role"] == "Medecin" or $_SESSION["role"] == "ChefdeProduit" ) {
            include_once 'vues/v_produit.php';
        } else {
            include_once 'vues/v_sommaire.php';
        }
        break;
    };
    case 'ajouterProduits':{
        if($_SESSION["role"] == "ChefdeProduit") {
            include_once 'vues/v_ajouterProduit.php';
        } else {
            include_once 'vues/v_sommaire.php';
        }
        break;
    };
    case 'attenteProduits':{
        if($_SESSION["role"] == "ChefdeProduit") {
            include_once 'vues/v_attenteProduit.php';
        } else {
            include_once 'vues/v_sommaire.php';
        }
        break;
    };
    case 'ajouterLeProduit':{
        
        $nom = $_POST["nomproduit"];
        $descriptio = $_POST["desc"];
        $effets = $_POST["effetsproduit"];
        $objectifs = $_POST["objectifs"];
        echo $nom;
        var_dump($_FILES);
        if(isset($_FILES['image'])){
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            move_uploaded_file($tmpName, '/var/www/html/ATM/gsbextranetb3/images/'.$name);
        }
        $pdo->creerProduit($nom,$descriptio,$effets,$name,$objectifs);
        
        break;
    };
    case 'validerProduit':{
        
        $id = $_GET['id'];
        $pdo->validerProduit($id);
        include_once 'vues/v_chefproduit.php';
        break;
    };
    case 'refuserProduit':{
        
        $id = $_GET['id'];
        $pdo->refuserProduit($id);
        include_once 'vues/v_chefproduit.php';

        break;
        
    };
    case 'voirLesProduitsChef':{
        
       
        include_once 'vues/v_listeProduitChef.php';
        break;
        
        
    };
 
};





?>
