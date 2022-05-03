function valider(e) {
    let regexTextValide = /^.{3,}$/;
    let login = document.getElementById("login").value;
    let password_user = document.getElementById("password_user").value;
    if(regexTextValide.test(login) && regexTextValide.test(password_user)) {
        let dataArray = {
            "login" : login,
            "password_user" : password_user
        };
        fetch_post('./../exec/connexion_exec.php', dataArray).then(function(response) {
            if(response == "1") {
                console.log("connexion réussi.");
                window.opener.location.href = "./../../index.php";
                window.close();
            } else if(response == "2") {
                alert("Il manque des informations pour vous connecter.");
            }
            console.log(response);
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

document.getElementById("valider").addEventListener("click", valider);
document.getElementById("annuler").addEventListener("click", annuler);
document.getElementById("pass_perdu").addEventListener("click", pass_perdu);
