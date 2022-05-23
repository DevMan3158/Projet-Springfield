<?php 
/**
 * Executer la recherche d'un message.
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
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 && ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {

    /* verifier qu'on vient a partir d'un formulaire */
    if(!empty($_POST) && array_key_exists('recherche', $_POST)) {

        $sql = "SELECT * FROM messages ".
                "LEFT JOIN message_produit ON messages.Id_msg = message_produit.Id_msg ".
                "LEFT JOIN produits ON produits.id_produit = message_produit.id_produit ".
                "WHERE ";

        $type = "user";
        if(!empty($_GET) && array_key_exists("type", $_GET)) {
            $type = $_GET['type'];
        }

        $find = false;
        if(!empty($_POST) && array_key_exists("recherche", $_POST) && !empty($_POST['recherche'])) {
            $find = true;
            $sql .= "(messages.Nom LIKE :find OR messages.Prenom LIKE :find OR ".
                    "messages.Email LIKE :find OR messages.Objet LIKE :find OR messages.Message LIKE :find) AND ";
        }

        /* se connecter a la base de donnees */
        $sgbd = connexion_sgbd();
        /* verifier qu'on est bien connecte a la base */
        if(!empty($sgbd)) {
            /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
            try {
                /* une recherche de message en admin */
                if($type == "admin" && $find) {
                    $res = $sgbd->prepare($sql."id_user is NULL ORDER BY messages.Id_msg DESC");
                    $res->execute([
                        ":find" => "%".$_POST['recherche']."%"
                    ]);
                /* tout les message admin */
                } else if($type == "admin" && !$find) {
                    $res = $sgbd->prepare($sql."id_user is NULL ORDER BY messages.Id_msg DESC");
                    $res->execute();
                /* recherche de message en gestionnaire */
                } else if($find) {
                    $res = $sgbd->prepare($sql."id_user=:id_user ORDER BY messages.Id_msg DESC");
                    $res->execute([
                        ":find" => "%".$_POST['recherche']."%",
                        ":id_user" => $_SESSION['id_user']
                    ]);
                /* tout les messages du gestionnaire */
                } else {
                    $res = $sgbd->prepare($sql."id_user=:id_user ORDER BY messages.Id_msg DESC");
                    $res->execute([
                        ":id_user" => $_SESSION['id_user']
                    ]);
                }
                /* recupere la liste de message */
                $tab = $res->fetchAll(PDO::FETCH_ASSOC);
                
                /* envoyer la liste de message */
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