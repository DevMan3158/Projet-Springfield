<?php
// à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
session_start();


if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION)){




/* test SuperGlob*/
/*var_dump($_POST);*/
include_once dirname(__FILE__) . '/../../../src/class/Pass_Crypt.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';

   function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

try{

   /*faire un empty post*/

   if(!empty($_POST));

   {
    
   /*On récupère se qui à était écrit dans les champs du formulaire*/ 
   $login = valid_donnees($_POST["login"]);
   $prenom = valid_donnees($_POST["prenom"]);
   $email = valid_donnees($_POST["email"]);
   $nom = valid_donnees($_POST["nom"]);
   $mdp = $_POST["mdp"];
   $cfn_mdp = $_POST["cfn_mdp"];



   /*test l'égalité des champs du formulaire pour le mot de passe et la répétition
     Si la condition est TRUE, crypt le mdp avec la fonction "password" SINON envoie un echo 
     dans add_utilisateur 
   */
        if( $_POST["mdp"] == $_POST["cfn_mdp"]){
            /*connexion à la SGBD Springfield par la fonction "connexion_sgbd"*/
              $dbco = connexion_sgbd();
              $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              if (!empty($_POST["mdp"]))
              {
           
             /*Envoie de la requête SQL UPDATE dans table utilisateur  pour modifier l'utilisateurs (Nom-Prénom-Email-Mdp)*/ 
              $dta_usr = $dbco->prepare("UPDATE utilisateur SET  nom=:nom , prenom=:prenom , login=:login , email=:email ,mot_pass=:mdp  WHERE  id_user=:id_user");
             /*Crée un tableau avec le nom $dta_usr avec les données stokés dans les variables */  
                 $dta_usr->execute
                 ([
                 ':login'=>$login,
                 ':prenom'=>$prenom,
                 ':nom'=>$nom,
                 ':email'=>$email,
                 ':mdp'=>Pass_Crypt::password($mdp),
                 ':id_user'=>$_SESSION["id_user"],  
                 ]);
             }


             else 
             {
                /*Envoie de la requête SQL UPDATE dans table utilisateur  pour modifier l'utilisateurs (Nom-Prénom-Email-)*/ 
              $dta_usr = $dbco->prepare("UPDATE utilisateur SET  nom=:nom , prenom=:prenom , login=:login , email=:email   WHERE  id_user=:id_user");
              /*Crée un tableau avec le nom $dta_usr avec les données stokés dans les variables */  
                  $dta_usr->execute
                  ([
                  ':login'=>$login,
                  ':prenom'=>$prenom,
                  ':nom'=>$nom,
                  ':email'=>$email,
                  ':id_user'=>$_SESSION["id_user"],  
                  ]);  
             }
            /*Raffiche les données à jour dans les champs du formulaire */
                $_SESSION['login']=$login;
                $_SESSION['prenom']=$prenom;
                $_SESSION['nom']=$nom;
                $_SESSION['email']=$email;
            }

            else
            {
               echo 'Mot de passe non identique';
              /* header("Location:../../index.php?ind=utilisateur");*/
            
            }
        
        /* test affichage
        /*echo '<br><br>P:' .$prenom.'<br>';
        echo 'E:' .$email.'<br>';
        echo 'N:' .$nom.'<br>';
        echo 'MDP:' .$mdp.'<br>';*/

           //On renvoie l'utilisateur vers la page utilisateur    
  header("Location:../../index.php?ind=utilisateur");

}

   }

catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
  
 }
 
 else 
 {
 echo '<h1>Page non disponible</h1>';}



 ?>


<?php 
/*


else 

header ("Location:../../index.php?ind=utilisateur");




/*6. met à jour */
//On se connecte à la BDD



/*
--Pour image--

var_dump($_POST);

if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    echo "true";
} else {
    echo "false";
}
if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    var_dump($_FILES);
}

if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    if(move_uploaded_file($_FILES['file']['tmp_name'], "./data/img".$_FILES['file']['name'])) {
        echo "Le fichier a été sauvegardé.";
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
} else {
    echo "Vous devez envoyer un fichier.";
}

*/
?>