<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./../css/style-connexion.css" />
        <title>Springfiled : connexion</title>
    </head>
    <body>
        <section id="connexion">
            <label>Login</label>
            <input type="text" name="login" id="login" />
            <label>Mot de passe</label>
            <input type="password" name="password_user" id="password_user" autocomplete="on" />
            <a href="#" id="pass_perdu">Mot de passe perdu</a>
            <figure>
                <button type="sumit" id="valider" class="button button_jaune">Valider</button>
                <button type="sumit" id="annuler" class="button button_gris">Annuler</button>
            </figure>
        </section>
        <script src="./../js/le_fetch.js"></script>
        <script src="./../js/connexion.js"></script>
    </body>
</html>