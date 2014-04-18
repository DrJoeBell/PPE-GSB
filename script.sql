-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Client: mysql1.alwaysdata.com
-- Généré le: Jeu 17 Avril 2014 à 09:22
-- Version du serveur: 5.1.66-0+squeeze1
-- Version de PHP: 5.3.6-11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `usersio_gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE IF NOT EXISTS `medecin` (
  `ID` varchar(32) NOT NULL,
  `ID_POSSEDE` varchar(32) NOT NULL,
  `NOM` varchar(255) DEFAULT NULL,
  `PRENOM` varchar(255) DEFAULT NULL,
  `ADRESSE` varchar(255) DEFAULT NULL,
  `VILLE_MEDECIN` varchar(255) NOT NULL,
  `CP_MEDECIN` int(5) NOT NULL,
  `TEL` varchar(32) DEFAULT NULL,
  `DEPARTEMENT` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_MEDECIN_SPECIALITE` (`ID_POSSEDE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `medecin`
--

INSERT INTO `medecin` (`ID`, `ID_POSSEDE`, `NOM`, `PRENOM`, `ADRESSE`, `VILLE_MEDECIN`, `CP_MEDECIN`, `TEL`, `DEPARTEMENT`) VALUES
('1', '1', 'Sheperd', 'Derek', '69 Rue de la Juiverie', 'Nantes', 44100, '06 12 45 78 36', '44'),
('10', '2', 'Robbins', 'Arizona', '65 Places des Grands Coeurs', 'Nantes', 44120, '06 36 25 14 98', '35'),
('11', '3', 'Tafraise', 'Ramon', '2 rue du Fruit', 'OasisLand', 1234, '01 02 03 04 05', '01'),
('2', '2', 'Grey', 'Meredith', '52 Rue de l''Abreuvoir', '', 0, '06 74 85 96 32', '44'),
('3', '3', 'Yang', 'Christina', '36 Rue des Cadeniers', '', 0, '06 52 63 41 85', '35'),
('4', '4', 'Karev', 'Alex', '75 Bd de Doulon', '', 0, '06 33 54 96 87', '35'),
('5', '5', 'O''Maley', 'Georges', '26 Rue de l''Échappée', '', 0, '06 85 52 41 45', '79'),
('6', '6', 'Weber', 'Richard', '42 Rue des Ferblantiers', '', 0, '07 52 45 55 21', '79'),
('7', '2', 'Tim', 'Vincent', '125 Rue de la Monnaie', '', 0, '07 06 25 19 24', '20'),
('8', '4', 'Hunt', 'Owen', '53 Place des Garennes', '', 0, '06 54 52 51 53', '44'),
('9', '6', 'Forbes-Montgomery', 'Addison', '83 Avenue des Amours', '', 0, '06 98 56 18 24', '44');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

CREATE TABLE IF NOT EXISTS `motif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `motif`
--

INSERT INTO `motif` (`id`, `libelle`) VALUES
(1, 'Visite Annuelle'),
(2, 'Presentation d''un nouveau medicament'),
(3, 'Sollicitation du medecin'),
(4, 'Visite bi-mensuelle');

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE IF NOT EXISTS `rapport` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `ID_REDIGER` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `ID_CONCERNE` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `DATERAPPORT` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `MOTIF` int(255) DEFAULT NULL,
  `BILAN` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_RAPPORT_MEDECIN` (`ID_CONCERNE`),
  KEY `FK_RAPPORT_VISITEUR` (`ID_REDIGER`),
  KEY `FK_RAPPORT_MOTIF` (`MOTIF`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `rapport`
--

INSERT INTO `rapport` (`ID`, `ID_REDIGER`, `ID_CONCERNE`, `DATERAPPORT`, `MOTIF`, `BILAN`) VALUES
(1, '1', '1', '27/11/2013', 1, 'Rien à signaler, tout est correcte !'),
(2, '2', '2', '23/10/2013', 2, 'Rien à signaler de particulier, ce'),
(8, '2', '3', '06/12/2012', 2, 'Ajout d''un test'),
(9, '3', '2', '06/12/2013', 2, 'test'),
(10, '1', '1', '06/12/2013', 1, 'coucou'),
(11, '7', '7', '06/12/2013', 3, 'Cette personne possède un égo .... comment dire ^^');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE IF NOT EXISTS `specialite` (
  `ID` varchar(32) CHARACTER SET latin1 NOT NULL,
  `LIBELLE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `specialite`
--

INSERT INTO `specialite` (`ID`, `LIBELLE`) VALUES
('1', 'Neurochirurgie'),
('2', 'Othopédie'),
('3', 'Généraliste'),
('4', 'Pédo-psychatrie'),
('5', 'Cancerologie'),
('6', 'Proctologie');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
  `ID` varchar(32) CHARACTER SET latin1 NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `PRENOM` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `LOGIN` varchar(255) CHARACTER SET latin1 NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ADRESSE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `VILLE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `CP` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `MAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DATEEMBAUCHE` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`ID`, `NOM`, `PRENOM`, `LOGIN`, `PASSWORD`, `ADRESSE`, `VILLE`, `CP`, `MAIL`, `DATEEMBAUCHE`) VALUES
('1', 'Martin', 'Ayden', 'martin1', '202cb962ac59075b964b07152d234b70', '18 Bd des Anglais', 'Nantes', '44000', 'toto@toto.fr', '01/09/2012'),
('10', 'prof', 'prof', 'prof', 'd450c5dbcc10db0749277efc32f15f9f', 'Bd du Massacre', 'Nantes', '44100', 'sio.carcouet@gmail.com', '2012-2014'),
('2', 'Dubois', 'Bradley', 'martin2', '202cb962ac59075b964b07152d234b70', '152 Bd des Américains', 'Nantes', '44000', 'toto@toto.fr', '25/11/2007'),
('3', 'Garnier', 'Lorenzo', 'martin3', '202cb962ac59075b964b07152d234b70', '92 Avenue des Champs', 'Fleury les Aubrais', '45400', 'toto@toto.fr', '09/01/2012'),
('4', 'Lopez', 'Jenny', 'martin4', '202cb962ac59075b964b07152d234b70', '32 Ruelle des Illuminés', 'Metz', '57000', 'toto@toto.fr', '25/10/2008'),
('5', 'Blanc', 'Alysson', 'martin5', '202cb962ac59075b964b07152d234b70', '93 Rue de la Soif', 'Rennes', '35000', 'blanc@blanc.com', '05/08/2010'),
('6', 'Girard', 'Alistair', 'martin6', '202cb962ac59075b964b07152d234b70', '52 Avenue de l''étrange', 'Niort', '79000', '', '03/07/2009'),
('7', 'PASCO', 'Mathieu', 'mathieu', '202cb962ac59075b964b07152d234b70', '11, rue du gaie jean-louis', 'Rennes', '35700', '', 'ADMIN'),
('8', 'ADMIN', 'Valentin', 'val', '202cb962ac59075b964b07152d234b70', '15, rue de la joie', 'Nantes', '44000', 'moi@moi.moi', '01/01/2001'),
('9', 'ADMIN', 'Clément', 'clement', '202cb962ac59075b964b07152d234b70', '42, rue de l''indice', 'New-York', '99011', 'tit@titi.fr', 'ADMIN');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `medecin_ibfk_1` FOREIGN KEY (`ID_POSSEDE`) REFERENCES `specialite` (`ID`);

--
-- Contraintes pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `rapport_ibfk_1` FOREIGN KEY (`ID_CONCERNE`) REFERENCES `medecin` (`ID`),
  ADD CONSTRAINT `rapport_ibfk_2` FOREIGN KEY (`ID_REDIGER`) REFERENCES `visiteur` (`ID`),
  ADD CONSTRAINT `rapport_ibfk_3` FOREIGN KEY (`MOTIF`) REFERENCES `motif` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
