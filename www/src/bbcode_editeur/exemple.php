<?php
/**
 * exemple en bbcode et son utilisation.
 */
include_once './conversion_bbcode.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- le css pour l'afficheur du bbcode -->
    <link rel="stylesheet" href="style-bbcode.css" />
    <title>Document</title>
</head>
<body>

<!-- afficheur du bbcode deja rempli -->
<figure class="bbcode">
    <button class="bbcode_bold">B</button><button class="bbcode_title">title</button><button class="bbcode_type">&lt;&gt;</button>
    <textarea class="editor_bbcode" readonly>[title]Titre[/title]
test 021 [b]strong[/b].</textarea>
</figure>

<!-- afficheur du bbcode vide -->
<figure class="bbcode">
    <button class="bbcode_bold">B</button><button class="bbcode_title">title</button><button class="bbcode_type">&lt;&gt;</button>
    <textarea class="editor_bbcode"></textarea>
</figure>

<!-- Le JS pour l'afficheur du bbcode -->
<script src="./bbcode.js"></script>

<!-- conversion du bbcode en html -->
<p><?php echo conversion_bbcode("[title]Titre[/title] \n test 021 [b]strong[/b]."); ?></p>
    
</body>
</html>