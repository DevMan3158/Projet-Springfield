let cellule_old_value = "";
let cellule_old_item = "0";

function modif_user(id_user, id_new, value_old, id_old) {
  let values = {
    id: 0,
    login: "",
    name: "",
    first_name: "",
    email: "",
    admin: 0,
  };
  values.id = parseInt(id_user.split("_")[1], 10);
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
        values.admin = parseInt(element.id.split("_")[4], 10);
      }
    });
  fetch_post("./src/exec/admin_modif_user_exec.php", values).then(function (
    response
  ) {
    if (response != "true") {
      values.id = value_old.split("_")[3];
      values.name = value_old;
      if (values.id == "6") {
        values.name = parseInt(value_old.split("_")[4], 10);
      }
      document.getElementById(id_new).innerHTML = values.name;
      document.getElementById(id_new).id = values.id_old;
      alert(response);
    }
  });
}

function editabled(item) {
  document
    .getElementById("user_tab")
    .querySelectorAll(".tab_input")
    .forEach((element) => {
      if (element.id != item.id) {
        if (cellule_old_item == element.id) {
          let value_old = cellule_old_value;
          let id_old = element.id;
          let modif = element.innerHTML != cellule_old_value;
          cellule_old_value = "";
          cellule_old_item = "0";
          if (modif) {
            modif_user(element.parentNode.id, element.id, value_old, id_old);
          }
        }
        element.contentEditable = false;
      }
    });
  document
    .getElementById("user_tab")
    .querySelectorAll(".tab_select")
    .forEach((element) => {
      if (element.id != item.id) {
        if (cellule_old_item == element.id) {
          element.querySelectorAll("select").forEach((element1) => {
            let value_old = cellule_old_value;
            let id_old = element.id;
            let modif = element1.value != cellule_old_value;
            let value = element1.value;
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
            element1.remove();
            element.id = new_id;
            element.innerText = value_text;
            cellule_old_value = "";
            cellule_old_item = "0";
            if (modif) {
              modif_user(element.parentNode.id, element.id, value_old, id_old);
            }
          });
        }
      }
    });
}

document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    editabled(event);
  }
});

function input_edit(e) {
  editabled(e.target);
  cellule_old_value = e.target.innerText;
  cellule_old_item = e.target.id;
  e.target.contentEditable = true;
}

function select_edit(e) {
  editabled(e.target);
  cellule_old_value = e.target.id.split("_")[4];
  cellule_old_item = e.target.id;
  let disp = '<select class="custom-select" name="admin">';
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
  disp += "</select>";
  e.target.innerHTML = disp;
}

function admin_del(e) {
   let isExecuted = confirm("Attention vous allez supprimer le message. 'Ok' pour continuer.");
   if(isExecuted) {
      let id_td = e.target.parentNode;
      if(e.target.classList.contains('img_del')) {
         id_td = e.target.parentNode.parentNode;
      }
      let values = {
         id: id_td.id.split("_")[1],
      };
      console.log(values.id);
      fetch_post("./src/exec/delete_user_exec.php", values).then(function (response) {
         if(response == "true") {
            id_td.remove();
         } else {
            alert(response);
         }
      });
   }
}

function bt_find(e) {
  e.preventDefault();
  document.getElementById("user_tab").innerHTML = "";
  fetch_form("./src/exec/find_user_exec.php", "form_find").then(function (
    response
  ) {
    if (response.split("[#json#]")[0] == "true") {
      let tabUser = JSON.parse(response.split("[#json#]")[1]);
      let i = 0;
      tabUser.forEach(valueLine => {
         let td = "<tr id=\"admin_"+valueLine['id_user']+"\">";
         td += "<td id=\"td_admin_"+i+"_1\" class=\"td_del\"><img class=\"img_del\" src=\"src/img/poubelle.svg\"></td>";
         td += "<td id=\"td_admin_"+i+"_2\" class=\"tab_input\">"+valueLine['login']+"</td>";
         td += "<td id=\"td_admin_"+i+"_3\" class=\"tab_input\">"+valueLine['nom']+"</td>";
         td += "<td id=\"td_admin_"+i+"_4\" class=\"tab_input\">"+valueLine['prenom']+"</td>";
         td += "<td id=\"td_admin_"+i+"_5\" class=\"tab_input\">"+valueLine['email']+"</td>";
         td += "<td id=\"td_admin_"+i+"_6_"+valueLine['id_admin']+"\" class=\"tab_select\">"+valueLine['nom_admin']+"</td>";
         td += "</tr>";
         document.getElementById("user_tab").innerHTML += td;
         i++;
      });
      activeClick();
    } else {
      alert(response);
    }
  });
}

function activeClick() {
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

   document
   .getElementById("user_tab")
   .querySelectorAll(".td_del")
   .forEach((element) => {
      element.addEventListener("click", admin_del);
   });

   document.getElementById("bt_find").addEventListener("click", bt_find);
}

activeClick();
