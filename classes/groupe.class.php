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
     * Vérification d'un flag
     * @param int $idFlag ID du type de flag
     * @param string $theFlag Flag proposé
     */
    public function checkFlag($idFlag, $theFlag) {
        // Le retour
        $monRetour = false;

        // Je vais chercher les infos en BDD
        $req = maBDD::getInstance()->prepare("SELECT * FROM flags WHERE groupe = :groupe AND type = :type");
        $req->bindValue(':groupe', $this->getId(), PDO::PARAM_INT);
        $req->bindValue(':type', $idFlag, PDO::PARAM_INT);
        $req->execute();

        // Pour chaque résultat retourné
        foreach ($req->fetchAll() as $value) {
            // Nouvel objet
            $monStub = new evenement();
            $monStub->setId($value->id);
            $monStub->setTimestamp($value->timestamp);
            $monStub->setType($value->type);
            $monStub->setEtat($value->etat);
            $monStub->setGroupe($value->groupe);
            $monStub->setIp($value->ip);
            $monStub->setDatas($value->datas);

            // On l'ajoute...
            $monRetour->append($monStub);
        }

        return $monRetour;
    }

    /**
     * Score du groupe
     * @return int score...
     */
    public function getScore() {
        $monScore = 0;

        // Je vais chercher les infos en BDD - que les éléments à prendre en compte !
        $req = maBDD::getInstance()->prepare("SELECT * FROM evenement ev, typeitem ty WHERE ev.type = ty.id AND ev.groupe = :groupe AND ev.etat=1");
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
