-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2024 at 12:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kerja_lembur`
--

CREATE TABLE `laporan_kerja_lembur` (
  `id_lembur` int NOT NULL,
  `hari_tgl_laporan` date NOT NULL,
  `waktu` time NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_kerja_lembur`
--

INSERT INTO `laporan_kerja_lembur` (`id_lembur`, `hari_tgl_laporan`, `waktu`, `uraian_pekerjaan`, `keterangan`, `dosen`) VALUES
(101, '2024-10-02', '17:00:00', 'Menyiapkan Materi Kuliah', 'Belum Selesai', 'Budi Santoso S.T., M.Kom.'),
(102, '2024-10-21', '18:00:00', 'Menyusun Laporan Riset', 'Selesai', 'Rahmat Dian S.Kom., M.Sc.'),
(103, '2024-10-25', '17:30:00', 'Menyiapkan Materi Kuliah', 'Belum Selesai', 'Adzania Rizki S.T., M.Eng.'),
(104, '2024-10-30', '19:00:00', 'Mengerjakan Tugas Administratif', 'Selesai', 'Vena Amalia S.T., M.T.'),
(105, '2024-11-15', '16:30:00', 'Menyusun Laporan Riset', 'Belum Selesai', 'Ratna Sari S.Kom., M.Kom.'),
(106, '2024-10-18', '17:15:00', 'Menyiapkan Materi Kuliah', 'Belum Selesai', 'Putri Amalia S.T., M.Eng.');

-- --------------------------------------------------------

--
-- Table structure for table `penggantian_pengawasan_ujian`
--

CREATE TABLE `penggantian_pengawasan_ujian` (
  `id_pengganti` int NOT NULL,
  `nama_pengawas_diganti` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `hari_tgl_penggantian` datetime NOT NULL,
  `jam` time NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `nama_pengawas_pengganti` varchar(255) NOT NULL,
  `dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penggantian_pengawasan_ujian`
--

INSERT INTO `penggantian_pengawasan_ujian` (`id_pengganti`, `nama_pengawas_diganti`, `unit_kerja`, `hari_tgl_penggantian`, `jam`, `ruang`, `nama_pengawas_pengganti`, `dosen`) VALUES
(12348, 'Ahmad Setiawan', 'Fakultas Teknik', '2024-10-01 07:44:45', '07:30:00', 'A101', 'Vera Dupita', 'Bagus Setiawan S.Kom., M.Sc.'),
(12349, 'Keysha Meinava', 'Fakultas Ekonomi', '2024-10-18 07:50:13', '09:00:00', 'A103', 'Anida Zalfalia', 'Kartika Putri S.T., M.T.'),
(12350, 'Dewi Mona', 'Fakultas Pertanian', '2024-10-20 08:16:00', '08:16:00', 'A104', 'Adzania Rizky', 'Bagus Pratama S.T., M.Kom.'),
(12376, 'Gerin Nurul', 'Fakultas Teknik', '2024-10-22 19:03:58', '10:05:00', 'A105', 'Nur Afifah', 'Dika Putra S.Kom., M.Sc.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan_kerja_lembur`
--
ALTER TABLE `laporan_kerja_lembur`
  ADD PRIMARY KEY (`id_lembur`);

--
-- Indexes for table `penggantian_pengawasan_ujian`
--
ALTER TABLE `penggantian_pengawasan_ujian`
  ADD PRIMARY KEY (`id_pengganti`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan_kerja_lembur`
--
ALTER TABLE `laporan_kerja_lembur`
  MODIFY `id_lembur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
