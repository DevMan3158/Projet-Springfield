<?php
session_start();
var_dump($_POST);
include_once dirname(__FILE__) . '/../../../src/class/Pass_Crypt.php';
include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';


try{

   /*faire un empty post*/

   if(!empty($_POST));

   {
  
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $nom = $_POST["nom"];
  $mdp = $_POST["mdp"];
  $cfn_mdp = $_POST["cfn_mdp"];

  if( $_POST["mdp"]== $_POST["cfn_mdp"]){
 

    }

    else

    {
       header("Location:../../index.php?ind=utilisateur");
   
    }


  $dbco = connexion_sgbd();
  $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  $dta_usr = $dbco->prepare("UPDATE utilisateur SET  nom=:nom , prenom=:prenom , email=:email ,mot_pass=:mdp , mot_pass=:cfn_mdp WHERE  id_user=:id_user");



 /*on crée un tableau avec le nom $dta_usr */  
   


      $dta_usr->execute
      ([

      ':prenom'=>$prenom,
      ':nom'=>$nom,
      ':email'=>$email,
      ':mdp'=>Pass_Crypt::password($mdp),
      ':cfn_mdp'=>Pass_Crypt::password($cfn_mdp),  
      ':id_user'=>$_SESSION["id_user"],  


      ]);
   

  
  $_SESSION['prenom']=$prenom;
  $_SESSION['nom']=$nom;
  $_SESSION['email']=$email;


  echo '<br><br>P:' .$prenom.'<br>';
  echo 'E:' .$email.'<br>';
  echo 'N:' .$nom.'<br>';
  echo 'MDP:' .$mdp.'<br>';

  

              
header("Location:../../index.php?ind=utilisateur");

  
  //On renvoie l'utilisateur vers la page de remerciement
  
 /**/

}

   }


catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
  /* if (isset($_POST['nom'])) $name = $_POST['nom'];*/
 
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







