-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 25 juil. 2022 à 15:09
-- Version du serveur : 5.7.36
-- Version de PHP : 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_wimmo_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_demandeur`
--

DROP TABLE IF EXISTS `t_demandeur`;
CREATE TABLE IF NOT EXISTS `t_demandeur` (
  `id_demandeur` int(11) NOT NULL AUTO_INCREMENT,
  `email_demandeur` varchar(200) NOT NULL,
  `mobile_demandeur` varchar(200) NOT NULL,
  `dateCreation_demandeur` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_demandeur`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_demandeur`
--

INSERT INTO `t_demandeur` (`id_demandeur`, `email_demandeur`, `mobile_demandeur`, `dateCreation_demandeur`) VALUES
(1, 'sss', 'fff', '2022-05-01 13:02:48'),
(2, 'abdou@gmail.com', '0788667766', '2022-05-01 13:43:12'),
(3, 'abdou229@gmail.com', '0888667766', '2022-05-01 13:47:41'),
(4, 'abdou221@gmail.com', '0688667766', '2022-05-01 13:51:07'),
(5, 'weynndri@gmail.com', '0000000000', '2022-05-02 09:46:51'),
(6, 'jackofblade19@gmail.com', '0000000000', '2022-05-03 17:58:25'),
(7, 'jack@gmail.com', '123', '2022-05-03 18:03:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
