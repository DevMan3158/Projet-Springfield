<?php
/**
 * Pour envoyer un message de reponse a un message recu.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/error_msg.php';

/* verifier qu'on as le droit de venir sur cette page */
if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 
&& ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {
    
} else {
    error_msg("401");
}