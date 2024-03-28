<?php 
session_start();
error_reporting(E_ALL); ini_set("display_errors", 1);
require_once ("../modele/connexion.php");
require_once ("../modele/infraction.class.php");
require_once ("../modele/infractionDAO.class.php");
require_once ("../modele/vehicule.class.php");
require_once ("../modele/vehicule.class.php");
require_once ("../modele/vehiculeDAO.class.php");
require_once ("../modele/conducteur.class.php");
require_once ("../modele/conducteurDAO.class.php");
require_once ("../modele/comprend.class.php");
require_once ("../modele/comprendDAO.class.php");
require_once ("../modele/delit.class.php");
require_once ("../modele/delitDAO.class.php");

$conducteurDAO = new ConducteurDAO();
$i = new InfractionDAO();
$vehiculeDAO = new VehiculeDAO();

$infraction['date'] = isset($_POST['date']) ? $_POST['date'] : null;
$infraction['num_immat'] = isset($_POST['num_immat']) ? $_POST['num_immat'] : null;
$infraction['num_permis'] = isset($_POST['num_permis']) ? $_POST['num_permis'] : null;

$id_inf = $i->getLastId();
$date = $infraction['date'];
$num_immat = $infraction['num_immat'];
$num_permis = $infraction['num_permis'];
$message="";

if (isset($_POST['valider'])){

    if(($conducteurDAO->existe($num_permis) && $vehiculeDAO->existe($num_immat))  || ($num_permis == "" && $vehiculeDAO->existe($num_immat))){
        $iDAO=new InfractionDAO();
        $i = new Infraction($id_inf,$date,$num_immat,$num_permis);
        $iDAO->insert($i);

        if(isset($_POST['delits']) && is_array($_POST['delits'])){
            $delitDAO = new DelitDAO();
            $comprendDAO = new ComprendDAO();
            foreach($_POST['delits'] as $delit){
                $d = $delitDAO->getByNum($delit);
                $nature = $d->getNature();
                $tarif = $d->getTarif();
                $del = new Delit($delit, $nature, $tarif);
                $comprend = new Comprend($id_inf, $del);
                $comprend = $comprendDAO->insert($comprend);
            }

        }
        header ("Location: infractions.php");
    } else {
        $message = "Erreur : numéro d'immatriculation ou de permis inexistant";
    }}
    else if(isset(($_POST['annuler']))){
        header ("Location: infractions.php");
    }
    require_once '../vue/ajout.view.php';
    


?>