<?php

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 
&& ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2) && !empty($_POST)) {
    $sgbd = connexion_sgbd();
    if(!empty($sgbd)) {

    } else {
        echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
    }
} else {
  echo "Vous n'avez pas le droit d'ouvrir cette page.";
}