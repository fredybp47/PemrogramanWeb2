-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 08:59 PM
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
-- Database: `dbberita`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblberita`
--

CREATE TABLE `tblberita` (
  `idBerita` int(11) NOT NULL,
  `judulBerita` varchar(255) NOT NULL,
  `isiBerita` text NOT NULL,
  `penulis` varchar(150) NOT NULL,
  `tgldipublish` datetime NOT NULL,
  `idKategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblberita`
--

INSERT INTO `tblberita` (`idBerita`, `judulBerita`, `isiBerita`, `penulis`, `tgldipublish`, `idKategori`) VALUES
(2, 'Ojol', 'Ojol tak sadar memasuki jaan tol setelah 10km berjalan.. parah memang', 'fred', '2024-05-17 00:00:00', 1),
(3, 'Angin gratis', 'Seorang pria berhasil menemukan teknologi angin gratis setelah dia meniup debu yang menempel di tangan nya', 'dodo', '2024-05-18 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblkategori`
--

CREATE TABLE `tblkategori` (
  `idKategori` int(11) NOT NULL,
  `namaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblkategori`
--

INSERT INTO `tblkategori` (`idKategori`, `namaKategori`) VALUES
(1, 'Sosial'),
(2, 'Budaya'),
(3, 'Teknologi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblberita`
--
ALTER TABLE `tblberita`
  ADD PRIMARY KEY (`idBerita`),
  ADD KEY `idKategori` (`idKategori`);

--
-- Indexes for table `tblkategori`
--
ALTER TABLE `tblkategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblberita`
--
ALTER TABLE `tblberita`
  MODIFY `idBerita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblkategori`
--
ALTER TABLE `tblkategori`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblberita`
--
ALTER TABLE `tblberita`
  ADD CONSTRAINT `tblberita_ibfk_1` FOREIGN KEY (`idKategori`) REFERENCES `tblkategori` (`idKategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
