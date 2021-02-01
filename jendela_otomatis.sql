-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2021 at 10:39 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jendela_otomatis`
--

-- --------------------------------------------------------

--
-- Table structure for table `atur_kelembaban`
--

CREATE TABLE `atur_kelembaban` (
  `id_kelembaban` int(11) NOT NULL,
  `kelembaban` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atur_kelembaban`
--

INSERT INTO `atur_kelembaban` (`id_kelembaban`, `kelembaban`) VALUES
(1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `atur_suhu`
--

CREATE TABLE `atur_suhu` (
  `id_suhu` int(11) NOT NULL,
  `suhu` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atur_suhu`
--

INSERT INTO `atur_suhu` (`id_suhu`, `suhu`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `data_sensor`
--

CREATE TABLE `data_sensor` (
  `id` int(11) NOT NULL,
  `waktu` time NOT NULL,
  `tanggal` date NOT NULL,
  `kecepatanangin` int(3) NOT NULL,
  `statushujan` int(1) NOT NULL,
  `suhu` int(3) NOT NULL,
  `kelembaban` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_sensor`
--

INSERT INTO `data_sensor` (`id`, `waktu`, `tanggal`, `kecepatanangin`, `statushujan`, `suhu`, `kelembaban`) VALUES
(1, '12:00:00', '2021-01-26', 69, 0, 32, 60);

-- --------------------------------------------------------

--
-- Table structure for table `operasi`
--

CREATE TABLE `operasi` (
  `id` smallint(1) NOT NULL,
  `status` smallint(1) NOT NULL COMMENT '0 = manual, 1 = auto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operasi`
--

INSERT INTO `operasi` (`id`, `status`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_jendela`
--

CREATE TABLE `status_jendela` (
  `id` smallint(6) NOT NULL,
  `status` smallint(6) NOT NULL COMMENT '0 = tertutup, 1 = terbuka'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_jendela`
--

INSERT INTO `status_jendela` (`id`, `status`) VALUES
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atur_kelembaban`
--
ALTER TABLE `atur_kelembaban`
  ADD PRIMARY KEY (`id_kelembaban`);

--
-- Indexes for table `atur_suhu`
--
ALTER TABLE `atur_suhu`
  ADD PRIMARY KEY (`id_suhu`);

--
-- Indexes for table `data_sensor`
--
ALTER TABLE `data_sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operasi`
--
ALTER TABLE `operasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_jendela`
--
ALTER TABLE `status_jendela`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atur_kelembaban`
--
ALTER TABLE `atur_kelembaban`
  MODIFY `id_kelembaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `atur_suhu`
--
ALTER TABLE `atur_suhu`
  MODIFY `id_suhu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_sensor`
--
ALTER TABLE `data_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_jendela`
--
ALTER TABLE `status_jendela`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
