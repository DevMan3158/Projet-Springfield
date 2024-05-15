<section>

<?php
    include_once dirname(__FILE__) . '/../config/sgbd_config.php';
    $sgbd= connexion_sgbd();
    $articles = $sgbd->prepare('SELECT photos.id_produit, photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
    INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat !=3  ORDER BY RAND()
    LIMIT 5');
    $personnages = $sgbd->prepare('SELECT photos.id_produit, photos.titre, photos.src, photos.alt FROM springfield.photos INNER JOIN springfield.produits ON produits.id_produit = photos.id_produit
    INNER JOIN categorie ON produits.id_cat = categorie.id_cat WHERE categorie.id_cat=3  ORDER BY RAND()
    LIMIT 5');

?>



<h3>
    Bienvenue
</h3>

<p>
    Découvrez le monde magique de <strong>Springfield</strong> grace aux différentes cartes çi dessous qui vous donnerons toutes les informations sur chaque éléments de la ville !
</p>

<?php
        $articles->execute();
        $resultat_articles = $articles->fetchAll((PDO::FETCH_ASSOC));



        foreach ($resultat_articles as $article) {

            echo    '<figure>
                        <a href="./index.php?ind=desc&desc='.($article['id_produit']).'">
                            <img src="data/img/'.($article['src']).'" alt="'.($article['alt']).'">
                            <figcaption>' .($article['titre']). '</figcaption>
                        </a>
                    </figure>';
    }

        $personnages->execute();
        $resultat_personnages = $personnages->fetchAll((PDO::FETCH_ASSOC));

        foreach ($resultat_personnages as $personnage) {

            echo    '<figure>
                        <a href="./index.php?ind=desc&desc='.($personnage['id_produit']).'">
                            <img class="contain" src="data/img/'.($personnage['src']).'" alt="'.($personnage['alt']).'">
                            <figcaption>' .($personnage['titre']). '</figcaption>
                        </a>
                    </figure>';
    }
?>

</section>