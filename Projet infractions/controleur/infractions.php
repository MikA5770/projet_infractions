<?php
session_start();
$idMaSession = session_id();
error_reporting(E_ALL); ini_set("display_errors",1);
require ("../modele/connexion.php");
require ("../modele/delit.class.php");
require ("../modele/delitDAO.class.php");
require ("../modele/conducteur.class.php");
require ("../modele/conducteurDAO.class.php");
require ("../modele/Infraction.class.php");
require ("../modele/InfractionDAO.class.php");
require ("../modele/Comprend.class.php");
require ("../modele/ComprendDAO.class.php");
require ("../modele/Vehicule.class.php");
require ("../modele/VehiculeDAO.class.php");
require_once('../modele/infractionDAO.class.php');
$conducteurDAO = new ConducteurDAO();
$conducteur = $conducteurDAO->getByNum($_SESSION['id']);

$infractionDAO = new InfractionDAO();
$lesInfractionsAdmin = $infractionDAO->getAll();
$lesInfractionsConducteur = $infractionDAO->getDelitByInf($_SESSION['id']);
$lignes	= [];

if($conducteurDAO->existeConducteur($_SESSION['id'], $_SESSION['mdp']) && $conducteur->getIsAdmin() == 1){
	
	
	foreach($lesInfractionsAdmin as $uneInfraction)
	{
		$ch = '';
	
		$ch .='<td>' .$uneInfraction->getIdInf() . '</td>';
		$ch .='<td>' .$uneInfraction->getDateInf() . '</td>';
		$ch .='<td>' .$uneInfraction->getNumImmat() . '</td>';
		$ch .='<td>' .$uneInfraction->getNumPermis() . '</td>';
		$ch .='<td> <a href="voirplus.php?id_inf='. urlencode($uneInfraction->getIdInf()) .'"> <img class="action" src="../vue/style/voir.png" style="width:30px; height:30px;"> </a></td>';
		$ch .= '<td> <a href="modif.php?id_inf=' . urlencode($uneInfraction->getIdInf()) . '&date=' . urlencode($uneInfraction->getDateInf()) . '"> <img class="action" src="../vue/style/modifier.png" style="width:30px; height:30px;"> </a></td>';
		$ch .='<td> <a href="supp.php?id_inf='. urlencode($uneInfraction->getIdInf()) .' "> <img class="action" src="../vue/style/supprimer.png" style="width:30px; height:30px;"></a> </td>';
		
		$lignes[] = "<tr>$ch</tr>";
	}
	
	unset($lesInfractionsAdmin);
	require_once('../vue/infractions.view.php');
	echo 
	"<section class='ajoutsection'>
	<div class='ajout'>
	<a href='../controleur/ajout.php' class='boutonsupp'>Ajouter une infraction</a>
	<a href='../controleur/import.php' class='boutonsupp'>Importer</a>
	</div>
	</section>";

} else if ($conducteurDAO->existeConducteur($_SESSION['id'], $_SESSION['mdp']) && $conducteur->getIsAdmin() == 0){

	foreach($lesInfractionsConducteur as $uneInfraction)
	{
		$ch = '';
	
		$ch .='<td>' .$uneInfraction->getIdInf() . '</td>';
		$ch .='<td>' .$uneInfraction->getDateInf() . '</td>';
		$ch .='<td>' .$uneInfraction->getNumImmat() . '</td>';
		$ch .='<td>' .$uneInfraction->getNumPermis() . '</td>';
		$ch .='<td> <a href="voirplus.php?id_inf='. urlencode($uneInfraction->getIdInf()) .'"> <img class="action" src="../vue/style/voir.png" style="width:30px; height:30px;"> </a></td>';
		$ch .='<td> <img class="action" src="../vue/style/modifier.png" style="width:30px; height:30px; opacity:0.15;"> </td>';
		$ch .='<td> <img class="action" src="../vue/style/supprimer.png" style="width:30px; height:30px; opacity:0.15;"> </td>';

	
		$lignes[] = "<tr>$ch</tr>";
	}

	unset($lesInfractionsConducteur);
	require_once('../vue/infractions.view.php');
	
}

 


?>
