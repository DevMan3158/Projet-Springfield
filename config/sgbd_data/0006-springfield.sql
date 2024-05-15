-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 18 mai 2022 à 11:58
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
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `id_cat`, `nom`, `lieu`, `nbvisite`, `description`, `id_user`, `date`) VALUES
(46, 3, 'Hugo Simpson II', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Hugo est le frère siamois de Bart Simpson de naissance. Peu de temps après, ils ont été séparés par le Docteur Hibbert et Hugo vit seul depuis cette séparation dans le grenier. [/b]', 1, '2022-05-20 09:20:21'),
(47, 3, 'Robert Terwilliger', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Robert Terwilliger plus connu sous le nom de Tahiti Bob ou Sideshow Bob est un ancien partenaire de scène de Krusty le Clown. Il est tombé dans le crime et n\'a désormais qu\'une ambition, tuer Bart Simpson. [/b]', 1, '2022-05-20 09:21:39'),
(48, 3, 'Mona Simpson', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Mona Simpson née Penelope Olsen est la mère d\'Homer et la compagne d\'Abraham Simpson. Elle apparaît dans l\'épisode La Mère d\'Homer.\r\nOn l\'a longtemps crue morte, jusqu\'à ce que l\'on découvre qu\'elle avait entamé des poursuites à cause d\'une rencontre avec le propriétaire de la centrale nucléaire Charles Montgomery Burns plusieurs années auparavant. [/b]', 1, '2022-05-20 09:22:36'),
(49, 3, 'Maude Flanders', '', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Maude Flanders (1960-2000) était l\'épouse de Ned Flanders, et la mère de Rod et Todd. Maude est une femme avec beaucoup de qualités : la foi, la chasteté, la charité. Elle aime dessiner, activité découverte après sa mort. [/b]', 1, '2022-05-20 09:23:22'),
(50, 3, 'Herbert Powell', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Herbert « Herb » Powell est le demi-frère d\'Homer.\r\n Il a été abandonné à l\'orphelinat de Shelbyville peu après sa naissance et son existence a été cachée à Homer. [/b]', 1, '2022-05-20 09:24:20'),
(51, 3, 'Abby', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    [b]Abby est la soeur d\'Abygail. Elle s\'occupe de celle-ci après qu\'elle ait subit un traumatisme en gardant Bart. [/b]', 1, '2022-05-20 09:24:52'),
(52, 3, 'Darcy', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Darcy est une fille venant de North Haverbrook. Bart éprouve des sentiments amoureux à son égard. [/b]', 1, '2022-05-20 09:25:23'),
(53, 3, 'Dame Judith Terwilliger', '', 0, '[title]  Histoire  [/title]\r\n\r\n    [b] Dame Judith Terwilliger (née Underdunk) est l\'épouse de Robert Terwilliger Sr. et la mère de Robert et Cecil Terwilliger. Elle est une actrice à la retraite. [/b]', 1, '2022-05-20 09:25:59');

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `id_produit`, `src`, `alt`, `titre`, `date`) VALUES
(41, 46, 'Hugo_Simpson2.webp', 'Une photo de Hugo Simpson II.', 'Hugo Simpson II', '2022-05-20 09:20:21'),
(42, 47, 'Sideshow_Bob.webp', 'Une photo de Robert Terwilliger.', 'Robert Terwilliger', '2022-05-20 09:21:39'),
(43, 48, 'Mona_Simpson.webp', 'Une photo de Mona Simpson.', 'Mona Simpson', '2022-05-20 09:22:36'),
(44, 49, 'Maude.webp', 'Une photo de Maude Flanders.', 'Maude Flanders', '2022-05-20 09:23:22'),
(45, 50, 'HerbPowell.webp', 'Une photo de Herbert Powell.', 'Herbert Powell', '2022-05-20 09:24:20'),
(46, 51, 'Abby.webp', 'Une photo de Abby.', 'Abby', '2022-05-20 09:24:52'),
(47, 52, 'Darcy.webp', 'Une photo de Darcy.', 'Darcy', '2022-05-20 09:25:23'),
(48, 53, 'Judith_Underdunk.webp', 'Une photo de Dame Judith Terwilliger.', 'Dame Judith Terwilliger', '2022-05-20 09:25:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
