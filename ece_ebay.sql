-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 17 avr. 2020 à 15:43
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteurs`
--

INSERT INTO `acheteurs` (`ID`, `Nom`, `Prenom`, `Email`, `Mdp`, `Adresse1`, `Adresse2`, `Ville`, `Code_Postal`, `Pays`, `Tel`, `Type_paiement`, `Num_carte`, `Nom_carte`, `Date_exp`, `Code`) VALUES
(1, 'Marcel', 'Pagnol', 'pagno@ece.fr', 'marcel', 'nanaj 75', '', 'Pananame', 75001, 'France', 46546488, 'MASTERCARD', 454546446, 'G ELEM ME', '2020-05-14', 9598),
(2, 'fz', 'zfe', 'zffez@zfefz', 'fe', 'zefze', 'zeffez', 'VFDSC', 543, 'VFD', 6534, 'VISA', 354, 'GF', '2028-07-22', 5334);

-- --------------------------------------------------------

--
-- Structure de la table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_encheres` int(11) NOT NULL,
  `ID_acheteurs` int(11) NOT NULL,
  `Horaire` date NOT NULL,
  `Montant` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_encheres` (`ID_encheres`,`ID_acheteurs`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `Statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_items` (`ID_items`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `encheres`
--

INSERT INTO `encheres` (`ID`, `Prix`, `Date_debut`, `Date_fin`, `ID_items`, `Statut`) VALUES
(1, 35, '2020-04-01', '2020-04-08', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Video` varchar(255) NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `TypeVente1` varchar(255) NOT NULL,
  `TypeVente2` varchar(255) NOT NULL,
  `ID_Vendeur` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Vendeur` (`ID_Vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`ID`, `Nom`, `Photo`, `Description`, `Video`, `Categorie`, `TypeVente1`, `TypeVente2`, `ID_Vendeur`) VALUES
(1, 'Montre', '', 'Belle montre ancienne', '', 'VIP', 'Enchere', 'achatDirect', 5),
(2, 'Meuble', '', 'Meuble moderne', '', 'ferraille', 'nego', 'achatDirect', 6);

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `ID` int(11) NOT NULL,
  `ID_acheteurs` int(11) NOT NULL,
  `ID_vendeur` int(11) NOT NULL,
  `ID_items` int(11) NOT NULL,
  `Round` int(11) NOT NULL,
  `Montant` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_acheteurs` (`ID_acheteurs`,`ID_vendeur`,`ID_items`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`ID`, `Nom`, `Prenom`, `Pseudo`, `Email`, `Pdp`, `Image`) VALUES
(5, 'La', 'Fayette', 'pa', 'pa@ece.fr', '0', '0'),
(6, 'Robert', 'Spierre', 'robo', 'robo@ece.fr', '0', '0'),
(7, 'Yann', 'Houras', 'Yannis', 'yanou@gmail.com', 'C:wamp64wwwProjet_Piscine_Ing3image_commerce.png', 'C:wamp64wwwProjet_Piscine_Ing3image_fond_accueil.png'),
(8, 'Yann', 'Houras', 'Yannis', 'yanou@gmail.com', 'C:wamp64wwwProjet_Piscine_Ing3image_commerce.png', 'C:wamp64wwwProjet_Piscine_Ing3image_fond_accueil.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat_direct`
--
ALTER TABLE `achat_direct`
  ADD CONSTRAINT `achat_direct_ibfk_1` FOREIGN KEY (`ID_Items`) REFERENCES `items` (`ID`);

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
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_3` FOREIGN KEY (`ID_acheteur`) REFERENCES `acheteurs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
