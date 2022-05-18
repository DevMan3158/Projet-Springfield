
  <?php
 /*include_once dirname(__FILE__) . '/../../../src/class/Pass_Crypt.php';
 echo Pass_Crypt::password("code");*/
  
  var_dump($_SESSION); /*Sert à affiché les informations de session*/
  var_dump($_POST);
  var_dump($_FILES);


  
  include_once dirname(__FILE__) . '/../../../src/fonctions/connexion_sgbd.php';

  /*if (!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && 
  array_key_exists('id_admin', $_SESSION) && array_key_exists('nom', $_SESSION) && 
  array_key_exists('prenom', $_SESSION) && array_key_exists('login', $_SESSION) && 
  array_key_exists('email', $_SESSION));*/

    //On démarre une nouvelle session
   /* session_start();*/ 
    /*On utilise session_id() pour récupérer l'id de session s'il existe.
     *Si l'id de session n'existe  pas, session_id() renvoie une chaine
     *de caractères vide*/
    /*$id_session = session_id();*/

   /* if($id_session){
    echo 'ID de session (récupéré via session_id()) : <br>'
    .$id_session. '<br>';
    }
    echo '<br><br>';
    if(isset($_COOKIE['PHPSESSID'])){
        echo 'ID de session (récupéré via $_COOKIE) : <br>'
        .$_COOKIE['PHPSESSID'];
    
    }*/
?>



  <!--Formulaire pour Users-->

        
  <div  class="container">   <!--Début_container-->
        
        <div class="row ">
            <div class="col-md-4 mb-5  InfoUse">
                Avatar :   
            </div>
       </div>
       <div class="row">
                <div class="col">


                        <div class="form-group text-center">
                        
                            <label for="exampleFormControlFile1 "></label>
                        
                            <form action="" method="post" enctype="multipart/form-data" >
                            
                                <input type="file" class="drop_img" id="file" name="file" accept="image/png, image/jpeg" />
                                <img id="add-img" src="/project/www/sgd-admin/src/img/add_image_user.svg" alt="Ajouter une image&nbsp;" />

                               <button type="submit" class="btn btn-light"><i class="bi bi-image-alt"></i> Valider</button>
                           </form>
                           <script>/*
                            Recuperation d'une image pour l'afficher sur le html
                            event (event) : evenement d'ecoute
                            */
                            function loadFiles(event) {
                                // on recupere la liste des fichiers
                                let files = event.target.files;
                                // Ou visualiser l'image qui sera telecharge
                                let preview = document.getElementById("add-img");
                                // une boucle sur les fichiers telecharges
                                for (var i = 0; i < files.length; i++) {
                                    // recuperation du fichier
                                    var file = files[i];
                                    // le type du fichier
                                    var imageType = /^image\//;
                              
                                    // verifier qu'on a bien une image, sinon on n'affiche rien.
                                    if (!imageType.test(file.type)) {
                                        continue;
                                    }
                            
                                    // on vide l'image par defaut et on ajoute le fichier
                                    preview.src = "";
                                    preview.file = file;
                            
                                    // ici on affiche l'image sur la page html (ne surtout pas le supprimer).
                                    var reader = new FileReader();
                                    reader.onload = (function(aImg) {
                                        return function(e) { 
                                            aImg.src = e.target.result;
                                            };
                                    })(preview);
                                    reader.readAsDataURL(file);
                                }
                            }
                            
                            /*
                            ajouter une image dans le telechargement
                            */
                            function img_add() {
                                document.getElementById('file').click();
                            }
                            
                            // en cas de changement de fichier (ici d'image)
                            document.getElementById('file').addEventListener('change', loadFiles);
                            // quand on clique sur le bouton pour ajouter une image
                            document.getElementById('add-img').addEventListener('click', img_add);</script>
                       
                        </div>
                    
                    
                </div>
    

            </div>

</div> 




<div  class="container mt-4">   <!--Début_container-->


    

    <div class="row">
      <div class="col-md-4 mb-5 InfoUse">
        Informations utilisateur :
      </div>

     

</div>  <!--Fin_container-->

 


    <form action="./src/exec/add_utilisateurs.php" method="post" >
        <div class="form-row "> <!--Début_row_1-->

        
              <div class="col-md-4 mb-3">

                  <label for="prenom">
                     Prénom
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
                    Nom
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
               Identifiant
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
                    Mot de passe
                </label>
                  <input 
                  class="form-control" 
                  type="password"  
                  id="password" 
                  name ="mdp"
                  placeholder="Mot de passe"
                  pattern="{6,}"
                  value= ""
                  
                  >
                  
                </div>
              </div>

              <div class="col-md-5 mb-5">
                <div class="form-group">

                 <label for="password">
                   Répéter le Mot de passe
                 </label>
                  <input 
                  class="form-control"
                  type="password"             
                  id="password" 
                  name ="cfn_mdp"
                  placeholder="Mot de passe..."
                  pattern="{6,}"
                  
                  >
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



<div> <!--Fin_Container-->  


