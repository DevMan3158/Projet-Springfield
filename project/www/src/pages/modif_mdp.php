<?php
/**
 * Afficher la page pour modifier le mot de passe.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/error_msg.php';

/* verifier qu'on as le droit de venir sur cette page */
if(!empty($_GET) && array_key_exists("ind", $_GET) && $_GET['ind'] == 'mmdp') {
    /* recupere le contenu de la page html a afficher */
    $html = file_get_contents(dirname(__FILE__) . '/../template/modif_mdp.html', true);
    /* si aucun code n'est entree */
    $code = "";
    if(!empty($_GET) && array_key_exists("code", $_GET)) {
        /* si on a un code, le recuperer */
        $code = $_GET["code"];
    }
    
    /* placer le code dans la page html */
    echo str_replace("#code#", $code, $html);
} else {
    error_msg("404");
}

