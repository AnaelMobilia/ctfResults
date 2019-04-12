<?php

/**
 * Gestion des groupes - ORM
 * @author Anael
 */
class groupe {

    private $id;
    private $urlServeur;
    private $membres;
    private $isEnligne;

    /**
     * Score du groupe
     * @return int score...
     */
    public function getScore() {
        $monScore = 0;

        // Je vais chercher les infos en BDD - que les éléments à prendre en compte !
        $req = maBDD::getInstance()->prepare("SELECT * FROM evenement ev, typeaction ty WHERE ev.type = ty.id AND ev.groupe = :groupe AND ev.etat=1");
        $req->bindValue(':groupe', $this->getId(), PDO::PARAM_INT);
        $req->execute();

        foreach ($req->fetchAll() as $value) {
            $monScore += (int) $value->valeur;
        }

        return $monScore;
    }

    public function getId() {
        return $this->id;
    }

    public function getUrlServeur() {
        return $this->urlServeur;
    }

    public function getMembres() {
        return $this->membres;
    }

    public function getIsEnligne() {
        return $this->isEnligne;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUrlServeur($urlServeur) {
        $this->urlServeur = $urlServeur;
    }

    public function setMembres($membres) {
        $this->membres = $membres;
    }

    public function setIsEnligne($isEnligne) {
        $this->isEnligne = $isEnligne;
    }

}
