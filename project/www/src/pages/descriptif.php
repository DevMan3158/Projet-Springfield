<?php
 


 //On appel le fichier contenant la conversion BBCODE VERS HTML 
include_once dirname(__FILE__) . '/../bbcode_editeur/conversion_bbcode.php';
 //On appel le fichier contenant toutes les infos de la base de données
include_once dirname(__FILE__) . '/../fonctions/connexion_sgbd.php';
 //On se connecte à la BDD
$sgbd= connexion_sgbd();
 ?>
 
  
 
<div class="contenairTitre">
    <div class="Ligne">
    </div>
   
   
<?php 
 /* initialise la variable $articles_lbp, pour faire requêtes SQL */

     $articles_lbp = $sgbd->prepare('SELECT produits.nom FROM springfield.produits WHERE produits.id_produit=:id_produit');


                        $articles_lbp->execute([":id_produit"=>$_GET["desc"]]);

                        $articles = $articles_lbp->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($articles as $article ){
                    
                        echo '<h3 class="h3Textcenter">'.$article['nom'].'</h3>';

                    }

 ?>

    <div class="Ligne">
    </div>
</div>

<div class="contenairLieux">

         <?php 

        $articles_img = $sgbd->prepare('SELECT photos.id_produit, photos.titre, photos.src, photos.alt ,produits.id_produit FROM springfield.photos INNER JOIN springfield.produits ON photos.id_produit = produits.id_produit WHERE produits.id_produit=:id_produit LIMIT 1; 
            ');                  
 /*INNER JOIN categorie ON produits.id_cat = categorie.id_cat*/

        $articles_img->execute([":id_produit"=>$_GET["desc"]]);

                        $articles_I = $articles_img->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($articles_I as $article_i )
                        {
          ?>


    <figure>
            <?php 

            echo '<img class="recadre" title="'.($article_i['titre']).'" src="data/img/'.($article_i['src']).'" alt="'.($article_i['alt']).'">';  

            } ?>                                                                                            
    </figure>


    <div class="contenairNomImage">





        <p>  <!--Appel conversion bbcode pour Nom du lieux, personnages, batiment-->
            <?php 
             /* initialise la variable $articles_lbp, pour faire requêtes SQL */

                 $articles_lbp = $sgbd->prepare('SELECT produits.nom FROM springfield.produits WHERE produits.id_produit=:id_produit');


                                    $articles_lbp->execute([":id_produit"=>$_GET["desc"]]);

                                    $articles = $articles_lbp->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($articles as $article ){
                                    
                                    
                                    echo conversion_bbcode('[title]'.$article['nom'].'[/title] [b][/b]');
                                }
                            
             ?>       
        </p>
    </div>
</div>

<div class="transit">
    <div class="Ligne">

    </div>
</div>

<div class="contenairHBC">



                <!--Appel conversion bbcode pour la description du lieux, personnages, batiment-->
    <p>

             <?php 
                 /* initialise la variable $articles_lbp, pour faire requêtes SQL */

                 $articles_desc = $sgbd->prepare('SELECT produits.description FROM springfield.produits WHERE produits.id_produit=:id_produit; ');


                 $articles_desc->execute([":id_produit"=>$_GET["desc"]]);

                 $articles_II = $articles_desc->fetchAll(PDO::FETCH_ASSOC);

                 foreach ($articles_II as $article_ii ){
                
                     echo conversion_bbcode($article_ii['description']);

                    }

                ?>       
    </p>

</div>


<div class="transit">
    <div class="Ligne">

    </div>
</div>


<div class="contenairBtn">

<a href="./index.php?ind=msg&desc=<?php echo $_GET["desc"]?>"><input class="favorite styled" type="button" value="SERVICES"></a>
<a href="./index.php?ind=msg&desc=<?php echo $_GET["desc"]?>"><input class="favorite styled" type="button" value="HORAIRES ET TARIFS"></a>
<a href="./index.php?ind=msg&desc=<?php echo $_GET["desc"]?>"><input class="favorite styled" type="button" value="CONTACT"></a>



</div>








