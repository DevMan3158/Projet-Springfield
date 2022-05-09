<?php

include_once dirname(__FILE__) . '/../src/fonctions/connexion_sgbd.php';

session_start();

if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION)) {

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page d'accueil</title>
    <link rel="apple-touch-icon" sizes="57x57" href="https://media.flaticon.com/dist/min/img/apple-icon-57x57-precomposed.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
        
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
</head>

<body>

<!----Début_Header  fixed-top---->


    <nav class="navbar navbar-secondary bg-simpson bg-gradient row">
        <a class="navbar-brand col m-1" href="./index.php?ind=acc">
            <img src="./../favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="">
        </a>

        <a class="col m-1 text-center text-simpson title-simpson" href="./index.php?ind=acc">Office du tourisme de Springfield</a>

        <!-- Dropdown -->
            
        <nav class="dropdown col text-right">
            <button class="btn m-1 btn-secondary bg-simpson bg-gradient" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="./src/img/burger_icon.svg" alt="menu" />
            </button>
            <div class="dropdown-menu dropdown-menu-right bg-simpson">
                <?php if($_SESSION['id_admin'] == 1) { ?>
                    <a class="dropdown-item" href="./index.php?ind=admin">
                        <img class="img_del" src="src/img/star.svg"> Admin
                    </a>
                <?php } ?>
                <?php if($_SESSION['id_admin'] == 1 || $_SESSION['id_admin'] == 2) { ?>
                    <a class="dropdown-item" href="./index.php?ind=produit">
                        <img class="img_del" src="src/img/document.svg"> Produits
                    </a>
                    <a class="dropdown-item" href="./index.php?ind=message">
                        <img class="img_del" src="src/img/enveloppe.svg">   Messages
                    </a>
                <?php } ?>
                <a class="dropdown-item" href="./index.php?ind=utilisateur">
                    <img class="img_del" src="src/img/utilisateur.svg"> Utilisateurs
                </a>
                <a class="dropdown-item" href="./../src/exec/deconnexion_exec.php">
                    <img class="img_del" src="src/img/deconnexion.svg"> Déconnexion
                </a>
            </div>
        </nav>
    </nav>  <!--Fin_Container_Fluid-->

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
<?php

} else { ?>
    <script src="./../src/js/header_connexion.js"></script>
    <script type="text/javascript">
        header_connexion(event);
    </script>
<?php 
}
?>