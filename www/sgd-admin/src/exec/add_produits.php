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

    $sth = $sgbd->prepare("
    INSERT INTO produits (nom, id_cat, lieu, description, id_user)
    VALUES (:nom, :id_cat, :lieu, :description, :id_user)");
/*$sth->bindParam(':nom',$nom, PDO::PARAM_STR);
$sth->bindParam(':id_cat',$cat, PDO::PARAM_INT);
$sth->bindParam(':lieu',$lieu, PDO::PARAM_STR);
$sth->bindParam(':description',$message, PDO::PARAM_STR);
$sth->bindParam(':id_user',$_SESSION["id_user"]);*/
$sth->execute([
    ':nom' => $nom,
    ':id_cat' => $cat,
    ':lieu' => $lieu,
    ':description' => $message,
    ':id_user' => $_SESSION["id_user"]
]);
$id_produit=$sgbd->lastInsertID();
header('location:../../index.php?ind=desc');


$lieu = validation_donnees($_POST["lieu"]);
$message = validation_donnees($_POST["story"]);

if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    $name = validation_donnees($_FILES['file']['name']);
    $nomphoto= validation_donnees("Une photo de ".$nom.".");
    $sth = $sgbd->prepare("
    INSERT INTO photos (id_produit, src, alt, titre)
    VALUES (:id, :src, :alt, :titre)");
    /*$sth->bindParam(':id',($id_produit), PDO::PARAM_INT);
    $sth->bindParam(':src',($name), PDO::PARAM_STR);
    $sth->bindParam(':alt',($nomphoto), PDO::PARAM_STR);
    $sth->bindParam(':titre',($nom), PDO::PARAM_STR);*/
    $sth->execute([
        ':id' => $id_produit,
        ':src' => $name,
        ':alt' => $nomphoto,
        ':titre' => $nom
    ]);
    if(move_uploaded_file($_FILES['file']['tmp_name'], "./../../../data/img/".$name)) {
        echo ' "Le fichier ".$name." a été sauvegardé.<br />"; ';
    } else {
        echo "Erreur lors du téléchargement du fichier ".$name.".";
    }
} else {
echo "Vous devez envoyer un fichier.";
}

} else { echo 'Acces interdit';} ?>


