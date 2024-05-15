<?php 
/**
 * Executer la rechercher d'un utilisateur par l'administrateur sous un format de tableau.
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
    if(!empty($_POST) && array_key_exists('recherche', $_POST)) {

        /* se connecter a la base de donnees */
        $sgbd = connexion_sgbd();
        /* verifier qu'on est bien connecte a la base */
        if(!empty($sgbd)) {
            /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
            try {
                /* recuperer la liste des utilisateurs */
                $res = $sgbd->prepare("SELECT * FROM utilisateur LEFT JOIN admin ON utilisateur.id_admin = admin.id_admin ".
                "WHERE (nom LIKE :find OR prenom LIKE :find OR login LIKE :find OR email LIKE :find) AND id_user!=:id_user");
                $res->execute([
                    ":find" => "%".$_POST['recherche']."%",
                    ":id_user" => $_SESSION['id_user']
                ]);
                $tab = $res->fetchAll(PDO::FETCH_ASSOC);
                /* envoyer la liste */
                echo "true"."[#json#]".json_encode($tab);
            } catch (PDOException $e) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
                $error_log = new Error_Log();
                $error_log->addError($e);
                echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
            }
        } else {
            echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
        }
    } else {
        error_msg("401");
    }
} else {
    error_msg("401");
}