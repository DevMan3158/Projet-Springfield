<?php

include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';
include_once dirname(__FILE__) . '/../fonctions/text_email_mdp.php';
include_once dirname(__FILE__) . '/../fonctions/message_email.php';
include_once dirname(__FILE__) . '/../config/config_default.php';

$sgbd = connexion_sgbd();

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('code', $_POST) && array_key_exists('login', $_POST) && 
    array_key_exists('password', $_POST) && array_key_exists('email', $_POST) && 
    array_key_exists('password_rep', $_POST)) {

    $tab_code = array (
        "[##EMAIL##]" => ""
    );
    
    $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

    if(!empty($sgbd)) {
        $perte_mdp = text_email_mdp(false);
        
        if(preg_match("/^.{3,255}$/", $_POST['code']) && preg_match("/^..{3,40}$/",$_POST['login']) 
            && preg_match("/^.{6,}$/",$_POST['password']) && preg_match("/^.{6,}$/",$_POST['password_rep'])
            && preg_match($regexEmailValide,$_POST['email'])) {
            $valide = true;
            try {
                $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE id_admin=1 LIMIT 1");
                $res->execute([
                    ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
                ]);
                if($res->rowCount() > 0) {
                    $email_admin = $res->fetch(PDO::FETCH_ASSOC)["email"];
                    $tab_code["[##EMAIL##]"] = $email_admin;
                    $id = 0;
                    $id_mmdp = 0;
                    if($_POST['password_rep'] != $_POST['password']) {
                        echo "Le mot de passe n'est pas identique, merci de recommencer.";
                        $valide = false;
                    }
                    if($valide) {
                        $res = $sgbd->prepare("SELECT * FROM utilisateur INNER JOIN pass_perdu  ON utilisateur.id_user = pass_perdu.id_user ".
                        "WHERE login=:login AND email=:email AND jeton=:jeton AND valide=1 AND expiration > CURRENT_TIMESTAMP");
                        $res->execute([
                            ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                            ":jeton" => htmlspecialchars(stripslashes(trim($_POST['code']))),
                            ":email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                        ]);
                        if($res->rowCount() > 0) {
                            $values = $res->fetch(PDO::FETCH_ASSOC);
                            $id_mmdp = $values["id_pass_perdu"];
                            $id = $values["id_user"];
                        } else {
                            echo "Le code de validation n'est plus valide.";
                            $valide = false;
                        }
                    }
                    if($valide) {
                            $res = $sgbd->prepare("UPDATE utilisateur SET mot_pass=:mot_pass WHERE id_user=:id_user");
                            $res->execute([
                                ":id_user" => $id,
                                ":mot_pass" => Pass_Crypt::password($_POST['password']),
                            ]);
                            $res = $sgbd->prepare("UPDATE pass_perdu SET valide=0 WHERE id_pass_perdu=:id_pass_perdu");
                            $res->execute([
                                ":id_pass_perdu" => $id_mmdp,
                            ]);// on envoie le message a l'ecole

                            message_email($_POST["email"], $email_admin, remplace_text($perte_mdp["titre"], $tab_code), remplace_text($perte_mdp["message"], $tab_code));
                            echo "true";
                    }
                } else {
                    echo "Un problème c'est produite lors de l'envoie du message.";
                }
            } catch (PDOException $exc) {
                $error_log = new Error_Log();
                $error_log->addError($e);
                echo "Une erreur c'est produite lors de l'envoie du message.";
            }
        } else {
            echo 'Il manque des informations pour transmettre le message.';
        }
    } else {
        echo "Une erreur c'est produite lors de l'envoie du message.";
    }

} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}
