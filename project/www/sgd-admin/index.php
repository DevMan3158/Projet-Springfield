<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../sgd-admin/src/css/style.css">
    <?php
if(!isset($_GET['ind'])) {
    $_GET['ind'] = 'acc' ; 
}

if($_GET['ind'] =='acc') {
    echo '<link rel="stylesheet" href="../sgd-admin/src/css/style-acc.css">';
}
elseif ($_GET['ind'] == 'admin') {
    echo '<link rel="stylesheet" href="../sgd-admin/src/css/style-admin.css">';
}

elseif ($_GET['ind'] == 'message') {
    echo '<link rel="stylesheet" href="../sgd-admin/src/css/style-message.css">';
}

 elseif ($_GET['ind'] == 'produit') {
    echo '<link rel="stylesheet" href="../sgd-admin/src/css/style-produit.css">';
 }
 elseif ($_GET['ind'] == 'utilisateur') {
    echo '<link rel="stylesheet" href="../sgd-admin/src/css/style-utilisateur.css">';
 }
?>
    <title>Page d'accueil</title>
    <link rel="shortcut icon" type="image/ico" href="../faviron.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
        
        <style>
        .row {
            border: 1px solid #7451EB;
            padding: 0px;
        }

        [class^="col"] {
            padding: 0px;
            margin: 0px;
            border: 2px solid #3FA5DB;

        }
    </style>
</head>

<body>




<!----Début_Header---->


    <div class="container-fluid bg-secondary ">

        <div class="row">
            <div class="col">
              
            
                
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

<!-- Brand -->
<a class="navbar-brand text-center text-right " href="./index.php?ind=acc">Office du tourisme de Springfield</a>


    

<!-- Links -->

<ul class="navbar-nav ">

   <!-- Dropdown -->
   <li class="nav-item dropdown ">
      <a class="nav-link dropdown-toggle " href="./index.php?ind=acc" id="navbardrop" data-toggle="dropdown">
      Accueil
      </a>
      <div class="dropdown-menu ">
         <a class="dropdown-item" href="./index.php?ind=admin">Admin</a>
         <a class="dropdown-item" href="./index.php?ind=produit">Produits</a>
         <a class="dropdown-item" href="./index.php?ind=utilisateur">Utilisateurs</a>
         <a class="dropdown-item" href="./index.php?ind=message">Messages</a>
      </div>
   </li>
</ul>

</nav>
                

            </div>
        </div>

    </div>  <!--Fin_Container_Fluid-->

<!----Fin_Header---->



 

<!----Contenus---->

<?php
if(!isset($_GET['ind'])) {
    $_GET['ind'] = 'acc' ; 
}

if($_GET['ind'] =='acc') {
    include './src/pages/acc.php';
}
elseif ($_GET['ind'] == 'admin') {
    include './src/pages/admin.php';
}

elseif ($_GET['ind'] == 'produit') {
    include './src/pages/produit.php';
}

 elseif ($_GET['ind'] == 'utilisateur') {
    include './src/pages/utilisateur.php';
 }

 elseif ($_GET['ind'] == 'message') {
    include './src/pages/message.php';
 }


?>

<!----Fin_Contenues---->

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>

</html>