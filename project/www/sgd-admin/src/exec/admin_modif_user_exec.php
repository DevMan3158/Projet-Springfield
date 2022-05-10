<?php 

session_start();

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 && $_SESSION['id_admin'] == 1) {
    if (!empty($_POST) && array_key_exists('id', $_POST)
    && array_key_exists('login', $_POST)
    && array_key_exists('name', $_POST)
    && array_key_exists('first_name', $_POST)
    && array_key_exists('email', $_POST)
    && array_key_exists('admin', $_POST)) {
        $sgbd = connexion_sgbd();
        if(!empty($sgbd)) {
            $valide = true;
            if($valide) {
                $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE login=:login AND id_user!=:id_user");
                $res->execute([
                    ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                    ":id_user" => $_POST['id']
                ]);
                if($res->rowCount() > 0) {
                    echo "le login est déja utilisé, merci d'en prendre un autre.";
                    $valide = false;
                }
            }
            if($valide) {
                $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE email=:email AND id_user!=:id_user");
                $res->execute([
                    ":email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                    ":id_user" => $_POST['id']
                ]);
                if($res->rowCount() > 0) {
                    echo "Cette adresse email fait déjà parti des inscris.";
                    $valide = false;
                }
            }
            if($valide) {
                $res = $sgbd->prepare("UPDATE utilisateur SET id_admin=:id_admin,nom=:nom,prenom=:prenom,login=:login,email=:email WHERE id_user=:id_user");
                $res->execute([
                    ":id_admin" => htmlspecialchars(stripslashes(trim($_POST['admin']))),
                    ":nom" => htmlspecialchars(stripslashes(trim($_POST['name']))),
                    ":prenom" => htmlspecialchars(stripslashes(trim($_POST['first_name']))),
                    ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                    ":email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                    ":id_user" => $_POST['id']
                ]);
                echo "true";
            }
        } else {
            echo "Une erreur est survenu lors de la connexion.";
        }
    } else {
        echo "Vous n'avez pas le droit d'ouvrir cette page.";
    }
} else {
    echo "Vous n'avez pas le droit d'ouvrir cette page.";
}