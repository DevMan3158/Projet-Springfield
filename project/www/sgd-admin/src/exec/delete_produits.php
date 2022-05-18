<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Êtes-vous sur?</title>
</head>
<body style="background-color:#343a40; padding:10px;">

    <h1 style="color:white; margin:auto; border:solid white 2px; width:fit-content; padding:10px; border-radius:10px;"> Êtes vous sur ? </h1>
    <a href="#" onClick= "window.opener.location.href='../../index.php?ind=produit&id_delete=<?php echo $_GET['id_delete'] ?>'; location.reload(); window.close()">
        <img src="../img/valider.png" alt="Valider"  style="width:100px;">
    </a>
    <a href="#" onClick="window.close();">
        <img src="../img/refuser.png" alt="Refuser"  style="width:100px;">
    </a>


</body>
</html>



