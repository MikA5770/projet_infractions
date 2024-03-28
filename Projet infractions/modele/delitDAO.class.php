<?php
error_reporting(E_ALL); ini_set("display_errors",1);
require_once ("delit.class.php");
require_once ("connexion.php");

class DelitDAO {
    private $bd;
    private $select;

    function __construct(){
        $this->bd = new Connexion();
        $this->select="SELECT id_delit, nature, tarif FROM DELIT";
    }

    function insert (Delit $delit) : void {
        $this->bd->execSQL("INSERT INTO DELIT (id_delit, nature, tarif)
        VALUES (:id, :nat, :tar)"
        ,[':id'=>$delit->getIdDelit(), ':nat'=>$delit->getNature()
        ,':tar'=>$delit->getTarif() ] );
       }

    function delete(int $idDelit):void{
        $this->bd->execSQL("DELETE FROM DELIT WHERE id_delit=:id",
        [':id'=>$idEquipt]);
    }

    function update(Delit $delit):void{
        $this->bd->execSQL("UPDATE DELIT SET nature=:nat, tarif=:tar WHERE id_delit=:id", 
        [':id'=>$delit->getIdDelit(), ':$nat'=>$delit->getNature()
        ,':tar'=>$delit->getTarif()]);
    }    
    private function loadQuery (array $result) : array {
        $delits = [];
        foreach($result as $row) {
        $delit = new Delit();
        $delit->setIdDelit($row['id_delit']);
        $delit->setNature($row['nature']);
        $delit->setTarif($row['tarif']);
        $delits[] = $delit;
        }
        return $delits;
        }

    function getAll () : array {
        return ($this->loadQuery($this->bd->execSQL($this->select)));
        }

    function getByNum (int $id) : Delit {
        $unDelit = new Delit();
        $lesDelits = $this->loadQuery($this->bd->execSQL($this->select ." WHERE
        id_delit=:id", [':id'=>$id]) );
        if (count($lesDelits)>0) { $unDelit = $lesDelits[0]; }
        return $unDelit;
           } 

    function existe (int $id) : bool {
        $req = "SELECT * FROM DELIT WHERE id_delit = :id";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':id'=>$id])));
        return ($res != []);
           }
    function getDelitByInf(string $idInf) : array {
        $req = "SELECT DELIT.id_delit, nature, tarif FROM DELIT, COMPREND WHERE COMPREND.id_delit = DELIT.id_delit AND id_inf =:idInf";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':idInf'=>$idInf])));
        return $res;
           }

    function getNonDelit (string $idInf) {
	    return	($this->loadQuery($this->bd->execSQL($this->select 
		." WHERE id_delit NOT IN (SELECT id_delit FROM COMPREND WHERE id_inf=:idInf)", [':idInf'=>$idInf]) ));
		}

    }

?>