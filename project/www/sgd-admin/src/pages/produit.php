<link rel="stylesheet" href="../src/bbcode_editeur/style-bbcode.css" />
<h1 class="text-center">Produits</h1>


    <form class="row text-center " action="./src/exec/add_produits.php" method="post" enctype="multipart/form-data" >

            <div class="col-md-12 text-center form-group">
                <input  type="file" id="file" name="file[]"  accept="image/png, image/jpeg, image/webp" multiple/>
                <img id="add-img" src="src/img/icons8-ajouter-une-image-90.png" alt="ajouter une image" />
            </div>

            <div class="col-md-12 text-center form-group">
                    <label for="nom">Nom :</label>
                    <input class="form-control" type="text" name="nom" text_area="Nom" placeholder="Hommer">

            </div> 

            <div class="col-md-12 form-group">

            <label for="catégorie">Choisisez une catégorie :</label>
            <select class="form-control" name="catégorie" id="cat-select">
                <option value="1">Lieux
                </option>
                <option value="2">Personnages</option>
                <option value="3">Batiments</option>
            </select>

            </div>

            <div class="col-md-12 text-center form-group">
                   <label for="lieu">Localisation :</label>
                   <input class="form-control" type="text" name="lieu" text_area="Lieu" placeholder="742 Evergreen Terrace">
            </div>

            <div class="col-md-12 text-center form-group">
                    <label for="description">Description :</label>            
                    <figure class="bbcode">
                    <button class="bbcode_bold">B</button><button class="bbcode_title">title</button><button class="bbcode_type">&lt;&gt;</button>
                    <textarea name="story" class="editor_bbcode form-control" readonly></textarea>
                </figure>
            </div>

            <button class="col-md-12 boutton form-control" type="sumit">Valider</button>

    </form>



<div class="container">
        <h1>Les produits</h1>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Lieu</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>



                <?php

                    include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
                    $sgbd= connexion_sgbd();

                    $requete = $sgbd->query ('SELECT COUNT(id_produit) as countid FROM produits');
                        
                    $nbligne = $requete->fetch();

                    for($i=0; $i<$nbligne['countid']; $i++) {
                    
                        echo '<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="col-md-1 edit">
                                    <button class="tablebutton">
                                        <img src="src/img/icons8-modifier.svg" class="testcolor">
                                    </button>
                                </td>
                                <td class="col-md-1 delete">
                                    <button class="tablebutton">
                                        <img src="src/img/poubelle.svg" class="testcolor">
                                    </button>
                                </td>
                            </tr>';
    
                        }

                ?>
                
            </tbody>
        </table>




<script src="./addImg.js"></script>

<script>

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


</script>


<script src="../src/bbcode_editeur/bbcode.js"></script>


