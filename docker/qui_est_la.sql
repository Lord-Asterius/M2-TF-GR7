-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 29 sep. 2020 à 16:55
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `qui_est_la`
--
CREATE DATABASE IF NOT EXISTS `qui_est_la` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `qui_est_la`;

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `key` int(11) NOT NULL,
  `reason` text COLLATE utf8_bin NOT NULL,
  `etudiant_key` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  'date' date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `enseigant_referent`
--

CREATE TABLE `enseigant_referent` (
  `enseigant_key` int(11) NOT NULL,
  `module_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `key` int(11) NOT NULL,
  `name` varchar(1024) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `key` int(11) NOT NULL,
  `id` varchar(1024) COLLATE utf8_bin NOT NULL,
  `password` varchar(1024) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(1024) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(1024) COLLATE utf8_bin NOT NULL,
  `mail` varchar(1024) COLLATE utf8_bin NOT NULL,
  `role` enum('ENSEIGNANT','EQUIPE_ADMINISTRATIVE','ADMINISTRATEUR','ETUDIANT','') COLLATE utf8_bin NOT NULL,
  `date_naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `user_module`
--

CREATE TABLE `user_module` (
  `user_key` int(11) NOT NULL,
  `module_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`key`),
  ADD KEY `etudiant_key` (`etudiant_key`);

--
-- Index pour la table `enseigant_referent`
--
ALTER TABLE `enseigant_referent`
  ADD KEY `enseigant_key` (`enseigant_key`),
  ADD KEY `module_key` (`module_key`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `user_module`
--
ALTER TABLE `user_module`
  ADD KEY `module_key` (`module_key`),
  ADD KEY `user_key` (`user_key`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`etudiant_key`) REFERENCES `user` (`key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseigant_referent`
--
ALTER TABLE `enseigant_referent`
  ADD CONSTRAINT `enseigant_referent_ibfk_1` FOREIGN KEY (`enseigant_key`) REFERENCES `user` (`key`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enseigant_referent_ibfk_2` FOREIGN KEY (`module_key`) REFERENCES `module` (`key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_module`
--
ALTER TABLE `user_module`
  ADD CONSTRAINT `user_module_ibfk_1` FOREIGN KEY (`user_key`) REFERENCES `user` (`key`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_module_ibfk_2` FOREIGN KEY (`module_key`) REFERENCES `module` (`key`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
