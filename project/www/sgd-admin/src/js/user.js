function fetch_form(url, idform) {
    const formData = new FormData(document.getElementById(idform));
    return fetch(url, {
        method: "post",
        body: formData,
    })
    .then((response) => response.text())
    .catch((error) => console.error("Error:", error));
}

function testLoad(e) {
    e.preventDefault();
    fetch_form('./src/exec/add_utilisateurs.php', "form-2").then(function(response) {
        console.log(response);
        document.getElementById('contenu').innerHTML = response.replaceAll("<", "&lt;").replaceAll(">", "&gt;");
    });
}

document.getElementById('btt-form-1').addEventListener('click', testLoad);

/*
Recuperation d'une image pour l'afficher sur le html
event (event) : evenement d'ecoute
*/
function loadFiles(event) {
    // on recupere la liste des fichiers
    let files = event.target.files;
    // Ou visualiser l'image qui sera telecharge
    let preview = document.getElementById("add-img");
    // une boucle sur les fichiers telecharges
    for (var i = 0; i < files.length; i++) {
        // recuperation du fichier
        var file = files[i];
        // le type du fichier
        var imageType = /^image\//;
  
        // verifier qu'on a bien une image, sinon on n'affiche rien.
        if (!imageType.test(file.type)) {
            continue;
        }

        // on vide l'image par defaut et on ajoute le fichier
        preview.src = "";
        preview.file = file;

        // ici on affiche l'image sur la page html (ne surtout pas le supprimer).
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) { 
                aImg.src = e.target.result;
                };
        })(preview);
        reader.readAsDataURL(file);
    }
}

/*
ajouter une image dans le telechargement
*/
function img_add() {
    document.getElementById('file').click();
}

// en cas de changement de fichier (ici d'image)
document.getElementById('file').addEventListener('change', loadFiles);
// quand on clique sur le bouton pour ajouter une image
document.getElementById('add-img').addEventListener('click', img_add);