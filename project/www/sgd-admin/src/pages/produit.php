<link rel="stylesheet" href="../src/bbcode_editeur/style-bbcode.css" />
<h1 class="text-center">Produits</h1>

<?php
                    include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
                    $sgbd= connexion_sgbd();

// On créer une variable qui saura si on est sur une édition de produit ou sur l'index

    $_GET['ind'] = 'produit';
    $editOrAdd="add_produits.php";
if (!empty($_GET['id_edit'])){
    $editOrAdd="edit_produits.php?id_edit=".$_GET['id_edit'];
}

// On créer un tableau pour regrouper les données 


$editInfo = array(
    'nom' => "",
    'cat' => "",
    'lieu' => "",
    'desc' => ""
);

if (!empty($_GET['id_edit'])) {

    // on fait la requete pour modifier les éléments

    $requeteEdit = $sgbd->prepare('SELECT produits.nom AS nom, produits.lieu, produits.description, categorie.nom AS cat, photos.src, photos.alt
    FROM produits INNER JOIN springfield.categorie ON produits.id_cat = categorie.id_cat 
    INNER JOIN springfield.photos ON photos.id_produit = produits.id_produit  WHERE produits.id_produit=:id_produit');
    $requeteEdit->execute([":id_produit"=>$_GET["id_edit"]]);
    $resultat_requeteEdit = $requeteEdit->fetch((PDO::FETCH_ASSOC));

    $editInfo = array(
        
        'nom' => $resultat_requeteEdit['nom'],
        'cat' => $resultat_requeteEdit['cat'],
        'lieu' => $resultat_requeteEdit['lieu'],
        'desc' => $resultat_requeteEdit['description'],
        'src' => $resultat_requeteEdit['src'],
        'alt' => $resultat_requeteEdit['alt']


    );

    }

                // ici on echo le formulaire, on utilise editOrAdd sur l'affiction, elle nous enverra sur la bonne page de réception des données.
echo' 

    <form class="row text-center " action="./src/exec/'.($editOrAdd).'" method="post" enctype="multipart/form-data" >

            <div class="col-md-12 text-center form-group">
                <input  type="file" id="file" name="file"  accept="image/png, image/jpeg, image/webp"/>';
                // ici on dit que s'il y a une photo, alors on remplace la photo par celle qu'on veux éditer
            if(!empty($resultat_requeteEdit['src'])) {
                echo '<img id="add-img" src="../data/img/'.($resultat_requeteEdit['src']).'" alt="'.($resultat_requeteEdit['alt']).'" />
                </div>';
            } else { // Sinon, on ajoute la photo de base ( upload image )
                echo '<img id="add-img" src="src/img/icons8-ajouter-une-image-90.png" />
                </div>';
            }
            echo '<div class="col-md-12 text-center form-group">
                    <label for="nom">Nom :</label>
                    <input class="form-control" type="text" name="nom" text_area="Nom" placeholder="Hommer" value="'.($editInfo['nom']).'">

            </div> 

            <div class="col-md-12 form-group">

            <label for="catégorie">Choisisez une catégorie :</label>
            <select class="form-control" name="catégorie" id="cat-select">';

                // Ici on donne l'attribut selected à la catégorie de base de l'élément qu'on souhaite modifier

            if(!empty($resultat_requeteEdit['cat'] == 'Lieux')) {

                echo   '<option value="1" selected>Lieux</option>
                        <option value="2">Personnages</option>
                        <option value="3">Batiments</option>';

            } elseif(!empty($resultat_requeteEdit['cat'] == 'Personnages')){

                echo   '<option value="1">Lieux</option>
                        <option value="2"selected>Personnages</option>
                        <option value="3">Batiments</option>';
            } elseif(!empty($resultat_requeteEdit['cat'] == 'Batiments')){

                echo   '<option value="1">Lieux</option>
                        <option value="2">Personnages</option>
                        <option value="3"selected>Batiments</option>';
            } else {

                echo
                        '<option value="1">Lieux</option>
                        <option value="2">Personnages</option>
                        <option value="3">Batiments</option>';
            }
            
            echo '</select>

            </div>

            <div class="col-md-12 text-center form-group">
                   <label for="lieu">Localisation :</label>
                   <input class="form-control" type="text" name="lieu" text_area="Lieu" placeholder="742 Evergreen Terrace" value="'.($editInfo['lieu']).'"> 
            </div>

            <div class="col-md-12 text-center form-group">
                    <label for="description">Description :</label>            
                    <figure class="bbcode">
                    <button class="bbcode_bold">B</button><button class="bbcode_title">title</button><button class="bbcode_type">&lt;&gt;</button>
                    <textarea name="story" height=500px class="editor_bbcode form-control textarea" readonly>'.($editInfo['desc']).'</textarea>
                </figure>
            </div>

            <button class="col-md-12 boutton form-control" type="submit">Valider</button>

    </form>';

?>



<div class="container">
        <h1>Les produits</h1>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Categorie</th>
                    <th>Lieu</th>
                    <th>Description</th>

                </tr>
            </thead>
            <tbody>



                <?php



                    // Ici on fait la requête pour récuperer le nombre de ligne dans le tableau

                    $requete = $sgbd->query ('SELECT COUNT(id_produit) as countid FROM produits');
                        
                    $nbligne = $requete->fetch();






                    // Ici la requête pour le tableau ADMIN

                    $requeteAdmin = $sgbd->query ('SELECT produits.nom AS produits, produits.lieu, produits.id_produit, produits.description, categorie.nom AS categories,
                      photos.src, photos.alt 
                    FROM produits INNER JOIN springfield.categorie ON produits.id_cat = categorie.id_cat INNER JOIN springfield.photos ON photos.id_produit = produits.id_produit');

                    $requeteAdmin->execute();

                    $resultat_requeteAdmin = $requeteAdmin->fetchAll((PDO::FETCH_ASSOC));

                    // On affiche le tableau ADMIN

                    if ($_SESSION['id_admin'] == 1) {


                    foreach ($resultat_requeteAdmin as $articleAdmin) {


                        echo   '<tr>
                                    <td>
                                        <img class="phototableau" src="../data/img/'.($articleAdmin['src']).'"
                                    
                                    </td>
                                    <td>'.($articleAdmin['produits']).'</td>
                                    <td>'.($articleAdmin['categories']).'</td>
                                    <td>'.($articleAdmin['lieu']).'</td>
                                    <td>'.($articleAdmin['description']).'</td>
                                    <td class="col-md-1 edit">
                                        <a class="tablebutton" href="index.php?ind=desc&id_edit='.($articleAdmin['id_produit']).'">
                                            <img src="src/img/icons8-modifier.svg" class="testcolor">
                                        </a>
                                    </td>
                                    <td class="col-md-1 delete">
                                        <a class="tablebutton" onclick="window.open(\'./src/exec/delete_produits.php?id_delete='.($articleAdmin['id_produit']).'\',\'pop_up\',\'width=300, height=200, toolbar=no status=no\');">
                                            <img src="src/img/poubelle.svg" class="testcolor">
                                        </a>
                                    </td>
                                </tr>';

                    }
                
                    } else {  

                                            // Ici la requête pour le tableau gestionnaire

                    $requeteGestionnaire = $sgbd->prepare ('SELECT produits.nom, produits.lieu, produits.id_produit, produits.description, categorie.nom  
                    FROM produits INNER JOIN springfield.categorie ON produits.id_cat = categorie.id_cat WHERE produits.id_user=:id_user');

                    $requeteGestionnaire->execute([":id_user"=>$_SESSION['id_user']]);

                    $resultat_requeteGestionnaire = $requeteGestionnaire->fetchAll((PDO::FETCH_ASSOC));

                        // On affiche le tableau gestionnaire

                        foreach ($resultat_requeteGestionnaire as $articleGestionnaire) {


                            echo   '<tr>
                                        <td>'.($articleGestionnaire['produits']).'</td>
                                        <td>'.($articleGestionnaire['categories']).'</td>
                                        <td>'.($articleGestionnaire['lieu']).'</td>
                                        <td>'.($articleGestionnaire['description']).'</td>
                                        <td class="col-md-1 edit">
                                            <a class="tablebutton" href="index.php?ind=desc&id_edit='.($articleGestionnaire['id_produit']).'">
                                                <img src="src/img/icons8-modifier.svg" class="testcolor">
                                            </a>
                                        </td>
                                        <td class="col-md-1 delete">
                                            <a class="tablebutton" onclick="window.open(\'./src/exec/delete_produits.php?id_delete='.($articleGestionnaire['id_produit']).'\',\'pop_up\',\'width=300, height=200, toolbar=no status=no\');">
                                                <img src="src/img/poubelle.svg" class="testcolor">
                                            </a>
                                        </td>
                                    </tr>';
    
                        }
                    }



                    // Supression d'un produit


                    if(!empty($_GET['id_delete'])){

                        $delete = $sgbd->prepare(" DELETE FROM produits WHERE id_produit=:id_produit");
                        $delete->execute(array(':id_produit'=>$_GET['id_delete']));
                    }

                ?>
                
            </tbody>
        </table>




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


