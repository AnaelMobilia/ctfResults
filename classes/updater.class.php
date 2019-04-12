<?php

/**
 * Insertion dans la BDD...
 * @author Anael
 */
class updater {

    /**
     * Changement du statut d'un serveur
     * @param int $idServeur id du serveur
     */
    public static function changeStatut($idServeur) {
        $req = maBDD::getInstance()->prepare("UPDATE groupe SET isEnLigne = (isEnLigne + 1)%2 WHERE id = :id");
        $req->bindValue(':id', $idServeur, PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * Enregistrement d'un événement poussé par l'admin
     * @param int $idGroupe id du groupe
     * @param int $idEvt id de l'événement
     */
    public static function enregistrerEvt($idGroupe, $idEvt) {
        $req = maBDD::getInstance()->prepare("INSERT INTO evenement (timestamp, type, etat, groupe, ip, tiers) VALUES (UNIX_TIMESTAMP(), :idEvt, 1, :idGroupe, :ip, :idGroupe2)");
        $req->bindValue(':idEvt', $idEvt, PDO::PARAM_INT);
        $req->bindValue(':idGroupe', $idGroupe, PDO::PARAM_INT);
        $req->bindValue(':ip', $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
        $req->bindValue(':idGroupe2', $idGroupe, PDO::PARAM_INT);
        $req->execute();
    }

}
