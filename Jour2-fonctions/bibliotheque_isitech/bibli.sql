-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 24 juil. 2025 à 13:55
-- Version du serveur : 11.5.2-MariaDB
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibli`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE IF NOT EXISTS `auteurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  `Prénom` varchar(20) NOT NULL,
  `Nationalité` varchar(30) DEFAULT NULL,
  `Date_de_naissance` date DEFAULT NULL,
  `Biographie` text DEFAULT NULL,
  `Date_de_création` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `Nom` (`Nom`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `Nom`, `Prénom`, `Nationalité`, `Date_de_naissance`, `Biographie`, `Date_de_création`) VALUES
(1, 'Hugo', 'Victor', 'Française', '1802-02-26', NULL, '2025-06-25 14:14:38'),
(2, 'Zola', 'Émile', 'Française', '1840-04-02', NULL, '2025-06-25 14:14:38'),
(3, 'Christie', 'Agatha', 'Britannique', '1890-09-15', NULL, '2025-06-25 14:14:38'),
(4, 'Asimov', 'Isaac', 'Américaine', '1920-01-02', NULL, '2025-06-25 14:14:38'),
(5, 'Saint-Exupéry', 'Antoine', 'Française', '1900-06-29', NULL, '2025-06-25 14:14:38'),
(6, 'Camus', 'Albert', 'Française', '1913-11-07', NULL, '2025-06-25 14:14:38'),
(7, 'Verne', 'Jules', 'Française', '1828-02-08', NULL, '2025-06-25 14:14:38'),
(8, 'Werber', 'Bernard', 'Française', NULL, NULL, '2025-06-26 14:56:21'),
(9, 'test', 'test', NULL, NULL, NULL, '2025-07-24 07:25:16');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

