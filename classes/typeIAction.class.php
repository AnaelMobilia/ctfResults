<?php

/**
 * Gestion des type d'items - ORM
 * @author Anael
 */
class typeAction {

    private $id;
    private $libelle;
    private $valeur;

    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getValeur() {
        return $this->valeur;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function setValeur($valeur) {
        $this->valeur = $valeur;
    }

}
