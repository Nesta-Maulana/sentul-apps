-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2019 at 07:28 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utility_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id` int(11) NOT NULL,
  `workcenter_id` int(11) DEFAULT NULL,
  `bagian` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `satuan_id` int(11) NOT NULL,
  `spek_min` double NOT NULL,
  `spek_max` double NOT NULL,
  `kategori_pencatatan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id`, `workcenter_id`, `bagian`, `status`, `satuan_id`, `spek_min`, `spek_max`, `kategori_pencatatan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Deepwell 1 ESDM', '1', 1, 0, 0, 0, '2019-03-12 18:22:43', '2019-03-12 18:22:43'),
(2, 1, 'Deepwell 2 ESDM', '1', 1, 0, 0, 0, '2019-03-12 18:23:06', '2019-03-12 18:23:06'),
(3, 1, 'Deepwell 3 ESDM', '1', 1, 0, 0, 0, '2019-03-12 18:24:16', '2019-03-12 18:24:16'),
(4, 1, 'Deepwell 4 ESDM', '1', 1, 0, 0, 0, '2019-03-12 18:24:32', '2019-03-12 18:24:32'),
(5, 2, 'Input Rain water', '1', 1, 0, 0, 0, '2019-03-12 18:25:03', '2019-03-12 18:25:03'),
(6, 2, 'Input Raw water', '1', 1, 0, 0, 0, '2019-03-12 18:25:29', '2019-03-12 18:25:29'),
(7, 2, 'Input Process Demin', '1', 1, 0, 0, 0, '2019-03-12 18:25:52', '2019-03-12 18:25:52'),
(8, 2, 'Input Process Soft', '1', 1, 0, 0, 0, '2019-03-12 18:26:09', '2019-03-12 18:26:09'),
(9, 2, 'WTP Regeneration Demin Kation', '1', 1, 0, 0, 0, '2019-03-12 18:26:27', '2019-03-12 18:26:27'),
(10, 2, 'WTP Regeneration Demin Anion', '1', 1, 0, 0, 0, '2019-03-12 18:26:44', '2019-03-12 18:26:44'),
(11, 2, 'WTP Regeneration Soft', '1', 1, 0, 0, 0, '2019-03-12 18:27:04', '2019-03-12 18:27:04'),
(12, 2, 'WTP Embung', '1', 1, 0, 0, 0, '2019-03-12 18:27:20', '2019-03-12 18:27:20'),
(13, 2, 'Input UF', '1', 1, 0, 0, 0, '2019-03-12 18:27:33', '2019-03-12 18:27:33'),
(14, 2, 'Permeate RO', '1', 1, 0, 0, 0, '2019-03-12 18:27:51', '2019-03-12 18:27:51'),
(15, 2, 'Project RO', '1', 1, 0, 0, 0, '2019-03-12 18:28:06', '2019-03-12 18:28:06'),
(16, 2, 'Limbah Recycle RO', '1', 1, 0, 0, 0, '2019-03-12 18:28:20', '2019-03-12 18:28:20'),
(17, 3, 'Demin Water', '1', 1, 0, 0, 0, '2019-03-12 18:28:40', '2019-03-12 18:28:40'),
(18, 3, 'Demin Water Boiler', '1', 1, 0, 0, 0, '2019-03-12 18:28:56', '2019-03-12 18:28:56'),
(19, 3, 'Demin Water Ruby', '1', 1, 0, 0, 0, '2019-03-12 18:29:09', '2019-03-12 18:29:09'),
(20, 3, 'Demin Water HB', '1', 1, 0, 0, 0, '2019-03-12 18:29:27', '2019-03-12 18:29:27'),
(21, 3, 'Soft Water (Production) - 3\"', '1', 1, 0, 0, 0, '2019-03-12 18:29:50', '2019-03-12 18:29:50'),
(22, 3, 'Soft Water (Production) - 4\"', '1', 1, 0, 0, 0, '2019-03-12 18:30:00', '2019-03-12 18:30:00'),
(23, 3, 'Soft Water Non-Produksi', '1', 1, 0, 0, 0, '2019-03-12 18:30:27', '2019-03-12 18:30:27'),
(24, 3, 'Soft Water Ruby', '1', 1, 0, 0, 0, '2019-03-12 18:30:44', '2019-03-12 18:30:44'),
(25, 3, 'Soft Water Gedung Depan', '1', 1, 0, 0, 0, '2019-03-12 18:31:13', '2019-03-12 18:31:13'),
(26, 3, 'Soft Water HB Produksi', '1', 1, 0, 0, 0, '2019-03-12 18:31:34', '2019-03-12 18:31:34'),
(27, 3, 'Soft Water HB', '1', 1, 0, 0, 0, '2019-03-12 18:31:51', '2019-03-12 18:31:51'),
(28, 3, 'Soft Water Lubrikasi', '1', 1, 0, 0, 0, '2019-03-12 18:32:08', '2019-03-12 18:32:08'),
(29, 3, 'Soft Water Cooling Tower', '1', 1, 0, 0, 0, '2019-03-12 18:32:33', '2019-03-12 18:32:33'),
(30, 3, 'Soft Water Kantin', '1', 1, 0, 0, 0, '2019-03-12 18:32:51', '2019-03-12 18:32:51'),
(31, 3, 'Service Water (all plant)', '1', 1, 0, 0, 0, '2019-03-12 18:33:13', '2019-03-12 18:33:13'),
(32, 4, 'IPAL HB Existing', '1', 1, 0, 0, 0, '2019-03-12 18:33:37', '2019-03-12 18:33:37'),
(33, 4, 'IPAL HB & Blowdown Boiler', '1', 1, 0, 0, 0, '2019-03-12 18:33:54', '2019-03-12 18:33:54'),
(34, 4, 'WWTP Input', '1', 1, 0, 0, 0, '2019-03-12 18:34:11', '2019-03-12 18:34:11'),
(35, 4, 'WWTP Output', '1', 1, 0, 0, 0, '2019-03-12 18:34:23', '2019-03-12 18:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Air', '2019-03-12 07:16:48', '2019-03-12 00:16:48'),
(2, 'Listrik', '2019-03-12 00:16:35', '2019-03-12 00:16:35'),
(3, 'Gas', '2019-03-12 00:16:40', '2019-03-12 00:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pencatatan`
--

CREATE TABLE `kategori_pencatatan` (
  `id` int(11) NOT NULL,
  `kategori_pencatatan` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pencatatan`
--

INSERT INTO `kategori_pencatatan` (`id`, `kategori_pencatatan`, `created_at`, `updated_at`) VALUES
(1, 'Perhari', '2019-03-14 04:48:56', '0000-00-00 00:00:00'),
(2, 'Pershift', '2019-03-14 04:48:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengamatan`
--

CREATE TABLE `pengamatan` (
  `id` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `nilai_meteran` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_update` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengamatan`
--

INSERT INTO `pengamatan` (`id`, `id_bagian`, `nilai_meteran`, `user_id`, `user_update`, `created_at`, `updated_at`) VALUES
(1, 1, 5.1234, 24, NULL, '2019-03-13 19:11:06', '2019-03-13 19:11:06'),
(5, 2, 5.12443, 24, NULL, '2019-03-13 20:54:55', '2019-03-13 20:54:55'),
(6, 17, 54.245, 24, NULL, '2019-03-13 21:17:43', '2019-03-13 21:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tgl_penggunaan` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rasio_detail`
--

CREATE TABLE `rasio_detail` (
  `id` int(11) NOT NULL,
  `rasio_head_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rasio_detail`
--

INSERT INTO `rasio_detail` (`id`, `rasio_head_id`, `company_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2019-03-12 19:28:04', '2019-03-12 19:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `rasio_head`
--

CREATE TABLE `rasio_head` (
  `id` int(11) NOT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rasio_head`
--

INSERT INTO `rasio_head` (`id`, `bagian_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, '1', '2019-03-12 19:27:54', '2019-03-12 19:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'm3', '1', '2019-03-13 01:09:06', '0000-00-00 00:00:00'),
(2, 'm2', '1', '2019-03-12 18:52:29', '2019-03-12 18:52:29'),
(3, 'm4', '1', '2019-03-13 02:11:10', '2019-03-12 19:11:10'),
(4, 'MWh', '1', '2019-03-13 21:52:23', '2019-03-13 21:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `workcenter`
--

CREATE TABLE `workcenter` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `workcenter` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workcenter`
--

INSERT INTO `workcenter` (`id`, `kategori_id`, `workcenter`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'FLOWMETER ESDM', '1', '2019-03-12 00:18:51', '2019-03-12 00:18:51'),
(2, 1, 'FLOWMETER WTP', '1', '2019-03-12 00:19:10', '2019-03-12 00:19:10'),
(3, 1, 'FLOWMETER TRANSFER', '1', '2019-03-12 00:19:21', '2019-03-12 00:19:21'),
(4, 1, 'FLOWMETER WASTE WATER', '1', '2019-03-12 00:19:36', '2019-03-12 00:19:36'),
(5, 2, 'Induk', '1', '2019-03-13 21:50:45', '2019-03-13 21:50:45'),
(6, 2, 'Produksi', '1', '2019-03-13 21:50:54', '2019-03-13 21:50:54'),
(7, 2, 'Support', '1', '2019-03-13 21:51:01', '2019-03-13 21:51:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_pencatatan`
--
ALTER TABLE `kategori_pencatatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengamatan`
--
ALTER TABLE `pengamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rasio_detail`
--
ALTER TABLE `rasio_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rasio_head`
--
ALTER TABLE `rasio_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workcenter`
--
ALTER TABLE `workcenter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_pencatatan`
--
ALTER TABLE `kategori_pencatatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengamatan`
--
ALTER TABLE `pengamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rasio_detail`
--
ALTER TABLE `rasio_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rasio_head`
--
ALTER TABLE `rasio_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workcenter`
--
ALTER TABLE `workcenter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
