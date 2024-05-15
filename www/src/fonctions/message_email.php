<?php
/**
 * Pour envoyer un email.
 */

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('message_email')) {
    /**
     * Pour envoyer un message html (si le message ne peut pas etre lut en html, il sera affiche en texte).
     * Si le message texte est vide, il sera remplacer par le htlm (sans les balises).
     * 
     * @param type (string) $mail email de reception.
     * @param type (string) $mail_from email d'envoi.
     * @param type (string) $objet l'objet du message.
     * @param type (string) $messageHTML le message en html.
     * @param type (string) $messageText le message en format texte.
     */
    function message_email(?string $mail, ?string $mail_from, ?string $objet, ?string $messageHTML, ?string $messageText = null):void {
        message_email_encoder($mail, $mail_from, "UTF-8", $objet, $messageHTML, $messageText);
    }

    /**
     * Pour envoyer un message html (si le message ne peut pas etre lut en html, il sera affiche en texte).
     * Si le message texte est vide, il sera remplacer par le htlm (sans les balises).
     * 
     * @param type (string) $mail email de reception.
     * @param type (string) $mail_from email d'envoi.
     * @param type (string) $encoder l'encodage du texte ("UTF-8" ou "ISO-8859-1" ou ...).
     * @param type (string) $objet l'objet du message.
     * @param type (string) $messageHTML le message en html.
     * @param type (string) $messageText le message en format texte.
     */
    function message_email_encoder(?string $mail, ?string $mail_from, ?string $encoder, ?string $objet, ?string $messageHTML, ?string $messageText = null):void {
        $passage_ligne = "\n";
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) { // On filtre les serveurs qui rencontrent des bogues.
            $passage_ligne = "\r\n";
        }
        if(empty($messageText)) {
            $messageText = strip_tags(str_replace("<br />", "\n", $messageHTML));
        }
        //Creation de la boundary
        $boundary = "-----=" . md5(rand());
        //Creation du header de l'e-mail.
        $header = "From: \"" . $mail_from . "\" <" . $mail_from . ">" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
        //Creation du message.
        $message = $passage_ligne . "--" . $boundary . $passage_ligne;
        //Ajout du message au format texte.
        $message .= "Content-Type: text/plain; charset=\"".$encoder."\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $messageText . $passage_ligne;
        //Separateur html et text
        $message .= $passage_ligne . "--" . $boundary . $passage_ligne;
        //Ajout du message au format HTML
        $message .= "Content-Type: text/html; charset=\"".$encoder."\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $messageHTML . $passage_ligne;
        //Fin du message
        $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
        //Envoi de l'e-mail.
        mail($mail, html_entity_decode($objet), html_entity_decode($message), $header);
    }
}