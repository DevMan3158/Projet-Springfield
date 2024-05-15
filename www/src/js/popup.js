/**
 * Pour affchier une nouvelle fenetre sous format popup.
 * @param {string} url le lien de la page
 * @param {string} windowName le nom de la fenetre
 * @param {window} win le window de la page (javascript : window)
 * @param {integer} w la largeur de la fenetre.
 * @param {integer} h la hauteur de la fenetre.
 * @returns retourne la fenetre a afficher.
 */
function popupWindow(url, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

/**
 * Pour affchier une nouvelle fenetre sous format popup.
 * @param {string} html le contenu html a afficher
 * @param {string} windowName le nom de la fenetre
 * @param {window} win le window de la page (javascript : window)
 * @param {integer} w la largeur de la fenetre.
 * @param {integer} h la hauteur de la fenetre.
 * @returns retourne la fenetre a afficher.
 */
function popupHTMLWindow(html, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    var myWindow = win.open('', windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, titlebar=no, location=no, width=${w}, height=${h}, top=${y}, left=${x}`);
    myWindow.document.write(html);
}

/**
 * creation d'un modal a afficher.
 */
function modal() {
  /* recherche la classe button dans la page et lui placer un clique */
    document.querySelectorAll(".button").forEach(function (btn) {
      /* action clique */
      btn.onclick = function (event) {
        /* pour eviter l'action d'un formulaire */
        event.preventDefault();
        /* recupere le nom de la modal */
        let modal = btn.getAttribute("data-modal");
        /* s'il est definit */
        if(modal != undefined) {
          /* on l'affiche */
          document.getElementById(modal).style.display = "block";
        }
      };
    });
    /* recherche la classe close dans la page et lui placer un clique */
    document.querySelectorAll(".close").forEach(function (btn) {
      /* action clique */
      btn.onclick = function (event) {
        /* pour eviter l'action d'un formulaire */
        event.preventDefault();
        /* recupere lemodal a fermer */
        let modal = btn.closest(".modal");
        /* le cache */
        modal.style.display = "none";
      };
    });
    /* action clique de la fenetre */
    /*window.onclick = function (event) {
      // pour eviter l'action d'un formulaire
      event.preventDefault();
      // verifier que c'est un modal
      if (event.target.className === "modal") {
        // on le ferme 
        event.target.style.display = "none";
      }
    };*/
}

/* faire un clique sur un modal */
/* il n'est pas utilise */
function clickModal(nameModal) {
  /* creation d'un bouton temporaire pour faire le clique */
    var btn = document.createElement("BUTTON");
    btn.classList.add("button");
    btn.setAttribute("data-modal", nameModal);
    /* on active le clique sur se bouton */
    modal();
    /* on clique le bouton */
    btn.click();
}