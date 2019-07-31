-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jul 2019 pada 11.22
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
-- Database: `production_data`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_kimia`
--

CREATE TABLE `analisa_kimia` (
  `id` int(11) NOT NULL,
  `kode_batch_standar` varchar(7) DEFAULT NULL,
  `ts_awal_1` double(5,2) DEFAULT NULL,
  `ts_awal_2` double(5,2) DEFAULT NULL,
  `ts_awal_sum` double(6,3) DEFAULT NULL,
  `ts_tengah_1` double(5,2) DEFAULT NULL,
  `ts_tengah_2` double(5,2) DEFAULT NULL,
  `ts_tengah_sum` double(6,3) DEFAULT NULL,
  `ts_akhir_1` double(5,2) DEFAULT NULL,
  `ts_akhir_2` double(5,2) DEFAULT NULL,
  `ts_akhir_sum` double(6,3) DEFAULT NULL,
  `ph_awal` double(4,2) DEFAULT NULL,
  `ph_tengah` double(4,2) DEFAULT NULL,
  `ph_akhir` double(4,2) DEFAULT NULL,
  `visco_awal` varchar(5) DEFAULT NULL,
  `visco_tengah` varchar(5) DEFAULT NULL,
  `visco_akhir` varchar(5) DEFAULT NULL,
  `sensory_awal` enum('OK','#OK') DEFAULT NULL,
  `sensory_tengah` enum('OK','#OK') DEFAULT NULL,
  `sensory_akhir` enum('OK','#OK') DEFAULT NULL,
  `jam_filling_awal` datetime DEFAULT NULL,
  `jam_filling_tengah` datetime DEFAULT NULL,
  `jam_filling_akhir` datetime DEFAULT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 = draft , 1= close',
  `status_akhir` enum('OK','#OK') DEFAULT NULL,
  `keterangan` text,
  `user_id_inputer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_kimia`
--

INSERT INTO `analisa_kimia` (`id`, `kode_batch_standar`, `ts_awal_1`, `ts_awal_2`, `ts_awal_sum`, `ts_tengah_1`, `ts_tengah_2`, `ts_tengah_sum`, `ts_akhir_1`, `ts_akhir_2`, `ts_akhir_sum`, `ph_awal`, `ph_tengah`, `ph_akhir`, `visco_awal`, `visco_tengah`, `visco_akhir`, `sensory_awal`, `sensory_tengah`, `sensory_akhir`, `jam_filling_awal`, `jam_filling_tengah`, `jam_filling_akhir`, `status`, `status_akhir`, `keterangan`, `user_id_inputer`, `created_at`, `updated_at`) VALUES
(1, '-', 10.81, 10.82, 10.815, 10.84, 10.85, 10.845, 10.78, 10.79, 10.785, 7.04, 7.04, 7.05, '4.11', '3.93', '3.61', 'OK', 'OK', 'OK', '2019-07-15 23:53:10', '2019-07-16 00:52:53', '2019-07-16 01:31:15', '1', 'OK', 'TS OK pH OK Sensory OK', 24, '2019-07-21 09:57:47', '2019-07-22 07:11:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_mikro`
--

