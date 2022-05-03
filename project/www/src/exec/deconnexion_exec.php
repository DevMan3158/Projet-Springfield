<?php

session_start();

if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION)) {
    $_SESSION['id_user'] = "";
    unset($_SESSION['id_user']);
}
if(!empty($_SESSION) && array_key_exists('id_admin', $_SESSION)) {
    $_SESSION['id_admin'] = "";
    unset($_SESSION['id_admin']);
}
if(!empty($_SESSION) && array_key_exists('nom', $_SESSION)) {
    $_SESSION['nom'] = "";
    unset($_SESSION['nom']);
}
if(!empty($_SESSION) && array_key_exists('prenom', $_SESSION)) {
    $_SESSION['prenom'] = "";
    unset($_SESSION['prenom']);
}
if(!empty($_SESSION) && array_key_exists('login', $_SESSION)) {
    $_SESSION['login'] = "";
    unset($_SESSION['login']);
}
if(!empty($_SESSION) && array_key_exists('email', $_SESSION)) {
    $_SESSION['email'] = "";
    unset($_SESSION['email']);
}
if(!empty($_SESSION) && array_key_exists('avatar', $_SESSION)) {
    $_SESSION['avatar'] = "";
    unset($_SESSION['avatar']);
}
unset($_SESSION);
session_destroy();

