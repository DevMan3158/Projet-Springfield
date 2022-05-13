function valider(e) {
    e.preventDefault();
    let values = {
        code : document.getElementById('code').value,
        login : document.getElementById('login').value,
        password : document.getElementById('password').value,
        password_rep : document.getElementById('password_rep').value
    };

    let regexTextValide = /^.{3,40}$/;
    const regexText = new RegExp(regexTextValide);

    let regexPassValide = /^.{6,}$/;
    const regexPass = new RegExp(regexPassValide);

    if(!regexPassValide.test(values.code)) {
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
        fetch_post('./../exec/modif_mdp_exec.php', values).then(function(response) {
            if(response == "true") {
                document.getElementById('code').value = "";
                document.getElementById('login').value = "";
                document.getElementById('password').value = "";
                document.getElementById('password_rep').value = "";
                alert("Merci de votre inscription.");
            } else {
                alert(response);
            }
        });
    }
}

function annuler(e) {
    window.close();
}

function pass_perdu(e) {

}

document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    valider(event);
  }
});

document.getElementById("valider").addEventListener("click", valider);
document.getElementById("annuler").addEventListener("click", annuler);
document.getElementById("pass_perdu").addEventListener("click", pass_perdu);