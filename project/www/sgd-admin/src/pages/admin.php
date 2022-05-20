<?php
/**
 * Afficher la page de l'administrateur.
 */

/* inclure des fonctionnalites à la page */
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
include_once dirname(__FILE__) . '/../../../src/class/Error_Log.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/error_msg.php';

/* verifier qu'on as le droit de venir sur cette page */
if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 && $_SESSION['id_admin'] == 1) {

  /* recupere le contenu de la page html a afficher */
  $page = file_get_contents(dirname(__FILE__) . '/../template/admin.html', true);

  /* creation de la table d'utilisateur a afficher */
  $table = "";
  /* se connecter a la base de donnees */
  $sgbd = connexion_sgbd();
  /* verifier qu'on est bien connecte a la base */
  if(!empty($sgbd)) {
    /* se proteger des erreurs de requete sql (pour ne pas afficher l'erreur a l'ecran) */
    try {
      /* on recupere la liste des utilisateurs du site */
      $res = $sgbd->prepare("SELECT * FROM utilisateur LEFT JOIN admin ON utilisateur.id_admin = admin.id_admin WHERE id_user!=:id_user");
      $res->execute([
        ":id_user" => $_SESSION['id_user']
      ]);
      $data = $res->fetchAll(PDO::FETCH_ASSOC);
      /* on creer une variable pour se retrouver dans les lignes du tableau */
      $i = 0;
      foreach ($data as $valueLine) {
        /* on rempli la ligne du tableau avec les donnees de l'utilisateur */
        $table .= "<tr id=\"admin_".$valueLine['id_user']."\">";
        $table .= "<td id=\"td_admin_".$i."_1\" class=\"td_del\"><img class=\"img_del\" src=\"src/img/poubelle.svg\"></td>";
        $table .= "<td id=\"td_admin_".$i."_2\" class=\"tab_input\">".$valueLine['login']."</td>";
        $table .= "<td id=\"td_admin_".$i."_3\" class=\"none-column tab_input\">".$valueLine['nom']."</td>";
        $table .= "<td id=\"td_admin_".$i."_4\" class=\"none-column tab_input\">".$valueLine['prenom']."</td>";
        $table .= "<td id=\"td_admin_".$i."_5\" class=\"none-email tab_input\">".$valueLine['email']."</td>";
        $table .= "<td id=\"td_admin_".$i."_6_".$valueLine['id_admin']."\" class=\"tab_select\">".$valueLine['nom_admin']."</td>";
        $table .= "</tr>";
        /* on augmente i pour l'ajout d'une nouvelle ligne */
        $i++;
      }

      /* creation de la table des niveau de l'utilisateur (admin, gestionnaire, utilisateur, banni). */
      $add_tab_select = "{";
      $res = $sgbd->prepare("SELECT * FROM admin");
      $res->execute();
      $data = $res->fetchAll(PDO::FETCH_ASSOC);
      /* on entre les niveau possible de l'utilisateur dans le tableau */
      foreach ($data as $valueLine) {
        $add_tab_select .= '"'.$valueLine['id_admin'].'" : "'.$valueLine['nom_admin'].'",';
      }
      $add_tab_select .= "}";
      /* on entre se tableau dans la partie javascript du html ("'#add_tab_select#'") */
      /* on entre le tableau utilisateur dans la page html ("#tab_admin#"). */
      echo str_replace("'#add_tab_select#'", $add_tab_select, str_replace("#tab_admin#", $table, $page));
    } catch (PDOException $e) {
      /* sauvegarde le message d'erreur dans le fichier "errors.log" */
      $error_log = new Error_Log();
      $error_log->addError($e);
      echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
    }
  } else {
    echo "Désolé, une erreur c'est produite lors du téléchargement de la page.";
  }
} else {
  error_msg("401");
}
