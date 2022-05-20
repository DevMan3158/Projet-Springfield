/* variables de la page */
let start_img = "./src/";

/**
 * Changer l'emplacement du dossier img avec l'image d'affichage du mot de passe.
 * 
 * @param {string} src l'emplacement du dossier img avec l'image d'affichage du mot de passe.
 */
function src_img(src) {
    start_img = src;
}

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
            e.target.src = start_img+"img/oeil.svg";
            element.type = "text";
        } else {
            /* le cacher */
            e.target.alt = "mot de passe cacher";
            e.target.src = start_img+"img/les-yeux-croises.svg";
            element.type = "password";
        }
    });
}

/* bouton pour rendre visible ou non le mot de passe. */
document.querySelectorAll(".passBtt").forEach(element => {
    element.addEventListener("click", passDispNo);
});
