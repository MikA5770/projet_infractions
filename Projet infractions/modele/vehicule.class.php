<?php 
error_reporting(E_ALL); ini_set("display_errors",1);
class Vehicule{
    private $num_immat;
    private $date_immat;
    private $modele;
    private $marque;
    private $num_permis;

    function __construct(string $num_immat="", string $date_immat="", string $modele="", string $marque="", string $num_permis=""){
        $this->num_immat = $num_immat;
        $this->date_immat = $date_immat;
        $this->modele = $modele;
        $this->marque = $marque;
        $this->num_permis = $num_permis;
    }

    function getNumImmat():string{
        return $this->num_immat;
    }
    function setNumImmat(string $num_immat):void{
        $this->num_immat = $num_immat;
    }

    function getDateImmat():string{
        return $this->date_immat;
    }
    function setDateImmat(string $date_immat):void{
        $this->date_immat = $date_immat;
    }

    function getModele():string{
        return $this->modele;
    }
    function setModele(string $modele):void{
        $this->modele = $modele;
    }

    function getMarque():string{
        return $this->marque;
    }

    function setMarque(string $marque):void{
        $this->marque = $marque;
    }

    function getNumPermis():string{
        return $this->num_permis;
    }
    function setNumPermis(string $num_permis):void{
        $this->num_permis = $num_permis;
    }


}
?>