<?php

// les donnees pour le message
$classmsg = "msg_valide";

$message = "";
$error_sgbd = "Une erreur s'est produite lors du téléchargement de la page, désolé pour ce désagrément.";

$form_name = "";
$form_prenom = "";
$form_email = "";
$form_msg = "";

?>
<section>
<p id="section_contact_info">PRENDRE RENDEZ-VOUS</p>
      <br />
      <h5 id="section_contact_title">
        Contactez-nous <br />
        pour réserver au restaurant
      </h5>
      <br />
      <figure id="form_contact">
        <form id="form_inform" action="./#section_contact" method="post">
          <p id="form_title">Formulaire de contact</p>
          <p>
            Remplissez le formulaire ci-dessous<br />
            pour nous contacter
          </p>
          <div class="user_name">
            <label>Nom</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z '-]{3,}" placeholder="Nom" value="<?php echo $form_name ?>" required />
          </div>
          <div class="user_name" id="name_2">
            <label>Prénom</label>
            <input
              type="text"
              id="first_name"
              name="first_name"
              placeholder="Prénom"
              pattern="[A-Za-z '-]{3,}"
              value="<?php echo $form_prenom ?>"
              required
            />
          </div>
          <label>Adresse e-mail</label>
          <input
            type="email"
            id="mail"
            name="mail"
            placeholder="monAdresseMail@gmail.com"
            pattern="[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)"
            value="<?php echo $form_email ?>"
            required
          />
          <label>Message</label>
          <textarea
            id="user_text"
            name="user_text"
            pattern=".{8,}"
            placeholder="Votre message/demande de réservation"
            required
          ><?php echo $form_msg ?></textarea>
            <div class="text_center">
                <button id="button_form" class="button_bleu" type="sumit">
                  <img
                    src="src/img/bouton_formulaire_coche.svg"
                    alt="image pour cocher le formulaire"
                  />&nbsp;&nbsp;Envoyer
                </button>
          </div>
        </form>

        <div id="form_image">
          <img
            src="src/imgs/illustration_formulaire.jpg"
            alt="la photo d'un plat"
          />
        </div>
      </figure>
</section>