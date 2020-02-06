-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2019 at 05:38 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.2.12-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vartvalds`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_guests`
--

CREATE TABLE `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_guests`
--

INSERT INTO `active_guests` (`ip`, `timestamp`) VALUES
('127.0.0.1', 1575992295);

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `anglu_antro_laikinas`
--

CREATE TABLE `anglu_antro_laikinas` (
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anglu_antro_laikinas`
--

INSERT INTO `anglu_antro_laikinas` (`zodis`, `vertimas`) VALUES
('train', 'traukinys'),
('car', 'automobilis'),
('ship', 'laivas');

-- --------------------------------------------------------

--
-- Table structure for table `anglu_laikinas`
--

CREATE TABLE `anglu_laikinas` (
  `id` int(5) NOT NULL,
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anglu_neteisingi`
--

CREATE TABLE `anglu_neteisingi` (
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `italu_antro_laikinas`
--

CREATE TABLE `italu_antro_laikinas` (
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `italu_antro_laikinas`
--

INSERT INTO `italu_antro_laikinas` (`zodis`, `vertimas`) VALUES
('romanzo', 'romanas'),
('pagina', 'puslapis'),
('dramma', 'drama');

-- --------------------------------------------------------

--
-- Table structure for table `italu_laikinas`
--

CREATE TABLE `italu_laikinas` (
  `id` int(5) NOT NULL,
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `italu_neteisingi`
--

CREATE TABLE `italu_neteisingi` (
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specifinis`
--

CREATE TABLE `specifinis` (
  `id` int(5) NOT NULL,
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL,
  `vartotojas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specifinis`
--

INSERT INTO `specifinis` (`id`, `zodis`, `vertimas`, `vartotojas`) VALUES
(7, 'sun', 'saule', 'Administratorius'),
(8, 'flower', 'gele', 'Administratorius'),
(9, 'interface', 'sasaja', 'Administratorius'),
(10, 'fence', 'tvora', 'Administratorius'),
(15, 'flower', 'gele', 'Vartotojas'),
(16, 'fence', 'tvora', 'Vartotojas'),
(17, 'sun', 'saule', 'Studentas'),
(18, 'interface', 'sasaja', 'Studentas'),
(19, 'flower', 'gele', 'Studentas'),
(20, 'fence', 'tvora', 'Studentas');

-- --------------------------------------------------------

--
-- Table structure for table `spec_antro_laikinas`
--

CREATE TABLE `spec_antro_laikinas` (
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spec_antro_laikinas`
--

INSERT INTO `spec_antro_laikinas` (`zodis`, `vertimas`) VALUES
('flower', 'gele'),
('fence', 'tvora');

-- --------------------------------------------------------

--
-- Table structure for table `spec_laikinas`
--

CREATE TABLE `spec_laikinas` (
  `id` int(5) NOT NULL,
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spec_neteisingi`
--

CREATE TABLE `spec_neteisingi` (
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('Destytojas', 'fe01ce2a7fbac8fafaed7c982a04e229', 'cb8c77129742db60fe89c84bc1216632', 5, 'demo@ktu.lt', 1575723938),
('Administratorius', 'fe01ce2a7fbac8fafaed7c982a04e229', '5f6e4721cff35fbdd2aba11500652f37', 9, 'demo@ktu.lt', 1575992295),
('Studentas', 'fe01ce2a7fbac8fafaed7c982a04e229', '3b970667e36fa5881c705bf7416523bf', 1, 'demo@ktu.lt', 1575723643),
('vilius', 'fe01ce2a7fbac8fafaed7c982a04e229', 'fea98e06e1462cac34dc30ef7363ea8c', 5, 'viliusk@gmail.com', 1575992264);

-- --------------------------------------------------------

--
-- Table structure for table `zodynas_anglu`
--

CREATE TABLE `zodynas_anglu` (
  `id` int(5) NOT NULL,
  `zodis` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `vertimas` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `tematika` varchar(50) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `zodynas_anglu`
--

INSERT INTO `zodynas_anglu` (`id`, `zodis`, `vertimas`, `tematika`) VALUES
(1, 'book', 'knyga', 'literatura'),
(2, 'paragraph', 'pastraipa', 'literatura'),
(3, 'novel', 'romanas', 'literatura'),
(4, 'car', 'automobilis', 'transportas'),
(5, 'bus', 'autobusas', 'transportas'),
(6, 'train', 'traukinys', 'transportas'),
(7, 'page', 'puslapis', 'literatura'),
(8, 'ship', 'laivas', 'transportas'),
(9, 'drama', 'drama', 'literatura'),
(10, 'bicycle', 'dviratis', 'transportas'),
(11, 'hero', 'herojus', 'literatura'),
(12, 'motorcycle', 'motociklas', 'transportas'),
(13, 'sun', 'saule', 'gamta');

-- --------------------------------------------------------

--
-- Table structure for table `zodynas_italu`
--

CREATE TABLE `zodynas_italu` (
  `id` int(5) NOT NULL,
  `zodis` varchar(50) NOT NULL,
  `vertimas` varchar(50) NOT NULL,
  `tematika` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zodynas_italu`
--

INSERT INTO `zodynas_italu` (`id`, `zodis`, `vertimas`, `tematika`) VALUES
(1, 'libro', 'knyga', 'literatura'),
(2, 'paragrafo', 'pastraipa', 'literatura'),
(3, 'romanzo', 'romanas', 'literatura'),
(4, 'auto', 'automobilis', 'transportas'),
(5, 'autobus', 'autobusas', 'transportas'),
(6, 'treno', 'traukinys', 'transportas'),
(7, 'pagina', 'puslapis', 'literatura'),
(8, 'la nave', 'laivas', 'transportas'),
(9, 'dramma', 'drama', 'literatura'),
(10, 'bicicletta', 'dviratis', 'transportas'),
(11, 'eroe', 'herojus', 'literatura'),
(12, 'motocicletta', 'motociklas', 'transportas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_guests`
--
ALTER TABLE `active_guests`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `anglu_laikinas`
--
ALTER TABLE `anglu_laikinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `italu_laikinas`
--
ALTER TABLE `italu_laikinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specifinis`
--
ALTER TABLE `specifinis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spec_laikinas`
--
ALTER TABLE `spec_laikinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `zodynas_anglu`
--
ALTER TABLE `zodynas_anglu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zodynas_italu`
--
ALTER TABLE `zodynas_italu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anglu_laikinas`
--
ALTER TABLE `anglu_laikinas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `italu_laikinas`
--
ALTER TABLE `italu_laikinas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `specifinis`
--
ALTER TABLE `specifinis`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `spec_laikinas`
--
ALTER TABLE `spec_laikinas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zodynas_anglu`
--
ALTER TABLE `zodynas_anglu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `zodynas_italu`
--
ALTER TABLE `zodynas_italu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
