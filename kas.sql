-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 03:03 AM
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
-- Database: `kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Akses` text NOT NULL DEFAULT 'User',
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`Username`, `Email`, `Password`, `Akses`, `ID`) VALUES
('Jason4931', 'emmanuel.jason2008@gmail.com', '4931', 'Supervisor', 2),
('Adinda', 'massiketayogurt@gmail.com', 'Adinda112', 'Supervisor', 3),
('User', 'user@gmail.com', '4931', 'User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `Nama` text NOT NULL,
  `Keterangan` text NOT NULL,
  `Accept` text NOT NULL DEFAULT 'False',
  `Uang` int(11) NOT NULL,
  `Kembalian` int(11) NOT NULL DEFAULT 0,
  `Tujuan` text NOT NULL,
  `Jam` time NOT NULL,
  `Hari` date NOT NULL,
  `Tglkembalian` date NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`Nama`, `Keterangan`, `Accept`, `Uang`, `Kembalian`, `Tujuan`, `Jam`, `Hari`, `Tglkembalian`, `ID`) VALUES
('Abed', 'Pinjam', 'True', 200000, 0, 'konsumsi', '14:53:40', '2024-01-04', '0000-00-00', 4),
('User', 'Hutang', 'True', 100000, 15000, 'beli makanan', '08:24:14', '2024-01-05', '0000-00-00', 5),
('User', 'Hutang', 'True', 5000, 0, 'Tes', '09:18:55', '2024-01-05', '0000-00-00', 8),
('Abed', 'Hutang', 'True', 12000, 0, 'beli minum', '09:40:12', '2024-01-05', '0000-00-00', 9),
('User', 'Pinjam', 'False', 20000, 0, 'nonton', '14:07:57', '2024-01-05', '0000-00-00', 12),
('', 'Kas', 'True', 56000, 0, '', '08:05:53', '2024-01-17', '0000-00-00', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
