<?php

// verifier que la constante variable "CHMDP_Y" a ete definie (une constante du fichier).
if(!defined("CHMDP_Y")) {
    // duree de validite pour le changement du mot passe
    define('CHMDP_Y', '0'); // Duree de validite pour le changement du mot de passe en annee.
    define('CHMDP_M', '0'); // Duree de validite pour le changement du mot de passe en mois.
    define('CHMDP_D', '0'); // Duree de validite pour le changement du mot de passe en jour.
    define('CHMDP_H', '12'); // Duree de validite pour le changement du mot de passe en heure.
    define('CHMDP_I', '0'); // Duree de validite pour le changement du mot de passe en minute.
    define('CHMDP_S', '0'); // Duree de validite pour le changement du mot de passe en seconde.
}
