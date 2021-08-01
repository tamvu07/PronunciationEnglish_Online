-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2019 at 04:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pronunciation_english_korea`
--

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE `example` (
  `EX_ID` int(11) NOT NULL,
  `VO_ID` int(11) NOT NULL,
  `example_test` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `translate` varchar(1000) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vocabulary`
--

CREATE TABLE `vocabulary` (
  `ID` int(11) NOT NULL,
  `vocabulary` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phonetic` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `translate` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pronunciation` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `vocabulary`
--

INSERT INTO `vocabulary` (`ID`, `vocabulary`, `type`, `phonetic`, `translate`, `pronunciation`, `image`) VALUES
(21, '아', '.', 'a', '.', '', ''),
(22, '어', '.', 'o', '.', '', ''),
(23, '오', '.', 'ô', '.', '', ''),
(24, '우', '.', 'u', '.', '', ''),
(25, '으', '.', 'ư', '.', '', ''),
(26, '이', '.', 'y', '.', '', ''),
(27, '애', '.', 'e', '.', '', ''),
(28, '에', '.', 'ê', '.', '', ''),
(29, '야', '.', 'ya', '.', '', ''),
(30, '여', '.', 'yo', '.', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `example`
--
ALTER TABLE `example`
  ADD PRIMARY KEY (`EX_ID`),
  ADD KEY `VA_ID` (`VO_ID`);

--
-- Indexes for table `vocabulary`
--
ALTER TABLE `vocabulary`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `example`
--
ALTER TABLE `example`
  MODIFY `EX_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vocabulary`
--
ALTER TABLE `vocabulary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `example`
--
ALTER TABLE `example`
  ADD CONSTRAINT `example` FOREIGN KEY (`VO_ID`) REFERENCES `vocabulary` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
