/**
 * Recuperer le contenu d'un fichier texte sur le serveur.
 * 
 * @param {string} url le lien du fichier texte
 * @returns fetch ajax
 */
function fetch_txt(url) {
    return fetch(url)
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

/**
 * Recuperer le contenu d'un fichier html sur le serveur.
 * 
 * @param {string} url le lien du fichier html
 * @returns fetch ajax
 */
function fetch_html(url) {
    return fetch(url)
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

/**
 * Execute un fichier php et recuperer le html retourne.
 * 
 * @param {string} url le lien du fichier php
 * @returns fetch ajax
 */
function fetch_php(url) {
    return fetch(url)
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

/**
 * Placer un tableau de donnee en une ligne de texte.
 * 
 * @param {array} data donner a envoyer sous format de tableau.
 * @returns String avec les valeurs a envoyer sous format de texte.
 */
function data(data) {
    let text = "";
    for (var key in data) {
      text += key + "=" + data[key] + "&";
    }
    return text.trim("&");
}

/**
 * Executer la page php avec des donnees de post.
 * 
 * @param {string} url le lien du fichier php qui va executer les post.
 * @param {array} dataArray tableau de donnees avec les post a transmettre.
 * @returns ajax fetch apres execution de la page php
 */
function fetch_post(url, dataArray) {
    let dataObject = this.data(dataArray);
    return fetch(url, {
             method: "post",
             headers: {
                   "Content-Type": "application/x-www-form-urlencoded",
             },
             body: dataObject,
        })
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

/**
 * Executer la page php avec des donnees de get.
 * 
 * @param {string} url le lien du fichier php qui va executer les get.
 * @param {array} dataArray tableau de donnees avec les get a transmettre.
 * @returns ajax fetch apres execution de la page php
 */
function fetch_get(url, dataArray) {
    let dataObject = this.data(dataArray);
    return fetch(url, {
             method: "get",
             headers: {
                   "Content-Type": "application/x-www-form-urlencoded",
             },
             body: dataObject,
        })
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

/**
 * Executer la page php avec un formulaire.
 * 
 * @param {string} url le lien du fichier php qui va executer le formulaire.
 * @param {string} idform id du formulaire dans le html.
 * @returns ajax fetch apres execution de la page php
 */
function fetch_form(url, idform) {
    const formData = new FormData(document.getElementById(idform));
    return fetch(url, {
        method: "post",
        body: formData,
    })
    .then((response) => response.text())
    .catch((error) => console.error("Error:", error));
}

