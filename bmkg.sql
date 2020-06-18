-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 10:07 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmkg`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_users`
--

CREATE TABLE `api_users` (
  `email` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `hit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_users`
--

INSERT INTO `api_users` (`email`, `api_key`, `hit`) VALUES
('ferdiberlianoputra@gmail.com', '123', 0),
('rizaluardi@gmail.com', '2211', 6);

-- --------------------------------------------------------

--
-- Table structure for table `cuaca`
--

CREATE TABLE `cuaca` (
  `id` int(5) NOT NULL,
  `parameter` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuaca`
--

INSERT INTO `cuaca` (`id`, `parameter`) VALUES
(1, 'Hujan'),
(2, 'Cerah'),
(3, 'Berawan'),
(4, 'Badai');

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `id` int(5) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`id`, `provinsi`, `kota`) VALUES
(1, 'Jawa Barat', 'Kota Bandung'),
(2, 'Lampung', 'Kota Metro'),
(3, 'Bali', 'Denpasar'),
(4, 'Sumatra Selatan', 'Palembang'),
(5, 'Jakarta', 'Jakarta'),
(6, 'Banten', 'Tanggerang');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(5) NOT NULL,
  `kode_daerah` int(5) NOT NULL,
  `kode_cuaca` int(5) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `kode_daerah`, `kode_cuaca`, `tanggal`) VALUES
(1, 5, 3, '2020-06-19'),
(2, 2, 2, '2020-06-19'),
(3, 2, 1, '2020-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `stasiun_cuaca`
--

CREATE TABLE `stasiun_cuaca` (
  `id` varchar(11) NOT NULL,
  `nama_stasiun` varchar(50) NOT NULL,
  `id_daerah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stasiun_cuaca`
--

INSERT INTO `stasiun_cuaca` (`id`, `nama_stasiun`, `id_daerah`) VALUES
('1', 'Badan Meteorologi Klimatologi dan Geofisika Indone', 5),
('2', 'BMKG Stasiun Meteorologi Klas 1 Serang', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `api_key` (`api_key`);

--
-- Indexes for table `cuaca`
--
ALTER TABLE `cuaca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_1` (`kode_daerah`),
  ADD KEY `foreign_2` (`kode_cuaca`) USING BTREE;

--
-- Indexes for table `stasiun_cuaca`
--
ALTER TABLE `stasiun_cuaca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`id_daerah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuaca`
--
ALTER TABLE `cuaca`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `informasi`
--
ALTER TABLE `informasi`
  ADD CONSTRAINT `foreign_1` FOREIGN KEY (`kode_daerah`) REFERENCES `daerah` (`id`),
  ADD CONSTRAINT `foreign_2` FOREIGN KEY (`kode_cuaca`) REFERENCES `cuaca` (`id`);

--
-- Constraints for table `stasiun_cuaca`
--
ALTER TABLE `stasiun_cuaca`
  ADD CONSTRAINT `fk_stasiun` FOREIGN KEY (`id_daerah`) REFERENCES `daerah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
