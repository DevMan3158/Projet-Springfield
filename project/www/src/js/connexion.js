function valider(e) {
    let regexTextValide = /^.{3,}$/;
    let login = document.getElementById("login").value;
    let password_user = document.getElementById("password_user").value;
    if(regexTextValide.test(login) && regexTextValide.test(password_user)) {
        let dataArray = {
            "login" : login,
            "password_user" : password_user
        };
        fetch_post('./../exec/connexion_exec.php', dataArray).then(function(response) {
            if(response == "true") {
                window.opener.location.href = "./../../sgd-admin/index.php";
                window.close();
            } else {
                popupHTMLWindow('<div>'+response+'</div>', "connexion", window, 320, 320);
                //alert(response);
            }
        });
    } else {
        console.log("Les informations sont vides, vous ne pouvez pas vous connecter.");
    }
}

function annuler(e) {
    window.close();
}

document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    valider(event);
  }
});

document.getElementById("valider").addEventListener("click", valider);
document.getElementById("annuler").addEventListener("click", annuler);

function passDispNo(e) {
    e.target.parentNode.querySelectorAll(".passDisp").forEach(element => {
        if(element.type == "password") {
            e.target.alt = "mot de passe afficher";
            e.target.src = "./../img/oeil.svg";
            element.type = "text";
        } else {
            e.target.alt = "mot de passe cacher";
            e.target.src = "./../img/les-yeux-croises.svg";
            element.type = "password";
        }
    });
}

document.querySelectorAll(".passBtt").forEach(element => {
    element.addEventListener("click", passDispNo);
});
