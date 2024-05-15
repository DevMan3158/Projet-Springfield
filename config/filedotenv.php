<?php
if(!function_exists("load_file_env")) {
    function load_file_env(string $path):void
    {
        $lines = file($path . '/.env');
        foreach ($lines as $line) {
            $line = trim($line);
            if(!empty($line)) {
                preg_match('/^#/', $line, $matches);
                if(empty($matches)) {
                    [$key, $value] = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);
                    $_ENV[$key] = $value;
                }
            }
        }
    }
}
