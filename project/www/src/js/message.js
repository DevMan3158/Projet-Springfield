/**
 * Verifier la validite du texte
 * @param {*} myval (string) : le texte a verifier
 * @returns (bool) : la validite du texte
 */
 function isValidName(myval) {
    let validCharactersRegex = /^.{3,40}$/;
 
    return (new RegExp(validCharactersRegex)).test(myval.trim());
}

/**
 * Verificateur de la validiter du formulaire
 * @param {*} e (event) : ecouteur
 */
function validation(e) {
    // pour ne pas prendre l'adresse de l'action du formulaire.
    e.preventDefault();
    // tableau de donnees post a envoyer
    let values = {
        name : document.getElementById('name').value,
        first_name : document.getElementById('first_name').value,
        email : document.getElementById('email').value,
        objet : document.getElementById('objet').value,
        user_text : document.getElementById('user_text').value
    };
    // regex pour verifier la validiter de l'email.
    let regexEmailValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const regexEmail = new RegExp(regexEmailValide);

    // regex pour verifier la validiter un texte a envoyer.
    let regexTextValide = /^.{8,}$/;
    const regexText = new RegExp(regexTextValide);

    // regex pour verifier la validiter de l'objet.
    let regexObjetValide = /^.{3,255}$/;
    const regexObjet = new RegExp(regexObjetValide);
    
    /* si le nom n'est pas bon, souligner en rouge */
    if(!isValidName(values.name)) {
        document.getElementById("name").style.borderBottomColor = "red";
    }
    /* si le prenom n'est pas bon, souligner en rouge */
    if(!isValidName(values.first_name)) {
        document.getElementById("first_name").style.borderBottomColor = "red";
    }
    /* si le email n'est pas bon, souligner en rouge */
    if(!regexEmail.test(values.email)) {
        document.getElementById("email").style.borderBottomColor = "red";
    }
    /* si le texte n'est pas bon, souligner en rouge */
    if(!regexText.test(values.user_text.replaceAll("\n", ""))) {
        document.getElementById("user_text").style.borderBottomColor = "red";
    }
    /* si l'objet n'est pas bon, souligner en rouge */
    if(!regexObjet.test(values.objet)) {
        document.getElementById("objet").style.borderBottomColor = "red";
    }

    /* si nom n'est pas valide, ce placer dessus */
    if(!isValidName(values.name)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
    /* si prenom n'est pas valide, ce placer dessus */
    } else if (!isValidName(values.first_name)) {
        document.getElementById("first_name").focus();
        document.getElementById("first_name").select();
        alert("Merci d'entrer un prénom.");
    /* si email n'est pas valide, ce placer dessus */
    } else if (!regexEmail.test(values.email)) {
        document.getElementById("email").focus();
        document.getElementById("email").select();
        alert("Merci d'entrer un email.");
    /* si objet n'est pas valide, ce placer dessus */
    } else if (!regexObjet.test(values.objet)) {
        document.getElementById("objet").focus();
        document.getElementById("objet").select();
        alert("Merci d'entrer un objet.");
    /* si le texte n'est pas valide, ce placer dessus */
    } else if (!regexText.test(values.user_text.replaceAll("\n", ""))) {
        document.getElementById("user_text").focus();
        document.getElementById("user_text").select();
        alert("Le message n'est pas valide.");
    /* si on a tout de valide */
    } else {
        /* envoyer les informations du message sur la page php */
        fetch_form('./src/exec/msg_exec.php', 'form_inform').then(function(response) {
            /* si tout c'est bien passe */
            if(response == "true") {
                /* vider le contenu du message sur la page */
                document.getElementById('name').value = "";
                document.getElementById('first_name').value = "";
                document.getElementById('email').value = "";
                document.getElementById('objet').value = "";
                document.getElementById('user_text').value = "";
                alert("Le message a été transmis, nous vous répondrons dans les plus brefs délais.");
            } else {
                alert(response);
            }
        });
    }

}

/**
 * Action si on touche le bouton entrer du clavier.
 */
document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    validation(event);
  }
});

/**
 * revenir sur la configuration d'origine du input du texte
 * 
 * @param {*} e (event) : ecouteur
 */
function styleInputForm(e) {
    e.target.style.borderBottomColor = "rgb(223 223 223)";
}

// en cas de changement du texte
document.getElementById("name").addEventListener('input', styleInputForm);
document.getElementById("first_name").addEventListener('input', styleInputForm);
document.getElementById("email").addEventListener('input', styleInputForm);
document.getElementById("objet").addEventListener('input', styleInputForm);
document.getElementById("user_text").addEventListener('input', styleInputForm);

// quand on clique sur le bouton du formulaire
document.getElementById('button_form').addEventListener('click', validation);
