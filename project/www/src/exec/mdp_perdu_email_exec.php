<?php

include_once dirname(__FILE__) . '/../fonctions/text_email_mdp.php';
include_once dirname(__FILE__) . '/../fonctions/message_email.php';
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';
include_once dirname(__FILE__) . '/../config/config_duree_demande_mdp.php';
if(file_exists(dirname(__FILE__) . '/../config/config.php')) {
    include_once dirname(__FILE__) . '/../config/config.php';
} else {
    define("RACINE", "http://localhost/");
    define("RACINE_PATH", dirname(__FILE__)."/../../");
    define("DATA_PATH", dirname(__FILE__)."/../../data/");
    define("DATA_WEB", RACINE."data/");
    define("NAME_SITE", "Office du tourisme de Springfield");
}

function remplace_text(?string $text, ?array $tab_code):?string {
    $tab_values_site = array (
        "[##NAME_SITE##]" => NAME_SITE,
        "[##RACINE##]" => RACINE
    );
    foreach ($tab_values_site as $key => $value) {
        $text = str_replace($key, $value, $text);
    }
    foreach ($tab_code as $key => $value) {
        $text = str_replace($key, $value, $text);
    }
    return $text;
}

if (!empty($_POST) && array_key_exists('email', $_POST)) {
    $perte_mdp = text_email_mdp();

    $tab_code = array (
        "[##CODE##]" => "",
        "[##LOGIN##]" => ""
    );

    // calcul la duree de validite de la demande
    $time = mktime(date("H") + CHMDP_H, date("i") + CHMDP_I, date("s") + CHMDP_S, date("m") + CHMDP_M, date("d") + CHMDP_D, date("Y") + CHMDP_Y);
    $date = date("Y-m-d H:i:s", $time);

    $sgbd = connexion_sgbd();
    if(!empty($sgbd)) {

        try {

            $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE id_admin=1 LIMIT 1");
            $res->execute([
                ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
            ]);
            if($res->rowCount() > 0) {
                $email_admin = $res->fetch(PDO::FETCH_ASSOC)["email"];
                $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE email=:email LIMIT 1");
                $res->execute([
                    ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
                ]);
                if($res->rowCount() > 0) {
                    
                    $result = $res->fetch(PDO::FETCH_ASSOC);
                    $id = $result['id_user'];

                    // creation d'une clee unique
                    $key = md5(uniqid() . $id . $result['login'] . $_POST["email"] . time());

                    $tab_code["[##CODE##]"] = $key;
                    $tab_code["[##LOGIN##]"] = $result['login'];

                        

                    // ajoute la demande de validite
                    $res = $sgbd->prepare("INSERT INTO pass_perdu (id_user, jeton, expiration) VALUES (:id_user, :jeton, :expiration)");
                    $res->execute([
                        ":id_user" => $id,
                        ":jeton" => $tab_code["[##CODE##]"],
                        ":expiration" => $date
                    ]);

                    // on envoie le message a l'ecole
                    message_email($_POST["email"], $email_admin, remplace_text($perte_mdp["titre"], $tab_code), remplace_text($perte_mdp["message"], $tab_code));
                    echo "true"; 
                } else {
                    echo "Cette adresse email n'est pas reconnu dans notre base, merci de créer un compte.";
                }
            } else {
                echo "Cette adresse email n'est pas reconnu dans notre base, merci de créer un compte.";
            }
        } catch (PDOException $e) {
            $error_log = new Error_Log();
            $error_log->addError($e);
            echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
        }
    } else {
        echo "Une erreur est survenu lors de la connexion.";
    }
} else {
    echo "Il manque des informations pour vous connecter.";
}