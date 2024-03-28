<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vue/style/style.css">
    <title>Importer une infraction</title>
</head>
<body>
    <?php
     session_start();
     error_reporting(E_ALL); ini_set("display_errors", 1);
     require_once ("../vue/header.php"); ?>
<section class="ajoutbox">
<div class="ajoutdiv">
  
<form action="../controleur/import.php" method="post" enctype="multipart/form-data">
    <input class="inputfile" type="file" id="fileInput" name="fileInput"> <br>
    <?php echo isset($fichier) ? "<label class='messimport'>Nom du fichier : " . $fichier . "</label>" : ""; ?> <br>
    <?php echo isset($message) ? "<label class='messimport'>" . $message . "</label>" : ""; ?> <br>
    <input class="boutonsupp" type="submit" name="importer" value="Importer">
    <input class="boutonsupp" type="submit" name="annuler" value="Annuler"><br>
</form>
</div>
</section>



</body>
</html>