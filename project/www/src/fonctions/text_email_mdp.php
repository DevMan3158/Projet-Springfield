<?php
// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('text_email_mdp')) {
    function text_email_mdp(bool $demande = true): ?array {
        if(true) {
            return array(
                "titre" => "le lien pour changer le mot de passe hibouth&egrave;que",
                "message" => "Madame, Monsieur\n\n"
                . "Vous avez demander de recevoir un lien et un code, pour cr&eacute;er un nouveau mot de passe apr&egrave;s la perte de celui-ci.\n\n"
                . "Le code : [##CODE##]\n"
                . "Le lien : <a href=\"[##RACINE##]?page=mdp&key=[##KEY##]\">[##RACINE##]?page=mdp&key=[##KEY##]</a>.\n\n"
                . "A tr&egrave;s vite sur www.hiboutheque.fr\n"
            );
        }
            return array(
                "titre" => "mot de passe modifi&eacute; pour hibouth&egrave;que",
                "message" => "Madame, Monsieur\n\n"
                . "Votre mot de passe administrateur d'hibouth&egrave;que vient d'&ecirc;tre modifier.\n"
                . "Si vous n'&ecirc;tes pas &agrave; l'origine de cette demande, merci de nous le faire savoir &agrave; l'adresse [##EMAIL##]\n\n"
                . "A tr&egrave;s vite sur www.hiboutheque.fr"
            );
    }
}
