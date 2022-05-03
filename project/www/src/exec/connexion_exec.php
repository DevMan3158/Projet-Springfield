<?php

include_once './../fonctions/connexion_sgbd.php';
include_once './../class/Error_Log.php';

session_start();

if (!empty($_POST) && array_key_exists('login', $_POST) && array_key_exists('password_user', $_POST)) {

    $sgbd = connexion_sgbd();
    try {
    $res = $sgbd->prepare("SELECT * FROM utilisateur LEFT JOIN admin ON utilisateur.id_admin = admin.id_admin".
                    " WHERE login=:login OR email=:login");
    $res->bindParam(':login', $login);
    $res->execute();
    $data = $res->fetchAll(PDO::FETCH_OBJ);
    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value) {
                            $data_line[$key] = $value;
                        }
                        if(Pass_Crypt::verify($pass, $data_line['pass'])) {
                            $user = new User(
                                utf8_encode($data_line['name']),
                                utf8_encode($data_line['firstname']),
                                utf8_encode($data_line['email']),
                                utf8_encode($data_line['login'])
                            );
                            $user->setPass_hash($data_line['pass']);
                            $user->setJeton($data_line['jeton']);
                            $user->setIdSt($data_line['id_user']);
                            $user->setDateSt($data_line['date']);
                            $user->setAdmin($this->testAdmin($data_line['name_admin']));
                            $values = $user;
                        }
                    }
                } catch (PDOException $exc) {
                    $this->error_log->addError($exc);
                }

    /*$users = new SGBD_Users();
    $user = $users->user($login, $pass);
    if(!empty($user)) {
        $_SESSION['id_user'] = $user->getId();
        $_SESSION['jeton'] = $user->getJeton();
    }
    return true;*/
    /*$_SESSION['id_user'] = "";
    $_SESSION['id_admin'] = "";
    $_SESSION['nom'] = "";
    $_SESSION['prenom'] = "";
    $_SESSION['login'] = "";
    $_SESSION['email'] = "";
    $_SESSION['avatar'] = "";*/
    echo "1";
} else {
    echo "2";
}