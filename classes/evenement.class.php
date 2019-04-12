<?php

/**
 * Gestion des événements - ORM
 * @author Anael
 */
class evenement {

    private $id;
    private $timestamp;
    private $type;
    private $etat;
    private $groupe;
    private $ip;
    private $tiers;
    private $nomGroupe;
    private $nom;
    private $valeur;

    public function getId() {
        return $this->id;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function getType() {
        return $this->type;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getGroupe() {
        return $this->groupe;
    }

    public function getIp() {
        return $this->ip;
    }

    public function getTiers() {
        return $this->tiers;
    }

    public function getNomGroupe() {
        return $this->nomGroupe;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getValeur() {
        return $this->valeur;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function setGroupe($groupe) {
        $this->groupe = $groupe;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function setTiers($tiers) {
        $this->tiers = $tiers;
    }

    public function setNomGroupe($nomGroupe) {
        $this->nomGroupe = $nomGroupe;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setValeur($valeur) {
        $this->valeur = $valeur;
    }

}
