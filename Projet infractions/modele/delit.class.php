<?php
error_reporting(E_ALL); ini_set("display_errors",1);
class Delit{
    private $id_delit;
    private $nature;
    private $tarif;

    function __construct(int $id_delit = 0, string $nature = "", int $tarif = 0) {
        $this->id_delit = $id_delit;
        $this->nature = $nature;
        $this->tarif = $tarif;
    }

    function getIdDelit(): int {
        return $this->id_delit;
    }
    function setIdDelit(int $id_delit): void {
        $this->id_delit = $id_delit;
    }

    function getNature(): string {
        return $this->nature;
    }
    function setNature(string $nature): void {
        $this->nature = $nature;
    }

    function getTarif(): int {
        return $this->tarif;
    }
    function setTarif(int $tarif): void {
        $this->tarif = $tarif;
    }
}
?>