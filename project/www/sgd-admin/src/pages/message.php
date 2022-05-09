<?php

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {

  echo file_get_contents(dirname(__FILE__) . '/../template/message.html', true);

} else {
  echo "Vous n'avez pas le droit d'ouvrir cette page.";
}