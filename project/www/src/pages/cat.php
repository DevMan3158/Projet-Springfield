<?php

    include_once dirname(__FILE__) . '/../config/sgbd_config.php';
    $sgbd= connexion_sgbd();

?>

<section>

    <div class="grid">

    <?php


    if ($_GET['cat'] == '1'){
        echo '  <h3>
                    Lieux
                </h3>';

                $articles = $sgbd->prepare('SELECT photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=1  ORDER BY RAND() LIMIT 5');
    }
    elseif ($_GET['cat'] == '2'){
        echo '  <h3>
                    Battiments
                </h3>';

                $articles = $sgbd->prepare('SELECT photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
        INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=2  ORDER BY RAND() LIMIT 5');
                
    } elseif ($_GET['cat'] == '3'){
        echo '  <h3>
                    Personnages
                </h3>';

                $articles = $sgbd->prepare('SELECT photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=3  ORDER BY RAND() LIMIT 5');
    }



    ?>





            <?php

                $articles->execute();
                    $resultat_articles = $articles->fetchAll((PDO::FETCH_ASSOC));

                    foreach ($resultat_articles as $article) {

                        echo    '<figure>
                                    <img class="contain" src="data/img/'.($article['src']).'" alt="'.($article['alt']).'">
                                    <figcaption>' .($article['titre']). '</figcaption>
                                </figure>';
                }

            ?>


    </div>

    <div class="btn">

    <div class="arrow">
        <a href="./index.php?ind=cat&cat=1&pg=1" class="pages">1</a>
        <a href="./index.php?ind=cat&cat=1&pg=2" class="pages">2</a>
        <a href="./index.php?ind=cat&cat=1&pg=3" class="pages">3</a>
        <a href="./index.php?ind=cat&cat=1&pg=4" class="pages">4</a>
        <a href="./index.php?ind=cat&cat=1&pg=5" class="pages">5</a>
    </div>



    </div>

</section>

