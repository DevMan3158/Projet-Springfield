let color_old = "white";
let type_msg = "user";

function display_date(date) {
    var ladate=new Date(Date.parse(date))
    return ladate.getDate()+"/"+(ladate.getMonth()+1)+"/"+ladate.getFullYear()+" à "+ladate.getHours()+"H"+ladate.getMinutes();
}

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
                document.querySelectorAll('.img_del_msg').forEach(element => {
                    element.id = "img_del_msg_"+values.id;
                });
                document.getElementById('msg_from').innerHTML = tabUser['Nom']+ " "+ tabUser['Prenom']+ " ("+ tabUser['Email']+ ").";
                document.getElementById('msg_date').innerHTML = display_date(tabUser['date'])+".";
                document.getElementById('msg_obj').innerHTML = tabUser['Objet']+".";
                document.getElementById('msg_txt').innerHTML = tabUser['Message'];
                document.getElementById('img_msg_'+values.id).src = "./src/img/document.svg";
                document.getElementById('txt_mobile').checked = true;
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

function init_values(e) {
    document.getElementById('msg_from').innerHTML = "";
    document.getElementById('msg_date').innerHTML = "";
    document.getElementById('msg_obj').innerHTML = "";
    document.getElementById('msg_txt').innerHTML = "";
    document.getElementById('recherche').value = "";
    document.querySelectorAll('.img_del_msg').forEach(element => {
        element.id = "img_del_msg";
    });
    document.getElementById('txt_mobile').checked = false;
}

function delete_msg(e) {
    let isExecuted = confirm("Attention vous allez supprimer le message. 'Ok' pour continuer.");
    if(isExecuted) {
        let values = {
            id_msg: e.target.id.split("_")[3],
        };
        fetch_post("./src/exec/msg_delete_exec.php", values).then(function (response) {
            if(response == "true") {
                document.getElementById('msg_'+values.id_msg).remove();
                init_values(e);
            } else {
                alert(response);
            }
        });
    }
    //init_values(e);
}

msg_create_click();

document.getElementById("bt_find").addEventListener("click", bt_find);

document.getElementById("return-list").addEventListener("click", function(e) {
    document.getElementById('txt_mobile').checked = false;
});

document.querySelectorAll('.img_del_msg').forEach(element => {
    element.addEventListener("click", delete_msg);
});

document.querySelectorAll('#select_type_msg').forEach(element => {
    element.addEventListener("change", function(e) {
        init_values(e);
        type_msg = document.getElementById("select_type_msg").value;
        bt_find(e);
    });
});
