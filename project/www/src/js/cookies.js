/**
 * 
 * 
 * @param {string} name le nom du coockie
 * @param {*} value la valeur de celui-ci
 * @param {*} days le nombre de jours de validites
 */
function setCookie(name,value,days=0) {
    // recupere la date d'expiration
    let expires = "";
    // si on a un nombre de jour pour l'expiration
    if (days > 0) {
        // creation de la date d'expiration
        let date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    // creation du cookie
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

/**
 * lire un coockie.
 * 
 * @param {string} name le nom du coockie
 * @returns le contenue du coockie
 */
function getCookie(name) {
    /* creation du nom de recuperation de la valeur */
    let nameEQ = name + "=";
    /* coupe le contenu du coockie */
    let ca = document.cookie.split(';');
    /* recherche le nom dans la table cree */
    for(let i=0;i < ca.length;i++) {
        /* recupere chaque donnee */
        let c = ca[i];
        /* retire l'espace du debut du texte */
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        /* recupere la bonne valeur */
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    /* si on n'a pas trouve la valeur */
    return undefined;
}

/**
 * supprimer un coockie.
 * 
 * @param {string} name le nom du coockie
 */
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}