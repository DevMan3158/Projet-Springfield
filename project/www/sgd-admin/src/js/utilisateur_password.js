// recupere l'input du premier mot de passe
const password = document.getElementById('password');
// si on clique sur l'oeuil pour afficher ou masquer le mot de passe
document.getElementById('togglePassword').addEventListener('click', (e) => {

    // connaitre le type d'affichage et le modifier
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // choissir l'image selon le type d'affichage
    let img_renove = (type === 'text') ? "bi-eye-slash" : "bi-eye";
    let img_eye = (type === 'text') ? "bi-eye" : "bi-eye-slash";

    // changer l'image (en modifient le nom de la classe)
    e.target.classList.remove(img_renove);
    e.target.classList.add(img_eye);
});

// recupere l'input du premier mot de passe
const password_2 = document.getElementById('show_hide_password_2');
// si on clique sur l'oeuil pour afficher ou masquer le mot de passe
document.getElementById('togglePassword_2').addEventListener('click', (e) => {

    // connaitre le type d'affichage et le modifier
    const type = password_2.getAttribute('type') === 'password' ? 'text' : 'password';
    password_2.setAttribute('type', type);

    // choissir l'image selon le type d'affichage
    let img_renove = (type === 'text') ? "bi-eye-slash" : "bi-eye";
    let img_eye = (type === 'text') ? "bi-eye" : "bi-eye-slash";

    // changer l'image (en modifient le nom de la classe)
    e.target.classList.remove(img_renove);
    e.target.classList.add(img_eye);
});

/**
<div class="input-group mb-2 mr-sm-2">
                      <input 
                        class="form-control" 
                        type="password"  
                        id="show_hide_password_2" />
                      <div class="input-group-append">
                          <div class="input-group-text"><i class="bi bi-eye-slash" id="togglePassword_2"></i></div>
                      </div>
                  </div>

<script src="./src/js/utilisateur_password.js"></script>

*/