<?php
/**
 * Pour la creation d'un fichier "errors.log" avec les messages d'erreurs rencontres.
 */
if (!class_exists('Error_Log')) {

    /**
     * Pour les contenir tous les logs rencontres dans les pages.
     */
    class Error_Log {

        // les variable de la classe
        private $logFile;
        private $error_log;

        /**
         * constructeur par defaut.
         */
        public function __construct() {
            $this->logFile = dirname(__FILE__)."/../../errors.log";
        }

        /**
         * Creation ou modification du fichier d'erreur, avec l'erreur rencontre.
         *
         * @param string|null ($message) : Le message d'erreur.
         * @return void ne retourne rien.
         */
        public function addError(?string $message): void {
            $ligne = "------------------------------------------------------------------------------------\n";
            $ligne .= date('Y-m-d H:i:s')."\t".$message."\n";

            // Enregistrement du message d'erreur dans le fichier log
            error_log($ligne, 3, $this->logFile);
        }

    }
}
