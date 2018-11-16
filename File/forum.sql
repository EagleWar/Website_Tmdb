-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 13 déc. 2017 à 23:21
-- Version du serveur :  5.7.19-log
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tuto`
--
CREATE DATABASE 'TUTO';
-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id_forum` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `creator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id_forum`, `title`, `date`, `creator`) VALUES
(5, 'test2', '2017-11-26 18:05:15', '1'),
(9, 'tt', '2017-11-27 01:36:34', '1'),
(10, 'test new subject', '2017-12-06 04:14:25', '1'),
(12, 'new subject for us', '2017-12-06 04:28:02', 'adriano'),
(14, 'new test of forum', '2017-12-07 19:55:19', '1'),
(15, 'test', '2017-12-11 11:26:54', '1'),
(17, 'forum of eduardo', '2017-12-13 05:00:25', 'edouardo');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `forum_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`forum_id`, `user_id`, `message`, `date`) VALUES
(5, '1', 'CRVTRBRY YNNRTRTE FEEREFF', '2017-11-26 19:21:25'),
(5, '1', '', '2017-11-26 20:47:28'),
(5, '1', '', '2017-11-26 20:47:41'),
(5, '1', 'bgfdfg', '2017-11-26 21:43:45'),
(5, '1', 'fvqsfvq eeafrfaarfa rrevfrevv\r\nervaervaevraevaerevarev', '2017-11-26 21:43:58'),
(5, '1', 'test', '2017-11-26 22:58:10'),
(5, '1', 'goooooooooooooooogle', '2017-11-26 22:58:28'),
(5, '1', 'test', '2017-11-26 22:59:33'),
(5, '1', 'vererververv', '2017-11-26 23:04:25'),
(5, '1', 'vrevrever ferferfre test test', '2017-11-26 23:04:40'),
(5, '1', 'dz dz dz dz dz dz dz dz dz dz dz d zd dz dz dz d d zd zd zd zd d z dzz dz dz dz dz ', '2017-11-26 23:07:35'),
(5, '2', 'mooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooodle', '2017-11-26 23:08:32'),
(5, '2', 'testforum sur une seule page', '2017-11-26 23:23:56'),
(5, '2', 'tesfrjhefhrehfhrj  fe f  ef  ef f ef  ef ', '2017-11-26 23:24:13'),
(5, '2', 'gooooooooooooooooooooooooooooooooooogle', '2017-11-26 23:34:44'),
(5, '2', 'gooogle', '2017-11-26 23:34:52'),
(5, '2', 'gooogle', '2017-11-27 00:20:26'),
(5, '1', 'rjout  test ddededed ', '2017-11-27 00:33:15'),
(5, 'yansou', 'yansou a ajouter un machin\r<br/>dada', '2017-11-29 01:32:27'),
(14, '1', 'newemssa\r\n', '2017-12-11 11:54:36'),
(17, 'edouardo', 'forum \r\n', '2017-12-13 05:03:10'),
(17, 'edouardo', 'new message from edouard about xiaomi phones', '2017-12-13 05:04:27');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(30) NOT NULL,
  `passwd` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'avatar/default.png',
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `passwd`, `image`, `email`) VALUES
('1', 'test', 'avatar/avatar_1.png', 'test2@gmail.com'),
('2', 'test2', 'avatar/avatar_1.png', 'test@gmail.com'),
('adriano', 'test', 'avatar/default.png', 'yans@gmail.com'),
('edouardo', 'test', 'avatar/avatar_edouardo.png', 'edouardo.test@gmail.com'),
('test', 'root', 'avatar/default.png', 'yanisoum@gmail.com'),
('testtest', 'root', 'avatar/default.png', 'test@live.fr'),
('yanisou', 'test', 'avatar/default.png', 'yanisoum@gg.com'),
('yansou', 'root', 'avatar/default.png', 'yanisoum@gmail.com'),
('yes', 'coucou', 'avatar/default.png', 'test@live.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id_forum`,`title`),
  ADD KEY `id_forum` (`id_forum`),
  ADD KEY `creator` (`creator`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_forum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
