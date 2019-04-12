<?php

/**
 * Chargement depuis la BDD...
 * @author Anael
 */
class loader {

    /**
     * Liste de tous les groupes
     * @return groupe[]
     */
    public static function chargerGroupes() {
        // Tous les groupes
        $req = "SELECT * FROM groupe";

        // Exécution de la requête
        $resultat = maBDD::getInstance()->query($req);

        $retour = new ArrayObject();
        // Pour chaque résultat retourné
        foreach ($resultat->fetchAll() as $value) {
            // Nouvel objet
            $monStub = new groupe();
            $monStub->setId($value->id);
            $monStub->setUrlServeur($value->urlServeur);
            $monStub->setMembres($value->membres);
            $monStub->setIsEnligne($value->isEnLigne);

            // On l'ajoute...
            $retour->append($monStub);
        }

        return $retour;
    }

    /**
     * Liste de tous les type d'item pour l'administration
     * @param boolean $saisieUser Doit-être saisissable par les utilisateurs (FALSE)
     * @param boolean $saisieAdmin Doit-être saisissable par l'administrateur (FALSE)
     * @return typeItem[]
     */
    public static function chargerTypeItems($saisieUser = false, $saisieAdmin = false) {
        // Tous les types d'items
        $req = "SELECT * FROM typeitem WHERE 1=1";
        if ($saisieUser) {
            $req .= " AND saisieUser=1";
        }
        if ($saisieAdmin) {
            $req .= " AND saisieAdmin=1";
        }

        // Exécution de la requête
        $resultat = maBDD::getInstance()->query($req);

        $retour = new ArrayObject();
        // Pour chaque résultat retourné
        foreach ($resultat->fetchAll() as $value) {
            // Nouvel objet
            $monStub = new typeItem();
            $monStub->setId($value->id);
            $monStub->setLibelle($value->libelle);
            $monStub->setValeur($value->valeur);

            // On l'ajoute...
            $retour->append($monStub);
        }

        return $retour;
    }

    /**
     * Liste de tous les événements d'un groupe
     * Charge directement le libellé de l'événement et le nom du groupe
     * @param int $idGroupe groupe en question
     * @return evenement[]
     */
    public static function chargerEvenementsGroupe($idGroupe) {
        $req = maBDD::getInstance()->prepare("SELECT * FROM evenement ev, groupe gr, typeitem ty WHERE ev.tiers = gr.id AND ev.type = ty.id AND ev.groupe = :groupe AND ev.etat=1");
        $req->bindValue(':groupe', $idGroupe, PDO::PARAM_INT);
        $req->execute();

        $retour = new ArrayObject();
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
            $monStub->setTiers($value->tiers);
            $monStub->setNomGroupe($value->membres);
            $monStub->setNom($value->libelle);
            $monStub->setValeur($value->valeur);

            // On l'ajoute...
            $retour->append($monStub);
        }

        return $retour;
    }

    /**
     * Liste de tous les événements d'une machine
     * Charge directement le libellé de l'événement et le nom du groupe
     * @param int $idMachine groupe en question
     * @return evenement[]
     */
    public static function chargerEvenementsMachine($idMachine) {
        $req = maBDD::getInstance()->prepare("SELECT * FROM evenement ev, groupe gr, typeitem ty WHERE ev.groupe = gr.id AND ev.type = ty.id AND ev.tiers = :groupe AND ev.etat=1");
        $req->bindValue(':groupe', $idMachine, PDO::PARAM_INT);
        $req->execute();

        $retour = new ArrayObject();
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
            $monStub->setTiers($value->tiers);
            $monStub->setNomGroupe($value->membres);
            $monStub->setNom($value->libelle);
            $monStub->setValeur($value->valeur);

            // On l'ajoute...
            $retour->append($monStub);
        }

        return $retour;
    }

    /**
     * Nom du groupe
     * @param int $idGroupe groupe en question
     * @return string
     */
    public static function getNomGroupe($idGroupe) {
        $req = maBDD::getInstance()->prepare("SELECT * FROM groupe WHERE id = :groupe");
        $req->bindValue(':groupe', $idGroupe, PDO::PARAM_INT);
        $req->execute();

        $resultat = $req->fetch();

        return $resultat->membres;
    }

    /**
     * Nom du serveur
     * @param int $idServeur groupe en question
     * @return string
     */
    public static function getNomServeur($idServeur) {
        $req = maBDD::getInstance()->prepare("SELECT * FROM groupe WHERE id = :id");
        $req->bindValue(':id', $idServeur, PDO::PARAM_INT);
        $req->execute();

        $resultat = $req->fetch();

        return $resultat->urlServeur;
    }

}
