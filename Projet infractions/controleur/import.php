<?php
require_once ("../modele/connexion.php");
require_once ("../modele/infraction.class.php");
require_once ("../modele/infractionDAO.class.php");
require_once ("../modele/vehicule.class.php");
require_once ("../modele/vehiculeDAO.class.php");
require_once ("../modele/conducteur.class.php");
require_once ("../modele/conducteurDAO.class.php");
require_once ("../modele/comprend.class.php");
require_once ("../modele/comprendDAO.class.php");
require_once ("../modele/delit.class.php");
require_once ("../modele/delitDAO.class.php");

$conducteurDAO = new ConducteurDAO();
$vehiculeDAO = new VehiculeDAO();
$infractionDAO = new InfractionDAO();
$delitDAO = new DelitDAO();
$comprendDAO = new ComprendDAO();
$i = $infractionDAO->getLastId();
$message = "";

if (isset($_FILES["fileInput"]) && $_FILES["fileInput"]["error"] == UPLOAD_ERR_OK) {
    $fichier = $_FILES["fileInput"]["name"];
    $contenu = file_get_contents($_FILES["fileInput"]["tmp_name"]);
    
    $data = json_decode($contenu, true);
    
    foreach ($data as $entry) {
        if (isset($entry['num_immat'])) {
            $lesNumImmmat[] = $entry['num_immat'];
        }
        if (isset($entry['num_permis'])) {
            $lesNumPermis[] = $entry['num_permis'];
        } 
        if (isset($entry['délits'])) {
            $lesDelits[] = $entry['délits'];
        }
    }
    
    if (isset($_POST['importer'])){
        
        
        foreach($lesNumImmmat as $numI){
            if(!$vehiculeDAO->existe($numI)){
                $message = "Erreur : l'un des numéros d'immatriculation n'existe pas";
            }
        }
        foreach($lesNumPermis as $numP){
            if(!$conducteurDAO->existe($numP) && $numP !== ""){
                $message = $message . "<br>Erreur : l'un des numéros de permis n'existe pas";
            }
        }
        foreach($lesDelits as $del){
            foreach($del as $num){
                if(!$delitDAO->existe($num)){
                        $message = $message . "<br>Erreur : l'un des numéros de délits n'existe pas";
                    }
                }
                }

        if($message !== ""){
            $z = 0;
        }
        else{
            foreach ($data as $entry) {
                    ['date_inf' => $dateInf, 'num_immat' => $numImmat, 'num_permis' => $numPermis, 'délits' => $delits] = $entry;
                    $infraction = new Infraction($i, $dateInf, $numImmat, $numPermis);
                    $infractionDAO->insert($infraction);
            
                    foreach ($delits as $idDelit) {
                            $del = $delitDAO->getByNum($idDelit);
                            $nature = $del->getNature();
                            $tarif = $del->getTarif();
                            $d = new Delit($idDelit, $nature, $tarif);
                            $comprend = new Comprend($i, $d);
                            $comprendDAO->insert($comprend);
                        }
                $i = $i + 1;
                }
                header ('location: infractions.php');
        }
            }else if(isset(($_POST['annuler']))){
                    header ("Location: infractions.php");
                }
                        
}
if(isset(($_POST['annuler']))){
    header ("Location: infractions.php");
}
require_once ("../vue/import.view.php");

?>
