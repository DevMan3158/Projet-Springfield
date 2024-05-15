<?php 
/**
 * Executer les changements de donnees d'un utilisateur, fait par un administrateur.
 */

/* demarrer la session */
session_start();

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/error_msg.php';

/* verifier qu'on as le droit de venir sur cette page */
if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 && $_SESSION['id_admin'] == 1) {

    /* verifier qu'on vient a partir d'un formulaire */
    if (!empty($_POST) && array_key_exists('id', $_POST)
    && array_key_exists('login', $_POST)
    && array_key_exists('name', $_POST)
    && array_key_exists('first_name', $_POST)
    && array_key_exists('email', $_POST)
    && array_key_exists('admin', $_POST)) {

        /* se connecter a la base de donnees */
        $sgbd = connexion_sgbd();
        /* verifier qu'on est bien connecte a la base */
        if(!empty($sgbd)) {
            /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
            try {
                /* variable de validation */
                $valide = true;
                if($valide) {
                    /* verifier que personne n'a deja le login (a part son proprietaire) */
                    $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE login=:login AND id_user!=:id_user");
                    $res->execute([
                        ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                        ":id_user" => $_POST['id']
                    ]);
                    /* si une personne possede deja le login, refuser le changement */
                    if($res->rowCount() > 0) {
                        echo "le login est déja utilisé, merci d'en prendre un autre.";
                        $valide = false;
                    }
                }
                if($valide) {
                    /* verifier que personne n'a deja l'email' (a part son proprietaire) */
                    $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE email=:email AND id_user!=:id_user");
                    $res->execute([
                        ":email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                        ":id_user" => $_POST['id']
                    ]);
                    /* si une personne possede deja l'email, refuser le changement */
                    if($res->rowCount() > 0) {
                        echo "Cette adresse email fait déjà parti des inscris.";
                        $valide = false;
                    }
                }
                /* si les donnees sont valident */
                if($valide) {
                    /* enregistrer les modifications */
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
            } catch (PDOException $e) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
                $error_log = new Error_Log();
                $error_log->addError($e);
                echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
            }
        } else {
            echo "Une erreur est survenu lors de la connexion.";
        }
    } else {
        error_msg("401");
    }
} else {
    error_msg("401");
}
