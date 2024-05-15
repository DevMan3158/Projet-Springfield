/* variables de la page */
let cellule_old_value = "";
let cellule_old_item = "0";

/**
 * modifier les informations d'un utilisateur.
 * 
 * @param {string} id_user id de l'utilisateur dans le noeud
 * @param {string} id_new le nouveau id
 * @param {string} value_old l'ancienne valeur
 * @param {string} id_old l'ancien id
 */
function modif_user(id_user, id_new, value_old, id_old) {
  /* une table avec les valeurs par default */
  let values = {
    id: 0,
    login: "",
    name: "",
    first_name: "",
    email: "",
    admin: 0,
  };
  /* recupere l'id utilisateur du noeud */
  values.id = parseInt(id_user.split("_")[1], 10);
  /* recupere les informations dans la table de la page */
  document
    .getElementById(id_user)
    .querySelectorAll("td")
    .forEach((element) => {
      let col = element.id.split("_")[3];
      if (col == "2") {
        values.login = element.innerHTML;
      } else if (col == "3") {
        values.name = element.innerHTML;
      } else if (col == "4") {
        values.first_name = element.innerHTML;
      } else if (col == "5") {
        values.email = element.innerHTML;
      } else if (col == "6") {
        /* recupere la valeur de l'id admin */
        values.admin = parseInt(element.id.split("_")[4], 10);
      }
    });
  /* envoyer les donnees a la page php */
  fetch_post("./src/exec/admin_modif_user_exec.php", values).then(function (
    response
  ) {
    /* en cas d'erreur */
    if (response != "true") {
      /* remettre la valeur d'avant */
      values.id = value_old.split("_")[3];
      values.name = value_old;
      if (values.id == "6") {
        values.name = parseInt(value_old.split("_")[4], 10);
      }
      document.getElementById(id_new).innerHTML = values.name;
      document.getElementById(id_new).id = values.id_old;
      /* afficher l'erreur */
      alert(response);
    }
  });
}

/**
 * rendre les celles non editable.
 * 
 * @param {*} item item du noeud
 */
function editabled(item) {
  /* parcourir les cellules tab_input pour fermer la version editable */
  document
    .getElementById("user_tab")
    .querySelectorAll(".tab_input")
    .forEach((element) => {
      /* si l'element n'est pas identique a l'item */
      if (element.id != item.id) {
        /* verifier que l'element n'est pas identique a la verion cliquer avant le changement */
        if (cellule_old_item == element.id) {
          /* si c'est d'une version cliquer avant */
          /* on recupere les anciennes informations (en cas d'erreur) */
          let value_old = cellule_old_value;
          let id_old = element.id;
          /* verifier qu'on a bien changer les valeurs */
          let modif = element.innerHTML != cellule_old_value;
          /* on vide les informations */
          cellule_old_value = "";
          cellule_old_item = "0";
          /* si on a modifier la valeur */
          if (modif) {
            /* on modifier les valeur dans la base */
            modif_user(element.parentNode.id, element.id, value_old, id_old);
          }
        }
        /* on desactive la cellule */
        element.contentEditable = false;
      }
    });
  /* parcourir les cellules tab_select pour fermer la version de selection */
  document
    .getElementById("user_tab")
    .querySelectorAll(".tab_select")
    .forEach((element) => {
      /* si l'element n'est pas identique a l'item */
      if (element.id != item.id) {
        /* verifier que l'element n'est pas identique a la verion cliquer avant le changement */
        if (cellule_old_item == element.id) {
          /* verifier le contenu des selections */
          element.querySelectorAll("select").forEach((element1) => {
            /* si c'est d'une version cliquer avant */
            /* on recupere les anciennes informations (en cas d'erreur) */
            let value_old = cellule_old_value;
            let id_old = element.id;
            let value = element1.value;
            /* verifier qu'on a bien changer les valeurs */
            let modif = element1.value != cellule_old_value;
            /* creation d'un nouveau id avec l'information sur le niveau de l'utilisateur */
            let value_item = element.id.split("_");
            let new_id =
              value_item[0] +
              "_" +
              value_item[1] +
              "_" +
              value_item[2] +
              "_" +
              value_item[3] +
              "_" +
              value;
            let value_text = optionsAdmin[value];
            /* supprimer le contenu de la cellule */
            element1.remove();
            /* on replace les informations du noeud */
            element.id = new_id;
            element.innerText = value_text;
            /* on vide les informations */
            cellule_old_value = "";
            cellule_old_item = "0";
            /* si on a modifier la valeur */
            if (modif) {
              /* on modifier les valeur dans la base */
              modif_user(element.parentNode.id, element.id, value_old, id_old);
            }
          });
        }
      }
    });
}

/**
 * Action si on touche le bouton entrer du clavier.
 */
document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    editabled(event);
  }
});

/**
 * rendre la cellule editable.
 * 
 * @param {event} e evenement du javascript 
 */
function input_edit(e) {
  /* remetre les cellules sous format non editable */
  editabled(e.target);
  /* recupere les informations de la cellule */
  cellule_old_value = e.target.innerText;
  cellule_old_item = e.target.id;
  /* rends celle-ci editable */
  e.target.contentEditable = true;
}

