-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 16 juin 2023 à 10:12
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddcompresseur`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

DROP TABLE IF EXISTS `alerte`;
CREATE TABLE IF NOT EXISTS `alerte` (
  `id` int(11) NOT NULL,
  `idMesure` int(11) NOT NULL,
  `typeDefaut` varchar(20) NOT NULL,
  `seuilAtteint` double NOT NULL,
  `seuilLimite` double NOT NULL,
  `dateDefaut` date NOT NULL,
  `heureDefaut` time NOT NULL,
  `tempsDiffDate` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alerte_FK_1` (`idMesure`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alerte`
--

INSERT INTO `alerte` (`id`, `idMesure`, `typeDefaut`, `seuilAtteint`, `seuilLimite`, `dateDefaut`, `heureDefaut`, `tempsDiffDate`) VALUES
(0, 0, 'DateActuelle', 0, 0, '2023-06-15', '16:40:11', 0),
(4, 1, 'maximum', 32, 30, '2023-06-24', '09:55:55', -9),
(7, 2, 'maximum', 1.5, 1, '2023-06-23', '15:16:00', -8),
(15, 2, 'maximum', 2.1, 1, '2023-07-16', '09:55:50', -29),
(16, 1, 'maximum', 34, 30, '2023-10-18', '00:24:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

DROP TABLE IF EXISTS `capteur`;
CREATE TABLE IF NOT EXISTS `capteur` (
  `id` int(11) NOT NULL,
  `idCompresseur` int(11) NOT NULL,
  `idSeuil` int(11) NOT NULL,
  `uniteMesure` varchar(10) NOT NULL,
  `nomMesure` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `capteur_FK_1` (`idCompresseur`),
  KEY `capteur_FK_2` (`idSeuil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`id`, `idCompresseur`, `idSeuil`, `uniteMesure`, `nomMesure`) VALUES
(1, 1, 1, 'bar', 'Pression'),
(2, 1, 2, 'kWh', 'Energie');

-- --------------------------------------------------------

--
-- Structure de la table `compresseur`
--

