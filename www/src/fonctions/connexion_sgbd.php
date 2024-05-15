<?php
/**
 * Pour se connecter a la base de donner a partir du fichier "sgbd_config.php".
 * Pouvoir avoir une connexion a la base de donnees differentes.
 */

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('connexion_sgbd')) {
    // inculre la classe qui va creer le fichier "errors.log" en cas d'erreur.
    include_once dirname(__FILE__) . '/../class/Error_Log.php';

    // fonction pour faire la connexion a la base de donnes
    function connexion_sgbd() {

        // verifier l'existance du fichier pour ouvrir la base de donnees
        if(file_exists(dirname(__FILE__) . '/../config/sgbd_config.php')) {
            // recupere les valeurs de connexion a la base de donnees.
            include dirname(__FILE__) . '/../config/sgbd_config.php';
        }
        
        // recupere les valeurs de connexion a la base et si null ou vide, on met une valeur par defaut.
        $sgbd_conn_type = !empty($sgbd_type) ? $sgbd_type : "mysql";
        $sgbd_conn_server = !empty($sgbd_server) ? $sgbd_server : "localhost";
        $sgbd_conn_port = !empty($sgbd_port) ? $sgbd_port : "0";
        $sgbd_conn_name = !empty($sgbd_name) ? $sgbd_name : "";
        $sgbd_conn_user = !empty($sgbd_user) ? $sgbd_user : "";
        $sgbd_conn_pass = !empty($sgbd_pass) ? $sgbd_pass : "";
        $sgbd_conn_prefix = !empty($sgbd_prefix) ? $sgbd_prefix : "";

        // creation de la ligne de connexion a placer dans PDO
        $line = $sgbd_conn_type . ':host=' . $sgbd_conn_server;
        // si on a besoin d'un numero de port
        if(!empty($sgbd_conn_port) && $sgbd_conn_port !== "0") {
            $line .= ';port=' . $sgbd_conn_port;
        }
        // si on a le nom de la table
        if(!empty($sgbd_conn_name)) {
            $line .= ';dbname=' . $sgbd_conn_name;
        }
        // utilisation de l'encodage UTF-8
        $line .= ";charset=UTF8";

        // valeur $sgbd a null par defaut.
        $sgbd = null;
        try {
            // verifier qu'on utilise un nom d'utilisateur et un mot de passe.
            if(!empty($sgbd_conn_user) && !empty($sgbd_conn_pass)) {
                $sgbd = new PDO($line, $sgbd_conn_user, $sgbd_conn_pass);
            // si on a seulement un nom d'utilisateur et pas de mot de passe.
            } else if(!empty($sgbd_conn_user)) {
                $sgbd = new PDO($line, $sgbd_conn_user, "");
            // si on n'a aucun des deux.
            } else {
                $sgbd = new PDO($line);
            }
        } catch (PDOException $e) {
            // en cas d'erreur de connexion, on place le message dans le fichier "errors.log".
            $error_log = new Error_Log();
            $error_log->addError($e);
        }
        // retourne la connexion a la base.
        return $sgbd;
    }
}

