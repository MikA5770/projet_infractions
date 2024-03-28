<?php

error_reporting(E_ALL); ini_set("display_errors",1);
require_once ("connexion.php");
require_once ("infraction.class.php");

class InfractionDAO{
    private $bd;
    private $select;

    function __construct(){
        $this->bd = new Connexion();
        $this->select="SELECT id_inf, DATE_FORMAT(date_inf, '%d/%m/%Y') AS date_inf, num_immat, num_permis FROM INFRACTION";
    }

    function insert (Infraction $infraction) : void {
        $this->bd->execSQL("INSERT INTO INFRACTION (id_inf, date_inf, num_immat, num_permis)
        VALUES (:id, STR_TO_DATE(:dat, '%d/%m/%Y'), :numI, :numP)"
        ,[':id'=>$infraction->getIdInf(), ':dat'=>$infraction->getDateInf()
        ,':numI'=>$infraction->getNumImmat(), ':numP'=>$infraction->getNumPermis() ] );
       }
       function getLastId(): int {
        $req = "SELECT MAX(id_inf) as max_id FROM INFRACTION";
        $res = $this->bd->execSQL($req, []);
        
        if (!empty($res) && isset($res[0]['max_id'])) {
            return (int)$res[0]['max_id'] + 1;
        } else {
            return 1;
        }
    }
    function delete(int $idInf):void{
        $this->bd->execSQL("DELETE FROM INFRACTION WHERE id_inf=:id",
        [':id'=>$idInf]);
    }

    function update(Infraction $infraction):void{
        $this->bd->execSQL("UPDATE INFRACTION SET date_inf=STR_TO_DATE(:dat, '%d/%m/%Y'), num_immat=:numI, num_permis=:numP WHERE id_inf=:id", 
        [':id'=>$infraction->getIdInf(), ':dat'=>$infraction->getDateInf()
        ,':numI'=>$infraction->getNumImmat(),':numP'=>$infraction->getNumPermis()]);
    }    
    private function loadQuery (array $result) : array {
        $infractions = [];
        foreach($result as $row) {
        $infraction = new Infraction();
        $infraction->setIdInf($row['id_inf']);
        $infraction->setDateInf($row['date_inf']);
        $infraction->setNumImmat($row['num_immat']);
        $infraction->setNumPermis($row['num_permis']);
        $infractions[] = $infraction;
        }
        return $infractions;
        }

    function getAll () : array {
        return ($this->loadQuery($this->bd->execSQL($this->select)));
        }

    function getByNum (int $id) : Infraction {
        $uneInfraction = new Infraction();
        $lesInfractions = $this->loadQuery($this->bd->execSQL($this->select ." WHERE
    id_inf=:id", [':id'=>$id]) );
        if (count($lesInfractions)>0) { $uneInfraction = $lesInfractions[0]; }
        return $uneInfraction;
           } 

    function existe (int $id) : bool {
        $req = "SELECT * FROM INFRACTION WHERE id_inf = :id";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
        return ($res != []); 
           }

    function getDelitByInf(string $id): array {
        $uneInfraction = new Infraction();
        $lesInfractions = $this->loadQuery($this->bd->execSQL(
            "SELECT id_inf, date_inf, num_immat, INFRACTION.num_permis 
            FROM INFRACTION, CONDUCTEUR 
            WHERE CONDUCTEUR.num_permis = INFRACTION.num_permis 
            AND CONDUCTEUR.num_permis = :numP",
            [':numP' => $id]
        ));
        if (count($lesInfractions) > 0) {
        $uneInfraction = $lesInfractions[0];
        }
            return $lesInfractions;
        }

}
?>
