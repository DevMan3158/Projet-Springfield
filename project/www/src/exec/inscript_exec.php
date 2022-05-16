<?php

include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';

$sgbd = connexion_sgbd();

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('first_name', $_POST) && 
    array_key_exists('email', $_POST) && array_key_exists('login', $_POST) && array_key_exists('password', $_POST)
    && array_key_exists('password_rep', $_POST)) {

    if(!empty($sgbd)) {
        $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

        if(preg_match("/^.{3,40}$/", $_POST['name']) && preg_match("/^.{3,40}$/", $_POST['first_name']) 
            && preg_match($regexEmailValide,$_POST['email']) && preg_match("/^..{3,40}$/",$_POST['login']) 
            && preg_match("/^.{6,}$/",$_POST['password']) && preg_match("/^.{6,}$/",$_POST['password_rep'])) {
            $valide = true;
            try {
                if($_POST['password_rep'] != $_POST['password']) {
                    echo "Le mot de passe n'est pas identique, merci de recommencer.";
                    $valide = false;
                }
                if($valide) {
                    $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE login=:login");
                    $res->execute([
                        ":login" => htmlspecialchars(stripslashes(trim($_POST['login'])))
                    ]);
                    if($res->rowCount() > 0) {
                        echo "le login est déja utilisé, merci d'en prendre un autre.";
                        $valide = false;
                    }
                }
                if($valide) {
                    $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE email=:email");
                    $res->execute([
                        ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
                    ]);
                    if($res->rowCount() > 0) {
                        echo "Cette adresse email fait déjà parti des inscris.";
                        $valide = false;
                    }
                }
                if($valide) {
                        $res = $sgbd->prepare("INSERT INTO utilisateur(nom, Prenom, login, email, mot_pass, id_admin) VALUES ".
                            "(:nom,:prenom,:login,:email,:password, 3)");
                        $res->execute([
                            ":nom" => htmlspecialchars(stripslashes(trim($_POST['name']))),
                            ":prenom" => htmlspecialchars(stripslashes(trim($_POST['first_name']))),
                            ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                            ":email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                            ":password" => Pass_Crypt::password($_POST['password']),
                        ]);
                        echo "true";
                }
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
