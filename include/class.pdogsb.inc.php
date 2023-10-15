<?php

/** 
 * Classe d'accÃ¨s aux donnÃ©es. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbextranet';   		
      	private static $user='gsbextranet' ;    		
      	private static $mdp='DqGpgB35mwCNkeq' ;	
	public static $monPdo;
	private static $monPdoGsb=null;
		
/**
 * Constructeur privÃ©, crÃ©e l'instance de PDO qui sera sollicitÃ©e
 * pour toutes les mÃ©thodes de la classe
 */				
	private function __construct(){
          
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crÃ©e l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * vÃ©rifie si le login et le mot de passe sont corrects
 * renvoie true si les 2 sont corrects
 * @param type $lePDO
 * @param type $login
 * @param type $pwd
 * @return bool
 * @throws Exception
 */
function checkUser($login,$pwd):bool {
    //AJOUTER TEST SUR TOKEN POUR ACTIVATION DU COMPTE
    $user=false;
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT motDePasse FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        if (is_array($unUser)){
           if (password_verify($pwd, $unUser['motDePasse']))
                $user=true;
        }
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $user;   
}


	
/**
 * Verifie si le medecin existe
 * renvoie un tableau associatif si l'utilisateur est présent
 * @param type $lePDO
 * @param type $login
 */
function donneLeMedecinByMail($login) {
    
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,roleMedecin,mailverifie, droitConnexion,roleMedecin FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
    return $unUser;   
}

function donnerValidateur() {
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,roleMedecin,mailverifie, droitConnexion FROM medecin WHERE roleMedecin= :roleId");
    $bvc1=$monObjPdoStatement->bindValue(':roleId',4);
    if ($monObjPdoStatement->execute()) {
        $unValidateur=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
    return $unValidateur;   
}
function validerUser($id) {
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE medecin SET droitConnexion = :aledroit WHERE id = :id");
    $bv1 = $pdoStatement->bindValue(':aledroit', 1);
    $bv2= $pdoStatement->bindValue(':id', $id);
    $execution = $pdoStatement->execute();
    return $execution;
}




public function tailleChampsMail(){
    

    
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS
WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
    $execution = $pdoStatement->execute();
$leResultat = $pdoStatement->fetch();
      
      return $leResultat[0];
    
       
       
}
public function getDateTokenBdd($token) {
    $requetepdo = PdoGsb::$monPdo->prepare("SELECT expiration_token FROM medecin WHERE token = :letoken");
    $requetepdo->bindValue(':letoken', $token);
    $requetepdo->execute();
    $ladate = $requetepdo->fetch();
    if ($ladate !== false && isset($ladate['expiration_token'])) {
        $timestampBDD = strtotime($ladate['expiration_token']);
        $timestampActuel = time();
        $difference = $timestampActuel - $timestampBDD;
        $differenceEnHeures = $difference / 3600;
        return $differenceEnHeures;
    } else {
        return "Date non trouvée"; 
    }
}
public function getVerifMail($token) {  
    $requetepdo = PdoGsb::$monPdo->prepare("SELECT mailverifie FROM medecin WHERE token = :letoken");
    $requetepdo->bindValue(':letoken', $token);
    $requetepdo->execute();
    $valeur = $requetepdo->fetch();
    return $valeur[0];

}
public function aVerifieMail($token) {  
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE medecin SET mailverifie = :averifie WHERE token = :letoken");
    $bv1 = $pdoStatement->bindValue(':averifie', 1);
    $bv2= $pdoStatement->bindValue(':letoken', $token);
    $execution = $pdoStatement->execute();
    return $execution;
}


public function creeMedecin($email, $mdp, $nom, $prenom, $tel, $RPPS, $dateNaissance, $dateDiplome)
{

    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id, mail, motDePasse, nom, prenom, telephone, RPPS, datenaissance, dateDiplome,mailverifie) 
            VALUES (null, :leMail, :leMdp, :leNom, :lePrenom, :leTel, :leRPPS, :ladateNaissance, :ladateDiplome, :mailverif)");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $bv2 = $pdoStatement->bindValue(':leMdp', $mdp);
    $bv5 = $pdoStatement->bindValue(':leNom', $nom);
    $bv6 = $pdoStatement->bindValue(':lePrenom', $prenom);
    $bv7 = $pdoStatement->bindValue(':leTel', $tel);
    $bv8 = $pdoStatement->bindValue(':leRPPS', $RPPS);
    $bv9 = $pdoStatement->bindValue(':ladateNaissance', $dateNaissance);
    $bv10 = $pdoStatement->bindValue(':ladateDiplome', $dateDiplome);
    $bv11 = $pdoStatement->bindValue(':mailverif', 0);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
public function creeAuthLigne($email)
{
    $idMed = $this->donneLeMedecinByMail($email);
    $expirationTime = date('Y-m-d H:i:s', strtotime('+300 seconds'));
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO auth_codes(idMedecin,code, expiration_time)"
            . "VALUES (:leid,:code ,:expTime)");

    $bv1 = $pdoStatement->bindValue(':leid', $idMed["id"]);
    $bv2 = $pdoStatement->bindValue(':expTime', $expirationTime);
    $bv3 = $pdoStatement->bindValue(':code',generateCode());
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function updateAuthCode($mail) {
    $code= strtolower(generateCode());
    $idMed = $this->donneLeMedecinByMail($mail);
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE auth_codes SET code = :lecode WHERE idMedecin = :leid");
    $bv1 = $pdoStatement->bindValue(':lecode', $code);
    $bv3 = $pdoStatement->bindValue(':leid', $idMed["id"]);
    $execution = $pdoStatement->execute();
    return $execution;
}
public function recupererAuthCode($mail) {
    $idMed = $this->donneLeMedecinByMail($mail);
    $monObjPdoStatement=PdoGsb::$monPdo->prepare("SELECT code, expiration_time FROM auth_codes WHERE idMedecin= :leid");
    $bvc1=$monObjPdoStatement->bindValue(':leid',$idMed["id"]);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
    }
    else {
     throw new Exception("erreur");
           
    }
    return $unUser;
}

public function insererToken($mail, $token) {
   
    $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE medecin SET token = :token ,expiration_token = :expiration WHERE mail = :mail");
    $bv1 = $pdoStatement->bindValue(':token', $token);
    $bv2 = $pdoStatement->bindValue(':expiration', $expiration);
    $bv3 = $pdoStatement->bindValue(':mail', $mail);
    $execution = $pdoStatement->execute();
    return $execution;
}


public function recupererToken($mail) {

    $monObjPdoStatement=PdoGsb::$monPdo->prepare("SELECT token,expiration_token FROM medecin WHERE mail= :lemail");
    $bvc1=$monObjPdoStatement->bindValue(':lemail',$mail);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
    }
    else {
     throw new Exception("erreur");
           
    }
    return $unUser;
}

