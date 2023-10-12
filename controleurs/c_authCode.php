<?php 
if(!isset($_GET['action'])){
    $_GET['action'] = 'demandeValidation';
}

$action = $_GET['action'];

switch($action) {
    case 'demandeValidation': 

        include('vues/v_authCode.php');
        break;
    case 'valider': 
       
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $num3 = $_POST['num3'];
        $num4 = $_POST['num4'];
        $num5 = $_POST['num5'];
        $num6 = $_POST['num6'];
        $lecodestring = $num1 . $num2 . $num3 . $num4 . $num5 . $num6;

        $lecode = $pdo->recupererAuthCode($_SESSION["mail"]);
        $timestampBDD = strtotime($lecode["expiration_time"]);
        $timestampActuel = time();
        $difference = $timestampActuel - $timestampBDD;
        $differenceEnHeures = $difference / 3600;

        if($lecode["code"]== trim($lecodestring) && $differenceEnHeures <= 0.5) {
            $infosMedecin = $pdo->donneLeMedecinByMail($_SESSION["mail"]);
            $id = $infosMedecin["id"];
            $id = $infosMedecin['id'];
			$nom =  $infosMedecin['nom'];
			$prenom = $infosMedecin['prenom'];
			$role = $infosMedecin['roleMedecin'];
			$verife = $infosMedecin["mailverifie"];
			$droitConnexion = $infosMedecin["droitConnexion"];
            $_SESSION['id'] = $id;
			connecter($id,$nom,$prenom,$role);
			$pdo->ajouteConnexionInitiale($_SESSION['id']);
			$maintenance = $pdo->checkMaintenance();
			$pdo->updateAuthCode($_SESSION["mail"]);
			if ($maintenance["active"]==1 && $_SESSION["role"] != "Administrateur") {
				include('vues/v_maintenance.php'); 

			} else {
				include("vues/v_sommaire.php");
			}
        } else {
            echo "Code invalide ou le délai est dépassé";
        }

       
        
        
        break;
}
?>