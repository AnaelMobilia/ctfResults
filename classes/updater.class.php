<?php

/**
 * Insertion dans la BDD...
 * @author Anael
 */
class updater {

    /**
     * Changement du statut d'un serveur
     * @param int $idServeur id du serveur
     * @return bool etat de la requête
     */
    public static function changeStatut($idServeur) {
        $req = maBDD::getInstance()->prepare("UPDATE groupe SET isEnLigne = (isEnLigne + 1)%2 WHERE id = :id");
        $req->bindValue(':id', $idServeur, PDO::PARAM_INT);
        return $req->execute();
    }

    /**
     * Enregistrement d'un événement
     * @param int $idGroupe id du groupe
     * @param int $idEvt id de l'événement
     * @param int $idVictime id de la victime (optionnel - uniquement pour les flags)
     * @param int $resultat OK ? (optionnel - uniqumenet pour les flags)
     * @return bool etat de la requête
     */
    public static function enregistrerEvt($idGroupe, $idEvt, $idVictime = false, $resultat = 1) {
        // Gestion des événements poussés par l'admin
        if (!$idVictime) {
            // Il s'agit d'un événément dont la responsabilité incombe au groupe même
            $idVictime = $idGroupe;
        }

        $req = maBDD::getInstance()->prepare("INSERT INTO evenement (timestamp, type, etat, groupe, ip, tiers) VALUES (UNIX_TIMESTAMP(), :idEvt, :resultat, :idGroupe, :ip, :idGroupe2)");
        $req->bindValue(':idEvt', $idEvt, PDO::PARAM_INT);
        $req->bindValue(':resultat', $resultat, PDO::PARAM_INT);
        $req->bindValue(':idGroupe', $idGroupe, PDO::PARAM_INT);
        $req->bindValue(':ip', $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
        $req->bindValue(':idGroupe2', $idVictime, PDO::PARAM_INT);
        return $req->execute();
    }

    /**
     * Enregistrement d'un flag
     * @param int $idGroupe id du groupe
     * @param int $idTypeFlag id du type du flag
     * @param string $flag le flag
     * @return bool etat de la requête
     */
    public static function enregistrerFlag($idGroupe, $idTypeFlag, $flag) {
        // On efface le vieux flag...
        $req = maBDD::getInstance()->prepare("DELETE FROM flags WHERE groupe = :idGroupe AND type = :idType");
        $req->bindValue(':idGroupe', $idGroupe, PDO::PARAM_INT);
        $req->bindValue(':idType', $idTypeFlag, PDO::PARAM_INT);
        $etat = $req->execute();

        if ($etat) {
            $req = maBDD::getInstance()->prepare("INSERT INTO flags (groupe, type, flag) VALUES (:idGroupe, :idType, :flag)");
            $req->bindValue(':idGroupe', $idGroupe, PDO::PARAM_INT);
            $req->bindValue(':idType', $idTypeFlag, PDO::PARAM_INT);
            $req->bindValue(':flag', $flag, PDO::PARAM_STR);

            $etat = $req->execute();
        }

        return $etat;
    }

}
