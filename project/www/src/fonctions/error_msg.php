<?php
/**
 * Afficher des messages d'erreur de page avec le code web (exemple : 401).
 */

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('error_msg')) {
    // la classe qui va lire le fichier d'erreur ini
    include_once dirname(__FILE__) . '/../class/Error_msg_ini.php';
    /* inclure des fonctionnalites à la page */
    include_once dirname(__FILE__) . '/../config/config_default.php';

    /**
     * Pour afficher le html de la page d'erreur
     *
     * @param string|null $error numero de l'erreur, exemple : 401
     * @param boolean $head doit contenir un head dans la page.
     * @return void ne retourne rien
     */
    function error_msg(?string $error, bool $head = true): void {
        // creation de l'objet de la classe.
        $error_msg_ini = new Error_msg_ini();
        // recupere la table par rapport a l'erreur
        $error_msg = $error_msg_ini->error($error);

        // recupere le html a afficher
        $html = file_get_contents(dirname(__FILE__) . '/../template/msg-error.html', true);

        // remplace les valeurs dans le html par ceux de l'erreur.
        $html = str_replace("##racine##",RACINE,$html);
        $html = str_replace("##title-error##",$error_msg['title'],$html);
        $html = str_replace("##msg-error##",$error_msg['msg'],$html);
        $html = str_replace("##img-error##",$error_msg['img'],$html);

        //affiche le html.
        echo $html;
    }
}