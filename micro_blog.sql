-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 20 Janvier 2017 à 23:28
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `micro_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(3) UNSIGNED NOT NULL,
  `contenu` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `contenu`, `date`, `utilisateur_id`) VALUES
(9, '              Coucou !!!!!!! :)\r\n                    ', '2017-01-05 15:28:19', 0),
(10, 'Hey !!!!\r\n        ', '2017-01-05 15:29:01', 0),
(11, '          Bonjour :)\r\n                                        ', '2017-01-05 15:56:35', 0),
(12, '                          Hello les amis', '2017-01-17 14:25:29', 0),
(13, '                          Comment vous allez ?', '2017-01-17 14:25:38', 0),
(14, '                          Moi je vais bien :)', '2017-01-17 14:25:45', 0),
(15, ' Je suis actuellement en cours de php', '2017-01-17 14:26:09', 0),
(16, '                          Ola quetal !', '2017-01-17 14:26:16', 0),
(17, '                          Hi, how are you ?', '2017-01-17 14:26:29', 0),
(18, '                          Saranghae *kiss**kiss*', '2017-01-17 14:27:09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `mdp`, `pseudo`, `sid`, `email`) VALUES
(1, '518d5f3401534f5c6c21977f12f60989', 'nana', 'd7ced1c64a7d1be0cfb32b6d3f7564e9', ''),
(2, 'nana', 'nana', 'd7ced1c64a7d1be0cfb32b6d3f7564e9', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`utilisateur_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
