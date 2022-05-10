<?php

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('connexion_sgbd')) {
    include_once dirname(__FILE__) . '/../class/Error_Log.php';

    function connexion_sgbd() {

        if(file_exists(dirname(__FILE__) . '/../config/sgbd_config.php')) {
            include dirname(__FILE__) . '/../config/sgbd_config.php';
        }
        
        $sgbd_conn_type = !empty($sgbd_type) ? $sgbd_type : "mysql";
        $sgbd_conn_server = !empty($sgbd_server) ? $sgbd_server : "localhost";
        $sgbd_conn_port = !empty($sgbd_port) ? $sgbd_port : "0";
        $sgbd_conn_name = !empty($sgbd_name) ? $sgbd_name : "springfield";
        $sgbd_conn_user = !empty($sgbd_user) ? $sgbd_user : "root";
        $sgbd_conn_pass = !empty($sgbd_pass) ? $sgbd_pass : "";
        $sgbd_conn_prefix = !empty($sgbd_prefix) ? $sgbd_prefix : "";

        $line = $sgbd_conn_type . ':host=' . $sgbd_conn_server;
        if(!empty($sgbd_conn_port) && $sgbd_conn_port !== "0") {
            $line .= ';port=' . $sgbd_conn_port;
        }
        if(!empty($sgbd_conn_name)) {
            $line .= ';dbname=' . $sgbd_conn_name;
        }
        $line .= ";charset=UTF8";

        $sgbd = null;
        try {
            
            if(!empty($sgbd_conn_user) && !empty($sgbd_conn_pass)) {
                $sgbd = new PDO($line, $sgbd_conn_user, $sgbd_conn_pass);
            } else {
                $sgbd = new PDO($line);
            }
        } catch (PDOException $e) {
            $error_log = new Error_Log();
            $error_log->addError($e);
        }
        return $sgbd;
    }
}

