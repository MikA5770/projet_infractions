<?php

error_reporting(E_ALL); ini_set("display_errors",1);
require_once ("connexion.php");
require_once ("vehicule.class.php");

class VehiculeDAO{
    private $bd;
    private $select;

    function __construct(){
        $this->bd = new Connexion();
        $this->select="SELECT num_immat, DATE_FORMAT(date_immat, '%d/%m/%Y') AS date_immat, modele, marque, num_permis FROM VEHICULE";
    }

    function insert (Vehicule $vehicule) : void {
        $this->bd->execSQL("INSERT INTO VEHICULE (num_immat, date_immat, modele, marque, num_permis)
        VALUES (:numI, :dat, :mod, :mar, :numP)"
        ,[':numI'=>$vehicule->getNumImmat(), ':dat'=>$vehicule->getDateImmat()
        ,':mod'=>$vehicule->getModele(), ':mar'=>$vehicule->getMarque(), ':numP'=>$vehicule->getNumPermis() ] );
       }

    function delete(string $numImmat):void{
        $this->bd->execSQL("DELETE FROM VEHICULE WHERE num_immat=:numI",
        [':numI'=>$numImmat]);
    }

    function update(Vehicule $vehicule):void{
        $this->bd->execSQL("UPDATE VEHICULE SET date_immat=:dat, modele=:mod, marque=:mar, num_permis=:numP WHERE num_immat=:numI", 
        [':numI'=>$vehicule->getNumImmat(), ':$dat'=>$vehicule->getDateImmat()
        ,':mod'=>$vehicule->getModele(),':mar'=>$vehicule->getMarque(),':numP'=>$vehicule->getNumPermis()]);
    }    
    private function loadQuery (array $result) : array {
        $vehicules = [];
        foreach($result as $row) {
        $vehicule = new Vehicule();
        $vehicule->setNumImmat($row['num_immat']);
        $vehicule->setDateImmat($row['date_immat']);
        $vehicule->setModele($row['modele']);
        $vehicule->setMarque($row['marque']);
        $vehicule->setNumPermis($row['num_permis']);
        $vehicules[] = $vehicule;
        }
        return $vehicules;
        }

    function getAll () : array {
        return ($this->loadQuery($this->bd->execSQL($this->select)));
        }

    function getByNum (string $numImmat) : Vehicule {
        $unVehicule = new Vehicule();
        $lesVehicules = $this->loadQuery($this->bd->execSQL($this->select ." WHERE
    num_immat=:numI", [':numI'=>$numImmat]) );
        if (count($lesVehicules)>0) { $unVehicule = $lesVehicules[0]; }
        return $unVehicule;
           } 

    function existe (string $numImmat) : bool {
        $req = "SELECT * FROM VEHICULE WHERE num_immat = :numI";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':numI'=>$numImmat])));
        return ($res != []);
           }
        
    }
?>
