<?php
/**
 * Afficher les messages recu.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/error_msg.php';

/* verifier qu'on as le droit de venir sur cette page */
if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 
&& ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {

  /* pas de selection si c'est un gestionnaire */
  $select = "";
  /* si c'est un administrateur */
  if($_SESSION['id_admin'] == 1) {
    /* placer une selection */
    $select = "<select id=\"select_type_msg\" class=\"custom-select custom-select-sm\">".
      "<option value=\"user\" selected>Gestionnaire</option>".
      "<option value=\"admin\">Administrateur</option>".
      "</select>";
  }

  /* recupere le contenu de la page html a afficher */
  $html = file_get_contents(dirname(__FILE__) . '/../template/message.html', true);

  /* creation d'une liste vide */
  $list = "";
  
  /* se connecter a la base de donnees */
  $sgbd = connexion_sgbd();
  /* verifier qu'on est bien connecte a la base */
  if(!empty($sgbd)) {
    /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
    try {
      /* recuperer la liste de message de l'utilisateur dans la base de donnees */
      $res = $sgbd->prepare("SELECT * FROM messages INNER JOIN message_produit ".
      "ON messages.Id_msg = message_produit.Id_msg INNER JOIN produits ".
      "ON produits.id_produit = message_produit.id_produit WHERE id_user=:id_user ORDER BY messages.Id_msg DESC");
      $res->execute([
        ":id_user" => $_SESSION['id_user']
      ]);
      $data = $res->fetchAll(PDO::FETCH_ASSOC);
      /* remplir la liste des messages */
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
      /* sauvegarde le message d'erreur dans le fichier "errors.log" */
      $error_log = new Error_Log();
      $error_log->addError($e);
      echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
    }
  } else {
    echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
  }
  
  /* remplace les informations de base du message sur la page html */
  $remp_box_msg = str_replace("#msg_from#","",str_replace("#msg_date#","",str_replace("#msg_obj#","",$html)));
  /* place la selection et la liste dans la page html */
  /* affiche la page html */
  echo str_replace("#list_msg#",$list,str_replace("#select_msg#", $select, $remp_box_msg));
} else {
  error_msg("401");
}
