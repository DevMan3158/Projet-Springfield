<?php
/**
 * Execute le changement de mot de passe.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';
include_once dirname(__FILE__) . '/../fonctions/text_email_mdp.php';
include_once dirname(__FILE__) . '/../fonctions/message_email.php';
include_once dirname(__FILE__) . '/../config/config_default.php';

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('code', $_POST) && array_key_exists('login', $_POST) && 
    array_key_exists('password', $_POST) && array_key_exists('email', $_POST) && 
    array_key_exists('password_rep', $_POST)) {

    /* se connecter a la base de donnees */
    $sgbd = connexion_sgbd();

    /* creation des clees a remplacer dans le message */
    $tab_code = array (
        "[##EMAIL##]" => "",
        "[##PG_MSG##]" => RACINE_MSG
    );
    
    /* regex de validation de l'adresse email */
    $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

    /* verifier qu'on est bien connecte a la base */
    if(!empty($sgbd)) {
        /* recupere le message a envoyer par email */
        $perte_mdp = text_email_mdp(false);
        
        /* verifier la validiter des informations */
        if(preg_match("/^.{3,255}$/", $_POST['code']) && preg_match("/^..{3,40}$/",$_POST['login']) 
            && preg_match("/^.{6,}$/",$_POST['password']) && preg_match("/^.{6,}$/",$_POST['password_rep'])
            && preg_match($regexEmailValide,$_POST['email'])) {
            $valide = true;
            /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
            try {
                /* recupere l'adresse email d'un administrateur */
                $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE id_admin=1 LIMIT 1");
                $res->execute([
                    ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
                ]);
                /* si une adresse email a ete trouve */
                if($res->rowCount() > 0) {
                    /* recupere l'email de l'administrateur */
                    $email_admin = $res->fetch(PDO::FETCH_ASSOC)["email"];
                    /* rempli les clees avec les bonnes valeurs */
                    $tab_code["[##EMAIL##]"] = $email_admin;
                    /* on place id utilisateur et son niveau admin a 0 */
                    $id = 0;
                    $id_mmdp = 0;
                    /* verifier que les mots de passes sont identiques */
                    if($_POST['password_rep'] != $_POST['password']) {
                        echo "Le mot de passe n'est pas identique, merci de recommencer.";
                        $valide = false;
                    }
                    /* si tout est bon */
                    if($valide) {
                        /* verifier la valider du code pour modifier le mot de passe */
                        $res = $sgbd->prepare("SELECT * FROM utilisateur INNER JOIN pass_perdu  ON utilisateur.id_user = pass_perdu.id_user ".
                        "WHERE login=:login AND email=:email AND jeton=:jeton AND valide=1 AND expiration > CURRENT_TIMESTAMP");
                        $res->execute([
                            ":login" => htmlspecialchars(stripslashes(trim($_POST['login']))),
                            ":jeton" => htmlspecialchars(stripslashes(trim($_POST['code']))),
                            ":email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                        ]);
                        if($res->rowCount() > 0) {
                            /* si c'est valide, on recupere les id */
                            $values = $res->fetch(PDO::FETCH_ASSOC);
                            $id_mmdp = $values["id_pass_perdu"];
                            $id = $values["id_user"];
                        } else {
                            echo "Le code de validation n'est plus valide.";
                            $valide = false;
                        }
                    }
                    /* si tout est bon */
                    if($valide) {
                        /* on modifit le mot de passe de l'utilisateur */
                        $res = $sgbd->prepare("UPDATE utilisateur SET mot_pass=:mot_pass WHERE id_user=:id_user");
                         $res->execute([
                            ":id_user" => $id,
                            ":mot_pass" => Pass_Crypt::password($_POST['password']),
                        ]);
                        /* on dessactive la validite du code, pour pas le re-utiliser */
                        $res = $sgbd->prepare("UPDATE pass_perdu SET valide=0 WHERE id_pass_perdu=:id_pass_perdu");
                        $res->execute([
                            ":id_pass_perdu" => $id_mmdp,
                        ]);

                        /* envoyer un message confirment la modification. */
                        message_email($_POST["email"], EMAIL_NOREPLY, remplace_text($perte_mdp["titre"], $tab_code), remplace_text($perte_mdp["message"], $tab_code));
                        echo "true";
                    }
                } else {
                    echo "Un problème c'est produite lors de l'envoie du message.";
                }
            } catch (PDOException $exc) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
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
