-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 26 sep. 2020 à 14:36
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  `key` int NOT NULL,
  `reason` text NOT NULL,
  `etudiant_key` int NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `key` int NOT NULL,
  `id` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `administrative staff`
--

CREATE TABLE `administrative staff` (
  `key` int NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL,
  `id` int NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `key` int NOT NULL,
  `id` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `first_name` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant_module`
--

CREATE TABLE `enseignant_module` (
  `enseignant_key` int NOT NULL,
  `module_key` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `key` int NOT NULL,
  `id` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant_module`
--

CREATE TABLE `etudiant_module` (
  `etudiant_key` int NOT NULL,
  `module_key` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `key` int NOT NULL,
  `name` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
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
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `administrative staff`
--
ALTER TABLE `administrative staff`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `enseignant_module`
--
ALTER TABLE `enseignant_module`
  ADD KEY `enseignant_key` (`enseignant_key`),
  ADD KEY `module_key` (`module_key`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `etudiant_module`
--
ALTER TABLE `etudiant_module`
  ADD KEY `etudiant_key` (`etudiant_key`),
  ADD KEY `module_key` (`module_key`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`key`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `key` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `key` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `administrative staff`
--
ALTER TABLE `administrative staff`
  MODIFY `key` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `key` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `key` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `key` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`etudiant_key`) REFERENCES `etudiant` (`key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseignant_module`
--
ALTER TABLE `enseignant_module`
  ADD CONSTRAINT `enseignant_module_ibfk_1` FOREIGN KEY (`enseignant_key`) REFERENCES `enseignant` (`key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant_module`
--
ALTER TABLE `etudiant_module`
  ADD CONSTRAINT `etudiant_module_ibfk_1` FOREIGN KEY (`etudiant_key`) REFERENCES `etudiant` (`key`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etudiant_module_ibfk_2` FOREIGN KEY (`module_key`) REFERENCES `module` (`key`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`key`) REFERENCES `enseignant_module` (`module_key`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
