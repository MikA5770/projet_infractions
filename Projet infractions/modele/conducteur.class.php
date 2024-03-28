<?php
error_reporting(E_ALL); ini_set("display_errors",1);
class Conducteur{
    private $num_permis;
    private $date_permis;
    private $nom;
    private $prenom;
    private $mdp;
    private $isAdmin;

    function __construct(string $num_permis='', string $date_permis='', string $nom='', string $prenom='', string $mdp='', string $isAdmin=''){
        $this->num_permis = $num_permis;
        $this->date_permis = $date_permis;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdp = $mdp;
        $this->isAdmin = $isAdmin;
    }

    function getNumPermis(): string {
        return $this->num_permis;
    }
    function setNumPermis(string $num_permis): void {
        $this->num_permis = $num_permis;
    }

    function getDatePermis(): string {
        return $this->date_permis;
    }
    function setDatePermis(string $date_permis): void {
        $this->date_permis = $date_permis;
    }

    function getNom(): string {
        return $this->nom;
    }
    function setNom(string $nom): void {
        $this->nom = $nom;
    }

    function getPrenom(): string {
        return $this->prenom;
    }
    function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    function getMdp(): string {
        return $this->mdp;
    }
    function setMdp(string $mdp): void {
        $this->mdp = $mdp;
    }

    function getIsAdmin(): string {
        return $this->isAdmin;
    }
    function setIsAdmin(string $isAdmin): void {
        $this->isAdmin = $isAdmin;
    }
}
?>