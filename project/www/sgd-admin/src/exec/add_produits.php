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
$cat = validation_donnees($_POST["catégorie"]);
$lieu = validation_donnees($_POST["lieu"]);
$message = validation_donnees($_POST["story"]);

    $sth = $sgbd->prepare("
    INSERT INTO produits (nom, id_cat, lieu, description, id_user)
    VALUES (:nom, :id_cat, :lieu, :description, :id_user)");
$sth->bindParam(':nom',htmlspecialchars(stripslashes(trim($nom))));
$sth->bindParam(':id_cat',htmlspecialchars(stripslashes(trim($cat))));
$sth->bindParam(':lieu',htmlspecialchars(stripslashes(trim($lieu))));
$sth->bindParam(':description',htmlspecialchars(stripslashes(trim($message))));
$sth->bindParam(':id_user',htmlspecialchars(stripslashes(trim($_SESSION["id_user"]))));
$sth->execute();
$id_produit=$sgbd->lastInsertID();
echo $id_produit;
/* Pour les modifications, Rajouter un if else ( SI la page existe alors la modifier SINON la créer ) */
/* Pour rajouter la photos, créer une autre requetes sql INSERT aec le $id_produit */

if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    $name = $_FILES['file']['name'];
    $nomphoto="Une photo de ".$nom.".";
    $sth = $sgbd->prepare("
    INSERT INTO photos (id_produit, src, alt, titre)
    VALUES (:id, :src, :alt, :titre)");
    $sth->bindParam(':id',htmlspecialchars(stripslashes(trim($id_produit))));
    $sth->bindParam(':src',htmlspecialchars(stripslashes(trim($name))));
    $sth->bindParam(':alt',htmlspecialchars(stripslashes(trim($nomphoto))));
    $sth->bindParam(':titre',htmlspecialchars(stripslashes(trim($nom))));
    $sth->execute();
    if(move_uploaded_file($_FILES['file']['tmp_name'], "./../../../data/img/".$name)) {
        echo "Le fichier ".$name." a été sauvegardé.<br />";
    } else {
        echo "Erreur lors du téléchargement du fichier ".$name.".";
    }
} else {
echo "Vous devez envoyer un fichier.";
}

} else { echo 'Acces interdit';} ?>


