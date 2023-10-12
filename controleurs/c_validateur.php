<?php 

if(!isset($_GET['action'])){
    $_GET['action'] = 'demandeValidation';
}

$action = $_GET['action'];

switch($action) {
    case 'demandeValidation': 
        include('vues/v_validateur.php');
        break;
    case 'valider': 
        $mail = $_POST['email'];
        if (!$pdo->validerUser($mail)){
            $pdo->validerUser($mail);
            echo "Utilisateur validé avec succès";
        } else {
            echo "Utilisateur déjà validé";
        }
         
       
        
        
        break;
}
?>