<?php

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] == 1) {

  $page = file_get_contents(dirname(__FILE__) . '/../template/admin.html', true);

  $table = "";
  $sgbd = connexion_sgbd();
  $res = $sgbd->prepare("SELECT * FROM utilisateur LEFT JOIN admin ON utilisateur.id_admin = admin.id_admin");
  $res->execute();
  $data = $res->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($data as $valueLine) {
    $table .= "<tr id=\"admin_".$valueLine['id_user']."\">";
    $table .= "<td id=\"td_admin_".$i."_2\"><img class=\"img_mod\" src=\"src/img/poubelle.svg\"></td>";
    $table .= "<td id=\"td_admin_".$i."_3\" class=\"tab_input\">".$valueLine['nom']."</td>";
    $table .= "<td id=\"td_admin_".$i."_4\" class=\"tab_input\">".$valueLine['prenom']."</td>";
    $table .= "<td id=\"td_admin_".$i."_5\" class=\"tab_input\">".$valueLine['email']."</td>";
    $table .= "<td id=\"td_admin_".$i."_6_".$valueLine['id_admin']."\" class=\"tab_select\">".$valueLine['nom_admin']."</td>";
    $table .= "</tr>";
    $i++;
  }

  $add_tab_select = "{";
  $sgbd = connexion_sgbd();
  $res = $sgbd->prepare("SELECT * FROM admin");
  $res->execute();
  $data = $res->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data as $valueLine) {
    $add_tab_select .= '"'.$valueLine['id_admin'].'" : "'.$valueLine['nom_admin'].'",';
  }
  $add_tab_select .= "}";
  echo str_replace("'#add_tab_select#'", $add_tab_select, str_replace("#tab_admin#", $table, $page));

} else {
  echo "Vous n'avez pas le droit d'ouvrir cette page.";
}
