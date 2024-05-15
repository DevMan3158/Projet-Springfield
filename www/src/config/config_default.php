<?php
// verifier que la constante variable "RACINE" a ete definie (une constante du fichier "config.php").
if(!defined("RACINE")) {
    /* verifier l'existance du fichier */
    if(file_exists(dirname(__FILE__) . '/config.php')) {
        /* recuperer les constantes */
        include_once dirname(__FILE__) . '/config.php';
    } else {
        /* sinon creer des constantes par defaut */
        define("RACINE", "http://localhost/");
        define("RACINE_PATH", dirname(__FILE__)."/../../");
        define("DATA_PATH", dirname(__FILE__)."/../../data/");
        define("DATA_WEB", RACINE."data/");
        define("NAME_SITE", "Office du tourisme de Springfield");
    }
}
