<?php

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('conversion_bbcode')) {
    function conversion_bbcode($chaine) {
        $chaine = str_replace("[b]", "<strong>", $chaine);
        $chaine = str_replace("[/b]", "</strong>", $chaine);
    
        $chaine = str_replace("[title]", "<span class=\"bb_title\">", $chaine);
        $chaine = str_replace("[/title]", "</span>", $chaine);
    
        return '<p>'.$chaine.'</p>';
    }
}

