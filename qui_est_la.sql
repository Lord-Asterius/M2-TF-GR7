-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 06:46 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qui_est_la`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

CREATE TABLE `absence` (
  `key` int(11) NOT NULL,
  `reason` text NOT NULL,
  `etudiant_key` int(11) NOT NULL,
  `module_key` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `absence`
--

INSERT INTO `absence` (`key`, `reason`, `etudiant_key`, `module_key`, `comment`, `created`) VALUES
(6, 'ESRDTFYGHJK', 2, 25, '', '2020-01-01 01:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `key` int(11) NOT NULL,
  `id` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `administrative staff`
--

CREATE TABLE `administrative staff` (
  `key` int(11) NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `key` int(11) NOT NULL,
  `id` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`key`, `id`, `password`, `first_name`, `last_name`) VALUES
(1, '12354', '123456', 'fabrice', 'bouquer');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant_module`
--

CREATE TABLE `enseignant_module` (
  `enseignant_key` int(11) NOT NULL,
  `module_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enseignant_module`
--

INSERT INTO `enseignant_module` (`enseignant_key`, `module_key`) VALUES
(1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `key` int(11) NOT NULL,
  `id` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`key`, `id`, `password`, `first_name`, `last_name`) VALUES
(1, '123456', '123456', 'Khadija', 'Angel'),
(2, '3453612', '123456', 'SOUFIANE', 'DQW');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_module`
--

CREATE TABLE `etudiant_module` (
  `id` int(11) NOT NULL,
  `etudiant_key` int(11) NOT NULL,
  `module_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant_module`
--

INSERT INTO `etudiant_module` (`id`, `etudiant_key`, `module_key`) VALUES
(1, 1, 25),
(2, 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `key` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`key`, `name`) VALUES
(25, 'Teqt fonctionnel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`key`),
  ADD KEY `etudiant_key` (`etudiant_key`),
  ADD KEY `absence_ibfk_2` (`module_key`);

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `administrative staff`
--
ALTER TABLE `administrative staff`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `enseignant_module`
--
ALTER TABLE `enseignant_module`
  ADD KEY `enseignant_key` (`enseignant_key`),
  ADD KEY `module_key` (`module_key`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `etudiant_module`
--
ALTER TABLE `etudiant_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etudiant_key` (`etudiant_key`),
  ADD KEY `module_key` (`module_key`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absence`
--
ALTER TABLE `absence`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `administrative staff`
--
ALTER TABLE `administrative staff`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `etudiant_module`
--
ALTER TABLE `etudiant_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`etudiant_key`) REFERENCES `etudiant` (`key`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`module_key`) REFERENCES `module` (`key`);

--
-- Constraints for table `enseignant_module`
--
ALTER TABLE `enseignant_module`
  ADD CONSTRAINT `enseignant_module_ibfk_1` FOREIGN KEY (`enseignant_key`) REFERENCES `enseignant` (`key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etudiant_module`
--
ALTER TABLE `etudiant_module`
  ADD CONSTRAINT `etudiant_module_ibfk_1` FOREIGN KEY (`etudiant_key`) REFERENCES `etudiant` (`key`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etudiant_module_ibfk_2` FOREIGN KEY (`module_key`) REFERENCES `module` (`key`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`key`) REFERENCES `enseignant_module` (`module_key`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
