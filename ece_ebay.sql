-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 avr. 2020 à 15:58
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ece_ebay`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat_direct`
--

DROP TABLE IF EXISTS `achat_direct`;
CREATE TABLE IF NOT EXISTS `achat_direct` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prix` int(11) NOT NULL,
  `ID_Items` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Items` (`ID_Items`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `acheteurs`
--

DROP TABLE IF EXISTS `acheteurs`;
CREATE TABLE IF NOT EXISTS `acheteurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Adresse1` varchar(255) NOT NULL,
  `Adresse2` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `Code_Postal` int(11) NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `Tel` int(11) NOT NULL,
  `Type_paiement` varchar(255) NOT NULL,
  `Num_carte` int(100) NOT NULL,
  `Nom_carte` varchar(255) NOT NULL,
  `Date_exp` date NOT NULL,
  `Code` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteurs`
--

INSERT INTO `acheteurs` (`ID`, `Nom`, `Prenom`, `Email`, `Mdp`, `Adresse1`, `Adresse2`, `Ville`, `Code_Postal`, `Pays`, `Tel`, `Type_paiement`, `Num_carte`, `Nom_carte`, `Date_exp`, `Code`) VALUES
(1, 'Marcel', 'Pagnol', 'pagno@ece.fr', 'marcel', 'nanaj 75', '', 'Pananame', 75001, 'France', 46546488, 'MASTERCARD', 454546446, 'G ELEM ME', '2020-05-14', 9598);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `Pseudo`, `Mdp`) VALUES
(1, 'EbayCE', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `carte_credit`
--

DROP TABLE IF EXISTS `carte_credit`;
CREATE TABLE IF NOT EXISTS `carte_credit` (
  `Num_carte` int(255) NOT NULL,
  `ID_acheteur` int(11) NOT NULL,
  `Solde` int(255) NOT NULL,
  KEY `Num_carte` (`Num_carte`),
  KEY `ID_acheteur` (`ID_acheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `encheres`
--

DROP TABLE IF EXISTS `encheres`;
CREATE TABLE IF NOT EXISTS `encheres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prix` int(11) NOT NULL,
  `Date_debut` date NOT NULL,
  `Date_fin` date NOT NULL,
  `ID_items` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_items` (`ID_items`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `encheres`
--

INSERT INTO `encheres` (`ID`, `Prix`, `Date_debut`, `Date_fin`, `ID_items`) VALUES
(1, 35, '2020-04-01', '2020-04-08', 1);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Photo` int(255) NOT NULL,
  `Description` text NOT NULL,
  `Video` varchar(255) NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `ID_Vendeur` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Vendeur` (`ID_Vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`ID`, `Nom`, `Photo`, `Description`, `Video`, `Categorie`, `ID_Vendeur`) VALUES
(1, 'Montre', 0, 'Belle montre ancienne', '', 'Encheres', 5),
(2, 'Meuble', 0, 'Meuble moderne', '', 'Achat immediat', 6);

-- --------------------------------------------------------

--
-- Structure de la table `negociations`
--

DROP TABLE IF EXISTS `negociations`;
CREATE TABLE IF NOT EXISTS `negociations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prix` int(11) NOT NULL,
  `ID_items` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_items` (`ID_items`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `ID_acheteur` int(11) NOT NULL,
  `ID_items` int(11) NOT NULL,
  KEY `ID_acheteur` (`ID_acheteur`),
  KEY `ID_items` (`ID_items`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`ID_acheteur`, `ID_items`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pdp` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`ID`, `Nom`, `Prenom`, `Pseudo`, `Email`, `Pdp`, `Image`) VALUES
(5, 'La', 'Fayette', 'pa', 'pa@ece.fr', '0', '0'),
(6, 'Robert', 'Spierre', 'robo', 'robo@ece.fr', '0', '0');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat_direct`
--
ALTER TABLE `achat_direct`
  ADD CONSTRAINT `achat_direct_ibfk_1` FOREIGN KEY (`ID_Items`) REFERENCES `items` (`ID`);

--
-- Contraintes pour la table `carte_credit`
--
ALTER TABLE `carte_credit`
  ADD CONSTRAINT `carte_credit_ibfk_1` FOREIGN KEY (`ID_acheteur`) REFERENCES `acheteurs` (`ID`);

--
-- Contraintes pour la table `encheres`
--
ALTER TABLE `encheres`
  ADD CONSTRAINT `encheres_ibfk_1` FOREIGN KEY (`ID_items`) REFERENCES `items` (`ID`);

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`ID_Vendeur`) REFERENCES `vendeur` (`ID`);

--
-- Contraintes pour la table `negociations`
--
ALTER TABLE `negociations`
  ADD CONSTRAINT `negociations_ibfk_1` FOREIGN KEY (`ID_items`) REFERENCES `items` (`ID`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`ID_items`) REFERENCES `items` (`ID`),
  ADD CONSTRAINT `panier_ibfk_3` FOREIGN KEY (`ID_acheteur`) REFERENCES `acheteurs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