DROP TABLE IF EXISTS `emprunts`;
CREATE TABLE IF NOT EXISTS `emprunts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_livre` int(11) DEFAULT NULL,
  `ID_membre` int(11) DEFAULT NULL,
  `Date_emprunt` timestamp NULL DEFAULT current_timestamp(),
  `Date_retour_prévue` timestamp NOT NULL,
  `Date_retour_effective` date DEFAULT NULL,
  `Prolongation` date DEFAULT NULL,
  `Notes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_livre` (`ID_livre`),
  KEY `ID_membre` (`ID_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`ID`, `ID_livre`, `ID_membre`, `Date_emprunt`, `Date_retour_prévue`, `Date_retour_effective`, `Prolongation`, `Notes`) VALUES
(1, 1, 1, '2025-05-31 22:00:00', '2025-06-14 22:00:00', '2025-06-14', NULL, NULL),
(2, 2, 2, '2025-06-09 22:00:00', '2025-06-23 22:00:00', NULL, '2025-07-08', NULL),
(3, 3, 3, '2025-05-19 22:00:00', '2025-06-02 22:00:00', '2025-06-05', NULL, NULL),
(4, 4, 4, '2025-06-17 22:00:00', '2025-07-01 22:00:00', '2025-06-26', NULL, NULL),
(5, 5, 5, '2025-04-21 22:00:00', '2025-05-05 22:00:00', '2025-05-06', NULL, NULL),
(6, 2, 1, '2025-06-10 07:00:00', '2025-06-24 07:00:00', NULL, NULL, NULL),
(7, 3, 2, '2025-06-11 08:00:00', '2025-06-25 08:00:00', NULL, NULL, NULL),
(8, 4, 3, '2025-06-12 09:00:00', '2025-06-26 09:00:00', '2025-06-21', NULL, NULL),
(9, 5, 4, '2025-06-13 10:00:00', '2025-06-27 10:00:00', '2025-06-30', NULL, NULL),
(10, 1, 5, '2025-06-14 11:00:00', '2025-06-28 11:00:00', NULL, NULL, NULL),
(11, 2, 2, '2025-06-15 12:00:00', '2025-06-29 12:00:00', NULL, NULL, NULL),
(12, 3, 3, '2025-06-16 13:00:00', '2025-06-30 13:00:00', NULL, NULL, NULL),
(13, 4, 4, '2025-06-17 14:00:00', '2025-07-01 14:00:00', NULL, NULL, NULL),
(14, 5, 1, '2025-06-18 15:00:00', '2025-07-02 15:00:00', '2025-07-04', NULL, NULL),
(15, 1, 2, '2025-06-19 16:00:00', '2025-07-03 16:00:00', NULL, NULL, NULL),
(16, 2, 3, '2025-06-20 17:00:00', '2025-07-04 17:00:00', '2025-07-01', NULL, NULL),
(17, 3, 4, '2025-06-21 18:00:00', '2025-07-05 18:00:00', NULL, NULL, NULL),
(18, 4, 5, '2025-06-22 19:00:00', '2025-07-06 19:00:00', '2025-06-25', NULL, NULL),
(19, 5, 1, '2025-06-23 20:00:00', '2025-07-07 20:00:00', NULL, NULL, NULL),
(20, 1, 3, '2025-06-24 07:30:00', '2025-07-08 07:30:00', NULL, NULL, NULL),
(21, 2, 4, '2025-06-25 08:30:00', '2025-07-09 08:30:00', '2025-06-28', NULL, NULL),
(22, 3, 5, '2025-06-26 09:30:00', '2025-07-10 09:30:00', NULL, NULL, NULL),
(23, 4, 1, '2025-06-27 10:30:00', '2025-07-11 10:30:00', NULL, NULL, NULL),
(24, 5, 2, '2025-06-28 11:30:00', '2025-07-12 11:30:00', NULL, NULL, NULL),
(25, 1, 4, '2025-06-29 12:30:00', '2025-07-13 12:30:00', '2025-07-04', NULL, NULL),
(26, 2, 5, '2025-06-30 13:30:00', '2025-07-14 13:30:00', NULL, NULL, NULL),
(27, 3, 1, '2025-07-01 14:30:00', '2025-07-15 14:30:00', NULL, NULL, NULL),
(28, 4, 2, '2025-07-02 15:30:00', '2025-07-16 15:30:00', NULL, NULL, NULL),
(29, 5, 3, '2025-07-03 16:30:00', '2025-07-17 16:30:00', NULL, NULL, NULL),
(30, 1, 5, '2025-07-04 17:30:00', '2025-07-18 17:30:00', '2025-07-20', NULL, NULL),
(31, 2, 1, '2025-07-05 18:30:00', '2025-07-19 18:30:00', NULL, NULL, NULL),
(32, 3, 2, '2025-07-06 19:30:00', '2025-07-20 19:30:00', NULL, NULL, NULL),
(33, 4, 3, '2025-07-07 20:30:00', '2025-07-21 20:30:00', NULL, NULL, NULL),
(34, 5, 4, '2025-07-07 22:00:00', '2025-07-21 22:00:00', NULL, NULL, NULL),
(35, 1, 1, '2025-07-09 08:45:00', '2025-07-23 08:45:00', NULL, NULL, NULL),
(36, 3, 6, '2025-06-26 15:26:56', '2025-07-10 15:26:56', NULL, NULL, NULL),
(37, 3, 5, '2025-07-24 22:00:00', '2025-07-23 22:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL CHECK (`note` between 1 and 5),
  `commentaire` text DEFAULT NULL,
  `date_evaluation` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_livre` (`id_livre`),
  KEY `id_membre` (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evaluations`
--

INSERT INTO `evaluations` (`id`, `id_livre`, `id_membre`, `note`, `commentaire`, `date_evaluation`) VALUES
(1, 1, 2, 5, 'Excellent livre, je recommande.', '2025-07-02 15:39:16'),
(2, 2, 3, 4, 'Belle découverte, bon rythme.', '2025-07-02 15:39:16'),
(3, 3, 1, 3, 'Moyen, je m’attendais à mieux.', '2025-07-02 15:39:16'),
(4, 4, 4, 5, 'Un chef-d’œuvre !', '2025-07-02 15:39:16'),
(5, 5, 1, 2, 'Pas très convaincu...', '2025-07-02 15:39:16'),
(6, 1, 5, 4, 'Très bon moment de lecture.', '2025-07-02 15:39:16'),
(7, 2, 2, 5, 'Une écriture fluide et prenante.', '2025-07-02 15:39:16'),
(8, 3, 4, 1, 'Difficile à terminer.', '2025-07-02 15:39:16'),
(9, 4, 3, 5, 'Une pépite.', '2025-07-02 15:39:16'),
(10, 5, 5, 3, 'Correct mais un peu lent par moments.', '2025-07-02 15:39:16');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_du_genre` varchar(30) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nom du genre` (`Nom_du_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `Nom_du_genre`, `Description`) VALUES
(1, 'Horreur', NULL),
(2, 'Polar', NULL),
(3, 'Enfant', NULL),
(4, 'Roman', NULL),
(5, 'Conte', NULL),
(6, 'Théâtre', NULL),
(7, 'Poésie', NULL),
(8, 'Manga', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Reference_vers_auteur` int(11) DEFAULT NULL,
  `Reference_vers_genre` int(11) DEFAULT NULL,
  `Annee_de_publication` int(4) DEFAULT NULL,
  `Nombre_de_pages` int(5) DEFAULT NULL,
  `Resume` text DEFAULT NULL,
  `Status_de_disponibilite` enum('Disponible','Indisponible','Non_référencé') DEFAULT NULL,
  `Date_ajout_automatique` timestamp NOT NULL DEFAULT current_timestamp(),
  `Index_appropries` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ISBN` (`ISBN`),
  KEY `FK_ID_auteur` (`Reference_vers_auteur`),
  KEY `FK_ID_genres` (`Reference_vers_genre`),
  KEY `Titre` (`Titre`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `Titre`, `ISBN`, `Reference_vers_auteur`, `Reference_vers_genre`, `Annee_de_publication`, `Nombre_de_pages`, `Resume`, `Status_de_disponibilite`, `Date_ajout_automatique`, `Index_appropries`) VALUES
(1, 'Les Misérables', '9782070409189', 1, 4, 1862, 424, NULL, NULL, '2025-06-25 14:21:18', NULL),
(2, 'Germinal', '9782253006743', 2, 4, 1885, 942, NULL, NULL, '2025-06-25 14:21:18', NULL),
(3, 'Le Crime de l’Orient-Express', '9780007119318', 3, 2, 1934, 642, NULL, NULL, '2025-06-25 14:21:18', NULL),
(4, 'Fondation', '9782070360534', 4, 1, 1951, 283, NULL, NULL, '2025-06-25 14:21:18', NULL),
(5, 'Le Petit Prince', '9780156013987', 5, 3, 1943, 289, NULL, 'Indisponible', '2025-06-25 14:21:18', NULL),
(6, 'L’Étranger', '9782070360022', 6, 4, 1942, 499, NULL, NULL, '2025-06-25 14:21:18', NULL),
(7, 'Voyage au centre de la Terre', '9782253006323', 7, 8, 1864, 626, NULL, NULL, '2025-06-25 14:21:18', NULL),
(8, 'Notre-Dame de Paris', '9782070409332', 1, 4, 1831, 634, NULL, NULL, '2025-06-25 14:21:18', NULL),
(9, 'La Peste', '9782070360428', 6, 4, 1947, 291, NULL, NULL, '2025-06-25 14:21:18', NULL),
(10, 'L’empire des anges', '89865463220', 8, 8, NULL, NULL, NULL, NULL, '2025-06-26 14:59:37', NULL),
(13, 'Les Veilleurs de l’Aube', '9782070467898', 4, 2, 2009, 378, NULL, 'Disponible', '2025-07-01 10:51:08', NULL),
(14, 'Ombres et Silences', '9782743649325', 3, 4, 1998, 512, NULL, 'Disponible', '2025-07-01 10:51:08', NULL),
(15, 'Le Dernier Jour d’un Condamné', '9782070409485', 1, NULL, NULL, NULL, NULL, 'Disponible', '2025-07-01 14:01:01', NULL),
(16, 'Boule et Bill', '549843216260', NULL, NULL, 1985, 45, NULL, 'Disponible', '2025-07-23 07:51:30', NULL),
(17, 'Apocalypse Now', '666666666666', 1, 1, 1999, 250, 'L\'enfer sur Terre arrive, aux abris !', 'Non_référencé', '2025-07-23 09:01:03', '1'),
(18, 'test', '1100110011', 5, 6, 2025, 1, 'zefefzefzfzefazf', 'Disponible', '2025-07-23 09:16:20', '44');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prénom` varchar(50) NOT NULL,
  `Email` text NOT NULL,
  `Téléphone` varchar(20) DEFAULT NULL,
  `Adresse` text DEFAULT NULL,
  `Date_de_naissance` date DEFAULT NULL,
  `Date_inscription` timestamp NULL DEFAULT current_timestamp(),
  `Statut` enum('actif','inactif') DEFAULT 'actif',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`Email`) USING HASH,
  KEY `Nom` (`Nom`),
  KEY `Statut` (`Statut`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`ID`, `Nom`, `Prénom`, `Email`, `Téléphone`, `Adresse`, `Date_de_naissance`, `Date_inscription`, `Statut`) VALUES
(1, 'Durand', 'Alice', 'alice.durand@mail.com', NULL, NULL, '1990-05-12', '2025-06-25 14:18:16', 'actif'),
(2, 'Martin', 'Bruno', 'bruno.martin@mail.com', NULL, NULL, '1985-09-22', '2025-06-25 14:18:16', 'actif'),
(3, 'Dupont', 'Claire', 'claire.dupont@mail.com', NULL, NULL, '1994-02-18', '2025-06-25 14:18:16', 'actif'),
(4, 'Bernard', 'David', 'david.bernard@mail.com', NULL, NULL, '1980-07-30', '2025-06-25 14:18:16', 'actif'),
(5, 'Moreau', 'Élodie', 'elodie.moreau@mail.com', NULL, NULL, '1992-11-03', '2025-06-25 14:18:16', 'actif'),
(6, 'Toto', 'Jeremy', 'j.toto@totomail.com', NULL, NULL, NULL, '2025-06-26 14:53:46', 'actif');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `FK_ID_Livre` FOREIGN KEY (`ID_livre`) REFERENCES `livres` (`id`),
  ADD CONSTRAINT `FK_ID_Membre` FOREIGN KEY (`ID_membre`) REFERENCES `membres` (`ID`);

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `FK_ID_auteur` FOREIGN KEY (`Reference_vers_auteur`) REFERENCES `auteurs` (`id`),
  ADD CONSTRAINT `FK_ID_genres` FOREIGN KEY (`Reference_vers_genre`) REFERENCES `genres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
