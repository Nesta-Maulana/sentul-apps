-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Apr 2019 pada 11.23
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
-- Database: `master_apps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agama`
--

CREATE TABLE `agama` (
  `id` int(11) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agama`
--

INSERT INTO `agama` (`id`, `agama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', '2019-03-29 02:15:47', '0000-00-00 00:00:00'),
(2, 'Kristen', '2019-03-29 02:15:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(11) NOT NULL,
  `aplikasi` varchar(50) DEFAULT NULL,
  `link` varchar(50) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `aplikasi`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Apps', 'master-apps', '1', '2019-04-01 04:25:56', '0000-00-00 00:00:00'),
(2, 'Utility Online', 'utility-online', '1', '2019-03-01 03:25:43', '0000-00-00 00:00:00'),
(3, 'Rollie', 'rollie', '1', '2019-04-22 03:09:18', '2019-04-22 03:09:18'),
(4, 'Vollie', 'vollie', '1', '2019-03-01 06:28:48', '0000-00-00 00:00:00'),
(10, 'Rollie - Penyelia', 'rollie-penyelia', '1', '2019-04-30 04:27:20', '2019-04-30 04:27:20'),
(11, 'Rollie - Operator Produksi', 'rollie-operator-produksi', '1', '2019-04-30 04:34:04', '2019-04-30 04:34:04'),
(12, 'Rollie - Inspektor QC', 'rollie-inspektor-qc', '1', '2019-04-30 04:07:16', '2019-04-30 04:07:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses_aplikasi`
--

CREATE TABLE `hak_akses_aplikasi` (
  `id` int(11) NOT NULL,
  `id_aplikasi` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hak_akses_aplikasi`
--

INSERT INTO `hak_akses_aplikasi` (`id`, `id_aplikasi`, `id_user`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 24, '1', '2019-04-16 08:45:45', '0000-00-00 00:00:00'),
(2, 2, 24, '1', '2019-04-16 08:45:45', '0000-00-00 00:00:00'),
(3, 3, 24, '1', '2019-04-16 08:45:45', '0000-00-00 00:00:00'),
(4, 4, 24, '1', '2019-04-16 09:00:08', '2019-04-16 09:00:08'),
(5, 2, 23, '0', '2019-04-16 08:57:32', '2019-04-16 08:57:32'),
(6, 3, 23, '1', '2019-04-16 08:58:52', '2019-04-16 08:58:52'),
(13, 10, 22, '0', '2019-04-22 02:24:49', '2019-04-22 02:24:49'),
(14, 10, 23, '0', '2019-04-22 02:24:49', '2019-04-22 02:24:49'),
(15, 10, 24, '1', '2019-04-22 02:27:02', '2019-04-22 02:27:02'),
(16, 11, 22, '0', '2019-04-29 07:19:08', '2019-04-29 07:19:08'),
(17, 11, 23, '0', '2019-04-29 07:19:08', '2019-04-29 07:19:08'),
(18, 11, 24, '1', '2019-04-30 00:43:09', '2019-04-30 00:43:09'),
(19, 12, 22, '0', '2019-04-30 02:51:53', '2019-04-30 02:51:53'),
(20, 12, 23, '0', '2019-04-30 02:51:53', '2019-04-30 02:51:53'),
(21, 12, 24, '1', '2019-04-30 02:52:10', '2019-04-30 02:52:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses_menu`
--

CREATE TABLE `hak_akses_menu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `tambah` enum('0','1') DEFAULT NULL,
  `lihat` enum('0','1') DEFAULT NULL,
  `ubah` enum('0','1') DEFAULT NULL,
  `hapus` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hak_akses_menu`
--

INSERT INTO `hak_akses_menu` (`id`, `user_id`, `menu_id`, `tambah`, `lihat`, `ubah`, `hapus`, `created_at`, `updated_at`) VALUES
(1, 24, 1, '0', '1', '0', '0', '2019-02-15 00:46:56', '2019-02-18 21:10:48'),
(2, 24, 2, '1', '1', '1', '1', '2019-02-15 00:46:56', '2019-04-16 02:25:40'),
(3, 24, 5, '1', '1', '1', '1', '2019-02-15 00:47:40', '2019-04-16 02:25:38'),
(4, 24, 7, '0', '1', '0', '0', '2019-02-15 00:47:40', '2019-02-18 20:57:31'),
(5, 24, 4, '1', '1', '1', '1', '2019-02-15 02:40:47', '2019-04-16 02:21:53'),
(6, 24, 14, '1', '1', '1', '1', '2019-02-15 02:40:47', '2019-04-16 03:08:44'),
(8, 24, 15, '1', '1', '1', '1', '2019-02-18 03:16:49', '2019-04-16 02:24:39'),
(9, 24, 6, '0', '0', '1', '1', '2019-02-19 07:21:18', '2019-04-16 03:08:53'),
(10, 24, 16, '1', '1', '1', '1', '2019-02-20 07:38:38', '2019-04-16 02:25:44'),
(11, 22, 22, '0', '0', '0', '0', '2019-03-04 18:58:04', '2019-03-04 18:58:04'),
(12, 23, 22, '0', '0', '0', '0', '2019-03-04 18:58:04', '2019-03-04 18:58:04'),
(13, 24, 22, '0', '0', '0', '0', '2019-03-04 18:58:04', '2019-03-04 18:58:04'),
(14, 22, 23, '0', '0', '0', '0', '2019-03-05 02:26:58', '2019-03-05 02:26:58'),
(15, 23, 23, '0', '0', '0', '0', '2019-03-05 02:26:58', '2019-03-05 02:26:58'),
(16, 24, 23, '1', '1', '1', '0', '2019-03-05 02:26:58', '2019-03-05 02:26:58'),
(17, 22, 24, '0', '1', '1', '0', '2019-03-10 19:23:19', '2019-03-10 19:24:17'),
(18, 23, 24, '0', '1', '1', '0', '2019-03-10 19:23:19', '2019-03-10 19:24:17'),
(19, 24, 24, '1', '1', '1', '0', '2019-03-10 19:23:19', '2019-03-12 00:17:16'),
(20, 22, 25, '1', '1', '1', '0', '2019-03-10 19:38:33', '2019-03-10 19:38:33'),
(21, 23, 25, '1', '1', '1', '0', '2019-03-10 19:38:33', '2019-03-10 19:38:33'),
(22, 24, 25, '1', '1', '1', '1', '2019-03-10 19:38:33', '2019-04-22 01:26:08'),
(23, 22, 26, '1', '1', '0', '0', '2019-03-10 19:47:48', '2019-03-10 19:48:14'),
(24, 23, 26, '1', '1', '0', '0', '2019-03-10 19:47:48', '2019-03-10 19:48:14'),
(25, 24, 26, '1', '1', '1', '1', '2019-03-10 19:47:48', '2019-04-16 03:02:13'),
(26, 22, 27, '0', '0', '0', '0', '2019-03-12 19:17:02', '2019-03-12 19:17:02'),
(27, 23, 27, '0', '0', '0', '0', '2019-03-12 19:17:02', '2019-03-12 19:17:02'),
(28, 24, 27, '1', '1', '1', '0', '2019-03-12 19:17:02', '2019-03-13 21:52:00'),
(29, 22, 28, '0', '0', '0', '0', '2019-03-12 19:22:02', '2019-03-12 19:22:02'),
(30, 23, 28, '0', '0', '0', '0', '2019-03-12 19:22:02', '2019-03-12 19:22:02'),
(31, 24, 28, '0', '1', '0', '0', '2019-03-12 19:22:02', '2019-03-12 19:22:15'),
(32, 22, 29, '0', '0', '0', '0', '2019-03-29 09:02:33', '2019-03-29 09:02:33'),
(33, 23, 29, '0', '0', '0', '0', '2019-03-29 09:02:34', '2019-03-29 09:02:34'),
(34, 24, 29, '1', '1', '1', '1', '2019-03-29 09:02:34', '2019-04-16 02:25:48'),
(35, 22, 30, '0', '0', '0', '0', '2019-04-01 08:48:19', '2019-04-01 08:48:19'),
(36, 23, 30, '0', '0', '0', '0', '2019-04-01 08:48:19', '2019-04-01 08:48:19'),
(37, 24, 30, '1', '1', '1', '1', '2019-04-01 08:48:19', '2019-04-16 02:25:49'),
(38, 22, 31, '0', '0', '0', '0', '2019-04-01 09:03:31', '2019-04-01 09:03:31'),
(39, 23, 31, '0', '0', '0', '0', '2019-04-01 09:03:31', '2019-04-01 09:03:31'),
(40, 24, 31, '1', '1', '1', '1', '2019-04-01 09:03:31', '2019-04-16 02:25:50'),
(41, 22, 32, '0', '0', '0', '0', '2019-04-02 00:41:12', '2019-04-02 00:41:12'),
(42, 23, 32, '0', '0', '0', '0', '2019-04-02 00:41:12', '2019-04-02 00:41:12'),
(43, 24, 32, '0', '1', '0', '0', '2019-04-02 00:41:12', '2019-04-02 00:42:54'),
(44, 22, 33, '0', '0', '0', '0', '2019-04-02 00:58:22', '2019-04-02 00:58:22'),
(45, 23, 33, '0', '0', '0', '0', '2019-04-02 00:58:22', '2019-04-02 00:58:22'),
(46, 24, 33, '1', '1', '1', '1', '2019-04-02 00:58:22', '2019-04-16 02:25:52'),
(47, 22, 34, '0', '0', '0', '0', '2019-04-02 00:58:55', '2019-04-02 00:58:55'),
(48, 23, 34, '0', '0', '0', '0', '2019-04-02 00:58:55', '2019-04-02 00:58:55'),
(49, 24, 34, '1', '1', '1', '1', '2019-04-02 00:58:55', '2019-04-16 02:25:53'),
(50, 22, 35, '0', '0', '0', '0', '2019-04-02 00:59:25', '2019-04-02 00:59:25'),
(51, 23, 35, '0', '0', '0', '0', '2019-04-02 00:59:25', '2019-04-02 00:59:25'),
(52, 24, 35, '1', '1', '1', '1', '2019-04-02 00:59:25', '2019-04-16 02:25:55'),
(53, 22, 36, '0', '0', '0', '0', '2019-04-04 01:51:45', '2019-04-04 01:51:45'),
(54, 23, 36, '0', '0', '0', '0', '2019-04-04 01:51:45', '2019-04-04 01:51:45'),
(55, 24, 36, '1', '1', '1', '1', '2019-04-04 01:51:45', '2019-04-16 02:25:58'),
(56, 22, 37, '0', '0', '0', '0', '2019-04-04 01:52:10', '2019-04-04 01:52:10'),
(57, 23, 37, '0', '0', '0', '0', '2019-04-04 01:52:10', '2019-04-04 01:52:10'),
(58, 24, 37, '1', '1', '1', '1', '2019-04-04 01:52:10', '2019-04-16 02:26:00'),
(59, 22, 38, '0', '0', '0', '0', '2019-04-04 01:52:30', '2019-04-04 01:52:30'),
(60, 23, 38, '0', '0', '0', '0', '2019-04-04 01:52:30', '2019-04-04 01:52:30'),
(61, 24, 38, '0', '1', '0', '0', '2019-04-04 01:52:31', '2019-04-04 01:53:40'),
(62, 22, 39, '0', '0', '0', '0', '2019-04-04 01:52:49', '2019-04-04 01:52:49'),
(63, 23, 39, '0', '0', '0', '0', '2019-04-04 01:52:49', '2019-04-04 01:52:49'),
(64, 24, 39, '0', '1', '0', '0', '2019-04-04 01:52:49', '2019-04-04 01:53:43'),
(65, 22, 40, '0', '0', '0', '0', '2019-04-04 02:56:50', '2019-04-04 02:56:50'),
(66, 23, 40, '0', '0', '0', '0', '2019-04-04 02:56:50', '2019-04-04 02:56:50'),
(67, 24, 40, '1', '1', '1', '1', '2019-04-04 02:56:50', '2019-04-16 02:26:01'),
(68, 22, 41, '0', '0', '0', '0', '2019-04-04 06:18:15', '2019-04-04 06:18:15'),
(69, 23, 41, '0', '0', '0', '0', '2019-04-04 06:18:15', '2019-04-04 06:18:15'),
(70, 24, 41, '1', '1', '1', '1', '2019-04-04 06:18:15', '2019-04-16 02:26:03'),
(71, 22, 42, '0', '0', '0', '0', '2019-04-15 08:13:06', '2019-04-15 08:13:06'),
(72, 23, 42, '0', '0', '0', '0', '2019-04-15 08:13:06', '2019-04-15 08:13:06'),
(73, 24, 42, '1', '1', '1', '1', '2019-04-15 08:13:06', '2019-04-16 02:25:56'),
(74, 22, 43, '0', '0', '0', '0', '2019-04-16 02:20:21', '2019-04-16 02:20:21'),
(75, 23, 43, '0', '0', '0', '0', '2019-04-16 02:20:21', '2019-04-16 02:20:21'),
(76, 24, 43, '1', '1', '1', '1', '2019-04-16 02:20:21', '2019-04-16 02:25:34'),
(77, 22, 44, '0', '0', '0', '0', '2019-04-16 02:38:31', '2019-04-16 02:38:31'),
(78, 23, 44, '0', '0', '0', '0', '2019-04-16 02:38:31', '2019-04-16 02:38:31'),
(79, 24, 44, '1', '1', '1', '1', '2019-04-16 02:38:31', '2019-04-16 03:03:52'),
(80, 22, 45, '0', '0', '0', '0', '2019-04-16 02:54:25', '2019-04-16 02:54:25'),
(81, 23, 45, '0', '0', '0', '0', '2019-04-16 02:54:25', '2019-04-16 02:54:25'),
(82, 24, 45, '1', '1', '1', '1', '2019-04-16 02:54:25', '2019-04-16 02:54:57'),
(83, 22, 46, '0', '0', '0', '0', '2019-04-22 02:23:39', '2019-04-22 02:23:39'),
(84, 23, 46, '0', '0', '0', '0', '2019-04-22 02:23:39', '2019-04-22 02:23:39'),
(85, 24, 46, '1', '1', '1', '1', '2019-04-22 02:23:39', '2019-04-22 02:24:11'),
(86, 22, 47, '0', '0', '0', '0', '2019-04-22 02:28:25', '2019-04-22 02:28:25'),
(87, 23, 47, '0', '0', '0', '0', '2019-04-22 02:28:25', '2019-04-22 02:28:25'),
(88, 24, 47, '1', '1', '1', '1', '2019-04-22 02:28:25', '2019-04-22 02:28:43'),
(89, 22, 48, '0', '0', '0', '0', '2019-04-22 02:31:31', '2019-04-22 02:31:31'),
(90, 23, 48, '0', '0', '0', '0', '2019-04-22 02:31:31', '2019-04-22 02:31:31'),
(91, 24, 48, '1', '1', '1', '1', '2019-04-22 02:31:31', '2019-04-22 02:31:52'),
(92, 22, 49, '0', '0', '0', '0', '2019-04-22 06:49:51', '2019-04-22 06:49:51'),
(93, 23, 49, '0', '0', '0', '0', '2019-04-22 06:49:51', '2019-04-22 06:49:51'),
(94, 24, 49, '1', '1', '1', '1', '2019-04-22 06:49:51', '2019-04-30 04:31:18'),
(95, 22, 50, '0', '0', '0', '0', '2019-04-24 02:09:01', '2019-04-24 02:09:01'),
(96, 23, 50, '0', '0', '0', '0', '2019-04-24 02:09:01', '2019-04-24 02:09:01'),
(97, 24, 50, '0', '0', '0', '0', '2019-04-24 02:09:01', '2019-04-24 02:09:01'),
(98, 22, 51, '0', '0', '0', '0', '2019-04-24 02:09:37', '2019-04-24 02:09:37'),
(99, 23, 51, '0', '0', '0', '0', '2019-04-24 02:09:37', '2019-04-24 02:09:37'),
(100, 24, 51, '0', '0', '0', '0', '2019-04-24 02:09:37', '2019-04-24 02:09:37'),
(101, 22, 52, '0', '0', '0', '0', '2019-04-24 02:10:03', '2019-04-24 02:10:03'),
(102, 23, 52, '0', '0', '0', '0', '2019-04-24 02:10:03', '2019-04-24 02:10:03'),
(103, 24, 52, '0', '0', '0', '0', '2019-04-24 02:10:03', '2019-04-24 02:10:03'),
(104, 22, 53, '0', '0', '0', '0', '2019-04-24 02:10:34', '2019-04-24 02:10:34'),
(105, 23, 53, '0', '0', '0', '0', '2019-04-24 02:10:34', '2019-04-24 02:10:34'),
(106, 24, 53, '0', '0', '0', '0', '2019-04-24 02:10:34', '2019-04-24 02:10:34'),
(107, 22, 54, '0', '0', '0', '0', '2019-04-24 02:11:02', '2019-04-24 02:11:02'),
(108, 23, 54, '0', '0', '0', '0', '2019-04-24 02:11:02', '2019-04-24 02:11:02'),
(109, 24, 54, '0', '0', '0', '0', '2019-04-24 02:11:02', '2019-04-24 02:11:02'),
(110, 22, 55, '0', '0', '0', '0', '2019-04-24 02:11:28', '2019-04-24 02:11:28'),
(111, 23, 55, '0', '0', '0', '0', '2019-04-24 02:11:28', '2019-04-24 02:11:28'),
(112, 24, 55, '0', '0', '0', '0', '2019-04-24 02:11:28', '2019-04-24 02:11:28'),
(113, 22, 56, '0', '0', '0', '0', '2019-04-24 02:12:37', '2019-04-24 02:12:37'),
(114, 23, 56, '0', '0', '0', '0', '2019-04-24 02:12:37', '2019-04-24 02:12:37'),
(115, 24, 56, '0', '0', '0', '0', '2019-04-24 02:12:37', '2019-04-24 02:12:37'),
(116, 22, 57, '0', '0', '0', '0', '2019-04-25 07:01:14', '2019-04-25 07:01:14'),
(117, 23, 57, '0', '0', '0', '0', '2019-04-25 07:01:14', '2019-04-25 07:01:14'),
(118, 24, 57, '1', '1', '1', '1', '2019-04-25 07:01:14', '2019-04-25 07:01:33'),
(119, 22, 58, '0', '0', '0', '0', '2019-04-29 07:33:26', '2019-04-29 07:33:26'),
(120, 23, 58, '0', '0', '0', '0', '2019-04-29 07:33:27', '2019-04-29 07:33:27'),
(121, 24, 58, '1', '1', '1', '1', '2019-04-29 07:33:27', '2019-04-29 07:37:26'),
(122, 22, 59, '0', '0', '0', '0', '2019-04-30 02:55:08', '2019-04-30 02:55:08'),
(123, 23, 59, '0', '0', '0', '0', '2019-04-30 02:55:09', '2019-04-30 02:55:09'),
(124, 24, 59, '1', '1', '1', '1', '2019-04-30 02:55:09', '2019-04-30 04:58:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `icons`
--

CREATE TABLE `icons` (
  `id` int(11) NOT NULL,
  `icons` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `icons`
--

INSERT INTO `icons` (`id`, `icons`) VALUES
(1, 'fa-500px'),
(2, 'fa-address-book'),
(3, 'fa-address-book-o'),
(4, 'fa-address-card'),
(5, 'fa-address-card-o'),
(6, 'fa-adjust'),
(7, 'fa-adn'),
(8, 'fa-align-center'),
(9, 'fa-align-justify'),
(10, 'fa-align-left'),
(11, 'fa-align-right'),
(12, 'fa-amazon'),
(13, 'fa-ambulance'),
(14, 'fa-american-sign-lan'),
(15, 'fa-anchor'),
(16, 'fa-android'),
(17, 'fa-angellist'),
(18, 'fa-angle-double-down'),
(19, 'fa-angle-double-left'),
(20, 'fa-angle-double-righ'),
(21, 'fa-angle-double-up'),
(22, 'fa-angle-down'),
(23, 'fa-angle-left'),
(24, 'fa-angle-right'),
(25, 'fa-angle-up'),
(26, 'fa-apple'),
(27, 'fa-archive'),
(28, 'fa-area-chart'),
(29, 'fa-arrow-circle-down'),
(30, 'fa-arrow-circle-left'),
(31, 'fa-arrow-circle-o-do'),
(32, 'fa-arrow-circle-o-le'),
(33, 'fa-arrow-circle-o-ri'),
(34, 'fa-arrow-circle-o-up'),
(35, 'fa-arrow-circle-righ'),
(36, 'fa-arrow-circle-up'),
(37, 'fa-arrow-down'),
(38, 'fa-arrow-left'),
(39, 'fa-arrow-right'),
(40, 'fa-arrow-up'),
(41, 'fa-arrows'),
(42, 'fa-arrows-alt'),
(43, 'fa-arrows-h'),
(44, 'fa-arrows-v'),
(45, 'fa-asl-interpreting'),
(46, 'fa-assistive-listeni'),
(47, 'fa-asterisk'),
(48, 'fa-at'),
(49, 'fa-audio-description'),
(50, 'fa-automobile'),
(51, 'fa-backward'),
(52, 'fa-balance-scale'),
(53, 'fa-ban'),
(54, 'fa-bandcamp'),
(55, 'fa-bank'),
(56, 'fa-bar-chart'),
(57, 'fa-bar-chart-o'),
(58, 'fa-barcode'),
(59, 'fa-bars'),
(60, 'fa-bath'),
(61, 'fa-bathtub'),
(62, 'fa-battery'),
(63, 'fa-battery-0'),
(64, 'fa-battery-1'),
(65, 'fa-battery-2'),
(66, 'fa-battery-3'),
(67, 'fa-battery-4'),
(68, 'fa-battery-empty'),
(69, 'fa-battery-full'),
(70, 'fa-battery-half'),
(71, 'fa-battery-quarter'),
(72, 'fa-battery-three-qua'),
(73, 'fa-bed'),
(74, 'fa-beer'),
(75, 'fa-behance'),
(76, 'fa-behance-square'),
(77, 'fa-bell'),
(78, 'fa-bell-o'),
(79, 'fa-bell-slash'),
(80, 'fa-bell-slash-o'),
(81, 'fa-bicycle'),
(82, 'fa-binoculars'),
(83, 'fa-birthday-cake'),
(84, 'fa-bitbucket'),
(85, 'fa-bitbucket-square'),
(86, 'fa-bitcoin'),
(87, 'fa-black-tie'),
(88, 'fa-blind'),
(89, 'fa-bluetooth'),
(90, 'fa-bluetooth-b'),
(91, 'fa-bold'),
(92, 'fa-bolt'),
(93, 'fa-bomb'),
(94, 'fa-book'),
(95, 'fa-bookmark'),
(96, 'fa-bookmark-o'),
(97, 'fa-braille'),
(98, 'fa-briefcase'),
(99, 'fa-btc'),
(100, 'fa-bug'),
(101, 'fa-building'),
(102, 'fa-building-o'),
(103, 'fa-bullhorn'),
(104, 'fa-bullseye'),
(105, 'fa-bus'),
(106, 'fa-buysellads'),
(107, 'fa-cab'),
(108, 'fa-calculator'),
(109, 'fa-calendar'),
(110, 'fa-calendar-check-o'),
(111, 'fa-calendar-minus-o'),
(112, 'fa-calendar-o'),
(113, 'fa-calendar-plus-o'),
(114, 'fa-calendar-times-o'),
(115, 'fa-camera'),
(116, 'fa-camera-retro'),
(117, 'fa-car'),
(118, 'fa-caret-down'),
(119, 'fa-caret-left'),
(120, 'fa-caret-right'),
(121, 'fa-caret-square-o-do'),
(122, 'fa-caret-square-o-le'),
(123, 'fa-caret-square-o-ri'),
(124, 'fa-caret-square-o-up'),
(125, 'fa-caret-up'),
(126, 'fa-cart-arrow-down'),
(127, 'fa-cart-plus'),
(128, 'fa-cc'),
(129, 'fa-cc-amex'),
(130, 'fa-cc-diners-club'),
(131, 'fa-cc-discover'),
(132, 'fa-cc-jcb'),
(133, 'fa-cc-mastercard'),
(134, 'fa-cc-paypal'),
(135, 'fa-cc-stripe'),
(136, 'fa-cc-visa'),
(137, 'fa-certificate'),
(138, 'fa-chain'),
(139, 'fa-chain-broken'),
(140, 'fa-check'),
(141, 'fa-check-circle'),
(142, 'fa-check-circle-o'),
(143, 'fa-check-square'),
(144, 'fa-check-square-o'),
(145, 'fa-chevron-circle-do'),
(146, 'fa-chevron-circle-le'),
(147, 'fa-chevron-circle-ri'),
(148, 'fa-chevron-circle-up'),
(149, 'fa-chevron-down'),
(150, 'fa-chevron-left'),
(151, 'fa-chevron-right'),
(152, 'fa-chevron-up'),
(153, 'fa-child'),
(154, 'fa-chrome'),
(155, 'fa-circle'),
(156, 'fa-circle-o'),
(157, 'fa-circle-o-notch'),
(158, 'fa-circle-thin'),
(159, 'fa-clipboard'),
(160, 'fa-clock-o'),
(161, 'fa-clone'),
(162, 'fa-close'),
(163, 'fa-cloud'),
(164, 'fa-cloud-download'),
(165, 'fa-cloud-upload'),
(166, 'fa-cny'),
(167, 'fa-code'),
(168, 'fa-code-fork'),
(169, 'fa-codepen'),
(170, 'fa-codiepie'),
(171, 'fa-coffee'),
(172, 'fa-cog'),
(173, 'fa-cogs'),
(174, 'fa-columns'),
(175, 'fa-comment'),
(176, 'fa-comment-o'),
(177, 'fa-commenting'),
(178, 'fa-commenting-o'),
(179, 'fa-comments'),
(180, 'fa-comments-o'),
(181, 'fa-compass'),
(182, 'fa-compress'),
(183, 'fa-connectdevelop'),
(184, 'fa-contao'),
(185, 'fa-copy'),
(186, 'fa-copyright'),
(187, 'fa-creative-commons'),
(188, 'fa-credit-card'),
(189, 'fa-credit-card-alt'),
(190, 'fa-crop'),
(191, 'fa-crosshairs'),
(192, 'fa-css3'),
(193, 'fa-cube'),
(194, 'fa-cubes'),
(195, 'fa-cut'),
(196, 'fa-cutlery'),
(197, 'fa-dashboard'),
(198, 'fa-dashcube'),
(199, 'fa-database'),
(200, 'fa-deaf'),
(201, 'fa-deafness'),
(202, 'fa-dedent'),
(203, 'fa-delicious'),
(204, 'fa-desktop'),
(205, 'fa-deviantart'),
(206, 'fa-diamond'),
(207, 'fa-digg'),
(208, 'fa-dollar'),
(209, 'fa-dot-circle-o'),
(210, 'fa-download'),
(211, 'fa-dribbble'),
(212, 'fa-drivers-license'),
(213, 'fa-drivers-license-o'),
(214, 'fa-dropbox'),
(215, 'fa-drupal'),
(216, 'fa-edge'),
(217, 'fa-edit'),
(218, 'fa-eercast'),
(219, 'fa-eject'),
(220, 'fa-ellipsis-h'),
(221, 'fa-ellipsis-v'),
(222, 'fa-empire'),
(223, 'fa-envelope'),
(224, 'fa-envelope-o'),
(225, 'fa-envelope-open'),
(226, 'fa-envelope-open-o'),
(227, 'fa-envelope-square'),
(228, 'fa-envira'),
(229, 'fa-eraser'),
(230, 'fa-etsy'),
(231, 'fa-eur'),
(232, 'fa-euro'),
(233, 'fa-exchange'),
(234, 'fa-exclamation'),
(235, 'fa-exclamation-circl'),
(236, 'fa-exclamation-trian'),
(237, 'fa-expand'),
(238, 'fa-expeditedssl'),
(239, 'fa-external-link'),
(240, 'fa-external-link-squ'),
(241, 'fa-eye'),
(242, 'fa-eye-slash'),
(243, 'fa-eyedropper'),
(244, 'fa-fa'),
(245, 'fa-facebook'),
(246, 'fa-facebook-f'),
(247, 'fa-facebook-official'),
(248, 'fa-facebook-square'),
(249, 'fa-fast-backward'),
(250, 'fa-fast-forward'),
(251, 'fa-fax'),
(252, 'fa-feed'),
(253, 'fa-female'),
(254, 'fa-fighter-jet'),
(255, 'fa-file'),
(256, 'fa-file-archive-o'),
(257, 'fa-file-audio-o'),
(258, 'fa-file-code-o'),
(259, 'fa-file-excel-o'),
(260, 'fa-file-image-o'),
(261, 'fa-file-movie-o'),
(262, 'fa-file-o'),
(263, 'fa-file-pdf-o'),
(264, 'fa-file-photo-o'),
(265, 'fa-file-picture-o'),
(266, 'fa-file-powerpoint-o'),
(267, 'fa-file-sound-o'),
(268, 'fa-file-text'),
(269, 'fa-file-text-o'),
(270, 'fa-file-video-o'),
(271, 'fa-file-word-o'),
(272, 'fa-file-zip-o'),
(273, 'fa-files-o'),
(274, 'fa-film'),
(275, 'fa-filter'),
(276, 'fa-fire'),
(277, 'fa-fire-extinguisher'),
(278, 'fa-firefox'),
(279, 'fa-first-order'),
(280, 'fa-flag'),
(281, 'fa-flag-checkered'),
(282, 'fa-flag-o'),
(283, 'fa-flash'),
(284, 'fa-flask'),
(285, 'fa-flickr'),
(286, 'fa-floppy-o'),
(287, 'fa-folder'),
(288, 'fa-folder-o'),
(289, 'fa-folder-open'),
(290, 'fa-folder-open-o'),
(291, 'fa-font'),
(292, 'fa-font-awesome'),
(293, 'fa-fonticons'),
(294, 'fa-fort-awesome'),
(295, 'fa-forumbee'),
(296, 'fa-forward'),
(297, 'fa-foursquare'),
(298, 'fa-free-code-camp'),
(299, 'fa-frown-o'),
(300, 'fa-futbol-o'),
(301, 'fa-gamepad'),
(302, 'fa-gavel'),
(303, 'fa-gbp'),
(304, 'fa-ge'),
(305, 'fa-gear'),
(306, 'fa-gears'),
(307, 'fa-genderless'),
(308, 'fa-get-pocket'),
(309, 'fa-gg'),
(310, 'fa-gg-circle'),
(311, 'fa-gift'),
(312, 'fa-git'),
(313, 'fa-git-square'),
(314, 'fa-github'),
(315, 'fa-github-alt'),
(316, 'fa-github-square'),
(317, 'fa-gitlab'),
(318, 'fa-gittip'),
(319, 'fa-glass'),
(320, 'fa-glide'),
(321, 'fa-glide-g'),
(322, 'fa-globe'),
(323, 'fa-google'),
(324, 'fa-google-plus'),
(325, 'fa-google-plus-circl'),
(326, 'fa-google-plus-offic'),
(327, 'fa-google-plus-squar'),
(328, 'fa-google-wallet'),
(329, 'fa-graduation-cap'),
(330, 'fa-gratipay'),
(331, 'fa-grav'),
(332, 'fa-group'),
(333, 'fa-h-square'),
(334, 'fa-hacker-news'),
(335, 'fa-hand-grab-o'),
(336, 'fa-hand-lizard-o'),
(337, 'fa-hand-o-down'),
(338, 'fa-hand-o-left'),
(339, 'fa-hand-o-right'),
(340, 'fa-hand-o-up'),
(341, 'fa-hand-paper-o'),
(342, 'fa-hand-peace-o'),
(343, 'fa-hand-pointer-o'),
(344, 'fa-hand-rock-o'),
(345, 'fa-hand-scissors-o'),
(346, 'fa-hand-spock-o'),
(347, 'fa-hand-stop-o'),
(348, 'fa-handshake-o'),
(349, 'fa-hard-of-hearing'),
(350, 'fa-hashtag'),
(351, 'fa-hdd-o'),
(352, 'fa-header'),
(353, 'fa-headphones'),
(354, 'fa-heart'),
(355, 'fa-heart-o'),
(356, 'fa-heartbeat'),
(357, 'fa-history'),
(358, 'fa-home'),
(359, 'fa-hospital-o'),
(360, 'fa-hotel'),
(361, 'fa-hourglass'),
(362, 'fa-hourglass-1'),
(363, 'fa-hourglass-2'),
(364, 'fa-hourglass-3'),
(365, 'fa-hourglass-end'),
(366, 'fa-hourglass-half'),
(367, 'fa-hourglass-o'),
(368, 'fa-hourglass-start'),
(369, 'fa-houzz'),
(370, 'fa-html5'),
(371, 'fa-i-cursor'),
(372, 'fa-id-badge'),
(373, 'fa-id-card'),
(374, 'fa-id-card-o'),
(375, 'fa-ils'),
(376, 'fa-image'),
(377, 'fa-imdb'),
(378, 'fa-inbox'),
(379, 'fa-indent'),
(380, 'fa-industry'),
(381, 'fa-info'),
(382, 'fa-info-circle'),
(383, 'fa-inr'),
(384, 'fa-instagram'),
(385, 'fa-institution'),
(386, 'fa-internet-explorer'),
(387, 'fa-intersex'),
(388, 'fa-ioxhost'),
(389, 'fa-italic'),
(390, 'fa-joomla'),
(391, 'fa-jpy'),
(392, 'fa-jsfiddle'),
(393, 'fa-key'),
(394, 'fa-keyboard-o'),
(395, 'fa-krw'),
(396, 'fa-language'),
(397, 'fa-laptop'),
(398, 'fa-lastfm'),
(399, 'fa-lastfm-square'),
(400, 'fa-leaf'),
(401, 'fa-leanpub'),
(402, 'fa-legal'),
(403, 'fa-lemon-o'),
(404, 'fa-level-down'),
(405, 'fa-level-up'),
(406, 'fa-life-bouy'),
(407, 'fa-life-buoy'),
(408, 'fa-life-ring'),
(409, 'fa-life-saver'),
(410, 'fa-lightbulb-o'),
(411, 'fa-line-chart'),
(412, 'fa-link'),
(413, 'fa-linkedin'),
(414, 'fa-linkedin-square'),
(415, 'fa-linode'),
(416, 'fa-linux'),
(417, 'fa-list'),
(418, 'fa-list-alt'),
(419, 'fa-list-ol'),
(420, 'fa-list-ul'),
(421, 'fa-location-arrow'),
(422, 'fa-lock'),
(423, 'fa-long-arrow-down'),
(424, 'fa-long-arrow-left'),
(425, 'fa-long-arrow-right'),
(426, 'fa-long-arrow-up'),
(427, 'fa-low-vision'),
(428, 'fa-magic'),
(429, 'fa-magnet'),
(430, 'fa-mail-forward'),
(431, 'fa-mail-reply'),
(432, 'fa-mail-reply-all'),
(433, 'fa-male'),
(434, 'fa-map'),
(435, 'fa-map-marker'),
(436, 'fa-map-o'),
(437, 'fa-map-pin'),
(438, 'fa-map-signs'),
(439, 'fa-mars'),
(440, 'fa-mars-double'),
(441, 'fa-mars-stroke'),
(442, 'fa-mars-stroke-h'),
(443, 'fa-mars-stroke-v'),
(444, 'fa-maxcdn'),
(445, 'fa-meanpath'),
(446, 'fa-medium'),
(447, 'fa-medkit'),
(448, 'fa-meetup'),
(449, 'fa-meh-o'),
(450, 'fa-mercury'),
(451, 'fa-microchip'),
(452, 'fa-microphone'),
(453, 'fa-microphone-slash'),
(454, 'fa-minus'),
(455, 'fa-minus-circle'),
(456, 'fa-minus-square'),
(457, 'fa-minus-square-o'),
(458, 'fa-mixcloud'),
(459, 'fa-mobile'),
(460, 'fa-mobile-phone'),
(461, 'fa-modx'),
(462, 'fa-money'),
(463, 'fa-moon-o'),
(464, 'fa-mortar-board'),
(465, 'fa-motorcycle'),
(466, 'fa-mouse-pointer'),
(467, 'fa-music'),
(468, 'fa-navicon'),
(469, 'fa-neuter'),
(470, 'fa-newspaper-o'),
(471, 'fa-object-group'),
(472, 'fa-object-ungroup'),
(473, 'fa-odnoklassniki'),
(474, 'fa-odnoklassniki-squ'),
(475, 'fa-opencart'),
(476, 'fa-openid'),
(477, 'fa-opera'),
(478, 'fa-optin-monster'),
(479, 'fa-outdent'),
(480, 'fa-pagelines'),
(481, 'fa-paint-brush'),
(482, 'fa-paper-plane'),
(483, 'fa-paper-plane-o'),
(484, 'fa-paperclip'),
(485, 'fa-paragraph'),
(486, 'fa-paste'),
(487, 'fa-pause'),
(488, 'fa-pause-circle'),
(489, 'fa-pause-circle-o'),
(490, 'fa-paw'),
(491, 'fa-paypal'),
(492, 'fa-pencil'),
(493, 'fa-pencil-square'),
(494, 'fa-pencil-square-o'),
(495, 'fa-percent'),
(496, 'fa-phone'),
(497, 'fa-phone-square'),
(498, 'fa-photo'),
(499, 'fa-picture-o'),
(500, 'fa-pie-chart'),
(501, 'fa-pied-piper'),
(502, 'fa-pied-piper-alt'),
(503, 'fa-pied-piper-pp'),
(504, 'fa-pinterest'),
(505, 'fa-pinterest-p'),
(506, 'fa-pinterest-square'),
(507, 'fa-plane'),
(508, 'fa-play'),
(509, 'fa-play-circle'),
(510, 'fa-play-circle-o'),
(511, 'fa-plug'),
(512, 'fa-plus'),
(513, 'fa-plus-circle'),
(514, 'fa-plus-square'),
(515, 'fa-plus-square-o'),
(516, 'fa-podcast'),
(517, 'fa-power-off'),
(518, 'fa-print'),
(519, 'fa-product-hunt'),
(520, 'fa-puzzle-piece'),
(521, 'fa-qq'),
(522, 'fa-qrcode'),
(523, 'fa-question'),
(524, 'fa-question-circle'),
(525, 'fa-question-circle-o'),
(526, 'fa-quora'),
(527, 'fa-quote-left'),
(528, 'fa-quote-right'),
(529, 'fa-ra'),
(530, 'fa-random'),
(531, 'fa-ravelry'),
(532, 'fa-rebel'),
(533, 'fa-recycle'),
(534, 'fa-reddit'),
(535, 'fa-reddit-alien'),
(536, 'fa-reddit-square'),
(537, 'fa-refresh'),
(538, 'fa-registered'),
(539, 'fa-remove'),
(540, 'fa-renren'),
(541, 'fa-reorder'),
(542, 'fa-repeat'),
(543, 'fa-reply'),
(544, 'fa-reply-all'),
(545, 'fa-resistance'),
(546, 'fa-retweet'),
(547, 'fa-rmb'),
(548, 'fa-road'),
(549, 'fa-rocket'),
(550, 'fa-rotate-left'),
(551, 'fa-rotate-right'),
(552, 'fa-rouble'),
(553, 'fa-rss'),
(554, 'fa-rss-square'),
(555, 'fa-rub'),
(556, 'fa-ruble'),
(557, 'fa-rupee'),
(558, 'fa-s15'),
(559, 'fa-safari'),
(560, 'fa-save'),
(561, 'fa-scissors'),
(562, 'fa-scribd'),
(563, 'fa-search'),
(564, 'fa-search-minus'),
(565, 'fa-search-plus'),
(566, 'fa-sellsy'),
(567, 'fa-send'),
(568, 'fa-send-o'),
(569, 'fa-server'),
(570, 'fa-share'),
(571, 'fa-share-alt'),
(572, 'fa-share-alt-square'),
(573, 'fa-share-square'),
(574, 'fa-share-square-o'),
(575, 'fa-shekel'),
(576, 'fa-sheqel'),
(577, 'fa-shield'),
(578, 'fa-ship'),
(579, 'fa-shirtsinbulk'),
(580, 'fa-shopping-bag'),
(581, 'fa-shopping-basket'),
(582, 'fa-shopping-cart'),
(583, 'fa-shower'),
(584, 'fa-sign-in'),
(585, 'fa-sign-language'),
(586, 'fa-sign-out'),
(587, 'fa-signal'),
(588, 'fa-signing'),
(589, 'fa-simplybuilt'),
(590, 'fa-sitemap'),
(591, 'fa-skyatlas'),
(592, 'fa-skype'),
(593, 'fa-slack'),
(594, 'fa-sliders'),
(595, 'fa-slideshare'),
(596, 'fa-smile-o'),
(597, 'fa-snapchat'),
(598, 'fa-snapchat-ghost'),
(599, 'fa-snapchat-square'),
(600, 'fa-snowflake-o'),
(601, 'fa-soccer-ball-o'),
(602, 'fa-sort'),
(603, 'fa-sort-alpha-asc'),
(604, 'fa-sort-alpha-desc'),
(605, 'fa-sort-amount-asc'),
(606, 'fa-sort-amount-desc'),
(607, 'fa-sort-asc'),
(608, 'fa-sort-desc'),
(609, 'fa-sort-down'),
(610, 'fa-sort-numeric-asc'),
(611, 'fa-sort-numeric-desc'),
(612, 'fa-sort-up'),
(613, 'fa-soundcloud'),
(614, 'fa-space-shuttle'),
(615, 'fa-spinner'),
(616, 'fa-spoon'),
(617, 'fa-spotify'),
(618, 'fa-square'),
(619, 'fa-square-o'),
(620, 'fa-stack-exchange'),
(621, 'fa-stack-overflow'),
(622, 'fa-star'),
(623, 'fa-star-half'),
(624, 'fa-star-half-empty'),
(625, 'fa-star-half-full'),
(626, 'fa-star-half-o'),
(627, 'fa-star-o'),
(628, 'fa-steam'),
(629, 'fa-steam-square'),
(630, 'fa-step-backward'),
(631, 'fa-step-forward'),
(632, 'fa-stethoscope'),
(633, 'fa-sticky-note'),
(634, 'fa-sticky-note-o'),
(635, 'fa-stop'),
(636, 'fa-stop-circle'),
(637, 'fa-stop-circle-o'),
(638, 'fa-street-view'),
(639, 'fa-strikethrough'),
(640, 'fa-stumbleupon'),
(641, 'fa-stumbleupon-circl'),
(642, 'fa-subscript'),
(643, 'fa-subway'),
(644, 'fa-suitcase'),
(645, 'fa-sun-o'),
(646, 'fa-superpowers'),
(647, 'fa-superscript'),
(648, 'fa-support'),
(649, 'fa-table'),
(650, 'fa-tablet'),
(651, 'fa-tachometer'),
(652, 'fa-tag'),
(653, 'fa-tags'),
(654, 'fa-tasks'),
(655, 'fa-taxi'),
(656, 'fa-telegram'),
(657, 'fa-television'),
(658, 'fa-tencent-weibo'),
(659, 'fa-terminal'),
(660, 'fa-text-height'),
(661, 'fa-text-width'),
(662, 'fa-th'),
(663, 'fa-th-large'),
(664, 'fa-th-list'),
(665, 'fa-themeisle'),
(666, 'fa-thermometer'),
(667, 'fa-thermometer-0'),
(668, 'fa-thermometer-1'),
(669, 'fa-thermometer-2'),
(670, 'fa-thermometer-3'),
(671, 'fa-thermometer-4'),
(672, 'fa-thermometer-empty'),
(673, 'fa-thermometer-full'),
(674, 'fa-thermometer-half'),
(675, 'fa-thermometer-quart'),
(676, 'fa-thermometer-three'),
(677, 'fa-thumb-tack'),
(678, 'fa-thumbs-down'),
(679, 'fa-thumbs-o-down'),
(680, 'fa-thumbs-o-up'),
(681, 'fa-thumbs-up'),
(682, 'fa-ticket'),
(683, 'fa-times'),
(684, 'fa-times-circle'),
(685, 'fa-times-circle-o'),
(686, 'fa-times-rectangle'),
(687, 'fa-times-rectangle-o'),
(688, 'fa-tint'),
(689, 'fa-toggle-down'),
(690, 'fa-toggle-left'),
(691, 'fa-toggle-off'),
(692, 'fa-toggle-on'),
(693, 'fa-toggle-right'),
(694, 'fa-toggle-up'),
(695, 'fa-trademark'),
(696, 'fa-train'),
(697, 'fa-transgender'),
(698, 'fa-transgender-alt'),
(699, 'fa-trash'),
(700, 'fa-trash-o'),
(701, 'fa-tree'),
(702, 'fa-trello'),
(703, 'fa-tripadvisor'),
(704, 'fa-trophy'),
(705, 'fa-truck'),
(706, 'fa-try'),
(707, 'fa-tty'),
(708, 'fa-tumblr'),
(709, 'fa-tumblr-square'),
(710, 'fa-turkish-lira'),
(711, 'fa-tv'),
(712, 'fa-twitch'),
(713, 'fa-twitter'),
(714, 'fa-twitter-square'),
(715, 'fa-umbrella'),
(716, 'fa-underline'),
(717, 'fa-undo'),
(718, 'fa-universal-access'),
(719, 'fa-university'),
(720, 'fa-unlink'),
(721, 'fa-unlock'),
(722, 'fa-unlock-alt'),
(723, 'fa-unsorted'),
(724, 'fa-upload'),
(725, 'fa-usb'),
(726, 'fa-usd'),
(727, 'fa-user'),
(728, 'fa-user-circle'),
(729, 'fa-user-circle-o'),
(730, 'fa-user-md'),
(731, 'fa-user-o'),
(732, 'fa-user-plus'),
(733, 'fa-user-secret'),
(734, 'fa-user-times'),
(735, 'fa-users'),
(736, 'fa-vcard'),
(737, 'fa-vcard-o'),
(738, 'fa-venus'),
(739, 'fa-venus-double'),
(740, 'fa-venus-mars'),
(741, 'fa-viacoin'),
(742, 'fa-viadeo'),
(743, 'fa-viadeo-square'),
(744, 'fa-video-camera'),
(745, 'fa-vimeo'),
(746, 'fa-vimeo-square'),
(747, 'fa-vine'),
(748, 'fa-vk'),
(749, 'fa-volume-control-ph'),
(750, 'fa-volume-down'),
(751, 'fa-volume-off'),
(752, 'fa-volume-up'),
(753, 'fa-warning'),
(754, 'fa-wechat'),
(755, 'fa-weibo'),
(756, 'fa-weixin'),
(757, 'fa-whatsapp'),
(758, 'fa-wheelchair'),
(759, 'fa-wheelchair-alt'),
(760, 'fa-wifi'),
(761, 'fa-wikipedia-w'),
(762, 'fa-window-close'),
(763, 'fa-window-close-o'),
(764, 'fa-window-maximize'),
(765, 'fa-window-minimize'),
(766, 'fa-window-restore'),
(767, 'fa-windows'),
(768, 'fa-won'),
(769, 'fa-wordpress'),
(770, 'fa-wpbeginner'),
(771, 'fa-wpexplorer'),
(772, 'fa-wpforms'),
(773, 'fa-wrench'),
(774, 'fa-xing'),
(775, 'fa-xing-square'),
(776, 'fa-y-combinator'),
(777, 'fa-y-combinator-squa'),
(778, 'fa-yahoo'),
(779, 'fa-yc'),
(780, 'fa-yc-square'),
(781, 'fa-yelp'),
(782, 'fa-yen'),
(783, 'fa-yoast'),
(784, 'fa-youtube'),
(785, 'fa-youtube-play'),
(786, 'fa-youtube-square');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nik` int(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `jk` enum('0','1') NOT NULL,
  `marital_status` enum('0','1','2') NOT NULL COMMENT '0 = Belum Menikah, 1 = Menikah, 2 = Duda/Janda',
  `tempat_lahir` varchar(50) NOT NULL,
  `agama_id` int(11) NOT NULL,
  `golongan_darah` enum('A','AB','B','O') NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `fullname`, `jk`, `marital_status`, `tempat_lahir`, `agama_id`, `golongan_darah`, `email`, `created_at`, `updated_at`) VALUES
(1, 123456789, 'Nesta Maulana Malik Ibrahim', '1', '0', 'Bogor', 1, 'O', 'nesta.maulana@nutrifood.co.id', '2019-04-24 02:45:58', '0000-00-00 00:00:00'),
(2, 987654321, 'User', '1', '0', 'Jakarta', 1, 'O', 'user@outlook.com', '2019-03-29 06:31:18', '2019-03-29 06:31:18'),
(3, 456789, 'Nesta Maulana', '1', '0', 'Bogor', 1, 'A', 'nestamaulana165@gmail.com', '2019-04-16 08:05:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `user_id` int(11) NOT NULL,
  `aktivitas` enum('1','2','3') NOT NULL COMMENT '1= add, 2=delete, 3=update',
  `keterangan` text NOT NULL,
  `apps_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` tinyint(2) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `link` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `aplikasi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu`, `icon`, `link`, `status`, `posisi`, `aplikasi_id`, `created_at`, `updated_at`) VALUES
(2, 0, 'Pengaturan Aplikasi', 'fa-link', '-', '1', '1', 1, '2019-03-01 01:48:20', '0000-00-00 00:00:00'),
(4, 31, 'Form PMB', 'fa-edit', 'master-apps/form-pmb', '1', '3', 1, '2019-04-29 07:18:34', '0000-00-00 00:00:00'),
(5, 30, 'Form User', 'fa-users', 'master-apps/form-user', '1', '0', 1, '2019-04-29 07:00:58', '0000-00-00 00:00:00'),
(6, 0, 'Form Menu', 'fa-coffee', 'master-apps/form-menu', '0', '0', 1, '2019-04-29 07:02:49', '0000-00-00 00:00:00'),
(14, 30, 'Kelola Menu', 'fa-opera', 'master-apps/form-menu', '1', '1', 1, '2019-04-29 07:03:05', '2019-02-11 09:06:43'),
(15, 30, 'Form Hak Akses', 'fa-calendar', 'master-apps/form-hak-akses', '1', '4', 1, '2019-04-29 07:03:24', '2019-02-18 03:10:03'),
(16, 30, 'Form Roles', 'fa-gear', 'master-apps/form-roles', '1', '3', 1, '2019-04-29 07:03:50', '2019-02-20 07:38:10'),
(17, 0, 'Menu Utility Online', 'fa-comments', '-', '1', '0', 2, '2019-04-02 01:13:02', '2019-03-03 04:08:29'),
(25, 35, 'Form Bagian', 'fa-archive', 'bagian', '1', '1', 1, '2019-04-16 02:18:23', '2019-03-10 19:38:33'),
(26, 35, 'Form Company', 'fa-bandcamp', 'company', '1', '0', 1, '2019-04-07 06:40:32', '2019-03-10 19:47:48'),
(29, 0, 'Home', 'fa-home', '/sentul-apps/master-apps', '1', '0', 1, '2019-04-29 07:02:19', '2019-03-29 09:02:33'),
(30, 0, 'Pengaturan Umum', 'fa-unlink', '-', '1', '2', 1, '2019-04-01 08:48:19', '2019-04-01 08:48:19'),
(31, 0, 'Parent', 'fa-paragraph', '-', '1', '3', 1, '2019-04-01 09:25:08', '2019-04-01 09:03:31'),
(33, 2, 'Rollie', 'fa-angle-right', '-', '1', '2', 1, '2019-04-02 00:58:22', '2019-04-02 00:58:22'),
(34, 2, 'Mollie', 'fa-angle-right', '-', '1', '3', 1, '2019-04-02 00:58:55', '2019-04-02 00:58:55'),
(35, 2, 'Ullie', 'fa-angle-right', '-', '1', '4', 1, '2019-04-02 00:59:25', '2019-04-02 00:59:25'),
(36, 0, 'Menu Utility Online 1', 'fa-angle-right', '-', '1', '4', 2, '2019-04-04 01:51:45', '2019-04-04 01:51:45'),
(37, 0, 'Menu Utility Online 2', 'fa-user', '-', '1', '5', 2, '2019-04-04 02:04:12', '2019-04-04 01:52:10'),
(40, 0, 'Menu Utility Online 5', 'fa-area-chart', '-', '1', '6', 2, '2019-04-04 02:56:50', '2019-04-04 02:56:50'),
(41, 37, 'Menu Utility', 'fa-bug', '-', '1', '0', 2, '2019-04-04 06:18:15', '2019-04-04 06:18:15'),
(42, 30, 'Kelola Produk', 'fa-yoast', 'master-apps/produk', '1', '2', 1, '2019-04-29 07:04:58', '2019-04-15 08:13:06'),
(43, 35, 'Rasio', 'fa-paypal', 'rasio', '1', '2', 1, '2019-04-16 02:20:21', '2019-04-16 02:20:21'),
(44, 35, 'Satuan', 'fa-bullseye', 'satuan', '1', '3', 1, '2019-04-16 02:38:31', '2019-04-16 02:38:31'),
(45, 35, 'Kategori', 'fa-angellist', 'kategori', '1', '4', 1, '2019-04-16 02:54:25', '2019-04-16 02:54:25'),
(46, 30, 'Aplikasi', 'fa-paw', 'master-apps/aplikasi', '1', '5', 1, '2019-04-29 07:04:15', '2019-04-22 02:23:39'),
(47, 30, 'Hak Akses Aplikasi', 'fa-reply-all', 'master-apps/hak-akses-aplikasi', '1', '6', 1, '2019-04-29 07:04:38', '2019-04-22 02:28:25'),
(48, 30, 'Plan', 'fa-building', 'master-apps/plan', '1', '7', 1, '2019-04-29 07:04:26', '2019-04-22 02:31:31'),
(49, 0, 'Jadwal Produksi', 'fa-calendar-o', 'rollie-penyelia/', '1', '7', 10, '2019-04-30 04:29:38', '2019-04-22 06:49:50'),
(50, 0, 'CPP', 'fa-angle-double-left', 'rollie/cpp', '1', '8', 3, '2019-04-24 02:09:00', '2019-04-24 02:09:00'),
(51, 0, 'Analisa Kimia FG', 'fa-angle-double-left', 'rollie/analisa-kimia-fg', '1', '9', 3, '2019-04-24 02:09:37', '2019-04-24 02:09:37'),
(52, 0, 'RKJ', 'fa-angellist', 'rollie/rkj', '1', '10', 3, '2019-04-24 02:10:03', '2019-04-24 02:10:03'),
(53, 0, 'Package Integrity', 'fa-anchor', 'rollie/package-integrity', '1', '10', 3, '2019-04-24 02:10:34', '2019-04-24 02:10:34'),
(54, 0, 'PPQ-FG', 'fa-angle-double-down', 'rollie/ppq-fg', '1', '10', 3, '2019-04-24 02:11:01', '2019-04-24 02:11:01'),
(55, 0, 'Analisa Mikro', 'fa-angle-double-left', 'rollie/analisa-mikro', '1', '10', 3, '2019-04-24 02:11:28', '2019-04-24 02:11:28'),
(56, 0, 'Sortasi', 'fa-codiepie', 'rollie/sortasi', '1', '10', 3, '2019-04-24 02:12:37', '2019-04-24 02:12:37'),
(57, 30, 'Brand', 'fa-angle-double-left', 'master-apps/brand', '1', '8', 1, '2019-04-25 07:01:14', '2019-04-25 07:01:14'),
(58, 0, 'Dashboard', 'fa-home', 'rollie-operator-produksi/', '1', '10', 11, '2019-04-30 04:35:26', '2019-04-29 07:33:26'),
(59, 0, 'Dashboard', 'fa-home', 'rollie-inspektor-qc/', '1', '10', 12, '2019-04-30 04:58:45', '2019-04-30 02:55:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_01_23_045558_create_user_accesses_table', 1),
(2, '2019_01_23_062430_roles', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', '1', '2019-01-23 07:00:00', NULL),
(2, 'Administrator', '1', NULL, NULL),
(3, 'R & D Produk', '0', NULL, NULL),
(8, 'Cek Save', '0', '2019-02-08 02:16:51', '2019-02-08 02:16:51'),
(9, 'CEK', '0', '2019-03-28 00:38:36', '2019-03-28 00:38:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `rolesId` int(11) NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifiedByAdmin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastUpdatePassword` date NOT NULL,
  `passwordWrong` int(1) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `rolesId`, `username`, `password`, `verified`, `verifiedByAdmin`, `lastUpdatePassword`, `passwordWrong`, `status`, `created_at`, `updated_at`) VALUES
(22, 1, '456789', 'maulana', '0', '1', '2019-01-24', 1, '0', '2019-01-23 18:17:34', '2019-01-23 18:17:34'),
(23, 2, '987654321', '$2y$10$Ayz5ekHG0j9kt.5/MwY0quaTDL90AdQuzqcqb5wNSeGXhsCUU.1Nm', '1', '1', '2019-03-15', 0, '1', '2019-01-03 17:00:00', '2019-04-01 07:54:44'),
(24, 2, '123456789', '$2y$10$Ayz5ekHG0j9kt.5/MwY0quaTDL90AdQuzqcqb5wNSeGXhsCUU.1Nm', '1', '1', '2019-04-30', 0, '1', '2015-02-13 02:12:11', '2019-04-30 09:11:45');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_hak_akses`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_hak_akses` (
`id` int(11)
,`parent_id` tinyint(2)
,`menu` varchar(50)
,`icon` varchar(20)
,`link` varchar(50)
,`posisi` varchar(100)
,`status` enum('0','1')
,`user_id` int(11)
,`lihat` enum('0','1')
,`tambah` enum('0','1')
,`ubah` enum('0','1')
,`hapus` enum('0','1')
,`aplikasi` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_hak_akses`
--
DROP TABLE IF EXISTS `v_hak_akses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hak_akses`  AS  select `menus`.`id` AS `id`,`menus`.`parent_id` AS `parent_id`,`menus`.`menu` AS `menu`,`menus`.`icon` AS `icon`,`menus`.`link` AS `link`,`menus`.`posisi` AS `posisi`,`menus`.`status` AS `status`,`hak_akses_menu`.`user_id` AS `user_id`,`hak_akses_menu`.`lihat` AS `lihat`,`hak_akses_menu`.`tambah` AS `tambah`,`hak_akses_menu`.`ubah` AS `ubah`,`hak_akses_menu`.`hapus` AS `hapus`,`aplikasi`.`aplikasi` AS `aplikasi` from ((`menus` join `hak_akses_menu` on((`hak_akses_menu`.`menu_id` = `menus`.`id`))) join `aplikasi` on((`aplikasi`.`id` = `menus`.`aplikasi_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hak_akses_aplikasi`
--
ALTER TABLE `hak_akses_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `aplikasi_id` (`aplikasi_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_rolesid_index` (`rolesId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `hak_akses_aplikasi`
--
ALTER TABLE `hak_akses_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `icons`
--
ALTER TABLE `icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
