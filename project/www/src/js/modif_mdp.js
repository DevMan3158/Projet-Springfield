/**
 * On valide le formulaire.
 * 
 * @param {event} e evenement du javascript 
 */
function valider(e) {
    // pour ne pas prendre l'adresse de l'action du formulaire.
    e.preventDefault();
    // tableau de donnees post a envoyer
    let values = {
        email : document.getElementById('email').value,
        code : document.getElementById('code').value,
        login : document.getElementById('login').value,
        password : document.getElementById('password').value,
        password_rep : document.getElementById('password_rep').value
    };
    // regex pour verifier la validiter de l'email.
    let regexEmailValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const regexEmail = new RegExp(regexEmailValide);

    // regex pour verifier la validiter des autres informations.
    let regexTextValide = /^.{3,40}$/;
    const regexText = new RegExp(regexTextValide);

    // regex pour verifier la validiter du mot de passe.
    let regexPassValide = /^.{6,}$/;
    const regexPass = new RegExp(regexPassValide);

    // verifier la validitee l'email
    if(!regexEmailValide.test(values.email)) {
        document.getElementById("email").focus();
        document.getElementById("email").select();
        alert("Merci d'entrer un email.");
    // verifier la validitee du nom
    } else if(!regexPassValide.test(values.code)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
    // verifier la validitee du login
    } else if (!regexText.test(values.login)) {
        document.getElementById("login").focus();
        document.getElementById("login").select();
        alert("Merci d'entrer un login.");
    // verifier la validitee du mot de passe
    } else if (!regexPass.test(values.password)) {
        document.getElementById("password").focus();
        document.getElementById("password").select();
        alert("Merci d'entrer un mot de passe.");
    // verifier la validitee du mot de passe
    } else if (!regexPass.test(values.password_rep)) {
        document.getElementById("password_rep").focus();
        document.getElementById("password_rep").select();
        alert("Merci de confirmer le mot de passe.");
    // verifier qu'on a un mot de passe identique
    } else if (values.password != values.password_rep) {
        document.getElementById("password").focus();
        document.getElementById("password").select();
        alert("Le mot de passe n'est pas identique, merci de recommencer.");
    } else {
        /* envoyer les informations du formulaire dans la page php. */
        fetch_post('./src/exec/modif_mdp_exec.php', values).then(function(response) {
            /* si tout c'est bien passe */
            if(response == "true") {
                /* on vide tout avant d'afficher le message */
                document.getElementById('email').value = "";
                document.getElementById('code').value = "";
                document.getElementById('login').value = "";
                document.getElementById('password').value = "";
                document.getElementById('password_rep').value = "";
                alert("Le mot de passe a été modifié.");
            } else {
                /* sinon, afficher le message d'erreur */
                alert(response);
            }
        });
    }
}

/**
 * On ferme la fenetre.
 * 
 * @param {event} e evenement du javascript 
 */
function annuler(e) {
    window.close();
}

/**
 * Action si on touche le bouton entrer du clavier.
 */
document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    valider(event);
  }
});

/* action sur le bouton valider ou annuler */
document.getElementById("valider").addEventListener("click", valider);
document.getElementById("annuler").addEventListener("click", annuler);