/**
 * Passer la cellule en selection
 * 
 * @param {event} e evenement du javascript 
 */
function select_edit(e) {
  /* remetre les cellules sous format non editable */
  editabled(e.target);
  /* recupere les informations de la cellule */
  cellule_old_value = e.target.id.split("_")[4];
  cellule_old_item = e.target.id;
  /* creation de la selection a afficher dans la cellule */
  let disp = '<select class="custom-select" name="admin">';
  /* rentre les options */
  Object.keys(optionsAdmin).forEach((key) => {
    let select = "";
    if (cellule_old_value == key) {
      select = " selected";
    }
    disp +=
      '<option value="' +
      key +
      '"' +
      select +
      ">" +
      optionsAdmin[key] +
      "</option>";
  });
  /* fin de la selection */
  disp += "</select>";
  /* l'affiche dans la cellule */
  e.target.innerHTML = disp;
}

/**
 * pour supprimer un utilisateur.
 * 
 * @param {event} e evenement du javascript 
 */
function admin_del(e) {
  /* message de confirmation */
   let isExecuted = confirm("Attention vous allez supprimer l'utilisateur. 'Ok' pour continuer.");
   /* si on confirme la suppression */
   if(isExecuted) {
      /* recupere l'id du parent */
      let id_td = e.target.parentNode;
      /* verifier qu'on n'a pas cliquer sur l'image */
      if(e.target.classList.contains('img_del')) {
        /* sinon changer l'id */
         id_td = e.target.parentNode.parentNode;
      }
      // tableau de donnees post a envoyer
      /* recupere l'id de l'utilisation sur l'id de la ligne */
      let values = {
         id: id_td.id.split("_")[1],
      };
      /* envoyer les informations du formulaire dans la page php. */
      fetch_post("./src/exec/delete_user_exec.php", values).then(function (response) {
        // si c'est bon
         if(response == "true") {
           // supprimer la ligne de l'utilisateur.
            id_td.remove();
         } else {
            alert(response);
         }
      });
   }
}

/**
 * pour rechercher un utilisateur.
 * 
 * @param {event} e evenement du javascript 
 */
function bt_find(e) {
  // pour ne pas prendre l'adresse de l'action du formulaire.
  e.preventDefault();
  // vide la table de la page html
  document.getElementById("user_tab").innerHTML = "";
  /* envoyer le formulaire de recherche sur la page php */
  fetch_form("./src/exec/find_user_exec.php", "form_find").then(function (
    response
  ) {
    // verifier que tout c'est bien passe
    if (response.split("[#json#]")[0] == "true") {
      // recuperer le tableau de la base
      let tabUser = JSON.parse(response.split("[#json#]")[1]);
      /* on creer une variable pour se retrouver dans les lignes du tableau */
      let i = 0;
      tabUser.forEach(valueLine => {
        /* on rempli la ligne du tableau avec les donnees de l'utilisateur */
         let td = "<tr id=\"admin_"+valueLine['id_user']+"\">";
         td += "<td id=\"td_admin_"+i+"_1\" class=\"td_del\"><img class=\"img_del\" src=\"src/img/poubelle.svg\"></td>";
         td += "<td id=\"td_admin_"+i+"_2\" class=\"tab_input\">"+valueLine['login']+"</td>";
         td += "<td id=\"td_admin_"+i+"_3\" class=\"none-column tab_input\">"+valueLine['nom']+"</td>";
         td += "<td id=\"td_admin_"+i+"_4\" class=\"none-column tab_input\">"+valueLine['prenom']+"</td>";
         td += "<td id=\"td_admin_"+i+"_5\" class=\"none-email tab_input\">"+valueLine['email']+"</td>";
         td += "<td id=\"td_admin_"+i+"_6_"+valueLine['id_admin']+"\" class=\"tab_select\">"+valueLine['nom_admin']+"</td>";
         td += "</tr>";
         /* on affiche la ligne du tableau html */
         document.getElementById("user_tab").innerHTML += td;
         /* on augmente i pour l'ajout d'une nouvelle ligne */
         i++;
      });
      /* on rends a nouveau le tableau et ces boutons cliquables */
      activeClick();
    } else {
      alert(response);
    }
  });
}

/**
 * activer les boutons de la page
 */
function activeClick() {
  /* activer le changement de format des cellules */
   document
   .getElementById("user_tab")
   .querySelectorAll(".tab_input")
   .forEach((element) => {
      element.addEventListener("dblclick", input_edit);
   });

   document
   .getElementById("user_tab")
   .querySelectorAll(".tab_select")
   .forEach((element) => {
      element.addEventListener("dblclick", select_edit);
   });

   /* activer le bouton de suppression */
   document
   .getElementById("user_tab")
   .querySelectorAll(".td_del")
   .forEach((element) => {
      element.addEventListener("click", admin_del);
   });
}

/* quand on clique sur le bouton recherche */
document.getElementById("bt_find").addEventListener("click", bt_find);

/* activer les cellules de la table, pour changer la valeur quand on clique dessus */
activeClick();
