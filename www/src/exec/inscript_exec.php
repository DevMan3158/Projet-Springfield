<?php

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('first_name', $_POST) && 
    array_key_exists('email', $_POST) && array_key_exists('login', $_POST) && array_key_exists('password', $_POST)
    && array_key_exists('password_rep', $_POST)) {

    /* se connecter a la base de donnees */
    $sgbd = connexion_sgbd();

    /* verifier qu'on est bien connecte a la base */
    if(!empty($sgbd)) {
        /* regex pour valider l'email */
        $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

        /* verifier qu'il y a des valeurs valides a entrer dans la base */
        if(preg_match("/^.{3,40}$/", $_POST['name']) && preg_match("/^.{3,40}$/", $_POST['first_name']) 
            && preg_match($regexEmailValide,$_POST['email']) && preg_match("/^..{3,40}$/",$_POST['login']) 
            && preg_match("/^.{6,}$/",$_POST['password']) && preg_match("/^.{6,}$/",$_POST['password_rep'])) {
            /* pour verifier la validiter des informations (eviter les doublons ou probleme de mot de passe) */
            $valide = true;
            /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
            try {
                /* si les deux mots de passes ne sont pas identique */
                if($_POST['password_rep'] != $_POST['password']) {
                    echo "Le mot de passe n'est pas identique, merci de recommencer.";
                    $valide = false;
                }
                /* si c'est valide, on continu la verification */
                if($valide) {
                    /* on verifit que le login n'a pas deja ete utilise par une autre personne */
                    $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE login=:login");
                    $res->execute([
                        ":login" => htmlspecialchars(stripslashes(trim($_POST['login'])))
                    ]);
                    /* si le login est deja utilise */
                    if($res->rowCount() > 0) {
                        echo "le login est déja utilisé, merci d'en prendre un autre.";
                        $valide = false;
                    }
                }
                /* si c'est valide, on continu la verification */
                if($valide) {
                    /* on verifit que l'email n'a pas deja ete utilise par une autre personne */
                    $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE email=:email");
                    $res->execute([
                        ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
                    ]);
                    /* si l'email est deja utilise */
                    if($res->rowCount() > 0) {
                        echo "Cette adresse email fait déjà parti des inscris.";
                        $valide = false;
                    }
                }
                /* si c'est valide, on enregistre l'utilisateur */
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
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
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
