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

                            //Ici on récupere les produits pour la première page

                            $articles1 = $sgbd->prepare('SELECT produits.id_produit, categorie.nom, photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                            INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=:id_cat LIMIT 5');
                            $articles1->execute([":id_cat"=>$_GET["cat"]]);
                    
                            $resultat_articles1 = $articles1->fetchAll((PDO::FETCH_ASSOC));

                            // Deuxieme page

                            $articles2 = $sgbd->prepare('SELECT produits.id_produit, categorie.nom, photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
                            INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=:id_cat LIMIT 5,5;');
                            $articles2->execute([":id_cat"=>$_GET["cat"]]);
                        
                                $resultat_articles2 = $articles2->fetchAll((PDO::FETCH_ASSOC));

                            // On dit que si on est sur une page, alors $pg récupere récupere la page

                            $pg=1;
                            if (!empty($_GET['pg'])){
                                $pg=$_GET['pg'];
                            }

                            // On éxécute les requetes via des boucles pour afficher les cartes ( Need une boucle pour les boucles )
                            if ($pg==1) {

                                foreach ($resultat_articles1 as $article1) {

                                    echo    '<figure>
                                                <a href="./index.php?ind=desc&desc='.($article1['id_produit']).'">
                                                    <img class="contain" src="data/img/'.($article1['src']).'" alt="'.($article1['alt']).'">
                                                    <figcaption>' .($article1['titre']). '</figcaption>
                                                </a>
                                            </figure>';
                                        }

                            } elseif ($pg==2){

                                foreach ($resultat_articles2 as $article2) {
        
                                    echo    '<figure>
                                                <a href="./index.php?ind=desc&desc='.($article2['id_produit']).'">
                                                    <img class="contain" src="data/img/'.($article2['src']).'" alt="'.($article2['alt']).'">
                                                    <figcaption>' .($article2['titre']). '</figcaption>
                                                </a>
                                            </figure>';
                                        }


                            }
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

                     // Boucle for, Si $i = la page en question alors SELECT src alt titre FROM blabla requete au dessus LIMIT 0, 10; 10, 10 pour les autres.
                ?>

    



        </div>

        <div class="btn">

        <div class="arrow">

        <?php


                        //Ici on fait une boucle $i qui correspond aux numéros de pages, et on récupere le numéro de page avec $_GET

                for ($i=1; $i<6; $i++){
                        echo'        
                        <a href="./index.php?ind=cat&cat='.$_GET['cat'].'&pg='.($i).'" class="pages">'.($i).'</a>';
                    };

        ?>

        </div>


    <?php } ?>

    </div>



</section>

