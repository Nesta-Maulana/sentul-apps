-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2019 pada 08.17
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

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
-- Struktur dari tabel `bagian`
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
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`id`, `workcenter_id`, `bagian`, `status`, `satuan_id`, `spek_min`, `spek_max`, `kategori_pencatatan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Deepwell 1 ESDM', '1', 1, 0, 0, 1, '2019-03-14 08:12:42', '2019-03-14 01:12:42'),
(2, 1, 'Deepwell 2 ESDM', '1', 1, 0, 0, 1, '2019-03-14 06:39:44', '2019-03-12 18:23:06'),
(3, 1, 'Deepwell 3 ESDM', '1', 1, 0, 0, 1, '2019-03-14 06:39:47', '2019-03-12 18:24:16'),
(4, 1, 'Deepwell 4 ESDM', '1', 1, 0, 0, 1, '2019-03-14 06:39:53', '2019-03-12 18:24:32'),
(5, 2, 'Input Rain water', '1', 1, 0, 0, 1, '2019-03-14 06:40:04', '2019-03-12 18:25:03'),
(6, 2, 'Input Raw water', '1', 1, 0, 0, 1, '2019-03-14 06:39:59', '2019-03-12 18:25:29'),
(7, 2, 'Input Process Demin', '1', 1, 0, 0, 1, '2019-03-14 06:40:07', '2019-03-12 18:25:52'),
(8, 2, 'Input Process Soft', '1', 1, 0, 0, 1, '2019-03-14 06:40:11', '2019-03-12 18:26:09'),
(9, 2, 'WTP Regeneration Demin Kation', '1', 1, 0, 0, 1, '2019-03-14 06:40:20', '2019-03-12 18:26:27'),
(10, 2, 'WTP Regeneration Demin Anion', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:26:44'),
(11, 2, 'WTP Regeneration Soft', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:27:04'),
(12, 2, 'WTP Embung', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:27:20'),
(13, 2, 'Input UF', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:27:33'),
(14, 2, 'Permeate RO', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:27:51'),
(15, 2, 'Project RO', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:28:06'),
(16, 2, 'Limbah Recycle RO', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:28:20'),
(17, 3, 'Demin Water', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:28:40'),
(18, 3, 'Demin Water Boiler', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:28:56'),
(19, 3, 'Demin Water Ruby', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:29:09'),
(20, 3, 'Demin Water HB', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:29:27'),
(21, 3, 'Soft Water (Production) - 3\"', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:29:50'),
(22, 3, 'Soft Water (Production) - 4\"', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:30:00'),
(23, 3, 'Soft Water Non-Produksi', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:30:27'),
(24, 3, 'Soft Water Ruby', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:30:44'),
(25, 3, 'Soft Water Gedung Depan', '1', 1, 0, 0, 1, '2019-03-14 06:40:25', '2019-03-12 18:31:13'),
(26, 3, 'Soft Water HB Produksi', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:31:34'),
(27, 3, 'Soft Water HB', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:31:51'),
(28, 3, 'Soft Water Lubrikasi', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:32:08'),
(29, 3, 'Soft Water Cooling Tower', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:32:33'),
(30, 3, 'Soft Water Kantin', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:32:51'),
(31, 3, 'Service Water (all plant)', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:33:13'),
(32, 4, 'IPAL HB Existing', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:33:37'),
(33, 4, 'IPAL HB & Blowdown Boiler', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:33:54'),
(34, 4, 'WWTP Input', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:34:11'),
(35, 4, 'WWTP Output', '1', 1, 0, 0, 1, '2019-03-14 06:41:15', '2019-03-12 18:34:23'),
(37, 6, 'Plant UPS', '1', 4, 0, 0, 1, '2019-03-14 01:41:38', '2019-03-14 01:41:38'),
(38, 6, 'Plant Produksi', '1', 4, 0, 0, 1, '2019-03-14 01:42:09', '2019-03-14 01:42:09'),
(39, 6, 'NFI LAB', '1', 4, 0, 0, 1, '2019-03-14 01:42:27', '2019-03-14 01:42:27'),
(40, 6, 'HNI PROCESSING', '1', 4, 0, 0, 1, '2019-03-14 01:42:47', '2019-03-14 01:42:47'),
(41, 6, 'HNI FILLPACK(RUBY)', '1', 4, 0, 0, 1, '2019-03-14 01:43:12', '2019-03-14 01:43:12'),
(42, 6, 'HNI EXIST - Office & RD', '1', 4, 0, 0, 1, '2019-03-14 01:43:34', '2019-03-14 01:43:34'),
(43, 6, 'HNI PRODUKSI (GREEK)', '1', 4, 0, 0, 1, '2019-03-14 01:44:25', '2019-03-14 01:44:25'),
(44, 5, 'PLANT WTP & WWTP', '1', 4, 0, 0, 1, '2019-03-15 03:10:12', '2019-03-14 20:10:12'),
(45, 7, 'PLANT DEEPWELL', '1', 4, 0, 0, 1, '2019-03-14 01:45:42', '2019-03-14 01:45:42'),
(46, 7, 'PLANT FIRE HYDRANT', '1', 4, 0, 0, 1, '2019-03-14 01:46:05', '2019-03-14 01:46:05'),
(47, 7, 'PLANT WWTP2', '1', 4, 0, 0, 1, '2019-03-14 01:46:24', '2019-03-14 01:46:24'),
(48, 7, 'RC-NFI', '1', 4, 0, 0, 1, '2019-03-14 01:46:42', '2019-03-14 01:46:42'),
(49, 7, 'RC-HNI', '1', 4, 0, 0, 1, '2019-03-14 01:46:57', '2019-03-14 01:46:57'),
(50, 7, 'PLANT UTILITY', '1', 4, 0, 0, 1, '2019-03-14 01:47:14', '2019-03-14 01:47:14'),
(51, 7, 'PLANT BOILER', '1', 4, 0, 0, 1, '2019-03-14 01:47:30', '2019-03-14 01:47:30'),
(52, 7, 'PLANT CHILLER A', '1', 4, 0, 0, 1, '2019-03-14 01:47:48', '2019-03-14 01:47:48'),
(53, 7, 'PLANT CHILLER B', '1', 4, 0, 0, 1, '2019-03-14 01:48:05', '2019-03-14 01:48:05'),
(54, 7, 'PLANT COMPRESSOR', '1', 4, 0, 0, 1, '2019-03-14 01:48:29', '2019-03-14 01:48:29'),
(55, 7, 'PLANT AC', '1', 4, 0, 0, 1, '2019-03-14 01:48:48', '2019-03-14 01:48:48'),
(56, 6, 'HNI AC GUDANG', '1', 4, 0, 0, 1, '2019-03-14 01:49:09', '2019-03-14 01:49:09'),
(57, 7, 'Bakery', '1', 4, 0, 0, 1, '2019-03-14 01:49:35', '2019-03-14 01:49:35'),
(58, 6, 'PLANT LAMPU & POWER', '1', 4, 0, 0, 1, '2019-03-14 01:53:46', '2019-03-14 01:53:46'),
(59, 5, 'PLANT PLN(Power Factor)', '1', 5, 0, 0, 2, '2019-03-14 08:55:31', '2019-03-14 01:55:31'),
(60, 5, 'PLANT PLN(THD)', '1', 6, 0, 0, 2, '2019-03-14 01:55:53', '2019-03-14 01:55:53'),
(61, 5, 'PLANT PLN', '1', 4, 0, 0, 1, '2019-03-14 20:11:00', '2019-03-14 20:11:00'),
(62, 5, 'PLANT GENSET', '1', 4, 0, 0, 1, '2019-03-14 20:11:15', '2019-03-14 20:11:15'),
(63, 8, 'Aplikasi', '1', 7, 0, 0, 2, '2019-03-14 23:09:44', '2019-03-14 23:09:44'),
(64, 9, 'Boiler 10 T', '1', 7, 0, 0, 2, '2019-03-14 23:16:21', '2019-03-14 23:16:21'),
(65, 10, 'Header (NFI)', '1', 7, 0, 0, 2, '2019-03-14 23:16:51', '2019-03-14 23:16:51'),
(66, 10, 'Ruby', '1', 7, 0, 0, 2, '2019-03-14 23:17:10', '2019-03-14 23:17:10'),
(67, 10, 'Retort', '1', 7, 0, 0, 2, '2019-03-14 23:17:29', '2019-03-14 23:17:29'),
(68, 10, 'HB Greek', '1', 9, 0, 0, 2, '2019-03-14 23:17:55', '2019-03-14 23:17:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Air', '1', '2019-04-16 02:55:57', '2019-03-12 00:16:48'),
(2, 'Listrik', '1', '2019-04-16 02:56:00', '2019-03-12 00:16:35'),
(3, 'Gas', '1', '2019-04-16 02:56:04', '2019-03-12 00:16:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pencatatan`
--

