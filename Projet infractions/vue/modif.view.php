<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../vue/style/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body>
    <?php 
    require_once ("../vue/header.php");
    $id_infraction = isset($_GET['id_inf']) ? $_GET['id_inf'] : null;
    $date = isset($_GET['date']) ? $_GET['date'] : null;



    ?>
<section class="contenant">
<div class="information">

    <p class="info">Numéro d'infraction : <?= $id_infraction?></p> 
    <p class="info">Date d'infraction : <?= $date?></p> 
    <p class="info"></p>

    <form action="modif.php" method="post">
    <label class="info">Numéro d'immatriculation :</label>
    <input class="login" type="text" value="<?= $modifInf['numI'] ?>" name="numI"> <br>
    
    <label class="info">Numéro de permis :</label>
    <input class="login" type="text" value="<?= $modifInf['numP'] ?>" name="numP"><br>

    <?php echo "<label class='mess'>" . $message . "</label>" ?>

    <p class="info deltitre">Modifier des délits :</p>

    <?php
    require_once("../modele/delitDAO.class.php");
    require_once("../modele/delit.class.php");
    $d = new DelitDAO();
    $delits = $d->getAll();
    $tabNonDelit = $d->getNonDelit($id);
    $tabIdDelit = [];
    foreach($tabNonDelit as $objet){
        $tabIdDelit[] = $objet->getIdDelit();
    }
    foreach($delits as $delit){
        $i = 0;
        if(in_array($delit->getIdDelit(), $tabIdDelit)){
            echo " <div class='divdelit'>  <input type='checkbox' id='" . $delit->getIdDelit() . "' name='delits[]' value='" . $delit->getIdDelit() . "'/> <label class='d' for='" . $delit->getIdDelit() . "'>" . $delit->getNature() . "</label> </div>  <br>";
        }else{
            echo " <div class='divdelit'>  <input type='checkbox' id='" . $delit->getIdDelit() . "' name='delits[]' value='" . $delit->getIdDelit() . "' checked/> <label class='d' for='" . $delit->getIdDelit() . "'>" . $delit->getNature() . "</label> </div>  <br>";
        }
        $i = $i+1;
    }
    ?>


    <input class="modifbutton" type="submit" value="Valider" name="valider">
    <input class="modifbutton" type="submit" value="Annuler" name="annuler">

    </form>
</div>
</section>
</body>
</html>