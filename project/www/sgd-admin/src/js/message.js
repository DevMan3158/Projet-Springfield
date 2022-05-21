/* variables de la page */
let color_old = "white";
let type_msg = "user";
let msg_default = "";

/**
 * Creation de la date a afficher
 * 
 * @param {string} date de la base de donnees
 * @returns la date string a afficher dans la page
 */
function display_date(date) {
    // creation de la date JS
    var ladate=new Date(Date.parse(date))
    // Retourne la date sous le format (25/5/2022 15H40).
    return ladate.getDate()+"/"+(ladate.getMonth()+1)+"/"+ladate.getFullYear()+" à "+ladate.getHours()+"H"+ladate.getMinutes();
}

/**
 * Creation et affichage du message dans la fenetre.
 * 
 * @param {event} e evenement du javascript 
 */
function load_msg(e) {
    // tableau de donnees post a envoyer
    let values = {
        id: e.target.id.split("_")[1]
    };
    // mettre le fond de la classe display_msg en blanc (dans la liste des messages).
    document.querySelectorAll('.display_msg').forEach(element => {
        element.style.backgroundColor = "white";
    });
    /* envoyer les informations du message sur la page php (l'id) */
    fetch_post("./src/exec/msg_load_exec.php", values).then(function (response) {
        /* si c'est bon, on recupere le tableau des valeurs du message */
        if (response.split("[#json#]")[0] == "true") {
            /* recuperation du tableau avec les valeurs du message */
            let tabUser = JSON.parse(response.split("[#json#]")[1])[0];
            /* modifier l'id des noeuds du message en ajoutent l'id du message */
            document.querySelectorAll('.img_del_msg').forEach(element => {
                element.id = "img_del_msg_"+values.id;
            });
            document.querySelectorAll('.img_env_msg').forEach(element => {
                element.id = "img_env_msg_"+values.id;
            });
            document.querySelectorAll('.img_rep_msg').forEach(element => {
                element.id = "img_rep_msg_"+values.id;
            });

            /* verifier qu'on a un nom de produit */
            display_name_produit(tabUser['nom']);

            /* affiche le message sur la fenetre */
            document.getElementById('msg_from').innerHTML = tabUser['Nom']+ " "+ tabUser['Prenom']+ " ("+ tabUser['Email']+ ").";
            document.getElementById('msg_date').innerHTML = display_date(tabUser['date_msg'])+".";
            document.getElementById('msg_produit').innerHTML = tabUser['nom']+".";
            document.getElementById('msg_obj').innerHTML = tabUser['Objet']+".";
            document.getElementById('msg_txt').innerHTML = tabUser['Message'].replaceAll("\n", '<br />');

            /* prepare le message dans le modal, pour la reponse */
            msg_default = "\n\n\n\n\n";
            msg_default += "------------------------------------------------------------------\n";
            msg_default += "De : "+document.getElementById('msg_from').innerHTML+"\n";
            msg_default += "le : "+document.getElementById('msg_date').innerHTML+"\n";
            /* si on a un nom de produit */
            if(document.getElementById('env_msg_produit').style.display != "none") {
                msg_default += "produit : "+document.getElementById('msg_produit').innerHTML+"\n";
            }
            msg_default += "Objet : "+document.getElementById('msg_obj').innerHTML+"\n\n";
            msg_default += tabUser['Message'];
            document.getElementById('env_msg_from').innerHTML = document.getElementById('msg_from').innerHTML;
            document.getElementById('env_msg_date').innerHTML = document.getElementById('msg_date').innerHTML;
            document.getElementById('env_msg_produit').innerHTML = document.getElementById('msg_produit').innerHTML;
            document.getElementById('env_msg_obj').innerHTML = document.getElementById('msg_obj').innerHTML;
            document.getElementById('env_msg_txt').innerHTML = msg_default;

            /* change l'image du message dans la liste, pour signaler qu'il a ete lut */
            document.getElementById('img_msg_'+values.id).src = "./src/img/document.svg";

            /* pour la version mobile, indiquer la lecture d'un message */
            document.getElementById('txt_mobile').checked = true;

            /* si c'est la premiere fois qu'on lit le message */
            if(e.target.classList.contains('display_msg_no_lu')) {
                /* changer la valeur de sa classe */
                e.target.classList.remove("display_msg_no_lu");
                e.target.classList.add("display_msg_lu");
            }
            /* change la couleur de fond dans la liste pour signaler qu'on lit ce message */
            e.target.style.backgroundColor = "#b1e6ff";
            /* conserve la couleur pour le hover */
            color_old = e.target.style.backgroundColor;
        } else {
            alert(response);
        }
    });
}

