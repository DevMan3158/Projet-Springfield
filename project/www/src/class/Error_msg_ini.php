<?php
if (!class_exists('Error_msg_ini')) {

    /**
     * Pour les contenir tous les logs rencontres dans les pages.
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

        public function error(?String $error): ?array {
            return $this->error_ini[$error];
        }
    }
}