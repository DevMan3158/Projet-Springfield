<h1 class="text-center">Adminstration</h1>


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






<!--Formulaire pour intégré User-->
<h1>Rajouter ou modifié un utilisateur</h1>
<form>
  <div class="form-row ">
    <div class="col-md-4 mb-3">
      <label for="validationServer01">Prénom</label>
      <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="Mark" required>
      <div class="valid-feedback">
        Parfait!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Nom</label>
      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="" required>
      <div class="valid-feedback">
      Parfait!!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServerUsername">Identifiant</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend3">@</span>
        </div>
        <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Identifiant" aria-describedby="inputGroupPrepend3" required>
        <div class="invalid-feedback">
          Choisir un Identifiant.
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationServer03">Ville</label>
      <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="City" required>
      <div class="invalid-feedback">
      Choisir une ville.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationServer04">Département</label>
      <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="State" required>
      <div class="invalid-feedback">
      Choisir un département.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationServer05">Code postal</label>
      <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check ">
      <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
      <label class="form-check-label" for="invalidCheck3">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit">Submit form</button>
</form>


<!--Table-->
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
<!--Pagination-->
<nav aria-label="Page navigation example ">
  <ul class="pagination justify-content-center ">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>