DROP TABLE IF EXISTS `compresseur`;
CREATE TABLE IF NOT EXISTS `compresseur` (
  `id` int(11) NOT NULL,
  `etatCompresseur` tinyint(1) NOT NULL,
  `etatMarche` tinyint(1) NOT NULL,
  `heureDebutMarche` time NOT NULL,
  `idPurge` int(11) NOT NULL,
  `dateChangement` varchar(25) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `dateAutomatique` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `compresseur_FK_2` (`idPurge`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compresseur`
--

INSERT INTO `compresseur` (`id`, `etatCompresseur`, `etatMarche`, `heureDebutMarche`, `idPurge`, `dateChangement`, `mode`, `dateAutomatique`) VALUES
(1, 1, 1, '15:44:14', 1, '2023-06-15 15:44:14', 'manuel', '2023-06-15');

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL,
  `idCompresseur` int(11) NOT NULL,
  `ipCompresseur` varchar(50) DEFAULT NULL,
  `portCompresseur` smallint(6) NOT NULL,
  `info` varchar(100) DEFAULT NULL,
  `adresseMail` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(100) DEFAULT NULL,
  `relais` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `configuration_FK_1` (`idCompresseur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `configuration`
--

INSERT INTO `configuration` (`id`, `idCompresseur`, `ipCompresseur`, `portCompresseur`, `info`, `adresseMail`, `motDePasse`, `relais`) VALUES
(0, 1, '192.168.0.156', 502, 'Batiment A, Salle A20', 'compresseur.lrq@gmail.com', '33ba211acbfb225524d55a74d6adf12f46c68a3931bd054a84e8efdffa3393bc', 'smtp.free.fr'),
(1, 1, '192.168.0.156', 502, 'Batiment A, Salle A20', 'dfpt.lrq@gmail.com', '33ba211acbfb225524d55a74d6adf12f46c68a3931bd054a84e8efdffa3393bc', 'smtp.free.fr'),
(2, 1, NULL, 502, NULL, 'magasinier.lrq@gmail.com', '33ba211acbfb225524d55a74d6adf12f46c68a3931bd054a84e8efdffa3393bc', NULL),
(3, 1, '192.168.0.156', 502, 'Batiment A, Salle A20', 'bacpromelec.lrq@gmail.com', '33ba211acbfb225524d55a74d6adf12f46c68a3931bd054a84e8efdffa3393bc', 'smtp.free.fr');

-- --------------------------------------------------------

--
-- Structure de la table `creneauxhoraire`
--

DROP TABLE IF EXISTS `creneauxhoraire`;
CREATE TABLE IF NOT EXISTS `creneauxhoraire` (
  `id` int(11) NOT NULL,
  `idCompresseur` int(11) NOT NULL,
  `jour` varchar(10) NOT NULL,
  `heure` tinyint(4) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `crenauxhoraire_FK_1` (`idCompresseur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `creneauxhoraire`
--

INSERT INTO `creneauxhoraire` (`id`, `idCompresseur`, `jour`, `heure`, `actif`) VALUES
(1, 1, 'Lundi', 0, 0),
(2, 1, 'Lundi', 1, 0),
(3, 1, 'Lundi', 2, 0),
(4, 1, 'Lundi', 3, 0),
(5, 1, 'Lundi', 4, 0),
(6, 1, 'Lundi', 5, 0),
(7, 1, 'Lundi', 6, 0),
(8, 1, 'Lundi', 7, 1),
(9, 1, 'Lundi', 8, 1),
(10, 1, 'Lundi', 9, 1),
(11, 1, 'Lundi', 10, 1),
(12, 1, 'Lundi', 11, 1),
(13, 1, 'Lundi', 12, 1),
(14, 1, 'Lundi', 13, 1),
(15, 1, 'Lundi', 14, 1),
(16, 1, 'Lundi', 15, 1),
(17, 1, 'Lundi', 16, 1),
(18, 1, 'Lundi', 17, 1),
(19, 1, 'Lundi', 18, 1),
(20, 1, 'Lundi', 19, 0),
(21, 1, 'Lundi', 20, 0),
(22, 1, 'Lundi', 21, 0),
(23, 1, 'Lundi', 22, 0),
(24, 1, 'Lundi', 23, 0),
(25, 1, 'Mardi', 0, 0),
(26, 1, 'Mardi', 1, 0),
(27, 1, 'Mardi', 2, 0),
(28, 1, 'Mardi', 3, 0),
(29, 1, 'Mardi', 4, 0),
(30, 1, 'Mardi', 5, 0),
(31, 1, 'Mardi', 6, 0),
(32, 1, 'Mardi', 7, 1),
(33, 1, 'Mardi', 8, 1),
(34, 1, 'Mardi', 9, 1),
(35, 1, 'Mardi', 10, 1),
(36, 1, 'Mardi', 11, 1),
(37, 1, 'Mardi', 12, 1),
(38, 1, 'Mardi', 13, 1),
(39, 1, 'Mardi', 14, 1),
(40, 1, 'Mardi', 15, 1),
(41, 1, 'Mardi', 16, 1),
(42, 1, 'Mardi', 17, 1),
(43, 1, 'Mardi', 18, 1),
(44, 1, 'Mardi', 19, 0),
(45, 1, 'Mardi', 20, 0),
(46, 1, 'Mardi', 21, 0),
(47, 1, 'Mardi', 22, 0),
(48, 1, 'Mardi', 23, 0),
(49, 1, 'Mercredi', 0, 0),
(50, 1, 'Mercredi', 1, 0),
(51, 1, 'Mercredi', 2, 0),
(52, 1, 'Mercredi', 3, 0),
(53, 1, 'Mercredi', 4, 0),
(54, 1, 'Mercredi', 5, 0),
(55, 1, 'Mercredi', 6, 0),
(56, 1, 'Mercredi', 7, 1),
(57, 1, 'Mercredi', 8, 1),
(58, 1, 'Mercredi', 9, 1),
(59, 1, 'Mercredi', 10, 1),
(60, 1, 'Mercredi', 11, 1),
(61, 1, 'Mercredi', 12, 1),
(62, 1, 'Mercredi', 13, 1),
(63, 1, 'Mercredi', 14, 0),
(64, 1, 'Mercredi', 15, 0),
(65, 1, 'Mercredi', 16, 0),
(66, 1, 'Mercredi', 17, 0),
(67, 1, 'Mercredi', 18, 0),
(68, 1, 'Mercredi', 19, 0),
(69, 1, 'Mercredi', 20, 0),
(70, 1, 'Mercredi', 21, 0),
(71, 1, 'Mercredi', 22, 0),
(72, 1, 'Mercredi', 23, 0),
(73, 1, 'Jeudi', 0, 0),
(74, 1, 'Jeudi', 1, 0),
(75, 1, 'Jeudi', 2, 0),
(76, 1, 'Jeudi', 3, 0),
(77, 1, 'Jeudi', 4, 0),
(78, 1, 'Jeudi', 5, 0),
(79, 1, 'Jeudi', 6, 0),
(80, 1, 'Jeudi', 7, 1),
(81, 1, 'Jeudi', 8, 1),
(82, 1, 'Jeudi', 9, 1),
(83, 1, 'Jeudi', 10, 1),
(84, 1, 'Jeudi', 11, 1),
(85, 1, 'Jeudi', 12, 1),
(86, 1, 'Jeudi', 13, 1),
(87, 1, 'Jeudi', 14, 1),
(88, 1, 'Jeudi', 15, 1),
(89, 1, 'Jeudi', 16, 1),
(90, 1, 'Jeudi', 17, 1),
(91, 1, 'Jeudi', 18, 1),
(92, 1, 'Jeudi', 19, 0),
(93, 1, 'Jeudi', 20, 0),
(94, 1, 'Jeudi', 21, 0),
(95, 1, 'Jeudi', 22, 0),
(96, 1, 'Jeudi', 23, 0),
(97, 1, 'Vendredi', 0, 0),
(98, 1, 'Vendredi', 1, 0),
(99, 1, 'Vendredi', 2, 0),
(100, 1, 'Vendredi', 3, 0),
(101, 1, 'Vendredi', 4, 0),
(102, 1, 'Vendredi', 5, 0),
(103, 1, 'Vendredi', 6, 0),
(104, 1, 'Vendredi', 7, 1),
(105, 1, 'Vendredi', 8, 1),
(106, 1, 'Vendredi', 9, 1),
(107, 1, 'Vendredi', 10, 1),
(108, 1, 'Vendredi', 11, 1),
(109, 1, 'Vendredi', 12, 1),
(110, 1, 'Vendredi', 13, 1),
(111, 1, 'Vendredi', 14, 1),
(112, 1, 'Vendredi', 15, 1),
(113, 1, 'Vendredi', 16, 1),
(114, 1, 'Vendredi', 17, 1),
(115, 1, 'Vendredi', 18, 1),
(116, 1, 'Vendredi', 19, 0),
(117, 1, 'Vendredi', 20, 0),
(118, 1, 'Vendredi', 21, 0),
(119, 1, 'Vendredi', 22, 0),
(120, 1, 'Vendredi', 23, 0),
(121, 1, 'Samedi', 0, 0),
(122, 1, 'Samedi', 1, 0),
(123, 1, 'Samedi', 2, 0),
(124, 1, 'Samedi', 3, 0),
(125, 1, 'Samedi', 4, 0),
(126, 1, 'Samedi', 5, 0),
(127, 1, 'Samedi', 6, 0),
(128, 1, 'Samedi', 7, 1),
(129, 1, 'Samedi', 8, 1),
(130, 1, 'Samedi', 9, 1),
(131, 1, 'Samedi', 10, 1),
(132, 1, 'Samedi', 11, 1),
(133, 1, 'Samedi', 12, 1),
(134, 1, 'Samedi', 13, 1),
(135, 1, 'Samedi', 14, 0),
(136, 1, 'Samedi', 15, 0),
(137, 1, 'Samedi', 16, 0),
(138, 1, 'Samedi', 17, 0),
(139, 1, 'Samedi', 18, 0),
(140, 1, 'Samedi', 19, 0),
(141, 1, 'Samedi', 20, 0),
(142, 1, 'Samedi', 21, 0),
(143, 1, 'Samedi', 22, 0),
(144, 1, 'Samedi', 23, 0),
(145, 1, 'Dimanche', 0, 0),
(146, 1, 'Dimanche', 1, 0),
(147, 1, 'Dimanche', 2, 0),
(148, 1, 'Dimanche', 3, 0),
(149, 1, 'Dimanche', 4, 0),
(150, 1, 'Dimanche', 5, 0),
(151, 1, 'Dimanche', 6, 0),
(152, 1, 'Dimanche', 7, 0),
(153, 1, 'Dimanche', 8, 0),
(154, 1, 'Dimanche', 9, 0),
(155, 1, 'Dimanche', 10, 0),
(156, 1, 'Dimanche', 11, 0),
(157, 1, 'Dimanche', 12, 0),
(158, 1, 'Dimanche', 13, 0),
(159, 1, 'Dimanche', 14, 0),
(160, 1, 'Dimanche', 15, 0),
(161, 1, 'Dimanche', 16, 0),
(162, 1, 'Dimanche', 17, 0),
(163, 1, 'Dimanche', 18, 0),
(164, 1, 'Dimanche', 19, 0),
(165, 1, 'Dimanche', 20, 0),
(166, 1, 'Dimanche', 21, 0),
(167, 1, 'Dimanche', 22, 0),
(168, 1, 'Dimanche', 23, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

DROP TABLE IF EXISTS `mesure`;
CREATE TABLE IF NOT EXISTS `mesure` (
  `id` int(11) NOT NULL,
  `idCapteur` int(11) NOT NULL,
  `donnee` double NOT NULL,
  `horodatage` varchar(25) NOT NULL,
  `dateMesure` date DEFAULT NULL,
  `heureMesure` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mesure_FK_1` (`idCapteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mesure`
--

INSERT INTO `mesure` (`id`, `idCapteur`, `donnee`, `horodatage`, `dateMesure`, `heureMesure`) VALUES
(2, 2, 1.2, '2023-05-03', NULL, NULL),
(0, 1, 32, '2023-05-02', NULL, NULL),
(10, 1, 8, '2023-05-05', NULL, NULL),
(3, 1, 35, '2023-05-17', NULL, NULL),
(4, 1, 9.2, '2023-05-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `purgecompresseur`
--

DROP TABLE IF EXISTS `purgecompresseur`;
CREATE TABLE IF NOT EXISTS `purgecompresseur` (
  `id` int(11) NOT NULL,
  `t_ON` tinyint(4) NOT NULL,
  `t_OFF` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `purgecompresseur`
--

INSERT INTO `purgecompresseur` (`id`, `t_ON`, `t_OFF`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

DROP TABLE IF EXISTS `semaine`;
CREATE TABLE IF NOT EXISTS `semaine` (
  `id` int(11) NOT NULL,
  `idCompresseur` int(11) NOT NULL,
  `numero` tinyint(4) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `semaineEntretien` tinyint(1) NOT NULL,
  `dateSemaine` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `semaine_FK_1` (`idCompresseur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `semaine`
--

INSERT INTO `semaine` (`id`, `idCompresseur`, `numero`, `actif`, `semaineEntretien`, `dateSemaine`) VALUES
(1, 1, 1, 1, 0, '01.01.2024 - 07.01.2024'),
(2, 1, 2, 1, 0, '08.01.2024 - 14.01.2024'),
(3, 1, 3, 1, 0, '15.01.2024 - 21.01.2024'),
(4, 1, 4, 1, 0, '22.01.2024 - 28.01.2024'),
(5, 1, 5, 1, 0, '29.01.2024 - 04.02.2024'),
(6, 1, 6, 1, 0, '05.02.2024 - 11.02.2024'),
(7, 1, 7, 0, 0, '12.02.2024 - 18.02.2024'),
(8, 1, 8, 0, 0, '19.02.2024 - 25.02.2024'),
(9, 1, 9, 1, 0, '26.02.2024 - 03.03.2024'),
(10, 1, 10, 1, 0, '04.03.2024 - 10.03.2024'),
(11, 1, 11, 1, 0, '11.03.2024 - 17.03.2024'),
(12, 1, 12, 1, 0, '18.03.2024 - 24.03.2024'),
(13, 1, 13, 1, 0, '25.03.2024 - 31.03.2024'),
(14, 1, 14, 1, 0, '01.04.2024 - 07.04.2024'),
(15, 1, 15, 1, 0, '08.04.2024 - 14.04.2024'),
(16, 1, 16, 0, 0, '15.04.2024 - 21.04.2024'),
(17, 1, 17, 0, 0, '22.04.2024 - 28.04.2024'),
(18, 1, 18, 1, 0, '29.04.2024 - 05.05.2024'),
(19, 1, 19, 1, 0, '06.05.2024 - 12.05.2024'),
(20, 1, 20, 1, 0, '13.05.2024 - 19.05.2024'),
(21, 1, 21, 1, 0, '20.05.2024 - 26.05.2024'),
(22, 1, 22, 1, 0, '27.05.2024 - 02.06.2024'),
(23, 1, 23, 1, 0, '03.06.2024 - 09.06.2024'),
(24, 1, 24, 1, 0, '10.06.2024 - 16.06.2024'),
(25, 1, 25, 1, 0, '17.06.2024 - 23.06.2024'),
(26, 1, 26, 1, 0, '24.06.2024 - 30.06.2024'),
(27, 1, 27, 1, 0, '01.07.2024 - 07.07.2024'),
(28, 1, 28, 0, 0, '08.07.2024 - 14.07.2024'),
(29, 1, 29, 0, 0, '15.07.2024 - 21.07.2024'),
(30, 1, 30, 0, 0, '22.07.2024 - 28.07.2024'),
(31, 1, 31, 0, 0, '29.07.2024 - 04.08.2024'),
(32, 1, 32, 0, 0, '05.08.2024 - 11.08.2024'),
(33, 1, 33, 0, 0, '12.08.2024 - 18.08.2024'),
(34, 1, 34, 0, 0, '19.08.2024 - 25.08.2024'),
(35, 1, 35, 1, 0, '26.08.2024 - 01.09.2024'),
(36, 1, 36, 1, 0, '02.09.2024 - 08.09.2024'),
(37, 1, 37, 1, 0, '09.09.2024 - 15.09.2024'),
(38, 1, 38, 1, 0, '16.09.2024 - 22.09.2024'),
(39, 1, 39, 1, 0, '23.09.2024 - 29.09.2024'),
(40, 1, 40, 1, 0, '30.09.2024 - 06.10.2024'),
(41, 1, 41, 1, 0, '07.10.2024 - 13.10.2024'),
(42, 1, 42, 1, 0, '14.10.2024 - 20.10.2024'),
(43, 1, 43, 0, 0, '21.10.2024 - 27.10.2024'),
(44, 1, 44, 0, 0, '28.10.2024 - 03.11.2024'),
(45, 1, 45, 1, 0, '04.11.2024 - 10.11.2024'),
(46, 1, 46, 1, 0, '11.11.2024 - 17.11.2024'),
(47, 1, 47, 1, 0, '18.11.2024 - 24.11.2024'),
(48, 1, 48, 1, 0, '25.11.2024 - 01.12.2024'),
(49, 1, 49, 1, 0, '02.12.2024 - 08.12.2024'),
(50, 1, 50, 1, 0, '09.12.2024 - 15.12.2024'),
(51, 1, 51, 0, 0, '16.12.2024 - 22.12.2024'),
(52, 1, 52, 0, 0, '23.12.2024 - 29.12.2024');

-- --------------------------------------------------------

--
-- Structure de la table `seuil`
--

DROP TABLE IF EXISTS `seuil`;
CREATE TABLE IF NOT EXISTS `seuil` (
  `id` int(11) NOT NULL,
  `seuilMin` double NOT NULL,
  `seuilMax` double NOT NULL,
  `etatSeuilMax` tinyint(1) NOT NULL,
  `etatSeuilMin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seuil`
--

INSERT INTO `seuil` (`id`, `seuilMin`, `seuilMax`, `etatSeuilMax`, `etatSeuilMin`) VALUES
(1, 10, 30, 1, 1),
(2, 0, 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
