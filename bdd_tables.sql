-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 13 nov. 2023 à 13:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `apeaj`
--

-- --------------------------------------------------------

--
-- Structure de la table `apprenti`
--

DROP TABLE IF EXISTS `apprenti`;
CREATE TABLE IF NOT EXISTS `apprenti` (
  `id_apprenti` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prénom` varchar(50) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_apprenti`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assister`
--

DROP TABLE IF EXISTS `assister`;
CREATE TABLE IF NOT EXISTS `assister` (
  `id_apprenti` int NOT NULL,
  `id_session` int NOT NULL,
  PRIMARY KEY (`id_apprenti`,`id_session`),
  KEY `id_session` (`id_session`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `id_élément` int NOT NULL,
  `id_fiche` int NOT NULL,
  `picto` varchar(50) DEFAULT NULL,
  `text` varchar(50) DEFAULT NULL,
  `taille_texte` varchar(50) DEFAULT NULL,
  `police` varchar(50) DEFAULT NULL,
  `audio` varchar(50) DEFAULT NULL,
  `couleur` varchar(50) DEFAULT NULL,
  `couleur_fond` varchar(50) DEFAULT NULL,
  `niveau` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_élément`,`id_fiche`),
  KEY `id_fiche` (`id_fiche`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `educ_admin`
--

DROP TABLE IF EXISTS `educ_admin`;
CREATE TABLE IF NOT EXISTS `educ_admin` (
  `id_personnel` int NOT NULL,
  PRIMARY KEY (`id_personnel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `element_defaut`
--

DROP TABLE IF EXISTS `element_defaut`;
CREATE TABLE IF NOT EXISTS `element_defaut` (
  `id_élément` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `picto` varchar(50) DEFAULT NULL,
  `text` varchar(50) DEFAULT NULL,
  `audio` varchar(50) DEFAULT NULL,
  `id_personnel` int NOT NULL,
  PRIMARY KEY (`id_élément`),
  KEY `id_personnel` (`id_personnel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_intervention`
--

DROP TABLE IF EXISTS `fiche_intervention`;
CREATE TABLE IF NOT EXISTS `fiche_intervention` (
  `id_fiche` int NOT NULL AUTO_INCREMENT,
  `numéro` smallint DEFAULT NULL,
  `nom_du_demandeur` varchar(50) DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `date_intervention` date DEFAULT NULL,
  `durée_intervention` varchar(50) DEFAULT NULL,
  `localisation` varchar(50) DEFAULT NULL,
  `description_demande` text,
  `degré_urgence` varchar(50) DEFAULT NULL,
  `type_intervention` varchar(50) DEFAULT NULL,
  `nature_intervention` varchar(50) DEFAULT NULL,
  `couleur_intervention` varchar(50) DEFAULT NULL,
  `etat_fiche` varchar(50) DEFAULT NULL,
  `date_création` datetime DEFAULT NULL,
  `id_personnel` int NOT NULL,
  `id_apprenti` int NOT NULL,
  PRIMARY KEY (`id_fiche`),
  KEY `id_personnel` (`id_personnel`),
  KEY `id_apprenti` (`id_apprenti`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_formation` int NOT NULL AUTO_INCREMENT,
  `intitulé` varchar(50) NOT NULL,
  `niveau_qualif` smallint DEFAULT NULL,
  `groupe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `laisser_trace`
--

DROP TABLE IF EXISTS `laisser_trace`;
CREATE TABLE IF NOT EXISTS `laisser_trace` (
  `id_personnel` int NOT NULL,
  `horodatage` datetime NOT NULL,
  `intitulé` varchar(50) DEFAULT NULL,
  `éval_texte` text,
  `commentaire_texte` text,
  `éval_audio` varchar(255) DEFAULT NULL,
  `commentaire_audio` varchar(50) DEFAULT NULL,
  `id_fiche` int NOT NULL,
  PRIMARY KEY (`id_personnel`,`horodatage`),
  KEY `id_fiche` (`id_fiche`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id_personnel` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prénom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_personnel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `description` text,
  PRIMARY KEY (`id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id_session` int NOT NULL AUTO_INCREMENT,
  `thème` varchar(50) DEFAULT NULL,
  `cours` varchar(50) DEFAULT NULL,
  `durée` int DEFAULT NULL,
  `id_formation` int NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `id_formation` (`id_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
