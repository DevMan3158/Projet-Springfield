<?php
session_start();

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && $_SESSION['id_admin'] != 4 
&& ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {


include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';
$sgbd= connexion_sgbd();

function validation_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

$nom = validation_donnees($_POST["nom"]);
$cat = validation_donnees($_POST["cat"]);
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
        $sth->bindParam(':id_produit',validation_donnees($_GET["id_edit"]));
        $sth->bindParam(':src',validation_donnees($name));
        $sth->bindParam(':alt',validation_donnees($nomphoto));
        $sth->bindParam(':titre',validation_donnees($nom));
        $sth->execute();
        if(move_uploaded_file($_FILES['file']['tmp_name'], "./../../../data/img/".$name)) {
            echo "Le fichier ".$name." a été sauvegardé.<br />";
        }
}


header('location:../../index.php?ind=desc');

} else { echo 'Acces interdit';}

?>