CREATE TABLE `kategori_pencatatan` (
  `id` int(11) NOT NULL,
  `kategori_pencatatan` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_pencatatan`
--

INSERT INTO `kategori_pencatatan` (`id`, `kategori_pencatatan`, `created_at`, `updated_at`) VALUES
(1, 'Perhari', '2019-03-14 04:48:56', '0000-00-00 00:00:00'),
(2, 'Pershift', '2019-03-14 04:48:56', '0000-00-00 00:00:00'),
(3, 'Perjam', '2019-03-15 07:39:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengamatan`
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
-- Dumping data untuk tabel `pengamatan`
--

INSERT INTO `pengamatan` (`id`, `id_bagian`, `nilai_meteran`, `user_id`, `user_update`, `created_at`, `updated_at`) VALUES
(1, 63, 5.23, 24, NULL, '2019-03-27 17:24:30', '2019-03-27 10:24:30'),
(2, 64, 5.1234, 24, NULL, '2019-03-27 10:27:56', '2019-03-27 10:27:56'),
(3, 59, 5.123, 24, NULL, '2019-03-27 10:28:49', '2019-03-27 10:28:49'),
(4, 63, 5.12, 24, NULL, '2019-03-28 00:34:10', '2019-03-28 00:34:10'),
(5, 64, 51.234, 24, NULL, '2019-03-28 00:37:12', '2019-03-28 00:37:12'),
(6, 37, 5.2345, 24, NULL, '2019-03-28 00:37:53', '2019-03-28 00:37:53'),
(7, 40, 51.324, 24, NULL, '2019-03-28 00:39:31', '2019-03-28 00:39:31'),
(8, 38, 5.234, 24, NULL, '2019-03-28 00:48:50', '2019-03-28 00:48:50'),
(9, 39, 52.34, 24, NULL, '2019-03-28 00:49:56', '2019-03-28 00:49:56'),
(10, 41, 1212, 24, NULL, '2019-03-28 00:50:59', '2019-03-28 00:50:59'),
(11, 42, 1299, 24, NULL, '2019-03-28 00:52:29', '2019-03-28 00:52:29'),
(12, 45, 54.24, 24, NULL, '2019-03-28 07:54:38', '2019-03-28 07:54:38'),
(13, 44, 123, 24, NULL, '2019-04-08 03:37:33', '2019-04-08 03:37:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `tgl_penggunaan` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`id`, `id_bagian`, `nilai`, `tgl_penggunaan`, `created_at`, `updated_at`) VALUES
(1, 1, 23091.02, '2019-03-25', '2019-03-26 01:46:27', '2019-03-26 01:46:27'),
(2, 3, 3.23, '2019-03-25', '2019-03-26 01:47:59', '2019-03-26 01:47:59'),
(3, 17, 5.134, '2019-03-26', '2019-03-27 02:06:34', '2019-03-27 02:06:34'),
(4, 1, -20.134, '2019-03-27', '2019-03-27 10:13:25', '2019-03-27 10:13:25'),
(5, 63, 0.11000000000000032, '2019-03-27', '2019-03-28 00:34:10', '2019-03-28 00:34:10'),
(6, 64, -46.110600000000005, '2019-03-27', '2019-03-28 00:37:12', '2019-03-28 00:37:12'),
(7, 37, 5.2345, '2019-03-27', '2019-03-28 00:37:53', '2019-03-28 00:37:53'),
(8, 40, 51.324, '2019-03-27', '2019-03-28 00:39:31', '2019-03-28 00:39:31'),
(9, 38, 5.234, '2019-03-27', '2019-03-28 00:48:50', '2019-03-28 00:48:50'),
(10, 39, 52.34, '2019-03-27', '2019-03-28 00:49:56', '2019-03-28 00:49:56'),
(11, 41, 1212, '2019-03-27', '2019-03-28 00:50:59', '2019-03-28 00:50:59'),
(12, 42, 1299, '2019-03-27', '2019-03-28 00:52:29', '2019-03-28 00:52:29'),
(13, 45, 54.24, '2019-03-27', '2019-03-28 07:54:38', '2019-03-28 07:54:38'),
(14, 44, 123, '2019-04-07', '2019-04-08 03:37:33', '2019-04-08 03:37:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rasio_detail`
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
-- Dumping data untuk tabel `rasio_detail`
--

INSERT INTO `rasio_detail` (`id`, `rasio_head_id`, `company_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2019-03-12 19:28:04', '2019-03-12 19:28:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rasio_head`
--

CREATE TABLE `rasio_head` (
  `id` int(11) NOT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rasio_head`
--

INSERT INTO `rasio_head` (`id`, `bagian_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, '1', '2019-03-12 19:27:54', '2019-03-12 19:27:54'),
(2, 39, '1', '2019-04-01 01:12:20', '2019-04-01 01:12:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'm3', '1', '2019-03-13 01:09:06', '0000-00-00 00:00:00'),
(2, 'm2', '1', '2019-03-12 18:52:29', '2019-03-12 18:52:29'),
(3, 'm4', '1', '2019-03-13 02:11:10', '2019-03-12 19:11:10'),
(4, 'MWh', '1', '2019-03-13 21:52:23', '2019-03-13 21:52:23'),
(5, 'lag', '1', '2019-03-14 01:55:09', '2019-03-14 01:55:09'),
(6, '%', '1', '2019-03-14 01:55:14', '2019-03-14 01:55:14'),
(7, 'nm3', '1', '2019-03-14 23:09:08', '2019-03-14 23:09:08'),
(8, 'mmbtu', '1', '2019-03-14 23:09:15', '2019-03-14 23:09:15'),
(9, 'kg', '1', '2019-03-14 23:09:23', '2019-03-14 23:09:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `workcenter`
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
-- Dumping data untuk tabel `workcenter`
--

INSERT INTO `workcenter` (`id`, `kategori_id`, `workcenter`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'FLOWMETER ESDM', '1', '2019-03-12 00:18:51', '2019-03-12 00:18:51'),
(2, 1, 'FLOWMETER WTP', '1', '2019-03-12 00:19:10', '2019-03-12 00:19:10'),
(3, 1, 'FLOWMETER TRANSFER', '1', '2019-03-12 00:19:21', '2019-03-12 00:19:21'),
(4, 1, 'FLOWMETER WASTE WATER', '1', '2019-03-12 00:19:36', '2019-03-12 00:19:36'),
(5, 2, 'Induk', '1', '2019-03-13 21:50:45', '2019-03-13 21:50:45'),
(6, 2, 'Produksi', '1', '2019-03-13 21:50:54', '2019-03-13 21:50:54'),
(7, 2, 'Support', '1', '2019-03-13 21:51:01', '2019-03-13 21:51:01'),
(8, 3, 'GAS PGN', '1', '2019-03-14 23:07:00', '2019-03-14 23:07:00'),
(9, 3, 'Boiler', '1', '2019-03-14 23:07:12', '2019-03-14 23:07:12'),
(10, 3, 'Steam', '1', '2019-03-14 23:07:19', '2019-03-14 23:07:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_pencatatan`
--
ALTER TABLE `kategori_pencatatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengamatan`
--
ALTER TABLE `pengamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rasio_detail`
--
ALTER TABLE `rasio_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rasio_head`
--
ALTER TABLE `rasio_head`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `workcenter`
--
ALTER TABLE `workcenter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_pencatatan`
--
ALTER TABLE `kategori_pencatatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengamatan`
--
ALTER TABLE `pengamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `rasio_detail`
--
ALTER TABLE `rasio_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rasio_head`
--
ALTER TABLE `rasio_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `workcenter`
--
ALTER TABLE `workcenter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
