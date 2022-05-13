<?php
// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('text_email_mdp')) {
    function text_email_mdp(bool $demande = true): ?array {
        if(true) {
            return array(
                "titre" => "le lien pour changer le mot de passe sur [##NAME_SITE##].",
                "message" => "Madame, Monsieur,<br /><br />"
                . "Vous avez demander de recevoir un lien et un code, pour cr&eacute;er un nouveau mot de passe apr&egrave;s la perte de celui-ci.<br /><br />"
                . "Le code : [##CODE##]<br />"
                . "Le login : [##LOGIN##]<br />"
                . "Le lien : <a href=\"[##RACINE##]src/pages/modif_mdp.php?code=[##CODE##]\">[##RACINE##]src/pages/modif_mdp.php?code=[##CODE##]</a>.<br /><br />"
                . "A tr&egrave;s vite sur [##NAME_SITE##]<br />"
            );
        }
            return array(
                "titre" => "mot de passe modifi&eacute; pour votre compte sur [##NAME_SITE##]",
                "message" => "Madame, Monsieur,<br /><br />"
                . "Votre mot de passe administrateur sur [##NAME_SITE##] vient d'&ecirc;tre modifi&eacute;.<br />"
                . "Si vous n'&ecirc;tes pas &agrave; l'origine de cette demande, merci de nous le faire savoir &agrave; l'adresse [##EMAIL##]<br /><br />"
                . "A tr&egrave;s vite sur [##NAME_SITE##]"
            );
    }
}