CREATE TABLE `analisa_mikro` (
  `id` int(11) NOT NULL,
  `cpp_head_id` int(11) NOT NULL,
  `tanggal_analisa` date NOT NULL,
  `status_analisa` enum('On Progress','OK','Resampling') DEFAULT NULL,
  `user_inputer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_mikro`
--

INSERT INTO `analisa_mikro` (`id`, `cpp_head_id`, `tanggal_analisa`, `status_analisa`, `user_inputer_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2019-07-31', 'On Progress', 24, '2019-07-31 07:33:20', '2019-07-31 07:33:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_mikro_detail`
--

CREATE TABLE `analisa_mikro_detail` (
  `id` int(11) NOT NULL,
  `analisa_mikro_id` int(11) NOT NULL,
  `kode_sampel` varchar(5) NOT NULL,
  `jam_filling` datetime NOT NULL,
  `rpd_filling_detail_id` int(11) NOT NULL,
  `suhu_preinkubasi` enum('30','55') NOT NULL,
  `tpc` int(3) DEFAULT NULL,
  `yeast` int(3) DEFAULT NULL,
  `mold` int(3) DEFAULT NULL,
  `ph` double(5,2) DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0 =  On Progress , 1 = OK , 2 = #OK ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_mikro_detail`
--

INSERT INTO `analisa_mikro_detail` (`id`, `analisa_mikro_id`, `kode_sampel`, `jam_filling`, `rpd_filling_detail_id`, `suhu_preinkubasi`, `tpc`, `yeast`, `mold`, `ph`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'A1', '2019-07-15 23:53:14', 3, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(2, 1, 'A2', '2019-07-15 23:53:14', 3, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(3, 1, 'R1', '2019-07-16 00:25:50', 5, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(4, 1, 'R2', '2019-07-16 00:25:50', 5, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(5, 1, 'B3', '2019-07-16 00:36:46', 6, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(6, 1, 'B4', '2019-07-16 00:36:46', 6, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(7, 1, 'C5', '2019-07-16 00:36:54', 7, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(8, 1, 'C6', '2019-07-16 00:36:54', 7, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(9, 1, 'R3', '2019-07-16 00:55:00', 9, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(10, 1, 'R4', '2019-07-16 00:55:00', 9, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(11, 1, 'D7', '2019-07-16 00:58:06', 10, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(12, 1, 'D8', '2019-07-16 00:58:06', 10, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(13, 1, 'E9', '2019-07-16 00:58:12', 11, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(14, 1, 'E10', '2019-07-16 00:58:12', 11, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:20', '2019-07-31 07:33:20'),
(15, 1, 'R5', '2019-07-16 01:25:14', 13, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:21', '2019-07-31 07:33:21'),
(16, 1, 'R6', '2019-07-16 01:25:14', 13, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:21', '2019-07-31 07:33:21'),
(17, 1, 'H11', '2019-07-16 01:31:18', 14, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:21', '2019-07-31 07:33:21'),
(18, 1, 'H12', '2019-07-16 01:31:18', 14, '30', NULL, NULL, NULL, NULL, '0', '2019-07-31 07:33:21', '2019-07-31 07:33:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`id`, `brand`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'NFI', 1, '2019-04-26 02:20:10', '2019-04-26 02:20:10'),
(2, 'HNI', 2, '2019-04-26 02:20:10', '2019-04-26 02:20:10'),
(3, 'WRP', 1, '2019-04-26 02:20:10', '2019-04-26 02:20:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `singkatan` varchar(30) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id`, `company`, `singkatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PT. Nutrifood Indonesia ', 'NFI', '1', '2019-04-26 02:15:19', '2019-04-26 02:15:19'),
(2, 'PT. Heavenly Nutrition Indonesia', 'HNI', '1', '2019-04-26 02:15:19', '2019-04-26 02:15:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpp_detail`
--

CREATE TABLE `cpp_detail` (
  `id` int(11) NOT NULL,
  `cpp_head_id` int(11) NOT NULL,
  `wo_id` int(11) NOT NULL,
  `mesin_filling_id` int(11) NOT NULL,
  `nolot` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cpp_detail`
--

INSERT INTO `cpp_detail` (`id`, `cpp_head_id`, `wo_id`, `mesin_filling_id`, `nolot`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'TB0715A', '2019-07-16 07:46:21', '2019-07-16 07:46:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpp_head`
--

CREATE TABLE `cpp_head` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `tanggal_packing` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  `analisa_kimia_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cpp_head`
--

INSERT INTO `cpp_head` (`id`, `produk_id`, `tanggal_packing`, `status`, `analisa_kimia_id`, `created_at`, `updated_at`) VALUES
(2, 35, '2019-07-15', '1', 1, '2019-07-22 07:10:58', '2019-07-21 09:58:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id` int(11) NOT NULL,
  `jenis_produk` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_produk`
--

INSERT INTO `jenis_produk` (`id`, `jenis_produk`, `created_at`, `updated_at`) VALUES
(1, 'Susu', '2019-04-26 02:30:50', '2019-04-26 02:30:50'),
(2, 'Non Susu', '2019-04-26 02:30:50', '2019-04-26 02:30:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_mesin_filling_detail`
--

CREATE TABLE `kelompok_mesin_filling_detail` (
  `id` int(11) NOT NULL,
  `kelompok_mesin_filling_head_id` int(11) NOT NULL,
  `mesin_filling_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelompok_mesin_filling_detail`
--

INSERT INTO `kelompok_mesin_filling_detail` (`id`, `kelompok_mesin_filling_head_id`, `mesin_filling_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-04-26 02:29:21', '2019-04-26 02:29:21'),
(2, 1, 2, '2019-04-26 02:29:21', '2019-04-26 02:29:21'),
(3, 2, 3, '2019-04-26 02:29:21', '2019-04-26 02:29:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_mesin_filling_head`
--

CREATE TABLE `kelompok_mesin_filling_head` (
  `id` int(11) NOT NULL,
  `nama_kelompok` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelompok_mesin_filling_head`
--

INSERT INTO `kelompok_mesin_filling_head` (`id`, `nama_kelompok`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Brix', '1', '2019-04-26 02:26:57', NULL),
(2, 'Prisma', '1', '2019-04-26 02:26:57', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_sampel_filling`
--

CREATE TABLE `kode_sampel_filling` (
  `id` int(11) NOT NULL,
  `kode_sampel` varchar(10) NOT NULL,
  `event` text NOT NULL,
  `jenis_produk_id` int(11) NOT NULL,
  `kelompok_mesin_filling_head__id` int(11) NOT NULL,
  `pi` int(11) NOT NULL,
  `mikro30` int(11) NOT NULL,
  `mikro_55` int(11) NOT NULL,
  `dissolve` int(11) NOT NULL,
  `standar` int(11) NOT NULL COMMENT 'titik tengah',
  `retain` int(11) NOT NULL,
  `wo` int(11) NOT NULL COMMENT 'nol',
  `ts_ph` int(11) NOT NULL COMMENT 'awal tengah akhir',
  `jumlah` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kode_sampel_filling`
--

INSERT INTO `kode_sampel_filling` (`id`, `kode_sampel`, `event`, `jenis_produk_id`, `kelompok_mesin_filling_head__id`, `pi`, `mikro30`, `mikro_55`, `dissolve`, `standar`, `retain`, `wo`, `ts_ph`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'A', 'start filling', 1, 1, 4, 2, 2, 4, 1, 1, 0, 2, 16, 0, 0),
(2, 'B', 'Before Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(3, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(4, 'C', 'After Paper ', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(5, 'C(SP)', 'After Paper  (Sambung Pabrik )', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(6, 'D', 'Before Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(7, 'E', 'After Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(8, 'F', 'Before Short Stop', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'F(B)', 'Before Short Stop Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(10, 'F(D)', 'Before Short Stop Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(11, 'F(H)', 'Before Short Stop CIP', 1, 1, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'F(N)', 'Before Short Stop Normal Stop', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'G', 'After Short Stop', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(14, 'G(A)', 'After Short Stop Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(15, 'G(C)', 'After Short Stop Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(16, 'G(E)', 'After Short Stop CIP', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(17, 'G(N)', 'After Short Stop Normal Stop', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(18, 'H', 'End filling', 1, 1, 4, 2, 1, 0, 0, 0, 0, 1, 8, 0, 0),
(19, 'R', 'Random QC', 1, 1, 4, 2, 0, 0, 1, 0, 0, 0, 6, 0, 0),
(20, 'R(P)', 'Random Prod', 1, 1, 3, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(21, 'R(S)', 'Random Resampling', 1, 1, 10, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0),
(22, 'A', 'start filling', 2, 1, 4, 2, 0, 4, 1, 1, 0, 2, 14, 0, 0),
(23, 'B', 'Before Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(24, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(25, 'C', 'After Paper ', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(26, 'C(SP)', 'After Paper  (Sambung Pabrik )', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(27, 'D', 'Before Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(28, 'E', 'After Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(29, 'F', 'Before Short Stop', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 'F(B)', 'Before Short Stop Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(31, 'F(D)', 'Before Short Stop Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(32, 'F(H)', 'Before Short Stop CIP', 2, 1, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(33, 'F(N)', 'Before Short Stop Normal Stop', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(34, 'G', 'After Short Stop', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(35, 'G(A)', 'After Short Stop Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(36, 'G(C)', 'After Short Stop Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(37, 'G(E)', 'After Short Stop CIP', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(38, 'G(N)', 'After Short Stop Normal Stop', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(39, 'H', 'End filling', 2, 1, 4, 2, 0, 0, 0, 0, 0, 1, 7, 0, 0),
(40, 'R', 'Random QC', 2, 1, 4, 2, 0, 0, 1, 0, 0, 0, 6, 0, 0),
(41, 'R(P)', 'Random Prod', 2, 1, 3, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(42, 'R(S)', 'Random Resampling', 2, 1, 10, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0),
(43, 'A', 'start filling', 1, 2, 4, 2, 2, 4, 1, 1, 0, 2, 16, 0, 0),
(44, 'B', 'Before Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(45, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(46, 'C', 'After Paper ', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(47, 'C(SP)', 'After Paper  (Sambung Pabrik )', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(48, 'D', 'Before Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(49, 'E', 'After Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(50, 'F', 'Before Short Stop', 1, 2, 2, 2, 0, 0, 0, 0, 0, 0, 4, 0, 0),
(51, 'F(B)', 'Before Short Stop Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(52, 'F(D)', 'Before Short Stop Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(53, 'F(H)', 'Before Short Stop CIP', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(54, 'F(N)', 'Before Short Stop Normal Stop', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(55, 'G', 'After Short Stop', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(56, 'G(A)', 'After Short Stop Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(57, 'G(C)', 'After Short Stop Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(58, 'G(E)', 'After Short Stop CIP', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(59, 'G(N)', 'After Short Stop Normal Stop', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(60, 'H', 'End filling', 1, 2, 4, 2, 1, 0, 0, 0, 0, 1, 8, 0, 0),
(61, 'R', 'Random QC', 1, 2, 4, 2, 0, 0, 1, 0, 0, 0, 6, 0, 0),
(62, 'R(P)', 'Random Prod', 1, 2, 3, 2, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(63, 'R(S)', 'Random Resampling', 1, 2, 10, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0),
(64, 'A', 'start filling', 2, 2, 4, 2, 0, 4, 1, 1, 0, 2, 14, 0, 0),
(65, 'B', 'Before Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(66, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(67, 'C', 'After Paper ', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(68, 'C(SP)', 'After Paper  (Sambung Pabrik )', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(69, 'D', 'Before Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(70, 'E', 'After Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(71, 'F', 'Before Short Stop', 2, 2, 2, 2, 0, 0, 0, 0, 0, 0, 4, 0, 0),
(72, 'F(B)', 'Before Short Stop Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(73, 'F(D)', 'Before Short Stop Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(74, 'F(H)', 'Before Short Stop CIP', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(75, 'F(N)', 'Before Short Stop Normal Stop', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(76, 'G', 'After Short Stop', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(77, 'G(A)', 'After Short Stop Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(78, 'G(C)', 'After Short Stop Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(79, 'G(E)', 'After Short Stop CIP', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(80, 'G(N)', 'After Short Stop Normal Stop', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(81, 'H', 'End filling', 2, 2, 4, 2, 0, 0, 0, 0, 0, 1, 7, 0, 0),
(82, 'R', 'Random QC', 2, 2, 4, 2, 0, 0, 1, 0, 0, 0, 6, 0, 0),
(83, 'R(P)', 'Random Prod', 2, 2, 3, 2, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(84, 'R(S)', 'Random Resampling', 2, 2, 10, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mesin_filling`
--

CREATE TABLE `mesin_filling` (
  `id` int(11) NOT NULL,
  `nama_mesin` varchar(30) NOT NULL,
  `kode_mesin` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mesin_filling`
--

INSERT INTO `mesin_filling` (`id`, `nama_mesin`, `kode_mesin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TBA', 'TBA C', '1', '2019-04-26 02:25:01', '2019-04-26 02:25:01'),
(2, 'A3', 'A3CF B', '1', '2019-04-26 02:25:01', '2019-04-26 02:25:01'),
(3, 'TPA', 'TPA A', '1', '2019-04-26 02:25:01', '2019-04-26 02:25:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `palet`
--

CREATE TABLE `palet` (
  `id` int(11) NOT NULL,
  `cpp_detail_id` int(11) NOT NULL,
  `palet` varchar(5) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `jumlah_box` int(11) DEFAULT NULL,
  `jumlah_pack` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `palet`
--

INSERT INTO `palet` (`id`, `cpp_detail_id`, `palet`, `start`, `end`, `jumlah_box`, `jumlah_pack`, `created_at`, `updated_at`) VALUES
(1, 1, 'P01', '2019-07-15 23:53:10', '2019-07-16 00:12:30', 119, 2856, '2019-07-16 07:46:21', '2019-07-16 08:05:20'),
(2, 1, 'P02', '2019-07-16 00:12:30', '2019-07-16 00:31:49', 119, 2856, '2019-07-16 07:47:49', '2019-07-16 08:05:23'),
(3, 1, 'P03', '2019-07-16 00:31:49', '2019-07-16 00:51:52', 119, 2856, '2019-07-16 08:03:05', '2019-07-16 08:05:27'),
(4, 1, 'P04', '2019-07-16 00:51:52', '2019-07-16 01:10:34', 119, 2856, '2019-07-16 08:03:16', '2019-07-22 06:29:46'),
(5, 1, 'P05', '2019-07-16 01:10:34', '2019-07-16 01:29:47', 119, 2856, '2019-07-16 08:03:17', '2019-07-22 06:29:49'),
(6, 1, 'P06', '2019-07-16 01:29:47', '2019-07-16 01:31:15', 9, 216, '2019-07-16 08:03:19', '2019-07-22 06:29:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `palet_ppq`
--

CREATE TABLE `palet_ppq` (
  `id` int(11) NOT NULL,
  `palet_id` int(11) NOT NULL,
  `ppq_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `palet_ppq`
--

INSERT INTO `palet_ppq` (`id`, `palet_id`, `ppq_id`, `created_at`, `updated_at`) VALUES
(10, 4, 1, '2019-07-22 06:30:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `plan`
--

INSERT INTO `plan` (`id`, `plan`, `company_id`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PT. Nutrifood Plant Sentul', 1, 'sentul', '1', '2019-04-26 02:17:12', '2019-04-26 02:17:12'),
(2, 'PT. Nutrifood Plant Ciawi', 1, 'ciawi', '1', '2019-04-26 02:17:12', '2019-04-26 02:17:12'),
(3, 'PT. Nutrifood Plant Cibitung', 1, 'cibitung', '1', '2019-04-26 02:17:12', '2019-04-26 02:17:12'),
(4, 'PT. Nutrifood Indonesia Head Office', 1, 'jakarta', '1', '2019-04-26 02:17:12', '2019-04-26 02:17:12'),
(5, 'PT. Heavenly Blush Sentul', 2, 'sentul', '1', '2019-04-26 02:17:12', '2019-04-26 02:17:12'),
(6, 'PT. Heavenly Nutrition Head Office', 2, 'jakarta', '1', '2019-04-26 02:17:12', '2019-04-26 02:17:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppq`
--

CREATE TABLE `ppq` (
  `id` int(11) NOT NULL,
  `nomor_ppq` varchar(30) NOT NULL,
  `tanggal_ppq` date NOT NULL,
  `jam_awal_ppq` datetime NOT NULL,
  `jam_akhir_ppq` datetime NOT NULL,
  `jumlah_pack` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `jenis_ppq` enum('0','1','2','3') NOT NULL COMMENT '0 = Kimia , 1 =  Mikro , 2 = Sortasi Gudang , 3 = Package Integrity',
  `kategori_ppq` enum('0','1','2','3','4','5','6','7') NOT NULL COMMENT '0 = Man , 1 = machine , 2 = method , 3 = material , 4= enviroment , 5 = sortasi , 6 = miss handling , 7 = dan lain lain',
  `user_inputer_id` int(11) NOT NULL,
  `status_akhir` enum('0','1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ppq`
--

INSERT INTO `ppq` (`id`, `nomor_ppq`, `tanggal_ppq`, `jam_awal_ppq`, `jam_akhir_ppq`, `jumlah_pack`, `alasan`, `jenis_ppq`, `kategori_ppq`, `user_inputer_id`, `status_akhir`, `created_at`, `updated_at`) VALUES
(1, '001/PPQ/VII/2019', '2019-07-18', '2019-07-16 00:58:06', '2019-07-16 01:10:53', 2500, 'Ini percobaan ppq loh', '3', '1', 1, '0', '2019-07-18 08:12:29', '2019-07-18 08:12:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `sub_brand_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kode_oracle` varchar(30) NOT NULL,
  `spek_ts_min` double(8,2) NOT NULL,
  `spek_ts_max` double(8,2) NOT NULL,
  `spek_ph_min` double(8,2) NOT NULL,
  `spek_ph_max` double(8,2) NOT NULL,
  `sla` int(2) NOT NULL COMMENT 'dalam hari',
  `waktu_analisa_mikro` int(2) NOT NULL COMMENT 'dalam hari',
  `kelompok_mesin_filling_head_id` int(11) NOT NULL,
  `jenis_produk_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `kode_trial` varchar(50) NOT NULL,
  `expired_range` int(2) NOT NULL COMMENT 'dalam bulan',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `sub_brand_id`, `nama_produk`, `kode_oracle`, `spek_ts_min`, `spek_ts_max`, `spek_ph_min`, `spek_ph_max`, `sla`, `waktu_analisa_mikro`, `kelompok_mesin_filling_head_id`, `jenis_produk_id`, `status`, `kode_trial`, `expired_range`, `created_at`, `updated_at`) VALUES
(1, 2, 'HB YOGURT DRINK BLACKCURRANT 24PX200ML', '7300651', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-BC', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(2, 2, 'HB YOGURT DRINK PEACH 24PX200ML', '7300451', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-PC', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(3, 2, 'HB YOGURT DRINK PEACH 24PX200ML PROMO GUNDAM', '7300451250', 14.50, 15.30, 4.35, 4.40, 5, 4, 2, 1, '1', 'HB-YD-PC-G', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(4, 2, 'HB GREEK CLASSIC 24PX200ML', '7300861', 14.50, 16.00, 4.15, 4.25, 8, 5, 2, 1, '1', 'HB-GR-GR', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(5, 2, 'HB YO YOGURT DRINK KIDS BANANA BERRIES BROCCOLI 24', '7300371', 17.25, 18.50, 4.35, 4.40, 5, 4, 2, 1, '1', 'HB-YO-BB', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(6, 2, 'HB YO YOGURT DRINK KIDS MANGO CARROT 24PX200ML', '7300351', 17.25, 18.50, 4.35, 4.50, 5, 4, 2, 1, '1', 'HB-YO-MC', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(7, 2, 'HB YOGURT DRINK LYCHEE SPINACH 24PX200ML', '7300751', 17.25, 18.50, 4.25, 4.35, 5, 4, 2, 1, '1', 'HB-YO-LS', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(8, 2, 'HB YOGURT DRINK RASPBERRY PUMPKIN 24PX200ML', '7300721', 17.25, 18.50, 4.25, 4.35, 5, 4, 2, 1, '1', 'HB-YO-RP', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(9, 2, 'HB YOGURT DRINK WHOLESOME ORIGINAL 24PX200ML', '7300851', 14.00, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-WH', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(10, 2, 'HB YOGURT DRINK WHOLESOME ORIGINAL 24PX200ML PROMO', '7300851250', 14.00, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-WH-G', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(11, 2, 'HB YOGURT DRINK STRAWBERRY 24PX200ML', '7300281', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-ST', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(12, 2, 'HB YOGURT DRINK STRAWBERRY 24PX200ML PROMO GUNDAM', '7300281250', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-ST-G', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(13, 1, 'HILO SCHOOL RTD COKLAT 24PX200ML', '2101492', 15.00, 16.00, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-SC-CO', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(14, 1, 'HILO SCHOOL RTD VEGIBERI 24PX200ML', '21014281', 13.50, 14.50, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-SC-VE', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(15, 1, 'HILO SCHOOL RTD VEGIBERI 4BNDX6PX200ML CAMBODIA', '5101428160KH', 13.50, 14.50, 6.60, 14.00, 4, 3, 1, 1, '1', '-', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(16, 1, 'HILO TEEN RTD COKLAT 4BNDX6PX200ML CAMBODIA', '5101461600KH', 15.00, 16.00, 6.60, 14.00, 4, 3, 1, 1, '1', '-', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(17, 1, 'HILO TEEN RTD COFFEE TIRAMISU 24PX200ML', '2101656', 14.40, 15.40, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-TE-TI', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(18, 4, 'L-MEN HIPROTEIN 2 GO RTD CHOCOLATE 12DX2PX200ML', '2307061', 11.80, 12.20, 6.60, 14.00, 4, 3, 1, 1, '1', '-', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(19, 4, 'L-MEN RTD HIGH PROTEIN 2GO CHOCOLATE 24PX200ML', '2307061250', 14.40, 15.20, 6.60, 14.00, 4, 3, 1, 1, '1', 'LM-OT-CO', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(20, 1, 'HILO TEEN RTD COKLAT 200ML', '2101461', 15.00, 16.00, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-TE-CO', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(21, 3, 'WRP RTD CHOCOLATE 12Dx400ML', '2205061', 17.50, 18.50, 6.50, 4.00, 4, 3, 1, 1, '1', '-', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(22, 3, 'WRP RTD CHOCOLATE 12DX400ML MALDIVES', '5205061MV', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', '-', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(23, 3, 'WRP ON THE GO CHOCOLATE 24PX200ML', '2205051', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', 'WR-OT-CO', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(24, 3, 'WRP ON THE GO COFFEE 24PX200ML', '2205050', 17.50, 18.50, 6.30, 14.00, 4, 3, 1, 1, '1', 'WR-OT-CF', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(25, 3, 'WRP ON THE GO STRAWBERRY 24PX200ML', '22050281', 17.50, 18.50, 6.30, 14.00, 4, 3, 1, 1, '1', 'WR-OT-ST', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(26, 3, 'WRP RTD ON THE GO ORIGINAL 24Px200ML', '2205000', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', 'WR-OT-OR', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(27, 2, 'HB YOGURT DRINK BLACKCURRANT 24PX200ML PROMO GUNDA', '7300651250', 15.30, 14.50, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-BC-G', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(28, 3, 'WRP ON THE GO ORIGINAL 24PX200ML', '2205000', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', 'WR-OT-OR', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(29, 5, 'NS RTD JERUK MADU 24PX200ML', '1101182250', 8.00, 9.00, 3.60, 3.90, 19, 15, 1, 1, '1', 'NS-RT-JM', 12, '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(30, 6, 'YOBASE LOW FAT HB YOGURT ORIGINAL', '7200004', 12.00, 12.50, 6.40, 6.55, 0, 0, 0, 1, '1', 'HB-YB-OR', 12, '2019-04-29 06:09:50', '0000-00-00 00:00:00'),
(31, 6, 'YOBASE LOW FAT HB YOGURT', '7200000', 12.00, 12.50, 6.40, 6.55, 0, 0, 0, 1, '1', 'HB-YB-LF', 12, '2019-04-29 06:09:50', '0000-00-00 00:00:00'),
(32, 6, 'COMPOUND YOBASE HB YO', '7200002', 12.00, 12.50, 6.50, 6.55, 0, 0, 0, 1, '1', 'HB-YB-YO', 12, '2019-04-29 06:11:43', '0000-00-00 00:00:00'),
(33, 2, 'MIXING HB YOGURT DRINK LYCHEE SPINACH KOMA', '7300751K', 17.25, 18.50, 4.25, 4.35, 5, 4, 2, 1, '1', 'LY-SP-KO', 12, '2019-07-01 01:31:08', '2019-07-01 01:31:08'),
(34, 2, 'MIXING HB YOGURT DRINK RASPBERRY PUMPKIN 200ML KOMA', '7300721K', 17.25, 18.50, 4.25, 4.35, 5, 4, 2, 1, '1', 'LY-SP-KO', 12, '2019-07-01 01:33:28', '2019-07-01 01:33:28'),
(35, 1, 'Hilo RTD Chocolate Taro 200 ml', '2101809250', 10.60, 11.00, 6.80, 7.70, 4, 3, 1, 1, '1', 'HL-CH-TA', 12, '2019-07-01 01:37:16', '2019-07-01 01:37:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rpd_filling_detail_at_event`
--

CREATE TABLE `rpd_filling_detail_at_event` (
  `id` int(11) NOT NULL,
  `rpd_filling_head_id` int(11) NOT NULL,
  `wo_id` int(11) NOT NULL,
  `tanggal_filling` date NOT NULL,
  `jam_filling` time NOT NULL,
  `mesin_filling_id` int(11) NOT NULL,
  `kode_sampel_id` int(11) NOT NULL,
  `ls_sa_sealing_quality` enum('OK','#OK','-') DEFAULT NULL,
  `ls_sa_proportion` varchar(5) DEFAULT NULL,
  `sideway_sealing_alignment` double(4,2) DEFAULT NULL,
  `overlap` double(5,2) DEFAULT NULL,
  `package_length` double(6,2) DEFAULT NULL,
  `paper_splice_sealing_quality` enum('OK','#OK','-') DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `no_md` varchar(50) DEFAULT NULL,
  `ls_sa_sealing_quality_strip` enum('OK','#OK','-') DEFAULT NULL,
  `ls_short_stop_quality` enum('OK','#OK','-') DEFAULT NULL,
  `sa_short_stop_quality` enum('OK','#OK','-') DEFAULT NULL,
  `status_akhir` enum('OK','#OK') DEFAULT NULL,
  `keterangan` text,
  `palet_id` int(11) NOT NULL,
  `user_id_inputer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rpd_filling_detail_at_event`
--

INSERT INTO `rpd_filling_detail_at_event` (`id`, `rpd_filling_head_id`, `wo_id`, `tanggal_filling`, `jam_filling`, `mesin_filling_id`, `kode_sampel_id`, `ls_sa_sealing_quality`, `ls_sa_proportion`, `sideway_sealing_alignment`, `overlap`, `package_length`, `paper_splice_sealing_quality`, `no_kk`, `no_md`, `ls_sa_sealing_quality_strip`, `ls_short_stop_quality`, `sa_short_stop_quality`, `status_akhir`, `keterangan`, `palet_id`, `user_id_inputer`, `created_at`, `updated_at`) VALUES
(3, 1, 2, '2019-07-16', '00:36:46', 2, 2, 'OK', '30:70', 1.22, 16.20, 117.66, 'OK', NULL, NULL, NULL, NULL, NULL, '#OK', NULL, 3, 24, '2019-07-17 07:12:22', '2019-07-17 07:12:22'),
(4, 1, 2, '2019-07-16', '00:58:06', 2, 6, 'OK', '30:70', NULL, NULL, NULL, NULL, NULL, NULL, 'OK', NULL, NULL, 'OK', NULL, 4, 24, '2019-07-18 07:46:12', '2019-07-18 07:46:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rpd_filling_detail_pi`
--

CREATE TABLE `rpd_filling_detail_pi` (
  `id` int(11) NOT NULL,
  `rpd_filling_head_id` int(11) NOT NULL,
  `wo_id` int(11) NOT NULL,
  `tanggal_filling` date NOT NULL,
  `jam_filling` time NOT NULL,
  `mesin_filling_id` int(11) NOT NULL,
  `kode_sampel_id` int(11) NOT NULL,
  `berat_kanan` decimal(6,2) NOT NULL,
  `berat_kiri` decimal(6,2) NOT NULL,
  `overlap` decimal(4,2) DEFAULT NULL,
  `ls_sa_proportion` varchar(10) DEFAULT NULL,
  `volume_kanan` int(11) DEFAULT NULL,
  `volume_kiri` int(11) DEFAULT NULL,
  `airgap` enum('OK','#OK','-') DEFAULT NULL,
  `ts_accurate_kanan` varchar(100) DEFAULT NULL,
  `ts_accurate_kiri` varchar(100) DEFAULT NULL,
  `ls_accurate` varchar(100) DEFAULT NULL,
  `sa_accurate` varchar(100) DEFAULT NULL,
  `surface_check` varchar(100) DEFAULT NULL,
  `pinching` enum('OK','#OK','-') DEFAULT NULL,
  `strip_folding` enum('OK','#OK','-') DEFAULT NULL,
  `konduktivity_kanan` enum('OK','#OK','-') DEFAULT NULL,
  `konduktivity_kiri` enum('OK','#OK','-') DEFAULT NULL,
  `design_kanan` enum('OK','#OK','-') DEFAULT NULL,
  `design_kiri` enum('OK','#OK','-') DEFAULT NULL,
  `dye_test` enum('OK','#OK','-') DEFAULT NULL,
  `residu_h2o2` enum('OK','#OK','-') DEFAULT NULL,
  `prod_code_and_no_md` enum('OK','#OK','-') DEFAULT NULL,
  `correction` text,
  `status_akhir` enum('OK','#OK') DEFAULT NULL,
  `dissolving_test` enum('OK','#OK','-') DEFAULT NULL,
  `user_id_inputer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rpd_filling_detail_pi`
--

INSERT INTO `rpd_filling_detail_pi` (`id`, `rpd_filling_head_id`, `wo_id`, `tanggal_filling`, `jam_filling`, `mesin_filling_id`, `kode_sampel_id`, `berat_kanan`, `berat_kiri`, `overlap`, `ls_sa_proportion`, `volume_kanan`, `volume_kiri`, `airgap`, `ts_accurate_kanan`, `ts_accurate_kiri`, `ls_accurate`, `sa_accurate`, `surface_check`, `pinching`, `strip_folding`, `konduktivity_kanan`, `konduktivity_kiri`, `design_kanan`, `design_kiri`, `dye_test`, `residu_h2o2`, `prod_code_and_no_md`, `correction`, `status_akhir`, `dissolving_test`, `user_id_inputer`, `created_at`, `updated_at`) VALUES
(3, 1, 2, '2019-07-15', '23:53:14', 2, 1, '222.58', '222.03', '4.33', '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:13:43', '2019-07-17 02:12:55'),
(4, 1, 2, '2019-07-16', '00:10:14', 2, 20, '222.19', '222.57', '4.34', '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:20:00', '2019-07-17 06:40:26'),
(5, 1, 2, '2019-07-16', '00:25:50', 2, 19, '221.86', '222.71', '4.37', '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:20:58', '2019-07-17 07:02:21'),
(6, 1, 2, '2019-07-16', '00:36:46', 2, 2, '220.82', '221.29', '4.31', '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 08:54:34', '2019-07-18 03:39:48'),
(7, 1, 2, '2019-07-16', '00:36:54', 2, 4, '221.34', '220.83', '4.02', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:25:24', '2019-07-18 03:40:20'),
(8, 1, 2, '2019-07-16', '00:40:34', 2, 20, '221.86', '222.69', '4.17', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:34:28', '2019-07-18 03:41:15'),
(9, 1, 2, '2019-07-16', '00:55:00', 2, 19, '222.17', '221.80', '4.24', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:35:03', '2019-07-18 03:46:56'),
(10, 1, 2, '2019-07-16', '00:58:06', 2, 6, '222.44', '221.89', '4.11', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 08:55:40', '2019-07-18 06:39:36'),
(11, 1, 2, '2019-07-16', '00:58:12', 2, 7, '221.46', '222.42', '4.19', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', '#OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'Strip wringkle', '#OK', NULL, 24, '2019-07-16 07:36:31', '2019-07-18 07:52:31'),
(12, 1, 2, '2019-07-16', '01:10:53', 2, 20, '222.77', '222.05', '4.16', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:37:08', '2019-07-18 07:58:20'),
(13, 1, 2, '2019-07-16', '01:25:14', 2, 19, '221.54', '222.58', '4.12', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:37:49', '2019-07-18 08:33:46'),
(14, 1, 2, '2019-07-16', '01:31:18', 2, 18, '221.76', '221.10', '4.13', '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', 'OK', NULL, 24, '2019-07-16 07:38:19', '2019-07-18 08:34:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rpd_filling_head`
--

CREATE TABLE `rpd_filling_head` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `start_filling` date NOT NULL,
  `status` enum('1','2') NOT NULL COMMENT '1= On Progress, 2=Done',
  `sensori_awal` enum('0','1') NOT NULL COMMENT '0 =  OK , 1 = #OK',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rpd_filling_head`
--

INSERT INTO `rpd_filling_head` (`id`, `produk_id`, `start_filling`, `status`, `sensori_awal`, `created_at`, `updated_at`) VALUES
(1, 35, '2019-07-16', '2', '0', '2019-07-15 04:29:09', '2019-07-18 08:34:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_brand`
--

CREATE TABLE `sub_brand` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `sub_brand` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_brand`
--

INSERT INTO `sub_brand` (`id`, `brand_id`, `sub_brand`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'HiLo', '1', '2019-04-26 02:23:01', '2019-04-26 02:23:01'),
(2, 2, 'HB', '1', '2019-04-26 02:23:01', '2019-04-26 02:23:01'),
(3, 3, 'WRP', '1', '2019-04-26 02:23:01', '2019-04-26 02:23:01'),
(4, 1, 'L-Men', '1', '2019-04-26 02:23:01', '2019-04-26 02:23:01'),
(5, 1, 'Nutrisari', '1', '2019-04-26 02:23:01', '2019-04-26 02:23:01'),
(6, 2, 'Yobase', '1', '2019-07-01 00:57:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wo`
--

CREATE TABLE `wo` (
  `id` int(11) NOT NULL,
  `nomor_wo` varchar(30) NOT NULL,
  `produk_id` int(11) NOT NULL COMMENT 'Terhubung Ke Tabel Produk',
  `plan_id` int(11) NOT NULL COMMENT 'Terhubung ke table plan',
  `production_plan_date` date NOT NULL,
  `production_realisation_date` date DEFAULT NULL,
  `tanggal_fillpack` date DEFAULT NULL,
  `plan_batch_size` varchar(20) NOT NULL,
  `actual_batch_size` varchar(20) DEFAULT NULL COMMENT 'batch size',
  `status` enum('0','1','2','3','4','5','6') NOT NULL COMMENT '0 = Pending ( WIP Mixing ), 1 = On Progress Mixing , 2 = WIP Fillpack , 3 = In Progress Fillpack , 4 = Done Fillpack ( Waiting For Close ) , 5. Closed, 6 = Canceled ',
  `completion_date` datetime DEFAULT NULL,
  `keterangan_1` text,
  `keterangan_2` text COMMENT 'alasan_batal',
  `keterangan_3` text,
  `revisi_formula` text NOT NULL,
  `rpd_filling_head_id` int(11) DEFAULT NULL,
  `cpp_head_id` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wo`
--

INSERT INTO `wo` (`id`, `nomor_wo`, `produk_id`, `plan_id`, `production_plan_date`, `production_realisation_date`, `tanggal_fillpack`, `plan_batch_size`, `actual_batch_size`, `status`, `completion_date`, `keterangan_1`, `keterangan_2`, `keterangan_3`, `revisi_formula`, `rpd_filling_head_id`, `cpp_head_id`, `expired_date`, `created_at`, `updated_at`) VALUES
(1, 'G1905214027', 13, 3, '2019-07-08', NULL, NULL, '9956.576', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AK/34.44)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(2, 'G1905218001', 35, 3, '2019-07-08', '2019-07-15', '2019-07-15', '14569.107', NULL, '4', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD CHOCOLATE TARO 200 ML ( AA/34.55)', 1, 2, '2020-07-15', '2019-07-15 04:16:45', '2019-07-18 08:39:52'),
(3, 'G1905700024', 30, 3, '2019-07-08', NULL, NULL, '6625.33', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ORIGINAL (1.0)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(4, 'G1905700025', 30, 3, '2019-07-08', NULL, NULL, '6625.33', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ORIGINAL (1.0)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(5, 'G1907703001', 6, 3, '2019-07-08', NULL, NULL, '9730.5249', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HEAVENLY BLUSH YOGURT MANGO CARROT (1.9)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(6, 'G1907703002', 5, 3, '2019-07-08', NULL, NULL, '9731.3811', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HEAVENLY BLUSH YOGURT BANANA BERRIES BROCCOLI (2.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(7, 'G1905708014', 10, 3, '2019-07-08', NULL, NULL, '7886.19', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT DRINK WHOLESOME ORIGINAL (1.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(8, 'G1905708015', 10, 3, '2019-07-08', NULL, NULL, '6660', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT DRINK WHOLESOME ORIGINAL (1.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(9, 'G1906708005', 4, 3, '2019-07-08', '2019-07-10', '2019-07-15', '5887.11', NULL, '0', '2019-07-15 11:40:51', '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 200ML (0.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', '2019-07-15 04:30:16'),
(10, 'G1905700023', 31, 3, '2019-07-09', NULL, NULL, '2240.11', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT (3.3)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(11, 'G1905708012', 4, 3, '2019-07-09', NULL, NULL, '5887.11', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 200ML (0.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(12, 'G1905708013', 4, 3, '2019-07-09', NULL, NULL, '5887.11', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 200ML (0.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(13, '139STTHNIVII19/HB-GR-GR', 4, 3, '2019-07-09', NULL, NULL, '', NULL, '0', NULL, '-', '-', '-', '-', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(14, 'G1905700022', 31, 3, '2019-07-10', NULL, NULL, '2240.11', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT (3.3)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(15, 'G1905700026', 31, 3, '2019-07-10', NULL, NULL, '2240.11', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT (3.3)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(16, 'G1905700027', 31, 3, '2019-07-10', NULL, NULL, '2240.11', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT (3.3)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(17, 'G1905700030', 31, 3, '2019-07-10', NULL, NULL, '2222.45', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT (3.3)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(18, 'G1905702013', 11, 3, '2019-07-10', NULL, NULL, '10084.12', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT STRAWBERRY (4.5)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(19, 'G1905704002', 3, 3, '2019-07-10', NULL, NULL, '10086.052', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT DRINK PEACH (2.3)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(20, 'G1905706011', 1, 3, '2019-07-10', NULL, NULL, '10048.24', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT DRINK BLACKCURRANT (2.7)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(21, 'G1905706012', 1, 3, '2019-07-10', NULL, NULL, '10048.24', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT DRINK BLACKCURRANT (2.7)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(22, 'G1905706013', 1, 3, '2019-07-10', NULL, NULL, '10048.24', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT DRINK BLACKCURRANT (2.7)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(23, 'G1907214001', 20, 3, '2019-07-11', NULL, NULL, '9969.252', NULL, '0', NULL, '-', '-', '-', '-', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(24, 'G1905702014', 11, 3, '2019-07-11', NULL, NULL, '10084.12', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT STRAWBERRY (4.5)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(25, 'G1905708018', 4, 3, '2019-07-11', NULL, NULL, '5887.11', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 200ML (0.2)', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL),
(26, 'G1905214022', 20, 3, '2019-07-12', NULL, NULL, '9969.252', NULL, '0', NULL, '-', '-', '-', '-', NULL, NULL, NULL, '2019-07-15 04:16:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `analisa_kimia`
--
ALTER TABLE `analisa_kimia`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `analisa_mikro`
--
ALTER TABLE `analisa_mikro`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `analisa_mikro_detail`
--
ALTER TABLE `analisa_mikro_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cpp_detail`
--
ALTER TABLE `cpp_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cpp_head`
--
ALTER TABLE `cpp_head`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompok_mesin_filling_detail`
--
ALTER TABLE `kelompok_mesin_filling_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompok_mesin_filling_head`
--
ALTER TABLE `kelompok_mesin_filling_head`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kode_sampel_filling`
--
ALTER TABLE `kode_sampel_filling`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mesin_filling`
--
ALTER TABLE `mesin_filling`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `palet`
--
ALTER TABLE `palet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `palet_ppq`
--
ALTER TABLE `palet_ppq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppq`
--
ALTER TABLE `ppq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rpd_filling_detail_at_event`
--
ALTER TABLE `rpd_filling_detail_at_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rpd_filling_detail_pi`
--
ALTER TABLE `rpd_filling_detail_pi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rpd_filling_head`
--
ALTER TABLE `rpd_filling_head`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sub_brand`
--
ALTER TABLE `sub_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wo`
--
ALTER TABLE `wo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `analisa_kimia`
--
ALTER TABLE `analisa_kimia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `analisa_mikro`
--
ALTER TABLE `analisa_mikro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `analisa_mikro_detail`
--
ALTER TABLE `analisa_mikro_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cpp_detail`
--
ALTER TABLE `cpp_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cpp_head`
--
ALTER TABLE `cpp_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelompok_mesin_filling_detail`
--
ALTER TABLE `kelompok_mesin_filling_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelompok_mesin_filling_head`
--
ALTER TABLE `kelompok_mesin_filling_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kode_sampel_filling`
--
ALTER TABLE `kode_sampel_filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `mesin_filling`
--
ALTER TABLE `mesin_filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `palet`
--
ALTER TABLE `palet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `palet_ppq`
--
ALTER TABLE `palet_ppq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ppq`
--
ALTER TABLE `ppq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_detail_at_event`
--
ALTER TABLE `rpd_filling_detail_at_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_detail_pi`
--
ALTER TABLE `rpd_filling_detail_pi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_head`
--
ALTER TABLE `rpd_filling_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sub_brand`
--
ALTER TABLE `sub_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `wo`
--
ALTER TABLE `wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
