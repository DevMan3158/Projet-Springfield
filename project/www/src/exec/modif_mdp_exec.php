<?php

include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';

$sgbd = connexion_sgbd();

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('code', $_POST) && array_key_exists('login', $_POST) && 
    array_key_exists('password', $_POST) && array_key_exists('password_rep', $_POST)) {

    if(!empty($sgbd)) {
        
        if(preg_match("/^.{3,255}$/", $_POST['code']) && preg_match("/^..{3,40}$/",$_POST['login']) 
            && preg_match("/^.{6,}$/",$_POST['password']) && preg_match("/^.{6,}$/",$_POST['password_rep'])) {
            $valide = true;
            try {
                $id = 0;
                if($_POST['password_rep'] != $_POST['password']) {
                    echo "Le mot de passe n'est pas identique, merci de recommencer.";
                    $valide = false;
                }
                if($valide) {
                    $res = $sgbd->prepare("SELECT * FROM utilisateur INNER JOIN pass_perdu  ON utilisateur.id_user = pass_perdu.id_user ".
                    "WHERE login=:login AND jeton=:jeton AND valie=1 AND expiration > CURDATE()");
                    $res->execute([
                        ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                        ":jeton" => htmlspecialchars(stripslashes(trim($_POST['code']))),
                    ]);
                    if($res->rowCount() > 0) {
                        echo "Le code de validation n'est plus valide.";
                        $valide = false;
                    } else {
                        $id = $res->fetch(PDO::FETCH_ASSOC)["id_user"];
                    }
                }
                if($valide) {
                        $res = $sgbd->prepare("UPDATE utilisateur SET mot_pass=:mot_pass WHERE id_user=:id_user");
                        $res->execute([
                            ":id_user" => $id,
                            ":mot_pass" => Pass_Crypt::password($_POST['password']),
                        ]);
                        echo "true";
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
