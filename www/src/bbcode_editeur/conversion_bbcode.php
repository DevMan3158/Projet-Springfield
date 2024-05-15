<?php

/**
 * Remplacer le bbcode par du html.
 */

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('conversion_bbcode')) {

    /**
     * Remplacer le bbcode par du html.
     *
     * @param string|null $chaine : le texte avec le bbcode.
     * @return string|null le texte en html.
     */
    function conversion_bbcode(?string $chaine):?string {
        /* si la valeur est vide ou null */
        if(empty($chaine)) {
            return $chaine;
        }
        /* sinon, on convertie le texte en html */
        $chaine = str_replace("<", "&lt;", $chaine);
        $chaine = str_replace(">", "&gt;", $chaine);
        
        $chaine = str_replace("[b]", "<strong>", $chaine);
        $chaine = str_replace("[/b]", "</strong>", $chaine);
    
        $chaine = str_replace("[title]", "<span class=\"bb_title\">", $chaine);
        $chaine = str_replace("[/title]", "</span>", $chaine);

        $chaine = str_replace("\n", "<br />", $chaine);
        $chaine = str_replace("  ", "&nbsp;&nbsp;", $chaine);
    
        return '<p>'.$chaine.'</p>';
    }
}

