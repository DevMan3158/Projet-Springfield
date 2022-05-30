<?php
/**
 * Pour crypter le mot de passe ou verifier la validiter d'un mot de passe.
 */
if (!class_exists('Pass_Crypt')) {

    /* inclure des fonctionnalites à la page */
    include_once dirname(__FILE__) . '/Error_Log.php';

    /**
     * Creation de la classe de cryptage ou verifier un mot de passe utilisateur.
     */
    class Pass_Crypt {

        /**
         * Le debut du mot de passe crypter, pour connetre son cryptage (retirer du mot de passe crypter pour des raison de securite).
         */
        private const START_PASS = '$argon2i$v=19$m=65536,t=4,p=1$';

        /**
         * Ce code va tester votre serveur pour déterminer quel serait le meilleur "cost".
         * Vous souhaitez définir le "cost" le plus élevé possible sans trop ralentir votre serveur.
         * 8-10 est une bonne base, mais une valeur plus élevée est aussi un bon choix à partir
         * du moment où votre serveur est suffisament rapide ! Le code suivant espère un temps
         * ≤ à 50 millisecondes, ce qui est une bonne base pour les systèmes gérants les identifications
         * intéractivement.
         * @return integer le meilleur "cost".
         */
        public static function test_Cost():int {
            $error_log = new Error_Log();
            $timeTarget = 0.05; // 50 millisecondes

            $cost = 8;
            /* se proteger des erreurs (pour ne pas afficher l'erreur a l'ecran) */
            try {
                do {
                    $cost++;
                    $start = microtime(true);
                    password_hash("test", PASSWORD_ARGON2I, ["cost" => $cost]);
                    $end = microtime(true);
                } while (($end - $start) < $timeTarget);
            } catch (Exception $e) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
                $error_log = new Error_Log();
                $error_log->addError($e);
            }
            return $cost;

        }
        
        /**
         * Crypter le mot de passe.
         * @param string|null $pass : le mot de passe a crypter.
         * @return string|null retourne le mot de passe crypte.
         */
        public static function password(?string $pass):?string {
            $error_log = new Error_Log();
            /* se proteger des erreurs (pour ne pas afficher l'erreur a l'ecran) */
            try {
                $options = [
                    'cost' => Pass_Crypt::test_Cost(),
                ];
                return str_replace(Pass_Crypt::START_PASS, '', password_hash($pass, PASSWORD_ARGON2I, $options));
            } catch (Exception $e) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
                $error_log = new Error_Log();
                $error_log->addError($e);
            }
            return "";
        }

        /**
         * 
         * @param string|null $pass : le mot de passe a tester.
         * @param string|null $hash : le mot de passe crypter a tester.
         * @return boolean retourne true, si le mot de passe est valide.
         */
        public static function verify(?string $pass, ?string $hash):bool {
            $error_log = new Error_Log();
            /* se proteger des erreurs (pour ne pas afficher l'erreur a l'ecran) */
            try {
                return password_verify($pass, Pass_Crypt::START_PASS.$hash);
            } catch (Exception $e) {
                /* sauvegarde le message d'erreur dans le fichier "errors.log" */
                $error_log = new Error_Log();
                $error_log->addError($e);
            }
            return false;
        }

    }
}
