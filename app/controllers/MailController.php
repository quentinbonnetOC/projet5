<?php
class MailController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        //Variables du formulaire
        $email = $_GET['email'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        
        // Mail
        $objet = utf8_decode('Confirmation de votre pré-inscription' ); 
        $contenu = utf8_decode('
        <html>
        <head>
        <title>Vous avez effectué votre pré-inscription dans notre club</title>
        </head>
        <body>
        <p>Bonjour Mr/Mmme '.$nom.' '.$prenom.'</p>
        <p>Nous vous confirmons votre pré-inscription au seins de ...</p>
        <p>Afin de finaliser votre dossier merci de compléter et de nous faire parvenir les documents suivants</p>
        </body>
        </html>');
        $entetes = 'Content-type: text/html; charset=\"ISO-8859-1\"' . "\r\n" .
        'From: quentinbonnet46@sfr.fr' . "\r\n" .
        'Reply-To: quentinbonnet46@sfr.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
                                
        //Envoi du mail
        mail($email, $objet, $contenu, $entetes);
        return $this->response->redirect('user/inscription');
    }
}