/**
 * Si le nom de produit est null, on ne l'affiche pas.
 * 
 * @param {string} name le nom du produit.
 */
function display_name_produit(name) {
    if(name == undefined || name == "null" || name == "Null" || name == "NULL") {
        document.getElementById('label_msg_produit').style.display = "none";
        document.getElementById('msg_produit').style.display = "none";
        document.getElementById('label_env_msg_produit').style.display = "none";
        document.getElementById('env_msg_produit').style.display = "none";
    } else {
        document.getElementById('label_msg_produit').style.display = "unset";
        document.getElementById('msg_produit').style.display = "unset";
        document.getElementById('label_env_msg_produit').style.display = "unset";
        document.getElementById('env_msg_produit').style.display = "unset";
    }
}

/**
 * Les messages apres une recherche
 * 
 * @param {event} e evenement du javascript 
 */
function bt_find(e) {
    // pour ne pas prendre l'adresse de l'action du formulaire.
    e.preventDefault();
    // vide la liste de message
    document.getElementById("list-msg").innerHTML = "";
    /* envoyer les informations du message sur la page php a partir d'un formulaire */
    fetch_form("./src/exec/msg_find_load.php?type="+type_msg, "form_find").then(function (
      response
    ) {
        /* si c'est bon, on recupere le tableau des valeurs de la liste des messages */
        if (response.split("[#json#]")[0] == "true") {
            /* masquer les messages */
            document.getElementById("msg").style.display = "none";
            /* recuperation du tableau avec la liste de message */
            let tabUser = JSON.parse(response.split("[#json#]")[1]);
            let i = 0;
            /* remplir la liste des messages */
            tabUser.forEach(valueLine => {
                let img_no_lu = "enveloppe.svg";
                let msg_no_lu = "display_msg_no_lu";
                if(valueLine['lu'] == "1") {
                    img_no_lu = "document.svg";
                    msg_no_lu = "display_msg_lu";
                }
                let line = '<li class="list-group-item display_msg text-left '+
                    msg_no_lu+'" id="msg_'+valueLine['Id_msg']+'">';
                line += '<img id="img_msg_'+valueLine['Id_msg']+
                    '" src="./src/img/'+img_no_lu+'" /> ';
                line += valueLine['Objet'];
                line += '</li>';
                /* afficher sur la page */
                document.getElementById("list-msg").innerHTML += line;
            });
            /* activer le clique sur la liste */
            msg_create_click();
            /* afficher lles messages, si elle n'est pas vide */
            message_vide();
        } else {
            alert(response);
        }
    });
}

/**
 * Creation du clique sur la liste de message
 */
function msg_create_click() {
    /* parcoure la liste et active le clique */
    document.querySelectorAll('.display_msg').forEach(element => {
        element.addEventListener("click", load_msg);
        /* si la sourie entre dans le bouton du message */
        element.addEventListener("mouseover",function(){
            color_old = element.style.backgroundColor;
            element.style.backgroundColor = "#FFF500";
        });
        /* si la sourie sort du bouton du message */
        element.addEventListener("mouseout",function(){
            element.style.backgroundColor = color_old;
        });
    });
}

/**
 * Initialiser le message avec les valeurs par defaut.
 * 
 * @param {event} e evenement du javascript 
 */
