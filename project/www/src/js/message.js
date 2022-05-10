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
 * @returns (bool) : true si il est valide.
 */
function validation(e) {
    e.preventDefault();
    let values = {
        name : document.getElementById('name').value,
        first_name : document.getElementById('first_name').value,
        email : document.getElementById('email').value,
        objet : document.getElementById('objet').value,
        user_text : document.getElementById('user_text').value
    };
    let regexEmailValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const regexEmail = new RegExp(regexEmailValide);

    let regexTextValide = /^.{8,}$/;
    const regexText = new RegExp(regexTextValide);

    let regexObjetValide = /^.{3,255}$/;
    const regexObjet = new RegExp(regexObjetValide);
    
    if(!isValidName(values.name)) {
        document.getElementById("name").style.borderBottomColor = "red";
    }
    if(!isValidName(values.first_name)) {
        document.getElementById("first_name").style.borderBottomColor = "red";
    }
    if(!regexEmail.test(values.email)) {
        document.getElementById("email").style.borderBottomColor = "red";
    }
    if(!regexText.test(values.user_text)) {
        document.getElementById("user_text").style.borderBottomColor = "red";
    }
    if(!regexObjet.test(values.objet)) {
        document.getElementById("objet").style.borderBottomColor = "red";
    }

    if(!isValidName(values.name)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
    } else if (!isValidName(values.first_name)) {
        document.getElementById("first_name").focus();
        document.getElementById("first_name").select();
        alert("Merci d'entrer un prénom.");
    } else if (!regexEmail.test(values.email)) {
        document.getElementById("email").focus();
        document.getElementById("email").select();
        alert("Merci d'entrer un email.");
    } else if (!regexObjet.test(values.objet)) {
        document.getElementById("objet").focus();
        document.getElementById("objet").select();
        alert("Merci d'entrer un objet.");
    } else if (!regexText.test(values.user_text)) {
        document.getElementById("user_text").focus();
        document.getElementById("user_text").select();
        alert("Le message n'est pas valide.");
    } else {
        fetch_form('./src/exec/msg_exec.php', 'form_inform').then(function(response) {
            if(response == "true") {
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
 * revenir sur la configuration d'origine du input du texte
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
