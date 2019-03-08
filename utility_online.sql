-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2019 at 09:32 AM
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
  `satuan` int(11) NOT NULL,
  `spek_min` double NOT NULL,
  `spek_max` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id`, `workcenter_id`, `bagian`, `status`, `satuan`, `spek_min`, `spek_max`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bagian 1', '1', 1, 1, 1, '2019-03-08 03:18:21', '2019-03-07 20:17:55');

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
(1, 'Kategori 1 diUpdate', '2019-03-06 06:41:33', '2019-03-05 23:41:33'),
(2, 'Data Update 1', '2019-03-06 06:18:10', '2019-03-05 23:18:10'),
(3, 'Cek Kategori', '2019-03-05 00:59:28', '2019-03-05 00:59:28'),
(4, 'Data Update 2', '2019-03-06 06:18:22', '2019-03-05 23:18:22'),
(5, 'Update', '2019-03-05 23:10:56', '2019-03-05 23:10:56'),
(6, 'CEk Update', '2019-03-05 23:11:41', '2019-03-05 23:11:41'),
(7, 'Kategori 2', '2019-03-05 23:12:37', '2019-03-05 23:12:37'),
(8, 'Data di update', '2019-03-05 23:13:24', '2019-03-05 23:13:24'),
(9, 'Data Save 1', '2019-03-05 23:19:55', '2019-03-05 23:19:55'),
(10, 'Simpan', '2019-03-05 23:43:31', '2019-03-05 23:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `pengamatan`
--

CREATE TABLE `pengamatan` (
  `id` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `nilai_meteran` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_update` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rasio_detail`
--

CREATE TABLE `rasio_detail` (
  `id` int(11) DEFAULT NULL,
  `rasion_head_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rasio_head`
--

CREATE TABLE `rasio_head` (
  `id` int(11) NOT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'Workcenter 1', '1', '2019-03-08 02:36:18', '0000-00-00 00:00:00'),
(2, 2, 'Workcenter 2', '1', '2019-03-08 02:36:18', '0000-00-00 00:00:00'),
(3, 2, NULL, '1', '2019-03-08 00:07:59', '2019-03-08 00:07:59'),
(4, 2, 'asdkjf', '1', '2019-03-08 00:09:18', '2019-03-08 00:09:18');

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
-- Indexes for table `pengamatan`
--
ALTER TABLE `pengamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rasio_head`
--
ALTER TABLE `rasio_head`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengamatan`
--
ALTER TABLE `pengamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rasio_head`
--
ALTER TABLE `rasio_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workcenter`
--
ALTER TABLE `workcenter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
