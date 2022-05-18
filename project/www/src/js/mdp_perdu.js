/**
 * On valide le formulaire.
 * 
 * @param {event} e evenement du javascript 
 */
function valider(e) {
    // regex pour verifier la validite de l'email */
    let regexTextValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    // recuperer l'adresse email.
    let email = document.getElementById("email").value;
    // verifier que l'adresse email et valide.
    if(regexTextValide.test(email)) {
        // tableau de donnees post a envoyer
        let dataArray = {
            "email" : email
        };
        // envoyer le post a la page d'email perdu.
        fetch_post('./../exec/mdp_perdu_email_exec.php', dataArray).then(function(response) {
            // si la page retourne "true", tout c'est bien passe.
            if(response == "true") {
                // afficher le message dans un modal.
                document.getElementById('modal-msg').innerText = "Vous avez reçu un email, pour modifier le mot de passe.";
                document.getElementById('modalOne').style.display = "block";
                // quand on ferme le modal, on revient a l'index
                document.querySelectorAll(".close").forEach(function (btn) {
                    btn.onclick = function (event) {
                        event.preventDefault();
                        let modal = btn.closest(".modal");
                        modal.style.display = "none";
                        window.opener.location.href = "./../../index.php";
                        window.close();
                    };
                  });
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

/* activer le modal de la page */
modal();