function init_values(e) {
    /* vide les donnees du message */
    document.getElementById('msg_from').innerHTML = "";
    document.getElementById('msg_date').innerHTML = "";
    document.getElementById('msg_obj').innerHTML = "";
    document.getElementById('msg_produit').innerHTML = "";
    document.getElementById('env_msg_from').innerHTML = "";
    document.getElementById('env_msg_date').innerHTML = "";
    document.getElementById('env_msg_obj').innerHTML = "";
    document.getElementById('env_msg_produit').innerHTML = "";
    document.getElementById('env_msg_txt').innerHTML = "";
    document.getElementById('msg_txt').innerHTML = "";
    document.getElementById('recherche').value = "";
    display_name_produit(undefined);
    msg_default = "";
    /* renomme les id de la page message par les valeurs par defaut */
    document.querySelectorAll('.img_del_msg').forEach(element => {
        element.id = "img_del_msg";
    });
    document.querySelectorAll('.img_env_msg').forEach(element => {
        element.id = "img_env_msg";
    });
    document.querySelectorAll('.img_rep_msg').forEach(element => {
        element.id = "img_rep_msg";
    });
    /* desactive la version lecture du mobile et revient a la liste */
    document.getElementById('txt_mobile').checked = false;
}

/**
 * Pour la suppression d'un message.
 * 
 * @param {event} e evenement du javascript 
 */
function delete_msg(e) {
    // verifier qu'on a bien ouvert un message
    if(e.target.id.split("_")[3] != undefined) {
        // demande la confirmation de la suppression
        let isExecuted = confirm("Attention vous allez supprimer le message. 'Ok' pour continuer.");
        if(isExecuted) {
            // tableau de donnees post a envoyer
            let values = {
                id_msg: e.target.id.split("_")[3],
            };
            /* envoyer les informations du message sur la page php (l'id) */
            fetch_post("./src/exec/msg_delete_exec.php", values).then(function (response) {
                if(response == "true") {
                    /* on retire le message de la liste */
                    document.getElementById('msg_'+values.id_msg).remove();
                    /* on vide le contenu du message */
                    init_values(e);
                } else {
                    alert(response);
                }
            });
        }
    }
    //init_values(e);
}

/**
 * Pour afficher la fenetre de reponse
 * 
 * @param {event} e evenement du javascript 
 */
function repondre_msg(e) {
    // verifier qu'on a bien ouvert un message
    if(e.target.id.split("_")[3] != undefined) {
        // afficher la fenetre de reponse
        document.getElementById('modalOne').style.display = "block";
    }
}

/**
 * Pour envoyer une reponse
 * 
 * @param {event} e evenement du javascript
 */
function envoyer_msg(e) {
    /* envoyer les informations du message sur la page php */
    fetch_form('./src/exec/envoyer_msg.php?id_msg='+e.target.id.split("_")[3], 'modal-form').then(function(response) {
        /* si tout c'est bien passe */
        if(response == "true") {
            /* vider le contenu du message sur la page */
            document.getElementById('env_msg_txt').innerHTML = msg_default;
            /* fermer la fenetre modal */
            document.getElementById('modalOne').style.display = "none";
            alert("Le message a été envoyé.");
        } else {
            alert(response);
        }
    });
}

/**
 * Si on change la selection (du gestion a l'administration)
 */
document.querySelectorAll('#select_type_msg').forEach(element => {
    element.addEventListener("change", function(e) {
        /* on vide le contenu du message */
        init_values(e);
        /* on modifit la liste */
        type_msg = document.getElementById("select_type_msg").value;
        bt_find(e);
    });
});

/* activer le clique des boutons */
msg_create_click();

/* activer le clique sur les boutons */
document.getElementById("bt_find").addEventListener("click", bt_find);

document.getElementById("return-list").addEventListener("click", function(e) {
    /* pour sortir du mode lecture du message sur mobile */
    document.getElementById('txt_mobile').checked = false;
});

document.querySelectorAll('.img_del_msg').forEach(element => {
    element.addEventListener("click", delete_msg);
});

document.querySelectorAll('.img_rep_msg').forEach(element => {
    element.addEventListener("click", repondre_msg);
});

document.querySelectorAll('.img_env_msg').forEach(element => {
    element.addEventListener("click", envoyer_msg);
});

/* active le modal */
modal();

function message_vide() {
    let nbmessage = 0;
    document.getElementById("list-msg").querySelectorAll('li').forEach(element => {
        nbmessage++;
    });
    if(nbmessage == 0) {
        document.getElementById("msg").style.display = "none";
        document.getElementById("no_list").style.display = "unset";
    } else {
        document.getElementById("msg").style.display = "grid";
        document.getElementById("no_list").style.display = "none";
    }
}

message_vide();

