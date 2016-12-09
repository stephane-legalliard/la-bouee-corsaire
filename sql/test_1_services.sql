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
-- Contenu de la table `services`
--

INSERT INTO `services` (`id`, `user_id`, `level`, `title`, `description`, `location`, `status`, `date`) VALUES
(1, 3, '3', 'Garde d’animaux', 'Après une formation de vétérinaire, je suis très à l’aise au contact des animaux.\r\nJe me propose de garder vos animaux de compagnie lors de vos absences.', 'Paris', 'OP', '2016-12-08 10:02:11'),
(2, 2, '2', 'Réparation d’ordinateurs', 'Très à l’aise avec l’outil informatique, je me propose de régler tous vos petits soucis avec ces bêtes mystérieuses que sont les ordinateurs.', 'Ploufragan', 'OP', '2016-12-08 10:03:27'),
(3, 2, '3', 'Réalisation de sites Web', 'Développeur Web de métier, je réalise les sites Web qui vont vous aider à faire décoller vos activités.', 'France entière', 'OP', '2016-12-08 10:04:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
