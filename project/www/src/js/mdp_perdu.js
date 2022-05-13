function valider(e) {
    let regexTextValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    let email = document.getElementById("email").value;
    if(regexTextValide.test(email)) {
        let dataArray = {
            "email" : email
        };
        fetch_post('./../exec/mdp_perdu_email_exec.php', dataArray).then(function(response) {
            if(response == "true") {
                alert("Vous avez reçu un email, pour modifier le mot de passe.");
                window.opener.location.href = "./../../index.php";
                window.close();
            } else {
                alert(response);
            }
        });
    } else {
        console.log("Les informations sont vides, vous ne pouvez pas vous connecter.");
    }
}

function annuler(e) {
    window.close();
}

function pass_perdu(e) {

}

document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    valider(event);
  }
});

document.getElementById("valider").addEventListener("click", valider);
document.getElementById("annuler").addEventListener("click", annuler);
document.getElementById("pass_perdu").addEventListener("click", pass_perdu);
