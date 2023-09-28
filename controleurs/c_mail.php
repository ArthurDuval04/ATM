<?php
// Import de PHPmailer
// Doit être au debut du scirpt
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendors/PHPMailer/src/Exception.php';
require '../vendors/PHPMailer/src/PHPMailer.php';
require '../vendors/PHPMailer/src/SMTP.php';

function envoyerUnMail($destinataire, $contenu) {


    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';               //Adresse IP ou DNS du serveur SMTP
    $mail->Port = 465;                          //Port TCP du serveur SMTP
    $mail->SMTPAuth =1;                        //Utiliser l'identification
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
    $mail->Username   =  'projetgsbATM@gmail.com';    //Adresse email à utiliser
    $mail->Password   =  'hxfwqiyukcwnqvhc';         //Mot de passe de l'adresse email à utiliser
    $mail-> setFrom("projetgsbATM@gmail.com", "GSB");
    $mail->AddAddress($destinataire,"");

    $mail->Subject    =  "test";                      //Le sujet du mail
    $mail->WordWrap   = 50; 		       //Nombre de caracteres pour le retour a la ligne automatique
    $mail->Body = "bjr";	       
    $mail->IsHTML(true);    

    if (!$mail->send()) {
           echo $mail->ErrorInfo;
    } else{

    
    }

}