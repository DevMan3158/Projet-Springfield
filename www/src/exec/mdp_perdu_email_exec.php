<?php
/**
 * Execute l'envoie par email d'une demande de modification de mot de passe.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../fonctions/text_email_mdp.php';
include_once dirname(__FILE__) . '/../fonctions/message_email.php';
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';
include_once dirname(__FILE__) . '/../class/Pass_Crypt.php';
include_once dirname(__FILE__) . '/../config/config_duree_demande_mdp.php';
include_once dirname(__FILE__) . '/../config/config_default.php';

/* verifier qu'on vient a partir d'un formulaire */
if (!empty($_POST) && array_key_exists('email', $_POST)) {

    /* recupere le message a envoyer par email */
    $perte_mdp = text_email_mdp();

    /* creation des clees a remplacer dans le message */
    $tab_code = array (
        "[##CODE##]" => "",
        "[##LOGIN##]" => "",
        "[##DATE_VALIDE##]" => ""
    );

    /* placer la local vers la france */
    setlocale(LC_ALL, "fr_FR");
    // calcul la duree de validite de la demande
    $time = mktime(date("H") + CHMDP_H, date("i") + CHMDP_I, date("s") + CHMDP_S, date("m") + CHMDP_M, date("d") + CHMDP_D, date("Y") + CHMDP_Y);
    $date = date("Y-m-d H:i:s", $time);
    /* remplace la valeur de la clee de duree de validation */
    $tab_code["[##DATE_VALIDE##]"] = date("d/m/Y H:i:s", $time);

    /* se connecter a la base de donnees */
    $sgbd = connexion_sgbd();
    /* verifier qu'on est bien connecte a la base */
    if(!empty($sgbd)) {
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
                /* demande les information de l'utilisateur */
                $res = $sgbd->prepare("SELECT * FROM utilisateur WHERE email=:email LIMIT 1");
                $res->execute([
                    ":email" => htmlspecialchars(stripslashes(trim($_POST['email'])))
                ]);
                /* verifier qu'on a bien un utilisateur */
                if($res->rowCount() > 0) {
                    /* recupere les information de l'utilisateur */
                    $result = $res->fetch(PDO::FETCH_ASSOC);
                    $id = $result['id_user'];

                    // creation d'une clee unique
                    $key = md5(uniqid() . $id . $result['login'] . $_POST["email"] . time());

                    /* rempli les clees avec les bonnes valeurs */
                    $tab_code["[##CODE##]"] = $key;
                    $tab_code["[##LOGIN##]"] = $result['login'];

                    // ajoute la demande de validite
                    $res = $sgbd->prepare("INSERT INTO pass_perdu (id_user, jeton, expiration) VALUES (:id_user, :jeton, :expiration)");
                    $res->execute([
                        ":id_user" => $id,
                        ":jeton" => $tab_code["[##CODE##]"],
                        ":expiration" => $date
                    ]);

                    // on envoie le message
                    message_email($_POST["email"], EMAIL_NOREPLY, remplace_text($perte_mdp["titre"], $tab_code), remplace_text($perte_mdp["message"], $tab_code));

                    echo "true"; 
                } else {
                    echo "Cette adresse email n'est pas reconnu dans notre base, merci de créer un compte.";
                }
            } else {
                echo "Un problème c'est produite lors de l'envoie du message.";
            }
        } catch (PDOException $e) {
            /* sauvegarde le message d'erreur dans le fichier "errors.log" */
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