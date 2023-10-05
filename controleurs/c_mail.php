<?php
require_once '../models/modelEmail.php';

class EmailController {
    public function sendContactEmail() {
        // ... récupérez les données du formulaire
        $to = 'arthur.duval18@gmail.com';
        $subject = 'Nouveau message de contact';
        $message = 'Contenu du message...';

        $emailModel = new EmailModel();
        $result = $emailModel->sendEmail($to, $subject, $message);

        if ($result === true) {
            echo 'Email envoyé avec succès !';
        } else {
            echo 'Erreur lors de l\'envoi de l\'email : ' . $result;
        }
    }
}