<?php

$html = file_get_contents(dirname(__FILE__) . '/../template/modif_mdp.html', true);

$code = "";
if(!empty($_GET) && array_key_exists("code", $_GET)) {
    $code = $_GET["code"];
}

echo str_replace("#code#", $code, $html);