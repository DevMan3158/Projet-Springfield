let color_old = "white";

function load_msg(e) {
    let values = {
        id: e.target.id.split("_")[1]
    };
    document.querySelectorAll('.display_msg').forEach(element => {
        element.style.backgroundColor = "white";
    });
    fetch_post("./src/exec/admin_modif_user_exec.php", values).then(function (response) {
        if (response.split("[#json#]")[0] == "true") {
            let tabUser = JSON.parse(response.split("[#json#]")[1])[0];
            document.getElementById('msg_from').innerHTML = tabUser['Nom']+ " "+ tabUser['Prenom']+ " ("+ tabUser['Email']+ ").";
            document.getElementById('msg_date').innerHTML = tabUser['date']+".";
            document.getElementById('msg_obj').innerHTML = tabUser['Objet']+".";
            document.getElementById('msg_txt').innerHTML = tabUser['Message'];
            e.target.style.backgroundColor = "blue";
            color_old = e.target.style.backgroundColor;
        } else {
            alert(response);
        }
    });
    document.querySelectorAll('.display_msg').forEach(element => {
        element.style.backgroundColor = "white";
    });
}

document.querySelectorAll('.display_msg').forEach(element => {
    element.addEventListener("click", load_msg);
    element.addEventListener("mouseover",function(){
        color_old = element.style.backgroundColor;
        element.style.backgroundColor = "gold";
    });
    element.addEventListener("mouseout",function(){
        element.style.backgroundColor = color_old;
    });
});
