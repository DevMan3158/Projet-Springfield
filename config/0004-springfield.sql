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
(1, 1, 'Krusty Burger', 'Interstate95', 0, '[title]\nHistoire\n[/title]\n[b]\nKrusty Burger est une chaîne de fast-food qui a été fondé à Springfield. Krusty Burger a été fondée par Krusty le clown.\n[/b]\n[title]\nBon à savoir\n[/title] \n[b]\nPropose également des repas pour enfants accompagnés de jouets, bien que les jouets eux-mêmes aient été créés dans des ateliers clandestins appartenant à Krusty.\n[/b]\n[title]\nPlats\n[/title]\n[b]\n-Burger croustillant\n\n-Burger Krusty frit\n\n-Sandwich à la Viande\n\n-Poumons de poulet (épicé ou doux)\n\n-Sauce-Grattez-les-Boisson à base de gomme Krusty partiellement gélatinée non laitière.\n[/b]', 1, '2022-05-05 10:05:25'),
(4, 2, 'Washington D.C', 'WashinStreet', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nWashington, D.C. , Officiellement le District fédéral de Columbia et communément appelé Washington, le district, est la capitale de l\' USA et de Springfield.\r\n[/b]\r\n', 1, '2022-05-05 10:24:52'),
(5, 2, 'Springfield Elementary School', ' Plympton Street', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nL\'école élémentaire de Springfield ou l\'école primaire de Springfield est l\'école où la plupart des enfants de Springfield sont scolarisés dont Bart et Lisa Simpson. Le principal/directeur est Seymour Skinner.\r\n[/b]\r\n[title]\r\nBon à savoir\r\n[/title] \r\n[b]\r\nÀ la cantine, la nourriture est décrite comme fade et les viandes servies sont bien souvent des morceaux d\'animaux de très basse qualité comme des organes, des tripes, etc.\r\n[/b]\r\n[title]\r\nCe qui est inclus\r\n[/title]\r\n[b]\r\nL’école dispose d’un « Mémorial des sorties scolaires » qui répertorie, sur l’un des murs extérieurs, le nom de tous les enfants qui ne sont pas revenus d’un voyage de classe.\r\n[/b]', 1, '2022-05-05 10:24:52'),
(6, 1, 'Evergreen terrace', 'Evergreen', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nEvergreen Terrace  est la rue dans laquelle vivent les Simpson . Les Simpson sont généralement mentionnés comme résidant au numéro 742. Par conséquent, les Flandres vivent à côté au numéro 744. Evergreen Terrace a également sa propre sortie de l\'autoroute.\r\n[/b]\r\n[title]\r\nBon à savoir\r\n[/title] \r\n[b]\r\nL\'ancien président George Bush a vécu en face des Simpson pendant une courte période.\r\n[/b]', 1, '2022-05-05 10:28:07'),
(9, 1, 'Cimetière de Springfield', 'En face de l\'Hôpital général.', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nLe Cimetière de Springfield est le plus grand cimetière de la ville.\r\n\r\nLa ville décida de déplacer le cimetière derrière la maison des Simpson ce qui terrifia Lisa car elle pouvait voir le cimetière par la fenêtre de sa chambre.\r\n[/b]\r\n\r\n\r\n\r\n', 1, '2022-05-05 10:33:23'),
(10, 1, 'Baie des Bourgots', 'En face de Springfield', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nBarnacle Bay est une île de la Nouvelle-Angleterre.\r\nL\'île possède un magasin qui vend du caramel, une promenade de bois en décomposition qui a été réparée et brûlée par Homer Simpson exactement le même jour, une église et un musée.\r\n[/b]\r\n', 1, '2022-05-05 10:33:23'),
(11, 3, 'Hommer', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nHomer est le quelqu\'un de plutôt gentil et d\'amical, mais il est stupide, obèse, maladroit, gourmand, peu cultivé, un ivrogne et colérique. Il vit à Springfield dans une grande maison avec sa femme, Marge.\r\n[/b]', 1, '2022-05-05 10:35:56'),
(16, 3, 'Marge', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nMarge est l\'épouse d\'Hommer et mère de trois enfants: Bart,Hugo, Lisa et Maggie Simpson.\r\n[/b]', 1, '2022-05-05 10:41:12'),
(17, 3, 'Bart', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nBart est le fils de Homer et Marge. Il est l\'enfant cancre américain par excellence, il n\'aime pas l\'école et préfère la télévision ou les bandes dessinées.\r\n[/b]', 1, '2022-05-05 10:41:12'),
(18, 3, 'Lisa', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nLisa Simpson, est la première fille de Marge et Homer Simpson. Lisa est extrêmement intelligente et est même la personne la plus cultivée de sa famille. Elle sait jouer du saxophone et est végétarienne.\r\n[/b]', 1, '2022-05-05 10:41:12'),
(19, 3, 'Maggie', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nMaggie Simpson est la troisième et dernière enfant d\'Homer Simpson et de Marge Simpson. Elle n\'a qu\'un an. Maggie Simpson ne parle pas, elle marche debout ou à quatre pattes. Elle ne se sépare jamais de sa tétine rouge fétiche.\r\n[/b]', 1, '2022-05-05 10:41:12'),
(20, 3, 'Abraham', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nAbraham est le grand-père de la famille Simpson. Il est l\'ex-époux de Mona Simpson avec qui il a eu Homer Simpson. Il est également le grand-père de Bart, Lisa et Maggie. Il sert souvent de babysitteur à ses petits enfants.\r\n[/b]', 1, '2022-05-05 10:42:16');

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `id_produit`, `src`, `alt`, `titre`, `date`) VALUES
(1, 1, 'krusty-burger.webp', 'Le restaurant Krusty Burger', 'Krusty Burger', '2022-05-05 10:06:14'),
(2, 20, 'Abraham.png', 'Une photo du personnage Abraham', 'Abraham', '2022-05-06 03:49:14'),
(3, 10, 'Baie_des_Bourgots.webp', 'Une photo de l\'ile Baie des Bourgots', 'Baie des Bourgots', '2022-05-06 03:49:14'),
(4, 17, 'Bart.webp', 'Une photo du personnage Bart', 'Bart', '2022-05-06 03:49:14'),
(5, 9, 'Cimetiere_de_Springfield.webp', 'Une photo du cimetière de Springfield', 'Cimetière de Springfield', '2022-05-06 03:49:14'),
(6, 6, 'Evergreen_Terrace.webp', 'Une photo du quartier Evergreen Terrace', 'Evergreen Terrace', '2022-05-06 03:49:14'),
(7, 11, 'Homer.webp', 'Une photo du personnage Homer', 'Homer', '2022-05-06 03:49:14'),
(8, 18, 'Lisa.png', 'Une photo du personnage Lisa', 'Lisa', '2022-05-06 03:49:14'),
(9, 19, 'Maggie.webp', 'Une photo du personnage Maggie', 'Maggie', '2022-05-06 03:49:14'),
(10, 16, 'Marge.webp', 'Une photo du personnage Marge', 'Marge', '2022-05-06 03:49:14'),
(11, 5, 'springfield_school.webp', 'Une photo de Springfield School', 'Springfield School', '2022-05-06 03:49:14'),
(12, 4, 'Washington.webp', 'Une photo de Washington D.C', 'Washington D.C', '2022-05-06 03:49:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
