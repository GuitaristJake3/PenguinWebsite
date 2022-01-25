-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 04:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penguins`
--

-- --------------------------------------------------------

--
-- Table structure for table `habitat`
--

CREATE TABLE `habitat` (
  `habitatID` int(11) NOT NULL,
  `habitatName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `habitat`
--

INSERT INTO `habitat` (`habitatID`, `habitatName`) VALUES
(1, 'Antarctic coastal areas'),
(2, 'Islands and coasts in the Southern Pacific and Antarctic Oceans'),
(3, 'Antarctic peninsular, sub Antarctic islands and the Falkland Islands'),
(4, 'Islands in the Atlantic and Indian Oceans');

-- --------------------------------------------------------

--
-- Table structure for table `penguin`
--

CREATE TABLE `penguin` (
  `penguinID` int(11) NOT NULL,
  `commonName` varchar(50) NOT NULL,
  `binomialName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penguin`
--

INSERT INTO `penguin` (`penguinID`, `commonName`, `binomialName`) VALUES
(1, 'Emperor', 'Aptenodytes forsteri'),
(2, 'Gentoo', 'Pygoscelis papua'),
(3, 'Adelie', 'Pygoscelis adeliae'),
(4, 'Macaroni', 'Eudyptes chrysolophus'),
(5, 'King', 'Aptenodytes patagonicus'),
(6, 'Rock Hopper', 'Eudyptes chrysocome'),
(7, 'Yellow Eyed', 'Megadyptes antipodes'),
(8, 'Magellanic', 'Spheniscus magellanicus');

-- --------------------------------------------------------

--
-- Table structure for table `penguinhabitation`
--

CREATE TABLE `penguinhabitation` (
  `penguinID` int(11) NOT NULL,
  `habitatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penguinhabitation`
--

INSERT INTO `penguinhabitation` (`penguinID`, `habitatID`) VALUES
(1, 1),
(2, 3),
(3, 1),
(4, 3),
(5, 3),
(6, 4),
(7, 2),
(8, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`habitatID`);

--
-- Indexes for table `penguin`
--
ALTER TABLE `penguin`
  ADD PRIMARY KEY (`penguinID`);

--
-- Indexes for table `penguinhabitation`
--
ALTER TABLE `penguinhabitation`
  ADD PRIMARY KEY (`penguinID`,`habitatID`),
  ADD KEY `habitatID` (`habitatID`),
  ADD KEY `penguinID` (`penguinID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `habitatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penguin`
--
ALTER TABLE `penguin`
  MODIFY `penguinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penguinhabitation`
--
ALTER TABLE `penguinhabitation`
  ADD CONSTRAINT `FK_pengid` FOREIGN KEY (`penguinID`) REFERENCES `penguin` (`penguinID`),
  ADD CONSTRAINT `penguinhabitation_ibfk_1` FOREIGN KEY (`penguinID`) REFERENCES `penguin` (`penguinID`),
  ADD CONSTRAINT `penguinhabitation_ibfk_2` FOREIGN KEY (`habitatID`) REFERENCES `habitat` (`habitatID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
