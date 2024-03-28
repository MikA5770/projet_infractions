<?php
error_reporting(E_ALL); ini_set("display_errors",1);
class Comprend{
    private $id_inf;
    private $id_delit;

    function __construct(int $id_inf=0, Delit $id_delit=null){
        $this->id_inf = $id_inf;
        $this->id_delit = $id_delit;
    }

    function getIdInf():int{
        return $this->id_inf;
    }
    function setIdInf(int $id_inf):void{
        $this->id_inf = $id_inf;
    }

    function getDelit():Delit{
        return $this->id_delit;
    }
    function setDelit(Delit $id_delit):void{
        $this->id_delit = $id_delit;
    }

}
?>