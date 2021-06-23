-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2021 at 07:49 AM
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
('1002', 'romanus', '12345', 'pengurus'),
('1003', 'antonius', '12345', 'pengurus'),
('1004', 'zainal', '12345', 'pengurus'),
('1005', 'regina', '12345', 'pengurus'),
('1006', 'allimarsun', '12345', 'pengurus'),
('1007', 'junanto', '12345', 'pengurus'),
('1008', 'yovinus', '12345', 'pengurus'),
('1009', 'gusti', '12345', 'pengurus'),
('1010', 'yohana', '12345', 'pengurus'),
('1021', 'kepsek', '12345', 'kepsek'),
('1022', 'wakepsek', '12345', 'wakepsek'),
('1100', '3041601374', '12345', 'siswa'),
('1101', '0050317632', '12345', 'siswa'),
('1102', '0041472740', '12345', 'siswa'),
('1103', '0041472788', '12345', 'siswa'),
('1104', '0041553952', '12345', 'siswa'),
('1105', '0040778601', '12345', 'siswa'),
('1106', '0041472790', '12345', 'siswa'),
('1107', '0035538172', '12345', 'siswa'),
('1108', '0041553955', '12345', 'siswa'),
('1109', '0032578550', '12345', 'siswa'),
('1110', '0041472787', '12345', 'siswa'),
('1111', '0034694191', '12345', 'siswa'),
('1112', '0053083010', '12345', 'siswa'),
('1113', '0050970552', '12345', 'siswa'),
('1114', '0051290257', '12345', 'siswa'),
('1115', '0028272634', '12345', 'siswa'),
('1116', '0051290250', '12345', 'siswa'),
('1117', '0040778587', '12345', 'siswa'),
('1118', '0035579955', '12345', 'siswa'),
('1119', '0051290230', '12345', 'siswa'),
('1120', '0020982594', '12345', 'siswa'),
('1121', '0046906202', '12345', 'siswa'),
('1122', '0066573177', '12345', 'siswa'),
('1123', '0011080609', '12345', 'siswa');

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
(1, 1, '1100'),
(2, 1, '1101'),
(3, 1, '1103'),
(4, 1, '1104'),
(5, 1, '1106'),
(6, 1, '1107'),
(7, 1, '1109'),
(8, 1, '1110'),
(9, 1, '1112'),
(10, 1, '1113'),
(11, 1, '1115'),
(12, 1, '1116'),
(13, 1, '1118'),
(14, 1, '1119'),
(15, 1, '1121'),
(16, 1, '1122'),
(38, 2, '1100'),
(39, 3, '1101'),
(40, 4, '1102'),
(41, 5, '1103'),
(42, 6, '1104'),
(43, 3, '1106'),
(44, 4, '1107'),
(45, 5, '1108'),
(46, 1, '1110'),
(47, 2, '1111'),
(48, 3, '1112'),
(49, 4, '1113'),
(50, 6, '1115'),
(51, 4, '1116'),
(52, 3, '1117'),
(53, 2, '1118'),
(54, 6, '1120'),
(55, 4, '1121'),
(56, 3, '1122'),
(57, 2, '1123'),
(58, 7, '1100'),
(59, 8, '1101'),
(60, 9, '1102'),
(61, 7, '1103'),
(62, 8, '1104'),
(63, 9, '1105'),
(64, 7, '1106'),
(65, 8, '1107'),
(66, 9, '1108'),
(67, 8, '1109'),
(68, 8, '1110'),
(69, 9, '1111'),
(70, 8, '1112'),
(71, 7, '1113'),
(72, 7, '1114'),
(73, 8, '1115'),
(74, 9, '1116'),
(75, 8, '1117'),
(76, 7, '1118'),
(77, 7, '1119'),
(78, 8, '1120'),
(79, 9, '1121'),
(80, 9, '1122'),
(81, 7, '1123'),
(82, 5, '1100'),
(83, 6, '1108'),
(84, 1, '1105'),
(85, 6, '1101');

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `id_pengurus` varchar(5) DEFAULT NULL,
  `id_ekskul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `judul`, `isi`, `kategori`, `tanggal`, `id_pengurus`, `id_ekskul`) VALUES
(1, 'Agenda Pramuka', 'membuat kelompok dan latihan baris berbaris', 'agenda', '2021-05-07', '1002', 1),
(2, 'Agenda Pramuka', 'Latihan cara mengikat tali', 'agenda', '2021-05-14', '1002', 1),
(3, 'Agenda Pramuka', 'Mempelajari gerak isyarat', 'agenda', '2021-05-21', '1002', 1),
(4, 'Agenda Pramuka', 'Upacara', 'agenda', '2021-05-28', '1002', 1),
(5, 'Agenda Pramuka', 'Mempelajari cara mendirikan tenda', 'agenda', '2021-06-04', '1002', 1),
(6, 'Agenda Pramuka', 'Lomba antar kelompok', 'agenda', '2021-06-11', '1002', 1),
(7, 'Pengumuman Pramuka', 'Peserta Ekskul Pramuka diwajibkan membawa 1 tenda utk 1 kelompok.', 'pengumuman', '2021-06-01', '1002', 1);

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

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `tanggal`, `hadir`, `id_siswa`, `id_ekskul`) VALUES
(1, '2021-05-07', 'ya', '1103', 1),
(2, '2021-05-07', 'ya', '1100', 1),
(3, '2021-05-07', 'ya', '1106', 1),
(4, '2021-05-07', 'ya', '1112', 1),
(5, '2021-05-07', 'ya', '1101', 1),
(6, '2021-05-07', 'ya', '1118', 1),
(7, '2021-05-07', 'ya', '1116', 1),
(8, '2021-05-07', 'ya', '1107', 1),
(9, '2021-05-07', 'ya', '1110', 1),
(10, '2021-05-07', 'ya', '1119', 1),
(11, '2021-05-07', 'ya', '1104', 1),
(12, '2021-05-07', 'ya', '1122', 1),
(13, '2021-05-14', 'ya', '1103', 1),
(14, '2021-05-14', 'ya', '1100', 1),
(15, '2021-05-14', 'ya', '1106', 1),
(16, '2021-05-14', 'ya', '1112', 1),
(17, '2021-05-14', 'ya', '1115', 1),
(18, '2021-05-14', 'ya', '1101', 1),
(19, '2021-05-14', 'ya', '1109', 1),
(20, '2021-05-14', 'ya', '1118', 1),
(21, '2021-05-14', 'ya', '1116', 1),
(22, '2021-05-14', 'ya', '1107', 1),
(23, '2021-05-14', 'ya', '1110', 1),
(24, '2021-05-14', 'ya', '1110', 1),
(25, '2021-05-14', 'ya', '1121', 1),
(26, '2021-05-14', 'ya', '1119', 1),
(27, '2021-05-14', 'ya', '1104', 1),
(28, '2021-05-14', 'ya', '1122', 1),
(29, '2021-05-28', 'ya', '1103', 1),
(30, '2021-05-28', 'ya', '1100', 1),
(31, '2021-05-28', 'ya', '1106', 1),
(32, '2021-05-28', 'ya', '1112', 1),
(33, '2021-05-28', 'ya', '1101', 1),
(34, '2021-05-28', 'ya', '1109', 1),
(35, '2021-05-28', 'ya', '1118', 1),
(36, '2021-05-28', 'ya', '1116', 1),
(37, '2021-05-28', 'ya', '1107', 1),
(38, '2021-05-28', 'ya', '1110', 1),
(39, '2021-05-28', 'ya', '1110', 1),
(40, '2021-05-28', 'ya', '1121', 1),
(41, '2021-05-28', 'ya', '1113', 1),
(42, '2021-05-28', 'ya', '1119', 1),
(43, '2021-05-28', 'ya', '1104', 1),
(44, '2021-05-28', 'ya', '1122', 1),
(45, '2021-06-04', 'ya', '1103', 1),
(46, '2021-06-04', 'ya', '1100', 1),
(47, '2021-06-04', 'ya', '1106', 1),
(48, '2021-06-04', 'ya', '1112', 1),
(49, '2021-06-04', 'ya', '1115', 1),
(50, '2021-06-04', 'ya', '1101', 1),
(51, '2021-06-04', 'ya', '1109', 1),
(52, '2021-06-04', 'ya', '1118', 1),
(53, '2021-06-04', 'ya', '1116', 1),
(54, '2021-06-04', 'ya', '1107', 1),
(55, '2021-06-04', 'ya', '1110', 1),
(56, '2021-06-04', 'ya', '1110', 1),
(57, '2021-06-04', 'ya', '1121', 1),
(58, '2021-06-04', 'ya', '1113', 1),
(59, '2021-06-04', 'ya', '1119', 1),
(60, '2021-06-04', 'ya', '1104', 1),
(61, '2021-06-04', 'ya', '1122', 1),
(62, '2021-06-11', 'ya', '1103', 1),
(63, '2021-06-11', 'ya', '1100', 1),
(64, '2021-06-11', 'ya', '1106', 1),
(65, '2021-06-11', 'ya', '1112', 1),
(66, '2021-06-11', 'ya', '1115', 1),
(67, '2021-06-11', 'ya', '1101', 1),
(68, '2021-06-11', 'ya', '1109', 1),
(69, '2021-06-11', 'ya', '1118', 1),
(70, '2021-06-11', 'ya', '1116', 1),
(71, '2021-06-11', 'ya', '1107', 1),
(72, '2021-06-11', 'ya', '1110', 1),
(73, '2021-06-11', 'ya', '1110', 1),
(74, '2021-06-11', 'ya', '1121', 1),
(75, '2021-06-11', 'ya', '1113', 1),
(76, '2021-06-11', 'ya', '1119', 1),
(77, '2021-06-11', 'ya', '1104', 1),
(78, '2021-06-11', 'ya', '1122', 1);

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
('1100', 'ANANDA PUTRI', 'XI MIA', '082178891282'),
('1101', 'BELLA', 'XI MIA', '081298369211'),
('1102', 'KIKI', 'XI MIA', '082178763281'),
('1103', 'ADVENTURA PRISKA SAPUTRI', 'XI IIS 1', '082382739818'),
('1104', 'RATNIKO', 'XI IIS 1', '089823872992'),
('1105', 'UTIN HENI', 'XI IIS 1', '082837839122'),
('1106', 'ANJELA LUSIA', 'XI IIS 2', '082937218331'),
('1107', 'GUGUN MARTINUS', 'XI IIS 2', '08222837912'),
('1108', 'TOYIP', 'XI IIS 2', '082382983791'),
('1109', 'BOBI', 'XI IIS 3', '082387123718'),
('1110', 'KRISTINA WULAN', 'XI IIS 3', '083283872643'),
('1111', 'YUNI SISILIA', 'XI IIS 3', '083764634834'),
('1112', 'AYU KURNIA', 'X MIA', '084334823987'),
('1113', 'NAINA', 'X MIA', '081343862844'),
('1114', 'RIKO FIRMANSYAH', 'X MIA', '083847329472'),
('1115', 'AZWANTO', 'X IIS 1', '084384792379'),
('1116', 'DITA SARI', 'X IIS 1', '089237482373'),
('1117', 'RANGGA', 'X IIS 1', '083427842743'),
('1118', 'DEBI', 'X IIS 2', '084368342312'),
('1119', 'RAHMA', 'X IIS 2', '082382764238'),
('1120', 'SYAMSUL', 'X IIS 2', '089383278211'),
('1121', 'MIKI RIO', 'X IIS 3', '083094923804'),
('1122', 'SURIYADI', 'X IIS 3', '084938473984'),
('1123', 'WASAT', 'X IIS 3', '082832163817');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
