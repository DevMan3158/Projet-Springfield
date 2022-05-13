<?php

include_once dirname(__FILE__) . '/../fonctions/text_email_mdp.php';
include_once dirname(__FILE__) . '/../fonctions/message_email.php';
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';

session_start();

if (!empty($_POST) && array_key_exists('login', $_POST) && array_key_exists('password_user', $_POST)) {
    // recupere l'adresse email et le dossier serveur
    $data_compte = mysql_fetch_assoc($req_compte);

    // creation d'un code unique
    $class_create_pass = new CreateValidatePassword();
    $class_create_pass->hardCode(true);
    $code = $class_create_pass->createPasswrd("15");

    // calcul la duree de validite de la demande
    $time = mktime(date("H") + CHMDP_H, date("i") + CHMDP_I, date("s") + CHMDP_S, date("m") + CHMDP_M, date("d") + CHMDP_D, date("Y") + CHMDP_Y);
    $date = date("Y-m-d H:i:s", $time);

    // creation d'une clee unique
    $key = md5(uniqid() . "ID" . $_POST["id"] . "JT" . $_POST['jeton'] . "D" . mktime());

    // ajoute la demande de validite
    $query = "INSERT INTO " . PREFIXE . "mdp_renouveler ("
    . "jeton_mdp, "
    . "id_compte, "
    . "jeton_compte, "
    . "code_mdp, "
                    . "date_string, "
                    . "date_time"
                    . ") VALUES ("
                    . "'" . safemode_injection($key) . "', "
                    . "'" . safemode_injection($_POST["id"]) . "', "
                    . "'" . safemode_injection($_POST['jeton']) . "', "
                    . "'" . safemode_injection($code) . "', "
                    . "'" . safemode_injection($date) . "', "
                    . "'" . safemode_injection($time) . "'"
                    . ")";
            mysql_query($query) or die("erreur 989785 : " . mysql_error());

    $message = str_replace("\n", "<br />\n", str_replace("[##KEY##]", $key, str_replace("[##RACINE##]", RACINE . $data_compte['dossier_serveur'], str_replace("[##CODE##]", $code, $email_perte_mdp['message']))));

    // on envoie le message a l'ecole
    message_email($data_compte['email'], EMAIL_HIBOU_CLIENT_CONTACT_NOREPLY, "iso-8859-1", html_entity_decode($email_perte_mdp['titre'], ENT_COMPAT, "iso-8859-1"), html_entity_decode($message, ENT_COMPAT, "iso-8859-1"));

} else {
    echo "Il manque des informations pour vous connecter.";
}