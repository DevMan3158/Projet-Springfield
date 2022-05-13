<?php

    include_once dirname(__FILE__) . '/../config/sgbd_config.php';
    $sgbd= connexion_sgbd();

?>

<section>

    <div class="grid">

        <?php

                    $articles_titre = $sgbd->prepare('SELECT categorie.nom FROM springfield.categorie WHERE categorie.id_cat=:id_cat');
                    $articles_titre->execute([":id_cat"=>$_GET["cat"]]);

                  if($articles_titre->rowCount() > 0) {


                    echo    '<h3>
                            '.$articles_titre->fetch((PDO::FETCH_ASSOC))['nom'].'
                            </h3>';

                    $articles = $sgbd->prepare('SELECT produits.id_produit, categorie.nom, photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                    INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=:id_cat  ORDER BY RAND() LIMIT 5');
                    $articles->execute([":id_cat"=>$_GET["cat"]]);
                
                        $resultat_articles = $articles->fetchAll((PDO::FETCH_ASSOC));

                        

                        foreach ($resultat_articles as $article) {

                            echo    '<figure>
                                        <a href="./index.php?ind=desc&desc='.($article['id_produit']).'">
                                            <img class="contain" src="data/img/'.($article['src']).'" alt="'.($article['alt']).'">
                                            <figcaption>' .($article['titre']). '</figcaption>
                                        </a>
                                    </figure>';
                    }

                ?>


        </div>

        <div class="btn">

        <div class="arrow">

        <?php

                for ($i=0; $i<5; $i++){
                        echo'        
                        <a href="./index.php?ind=cat&cat='.$_GET['cat'].'&pg='.($i).'" class="pages">'.($i).'</a>';
                    };

        ?>

        </div>


    <?php } ?>

    </div>



</section>

