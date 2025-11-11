-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 02:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kdrama`
--

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE `cast` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `agensi` varchar(100) DEFAULT NULL,
  `id_kdrama` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cast`
--

INSERT INTO `cast` (`id`, `nama`, `jenis_kelamin`, `agensi`, `id_kdrama`) VALUES
(1, 'Hyun Bin', 'Pria', 'VAST Entertainment', 1),
(2, 'Son Ye-jin', 'Wanita', 'MSTeam Entertainment', 1),
(3, 'Song Joong-ki', 'Pria', 'HighZium Studio', 2),
(4, 'Jeon Yeo-been', 'Wanita', 'Management MMM', 2),
(5, 'Ahn Hyo-seop', 'Pria', 'The Present Company', 3),
(6, 'Kim Se-jeong', 'Wanita', 'Jellyfish Entertainment', 3),
(7, 'Ryu Seung-ryong', 'Pria', 'PRAIN TPC', 4),
(8, 'Han Hyo-joo', 'Wanita', 'BH Entertainment', 4),
(9, 'Kim Tae-ri', 'Wanita', 'Management mmm', 5),
(10, 'Nam Joo-hyuk', 'Pria', 'Management SOOP', 5),
(11, 'Song Kang', 'Pria', 'Namoo Actors', 6),
(12, 'Lee Do-hyun', 'Pria', 'Yuehua Entertainment Korea', 6),
(13, 'Park Ji-hoon', 'Pria', 'YY Entertainment', 7),
(14, 'Choi Hyun-wook', 'Pria', 'Gold Medalist', 7),
(15, 'Bae Suzy', 'Wanita', 'Management SOOP', 8);

-- --------------------------------------------------------

--
-- Table structure for table `kdrama`
--

CREATE TABLE `kdrama` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `tahun_liris` year(4) DEFAULT NULL,
  `id_platforms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kdrama`
--

INSERT INTO `kdrama` (`id`, `judul`, `genre`, `tahun_liris`, `id_platforms`) VALUES
(1, 'Crash Landing on You', 'Romance, Comedy', '2019', 1),
(2, 'Vincenzo', 'Action, Comedy', '2021', 1),
(3, 'Business Proposal', 'Romance, Office', '2022', 2),
(4, 'Moving', 'Sci-Fi, Action', '2023', 3),
(5, 'Twenty-Five Twenty-One', 'Drama, Youth', '2022', 1),
(6, 'Sweet Home', 'Horror, Thriller', '2020', 1),
(7, 'Weak Hero Class 1', 'Action, School', '2022', 4),
(8, 'Anna', 'Psychological, Thriller', '2022', 5);

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `negara_asal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `nama`, `negara_asal`) VALUES
(1, 'Netflix', 'Amerika Serikat'),
(2, 'Viu', 'Hong Kong'),
(3, 'Disney + Hotstar', 'Amerika Serikat'),
(4, 'TVING', 'Korea Selatan'),
(5, 'Coupang Play', 'Korea Selatan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cast`
--
ALTER TABLE `cast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kdrama` (`id_kdrama`);

--
-- Indexes for table `kdrama`
--
ALTER TABLE `kdrama`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_platforms` (`id_platforms`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cast`
--
ALTER TABLE `cast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kdrama`
--
ALTER TABLE `kdrama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cast`
--
ALTER TABLE `cast`
  ADD CONSTRAINT `cast_ibfk_1` FOREIGN KEY (`id_kdrama`) REFERENCES `kdrama` (`id`);

--
-- Constraints for table `kdrama`
--
ALTER TABLE `kdrama`
  ADD CONSTRAINT `kdrama_ibfk_1` FOREIGN KEY (`id_platforms`) REFERENCES `platforms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
