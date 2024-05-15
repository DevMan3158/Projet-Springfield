<?php
/**
 * Afficher la page d'inscription.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/error_msg.php';

/* verifier qu'on as le droit de venir sur cette page */
if(!empty($_GET) && array_key_exists("ind", $_GET) && $_GET['ind'] == 'insc') {
    /* affiche le contenu de la page html */
    echo file_get_contents(dirname(__FILE__) . '/../template/inscription.html', true);
} else {
    error_msg("401");
}