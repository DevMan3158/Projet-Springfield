/**
 * On valide le formulaire.
 * 
 * @param {event} e evenement du javascript 
 */
function valider(e) {
    // les regex de validation
    let regexTextValide = /^.{3,}$/;
    let login = document.getElementById("login").value;
    let password_user = document.getElementById("password_user").value;
    // verifier la validite des valeurs
    if(regexTextValide.test(login) && regexTextValide.test(password_user)) {
        // tableau de donnees post a envoyer
        let dataArray = {
            "login" : login,
            "password_user" : password_user
        };
        /* envoyer les informations du formulaire dans la page php. */
        fetch_post('./../exec/connexion_exec.php', dataArray).then(function(response) {
            /* si tout c'est bien passe */
            if(response == "true") {
                /* retourne a l'index et ferme la fenetre */
                window.opener.location.href = "./../../sgd-admin/index.php";
                window.close();
            } else {
                // afficher le message dans un modal.
                document.getElementById('modal-msg').innerText = response;
                document.getElementById('modalOne').style.display = "block";
            }
        });
    } else {
        // afficher le message dans un modal.
        document.getElementById('modal-msg').innerText = "Les informations sont vides, vous ne pouvez pas vous connecter.";
        document.getElementById('modalOne').style.display = "block";
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

// si on clique sur le lien du mot de passe perdu.
document.getElementById("pass_perdu").addEventListener("click", function(e) {
    window.location.href = e.target.href;
});

/* changement de l'emplacement des images pour l'affichage du mot de passe */
src_img("./../");

/* activer le modal */
modal();
