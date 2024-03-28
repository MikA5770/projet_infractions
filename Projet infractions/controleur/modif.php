<?php
session_start();
require_once("../modele/connexion.php");
require_once("../modele/infractionDAO.class.php");
require_once("../modele/infraction.class.php");
require_once ("../modele/vehicule.class.php");
require_once ("../modele/vehicule.class.php");
require_once ("../modele/vehiculeDAO.class.php");
require_once ("../modele/conducteur.class.php");
require_once ("../modele/conducteurDAO.class.php");
require_once ("../modele/comprend.class.php");
require_once ("../modele/comprendDAO.class.php");
require_once ("../modele/delit.class.php");
require_once ("../modele/delitDAO.class.php");

$conducteurDAO = new conducteurDAO();
$vehiculeDAO = new vehiculeDAO();



$modifInf['numP'] = isset($_POST['numP']) ? $_POST['numP'] : null;
$modifInf['numI'] = isset($_POST['numI']) ? $_POST['numI'] : null;

$id_infraction = isset($_GET['id_inf']) ? $_GET['id_inf'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : null;

if ($id_infraction !== null && $date !== null) {
    $_SESSION['id_inf'] = $id_infraction;
    $_SESSION['date'] = $date;
}
$message= "";

$numP = $modifInf['numP'];
$numI = $modifInf['numI'];

$id = intval($_SESSION['id_inf']);
$date = htmlspecialchars($_SESSION['date']);
if (isset($_POST['valider'])) {

    if(($conducteurDAO->existe($numP) && $vehiculeDAO->existe($numI)) || ($numP == "" && $vehiculeDAO->existe($numI))){
    
    $infractionDAO = new InfractionDAO();
    $infraction = new Infraction($id, $date, $numI, $numP);
    $infractionDAO->update($infraction);

    if(isset($_POST['delits']) && is_array($_POST['delits'])){
        $delitDAO = new DelitDAO();
        $comprendDAO = new ComprendDAO();
        $comprendDAO->deleteByNumInf($id);
        foreach($_POST['delits'] as $delit){
            $d = $delitDAO->getByNum($delit);
            $nature = $d->getNature();
            $tarif = $d->getTarif();
            $del = new Delit($delit, $nature, $tarif);
            $comprend = new Comprend($id, $del);
            $comprend = $comprendDAO->insert($comprend);
        }

    }
    header("Location: infractions.php");
} else {
    $message = "Erreur : numéro d'immatriculation ou de permis inexistant";

    }} else if(isset($_POST['annuler'])){
    header("Location: infractions.php");
}

require_once("../vue/modif.view.php");
?>
