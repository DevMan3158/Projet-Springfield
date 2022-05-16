function valider(e) {
    e.preventDefault();
    let values = {
        email : document.getElementById('email').value,
        code : document.getElementById('code').value,
        login : document.getElementById('login').value,
        password : document.getElementById('password').value,
        password_rep : document.getElementById('password_rep').value
    };
    let regexEmailValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const regexEmail = new RegExp(regexEmailValide);

    let regexTextValide = /^.{3,40}$/;
    const regexText = new RegExp(regexTextValide);

    let regexPassValide = /^.{6,}$/;
    const regexPass = new RegExp(regexPassValide);

    if(!regexEmailValide.test(values.email)) {
        document.getElementById("email").focus();
        document.getElementById("email").select();
        alert("Merci d'entrer un email.");
    } else if(!regexPassValide.test(values.code)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
    } else if (!regexText.test(values.login)) {
        document.getElementById("login").focus();
        document.getElementById("login").select();
        alert("Merci d'entrer un login.");
    } else if (!regexPass.test(values.password)) {
        document.getElementById("password").focus();
        document.getElementById("password").select();
        alert("Merci d'entrer un mot de passe.");
    } else if (!regexPass.test(values.password_rep)) {
        document.getElementById("password_rep").focus();
        document.getElementById("password_rep").select();
        alert("Merci de confirmer le mot de passe.");
    } else if (values.password != values.password_rep) {
        document.getElementById("password").focus();
        document.getElementById("password").select();
        alert("Le mot de passe n'est pas identique, merci de recommencer.");
    } else {
        fetch_post('./src/exec/modif_mdp_exec.php', values).then(function(response) {
            if(response == "true") {
                document.getElementById('email').value = "";
                document.getElementById('code').value = "";
                document.getElementById('login').value = "";
                document.getElementById('password').value = "";
                document.getElementById('password_rep').value = "";
                alert("Le mot de passe a été modifié.");
            } else {
                alert(response);
                console.log(response);
            }
        });
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
            e.target.src = "./src/img/oeil.svg";
            element.type = "text";
        } else {
            e.target.alt = "mot de passe cacher";
            e.target.src = "./src/img/les-yeux-croises.svg";
            element.type = "password";
        }
    });
}

document.querySelectorAll(".passBtt").forEach(element => {
    element.addEventListener("click", passDispNo);
});