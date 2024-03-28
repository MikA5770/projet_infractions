<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'infractions</title>
    <link rel="stylesheet" href="../vue/style/style.css">
</head>
<body>
<?php require_once('../vue/header.php'); ?>


<div class="tabInfrac">
<table border="1" class='table_infraction'>
<tr><th>Numéro</th><th>Date</th><th>Immatriculation</th><th>Permis</th><th>Voir plus</th><th>Modifier</th><th>Supprimer  </th>
    </tr>

    <?php
    foreach($lignes as $ligne) {
        echo $ligne; 
    }
    ?>

</table>
</div>
</body>
</html>