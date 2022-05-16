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

                    // Ici on fait la requête pour récuperer le nombre de ligne dans le tableau

                    $requete = $sgbd->query ('SELECT COUNT(id_produit) as countid FROM produits');
                        
                    $nbligne = $requete->fetch();






                    // Ici la requête pour le tableau ADMIN

                    $requeteAdmin = $sgbd->query ('SELECT nom, lieu, id_produit, description FROM produits');

                    $requeteAdmin->execute();

                    $resultat_requeteAdmin = $requeteAdmin->fetchAll((PDO::FETCH_ASSOC));

                    // On affiche le tableau ADMIN

                    if ($_SESSION['id_admin'] == 1) {


                    foreach ($resultat_requeteAdmin as $articleAdmin) {


                        echo   '<tr>
                                    <td>'.($articleAdmin['nom']).'</td>
                                    <td>'.($articleAdmin['lieu']).'</td>
                                    <td>'.($articleAdmin['description']).'</td>
                                    <form action="http://localhost/springfield/project/www/sgd-admin/index.php?ind=produit&id='.($articleAdmin['id_produit']).'">
                                        <td class="col-md-1 edit">
                                            <button type="submit" value="edit" class="tablebutton">
                                                <img src="src/img/icons8-modifier.svg" class="testcolor">
                                            </button>
                                        </td>
                                    </form>
                                    <form action="http://localhost/springfield/project/www/sgd-admin/index.php?ind=produit&id='.($articleAdmin['id_produit']).'">
                                        <td class="col-md-1 delete">
                                            <button type="submit" value="edit" class="tablebutton">
                                                <img src="src/img/poubelle.svg" class="testcolor">
                                            </button>
                                        </td>
                                    </form
                                </tr>';

                    }
                
                    } else {  

                                            // Ici la requête pour le tableau gestionnaire

                    $requeteGestionnaire = $sgbd->prepare ('SELECT nom, lieu, id_produit, description FROM produits WHERE produits.id_user=:id_user');

                    $requeteGestionnaire->execute([":id_user"=>$_SESSION['id_user']]);

                    $resultat_requeteGestionnaire = $requeteGestionnaire->fetchAll((PDO::FETCH_ASSOC));

                        // On affiche le tableau gestionnaire

                        foreach ($resultat_requeteGestionnaire as $articleGestionnaire) {

                            echo   '<tr>
                                        <td>'.($articleGestionnaire['nom']).'</td>
                                        <td>'.($articleGestionnaire['lieu']).'</td>
                                        <td>'.($articleGestionnaire['description']).'</td>
                                        <form action="http://localhost/springfield/project/www/sgd-admin/index.php?ind=produit&id='.($articleGestionnaire['id_produit']).'">
                                            <td class="col-md-1 edit">
                                                <button type="submit" value="edit" class="tablebutton">
                                                    <img src="src/img/icons8-modifier.svg" class="testcolor">
                                                </button>
                                            </td>
                                        </form>
                                        <form action="http://localhost/springfield/project/www/sgd-admin/index.php?ind=produit&id='.($articleGestionnaire['id_produit']).'">
                                            <td class="col-md-1 delete">
                                                <button type="submit" value="edit" class="tablebutton">
                                                    <img src="src/img/poubelle.svg" class="testcolor">
                                                </button>
                                            </td>
                                        </form
                                    </tr>';
    
                        }
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


