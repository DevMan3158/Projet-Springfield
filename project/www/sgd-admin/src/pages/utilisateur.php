
  <?php

include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION) && ($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2)) {

  echo file_get_contents(dirname(__FILE__) . '/../template/utilisateur.html', true);

} else {
  echo "Vous n'avez pas le droit d'ouvrir cette page.";
}


$serveur = "localhost";
$dbname = "springfield";  /* On déclare la base de données*/
$user = "root";
$pass = "1234";
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$nom = $_POST["nom"];
$message = $_POST["mot_pass"];

try{
        


  //On se connecte à la BDD
  $dbco = new PDO("mysql:host=$serv;dbname=$dbname; charset=utf8", $user, $pass );
  $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //On insère les données reçues
  $sth = $dbco->prepare("
      INSERT INTO utilisateur(nom, prenom, email, mot_pass)  
      VALUES(:nom, :prenom, :email, :mot_pass)");
  /*INSERT INTO -> On spécifie la table "utilisateur" dans la db "springfield" */
  $sth->bindParam(':prenom',$prenom);
  
  $sth->bindParam(':nom',$nom);
  
  $sth->bindParam(':email',$email);

  $sth->bindParam('mot_pass',$mot_pass);
  
 
  $sth->execute();

  echo 'Serveur:' .$serveur.'<br>';
  echo 'db:' .$dbname.'<br>';
  echo 'P:' .$prenom.'<br>';
  echo 'N:' .$nom.'<br>';
  echo 'E:' .$email.'<br>';


  /*echo' Envoie dans la table  <br>';*/
  //On renvoie l'utilisateur vers la page de remerciement
  /*header("Location:Formulairemessage.html");*/
}
catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
?>

