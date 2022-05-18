<?php
session_start();
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
$sgbd= connexion_sgbd();

function validation_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

$nom = validation_donnees($_POST["nom"]);
$cat = validation_donnees($_POST["catégorie"]);
$lieu = validation_donnees($_POST["lieu"]);
$message = validation_donnees($_POST["story"]);

$sth = $sgbd->prepare(" UPDATE produits SET produits.nom = :nom, produits.id_cat = :id_cat, produits.lieu = :lieu, 
produits.description = :description WHERE produits.id_produit=:id_produit");

$sth->bindParam(':nom',$nom);
$sth->bindParam(':id_cat',$cat);
$sth->bindParam(':lieu',$lieu);
$sth->bindParam(':description',$message);
$sth->bindParam(':id_produit',$_GET["id_edit"]);
$sth->execute();
/* Pour les modifications, Rajouter un if else ( SI la page existe alors la modifier SINON la créer ) */
/* Pour rajouter la photos, créer une autre requetes sql INSERT aec le $id_produit */




if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
        $name=$_FILES["file"]["name"];
        $nomphoto="Une photo de ".$nom.".";
        $sth = $sgbd->prepare('UPDATE photos SET photos.src = :src, photos.alt = :alt, photos.titre = :titre WHERE photos.id_produit=:id_produit');
        $sth->bindParam(':id_produit',$_GET["id_edit"]);
        $sth->bindParam(':src',$name);
        $sth->bindParam(':alt',$nomphoto);
        $sth->bindParam(':titre',$nom);
        $sth->execute();
        if(move_uploaded_file($_FILES['file']['tmp_name'], "./../../../data/img/".$name)) {
            echo "Le fichier ".$name." a été sauvegardé.<br />";
        }
}

//header("location:../../index.php?ind=produit");









?>