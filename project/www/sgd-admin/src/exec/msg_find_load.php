<?php 

session_start();

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';

$sql = "SELECT * FROM messages ".
"LEFT JOIN message_produit ON messages.Id_msg = message_produit.Id_msg ".
"LEFT JOIN produits ON produits.id_produit = message_produit.id_produit ".
"WHERE ";

$type = "user";
if(!empty($_GET) && array_key_exists("type", $_GET)) {
    $type = $_GET['type'];
}

$find = false;
if(!empty($_POST) && array_key_exists("recherche", $_POST) && !empty($_POST['recherche'])) {
    $find = true;
    $sql .= "(messages.Nom LIKE :find OR messages.Prenom LIKE :find OR ".
    "messages.Email LIKE :find OR messages.Objet LIKE :find OR messages.Message LIKE :find) AND ";
}



if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 && $_SESSION['id_admin'] == 1) {
    if(!empty($_POST) && array_key_exists('recherche', $_POST)) {
        $sgbd = connexion_sgbd();
        if(!empty($sgbd)) {
            try {
                if($type == "admin" && $find) {
                    $res = $sgbd->prepare($sql."id_user is NULL ORDER BY messages.Id_msg DESC");
                    $res->execute([
                        ":find" => "%".$_POST['recherche']."%"
                    ]);
                } else if($type == "admin" && !$find) {
                    $res = $sgbd->prepare($sql."id_user is NULL ORDER BY messages.Id_msg DESC");
                    $res->execute();
                } else if($find) {
                    $res = $sgbd->prepare($sql."id_user=:id_user ORDER BY messages.Id_msg DESC");
                    $res->execute([
                        ":find" => "%".$_POST['recherche']."%",
                        ":id_user" => $_SESSION['id_user']
                    ]);
                } else {
                    $res = $sgbd->prepare($sql."id_user=:id_user ORDER BY messages.Id_msg DESC");
                    $res->execute([
                        ":id_user" => $_SESSION['id_user']
                    ]);
                }
                $tab = $res->fetchAll(PDO::FETCH_ASSOC);
                
                echo "true"."[#json#]".json_encode($tab);
            } catch (PDOException $e) {
                $error_log = new Error_Log();
                $error_log->addError($e);
                echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
            }
        } else {
            echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
        }
    } else {
        echo "Vous n'avez pas le droit d'ouvrir cette page.";
    }
} else {
    echo "Vous n'avez pas le droit d'ouvrir cette page.";
}