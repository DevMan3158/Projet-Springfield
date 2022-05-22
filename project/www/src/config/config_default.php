<?php
// verifier que la constante variable "RACINE" a ete definie (une constante du fichier "config.php").
if(!defined("RACINE")) {
    /* verifier l'existance du fichier */
    if(file_exists(dirname(__FILE__) . '/config.php')) {
        /* recuperer les constantes */
        include_once dirname(__FILE__) . '/config.php';
    }
}

// Activer chaque constante et leur attribuer une valeur.
if(!defined("RACINE")) {
    define("RACINE", "http://localhost/");
}

if(!defined("RACINE_PATH")) {
    define("RACINE_PATH", dirname(__FILE__)."/../../");
}

if(!defined("DATA_PATH")) {
    define("DATA_PATH", dirname(__FILE__)."/../../data/");
}

if(!defined("DATA_WEB")) {
    define("DATA_WEB", RACINE."data/");
}

if(!defined("NAME_SITE")) {
    define("NAME_SITE", "Office du tourisme de Springfield");
}

if(!defined("RACINE_MSG")) {
    define("RACINE_MSG", RACINE."index.php?ind=msg");
}

if(!defined("EMAIL_NOREPLY")) {
    define("EMAIL_NOREPLY", "noreply@springfield.usa");
}
