<?php
require __DIR__ . "/filedotenv.php";
load_file_env(__DIR__);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$sgbd_type = "mysql";
$sgbd_server = $_ENV['NAME_PROJECT'] . "_mariadb";
$sgbd_port = "0";
$sgbd_name = $_ENV['SGBD_DATABASE'];
$sgbd_user = "root";
$sgbd_pass = $_ENV['SGBD_PASSWORD'];
$sgbd_prefix = "";

