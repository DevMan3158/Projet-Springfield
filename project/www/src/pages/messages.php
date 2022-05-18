<?php
/**
 * Afficher le formulaire de contact pour envoyer un message.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../fonctions/error_msg.php';

if(!empty($_GET) && array_key_exists('ind', $_GET) && $_GET['ind'] == "msg") {
    /* place l'id de description a 0 */
    $desc = 0;
    /* image par defaut pour le formulaire. */
    $img = "src/img/message_admin_2.svg";
    /* nom du formulaire */
    $name = "Administration";
    /* si on a ouvert une page a partir d'une description de produit */
    if(array_key_exists('desc', $_GET)) {
        /* se connecter a la base de donnees */
        $sgbd = connexion_sgbd();
        /* verifier qu'on est bien connecte a la base */
        if(!empty($sgbd)) {
            /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
            try {
                /* recuperer l'image du produit */
                $res = $sgbd->prepare("SELECT * FROM produits INNER JOIN photos ON produits.id_produit = photos.id_produit WHERE produits.id_produit=:id_produit LIMIT 1");
                $res->execute([
                    ":id_produit" => $_GET['desc']
                ]);
                /* si on a trouve le produit (si le produit n'a pas ete trouve, on envoie le message a l'administrateur). */
                if($res->rowCount() > 0) {
                    $data = $res->fetch(PDO::FETCH_ASSOC);
                    $desc = $_GET['desc'];
                    $name = $data['nom'];
                    if(!empty($data['src'])) {
                        $img = "data/img/".$data['src'];
                    }
                }
            } catch (PDOException $e) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
                $error_log = new Error_Log();
                $error_log->addError($e);
                echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
            }
        } else {
            echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
        }
    }
    /* recupere le contenu de la page html a afficher */
    $html = file_get_contents(dirname(__FILE__) . '/../template/messages.html', true);

    /* place l'id produit et l'image sur la page html */
    /* afficher la page html */
    echo str_replace("#nom_produit#",$name,str_replace("#id_produit#",$desc,str_replace("#img_produit#",$img,$html)));
} else {
    error_msg("404");
}
