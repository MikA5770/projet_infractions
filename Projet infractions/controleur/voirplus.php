<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vue/style/style.css">
    <title>Voir en détails</title>
</head>
<body>
    
    
    
<?php 
session_start();
$idMaSession = session_id();

require_once('../vue/header.php');

require_once ("../modele/infractionDAO.class.php");
require_once ("../modele/conducteurDAO.class.php");
require_once ("../modele/vehiculeDAO.class.php");
require_once ("../modele/comprendDAO.class.php");
require_once ("../modele/delitDAO.class.php");
error_reporting(E_ALL); ini_set("display_errors",1);

$id_inf = (isset($_GET['id_inf'])?$_GET['id_inf']:null);

$infractionDAO = new InfractionDAO();
$conducteurDAO = new ConducteurDAO();
$vehiculeDAO = new VehiculeDAO();
$delitDAO = new DelitDAO();

$infraction = $infractionDAO->getByNum($id_inf);
$num_immat = $infraction->getNumImmat();
$vehicule = $vehiculeDAO->getByNum($num_immat);
$num_permis = $infraction->getNumPermis();
$delits = $delitDAO->getDelitByInf($id_inf);

$conducteur = $conducteurDAO->getByNum($num_permis);

if($infraction->getNumPermis() == ""){
    $nom = "Inconnu, numéro de permis inexistant";
    $prenom = "Inconnu, numéro de permis inexistant";
} else{
    $nom = $conducteur->getNom();
    $prenom = $conducteur->getPrenom();
}


$marque = $vehicule->getMarque();
$modele = $vehicule->getModele();
$date_immat = $vehicule->getDateImmat();
?>
<form action="" method="post">
<input class="retour" type="submit" name="retour" value="Retour">
</form>
<section class="contenant">
    <div class="information">
        
        <?php

if(isset($_POST['retour'])){
    header ('location: infractions.php');
}

echo "<p class='info inf'>Voici le détail de l'infraction : $id_inf </p> ";

echo "<p class='info'>Nom : $nom</p>";
echo "<p class='info'>Prénom : $prenom</p>";
echo "<p class='info'>Marque du véhicule : $marque</p>";
echo "<p class='info'>Modèle du véhicule : $modele</p>";
echo "<p class='info'>Date d'immatriculation : $date_immat</p>";
echo "<p class='info'>Délits :</p>";
foreach($delits as $delit){
    echo "<p class='info delit'>- " . $delit->getNature() . " ~ Tarif : " . $delit->getTarif() . "€</p>";
}
?>
</div>
</section>

</body>
</html>