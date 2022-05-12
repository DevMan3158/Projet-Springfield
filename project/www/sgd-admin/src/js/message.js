let color_old = "white";
let type_msg = "user";

function load_msg(e) {
    let values = {
        id: e.target.id.split("_")[1]
    };
    document.querySelectorAll('.display_msg').forEach(element => {
        element.style.backgroundColor = "white";
    });
    fetch_post("./src/exec/msg_load_exec.php", values).then(function (response) {
        if (response.split("[#json#]")[0] == "true") {
            let tabUser = JSON.parse(response.split("[#json#]")[1])[0];
            document.getElementById('msg_from').innerHTML = tabUser['Nom']+ " "+ tabUser['Prenom']+ " ("+ tabUser['Email']+ ").";
            document.getElementById('msg_date').innerHTML = tabUser['date']+".";
            document.getElementById('msg_obj').innerHTML = tabUser['Objet']+".";
            document.getElementById('msg_txt').innerHTML = tabUser['Message'];
            document.getElementById('img_msg_'+values.id).src = "./src/img/document.svg";
            if(e.target.classList.contains('display_msg_no_lu')) {
                e.target.classList.remove("display_msg_no_lu");
                e.target.classList.add("display_msg_lu");
            }
            e.target.style.backgroundColor = "#b1e6ff";
            color_old = e.target.style.backgroundColor;
        } else {
            alert(response);
        }
    });
    document.querySelectorAll('.display_msg').forEach(element => {
        element.style.backgroundColor = "white";
    });
}

function bt_find(e) {
    e.preventDefault();
    document.getElementById("list-msg").innerHTML = "";
    fetch_form("./src/exec/msg_find_load.php?type="+type_msg, "form_find").then(function (
      response
    ) {
      if (response.split("[#json#]")[0] == "true") {
        let tabUser = JSON.parse(response.split("[#json#]")[1]);
        let i = 0;
        tabUser.forEach(valueLine => {
            let img_no_lu = "enveloppe.svg";
            let msg_no_lu = "display_msg_no_lu";
            if(valueLine['lu'] == "1") {
                img_no_lu = "document.svg";
                msg_no_lu = "display_msg_lu";
            }
            let line = '<li class="list-group-item display_msg text-left '+
                msg_no_lu+'" id="msg_'+valueLine['Id_msg']+'">';
            line += '<img id="img_msg_'+valueLine['Id_msg']+
                '" src="./src/img/'+img_no_lu+'" /> ';
            line += valueLine['Objet'];
            line += '</li>';
            document.getElementById("list-msg").innerHTML += line;
        });
        msg_create_click();
      } else {
        alert(response);
      }
    });
  }

function msg_create_click() {
    document.querySelectorAll('.display_msg').forEach(element => {
        element.addEventListener("click", load_msg);
        element.addEventListener("mouseover",function(){
            color_old = element.style.backgroundColor;
            element.style.backgroundColor = "#FFF500";
        });
        element.addEventListener("mouseout",function(){
            element.style.backgroundColor = color_old;
        });
    });
}


msg_create_click();

document.getElementById("bt_find").addEventListener("click", bt_find);

document.querySelectorAll('#select_type_msg').forEach(element => {
    element.addEventListener("change", function(e) {
        type_msg = document.getElementById("select_type_msg").value;
        bt_find(e);
    });
});
