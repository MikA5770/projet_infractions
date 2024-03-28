<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../vue/style/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression</title>
</head>
<body>
    <?php require_once ("../vue/header.php");?>
<section class="contenant">
<div class="supp">


    <p class="info">Voulez-vous vraiment supprimer l'infraction <?php
    $id = (isset($_GET['id_inf'])?$_GET['id_inf']:null);
    echo $id;?> ?</p>
    <form method='post'> 
        <input class="boutonsupp" type='submit' name='supp' value='Supprimer'>
    	<input class="boutonsupp" type='submit' name='annuler' value='Annuler'> 
    </form>
</div>
</section>
</body>
</html>