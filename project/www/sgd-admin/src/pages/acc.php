<h1 class="text-center text-body">Accueil</h1>

<!--Formulaire connexion-->
<form class="form-inline justify-content-center">
  <label class="sr-only" for="inlineFormInputName2">Nom</label>
  <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

  <label class="sr-only" for="inlineFormInputGroupUsername2">Identifiant</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text">@</div>
    </div>
    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Identifiant">
  </div>

  <div class="form-check mb-2 mr-sm-2">
    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
    <label class="form-check-label" for="inlineFormCheck">
      Se souvenir de moi 
    </label>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Connexion</button>
</form>
  


<!--Ajout-Image-->

<div class="container-fluid bg-light ">

    <div class="row">
        <div class="col">
            <form>
                <div class="form-group text-center">
                    <label for="exampleFormControlFile1 "></label>
                    <input type="file" class="drop_img" id="exampleFormControlFile1" accept="image/png, image/jpeg">
                    
                    <figure class="figure">
                        <img src="..." class="figure-img img-fluid rounded" alt="...">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                    </figure>

                </div>
            </form>
       
        </div>
    
    
        <div class="col">
        <form id="form_1" class="form_active">
          <input type="File" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpeg" />

          <figure id="all_img"><img id="img-add" alt="ajouter une image" title="Ajout d'image" src="./../img/icons8-ajouter-80_1.svg" />
            <figure id="add_img" class="drop_img"></figure></figure>
        </div>

   </div>

</div>


<div class="container-fluid bg-light ">
    <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
    </div>
</div>

<!--Pagination
<nav aria-label="Page navigation example ">
  <ul class="pagination justify-content-center ">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>-->