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

    $sth = $sgbd->prepare("
    INSERT INTO produits (nom, id_cat, lieu, description, id_user)
    VALUES (:nom, :id_cat, :lieu, :description, :id_user)");
$sth->bindParam(':nom',$nom);
$sth->bindParam(':id_cat',$cat);
$sth->bindParam(':lieu',$lieu);
$sth->bindParam(':description',$message);
$sth->bindParam(':id_user',$_SESSION["id_user"]);
$sth->execute();
$id_produit=$sgbd->lastInsertID();
echo $id_produit;
/* Pour les modifications, Rajouter un if else ( SI la page existe alors la modifier SINON la créer ) */
/* Pour rajouter la photos, créer une autre requetes sql INSERT aec le $id_produit */




if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    foreach ($_FILES["file"]["name"] as $key => $name) {
        $nomphoto="Une photo de ".$nom.".";
        $sth = $sgbd->prepare("
        INSERT INTO photos (id_produit, src, alt, titre)
        VALUES (:id, :src, :alt, :titre)");
        $sth->bindParam(':id',$id_produit);
        $sth->bindParam(':src',$name);
        $sth->bindParam(':alt',$nomphoto);
        $sth->bindParam(':titre',$nom);
        $sth->execute();
        if(move_uploaded_file($_FILES['file']['tmp_name'][$key], "./../../../data/img/".$name)) {
            echo "Le fichier ".$name." a été sauvegardé.<br />";
        } else {
            echo "Erreur lors du téléchargement du fichier ".$name.".";
        }
    }
} else {
    echo "Vous devez envoyer un fichier.";
}


//On renvoie l'utilisateur vers la page de remerciement
/*header("location:produit.php");*/










?>

