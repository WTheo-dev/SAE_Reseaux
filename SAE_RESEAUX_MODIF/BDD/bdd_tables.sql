-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 mars 2024 à 10:26
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
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_apprenti`),
  UNIQUE KEY `id_Utilisateur` (`id_Utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `composer_présentation`
--

DROP TABLE IF EXISTS `composer_presentation`;
CREATE TABLE IF NOT EXISTS `composer_presentation` (
  `id_element` int NOT NULL,
  `id_fiche` int NOT NULL,
  `picto` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `text` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `taille_texte` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `audio` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `police` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `couleur` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `couleur_fond` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `niveau` tinyint DEFAULT NULL,
  `position_elem` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ordre_saisie_focus` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_element`,`id_fiche`),
  KEY `id_fiche` (`id_fiche`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `id_session` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_fiche` int NOT NULL,
  `id_materiaux` int NOT NULL,
  PRIMARY KEY (`id_session`,`id_utilisateur`,`id_fiche`,`id_materiaux`),
  KEY `id_utilisateur` (`id_utilisateur`,`id_fiche`,`id_materiaux`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `educ_admin`
--

DROP TABLE IF EXISTS `educ_admin`;
CREATE TABLE IF NOT EXISTS `educ_admin` (
  `id_personnel` int NOT NULL,
  PRIMARY KEY (`id_personnel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `element_defaut`
--

DROP TABLE IF EXISTS `element_defaut`;
CREATE TABLE IF NOT EXISTS `element_defaut` (
  `id_element` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picto` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `text` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `audio` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_personnel` int NOT NULL,
  PRIMARY KEY (`id_element`),
  KEY `id_personnel` (`id_personnel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_intervention`
--

DROP TABLE IF EXISTS `fiche_intervention`;
CREATE TABLE IF NOT EXISTS `fiche_intervention` (
  `id_fiche` int NOT NULL AUTO_INCREMENT,
  `numero` smallint DEFAULT NULL,
  `nom_du_demandeur` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `date_intervention` date DEFAULT NULL,
  `duree_intervention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `localisation` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_demande` text COLLATE utf8mb4_general_ci,
  `degre_urgence` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_intervention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nature_intervention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `couleur_intervention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etat_fiche` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `id_personnel` int NOT NULL,
  `id_apprenti` int NOT NULL,
  PRIMARY KEY (`id_fiche`),
  KEY `id_personnel` (`id_personnel`),
  KEY `id_apprenti` (`id_apprenti`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_formation` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `niveau_qualif` smallint DEFAULT NULL,
  `groupe` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `laisser_trace`
--

DROP TABLE IF EXISTS `laisser_trace`;
CREATE TABLE IF NOT EXISTS `laisser_trace` (
  `id_personnel` int NOT NULL,
  `horodatage` datetime NOT NULL,
  `intitule` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eval_texte` text COLLATE utf8mb4_general_ci,
  `commentaire_texte` text COLLATE utf8mb4_general_ci,
  `eval_audio` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `commentaire_audio` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_fiche` int NOT NULL,
  PRIMARY KEY (`id_personnel`,`horodatage`),
  KEY `id_fiche` (`id_fiche`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matériaux`
--

DROP TABLE IF EXISTS `materiaux`;
CREATE TABLE IF NOT EXISTS `materiaux` (
  `id_utilisateur` int NOT NULL,
  `id_fiche` int NOT NULL,
  `id_materiaux` int NOT NULL AUTO_INCREMENT,
  `nom_image` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom_materiaux` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_intervention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_fiche`,`id_materiaux`),
  KEY `id_fiche` (`id_fiche`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id_personnel` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`id_personnel`),
  UNIQUE KEY `id_Utilisateur` (`id_Utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rôle_`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `description` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id_session` int NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cours` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `id_formation` int NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `id_formation` (`id_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_Utilisateur` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mdp` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_Utilisateur`),
  KEY `Id_role` (`id_role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
