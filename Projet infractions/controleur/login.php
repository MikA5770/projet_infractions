<?php
error_reporting(E_ALL); ini_set("display_errors", 1);
require_once ("../modele/connexion.php");
require_once ("../modele/conducteur.class.php");
require_once ("../modele/conducteurDAO.class.php");

$identifiant['permis'] = isset($_POST['permis']) ? $_POST['permis'] : null;
$identifiant['mdp'] = isset($_POST['mdp']) ? $_POST['mdp'] : null;
$numP = $identifiant['permis'];
$mdp = $identifiant['mdp'];
$message = "";
$c = new ConducteurDAO();

if (isset($_POST['Se_connecter'])) {
    if ($c->existeConducteur($numP, $mdp)) {
        session_start();
        $_SESSION['id'] = $identifiant['permis'];
        $_SESSION['mdp'] = $identifiant['mdp'];
        $idSession = session_id();
        header("location: infractions.php");
    } else {
        $message = "Identification incorrecte. Essayez de nouveau.";
    }
}

require_once '../vue/login.view.php';
?>
