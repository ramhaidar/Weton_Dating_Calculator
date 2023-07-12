-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 11:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weton_jodoh`
--

-- --------------------------------------------------------

--
-- Table structure for table `neptu_hari`
--

CREATE TABLE `neptu_hari` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `neptu_hari`
--

INSERT INTO `neptu_hari` (`id`, `nama`, `nilai`) VALUES
(3, 'Selasa', 3),
(4, 'Senin', 4),
(5, 'Minggu', 5),
(6, 'Jumat', 6),
(7, 'Rabu', 7),
(8, 'Kamis', 8),
(9, 'Sabtu', 9);

-- --------------------------------------------------------

--
-- Table structure for table `neptu_pasaran`
--

CREATE TABLE `neptu_pasaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `neptu_pasaran`
--

INSERT INTO `neptu_pasaran` (`id`, `nama`, `nilai`) VALUES
(4, 'Wage', 4),
(5, 'Legi', 5),
(7, 'Pon', 7),
(8, 'Kliwon', 8),
(9, 'Pahing', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orang`
--

CREATE TABLE `orang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `neptu_hari_id` int(11) NOT NULL,
  `neptu_pasaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orang`
--

INSERT INTO `orang` (`id`, `nama`, `neptu_hari_id`, `neptu_pasaran`) VALUES
(1, 'Joko Widodo', 6, 8),
(2, 'Megawati', 5, 8),
(3, 'Haritano', 7, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `neptu_hari`
--
ALTER TABLE `neptu_hari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neptu_pasaran`
--
ALTER TABLE `neptu_pasaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orang`
--
ALTER TABLE `orang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `neptu_hari_id` (`neptu_hari_id`),
  ADD KEY `neptu_pasaran` (`neptu_pasaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `neptu_hari`
--
ALTER TABLE `neptu_hari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `neptu_pasaran`
--
ALTER TABLE `neptu_pasaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orang`
--
ALTER TABLE `orang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orang`
--
ALTER TABLE `orang`
  ADD CONSTRAINT `orang_ibfk_1` FOREIGN KEY (`neptu_hari_id`) REFERENCES `neptu_hari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_ibfk_2` FOREIGN KEY (`neptu_pasaran`) REFERENCES `neptu_pasaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
