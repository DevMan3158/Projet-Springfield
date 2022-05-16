function valider(e) {
    let regexTextValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    let email = document.getElementById("email").value;
    if(regexTextValide.test(email)) {
        let dataArray = {
            "email" : email
        };
        fetch_post('./../exec/mdp_perdu_email_exec.php', dataArray).then(function(response) {
            if(response == "true") {
                document.getElementById('modal-msg').innerText = "Vous avez reçu un email, pour modifier le mot de passe.";
                document.getElementById('modalOne').style.display = "block";
                document.querySelectorAll(".close").forEach(function (btn) {
                    btn.onclick = function (event) {
                        event.preventDefault();
                        let modal = btn.closest(".modal");
                        modal.style.display = "none";
                        window.opener.location.href = "./../../index.php";
                        window.close();
                    };
                  });
            } else {
                document.getElementById('modal-msg').innerText = response;
                document.getElementById('modalOne').style.display = "block";
            }
        });
    } else {
        document.getElementById('modal-msg').innerText = "Les informations sont vides, vous ne pouvez pas vous connecter.";
        document.getElementById('modalOne').style.display = "block";
    }
}

function annuler(e) {
    window.close();
}

document.body.addEventListener("keydown", (event) => {
  if (event.key == "Enter") {
    valider(event);
  }
});

document.getElementById("valider").addEventListener("click", valider);
document.getElementById("annuler").addEventListener("click", annuler);

function passDispNo(e) {
    e.target.parentNode.querySelectorAll(".passDisp").forEach(element => {
        if(element.type == "password") {
            e.target.alt = "mot de passe afficher";
            e.target.src = "./src/img/oeil.svg";
            element.type = "text";
        } else {
            e.target.alt = "mot de passe cacher";
            e.target.src = "./src/img/les-yeux-croises.svg";
            element.type = "password";
        }
    });
}

document.querySelectorAll(".passBtt").forEach(element => {
    element.addEventListener("click", passDispNo);
});

modal();