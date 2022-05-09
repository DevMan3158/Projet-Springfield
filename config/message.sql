-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb:3311
-- Généré le : ven. 06 mai 2022 à 01:20
-- Version du serveur : 10.4.18-MariaDB-1:10.4.18+maria~focal-log
-- Version de PHP : 8.0.15

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

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `Id_msg` int(10) NOT NULL,
  `Nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Prenom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `lu` tinyint(2) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message_lu`
--

CREATE TABLE `message_lu` (
  `id_msg_lu` int(10) NOT NULL,
  `id_msg` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message_produit`
--

CREATE TABLE `message_produit` (
  `id_msg_prd` int(10) NOT NULL,
  `id_msg` int(10) NOT NULL,
  `id_produit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id_msg`);

--
-- Index pour la table `message_lu`
--
ALTER TABLE `message_lu`
  ADD PRIMARY KEY (`id_msg_lu`),
  ADD KEY `key_msg_lu_id_msg` (`id_msg`),
  ADD KEY `key_msg_lu_id_user` (`id_user`);

--
-- Index pour la table `message_produit`
--
ALTER TABLE `message_produit`
  ADD PRIMARY KEY (`id_msg_prd`),
  ADD KEY `key_msg_prd_id_produit` (`id_produit`),
  ADD KEY `key_msg_prd_id_msg` (`id_msg`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `Id_msg` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message_lu`
--
ALTER TABLE `message_lu`
  MODIFY `id_msg_lu` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message_produit`
--
ALTER TABLE `message_produit`
  MODIFY `id_msg_prd` int(10) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message_lu`
--
ALTER TABLE `message_lu`
  ADD CONSTRAINT `key_msg_lu_id_msg` FOREIGN KEY (`id_msg`) REFERENCES `messages` (`Id_msg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key_msg_lu_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message_produit`
--
ALTER TABLE `message_produit`
  ADD CONSTRAINT `key_msg_prd_id_msg` FOREIGN KEY (`id_msg`) REFERENCES `messages` (`Id_msg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key_msg_prd_id_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
