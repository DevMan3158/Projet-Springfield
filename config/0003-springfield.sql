-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 05 mai 2022 à 12:41
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
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `id_admin`, `nom`, `prenom`, `login`, `avatar`, `email`, `mot_pass`, `date`) VALUES
(1, 1, 'root', 'root', 'root', '', 'root@root.fr', 'TmpKMmNCRjI2V2NPU0xCMQ$Gi6Ucz29Na2efDYcEgyx+7s5TT2VHpSiWYx8qo546T4', '2022-05-05 13:44:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `id_user`, `nom`, `description`, `avatar`, `date`) VALUES
(1, 1, 'Lieux', '', '../img/map.png', '2022-05-05 09:48:01'),
(2, 1, 'Batiments', '', '../img/musee.png', '2022-05-05 09:48:01'),
(3, 1, 'Personnages', '', '../img/expo.png', '2022-05-05 09:48:01');
COMMIT;
