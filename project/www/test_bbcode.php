<?php
include_once './src/fonctions/conversion_bbcode.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style-bbcode.css" />
    <title>Document</title>
</head>
<body>

<figure class="bbcode">
    <button class="bbcode_bold">B</button><button class="bbcode_title">title</button><button class="bbcode_type">&lt;&gt;</button>
    <textarea class="editor_bbcode" readonly></textarea>
</figure>

<figure class="bbcode">
    <button class="bbcode_bold">B</button><button class="bbcode_title">title</button><button class="bbcode_type">&lt;&gt;</button>
    <textarea class="editor_bbcode"></textarea>
</figure>

<script src="./src/js/bbcode.js"></script>

<p><?php echo conversion_bbcode('test 021 [b]strong[/b] and [title]Titre[/title].'); ?></p>
    
</body>
</html>