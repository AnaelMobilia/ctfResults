-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 14 avr. 2019 à 01:43
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `myctf`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `etat` tinyint(4) NOT NULL,
  `groupe` int(11) NOT NULL,
  `ip` text NOT NULL,
  `tiers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `timestamp`, `type`, `etat`, `groupe`, `ip`, `tiers`) VALUES
(1, 0, 11, 1, 3, '127.0.0.1', '3'),
(2, 0, 11, 1, 1, '127.0.0.1', '1'),
(3, 0, 11, 1, 1, '127.0.01', '1'),
(4, 0, 11, 1, 10, '127.0.0.1', '10'),
(5, 0, 11, 1, 5, '127.0.0.1', '5'),
(6, 0, 12, 1, 7, '127.0.0.1', '7');

-- --------------------------------------------------------

--
-- Structure de la table `flags`
--

CREATE TABLE `flags` (
  `id` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `flag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `urlServeur` text NOT NULL,
  `membres` text NOT NULL,
  `isEnLigne` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `urlServeur`, `membres`, `isEnLigne`) VALUES
(1, 'a.ctf.arrobe.fr', 'Christophe', 0),
(2, 'b.ctf.arrobe.fr', 'Romain', 0),
(3, 'c.ctf.arrobe.fr', 'Aur&eacute;lien', 0),
(4, 'd.ctf.arrobe.fr', 'Benjamin', 0),
(5, 'e.ctf.arrobe.fr', 'Alexandre', 0),
(6, 'f.ctf.arrobe.fr', 'Yann + Matthieu', 0),
(7, 'g.ctf.arrobe.fr', 'Anael', 1),
(8, 'h.ctf.arrobe.fr', 'Adrien', 0),
(9, 'i.ctf.arrobe.fr', 'Valentin + Livio', 0),
(10, 'j.ctf.arrobe.fr', 'Nadezhda + Clara', 0),
(11, 'k.ctf.arrobe.fr', 'J&eacute;r&ocirc;me + Agathe', 0),
(12, 'l.ctf.arrobe.fr', 'Ludovic + K&eacute;vin', 0),
(13, 'm.ctf.arrobe.fr', 'Th&eacute;o + William', 0),
(14, 'n.ctf.arrobe.fr', 'Alexis + Nicolas', 0),
(16, 'o.ctf.arrobe.fr', 'Lisa + Florian', 0),
(17, 'p.ctf.arrobe.fr', 'Pierre + Thomas', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ping`
--

CREATE TABLE `ping` (
  `id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `dateheure` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reponse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `typeaction`
--

CREATE TABLE `typeaction` (
  `id` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `valeur` int(11) NOT NULL,
  `saisieUser` tinyint(4) NOT NULL,
  `saisieAdmin` tinyint(4) NOT NULL,
  `isEvtMachine` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeaction`
--

INSERT INTO `typeaction` (`id`, `libelle`, `valeur`, `saisieUser`, `saisieAdmin`, `isEvtMachine`) VALUES
(1, 'Capture du flag /root/flag', 100, 1, 0, 1),
(2, 'Capture du flag devWeb', 30, 1, 0, 1),
(3, 'Capture du flag FTP', 30, 1, 0, 1),
(4, 'Capture du flag Mercurial', 30, 1, 0, 1),
(5, 'Capture du flag WordPress', 30, 1, 0, 1),
(6, 'Capture du flag SQL', 30, 1, 0, 1),
(7, 'VM non disponible (supervision)', -1, 0, 1, 1),
(11, 'R&eacute;initialisation de la VM', -15, 0, 1, 1),
(12, 'Bonus - 1er en ligne', 10, 0, 1, 0),
(13, 'Bonus - 2&egrave;me en ligne', 9, 0, 1, 0),
(14, 'Bonus - 3&egrave;me en ligne', 8, 0, 1, 0),
(15, 'Bonus - 4&egrave;me en ligne', 7, 0, 1, 0),
(16, 'Bonus - 5&egrave;me en ligne', 6, 0, 1, 0),
(17, 'Bonus - 6&egrave;me en ligne', 5, 0, 1, 0),
(18, 'Bonus - 7&egrave;me en ligne', 4, 0, 1, 0),
(19, 'Bonus - 8&egrave;me en ligne', 3, 0, 1, 0),
(20, 'Bonus - 9&egrave;me en ligne', 2, 0, 1, 0),
(21, 'Bonus - 10&egrave;me en ligne', 1, 0, 1, 0),
(22, 'Malus - Mise en ligne tardive', -5, 0, 1, 1),
(23, 'Faire le K&eacute;vin', -30, 0, 1, 0),
(24, 'P&eacute;nalit&eacute; - Capture du flag /root/flag', -50, 0, 0, 0),
(25, 'P&eacute;nalit&eacute; - Capture du flag devWeb', -15, 0, 0, 0),
(26, 'P&eacute;nalit&eacute; - Capture du flag FTP', -15, 0, 0, 0),
(27, 'P&eacute;nalit&eacute; - Capture du flag Mercurial', -15, 0, 0, 0),
(28, 'P&eacute;nalit&eacute; - Capture du flag WordPress', -15, 0, 0, 0),
(29, 'P&eacute;nalit&eacute; - Capture du flag SQL', -15, 0, 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ping`
--
ALTER TABLE `ping`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeaction`
--
ALTER TABLE `typeaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `typeaction`
--
ALTER TABLE `typeaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
