-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 08 Décembre 2016 à 10:06
-- Version du serveur :  10.0.27-MariaDB-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boueecorsaire`
--

--
-- Contenu de la table `needs`
--

INSERT INTO `needs` (`id`, `user_id`, `level`, `hours`, `title`, `description`, `location`, `status`, `date`) VALUES
(1, 3, '2', 5, 'Fuite de baignoire', 'Une fuite d’eau dans ma salle de bains provoque des infiltrations d’eau chez mon voisin.\r\nJ’ai besoin de l’aide de quelqu’un avec de l’expérience en plomberie pour régler ce souci.', 'Paris', 'OP', '2016-12-08 10:00:20'),
(2, 1, '1', 2, 'Cours d’anglais', 'En prévision d’un voyage d’affaires, je souhaite apprendre quelques bases en anglais.', 'Rennes', 'OP', '2016-12-08 10:06:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
