<?php

if (!class_exists('Pass_Crypt')) {

    include_once dirname(__FILE__) . '/Error_Log.php';

    class Pass_Crypt {

        private const START_PASS = '$argon2i$v=19$m=65536,t=4,p=1$';

        public static function test_Cost():int {
            $error_log = new Error_Log();
            $timeTarget = 0.05; // 50 millisecondes

            $cost = 8;
            try {
                do {
                    $cost++;
                    $start = microtime(true);
                    password_hash("test", PASSWORD_ARGON2I, ["cost" => $cost]);
                    $end = microtime(true);
                } while (($end - $start) < $timeTarget);
            } catch (Exception $e) {
                $error_log->addError(776710000, "plats_chaud", $e);
            }
            return $cost;

        }

        public static function password(?string $pass):?string {
            $error_log = new Error_Log();
            try {
                $options = [
                    'cost' => Pass_Crypt::test_Cost(),
                ];
                return str_replace(Pass_Crypt::START_PASS, '', password_hash($pass, PASSWORD_ARGON2I, $options));
            } catch (Exception $e) {
                $error_log->addError(776710000, "plats_chaud", $e);
            }
            return "";
        }

        public static function verify(?string $pass, ?string $hash):bool {
            $error_log = new Error_Log();
            try {
                return password_verify($pass, Pass_Crypt::START_PASS.$hash);
            } catch (Exception $e) {
                $error_log->addError(776710000, "plats_chaud", $e);
            }
            return false;
        }

    }
}
