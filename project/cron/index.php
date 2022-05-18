<center>WELCOME DAMP (CRON)</center>

<?php
$dir_nom = '.'; // dossier liste (pour lister le repertoir courant : $dir_nom = '.'  --> ('point')
$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
$fichier= array(); // on declare le tableau contenant le nom des fichiers
//$dossier= array(); // on declare le tableau contenant le nom des dossiers

while($element = readdir($dir)) {
	if($element != '.' && $element != '..') {
		if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		//else {$dossier[] = $element;}
	}
}

closedir($dir);

if(!empty($fichier)) {
	sort($fichier);
	echo "\t\t<ul>\n";
		foreach($fichier as $lien){
			if (substr($lien, 0, 1) != "." && $lien != "index.php" && $lien != "config_path.php" && $lien != "config_path.php.example") {
				if($lien != 'phpmyadmin' && $lien != 'phppgadmin' && $lien != 'webgrind') {
					echo "\t\t\t<li><a href=\"$dir_nom/$lien \">$lien</a></li>\n";
				}
			}
		}
	echo "\t\t</ul>";
}
?>
