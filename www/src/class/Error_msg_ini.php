<?php
/**
 * Tout les erreur rencontre dans les pages avec un codage d'erreur sous le format web (du style : 401 ou 500 ...).
 */
if (!class_exists('Error_msg_ini')) {

    /**
     * Pour les contenir tous les erreurs rencontres dans les pages.
     */
    class Error_msg_ini {

        // les variable de la classe
        private $error_ini;

        /**
         * constructeur par defaut.
         */
        public function __construct() {
            $this->error_ini = parse_ini_file(dirname(__FILE__)."/../config/error.ini", true);
        }

        /**
         * Recupere les informations des erreurs.
         *
         * @param string|null $error la valeur de l'erreur sous format page html, exemple: 401
         * @return array|null retourne un tableau du style ["img"=>"","title"=>"","msg"=>""].
         */
        public function error(?String $error): ?array {
            return $this->error_ini[$error];
        }
    }
}