<?php
/**
 * Afficher la page du mot de passe perdu. 
 */

/* affiche le contenu de la page html */
echo file_get_contents(dirname(__FILE__) . '/../template/mdp_perdu.html', true);
