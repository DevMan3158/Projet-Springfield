<?php
    include_once dirname(__FILE__) . '/../config/sgbd_config.php';
    $sgbd= connexion_sgbd();
    $articles = $sgbd->prepare('SELECT titre, src, alt FROM springfield.photos ORDER BY RAND()
    LIMIT 10');

?>



<h3>
    Bienvenue
</h3>

<p>
    Découvrez le monde magique de <strong>Springfield</strong> grace aux différentes cartes çi dessous qui vous donnerons toutes les informations sur chaque éléments de la ville !
</p>

<?php
        $articles->execute();
        $resultat = $articles->fetchAll((PDO::FETCH_ASSOC));

        foreach ($resultat as $article) {

            echo    '<figure>
                        <img src="data/img/'.($article['src']).'" alt="'.($article['alt']).'">
                        <figcaption>' .($article['titre']). '</figcaption>
                    </figure>';
    }
?>