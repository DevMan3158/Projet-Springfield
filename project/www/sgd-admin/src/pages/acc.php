<!--<style>
div .row .col
{
    border : solid 1px black; 
}
</style>-->

<?php 
 if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
 array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
 array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
 array_key_exists('email', $_SESSION)) {  
     
?>

    <div  class="container-fluid">

        <div class="Container-fluid-Modif">

            <div class="row">
                <div class="col"> 
             <h1 class="text-center text-body">Bienvenue sur la page d'Accueil !</h1>
             </div>
            </div>


        </div>



    <div>
    

    
    <?php 
    
} 
 
else echo '<h1>Page non disponible</h1>';


?>



