<?php
/**
 * Pour le contenu du message lors d'envoie d'email pour la perte d'un mot de passe.
 */

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('text_email_mdp')) {
    
    /* inclure des fonctionnalites à la page */
    include_once dirname(__FILE__) . '/../config/config_default.php';

    /**
     * Message d'email pour une demande de changement de mot de passe.
     * $demande=false : message signalent la modification
     *
     * @param boolean $demande demande de changement de mot de passe
     * @return array|null tableau du message
     */
    function text_email_mdp(bool $demande = true): ?array {
        /* si on fait une demande de modification de mot de passe */
        if($demande) {
            /* le contenu de l'email pour modifier le mot de passe. */
            return array(
                "titre" => "le lien pour changer le mot de passe sur [##NAME_SITE##].",
                "message" => "Madame, Monsieur,<br /><br />"
                . "Vous avez demander de recevoir un lien et un code, pour cr&eacute;er un nouveau mot de passe apr&egrave;s la perte de celui-ci.<br />"
                . "Le code n'est valide qu'une seule fois et pour une durée de 12h (sinon vous allez devoir refaire une demande).<br /><br />"
                . "Le code : [##CODE##]<br />"
                . "Le login : [##LOGIN##]<br />"
                . "Avant le : [##DATE_VALIDE##]<br />"
                . "Le lien : <a href=\"[##RACINE##]index.php?ind=mmdp&code=[##CODE##]\">[##RACINE##]src/pages/modif_mdp.php?code=[##CODE##]</a>.<br /><br />"
                . "A tr&egrave;s vite sur [##NAME_SITE##]<br />"
            );
        }
        /* le contnu de l'email pour confirmer le changement de mot de passe. */
        return array(
            "titre" => "mot de passe modifi&eacute; pour votre compte sur [##NAME_SITE##]",
            "message" => "Madame, Monsieur,<br /><br />"
            . "Votre mot de passe sur [##NAME_SITE##] vient d'&ecirc;tre modifi&eacute;.<br />"
            . "Si vous n'&ecirc;tes pas &agrave; l'origine de cette demande, merci de nous le faire savoir &agrave; la page : <a href=\"[##PG_MSG##]\">[##PG_MSG##]</a>.<br /><br />"
            . "A tr&egrave;s vite sur [##NAME_SITE##]"
        );
    }

    /**
     * Modifier les informations dans le message d'email par les informations du site.
     *
     * @param string|null $text : le message avec des mots clees a remplacer.
     * @param array|null $tab_code : tableau avec des mots clees a modifier dans le message.
     * @return string|null le message sans mot clee.
     */
    function remplace_text(?string $text, ?array $tab_code):?string {
        /* tableau de mot clee du site predefini */
        $tab_values_site = array (
            "[##NAME_SITE##]" => NAME_SITE,
            "[##RACINE##]" => RACINE
        );
        /* remplace les mots clees predefini dans le message */
        foreach ($tab_values_site as $key => $value) {
            $text = str_replace($key, $value, $text);
        }
        /* remplace les mots clees dans le message */
        foreach ($tab_code as $key => $value) {
            $text = str_replace($key, $value, $text);
        }
        return $text;
    }

}
