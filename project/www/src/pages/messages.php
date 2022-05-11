<?php

include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../class/Error_Log.php';

$desc = 0;
$img = "src/img/message_admin.svg";
if(!empty($_GET) && array_key_exists('desc', $_GET)) {
    $sgbd = connexion_sgbd();
    if(!empty($sgbd)) {
        try {
            $res = $sgbd->prepare("SELECT * FROM produits INNER JOIN photos ON produits.id_produit = photos.id_produit WHERE produits.id_produit=:id_produit LIMIT 1");
            $res->execute([
                ":id_produit" => $_GET['desc']
            ]);
            if($res->rowCount() > 0) {
                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                $desc = $_GET['desc'];
                if(!empty($data[0]['src'])) {
                    $img = "data/img/".$data[0]['src'];
                }
            }
        } catch (PDOException $e) {
            $error_log = new Error_Log();
            $error_log->addError($e);
            echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
        }
    } else {
    echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
    }
}
$html = file_get_contents(dirname(__FILE__) . '/../template/messages.html', true);

echo str_replace("#id_produit#",$desc,str_replace("#img_produit#",$img,$html));