public function testMail($email){
    $pdo = PdoGsb::$monPdo;
    $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $execution = $pdoStatement->execute();
    $resultatRequete = $pdoStatement->fetch();
    if ($resultatRequete['nbMail']==0)
        $mailTrouve = false;
    else
        $mailTrouve=true;
    
    return $mailTrouve;
}




function connexionInitiale($mail){
     $pdo = PdoGsb::$monPdo;
    $medecin= $this->donneLeMedecinByMail($mail);
    $id = $medecin['id'];
    $this->ajouteConnexionInitiale($id);
    
}

function deconnectionInitiale($id){
    $pdo = PdoGsb::$monPdo;
    $this->ajouteDeconnexionInitiale($id);
   
}
function ajouteConnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), null)");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function ajouteDeconnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE historiqueconnexion SET dateFinLog = now() WHERE idMedecin = :leMedecin AND dateFinLog IS NULL ");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function donneinfosmedecin($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom,mail,dateNaissance,telephone FROM medecin WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
   
    }
    else
        throw new Exception("erreur");
           
    return $unUser;
    
}
function Maintenance($status){
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE maintenance SET active = :active WHERE idMaintenance = :id");
    $bv1 = $pdoStatement->bindValue(':active', $status);
    $bv2 = $pdoStatement->bindValue(':id', 1);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function checkMaintenance(){
  
    $pdo = PdoGsb::$monPdo;
        $monObjPdoStatement=$pdo->prepare("SELECT active FROM maintenance WHERE idMaintenance= :lId");
 $bvc1=$monObjPdoStatement->bindValue(':lId',1);
 if ($monObjPdoStatement->execute()) {
     $lamaintenance=$monObjPdoStatement->fetch();

 }
 else {
     throw new Exception("erreur");
 }
 return $lamaintenance;

}
function produit(){
    $pdo = PdoGsb::$monPdo;
    $sql = "SELECT * FROM produit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
function creerProduit($nom,$descriptio,$effets,$img_name,$objectif){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO produit(nom,objectif, information,effetIndesirable,img_name,estValide) "
            . "VALUES (:nom, :obj, :info,:effet,:img,:valide)");
    $bv1 = $pdoStatement->bindValue(':nom', $nom);
    $bv2= $pdoStatement->bindValue(':obj', $objectif);
    $bv3 = $pdoStatement->bindValue(':info', $descriptio);
    $bv4 = $pdoStatement->bindValue(':effet', $effets);
    $bv5 = $pdoStatement->bindValue(':img', $img_name);
    $bv6 = $pdoStatement->bindValue(':valide', 0);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function produitValides(){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM produit WHERE estValide = :valeur");
    $bv1 = $sql->bindValue(':valeur', 1);
    $sql->execute();
    return $sql->fetchAll();
}
function produitnonValides(){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM produit WHERE estValide = :valeur");
    $bv1 = $sql->bindValue(':valeur', 0);
    $sql->execute();
    return $sql->fetchAll();
}

function validerProduit($id){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("UPDATE produit SET estValide = :estValide WHERE id = :id");
    $bv1 = $sql->bindValue(':id', $id);
    $bv2 = $sql->bindValue(':estValide', 1);
    $sql->execute();
    return $sql->fetchAll();
}

function refuserProduit($id){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("DELETE FROM produit WHERE id = :id");
    $bv1 = $sql->bindValue(':id', $id);
    $sql->execute();
    return $sql->fetchAll();
}
}

?>