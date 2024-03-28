<?php
error_reporting(E_ALL); ini_set("display_errors",1);

class Infraction{
    private $id_inf;
    private $date_inf;
    private $num_immat;
    private $num_permis;

    function __construct(int $id_inf = 0, string $date_inf = "", string $num_immat = "", string $num_permis = "") {
        $this->id_inf = $id_inf;
        $this->date_inf = $date_inf;
        $this->num_immat = $num_immat;
        $this->num_permis = $num_permis;
    }

    function getIdInf(): int {
        return $this->id_inf;
    }
    function setIdInf(int $id_inf): void {
        $this->id_inf = $id_inf;
    }

    function getDateInf(): string {
        return $this->date_inf;
    }
    function setDateInf(string $date_inf): void {
        $this->date_inf = $date_inf;
    }

    function getNumImmat(): string {
        return $this->num_immat;
    }
    function setNumImmat(string $num_immat): void {
        $this->num_immat = $num_immat;
    }

    function getNumPermis(): string {
        return $this->num_permis;
    }
    function setNumPermis(string $num_permis): void {
        $this->num_permis = $num_permis;
    }
}

?>