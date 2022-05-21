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
const password_2 = document.getElementById('password_2');
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

/* le formulaire de l'utilisateur */
function formulaire(e) {
    // pour ne pas prendre l'adresse de l'action du formulaire.
    e.preventDefault();
    /* envoyer les informations du message sur la page php */
    fetch_form('./src/exec/add_utilisateurs.php', 'form-user').then(function(response) {
        /* si tout c'est bien passe */
        if(response == "true") {
            //alert("Enregistrement effectué.");
        } else {
            if(!alert(response)) {
                location.reload();
            }
        }
    });
}

/* activer le clique sur les boutons */
document.getElementById("valide_user").addEventListener("click", formulaire);
