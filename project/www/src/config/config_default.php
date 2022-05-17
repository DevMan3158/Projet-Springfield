<?php
// verifier que la constante variable "RACINE" a ete definie (une constante du fichier "config.php").
if(!defined("RACINE")) {
    
    if(file_exists(dirname(__FILE__) . '/config.php')) {
        include_once dirname(__FILE__) . '/config.php';
    } else {
        define("RACINE", "http://localhost/");
        define("RACINE_PATH", dirname(__FILE__)."/../../");
        define("DATA_PATH", dirname(__FILE__)."/../../data/");
        define("DATA_WEB", RACINE."data/");
        define("NAME_SITE", "Office du tourisme de Springfield");
    }
}
