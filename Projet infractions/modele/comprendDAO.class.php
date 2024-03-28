<?php

error_reporting(E_ALL); ini_set("display_errors",1);
require_once ("connexion.php");
require_once ("comprend.class.php");

class ComprendDAO{
    private $bd;
    private $select;

    function __construct(){
        $this->bd = new Connexion();
        $this->select="SELECT id_inf, id_delit FROM COMPREND";
    }

    function insert (Comprend $comprend) : void {
        $this->bd->execSQL("INSERT INTO COMPREND (id_inf, id_delit)
        VALUES (:idI, :IdD)"
        ,[':idI'=>$comprend->getIdInf(), ':IdD'=>$comprend->getDelit()->getIdDelit() ] );
       }

    function delete(int $idI):void{
        $this->bd->execSQL("DELETE FROM COMPREND WHERE id_inf=:id",
        [':id'=>$idI]);
    }
    function deleteByNumInf (int $numI) : void	{
        $this->bd->execSQL("DELETE FROM COMPREND WHERE id_inf = :numI"
                            ,[':numI'=>$numI ] );
    }


        private function loadQuery (array $result) : array {
        $delitDAO = new DelitDAO();
        $lesDelitsByInfraction =[];
        foreach($result as $row) {
        $delit = $delitDAO->getByNum($row['id_delit']);
        $lesDelitsByInfraction[] = new Comprend($row['id_inf']);
        }
        return $lesDelitsByInfraction;
        }

    function getAll () : array {
        return ($this->loadQuery($this->bd->execSQL($this->select)));
        }

    function getByNumInfrac (int $id) : array {
            return	($this->loadQuery($this->bd->execSQL($this->select ." WHERE id_inf=:idInf", [':idInf'=>$id]) ));
        } 

	function getByNumInfracByIdDelit (int $id_inf, int $idDelit) : array	{
			return	($this->loadQuery($this->bd->execSQL($this->select ." AND id_inf=:idInf AND id_delit=:idDelit"
									, [':idInf'=>$id_inf, ':idDelit'=>$idDelit] )))[0];
		}	
        
    function existe (int $id) : bool {
        $req = "SELECT * FROM COMPREND WHERE id_inf = :idI";
        $res = ($this->loadQuery($this->bd->execSQL($req,[':idI'=>$id])));
        return ($res != []); 
           }

}


?>
