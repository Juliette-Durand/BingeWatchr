-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 28 fév. 2025 à 12:27
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bingewatchr`
--

-- --------------------------------------------------------

--
-- Structure de la table `actor`
--

DROP TABLE IF EXISTS `actor`;
CREATE TABLE IF NOT EXISTS `actor` (
  `actor_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Actor identifier',
  `actor_first_name` varchar(100) NOT NULL COMMENT 'Actor first name',
  `actor_last_name` varchar(255) NOT NULL COMMENT 'Actor last name',
  `actor_picture` varchar(20) DEFAULT NULL COMMENT 'Actor photography',
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `actor`
--

INSERT INTO `actor` (`actor_id`, `actor_first_name`, `actor_last_name`, `actor_picture`) VALUES
(1, 'Jean-Paul', 'Rouve', 'jp_rouve.jpg'),
(2, 'Isabelle', 'Nanty', 'isabelle_naty.jpg'),
(3, 'Théo', 'Fernandez', 'theo_fernandez.jpg'),
(4, 'Pierre', 'Lottin', 'pierre_lottin.jpg'),
(5, 'Christian', 'Clavier', 'christian_clavier.jp'),
(6, 'Claire', 'Chust', 'claire_chust.jpg'),
(7, 'Rayane', 'Bensetti', 'rayan_bensetti.jpg'),
(8, 'Gérard', 'Jugnot', 'gerard_jugnot.jpg'),
(9, 'Julien', 'Hubert', 'julien_hubert.jpg'),
(10, 'Lucie', 'De Saint-Thibaut', 'lucie_de_st.jpg'),
(11, 'Dany', 'Boon', 'dany_boon.jpg'),
(12, 'Kad', 'Merad', 'kad_merad.jpg'),
(13, 'Zoé', 'Félix', 'zoe_felix.jpg'),
(14, 'Chantal', 'Lauby', 'chantal_lauby.jpg'),
(15, 'Ary', 'Abittan', 'ary_abittan.jpg'),
(16, 'Élodie', 'Fontan', 'elodie_fontan.jpg'),
(17, 'Omar', 'Sy', 'omar_sy.jpg'),
(18, 'François', 'Cluzet', 'francois_cluzet.jpg'),
(19, 'Audrey', 'Fleurot', 'audrey_fleurot.jpg'),
(20, 'François', 'Damiens', 'francois_dam.jpg'),
(21, 'Karin', 'Viard', 'karine_viard.jpg'),
(22, 'Louane', 'Emera', 'louane_emera.jpg'),
(23, 'Patrick', 'Bruel', 'patrick_bruel.jpg'),
(24, 'Valérie', 'Benguigui', 'val_benguigui.jpg'),
(25, 'Miren', 'Pradier', 'miren_pradier.jpg'),
(26, 'Jean', 'Dujardin', 'jean_dujardin.jpg'),
(27, 'Bérénice', 'Bejo', 'berenice_bejo.jpg'),
(28, 'James', 'Cromwell', 'james_cromwell.jpg'),
(29, 'Ryan', 'Gosling', 'ryan _gosling.jpg'),
(30, 'Emma', 'Stone', 'emma _stone.jpg'),
(31, 'John', 'Legend', 'john _legend.jpg'),
(32, 'Ethan', 'Hawke', 'ethan_hawke.jpg'),
(33, 'James', 'Ransone', 'james_ransone.jpg'),
(34, 'Juliet', 'Rylance', 'juliet_rylance.jpg'),
(35, 'Anthony', 'Mackie', 'anthony_mackie.jpg'),
(36, 'Harrison', 'Ford', 'harrison_ford.jpg'),
(37, 'Tatiana', 'Maslany', 'tatiana_maslany.jpg'),
(38, 'Theo', 'James', 'theo_james.jpg'),
(39, 'Daniel', 'Radcliffe', 'daniel_radcliffe.jpg'),
(40, 'Rupert', 'Grint', 'rupert_grint.jpg'),
(41, 'Emma', 'Watson', 'emma_watson.jpg'),
(42, 'Jennifer', 'Lawrence', 'jennifer_lawrence.jp'),
(43, 'Josh', 'Hutcherson', 'josh_hutcherson.jpg'),
(44, 'Liam', 'Hemsworth', 'liam_hemsworth.jpg'),
(45, 'Shailene', 'Woodley', 'shailene_woodley.jpg'),
(46, 'Ansel', 'Elgort', 'ansel_elgort.jpg'),
(47, 'Nat', 'Wolff', 'nat_wolff.jpg'),
(48, 'Keanu', 'Reeves', 'keanu_reeves.jpg'),
(49, 'Laurence', 'Fishburne', 'laurence_fishburne.j'),
(50, 'Carrie-Anne', 'Moss', 'carrie-anne_moss.jpg'),
(51, 'Eva', 'Green', 'eva_green.jpg'),
(52, 'Asa', 'Butterfield', 'asa_butterfield.jpg'),
(53, 'Samuel L.', 'Jackson', 'samuel_l_jackson.jpg'),
(54, 'Hugh', 'Bonneville', 'hugh_bonneville.jpg'),
(55, 'Emily', 'Mortimer', 'emily_mortimer.jpg'),
(56, 'Julie', 'Walters', 'julie_walters.jpg'),
(57, 'Jim', 'Broadbent', 'jim_broadbent.jpg'),
(58, 'Olivia', 'Colman', 'olivia_colman.jpg'),
(59, 'Antonio', 'Banderas', 'antonio_banderas.jpg'),
(60, 'Ben', 'Whishaw', 'ben_whishaw.jpg'),
(61, 'Sarah', 'Stern', 'sarah_stern.jpg'),
(62, 'Théo', 'Fernandez', 'theo_fernandez.jpg'),
(63, 'Harrison', 'Thomas', 'harrison_thomas.jpg'),
(64, 'Sarah', 'Grey', 'sarah_grey.jpg'),
(65, 'Adam', 'DiMarco', 'adam_dimarco.jpg'),
(66, 'Katherine', 'Isabelle', 'katherine_isabelle.j'),
(67, 'Jake', 'Manley', 'jake_manley.jpg'),
(68, 'Tomer', 'Sisley', 'tomer_sisley.jpg'),
(69, 'Kristin', 'Scott Thomas', 'kristin_scott_thomas'),
(70, 'Niels', 'Arestrup', 'niels_arestrup.jpg'),
(71, 'Mélanie', 'Thierry', 'melanie_thierry.jpg'),
(72, 'Carla', 'Tous', 'carla_tous.jpg'),
(73, 'Gilbert', 'Melki', 'gilbert_melki.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `belong`
--

DROP TABLE IF EXISTS `belong`;
CREATE TABLE IF NOT EXISTS `belong` (
  `bel_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Commentary id',
  `bel_cat_id` int UNSIGNED NOT NULL COMMENT 'Category''s id',
  `bel_movie_id` int UNSIGNED NOT NULL COMMENT 'Movie''s id',
  PRIMARY KEY (`bel_id`),
  KEY `bel_cat_id` (`bel_cat_id`),
  KEY `bel_movie_id` (`bel_movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `belong`
--

INSERT INTO `belong` (`bel_id`, `bel_cat_id`, `bel_movie_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 6),
(8, 1, 6),
(9, 1, 7),
(10, 2, 7),
(11, 7, 7),
(12, 1, 8),
(13, 1, 9),
(14, 2, 9),
(15, 3, 9),
(16, 11, 9),
(17, 3, 10),
(18, 7, 10),
(19, 8, 11),
(85, 4, 12),
(86, 6, 12),
(87, 10, 12),
(88, 1, 13),
(89, 4, 13),
(90, 12, 13),
(91, 1, 14),
(92, 8, 14),
(93, 4, 15),
(94, 12, 15),
(95, 13, 15),
(96, 1, 16),
(97, 4, 17),
(98, 13, 17),
(99, 2, 18),
(100, 14, 18),
(101, 6, 19),
(102, 4, 20),
(103, 10, 20),
(104, 12, 20),
(105, 4, 21),
(106, 10, 21),
(107, 4, 22),
(108, 10, 22),
(109, 2, 23),
(110, 6, 23),
(111, 9, 23),
(112, 4, 24),
(113, 10, 24),
(114, 10, 25),
(115, 4, 25),
(116, 10, 25),
(117, 2, 26),
(118, 6, 26),
(119, 9, 26),
(121, 4, 27),
(122, 10, 27),
(124, 4, 28),
(125, 10, 28),
(127, 4, 29),
(128, 10, 29),
(129, 8, 30),
(130, 12, 31),
(131, 13, 31),
(132, 2, 32),
(133, 6, 32),
(134, 9, 32),
(135, 2, 33),
(136, 6, 33),
(137, 9, 33),
(138, 12, 34),
(139, 13, 34),
(140, 2, 35),
(141, 3, 35),
(142, 6, 36),
(143, 9, 36),
(144, 2, 37),
(145, 6, 37),
(146, 9, 37),
(147, 4, 38),
(148, 10, 38),
(149, 12, 38);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Category''s identifier',
  `cat_name` varchar(30) NOT NULL COMMENT 'Category name',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Comédie'),
(2, 'Drame'),
(3, 'Romance'),
(4, 'Aventure'),
(5, 'Thriller'),
(6, 'Action'),
(7, 'Musique'),
(8, 'Horreur'),
(9, 'Science-fiction'),
(10, 'Fantastique'),
(11, 'Historique'),
(12, 'Jeunesse et Famille'),
(13, 'Animation'),
(14, 'Policier');

-- --------------------------------------------------------

--
-- Structure de la table `collect`
--

DROP TABLE IF EXISTS `collect`;
CREATE TABLE IF NOT EXISTS `collect` (
  `coll_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Collect''s id will only refers to the movie collected - Isn''t about the collection itself',
  `coll_status` enum('Voir','Vu') NOT NULL COMMENT 'Category where the movie will be (To see, Already seen)',
  `coll_user_id` varchar(20) NOT NULL COMMENT 'Collect user''s id ',
  `coll_movie_id` int UNSIGNED NOT NULL COMMENT 'Collect movie''s id',
  PRIMARY KEY (`coll_id`),
  KEY `coll_user_id` (`coll_user_id`),
  KEY `coll_movie_id` (`coll_movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comm_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Commentary id',
  `comm_title` varchar(100) NOT NULL COMMENT 'Commentary title',
  `comm_content` text NOT NULL COMMENT 'Commentary content',
  `comm_date` datetime NOT NULL COMMENT 'Commentary''s publication date',
  `comm_user_id` varchar(20) NOT NULL COMMENT 'User''s id',
  `comm_movie_id` int UNSIGNED NOT NULL COMMENT 'Movie''s id',
  `comm_state` enum('P','U') NOT NULL DEFAULT 'U' COMMENT 'P pour published / U pour Unpublished',
  PRIMARY KEY (`comm_id`),
  KEY `comm_user_id` (`comm_user_id`),
  KEY `comm_movie_id` (`comm_movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`comm_id`, `comm_title`, `comm_content`, `comm_date`, `comm_user_id`, `comm_movie_id`, `comm_state`) VALUES
(58, 'Sympathique', 'Une petite comédie bien française, très divertissante pour toute la famille. On ne s\'ennuie pas, et on rigole beaucoup. L\'humour est vraiment très réussi, et change un peu de ce qu\'on peut voir aujourd\'hui. Isabelle Nanty et Jean-Paul Rouve sont juste exceptionnels! Moi qui adore cet acteur, et c\'est surement la principale raison qui m\'a poussée à voir le film de Olivier Baroux, j\'ai été vraiment servi! Il est complètement déjanté! J\'attends la suite. \'Les Tuche en Amérique\' verra t-il le jour?', '2025-01-02 10:57:00', 'CaptainBaguette', 1, 'P'),
(59, 'Un film bien beauf', 'Un film « beauf attitude » sans originalité et sans réel humour tant les gags et situations burlesques sont prévisibles.', '2025-01-02 10:57:02', 'DarkVadorFan', 1, 'P'),
(60, 'Très bonne comédie', 'Tout le monde était plié de rire dans la salle. Dans la pure tradition de la comédie de mœurs française. Avec des comédiens au top et des dialogues qui font mouche, le film parvient à nous emmener dans une réflexion inattendue sur les psychothérapies.', '2025-01-02 10:57:34', 'GollumTropMignon', 2, 'P'),
(61, 'Je suis très déçue par ce film', 'Ca change du superbe MONSIEUR BATIGNOLE de Gérard Jugnot!\r\nIci, ok les jeunes actrices jouent assez bien, mais le scénario est quand même assez médiocre selon mon avis. En plus, Adriana Karembeu n\'a aucun jeu, elle fait vraiment potiche-belle plante, c\'est tout.\r\nC\'est un des plus mauvais films que j\'ai vus. Désolée pour l\'équipe du film.', '2025-01-02 10:57:57', 'SuperPoulet', 3, 'P'),
(62, 'Excellent', 'Une excellente comédie désormais cultissime de et avec Dany Boon. Le duo Dany Boon/Kad Merad est génial et marche à merveille,l\'histoire est drole mais peut-être mal pris étant moqueuse des Ch\'tis et la mise en scène est excellente.', '2025-01-02 10:58:12', 'TonyStark', 4, 'P'),
(63, 'Un film qui ravira les Ch\'tis', 'Voilà le film le plus célèbre de Dany Boon, un film gai, joyeux, sans prétention, mais qui casse pas non plus 3 pattes à un canard. De nombreuses scènes feront sourire puisque on suit un facteur muté de force dans le Pas-de-Calais qui est considéré, à tort, comme un lieu horrible entre l\'accent ch\'tis, la pluie, l\'alcool, ... et évidemment ce facteur découvrira toutes les richesses de cette partie du pays et l\'accueil si chaleureux des gens du Nord.', '2025-01-02 10:58:25', 'CaptainBaguette', 4, 'P'),
(64, 'Véritable chef d\'œuvre et amplement mérité', 'Intouchables nous fait découvrir des liens forts entre un jeune de banlieue et un tétraplégique que tout oppose. Beaucoup de rires mais également une très forte émotion, j\'en suis ressortie émue, à aller voir absolument !', '2025-01-02 10:58:40', 'DarkVadorFan', 6, 'P'),
(65, 'Une grande réussite improbable', 'Deux mondes et deux personnes totalement opposées vont se s\'apprivoiser et se lier d\'une amitié peu commune. Rire garanti du début à la fin !', '2025-01-02 10:58:43', 'GollumTropMignon', 6, 'P'),
(66, 'À voir impérativement !', 'Un très beau film, tout en mélodie, sensibilité et humour. Les acteurs sont à la fois touchants et amusants , très à l\'aise dans leurs rôles respectifs. Une belle petite famille à découvrir avec plaisir dans le cadre d\'une histoire certes facile mais qui nous émeut et nous fait sourire.', '2025-01-02 10:58:52', 'SuperPoulet', 7, 'P'),
(67, 'Belle réalisation', 'Un film nostalgique qui nous plonge dans l\'Hollywood des années 1920-1930. Une réalisation d\'une grande originalité, appliquée, avec une très belle photographie noire et blanche. Jean Dujardin et Bérénice Bejo sont tout à fait convaincants et, décors, costumes et bande-son sont également parfaits. L\'histoire est simple mais intéressante et touchante. Et, même si l\'on constate quelques baisses de rythme par moment, \'The Artist\' reste un pari risqué et osé, réussi, rendant un très bel hommage à un cinéma désormais révolu !', '2025-01-02 11:02:01', 'TonyStark', 9, 'P'),
(68, 'Superbe', 'Ce film est un enchantement. On retrouve la féerie des films de Jacques Demy, simple et colorée. Emma Stone est magnifiée, tellement attachante, différente. Ryan Gosling n\'est pas autant mis en valeur, moins expressif mais leur duo est très convaincant. Le chant, la danse, les décors de La, Los Angeles, c\'est très réussi. Merci Damien.', '2025-01-02 11:02:08', 'CaptainBaguette', 10, 'P'),
(69, 'Bof, pas convaincu', 'Eh bien non, je ne fais pas partie de la cohorte des enchantés, ravis, emportés et autres qualificatifs pour désigner ce \'chef-d\'oeuvre\' qui pour moi est loin d\'en être un. Histoire d\'une banalité effrayante. Les quelques pas de danse qu\'amorce les deux acteurs ne font pas de ce film une grande comédie musicale. En plus le film traîne en longueur. Pas le film de l\'année pour moi. Ou alors j\'ai peur pour les autres', '2025-01-02 11:02:25', 'DarkVadorFan', 10, 'P'),
(70, 'Ennuyeux', 'Je comprend pourquoi ce film ne m\'avait pas marqué à l\'époque, je me suis tellement ennuyé devant ce pseudo film d\'horreur ce n\'est pas mal joué mais aucun intérêt scénario ?? aucun frisson', '2025-01-02 11:02:34', 'GollumTropMignon', 11, 'P'),
(71, 'Du bon travail', 'Cela faisait bien longtemps qu\'un film d\'épouvante m\'avait fait autant flipper. Pas de gore ,ni d\'effusions d\'hémoglobine mais une ambiance glauque et angoissante instaurant une tension allant crescendo tout au long du film. Hormis quelques petits défauts, peu de choses à reprocher à cette œuvre. Le casting est efficace ( Avec un Ethan Hawke très crédible), les dialogues de bonne facture, et la BO est en parfaite adéquation avec le film. A noter une réalisation léchée et très bien réussie.', '2025-01-02 11:10:36', 'SuperPoulet', 11, 'P'),
(72, 'Effrayant à souhait', 'Un super film. Qu\'il s\'agisse de l\'ambiance ou de l\'histoire rien a redire. En vrai j\'ai flippé a mort et j\'ai regardé pas mal de passage les yeux a demi fermé. A voir pour se faire peur. Je pense que le reverrais mais chez moi , avec de la lumière et le bouton pause a proximité !', '2025-01-02 11:30:02', 'TonyStark', 11, 'P'),
(75, 'Une plongée magique dans l’univers de Poudlard !', 'Ce film, c’est juste de la pure magie du début à la fin ! Voir Poudlard prendre vie, c’est incroyable, et les acteurs collent parfaitement aux personnages. L’ambiance, la musique, tout est là pour nous embarquer dans l’aventure. Un vrai kiff pour les fans du livre et une super intro à la saga !', '2025-02-28 10:04:26', 'TonyStark', 20, 'P'),
(76, 'Un classique qu’on ne se lasse pas de revoir', 'C’est LE film qui a lancé toute la folie Harry Potter, et franchement, il est toujours aussi génial. L’histoire est prenante, les décors sont dingues, et il y a ce petit truc magique qui fait qu’on retombe en enfance à chaque fois. Que du bonheur !', '2025-02-28 10:04:26', 'SuperPoulet', 20, 'P'),
(78, 'Un spectacle captivant mais prévisible', 'Hunger Games offre un divertissement efficace avec une mise en scène soignée et une tension bien maîtrisée. Jennifer Lawrence incarne avec brio Katniss Everdeen, un personnage fort et attachant, tandis que l’univers dystopique est visuellement réussi.\r\n\r\nCependant, le film peine parfois à sortir des codes classiques du genre, avec un scénario relativement prévisible et des personnages secondaires qui manquent de profondeur. Si l’action et l’émotion sont au rendez-vous, on aurait aimé une approche plus audacieuse sur certains aspects de l’histoire. Un bon film, mais pas révolutionnaire.', '2025-02-28 11:50:35', 'DevTestUser', 23, 'P');

-- --------------------------------------------------------

--
-- Structure de la table `host`
--

DROP TABLE IF EXISTS `host`;
CREATE TABLE IF NOT EXISTS `host` (
  `host_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Commentary id',
  `host_plat_id` int UNSIGNED NOT NULL COMMENT 'Platform''s id',
  `host_movie_id` int UNSIGNED NOT NULL COMMENT 'Movie''s id',
  PRIMARY KEY (`host_id`),
  KEY `host_plat_id` (`host_plat_id`),
  KEY `host_movie_id` (`host_movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `host`
--

INSERT INTO `host` (`host_id`, `host_plat_id`, `host_movie_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 1, 3),
(4, 8, 3),
(5, 4, 4),
(6, 9, 5),
(7, 8, 6),
(8, 3, 6),
(9, 7, 7),
(10, 7, 8),
(11, 7, 9),
(12, 10, 9),
(13, 5, 10),
(14, 7, 10),
(15, 1, 11);

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `movie_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Movie''s id',
  `movie_name` varchar(210) NOT NULL COMMENT 'Movie''s name',
  `movie_desc` text NOT NULL COMMENT 'Movie''s synopsis',
  `movie_release` date NOT NULL COMMENT 'Movie''s release date',
  `movie_creation_date` datetime NOT NULL COMMENT 'Date of creation in database',
  `movie_poster` varchar(40) DEFAULT NULL,
  `movie_pegi` enum('10','12','16','18') DEFAULT NULL COMMENT 'Age minimum to see the movie',
  `movie_display` datetime DEFAULT NULL COMMENT 'If the movie is on display, there will be a time out before expiration',
  `movie_duration` time NOT NULL COMMENT 'Movie''s duration',
  `movie_state` enum('P','U') NOT NULL DEFAULT 'U' COMMENT 'P pour published / U pour Unpublished',
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`movie_id`, `movie_name`, `movie_desc`, `movie_release`, `movie_creation_date`, `movie_poster`, `movie_pegi`, `movie_display`, `movie_duration`, `movie_state`) VALUES
(1, 'Les Tuches', 'Une famille modeste, les Tuche, devient riche après avoir gagné au loto. L\'histoire comique de leurs aventures.', '2011-12-21', '2024-12-19 09:13:00', 'les_tuches.jpg', NULL, NULL, '01:25:00', 'P'),
(2, 'Jamais Sans Mon Psy', 'Une comédie où un homme, accompagné de son psy, cherche à trouver une solution à ses problèmes amoureux.', '0000-00-00', '2024-12-19 09:13:01', 'jamais_sans_psy.jpg', NULL, NULL, '01:40:00', 'P'),
(3, '3 Petites Filles', 'Trois petites filles sont confrontées à un mystère après avoir trouvé des indices qui les mènent dans une aventure.', '2020-10-14', '2024-12-19 09:13:02', 'trois_petite_filles.jpg', NULL, '2024-12-20 15:21:10', '01:35:00', 'P'),
(4, 'Bienvenue chez les Ch\'tis', 'Un fonctionnaire du sud est muté dans le nord, et des chocs culturels suivent.', '2008-02-27', '2024-12-19 09:13:03', 'bienvenue_chez_les_chtis.jpg', NULL, NULL, '01:46:00', 'P'),
(5, 'Qu\'est-ce qu\'on a fait au Bon Dieu', 'Un couple français catholique doit accepter les mariages de leurs filles.', '2014-04-16', '2024-12-19 09:13:04', 'quest_ce_que_on_a_fait.jpg', NULL, NULL, '01:37:00', 'P'),
(6, 'Intouchables', 'L\'amitié improbable entre un aristocrate tétraplégique et son aide-soignant de banlieue.', '2011-11-02', '2024-12-19 09:13:05', 'intouchables.jpg', NULL, NULL, '01:52:00', 'P'),
(7, 'La Famille Bélier', 'Une jeune fille rêve de devenir chanteuse, mais sa famille sourde ne la comprend pas.', '2014-12-17', '2024-12-19 09:13:06', 'famille_belier.jpg', NULL, NULL, '01:45:00', 'P'),
(8, 'Le Prénom', 'Lors d\'un dîner, la révélation du prénom d\'un bébé boulerverse tout.', '2012-10-10', '2024-12-19 09:13:07', 'le_prenom.jpg', NULL, NULL, '01:49:00', 'P'),
(9, 'The Artist', 'Un film muet qui raconte l\'histoire d\'un acteur de cinéma muet dans les années 1920.', '2011-11-23', '2024-12-19 09:13:08', 'the_artist.jpg', NULL, NULL, '01:40:00', 'P'),
(10, 'La La Land', 'Un film musical romantique sur les rêves d\'une actrice et d\'un pianiste.', '2016-12-09', '2024-12-19 09:13:09', 'la_la_land.jpg', NULL, NULL, '02:08:00', 'P'),
(11, 'Sinister', 'Un écrivain de crimes véritables découvre une réserve de bandes-vidéo mettant en scène plusieurs meurtres brutaux ayant eu lieu dans la maison qu\'il vient d\'acheter.', '2012-11-07', '2024-12-19 09:13:10', 'sinister.jpg', '', NULL, '01:50:00', 'P'),
(12, 'Captain America: Brave New World', 'Peu après avoir fait la connaissance du nouveau président des Etats-Unis Thaddeus Ross, Sam Wilson se retrouve plongé au coeur d\'un gigantesque incident international. Dans une lutte acharnée contre la montre, il se retrouve contraint de découvrir la raison de cet infâme complot avant que le véritable cerveau de l’opération ne mette bientôt le monde entier à feu et à sang…', '2025-02-12', '2025-02-27 11:46:03', 'captain_america_brave_new_world.jpg', NULL, '2025-02-12 00:00:00', '01:58:00', 'P'),
(13, 'Paddington au Pérou', 'Alors que Paddington rend visite à sa tante Lucy bien-aimée, qui réside désormais à la Maison des ours retraités au Pérou, la famille Brown et notre ours préféré plongent dans un voyage inattendu et plein de mystères, à travers la forêt amazonienne et jusqu\'aux sommets des montagnes du Machu Picchu.', '2025-02-05', '2025-02-27 11:46:03', 'paddington_au_perou.jpg', NULL, '2025-02-05 00:00:00', '01:45:00', 'P'),
(14, 'The Monkey', 'Lorsque Bill et Hal, des jumeaux, trouvent dans le grenier un vieux jouet ayant appartenu à leur père, une série de morts atroces commence à se produire autour d\'eux...', '2025-02-19', '2025-02-27 11:50:43', 'the_monkey.jpg', '12', '2025-02-19 00:00:00', '01:38:00', 'P'),
(15, 'Mufasa : Le Roi Lion', 'Rafiki raconte à la jeune lionne Kiara - la fille de Simba et Nala – la légende de Mufasa. Il est aidé en cela par Timon et Pumbaa, dont les formules choc sont désormais bien connues. Relatée sous forme de flashbacks, l\'histoire de Mufasa est celle d’un lionceau orphelin, seul et désemparé qui, un jour, fait la connaissance du sympathique Taka, héritier d\'une lignée royale. Cette rencontre fortuite marque le point de départ d’un périple riche en péripéties d’un petit groupe « d’indésirables » qui s’est formé autour d’eux et qui est désormais à la recherche de son destin. Leurs liens d’amitié seront soumis à rude épreuve lorsqu’il leur faudra faire équipe pour échapper à un ennemi aussi menaçant que mortel…', '2024-12-18', '2025-02-27 11:50:03', 'mufasa_le_roi_lion.jpg', NULL, NULL, '01:58:00', 'P'),
(16, 'God Save the Tuche', 'Les Tuche mènent à nouveau une vie paisible à Bouzolles. Mais lorsque le petit-fils de Jeff et Cathy est sélectionné pour un stage de football à Londres, c’est l’occasion rêvée pour toute la famille d’aller découvrir l’Angleterre et de rencontrer la famille royale. Entre chocs culturels et maladresses, les Tuche se retrouvent plongés au cœur de la royauté anglaise, qui n’est pas près d’oublier leur séjour !', '2025-02-05', '2025-02-27 11:46:03', 'god_save_the_tuche.jpg', NULL, '2025-02-05 00:00:00', '01:35:00', 'P'),
(17, 'Sonic 3, le film', 'Sonic, Knuckles et Tails se retrouvent face à un nouvel adversaire, Shadow, mystérieux et puissant ennemi aux pouvoirs inédits. Dépassée sur tous les plans, la Team Sonic va devoir former une alliance improbable pour tenter d’arrêter Shadow et protéger notre planète.', '2024-12-25', '2025-02-27 11:46:03', 'sonic_3.jpg', NULL, '2025-02-27 13:49:41', '01:49:00', 'P'),
(18, 'The Order', 'Une série de braquages de banques et de vols de voitures a effrayé les communautés du nord-ouest du Pacifique. Un agent isolé du FBI pense que ces crimes ne sont pas l\'œuvre de criminels motivés par la finance.', '2025-02-06', '2025-02-27 11:46:03', 'the_order.jpg', NULL, '2025-02-06 00:00:00', '01:56:00', 'P'),
(19, 'Largo Winch : Le prix de l\'argent', 'Depuis l’enlèvement brutal de son fils Noom, Largo Winch fait l’objet d’une impitoyable machination cherchant à l’anéantir et à détruire le groupe W. Pour faire éclater la vérité et retrouver son fils, Largo se lance dans une traque sans relâche. Des forêts canadiennes, en passant par Bangkok jusque dans les profondeurs des mines birmanes il ne sait pas encore qu’il devra faire face aux démons du passé.', '2024-07-31', '2025-02-27 11:49:53', 'largo_winch_le_prix_de_largent.jpg', NULL, NULL, '01:40:00', 'P'),
(20, 'Harry Potter à l\'école des sorciers', 'Orphelin, Harry Potter a été recueilli à contrecœur par son oncle Vernon et sa tante Pétunia, aussi cruels que mesquins, qui n\'hésitent pas à le faire dormir dans le placard sous l\'escalier. Constamment maltraité, il doit en outre supporter les jérémiades de son cousin Dudley, garçon cupide et archi-gâté par ses parents. De leur côté, Vernon et Pétunia détestent leur neveu dont la présence leur rappelle sans cesse le tempérament \"imprévisible\" des parents du garçon et leur mort mystérieuse.\n\nÀ l\'approche de ses 11 ans, Harry ne s\'attend à rien de particulier – ni carte, ni cadeau, ni même un goûter d\'anniversaire. Et pourtant, c\'est à cette occasion qu\'il découvre qu\'il est le fils de deux puissants magiciens et qu\'il possède lui aussi d\'extraordinaires pouvoirs. Quand on lui propose d\'intégrer Poudlard, la prestigieuse école de sorcellerie, il trouve enfin le foyer et la famille qui lui ont toujours manqué… et s\'engage dans l\'aventure de sa vie.', '2001-12-05', '2025-02-27 11:46:03', 'harry_potter_1.jpg', NULL, NULL, '02:32:00', 'P'),
(21, 'Harry Potter et la chambre des secrets', 'Alors que l\'oncle Vernon, la tante Pétunia et son cousin Dudley reçoivent d\'importants invités à dîner, Harry Potter est contraint de passer la soirée dans sa chambre. Dobby, un elfe, fait alors son apparition. Il lui annonce que de terribles dangers menacent l\'école de Poudlard et qu\'il ne doit pas y retourner en septembre. Harry refuse de le croire.\n\nMais sitôt la rentrée des classes effectuée, ce dernier entend une voix malveillante. Celle-ci lui dit que la redoutable et légendaire Chambre des secrets est à nouveau ouverte, permettant ainsi à l\'héritier de Serpentard de semer le chaos à Poudlard. Les victimes, retrouvées pétrifiées par une force mystérieuse, se succèdent dans les couloirs de l\'école, sans que les professeurs - pas même le populaire Gilderoy Lockhart - ne parviennent à endiguer la menace. Aidé de Ron et Hermione, Harry doit agir au plus vite pour sauver Poudlard.', '2002-12-04', '2025-02-27 11:46:03', 'harry_potter_2.jpg', NULL, NULL, '02:38:00', 'P'),
(22, 'Harry Potter et le Prisonnier d\'Azkaban', 'Sirius Black, un dangereux sorcier criminel, s\'échappe de la sombre prison d\'Azkaban avec un seul et unique but : retrouver Harry Potter, en troisième année à l\'école de Poudlard. Selon la légende, Black aurait jadis livré les parents du jeune sorcier à leur assassin, Lord Voldemort, et serait maintenant déterminé à tuer Harry...', '2004-06-02', '2025-02-27 11:46:03', 'harry_potter_3.jpg', NULL, NULL, '02:21:00', 'P'),
(23, 'Hunger Games', 'Chaque année, dans les ruines de ce qui était autrefois l\'Amérique du Nord, le Capitole, l\'impitoyable capitale de la nation de Panem, oblige chacun de ses douze districts à envoyer un garçon et une fille - les \"Tributs\" - concourir aux Hunger Games. A la fois sanction contre la population pour s\'être rebellée et stratégie d\'intimidation de la part du gouvernement, les Hunger Games sont un événement télévisé national au cours duquel les tributs doivent s\'affronter jusqu\'à la mort. L\'unique survivant est déclaré vainqueur.\n\nLa jeune Katniss, 16 ans, se porte volontaire pour prendre la place de sa jeune sœur dans la compétition. Elle se retrouve face à des adversaires surentraînés qui se sont préparés toute leur vie. Elle a pour seuls atouts son instinct et un mentor, Haymitch Abernathy, qui gagna les Hunger Games il y a des années mais n\'est plus désormais qu\'une épave alcoolique. Pour espérer pouvoir revenir un jour chez elle, Katniss va devoir, une fois dans l\'arène, faire des choix impossibles entre la survie et son humanité, entre la vie et l\'amour...', '2012-03-21', '2025-02-27 11:46:03', 'hunger_games_1.jpg', NULL, NULL, '02:22:00', 'P'),
(24, 'Harry Potter et la Coupe de Feu', 'La quatrième année à l\'école de Poudlard est marquée par le \"Tournoi des trois sorciers\". Les participants sont choisis par la fameuse \"coupe de feu\" qui est à l\'origine d\'un scandale. Elle sélectionne Harry Potter alors qu\'il n\'a pas l\'âge légal requis !\n\nAccusé de tricherie et mis à mal par une série d\'épreuves physiques de plus en plus difficiles, ce dernier sera enfin confronté à Celui dont on ne doit pas prononcer le nom, Lord V.', '2005-11-30', '2025-02-27 11:46:03', 'harry_potter_4.jpg', NULL, NULL, '02:37:00', 'P'),
(25, 'Harry Potter et l\'ordre du Phénix', 'Alors qu\'il entame sa cinquième année d\'études à Poudlard, Harry Potter découvre que la communauté des sorciers ne semble pas croire au retour de Voldemort, convaincue par une campagne de désinformation orchestrée par le Ministre de la Magie Cornelius Fudge. Afin de le maintenir sous surveillance, Fudge impose à Poudlard un nouveau professeur de Défense contre les Forces du Mal, Dolorès Ombrage, chargée de maintenir l\'ordre à l\'école et de surveiller les faits et gestes de Dumbledore. Prodiguant aux élèves des cours sans grand intérêt, celle qui se fait appeler la Grande Inquisitrice de Poudlard semble également décidée à tout faire pour rabaisser Harry. Entouré de ses amis Ron et Hermione, ce dernier met sur pied un groupe secret, \"L\'Armée de Dumbledore\", pour leur enseigner l\'art de la défense contre les forces du Mal et se préparer à la guerre qui s\'annonce...', '2007-07-11', '2025-02-27 11:46:03', 'harry_potter_5.jpg', NULL, NULL, '02:18:00', 'P'),
(26, 'Hunger Games : L\'embrasement', 'Katniss Everdeen est rentrée chez elle saine et sauve après avoir remporté la 74e édition des Hunger Games avec son partenaire Peeta Mellark.\n\nPuisqu’ils ont gagné, ils sont obligés de laisser une fois de plus leur famille et leurs amis pour partir faire la Tournée de la victoire dans tous les districts. Au fil de son voyage, Katniss sent que la révolte gronde, mais le Capitole exerce toujours un contrôle absolu sur les districts tandis que le Président Snow prépare la 75e édition des Hunger Games, les Jeux de l’Expiation – une compétition qui pourrait changer Panem à jamais…', '2013-11-27', '2025-02-27 11:46:03', 'hunger_games_2.jpg', NULL, NULL, '02:26:00', 'P'),
(27, 'Harry Potter et le Prince de Sang Mêlé', 'L\'étau démoniaque de Voldemort se resserre sur l\'univers des Moldus et le monde de la sorcellerie. Poudlard a cessé d\'être un havre de paix, le danger rode au coeur du château... Mais Dumbledore est plus décidé que jamais à préparer Harry à son combat final, désormais imminent. Ensemble, le vieux maître et le jeune sorcier vont tenter de percer à jour les défenses de Voldemort. Pour les aider dans cette délicate entreprise, Dumbledore va relancer et manipuler son ancien collègue, le Professeur Horace Slughorn, qu\'il croit en possession d\'informations vitales sur le jeune Voldemort. Mais un autre \"mal\" hante cette année les étudiants : le démon de l\'adolescence ! Harry est de plus en plus attiré par Ginny, qui ne laisse pas indifférent son rival, Dean Thomas ; Lavande Brown a jeté son dévolu sur Ron, mais oublié le pouvoir \"magique\" des chocolats de Romilda Vane ; Hermione, rongée par la jalousie, a décidé de cacher ses sentiments, vaille que vaille. L\'amour est dans tous les coeurs - sauf un. Car un étudiant reste étrangement sourd à son appel. Dans l\'ombre, il poursuit avec acharnement un but aussi mystérieux qu\'inquiétant... jusqu\'à l\'inévitable tragédie qui bouleversera à jamais Poudlard...', '2009-07-15', '2025-02-27 11:46:03', 'harry_potter_6.jpg', NULL, NULL, '02:33:00', 'P'),
(28, 'Harry Potter et les Reliques de la Mort : partie 1', 'Le pouvoir de Voldemort s\'étend. Celui-ci contrôle maintenant le Ministère de la Magie et Poudlard. Harry, Ron et Hermione décident de terminer le travail commencé par Dumbledore, et de retrouver les derniers Horcruxes pour vaincre le Seigneur des Ténèbres. Mais il reste bien peu d\'espoir aux trois sorciers, qui doivent réussir à tout prix.', '2010-11-24', '2025-02-27 11:46:03', 'harry_potter_7.jpg', NULL, NULL, '02:26:00', 'P'),
(29, 'Harry Potter et les Reliques de la Mort : partie 2', 'Dans la 2e Partie de cet épisode final, le combat entre les puissances du bien et du mal de l’univers des sorciers se transforme en guerre sans merci. Les enjeux n’ont jamais été si considérables et personne n’est en sécurité. Mais c’est Harry Potter qui peut être appelé pour l’ultime sacrifice alors que se rapproche l’ultime épreuve de force avec Voldemort.', '2011-07-13', '2025-02-27 11:46:03', 'harry_potter_8.jpg', NULL, NULL, '02:10:00', 'P'),
(30, 'Smile 2', 'À l’aube d’une nouvelle tournée mondiale, la star de la pop Skye Riley se met à vivre des événements aussi terrifiants qu’inexplicables. Submergée par la pression de la célébrité et devant un quotidien qui bascule de plus en plus dans l’horreur, Skye est forcée de se confronter à son passé obscur pour tenter de reprendre le contrôle de sa vie avant qu’il ne soit trop tard.', '2024-10-16', '2025-02-27 11:49:03', 'smile_2.jpg', '16', NULL, '02:12:00', 'P'),
(31, 'Vaiana, la légende au bout du monde', 'Il y a 3 000 ans, les plus grands marins du monde voyagèrent dans le vaste océan Pacifique, à la découverte des innombrables îles de l\'Océanie. Mais pendant le millénaire qui suivit, ils cessèrent de voyager. Et personne ne sait pourquoi...\n\nVaiana, la légende du bout du monde raconte l\'aventure d\'une jeune fille téméraire qui se lance dans un voyage audacieux pour accomplir la quête inachevée de ses ancêtres et sauver son peuple. Au cours de sa traversée du vaste océan, Vaiana va rencontrer Maui, un demi-dieu. Ensemble, ils vont accomplir un voyage épique riche d\'action, de rencontres et d\'épreuves... En accomplissant la quête inaboutie de ses ancêtres, Vaiana va découvrir la seule chose qu\'elle a toujours cherchée : elle-même.', '2016-11-30', '2025-02-27 11:46:03', 'vaiana.jpg', NULL, NULL, '01:47:00', 'P'),
(32, 'Hunger Games : La Révolte - Partie 1', 'Katniss Everdeen s’est réfugiée dans le District 13 après avoir détruit à jamais l’arène et les Jeux. Sous le commandement de la Présidente Coin, chef du district, et suivant les conseils de ses amis en qui elle a toute confiance, Katniss déploie ses ailes pour devenir le symbole de la rébellion. Elle va se battre pour sauver Peeta et libérer le pays tout entier, à qui son courage a redonné espoir.', '2014-11-19', '2025-02-27 11:46:03', 'hunger_games_3.jpg', NULL, NULL, '02:03:00', 'P'),
(33, 'Hunger Games : La Révolte - Partie 2', 'Alors que Panem est ravagé par une guerre désormais totale, Katniss et le Président Snow vont s’affronter pour la dernière fois. Katniss et ses plus proches amis – Gale, Finnick, et Peeta – sont envoyés en mission pour le District 13 : ils vont risquer leur vie pour tenter d’assassiner le Président Snow, qui s’est juré de détruire Katniss. Les pièges mortels, les ennemis et les choix déchirants qui attendent Katniss seront des épreuves bien pires que tout ce qu’elle a déjà pu affronter dans l’arène…', '2015-11-18', '2025-02-27 11:46:03', 'hunger_games_4.jpg', NULL, NULL, '02:17:00', 'P'),
(34, 'Ratatouille', 'Rémy est un jeune rat qui rêve de devenir un grand chef français. Ni l\'opposition de sa famille, ni le fait d\'être un rongeur dans une profession qui les déteste ne le démotivent. Rémy est prêt à tout pour vivre sa passion de la cuisine... et le fait d\'habiter dans les égouts du restaurant ultra coté de la star des fourneaux, Auguste Gusteau, va lui en donner l\'occasion ! Malgré le danger et les pièges, la tentation est grande de s\'aventurer dans cet univers interdit.\n\nEcartelé entre son rêve et sa condition, Rémy va découvrir le vrai sens de l\'aventure, de l\'amitié, de la famille... et comprendre qu\'il doit trouver le courage d\'être ce qu\'il est : un rat qui veut être un grand chef...', '2007-08-01', '2025-02-27 11:46:03', 'ratatouille.jpg', NULL, NULL, '01:50:00', 'P'),
(35, 'Nos Étoiles Contraires', 'Hazel Grace et Gus sont deux adolescents hors-normes, partageant un humour ravageur et le mépris des conventions. Leur relation est elle-même inhabituelle, étant donné qu’ils se sont rencontrés et sont tombés amoureux lors d\'un groupe de soutien pour les malades du cancer.', '2014-08-20', '2025-02-27 11:46:03', 'nos_etoiles_contraires.jpg', NULL, NULL, '02:05:00', 'P'),
(36, 'Matrix', 'Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit venue. Sous ce pseudonyme, il est l\'un des pirates les plus recherchés du cyber-espace. A cheval entre deux mondes, Neo est assailli par d\'étranges songes et des messages cryptés provenant d\'un certain Morpheus. Celui-ci l\'exhorte à aller au-delà des apparences et à trouver la réponse à la question qui hante constamment ses pensées : qu\'est-ce que la Matrice ? Nul ne le sait, et aucun homme n\'est encore parvenu à en percer les defenses. Mais Morpheus est persuadé que Neo est l\'Elu, le libérateur mythique de l\'humanité annoncé selon la prophétie. Ensemble, ils se lancent dans une lutte sans retour contre la Matrice et ses terribles agents...', '1999-06-23', '2025-02-27 11:49:50', 'matrix.jpg', NULL, NULL, '02:15:00', 'P'),
(37, 'Hunger Games : La Ballade du serpent et de l\'oiseau chanteur', 'Le jeune Coriolanus est le dernier espoir de sa lignée, la famille Snow autrefois riche et fière est aujourd’hui tombée en disgrâce dans un Capitole d\'après-guerre. À l’approche des 10ème HUNGER GAMES, il est assigné à contrecœur à être le mentor de Lucy Gray Baird, une tribut originaire du District 12, le plus pauvre et le plus méprisé de Panem. Le charme de Lucy Gray ayant captivé le public, Snow y voit l’opportunité de changer son destin, et va s’allier à elle pour faire pencher le sort en leur faveur. Luttant contre ses instincts, déchiré entre le bien et le mal, Snow se lance dans une course contre la montre pour survivre et découvrir s’il deviendra finalement un oiseau chanteur ou un serpent.', '2023-11-15', '2025-02-27 11:46:03', 'hunger_games_5.jpg', NULL, NULL, '02:38:00', 'P'),
(38, 'Miss Peregrine et les enfants particuliers', 'À la mort de son grand-père, Jacob découvre les indices et l’existence d’un monde mystérieux qui le mène dans un lieu magique : la Maison de Miss Peregrine pour Enfants Particuliers. Mais le mystère et le danger s’amplifient quand il apprend à connaître les résidents, leurs étranges pouvoirs …  et leurs puissants ennemis. Finalement, Jacob découvre que seule sa propre \"particularité\" peut sauver ses nouveaux amis.', '2016-10-05', '2025-02-27 11:49:48', 'miss_peregrine_et_les_enfants_partic.jpg', NULL, NULL, '02:03:00', 'P');

-- --------------------------------------------------------

--
-- Structure de la table `opinion`
--

DROP TABLE IF EXISTS `opinion`;
CREATE TABLE IF NOT EXISTS `opinion` (
  `opi_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Like id',
  `opi_yes_no` tinyint(1) NOT NULL COMMENT 'If the user likes it''s true - if he dislikes it''s false',
  `opi_user_id` varchar(20) NOT NULL COMMENT 'User''s id',
  `opi_movie_id` int UNSIGNED NOT NULL COMMENT 'Movie''s id',
  PRIMARY KEY (`opi_id`),
  KEY `opi_user_id` (`opi_user_id`),
  KEY `opi_movie_id` (`opi_movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `pic_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Picture''s identifier',
  `pic_file` varchar(40) NOT NULL COMMENT 'Picture''s name of file with extension',
  `pic_comment_id` int UNSIGNED NOT NULL COMMENT 'Comment linked to the photo',
  PRIMARY KEY (`pic_id`),
  KEY `FK_pic_comment_id` (`pic_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`pic_id`, `pic_file`, `pic_comment_id`) VALUES
(37, 'd784d4c52f46ad015523.webp', 78),
(38, 'aec1b2376c979bf8a52e.webp', 78),
(39, '12ee63d99361b81d8010.webp', 78);

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

DROP TABLE IF EXISTS `platform`;
CREATE TABLE IF NOT EXISTS `platform` (
  `plat_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Platform identifier',
  `plat_name` varchar(50) NOT NULL COMMENT 'Platform name',
  `plat_link` varchar(255) NOT NULL COMMENT 'Link to access platform',
  `plat_logo` varchar(20) NOT NULL COMMENT 'Platform logo',
  PRIMARY KEY (`plat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `platform`
--

INSERT INTO `platform` (`plat_id`, `plat_name`, `plat_link`, `plat_logo`) VALUES
(1, 'Netflix', 'https://www.netflix.com', 'netflix.png'),
(2, 'Disney+', 'https://www.disneyplus.com/fr-fr', 'disneyplus.png'),
(3, 'Prime Video', 'https://www.primevideo.com/-/fr', 'primevideo.png'),
(4, 'YouTube TV', 'https://tv.youtube.com', 'youtube.png'),
(5, 'Rakuten TV', 'https://www.rakuten.tv/fr', 'rakutentv.png'),
(6, 'Hulu', 'https://www.hulu.com', 'gulu.png'),
(7, '123Movies', 'https://www.123moviesfree.net', '123movies.png'),
(8, 'Pluto', 'https://www.pluto.tv/fr', 'pluto.png'),
(9, 'Max', 'https://www.max.com/fr/en', 'max.png'),
(10, 'Popcornflix', 'https://popcornflix.rest/', 'popcornflix.png');

-- --------------------------------------------------------

--
-- Structure de la table `play`
--

DROP TABLE IF EXISTS `play`;
CREATE TABLE IF NOT EXISTS `play` (
  `play_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Commentary id',
  `play_actor_id` int UNSIGNED NOT NULL COMMENT 'Actor''s id',
  `play_movie_id` int UNSIGNED NOT NULL COMMENT 'Movie''s id',
  PRIMARY KEY (`play_id`),
  KEY `play_actor_id` (`play_actor_id`),
  KEY `play_movie_id` (`play_movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `play`
--

INSERT INTO `play` (`play_id`, `play_actor_id`, `play_movie_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 3),
(9, 9, 3),
(10, 10, 3),
(11, 11, 4),
(12, 12, 4),
(13, 13, 4),
(14, 5, 5),
(15, 14, 5),
(16, 15, 5),
(17, 16, 5),
(18, 17, 6),
(19, 18, 6),
(20, 19, 6),
(21, 20, 7),
(22, 21, 7),
(23, 22, 7),
(24, 23, 8),
(25, 24, 8),
(26, 25, 8),
(27, 26, 9),
(28, 27, 9),
(29, 28, 9),
(30, 29, 10),
(31, 30, 10),
(32, 31, 10),
(33, 32, 11),
(34, 33, 11),
(35, 34, 11),
(36, 35, 12),
(37, 36, 12),
(38, 37, 14),
(39, 38, 14),
(40, 39, 20),
(41, 40, 20),
(42, 41, 20),
(43, 39, 21),
(44, 40, 21),
(45, 41, 21),
(46, 39, 22),
(47, 40, 22),
(48, 41, 22),
(49, 42, 23),
(50, 43, 23),
(51, 44, 23),
(52, 39, 24),
(53, 40, 24),
(54, 41, 24),
(55, 39, 25),
(56, 40, 25),
(57, 41, 25),
(58, 42, 26),
(59, 43, 26),
(60, 44, 26),
(61, 39, 27),
(62, 40, 27),
(63, 41, 27),
(64, 39, 28),
(65, 40, 28),
(66, 41, 28),
(67, 39, 29),
(68, 40, 29),
(69, 41, 29),
(70, 42, 32),
(71, 43, 32),
(72, 44, 32),
(73, 42, 33),
(74, 43, 33),
(75, 44, 33),
(76, 45, 35),
(77, 46, 35),
(78, 47, 35),
(79, 48, 36),
(80, 49, 36),
(81, 50, 36),
(82, 51, 38),
(83, 52, 38),
(84, 53, 38),
(85, 54, 13),
(86, 55, 13),
(87, 56, 13),
(88, 57, 13),
(89, 58, 13),
(90, 59, 13),
(91, 60, 13),
(92, 61, 16),
(95, 64, 18),
(96, 65, 18),
(97, 66, 18),
(98, 67, 18),
(99, 68, 19),
(100, 69, 19),
(101, 70, 19),
(102, 71, 19),
(103, 73, 19),
(104, 60, 17),
(105, 54, 13),
(106, 55, 13),
(107, 56, 13),
(108, 57, 13),
(109, 58, 13),
(110, 59, 13),
(111, 60, 13),
(112, 61, 30),
(113, 62, 37),
(114, 1, 16),
(115, 2, 16),
(116, 3, 16),
(117, 4, 16);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(20) NOT NULL COMMENT 'User''s identifier (no special characters)',
  `user_first_name` varchar(100) NOT NULL COMMENT 'User''s first name',
  `user_last_name` varchar(255) NOT NULL COMMENT 'User''s last name',
  `user_mail` varchar(320) NOT NULL COMMENT 'User''s email address',
  `user_password` varchar(255) NOT NULL COMMENT 'User''s password',
  `user_create_date` datetime NOT NULL COMMENT 'Date of user''s profile creation',
  `user_avatar` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'User''s photo or avatar',
  `user_bio` text COMMENT 'User''s biography',
  `user_role` enum('user','admin','modo') NOT NULL COMMENT 'User''s role defined by the admin',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_first_name`, `user_last_name`, `user_mail`, `user_password`, `user_create_date`, `user_avatar`, `user_bio`, `user_role`) VALUES
('CaptainBaguette', 'Steve', 'Rogers', 'captainbaguette@gmail.com', '$2y$10$p/boHzhc7DP9LOiDV8Cene3s5LY4fFh0P293x1wBuIf5/Q76DjKj6', '2025-02-28 09:31:36', 'eaa426da80dfee6928a7.webp', 'Super-héro le jour, boulanger la nuit', 'user'),
('DarkVadorFan', 'Anakin', 'Skywalker', 'vadorfan@gmail.com', '$2y$10$xv4awHS1wUO1MB7gzZ8X5OFw9rCgW5iSh5dNXcqL0gmDrQobGwyrq', '2025-02-28 09:29:40', '694f46f65cde5bd4a62e.webp', 'Passionné par les films Star Wars et les sabres laser', 'user'),
('DevTestAdmin', 'Dev', 'Admin', 'devtestadmin@dev.com', '$2y$10$w8VBr9BpIUgm6Jk0HfA4LO5xKdZXu.UXdzrM7W2dIQ9nwQ0lTa9nG', '2025-02-27 15:24:51', 'cff492f173345dfca0a5.webp', '', 'admin'),
('DevTestModo', 'Dev', 'Modo', 'devtestmodo@dev.com', '$2y$10$Uu8INVT/PvmqZAhhkhwhNe5sWSPj8Lm7r0tFEEC1lgHIl5J0UXT62', '2025-02-27 14:01:26', '4ebe9c504b5ec0faed5a.webp', '', 'modo'),
('DevTestUser', 'Dev', 'User', 'devtestuser@dev.com', '$2y$10$N6KFpX8PrHUw5h.rbZShPu7Tzg/BaeKi4vss1UxGmrDi8Cw1cMh/u', '2025-02-27 15:23:51', 'no_profile_pic.webp', '', 'user'),
('GollumTropMignon', 'Smeagol', 'Gollum', 'gollumsmea@gmail.com', '$2y$10$WgJPprtEjE86Uy7GAAZ/v.ah7Kwf6Wpu06M7GxFswwXHqfpQpz5xy', '2025-02-28 09:32:38', '2f8b924041727e699413.webp', 'J\'adore mon précieux !', 'user'),
('SuperPoulet', 'Clark', 'Kent', 'superpoulet@gmail.com', '$2y$10$YrUg5TKcgmOQyDhHdxUXmOLGRhqSfhO0hfbPtcY6x.Pd3XR9WtCMS', '2025-02-28 09:35:32', '6732681ca117504e0108.webp', 'Sauve le monde tout en mangeant des frites', 'user'),
('TonyStark', 'Tony', 'Stark', 'ironman@gmail.com', '$2y$10$kGl8R4Kh8pkv/cUpLe/CIOJq4DEGtoQS.glcNLCbCl7S9.DCZEngu', '2025-02-28 09:39:39', '197e5b250c8b56c42d45.webp', 'Génie, milliardaire, playboy, philanthrope', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `belong`
--
ALTER TABLE `belong`
  ADD CONSTRAINT `belong_ibfk_1` FOREIGN KEY (`bel_cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `belong_ibfk_2` FOREIGN KEY (`bel_movie_id`) REFERENCES `movie` (`movie_id`);

--
-- Contraintes pour la table `collect`
--
ALTER TABLE `collect`
  ADD CONSTRAINT `collect_ibfk_1` FOREIGN KEY (`coll_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `collect_ibfk_2` FOREIGN KEY (`coll_movie_id`) REFERENCES `movie` (`movie_id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`comm_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comm_movie_id`) REFERENCES `movie` (`movie_id`);

--
-- Contraintes pour la table `host`
--
ALTER TABLE `host`
  ADD CONSTRAINT `host_ibfk_1` FOREIGN KEY (`host_plat_id`) REFERENCES `platform` (`plat_id`),
  ADD CONSTRAINT `host_ibfk_2` FOREIGN KEY (`host_movie_id`) REFERENCES `movie` (`movie_id`);

--
-- Contraintes pour la table `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`opi_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `opinion_ibfk_2` FOREIGN KEY (`opi_movie_id`) REFERENCES `movie` (`movie_id`);

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `FK_pic_comment_id` FOREIGN KEY (`pic_comment_id`) REFERENCES `comment` (`comm_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `play`
--
ALTER TABLE `play`
  ADD CONSTRAINT `play_ibfk_1` FOREIGN KEY (`play_actor_id`) REFERENCES `actor` (`actor_id`),
  ADD CONSTRAINT `play_ibfk_2` FOREIGN KEY (`play_movie_id`) REFERENCES `movie` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
