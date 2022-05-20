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
(1, 1, 'Krusty Burger', 'Interstate95', 0, '[title]\nHistoire\n[/title]\n[b]\nKrusty Burger est une chaîne de fast-food qui a été fondé à Springfield. Krusty Burger a été fondée par Krusty le clown.\n[/b]\n[title]\nBon à savoir\n[/title] \n[b]\nPropose également des repas pour enfants accompagnés de jouets, bien que les jouets eux-mêmes aient été créés dans des ateliers clandestins appartenant à Krusty.\n[/b]\n[title]\nPlats\n[/title]\n[b]\n-Burger croustillant\n\n-Burger Krusty frit\n\n-Sandwich à la Viande\n\n-Poumons de poulet (épicé ou doux)\n\n-Sauce-Grattez-les-Boisson à base de gomme Krusty partiellement gélatinée non laitière.\n[/b]', 5, '2022-05-05 10:05:25'),
(4, 2, 'Washington D.C', 'WashinStreet', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nWashington, D.C. , Officiellement le District fédéral de Columbia et communément appelé Washington, le district, est la capitale de l\' USA et de Springfield.\r\n[/b]\r\n', 8, '2022-05-05 10:24:52'),
(5, 2, 'Springfield Elementary School', ' Plympton Street', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nL\'école élémentaire de Springfield ou l\'école primaire de Springfield est l\'école où la plupart des enfants de Springfield sont scolarisés dont Bart et Lisa Simpson. Le principal/directeur est Seymour Skinner.\r\n[/b]\r\n[title]\r\nBon à savoir\r\n[/title] \r\n[b]\r\nÀ la cantine, la nourriture est décrite comme fade et les viandes servies sont bien souvent des morceaux d\'animaux de très basse qualité comme des organes, des tripes, etc.\r\n[/b]\r\n[title]\r\nCe qui est inclus\r\n[/title]\r\n[b]\r\nL’école dispose d’un « Mémorial des sorties scolaires » qui répertorie, sur l’un des murs extérieurs, le nom de tous les enfants qui ne sont pas revenus d’un voyage de classe.\r\n[/b]', 3, '2022-05-05 10:24:52'),
(6, 1, 'Evergreen terrace', 'Evergreen', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nEvergreen Terrace  est la rue dans laquelle vivent les Simpson . Les Simpson sont généralement mentionnés comme résidant au numéro 742. Par conséquent, les Flandres vivent à côté au numéro 744. Evergreen Terrace a également sa propre sortie de l\'autoroute.\r\n[/b]\r\n[title]\r\nBon à savoir\r\n[/title] \r\n[b]\r\nL\'ancien président George Bush a vécu en face des Simpson pendant une courte période.\r\n[/b]', 8, '2022-05-05 10:28:07'),
(9, 1, 'Cimetière de Springfield', 'En face de l\'Hôpital général.', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nLe Cimetière de Springfield est le plus grand cimetière de la ville.\r\n\r\nLa ville décida de déplacer le cimetière derrière la maison des Simpson ce qui terrifia Lisa car elle pouvait voir le cimetière par la fenêtre de sa chambre.\r\n[/b]\r\n\r\n\r\n\r\n', 8, '2022-05-05 10:33:23'),
(10, 1, 'Baie des Bourgots', 'En face de Springfield', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nBarnacle Bay est une île de la Nouvelle-Angleterre.\r\nL\'île possède un magasin qui vend du caramel, une promenade de bois en décomposition qui a été réparée et brûlée par Homer Simpson exactement le même jour, une église et un musée.\r\n[/b]\r\n', 1, '2022-05-05 10:33:23'),
(11, 3, 'Hommer', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nHomer est le quelqu\'un de plutôt gentil et d\'amical, mais il est stupide, obèse, maladroit, gourmand, peu cultivé, un ivrogne et colérique. Il vit à Springfield dans une grande maison avec sa femme, Marge.\r\n[/b]', 2, '2022-05-05 10:35:56'),
(16, 3, 'Marge', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nMarge est l\'épouse d\'Hommer et mère de trois enfants: Bart,Hugo, Lisa et Maggie Simpson.\r\n[/b]', 2, '2022-05-05 10:41:12'),
(17, 3, 'Bart', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nBart est le fils de Homer et Marge. Il est l\'enfant cancre américain par excellence, il n\'aime pas l\'école et préfère la télévision ou les bandes dessinées.\r\n[/b]', 2, '2022-05-05 10:41:12'),
(18, 3, 'Lisa', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nLisa Simpson, est la première fille de Marge et Homer Simpson. Lisa est extrêmement intelligente et est même la personne la plus cultivée de sa famille. Elle sait jouer du saxophone et est végétarienne.\r\n[/b]', 2, '2022-05-05 10:41:12'),
(19, 3, 'Maggie', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nMaggie Simpson est la troisième et dernière enfant d\'Homer Simpson et de Marge Simpson. Elle n\'a qu\'un an. Maggie Simpson ne parle pas, elle marche debout ou à quatre pattes. Elle ne se sépare jamais de sa tétine rouge fétiche.\r\n[/b]', 2, '2022-05-05 10:41:12'),
(20, 3, 'Abraham', '', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nAbraham est le grand-père de la famille Simpson. Il est l\'ex-époux de Mona Simpson avec qui il a eu Homer Simpson. Il est également le grand-père de Bart, Lisa et Maggie. Il sert souvent de babysitteur à ses petits enfants.\r\n[/b]', 2, '2022-05-05 10:42:16'),
(21, 1, 'Springfield', 'Etats-Unis', 0, '[title]\r\nHistoire\r\n[/title]\r\n&lt;b&gt;Springfield est une ville (ou un village dans certains épisodes) du comté de Springfield , dans l\'État de Springfield, et est située dans la partie continentale des États-Unis , où vit la famille Simpson .&lt;/b&gt;', 8, '2022-05-19 10:19:33'),
(22, 2, 'Centrale nucléaire de Springfield', 'Derrière Springfield', 0, '[title]\r\nHistoire\r\n[/title]\r\n[b]\r\nLa centrale Nucléaire de Springfield est une centrale nucléaire composée de deux réacteurs à eau pressurisée. Elle appartient à M. Burns et est la principale source d\'énergie de la ville.\r\n[/b]', 8, '2022-05-19 10:26:48'),
(23, 2, 'Kwik-E-Mart', 'Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le Kwik-E-Mart est une épicerie à Springfield, géré par Apu Nahasapeemapetilon mais son frère Sanjay Nahasapeemapetilon l\'aide parfois. [/b]', 1, '2022-05-19 10:29:19'),
(24, 1, 'Shelbyville', 'Juste derrière Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Shelbyville est une ville située près de Springfield. Ces deux villes sont considérées comme jumelles, ce qui explique leur grande rivalité. Les Shelbyvilliens ne sont pas beaucoup plus intelligents que les habitants de Springfield. [/b]', 1, '2022-05-19 10:33:24'),
(25, 2, 'L\'Armoire à sandwiches de Grand-Maman', 'Sandwich Street', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] L\'Armoire à sandwiches de Grand-Maman, est le nom d\'une franchise de restaurant appartenant à Trudy Zangler. Cette dernière remarquera les talents de Marge en matière de sandwiches et lui offrit d\'ouvrir une franchise à Springfield, offre que Marge acceptera. [/b]', 1, '2022-05-19 10:35:37'),
(26, 2, 'La Maison Derrière', 'Derrière la maison', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] La Maison Derrière est une maison de boîte de strip-tease ou Homer s\'aventure régulièrement afin de se vider les esprits[/b]', 1, '2022-05-19 10:37:24'),
(27, 2, 'La mangeoire d\'oncle Moe', 'Derrière le musée', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] La mangeoire d\'oncle Moe est un bar familial qui remplace la Taverne de Moe dans l\'épisode Bart vend son âme. [/b]', 6, '2022-05-19 10:38:37'),
(28, 2, 'La Truffe Dorée', 'Dans une truffe bien secrete', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] La Truffe Dorée est un restaurant chic et de haute gastronomie situé à Springfield.\r\n\r\nIl a déjà employé Willie jusqu\'à ce qu\'il quitte et retourne à son ancien poste à l\'École élémentaire de Springfield.\r\n\r\nHomer a donné un mauvais rapport au restaurant lorsqu\'il travaillait en tant que critique gastronomique, uniquement parce que les autres critiques lui avait dit de le faire. [/b]', 1, '2022-05-19 10:39:36'),
(29, 2, 'Le Barnacle Rusty', 'Rusty hood', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le Barnacle Rusty est un restaurant sur le thème des pirates, À l\'origine, il n\'était que mentionné mais apparaît plus tard quand Eugene Fisk tient sa soirée de célibataire. [/b]', 1, '2022-05-19 10:40:59'),
(30, 2, 'Le Hollandais Volant', 'SeaFood street', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le Hollandais Volant, propriété du capitaine Horatio McCallister, est un restaurant de fruits de mer à Springfield. [/b]', 1, '2022-05-19 10:42:22'),
(31, 2, 'Le Hun Hungry', 'GermanStreet', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] The Hungry Hun est un restaurant de cuisine allemande situé dans l\'est de Springfield. [/b]', 1, '2022-05-19 10:43:00'),
(32, 1, 'Le pays du chocolat', 'Dans l\'imagination de Homer', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le pays du chocolat est un lieux imaginé par Homer.\r\n\r\nQuand des Allemands achètent la centrale nucléaire de Springfield ils expliquent à Homer qu\'ils viennent du « pays du chocolat », en faisant référence à l\'Allemagne. Cependant, ce dernier s\'imagine plutôt un endroit fantaisiste.\r\n\r\nCela cause des problèmes à Homer lors de son entrevue. En effet, lorsque les Allemands parviennent à le ramener à la réalité, Homer est licencié de la centrale. [/b]', 2, '2022-05-19 10:44:03'),
(33, 1, 'Le petit pays de la Duff', 'Parc d\'attraction Duffland', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le petit pays de la Duff est une attraction du parc d\'attractions de Duffland. Selma, Bart et Lisa font l\'attraction ensemble, Bart met au défi Lisa de boire l\'eau du fleuve. L\'eau lui donne des hallucinations. [/b]', 1, '2022-05-19 10:45:03'),
(34, 1, 'Les grottes du papa de Carl', 'Dans la foret derrière Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Les grottes du papa de Carl sont des grottes se trouvant à proximité de Springfield. La famille Simpson s\'y balade dans l\'épisode L\'Histoire apparemment sans fin . [/b]', 8, '2022-05-19 10:49:29'),
(35, 2, 'Luigi\'s', 'ItalianaStreet', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Luigi\'s est un restaurant italien situé dans le Little Italy district de Springfield. Le restaurant est la propriété et le gestionnaire de Luigi Risotto, Luigi est toujours fermé le lundi. [/b]', 1, '2022-05-19 10:50:32'),
(36, 2, 'Agence Le blazer rouge', 'En plein centre ville', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] L\'Agence Le blazer rouge est une agence immobilière fondée par Lionel Hutz. [/b]', 1, '2022-05-19 10:51:15'),
(37, 1, 'Amulet Hamlet', 'Au royaume de Springfieldia.', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le magasin vend l\'Amulet of Warmfyre, dans lequel il est le seul amulette de soigner contre la morsure d\'un Marcheur Blanc. Homer achète l\'amulette pour 100 pièces d\'or après que Lisa ait transformé le plomb en or. [/b]', 1, '2022-05-19 10:52:11'),
(38, 2, 'Aphrodite Inn', 'Vers le centre ville', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le Aphrodite Inn est un des hôtels les plus luxueux de Springfield.\r\n\r\nGunter et Ernst sont souvent hébergés dans cet hôtel. Dans une BD des Simpsons, elle est dirigée par Nick Aphrodite, dont Marge est tombée amoureuse alors qu\'elle y séjournait à partir d\'une potion d\'amour du professeur Frink. [/b]', 1, '2022-05-19 10:52:50'),
(39, 2, 'Mausolée de la famille Burns', 'Entre la foret et Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le mausolée de la famille Burns est, comme son nom l\'indique, un mausolée contenant les tombes des membres de la famille Burns. [/b]', 4, '2022-05-19 10:55:21'),
(40, 1, 'Route Rurale 9', 'En campagne', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] La Route Rurale 9 est, comme son nom l\'indique, une route située en campagne. [/b]', 8, '2022-05-19 10:55:53'),
(41, 1, 'Cypress Creek', 'Au nord de Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Cypress Creek est une ville de compagnie construites pour les familles des employés de la Corporation Globex dont le siège est situé à Cypress Creek. [/b]', 1, '2022-05-19 10:56:39'),
(42, 1, 'Duff Gardens', 'à l\'exterieuse de Springfield à l\'ouest', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] Le Duff Gardens est un parc d\'attraction sponsorisé par la Bière Duff . [/b]', 1, '2022-05-19 10:57:23'),
(43, 1, 'Forêt nationale de Springfield', 'A l\'ouest de Springfield', 0, '[title]  Histoire  [/title]\r\n\r\n    \r\n    [b] La Forêt nationale de Springfield est la forêt de Springfield.\r\nLa forêt contient une cascade et une grotte, qui abrite une famille d\'ours. [/b]', 8, '2022-05-19 10:58:18'),
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
(12, 4, 'Washington.webp', 'Une photo de Washington D.C', 'Washington D.C', '2022-05-06 03:49:14'),
(15, 21, 'springfield.png', 'Une photo de Springfield.', 'Springfield', '2022-05-19 12:19:33'),
(16, 22, 'centrale_nucleaire.webp', 'Une photo de Centrale nucléaire de Springfield.', 'Centrale nucléaire de Springfield', '2022-05-19 12:26:48'),
(17, 23, 'Kwik-E-Mart.webp', 'Une photo de Kwik-E-Mart.', 'Kwik-E-Mart', '2022-05-19 12:29:19'),
(19, 24, 'Shelbyville.webp', 'Une photo de Shelbyville.', 'Shelbyville', '2022-05-19 12:33:24'),
(20, 25, 'Sandwicherie_Simpson.webp', 'Une photo de L\'Armoire à sandwiches de Grand-Maman.', 'L\'Armoire à sandwiches de Grand-Maman', '2022-05-19 12:35:37'),
(21, 26, 'La_Maison_Derriere.webp', 'Une photo de La Maison Derrière.', 'La Maison Derrière', '2022-05-19 12:37:24'),
(22, 27, 'La_mangeoire_d\'oncle_Moe.webp', 'Une photo de La mangeoire d\'oncle Moe.', 'La mangeoire d\'oncle Moe', '2022-05-19 12:38:37'),
(23, 28, 'La_Truffe_Dorée.webp', 'Une photo de La Truffe Dorée.', 'La Truffe Dorée', '2022-05-19 12:39:36'),
(24, 29, 'The_Rusty_Barnacle.webp', 'Une photo de Le Barnacle Rusty.', 'Le Barnacle Rusty', '2022-05-19 12:40:59'),
(25, 30, 'The_Frying_Dutchman.webp', 'Une photo de Le Hollandais Volant.', 'Le Hollandais Volant', '2022-05-19 12:42:22'),
(26, 31, 'The_Hungry_Hun.webp', 'Une photo de Le Hun Hungry.', 'Le Hun Hungry', '2022-05-19 12:43:00'),
(27, 32, 'Le_pays_du_chocolat.webp', 'Une photo de Le pays du chocolat.', 'Le pays du chocolat', '2022-05-19 12:44:03'),
(28, 33, 'Le_petit_pays_de_la_Duff.webp', 'Une photo de Le petit pays de la Duff.', 'Le petit pays de la Duff', '2022-05-19 12:45:04'),
(29, 34, 'Les_grottes_du_papa_de_Carl.webp', 'Une photo de Les grottes du papa de Carl.', 'Les grottes du papa de Carl', '2022-05-19 12:49:29'),
(30, 35, 'Luigi\'s.webp', 'Une photo de Luigi\'s.', 'Luigi\'s', '2022-05-19 12:50:32'),
(31, 36, 'Agence_Le_blazer_rouge.webp', 'Une photo de Agence Le blazer rouge.', 'Agence Le blazer rouge', '2022-05-19 12:51:15'),
(32, 37, 'Amulet_Hamlet.webp', 'Une photo de Amulet Hamlet.', 'Amulet Hamlet', '2022-05-19 12:52:11'),
(33, 38, 'Aphrodite_Inn.webp', 'Une photo de Aphrodite Inn.', 'Aphrodite Inn', '2022-05-19 12:52:50'),
(34, 39, 'Burns_Family_Mausoleum.webp', 'Une photo de Mausolée de la famille Burns.', 'Mausolée de la famille Burns', '2022-05-19 12:55:21'),
(35, 40, 'Ruralroad.webp', 'Une photo de Route Rurale 9.', 'Route Rurale 9', '2022-05-19 12:55:53'),
(36, 41, 'Cypress_Creek.webp', 'Une photo de Cypress Creek.', 'Cypress Creek', '2022-05-19 12:56:39'),
(37, 42, 'Duff_Gardens.webp', 'Une photo de Duff Gardens.', 'Duff Gardens', '2022-05-19 12:57:23'),
(38, 43, 'Springfield_National_Forest.webp', 'Une photo de Forêt nationale de Springfield.', 'Forêt nationale de Springfield', '2022-05-19 12:58:18'),
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
