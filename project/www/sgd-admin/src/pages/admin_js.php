<script type="text/javascript">
    let optionsAdmin = {
        <?php
            $sgbd = connexion_sgbd();
            $res = $sgbd->prepare("SELECT * FROM admin");
            $res->execute();
            $data = $res->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $valueLine) {
                echo '"'.$valueLine['id_admin'].'" : "'.$valueLine['nom_admin'].'",';
            }
        ?>
    };
</script>

<script src="./src/js/admin.js"></script>