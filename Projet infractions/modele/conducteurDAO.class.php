<?php

error_reporting(E_ALL); ini_set("display_errors",1);
require_once ("connexion.php");
require_once ("conducteur.class.php");

class ConducteurDAO{
    private $bd;
    private $select;

    function __construct(){
        $this->bd = new Connexion();
        $this->select="SELECT num_permis, DATE_FORMAT(date_permis, '%d/%m/%Y') AS date_permis, nom, prenom, mdp, isAdmin FROM CONDUCTEUR";
    }

    function insert (Conducteur $conducteur) : void {
        $this->bd->execSQL("INSERT INTO CONDUCTEUR (num_permis, date_permis, nom, prenom, mdp, isAdmin)
        VALUES (:num, :dat, :nom, :prenom, :mdp, :isAdmin)"
        ,[':num'=>$conducteur->getNumPermis(), ':dat'=>$conducteur->getDatePermis()
        ,':nom'=>$conducteur->geNom(),':prenom'=>$conducteur->getPrenom(),':mdp'=>$conducteur->getMdp(),
        ':isAdmin'=>$conducteur->getIsAdmin() ] );
       }

    function delete(string $numP):void{
        $this->bd->execSQL("DELETE FROM CONDUCTEUR WHERE num_permis=:num",
        [':num'=>$numP]);
    }

    function update(Conducteur $conducteur):void{
        $this->bd->execSQL("UPDATE CONDUCTEUR SET date_permis=:dat, nom=:nom, prenom=:prenom, mdp:mdp, isAdmin=:isAdmin WHERE num_permis=:num", 
        [':num'=>$conducteur->getNumPermis(), ':dat'=>$conducteur->getDatePermis()
        ,':nom'=>$conducteur->geNom(),':prenom'=>$conducteur->getPrenom(),':mdp'=>$conducteur->getMdp(),
        ':isAdmin'=>$conducteur->getIsAdmin() ]);
    }    
    private function loadQuery (array $result) : array {
        $conducteurs = [];
        foreach($result as $row) {
        $conducteur = new Conducteur();
        $conducteur->setNumPermis($row['num_permis']);
        $conducteur->setDatePermis($row['date_permis']);
        $conducteur->setNom($row['nom']);
        $conducteur->setPrenom($row['prenom']);
        $conducteur->setMdp($row['mdp']);
        $conducteur->setIsAdmin($row['isAdmin']);
        $conducteurs[] = $conducteur;
        }
        return $conducteurs;
        }

    function getAll () : array {
        return ($this->loadQuery($this->bd->execSQL($this->select)));
        }

    function getByNum (string $numP) : Conducteur {
        $unConducteur = new Conducteur();
        $lesConducteurs = $this->loadQuery($this->bd->execSQL($this->select ." WHERE
    num_permis=:num", [':num'=>$numP]) );
        if (count($lesConducteurs)>0) { $unConducteur = $lesConducteurs[0]; }
        return $unConducteur;
           } 


    function existe (string $numP) : bool {
        $req = "SELECT * FROM CONDUCTEUR WHERE num_permis = :num";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':num'=>$numP])));
        return ($res != []); 
           }

           function existeConducteur (string $numP, string $mdp) : bool {
            $req = "SELECT * FROM CONDUCTEUR WHERE num_permis = :num AND mdp = :passwrd";
            $res = ($this->loadQuery($this->bd->execSQL($req,[':num'=>$numP, ':passwrd'=>$mdp])));
            return ($res != []); 
           }

           function estAdmin (string $numP, string $mdp) : bool {
            $req = "SELECT * FROM CONDUCTEUR WHERE num_permis = :num AND mdp = :passwrd";
            $res = ($this->loadQuery($this->bd->execSQL($req,[':num'=>$numP, ':passwrd'=>$mdp])));
            return ($res != []); 
           }
        
}

?>
