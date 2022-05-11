function load_msg(e) {
    let values = {
        id: e.target.id.split("_")[1]
    };
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




document.getElementById('display_msg').addEventListener("click", load_msg)