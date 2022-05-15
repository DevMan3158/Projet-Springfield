<?php

    include_once dirname(__FILE__) . '/../config/sgbd_config.php';
    $sgbd= connexion_sgbd();

?>

<section>

    <div class="grid">

        <?php

                            //Ici on récupere le titre des catégories

                            $articles_titre = $sgbd->prepare('SELECT categorie.nom FROM springfield.categorie WHERE categorie.id_cat=:id_cat');
                            $articles_titre->execute([":id_cat"=>$_GET["cat"]]);

                            if($articles_titre->rowCount() > 0) {


                            echo    '<h3>
                                    '.$articles_titre->fetch((PDO::FETCH_ASSOC))['nom'].'
                                    </h3>';

                            // On récupere le nombre de produits de la catégories actuelle pour calculer le nombre de pages

                            $nombre_produits = $sgbd->prepare('SELECT id_cat, COUNT(*) AS nbByCat FROM produits WHERE produits.id_cat=:id_cat');
                            
                            $nombre_produits->execute([":id_cat"=>$_GET["cat"]]);

                            $nombre_produits_by_idcat = $nombre_produits->fetchAll((PDO::FETCH_ASSOC));
                            
                            foreach ($nombre_produits_by_idcat as $nbByCat) {
                                $nbOfPages = ceil($nbByCat['nbByCat'] / 5);
                            }

                            //Ici on récupere les produits pour la première page



                            // Deuxieme page

                            $articles2 = $sgbd->prepare('SELECT produits.id_produit, categorie.nom, photos.titre, photos.src, photos.alt 
                            FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                            INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=:id_cat LIMIT 5,5;');
                            $articles2->execute([":id_cat"=>$_GET["cat"]]);
                        
                            $resultat_articles2 = $articles2->fetchAll((PDO::FETCH_ASSOC));


                    
                            // On dit que si on est sur une page, alors $pg récupere la page actuelle, sinon il est sur 0

                            $pg=0;
                            if (!empty($_GET['pg'])){
                                $pg=$_GET['pg'];
                            }

                            // Ici on affiche le contenue des pages (les produits) (5 par pages)


                            for ($i=0; $i<$nbOfPages; $i++){

                                        $articles = $sgbd->prepare('SELECT produits.id_produit, categorie.nom, photos.titre, photos.src, photos.alt 
                                        FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                                        INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=:id_cat LIMIT 5');
                                        $articles->execute([":id_cat"=>$_GET["cat"]]);
                                
                                        $resultat_articles = $articles->fetchAll((PDO::FETCH_ASSOC));

                                if ($pg==$i) {

                                    foreach ($resultat_articles as $article) {


                                        echo    '<figure>
                                                    <a href="./index.php?ind=desc&desc='.($article['id_produit']).'">
                                                        <img class="contain" src="data/img/'.($article['src']).'" alt="'.($article['alt']).'">
                                                        <figcaption>' .($article['titre']). '</figcaption>
                                                    </a>
                                                </figure>';

                                            }
                                        }


                            }


                            /* if ($pg==0) {

                                foreach ($resultat_articles1 as $article1) {

                                    echo    '<figure>
                                                <a href="./index.php?ind=desc&desc='.($article1['id_produit']).'">
                                                    <img class="contain" src="data/img/'.($article1['src']).'" alt="'.($article1['alt']).'">
                                                    <figcaption>' .($article1['titre']). '</figcaption>
                                                </a>
                                            </figure>';
                                        }

                            } elseif ($pg==1){

                                foreach ($resultat_articles2 as $article2) {
        
                                    echo    '<figure>
                                                <a href="./index.php?ind=desc&desc='.($article2['id_produit']).'">
                                                    <img class="contain" src="data/img/'.($article2['src']).'" alt="'.($article2['alt']).'">
                                                    <figcaption>' .($article2['titre']). '</figcaption>
                                                </a>
                                            </figure>';
                                        }


                            } */
/*
                            foreach ($resultat_articles1 as $article1) {

                                echo    '<figure>
                                            <a href="./index.php?ind=desc&desc='.($article1['id_produit']).'">
                                                <img class="contain" src="data/img/'.($article1['src']).'" alt="'.($article1['alt']).'">
                                                <figcaption>' .($article1['titre']). '</figcaption>
                                            </a>
                                        </figure>';
                                    }

                            
                            foreach ($resultat_articles2 as $article2) {
        
                                echo    '<figure>
                                            <a href="./index.php?ind=desc&desc='.($article2['id_produit']).'">
                                                <img class="contain" src="data/img/'.($article2['src']).'" alt="'.($article2['alt']).'">
                                                <figcaption>' .($article2['titre']). '</figcaption>
                                            </a>
                                        </figure>';
                                    }
                
*/

                ?>

    



        </div>

        <?php



        ?>

        <div class="btn">

        <div class="arrow">

        <?php



            


                        //Ici on fait une boucle $i qui correspond aux numéros de pages, et on récupere le numéro de page avec $_GET

                for ($i=0; $i<($nbOfPages); $i++){
                        echo'        
                        <a href="./index.php?ind=cat&cat='.$_GET['cat'].'&pg='.($i).'" class="pages">'.($i).'</a>';
                    };


                            




        ?>

        </div>

        </div>
    <?php } ?>




</section>

