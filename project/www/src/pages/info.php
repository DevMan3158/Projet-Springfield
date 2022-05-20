<?php

// page par defaut
$info = "propos";

// verifier qu'on a bien un get
if(!empty($_GET) && array_key_exists("info", $_GET)) {
    $info = $_GET['info'];
}

// la page a afficher
if($info == "propos") {
    /* affiche le contenu de la page html a afficher */
    echo file_get_contents(dirname(__FILE__) . '/../template/a_propos.html', true);
} else if($info == "legales") {
    /* affiche le contenu de la page html a afficher */
    echo file_get_contents(dirname(__FILE__) . '/../template/mentions_legales.html', true);
} else if($info == "politique") {
    /* affiche le contenu de la page html a afficher */
    echo file_get_contents(dirname(__FILE__) . '/../template/politique.html', true);
}

