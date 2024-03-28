<html>
<head>
<meta charset="utf-8">
<title>Ajout d'une infraction</title>
<link rel="stylesheet" href="../vue/style/style.css">
</head>
<body>
    <?php
     require_once ("header.php");
     require_once ("../modele/infractionDAO.class.php");
     $i = new InfractionDAO();
     $id = $i->getLastId(); ?>
    <form action="../controleur/ajout.php" method="post">

    <section class="ajoutbox">
<div class="ajoutdiv">

<p class="aj">Numéro : <?= $id ?></p>
<p class="aj">Date :</p>
<input class="ajinput" type="text" name="date" placeholder="JJ/MM/AAAA" value="<?=$infraction['date']?>"> 
<p class="aj">Numéro immatriculation : </p>
<input class="ajinput" type="text" name="num_immat" value="<?=$infraction['num_immat']?>">
<p class="aj">Numéro de permis : </p>
<input class="ajinput" type="text" name="num_permis" value="<?=$infraction['num_permis']?>">
<br>



<?= "<label class='mess'>$message</label>" ?>

<p class="aj deltitre">Ajouter des délits :</p>

    <?php
    require_once("../modele/delitDAO.class.php");
    require_once("../modele/delit.class.php");
    $d = new DelitDAO();
    $delits = $d->getAll();
    foreach($delits as $delit){
        echo " <div class='divdelit'>  <input type='checkbox' id='" . $delit->getIdDelit() . "' name='delits[]' value='" . $delit->getIdDelit() . "'/> <label class='d' for='" . $delit->getIdDelit() . "'>" . $delit->getNature() . "</label> </div>  <br>";
    }
    ?>

<br>
<input class="ajoutbutton" type="submit" name="valider" value="Valider">
<input class="ajoutbutton" type="submit" name="annuler" value="Annuler">
</form>
</div>
</section>

</body>
</html>