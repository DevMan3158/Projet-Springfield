<?php

include_once dirname(__FILE__) . '/../fonctions/error_msg.php';
$html = file_get_contents(dirname(__FILE__) . '/../template/modif_mdp.html', true);

if(!empty($_GET) && array_key_exists("ind", $_GET) && $_GET['ind'] == 'mmdp') {
    $code = "";
    if(!empty($_GET) && array_key_exists("code", $_GET)) {
        $code = $_GET["code"];
    }
    
    echo str_replace("#code#", $code, $html);
} else {
    error_msg("404");
}

