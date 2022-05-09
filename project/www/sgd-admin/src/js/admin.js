let cellule_old_value = '';
let cellule_old_item = "0";

function modif_user(id_user) {
}

function editabled(item) {
   document.getElementById('user_tab').querySelectorAll(".tab_input").forEach(element => {
      if(element.id != item.id) {
         if(cellule_old_item == element.id) {
            let modif = element.innerHTML != cellule_old_value;
            cellule_old_value = '';
            cellule_old_item = "0";
            if(modif) {
               modif_user(element.parentNode.id);
            }
         }
         element.contentEditable = false;
      }
   });
   document.getElementById('user_tab').querySelectorAll(".tab_select").forEach(element => {
      if(element.id != item.id) {
         if(cellule_old_item == element.id) {
            element.querySelectorAll("select").forEach(element1 => {
               let modif = element1.value != cellule_old_value;
               let value = element1.value;
               let value_item = item.id.split("_");
               let new_id = value_item[0]+"_"+value_item[1]+"_"+value_item[2]+"_"+value_item[3]+"_"+value;
               let value_text = optionsAdmin[value];
               element1.remove();
               element.id = new_id;
               element.innerText = value_text;
               cellule_old_value = '';
               cellule_old_item = "0";
               if(modif) {
                  modif_user(element.parentNode.id);
               }
            });
         }
      }
   });
}

document.body.addEventListener('keydown', (event) => {
   if(event.key == 'Enter'){
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
      Object.keys(optionsAdmin).forEach(key => {
         let select = "";
         if(cellule_old_value == key) {
            select = " selected";
         }
         disp += '<option value="'+key+'"'+select+'>'+optionsAdmin[key]+'</option>';
      });
      disp += '</select>';
      e.target.innerHTML = disp;
}

function admin_del(e) {
}

function admin_modif(e) {
}

document.getElementById('user_tab').querySelectorAll(".tab_input").forEach(element => {
   element.addEventListener('click', input_edit);
});

document.getElementById('user_tab').querySelectorAll(".tab_select").forEach(element => {
   element.addEventListener('click', select_edit);
});

document.getElementById('user_tab').querySelectorAll(".img_del").forEach(element => {
   element.addEventListener('click', admin_del);
});

document.getElementById('user_tab').querySelectorAll(".img_mod").forEach(element => {
   element.addEventListener('click', admin_modif);
});

