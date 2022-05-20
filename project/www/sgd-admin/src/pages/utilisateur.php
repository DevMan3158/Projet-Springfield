
  <?php
/*include_once dirname(__FILE__) . '/../../../src/class/Pass_Crypt.php';
 echo Pass_Crypt::password("dada");*/


 
 if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
array_key_exists('email', $_SESSION)) {
  
  /*var_dump($_SESSION); Sert à affiché les informations de session
  var_dump($_POST);
  var_dump($_FILES);*/

 include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';


?>

       

 <!--Formulaire pour Users-->

    <div  class="container mt-4"> <!--Début_container-->
    
    
        
    
        <div class="row">
          <div class="col-md-4 mb-5 InfoUse">
            Informations utilisateur :
          </div>
            
            
            
    </div>  <!--Fin_container-->

 


    <form action="./src/exec/add_utilisateurs.php" method="post" >
        <div class="form-row "> <!--Début_row_1-->

        <div class="col-md-4 mb-3">

      <label for="prenom">
         <strong>Login</strong>
      </label>

      <input 
      class="form-control"
      type="text"  
      id="login" 
      placeholder= ""
      value = "<?php  echo $_SESSION['login']; ?>" 
      name = "login" 
      required  
      >
</div>
              <div class="col-md-4 mb-3">

                  <label for="prenom">
                  <strong>Prénom</strong>
                  </label>

                  <input 
                  class="form-control"
                  type="text"  
                  id="prenom" 
                  placeholder= ""
                  value = "<?php  echo $_SESSION['prenom']; ?>" 
                  name = "prenom" 
                  required  
                  >
              </div>

              <div class="col-md-4 mb-3">

                    <label for="nom">
                    <strong>Nom</strong>
                    </label>

                 <input 
                  class="form-control" 
                  
                  type="text"
                  id="nom" 
                  placeholder= ""
                  value="<?php  echo $_SESSION['nom']; ?>" 
                  name = "nom" 
                  required
                  >   

              </div>
              
            <div class="col-md-4 mb-5">

              <label for="email">
              <strong>Identifiant</strong>
              </label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend3">@</span>
                  </div>

                  <input 
                  class="form-control"
                  type="email" 
                  id="email" 
                  value="<?php  echo $_SESSION['email']; ?> "
                  placeholder = ""
                  name = "email" 
                  aria-describedby="inputGroupPrepend3"
                 
                  required
                  >           
                </div>
                
              </div>
           </div><!--Fin_row_1- pattern="[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}
                           [a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)"-->            

              <div class="row"><!--Début_row_2-->
                <div class="col-md-4 mb-5 InfoUse">
                  Modifier le mot de passe :
                </div> 
             </div>   <!--Fin_row_2-->  


        <div class="row"> <!--Début_row_3-->
              <div class="col-md-5 mb-3">   
                <div class="form-group">

                <label for="password">
                <strong>Mot de passe</strong>
                </label>
                <div class="input-group mb-2 mr-sm-2">
                  <input 
                  class="form-control" 
                  type="password"  
                  id="password" 
                  name ="mdp"
                  placeholder="Mot de passe"
                  pattern="{6,}"
                  value= ""
                  
                  >
                  <div class="input-group-append">
                          <div class="input-group-text"><i class="bi bi-eye-slash" id="togglePassword"></i></div>
                      </div>
                  </div>
                  
                </div>
              </div>

              <div class="col-md-5 mb-5">
                <div class="form-group">

                 <label for="password">
                 <strong> Répéter le Mot de passe</strong>
                 </label>
                 <div class="input-group mb-2 mr-sm-2">
                  <input 
                  class="form-control"
                  type="password"             
                  id="password_2" 
                  name ="cfn_mdp"
                  placeholder="Mot de passe..."
                  pattern="{6,}"
                  
                  >
                  <div class="input-group-append">
                          <div class="input-group-text"><i class="bi bi-eye-slash" id="togglePassword_2"></i></div>
                      </div>
                  </div>
                </div>
              </div>

        </div> <!--Fin_row_3-->
          

            
          
        <div class="row"> <!--Début_row_4-->
         <div class="col mb-3 text-center text-left-md">  

           <button 
                  class="btn btn-primary " type="submit">  
                  Valider
          </button>

         </div>
          </div> <!--Fin_row_4-->
    </form>

    <script src="./src/js/utilisateur_password.js"></script>

<div> <!--Fin_Container-->  


 <?php                 } 
 
 else echo '<h1>Page non disponible</h1>';
 
 
 ?>

