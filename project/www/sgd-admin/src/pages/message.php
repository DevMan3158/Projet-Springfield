<?php

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/error_msg.php';


if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 
&& ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {

  $select = "";
  if($_SESSION['id_admin'] == 1) {
    $select = "<select id=\"select_type_msg\" class=\"custom-select custom-select-sm\">".
      "<option value=\"user\" selected>Gestionnaire</option>".
      "<option value=\"admin\">Administrateur</option>".
      "</select>";
  }

  $html = file_get_contents(dirname(__FILE__) . '/../template/message.html', true);
  $list = "";

  $sgbd = connexion_sgbd();
  if(!empty($sgbd)) {
    try {
      $res = $sgbd->prepare("SELECT * FROM messages INNER JOIN message_produit ".
      "ON messages.Id_msg = message_produit.Id_msg INNER JOIN produits ".
      "ON produits.id_produit = message_produit.id_produit WHERE id_user=:id_user ORDER BY messages.Id_msg DESC");
      $res->execute([
        ":id_user" => $_SESSION['id_user']
      ]);
      $data = $res->fetchAll(PDO::FETCH_ASSOC);
      $data_list = "";
        foreach($data as $value) {
            $img_no_lu = "enveloppe.svg";
            $msg_no_lu = "display_msg_no_lu";
            if($value['lu'] == "1") {
                $img_no_lu = "document.svg";
                $msg_no_lu = "display_msg_lu";
            }
            $data_list .= '<li class="list-group-item display_msg text-left '.$msg_no_lu.'" id="msg_'.$value['Id_msg'].'">';
            $data_list .= '<img id="img_msg_'.$value['Id_msg'].'" src="./src/img/'.$img_no_lu.'" /> ';
            $data_list .= $value['Objet'];
            $data_list .= '</li>';
        }
      $list = $data_list;
    } catch (PDOException $e) {
      $error_log = new Error_Log();
      $error_log->addError($e);
      echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
    }
  } else {
    echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
  }
  
  $remp_box_msg = str_replace("#msg_from#","",str_replace("#msg_date#","",str_replace("#msg_obj#","",$html)));
  echo str_replace("#list_msg#",$list,str_replace("#select_msg#", $select, $remp_box_msg));
} else {
  error_msg("401");
}
