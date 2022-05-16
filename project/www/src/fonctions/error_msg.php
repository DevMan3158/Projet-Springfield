<?php

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('error_msg')) {
    include_once dirname(__FILE__) . '/../class/Error_msg_ini.php';
    if(!defined("RACINE")) {
        include_once dirname(__FILE__) . '/../config/config.php';
    }

    function error_msg(?string $error, bool $header = true): void {
        $error_msg_ini = new Error_msg_ini();
        $error_msg = $error_msg_ini->error($error);
        $html = file_get_contents(dirname(__FILE__) . '/../template/msg-error.html', true);

        $html = str_replace("##racine##",RACINE,$html);
        $html = str_replace("##title-error##",$error_msg['title'],$html);
        $html = str_replace("##msg-error##",$error_msg['msg'],$html);
        $html = str_replace("##img-error##",$error_msg['img'],$html);
        echo $html;
    }
}