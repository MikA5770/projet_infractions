<?php 
session_start();
require_once ("../modele/infractionDAO.class.php");
require_once ("../modele/comprendDAO.class.php");

$id = (isset($_GET['id_inf'])?$_GET['id_inf']:null);
$suppression = new InfractionDAO();
$comprend = new ComprendDAO();


if(isset($_POST['supp'])){
    $suppression->delete($id);
    $comprend->deleteByNumInf($id);
    header("Location: infractions.php"); 
} else if(isset($_POST['annuler'])){
    header("Location: infractions.php"); 
}

require_once ("../vue/supp.view.php")

?>