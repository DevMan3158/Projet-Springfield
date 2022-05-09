<?php 

include_once './../fonctions/connexion_sgbd.php';
include_once './../class/Error_Log.php';

$sgbd = connexion_sgbd();

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('first_name', $_POST) && 
    array_key_exists('email', $_POST) && array_key_exists('user_text', $_POST) && array_key_exists('objet', $_POST)) {

    if(!empty($sgbd)) {
        $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

        if(preg_match("/^.{3,40}$/", $_POST['name']) && preg_match("/^.{3,40}$/", $_POST['first_name']) 
            && preg_match($regexEmailValide,$_POST['email']) && preg_match("/^.{3,255}$/",$_POST['objet']) 
            && preg_match("/^.{8,}$/",$_POST['user_text'])) {
            try {
                $res = $sgbd->prepare("INSERT INTO messages(Nom, Prenom, Email, Objet, Message) VALUES ".
                    "(:Nom,:Prenom,:Email,:Objet,:Message)");
                $res->execute([
                    ":Nom" => htmlspecialchars(stripslashes(trim($_POST['name']))),
                    ":Prenom" => htmlspecialchars(stripslashes(trim($_POST['first_name']))),
                    ":Email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                    ":Objet" => htmlspecialchars(stripslashes(trim($_POST['objet']))),
                    ":Message" => htmlspecialchars(stripslashes(trim($_POST['user_text']))),
                ]);
                echo "1";
            } catch (PDOException $exc) {
                $error_log = new Error_Log();
                $error_log->addError($e);
                echo "Une erreur c'est produite lors de l'envoie du message.";
            }
        } else {
            echo 'Il manque des informations pour transmettre le message.';
        }
    } else {
        echo "Une erreur c'est produite lors de l'envoie du message.";
    }

} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}
