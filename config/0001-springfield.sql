-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb:3311
-- Généré le : sam. 21 mai 2022 à 02:09
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
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nom_admin` varchar(40) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nom` varchar(40) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `Id_msg` int(10) NOT NULL,
  `Nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Prenom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Objet` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
-- Structure de la table `pass_perdu`
--

CREATE TABLE `pass_perdu` (
  `id_pass_perdu` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jeton` varchar(255) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration` timestamp NOT NULL DEFAULT current_timestamp(),
  `valide` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(10) NOT NULL,
  `id_produit` int(10) NOT NULL,
  `src` varchar(100) NOT NULL DEFAULT '',
  `alt` varchar(255) NOT NULL DEFAULT '',
  `titre` varchar(255) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(10) NOT NULL,
  `id_cat` int(10) NOT NULL,
  `nom` varchar(40) NOT NULL DEFAULT '',
  `lieu` varchar(40) NOT NULL DEFAULT '',
  `nbvisite` int(20) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `id_user` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(10) NOT NULL,
  `id_admin` int(10) NOT NULL,
  `nom` varchar(40) NOT NULL DEFAULT '',
  `prenom` varchar(40) NOT NULL DEFAULT '',
  `login` varchar(40) NOT NULL DEFAULT '',
  `avatar` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mot_pass` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `cat_user` (`id_user`);

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
-- Index pour la table `pass_perdu`
--
ALTER TABLE `pass_perdu`
  ADD PRIMARY KEY (`id_pass_perdu`),
  ADD KEY `perdu_pass_user` (`id_user`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `photo_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `produit_cat` (`id_cat`),
  ADD KEY `produit_user` (`id_user`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_admin` (`id_admin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(10) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `pass_perdu`
--
ALTER TABLE `pass_perdu`
  MODIFY `id_pass_perdu` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `cat_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Contraintes pour la table `pass_perdu`
--
ALTER TABLE `pass_perdu`
  ADD CONSTRAINT `perdu_pass_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photo_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produit_cat` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `user_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
