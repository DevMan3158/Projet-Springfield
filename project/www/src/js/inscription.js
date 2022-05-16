/**
 * Verificateur de la validiter du formulaire
 * @param {*} e (event) : ecouteur
 * @returns (bool) : true si il est valide.
 */
function validation(e) {
    e.preventDefault();
    let values = {
        name : document.getElementById('name').value,
        first_name : document.getElementById('first_name').value,
        email : document.getElementById('email').value,
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
    
    if(!regexText.test(values.name)) {
        document.getElementById("name").style.borderBottomColor = "red";
    }
    if(!regexText.test(values.first_name)) {
        document.getElementById("first_name").style.borderBottomColor = "red";
    }
    if(!regexText.test(values.login)) {
        document.getElementById("login").style.borderBottomColor = "red";
    }
    if(!regexEmail.test(values.email)) {
        document.getElementById("email").style.borderBottomColor = "red";
    }
    if(!regexPass.test(values.password)) {
        document.getElementById("password").style.borderBottomColor = "red";
    }
    if(!regexPass.test(values.password_rep)) {
        document.getElementById("password_rep").style.borderBottomColor = "red";
    }
    if (!regexPass.test(values.password_rep)) {
        document.getElementById("password").style.borderBottomColor = "red";
        document.getElementById("password_rep").style.borderBottomColor = "red";
    }

    if(!regexText.test(values.name)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
    } else if (!regexText.test(values.first_name)) {
        document.getElementById("first_name").focus();
        document.getElementById("first_name").select();
        alert("Merci d'entrer un prénom.");
    } else if (!regexText.test(values.login)) {
        document.getElementById("login").focus();
        document.getElementById("login").select();
        alert("Merci d'entrer un login.");
    } else if (!regexEmail.test(values.email)) {
        document.getElementById("email").focus();
        document.getElementById("email").select();
        alert("Merci d'entrer un email.");
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
        fetch_form('./src/exec/inscript_exec.php', 'form_inform').then(function(response) {
            if(response == "true") {
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

document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    validation(event);
  }
});