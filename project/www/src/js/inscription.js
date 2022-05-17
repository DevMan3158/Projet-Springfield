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
    
    /* si le nom n'est pas bon, souligner en rouge */
    if(!regexText.test(values.name)) {
        document.getElementById("name").style.borderBottomColor = "red";
    }
    /* si le prenom n'est pas bon, souligner en rouge */
    if(!regexText.test(values.first_name)) {
        document.getElementById("first_name").style.borderBottomColor = "red";
    }
    /* si le login n'est pas bon, souligner en rouge */
    if(!regexText.test(values.login)) {
        document.getElementById("login").style.borderBottomColor = "red";
    }
    /* si l'email n'est pas bon, souligner en rouge */
    if(!regexEmail.test(values.email)) {
        document.getElementById("email").style.borderBottomColor = "red";
    }
    /* si le mot de passe n'est pas bon, souligner en rouge */
    if(!regexPass.test(values.password)) {
        document.getElementById("password").style.borderBottomColor = "red";
    }
    /* si le mot de passe n'est pas bon, souligner en rouge */
    if(!regexPass.test(values.password_rep)) {
        document.getElementById("password_rep").style.borderBottomColor = "red";
    }
    /* si les mots de passe ne sont pas identiques, souligner en rouge */
    if (!regexPass.test(values.password_rep)) {
        document.getElementById("password").style.borderBottomColor = "red";
        document.getElementById("password_rep").style.borderBottomColor = "red";
    }

    /* si nom n'est pas valide, ce placer dessus */
    if(!regexText.test(values.name)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
    /* si prenom n'est pas valide, ce placer dessus */
    } else if (!regexText.test(values.first_name)) {
        document.getElementById("first_name").focus();
        document.getElementById("first_name").select();
        alert("Merci d'entrer un prénom.");
    /* si login n'est pas valide, ce placer dessus */
    } else if (!regexText.test(values.login)) {
        document.getElementById("login").focus();
        document.getElementById("login").select();
        alert("Merci d'entrer un login.");
    /* si email n'est pas valide, ce placer dessus */
    } else if (!regexEmail.test(values.email)) {
        document.getElementById("email").focus();
        document.getElementById("email").select();
        alert("Merci d'entrer un email.");
    /* si le mot de passe n'est pas valide, ce placer dessus */
    } else if (!regexPass.test(values.password)) {
        document.getElementById("password").focus();
        document.getElementById("password").select();
        alert("Merci d'entrer un mot de passe.");
    /* si le mot de passe n'est pas valide, ce placer dessus */
    } else if (!regexPass.test(values.password_rep)) {
        document.getElementById("password_rep").focus();
        document.getElementById("password_rep").select();
        alert("Merci de confirmer le mot de passe.");
    /* si les mots de passe ne sont pas identiques, ce placer dessus */
    } else if (values.password != values.password_rep) {
        document.getElementById("password").focus();
        document.getElementById("password").select();
        alert("Le mot de passe n'est pas identique, merci de recommencer.");
    /* si on a tout de valide */
    } else {
        /* envoyer les informations de l'inscription sur la page php */
        fetch_form('./src/exec/inscript_exec.php', 'form_inform').then(function(response) {
            /* si tout c'est bien passe */
            if(response == "true") {
                /* vider le contenu de l'inscription sur la page */
                document.getElementById('name').value = "";
                document.getElementById('first_name').value = "";
                document.getElementById('email').value = "";
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

/**
 * revenir sur la configuration d'origine du input du texte
 * @param {*} e (event) : ecouteur
 */
function styleInputForm(e) {
    e.target.style.borderBottomColor = "rgb(223 223 223)";
}

// en cas de changement du texte
document.getElementById("name").addEventListener('input', styleInputForm);
document.getElementById("first_name").addEventListener('input', styleInputForm);
document.getElementById("login").addEventListener('input', styleInputForm);
document.getElementById("email").addEventListener('input', styleInputForm);
document.getElementById("password").addEventListener('input', styleInputForm);
document.getElementById("password_rep").addEventListener('input', styleInputForm);

// quand on clique sur le bouton du formulaire
document.getElementById('button_form').addEventListener('click', validation);

/**
 * function pour afficher ou masquer le mot de passe.
 * 
 * @param {event} e evenement du javascript
 */
 function passDispNo(e) {
    /* recupere sur le noeud parent l'editeur du mot de passe */
    e.target.parentNode.querySelectorAll(".passDisp").forEach(element => {
        /* si le mot de passe est cacher */
        if(element.type == "password") {
            /* le rendre visible */
            e.target.alt = "mot de passe afficher";
            e.target.src = "./src/img/oeil.svg";
            element.type = "text";
        } else {
            /* le cacher */
            e.target.alt = "mot de passe cacher";
            e.target.src = "./src/img/les-yeux-croises.svg";
            element.type = "password";
        }
    });
}

/* Boutton pour rendre visible ou non le mot de passe. */
document.querySelectorAll(".passBtt").forEach(element => {
    element.addEventListener("click", passDispNo);
});

/**
 * Action si on touche le boutton entrer du clavier.
 */
document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    validation(event);
  }
});