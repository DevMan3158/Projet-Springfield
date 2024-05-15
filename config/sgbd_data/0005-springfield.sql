-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 20 mai 2022 à 14:17
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `springfield`
--
CREATE DATABASE IF NOT EXISTS `springfield` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `springfield`;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`Id_msg`, `Nom`, `Prenom`, `Email`, `Objet`, `Message`, `lu`, `date`) VALUES
(1, 'Gumble', 'Bernard', 'Bernard@springfield.usa', 'A demain à la taverne de moe.', 'Demain il y a de la bière duff gratuite chez moe, faut venir :).', 0, '2022-05-19 14:47:56'),
(2, 'Simpson', 'Homer', 'Homer@springfield.usa', 'Perte de mot de passe.', 'Bonjour, \r\nJ\'ai perdu mon login et mot de passe. \r\nCordialement.', 0, '2022-05-20 09:47:28'),
(3, 'Seymour', 'Skinner', 'Skinner@springfield.usa', 'Perte de mot de passe.', 'Bonjour,\r\nJ\'ai perdu mon login et mot de passe.\r\nCordialement.', 0, '2022-05-20 09:55:48'),
(4, 'Burns', 'Montgomery', 'Burns@springfield.usa', 'Perte de mot de passe.', 'Bonjour,\r\nJ\'ai perdu mon login et mot de passe.\r\nCordialement.', 0, '2022-05-20 09:58:57'),
(5, 'le clown', 'Krusty', 'Krusty@springfield.usa', 'Perte de mot de passe.', 'Bonjour,\r\nJ\'ai perdu mon login et mot de passe.\r\nCordialement.', 0, '2022-05-20 09:59:39'),
(6, 'Simpson', 'Homer', 'Homer@springfield.usa', 'Les prix du restaurant', 'Bonjour,\r\nSerait-il possible d\'avoir les prix ?\r\nCordialement.', 1, '2022-05-20 12:09:07'),
(7, 'Skinner', 'Seymour', 'Skinner@springfield.usa', 'Les prix du restaurant', 'Bonjour,\r\nSerait-il possible d\'avoir les prix ?\r\nCordialement.', 0, '2022-05-20 12:09:46'),
(8, 'Burns', 'Montgomery', 'Burns@springfield.usa', 'Les prix du restaurant', 'Bonjour,\r\nSerait-il possible d\'avoir les prix ?\r\nCordialement.', 0, '2022-05-20 12:11:05'),
(9, 'Carlton', 'Carlson', 'Carlson@springfield.usa', 'A demain à la taverne de moe.', 'Demain il y a de la bière duff gratuite chez moe, faut venir :).', 0, '2022-05-20 12:15:16'),
(10, 'Lenford', 'Leonard', 'Leonard@springfield.usa', 'A demain à la taverne de moe.', 'Demain il y a de la bière duff gratuite chez moe, faut venir :).', 0, '2022-05-20 12:16:19');

--
-- Déchargement des données de la table `message_lu`
--

INSERT INTO `message_lu` (`id_msg_lu`, `id_msg`, `id_user`, `date`) VALUES
(1, 6, 1, '2022-05-20 12:16:42');

--
-- Déchargement des données de la table `message_produit`
--

INSERT INTO `message_produit` (`id_msg_prd`, `id_msg`, `id_produit`) VALUES
(1, 1, 11),
(2, 6, 28),
(3, 7, 28),
(4, 8, 28),
(5, 9, 11),
(6, 10, 11);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
