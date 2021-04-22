-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2021 at 09:50 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_siekskul`
--

-- --------------------------------------------------------

--
-- Table structure for table `ekskul`
--

CREATE TABLE `ekskul` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jadwal` text NOT NULL,
  `wajib` varchar(10) NOT NULL DEFAULT 'tidak' COMMENT 'ya/tidak',
  `id_pengurus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ekskul`
--

INSERT INTO `ekskul` (`id`, `nama`, `jadwal`, `wajib`, `id_pengurus`) VALUES
(1, 'Pramuka', 'Jumat', 'ya', '1002'),
(2, 'PKS', 'Selasa', 'tidak', '1003'),
(3, 'PMR', 'Selasa', 'tidak', '1004'),
(4, 'Seni', 'Selasa', 'tidak', '1005'),
(5, 'Sepak Bola', 'Sabtu', 'tidak', '1006'),
(6, 'Voli', 'Selasa dan Kamis', 'tidak', '1007'),
(7, 'Rokat', 'Jumat', 'ya', '1008'),
(8, 'Rohis', 'Jumat', 'ya', '1009'),
(9, 'Rokris', 'Jumat', 'ya', '1010');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` varchar(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '12345',
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `status`) VALUES
('1', 'admin', 'admin', 'admin'),
('1002', '1002', '12345', 'pengurus'),
('1003', '1003', '12345', 'pengurus'),
('1004', '1004', '12345', 'pengurus'),
('1005', '1005', '12345', 'pengurus'),
('1006', '1006', '12345', 'pengurus'),
('1007', '1007', '12345', 'pengurus'),
('1008', '1008', '12345', 'pengurus'),
('1009', '1009', '12345', 'pengurus'),
('1010', '1010', '12345', 'pengurus'),
('1011', '1011', '12345', 'siswa'),
('1012', '1012', '12345', 'siswa'),
('1013', '1013', '12345', 'siswa'),
('1014', '1014', '12345', 'siswa'),
('1015', '1015', '12345', 'siswa'),
('1016', '1016', '12345', 'siswa'),
('1017', '1017', '12345', 'siswa'),
('1018', '1018', '12345', 'siswa'),
('1019', '1019', '12345', 'siswa'),
('1020', '1020', '12345', 'siswa'),
('1021', 'kepsek', '12345', 'kepsek'),
('1022', 'wakepsek', '12345', 'wakepsek');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nohp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama`, `nohp`) VALUES
('1002', 'Romanus Rinto Charles', '081234561234'),
('1003', 'Antonius Fredi', '089912345678'),
('1004', 'Zainal Fanani', '089900123456'),
('1005', 'Regina A', '081123008877'),
('1006', 'Alli Marsun', '086578129876'),
('1007', 'Junanto J', '081274627267'),
('1008', 'Yovinus Leovi P', '083729472673'),
('1009', 'Gusti Abdurahman H', '082863527367'),
('1010', 'Yohana Marwati', '088162826367');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `id_siswa` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `id_ekskul`, `id_siswa`) VALUES
(7, 1, '1011'),
(9, 1, '1016'),
(10, 3, '1011'),
(11, 7, '1011');

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_pengurus` varchar(5) DEFAULT NULL,
  `id_ekskul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `judul`, `isi`, `tanggal`, `id_pengurus`, `id_ekskul`) VALUES
(1, 'Ekskul Pramuka minggu ini ditiadakan', 'Berhubungan dengan acara XXX yang dilaksanakan bertepatan pada hari Jumat, maka ekstrakurikuler pada hari Jumat tanggal 10 - mm - 2020 ditiadakan. \r\nDiadakan kembali pada tanggal 17 - mm - 2020', '2021-04-22', '1002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `hadir` varchar(10) NOT NULL DEFAULT 'ya' COMMENT 'ya/tidak',
  `id_siswa` varchar(5) NOT NULL,
  `id_ekskul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `nohp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `kelas`, `nohp`) VALUES
('1011', 'Agung', 'X IPA 1', '089898112233'),
('1012', 'Budianto', 'X IPA 1', '081192875566'),
('1013', 'Charles', 'X IPA 1', '081928273661'),
('1014', 'Dedi', 'X IPA 1', '089900990012'),
('1015', 'Emma', 'X IPA 1', '081127363767'),
('1016', 'Abdullah', 'X IPS 1', '089182735537'),
('1017', 'Bernadeth', 'X IPS 1', '081637616273'),
('1018', 'Cindy', 'X IPS 1', '087787792817'),
('1019', 'Dinda', 'X IPS 1', '081736762736'),
('1020', 'Filensius', 'X IPS 1', '083667636363');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_username` (`username`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
