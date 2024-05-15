<?php
    /*Connexion*/
    include_once dirname(__FILE__) . '/src/fonctions/connexion_sgbd.php';

    session_start();

    $isConnected = false;

    if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
    array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) &&   
    array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
    array_key_exists('email', $_SESSION)) {
        $isConnected = true;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/normalizer.css" />
    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Montserrat&family=Oswald&family=Playball&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/280516d329.js" crossorigin="anonymous"></script>
    <?php
        /*Liens_Contenues_.css*/
        if(empty($_GET['ind'])) {
            $_GET['ind'] = 'acc';
        }

        if ($_GET['ind'] == 'acc') {
            echo '<link rel="stylesheet" href="./src/css/style-acc.css">';
        } elseif ($_GET['ind'] == 'cat'){
            echo '<link rel="stylesheet" href="./src/css/style-cat.css">';
        } elseif ($_GET['ind'] == 'msg'){
            echo '<link rel="stylesheet" href="./src/css/formulaire.css">';
            echo '<link rel="stylesheet" href="./src/css/style-messages.css">';
        } elseif ($_GET['ind'] == 'insc'){
            echo '<link rel="stylesheet" href="./src/css/formulaire.css">';
            echo '<link rel="stylesheet" href="./src/css/style-inscription.css">';

        } elseif ($_GET['ind'] == 'desc'){       
            echo '<link rel="stylesheet" href="./src/css/style-descriptif.css">';
            
        } elseif ($_GET['ind'] == 'mmdp'){
            echo '<link rel="stylesheet" href="./src/css/formulaire.css">';
            echo '<link rel="stylesheet" href="./src/css/style-modif-mdp.css">';
        } 
            elseif ($_GET['ind'] == 'info'){       
            echo '<link rel="stylesheet" href="./src/css/style-entreprise.css">';
        }

    ?>
    <title>Springfield</title>
</head>
<body>
    <header>

        <div class="hommerheader">
            <img src="src/img/hommer_content.png" alt="Hommer joyeux">
        </div>
        <a href="./index.php?ind=acc">
            <h1>
                Office du tourisme de Springfield 
            </h1>
        </a>
        <input type="checkbox" id="checkbox">
        <label id="donnut" for="checkbox">
            <img id="d1" src="src/img/donnuts.png" alt="Un donnuts">
            <img id="d2" src="src/img/donnuts_2.png" alt="Un donnuts croqué">
        </label>
        <nav>
            <a id="acc" href="./index.php?ind=acc">Accueil</a>
            <?php if($isConnected) { ?>
                <a id="disc" href="./src/exec/deconnexion_exec.php">Déconnexion</a>
            <?php } else { ?>
                <a id="btt_conn" class="conn">Connexion</a>
            <?php } ?>
            <?php if(!$isConnected) { ?>
            <a id="insc" href="./index.php?ind=insc">Inscription</a>
            <?php } ?>
            <?php if($isConnected) { ?>
            <a id="backOff" href="sgd-admin/index.php">Back-Office</a>
            <?php } ?>
            <div class="cat">
                <a>Categories</a>
                <div class="souscat">
                    <a id="batt" href="./index.php?ind=cat&cat=2">Battiments</a>
                    <a id="pers" href="./index.php?ind=cat&cat=3">Personnages</a>
                    <a id="lieux" href="./index.php?ind=cat&cat=1">Lieux</a>
                </div>
            </div>
            


            <?php $sgb = connexion_sgbd(); // idem : $sgb = new PDO(....,....,...)  ?>
            

            

        </nav>
    </header>
    <?php

        if ($_GET['ind'] == 'acc') {
            include './src/pages/acc.php';
        } elseif ($_GET['ind'] == 'cat'){
            include './src/pages/cat.php';
        } elseif ($_GET['ind'] == 'msg'){
            include './src/pages/messages.php';
        } elseif ($_GET['ind'] == 'insc'){
            include './src/pages/inscription.php';
        } elseif ($_GET['ind'] == 'mmdp'){
            include './src/pages/modif_mdp.php';
        } elseif ($_GET['ind'] == 'info') {
            include './src/pages/info.php';
        } elseif ($_GET['ind'] == 'desc') {
            include './src/pages/descriptif.php';
        }

    ?>
    <footer>
        <ul>
            <li>Contact</li>
            <li><a href="./index.php?ind=msg">Particulier</a></li>
            <li><a href="./index.php?ind=msg">Professionel</a></li>
        </ul>

        <ul>
            <li>Entreprise</li>
            <li><a href="./index.php?ind=info&info=propos">À propos</a></li>
            <li><a href="./index.php?ind=info&info=legales">Mentions légales</a></li>
            <li><a href="./index.php?ind=info&info=politique">Politique de confidentialité</a></li>
        </ul>
        <h1> Springfield </h1>
        <div class="duffbeer">
            <img src="src/img/duff_beer.png">
        </div>

        <p>Tous droits réservés @Springfield - 2022</p>
    </footer>
    <script src="./src/js/popup.js"></script>
    <script src="./src/js/header_connexion.js"></script>
</body>
</html>
