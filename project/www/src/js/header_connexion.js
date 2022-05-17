/**
 * Active l'ouverture de la fenetre de connexion
 * 
 * @param {*} e (event) : ecouteur
 */
function header_connexion(e) {
    /* le debut du lien par defaut */
    let startLink = "./src/";
    /* recupere le lien de la page */
    var hostname_origin = document.location.href;
    /* verifier si on est dans une page admin */
    if (hostname_origin.search("sgd-admin") != -1) {
        /* changer le lien de depart de la page */
        startLink = "./../src/";
    }
    /* afficher la page de connexion */
    popupWindow(startLink+"pages/connexion.php", "connexion", window, 320, 360);
}

/* verifier l'existance du boutton de connexion sur la page  */
if(document.getElementById('btt_conn')) {
    /* active le clique du boutton de connexion */
    document.getElementById('btt_conn').addEventListener("click", header_connexion);
}