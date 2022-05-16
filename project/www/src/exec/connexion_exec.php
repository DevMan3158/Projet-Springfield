<?php

include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';

session_start();

if (!empty($_POST) && array_key_exists('login', $_POST) && array_key_exists('password_user', $_POST)) {

    $sgbd = connexion_sgbd();
    if(!empty($sgbd)) {
        try {
            $res = $sgbd->prepare("SELECT * FROM utilisateur LEFT JOIN admin ON utilisateur.id_admin = admin.id_admin".
                            " WHERE login=:login OR email=:login");
            $res->bindParam(':login', $_POST['login']);
            $res->execute();
            $data = $res->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $valueLine) {
                if($valueLine['id_admin'] != 4) {
                    if(Pass_Crypt::verify($_POST['password_user'], $valueLine['mot_pass'])) {
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
        } catch (PDOException $exc) {
            echo "Erreur de login.";
            $error_log = new Error_Log();
            $error_log->addError($e);
        }
    } else {
        echo "Une erreur est survenu lors de la connexion.";
    }
} else {
    echo "Il manque des informations pour vous connecter.";
}