-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 08 Décembre 2016 à 09:56
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
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `surname`, `adress`, `description`, `region`, `city`, `phone`, `hours_credit`, `hours_debit`) VALUES
(1, 'jdupont35', 'jdupont35', 'jdupont35@fondationface.org', 'jdupont35@fondationface.org', 1, NULL, '$2y$13$7FHRT6ZLyg/X2IILNHz1tOnsTJzI6RGCzz/nOeGfpXWkqde.4UQv6', '2016-12-08 09:51:06', NULL, NULL, 'a:0:{}', 'Jean', 'Dupont', '23, rue d’Aiguillon\r\n35000 Rennes', 'Rennais passionné de bricolage, je peux vous aider dans tous vos petits travaux du quotidien.', 'Bretagne', 'Rennes', '0612244896', 20, 10),
(2, 'educlos', 'educlos', 'educlos@fondationface.org', 'educlos@fondationface.org', 1, NULL, '$2y$13$BZr2rMS8hqWzwEt4amO2n.mUs41tYjBWSqiE9InB6vgU8lmeVo822', '2016-12-08 09:53:29', NULL, NULL, 'a:0:{}', 'Erwann', 'Duclos', '17, allée des Acacias\r\n22440 Ploufragan', 'Développeur de métier, je suis à votre disposition pour tous vos soucis informatiques ;-)', 'Bretagne', 'Ploufragan', '0408163264', 20, 5),
(3, 'massacor', 'massacor', 'amenager@fondationface.org', 'amenager@fondationface.org', 1, NULL, '$2y$13$vTWM6asSrHBdx4MY9tAMB.d9uIdwF3wmTkEwi5NGCDBOIk8CFUsM.', '2016-12-08 09:55:51', NULL, NULL, 'a:0:{}', 'Ange', 'Ménager', '42, place de la Liberté\r\n75000 Paris', 'Sympathique et à l’aise avec les animaux, je m’occupe de vos amis à poils, plumes et écailles pendant vos absences.', 'Île de France', 'Paris', NULL, 5, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
