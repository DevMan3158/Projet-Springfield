<?php

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';

/* demarrer la session */
session_start();

/* verifier qu'on vient a partir d'un formulaire */
if (!empty($_POST) && array_key_exists('login', $_POST) && array_key_exists('password_user', $_POST)) {

    /* se connecter a la base de donnees */
    $sgbd = connexion_sgbd();
    /* verifier qu'on est bien connecte a la base */
    if(!empty($sgbd)) {
        /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
        try {
            /* recuperer l'utilisateur dans la base par le login ou l'email */
            $res = $sgbd->prepare("SELECT * FROM utilisateur LEFT JOIN admin ON utilisateur.id_admin = admin.id_admin".
                            " WHERE login=:login OR email=:login");
            $res->bindParam(':login', $_POST['login']);
            $res->execute();
            /* si on a trouve un utilisateur */
            if($res->rowCount() > 0) {
                /* recuperer ces informations */
                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $valueLine) {
                    /* verifier qu'il n'a pas ete banni */
                    if($valueLine['id_admin'] != 4) {
                        /* verifier la validiter du mot de passe */
                        if(Pass_Crypt::verify($_POST['password_user'], $valueLine['mot_pass'])) {
                            /* connecter l'utilisateur */
                            $_SESSION['id_user'] = $valueLine['id_user'];
                            $_SESSION['id_admin'] = $valueLine['id_admin'];
                            $_SESSION['nom'] = $valueLine['nom'];
                            $_SESSION['prenom'] = $valueLine['prenom'];
                            $_SESSION['login'] = $valueLine['login'];
                            $_SESSION['email'] = $valueLine['email'];
                            $_SESSION['avatar'] = $valueLine['avatar'];
                            echo "true";
                        } else {
                            echo "Erreur de mot de passe.";
                        }
                    } else {
                        echo "Vous avez été banni.";
                    }
                }
            } else {
                echo "Erreur de login.";
            }
        } catch (PDOException $exc) {
            /* sauvegarde le message d'erreur dans le fichier "errors.log" */
            $error_log = new Error_Log();
            $error_log->addError($e);
            echo "Erreur de connexion.";
        }
    } else {
        echo "Une erreur est survenu lors de la connexion.";
    }
} else {
    echo "Il manque des informations pour vous connecter.";
}