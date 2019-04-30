-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2019 pada 11.03
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
-- Struktur dari tabel `cpp`
--

CREATE TABLE `cpp` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah_batch` varchar(2) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `tanggal_fillpack` date NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Struktur dari tabel `lot`
--

CREATE TABLE `lot` (
  `id` int(11) NOT NULL,
  `wo_id` int(11) NOT NULL,
  `mesin_filling_id` int(11) NOT NULL,
  `nomor_lot` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `lot_id` int(11) NOT NULL,
  `palet` varchar(10) NOT NULL,
  `palet_start` datetime NOT NULL,
  `palet_end` datetime NOT NULL,
  `jumlah_box` int(10) NOT NULL,
  `jumlah_pak` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `sub_brand_id` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `sub_brand_id`, `nama_produk`, `kode_oracle`, `spek_ts_min`, `spek_ts_max`, `spek_ph_min`, `spek_ph_max`, `sla`, `waktu_analisa_mikro`, `kelompok_mesin_filling_head_id`, `jenis_produk_id`, `status`, `kode_trial`, `created_at`, `updated_at`) VALUES
(1, 2, 'HB YOGURT DRINK BLACKCURRANT 24PX200ML', '7300651', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-BC', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(2, 2, 'HB YOGURT DRINK PEACH 24PX200ML', '7300451', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-PC', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(3, 2, 'HB YOGURT DRINK PEACH 24PX200ML PROMO GUNDAM', '7300451250', 14.50, 15.30, 4.35, 4.40, 5, 4, 2, 1, '1', 'HB-YD-PC-G', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(4, 2, 'HB GREEK CLASSIC 24PX200ML', '7300861', 14.50, 16.00, 4.15, 4.25, 8, 5, 2, 1, '1', 'HB-GR-GR', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(5, 2, 'HB YO YOGURT DRINK KIDS BANANA BERRIES BROCCOLI 24', '7300371', 17.25, 18.50, 4.35, 4.40, 5, 4, 2, 1, '1', 'HB-YO-BB', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(6, 2, 'HB YO YOGURT DRINK KIDS MANGO CARROT 24PX200ML', '7300351', 17.25, 18.50, 4.35, 4.50, 5, 4, 2, 1, '1', 'HB-YO-MC', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(7, 2, 'HB YOGURT DRINK LYCHEE SPINACH 24PX200ML', '7300751', 17.25, 18.50, 4.25, 4.35, 5, 4, 2, 1, '1', 'HB-YO-LS', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(8, 2, 'HB YOGURT DRINK RASPBERRY PUMPKIN 24PX200ML', '7300721', 17.25, 18.50, 4.25, 4.35, 5, 4, 2, 1, '1', 'HB-YO-RP', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(9, 2, 'HB YOGURT DRINK WHOLESOME ORIGINAL 24PX200ML', '7300851', 14.00, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-WH', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(10, 2, 'HB YOGURT DRINK WHOLESOME ORIGINAL 24PX200ML PROMO', '7300851250', 14.00, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-WH-G', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(11, 2, 'HB YOGURT DRINK STRAWBERRY 24PX200ML', '7300281', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-ST', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(12, 2, 'HB YOGURT DRINK STRAWBERRY 24PX200ML PROMO GUNDAM', '7300281250', 14.50, 15.30, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-ST-G', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(13, 1, 'HILO SCHOOL RTD COKLAT 24PX200ML', '2101492', 15.00, 16.00, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-SC-CO', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(14, 1, 'HILO SCHOOL RTD VEGIBERI 24PX200ML', '21014281', 13.50, 14.50, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-SC-VE', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(15, 1, 'HILO SCHOOL RTD VEGIBERI 4BNDX6PX200ML CAMBODIA', '5101428160KH', 13.50, 14.50, 6.60, 14.00, 4, 3, 1, 1, '1', '-', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(16, 1, 'HILO TEEN RTD COKLAT 4BNDX6PX200ML CAMBODIA', '5101461600KH', 15.00, 16.00, 6.60, 14.00, 4, 3, 1, 1, '1', '-', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(17, 1, 'HILO TEEN RTD COFFEE TIRAMISU 24PX200ML', '2101656', 14.40, 15.40, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-TE-TI', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(18, 4, 'L-MEN HIPROTEIN 2 GO RTD CHOCOLATE 12DX2PX200ML', '2307061', 11.80, 12.20, 6.60, 14.00, 4, 3, 1, 1, '1', '-', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(19, 4, 'L-MEN RTD HIGH PROTEIN 2GO CHOCOLATE 24PX200ML', '2307061250', 14.40, 15.20, 6.60, 14.00, 4, 3, 1, 1, '1', 'LM-OT-CO', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(20, 1, 'HILO TEEN RTD COKLAT 200ML', '2101461', 15.00, 16.00, 6.60, 14.00, 4, 3, 1, 1, '1', 'HL-TE-CO', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(21, 3, 'WRP RTD CHOCOLATE 12Dx400ML', '2205061', 17.50, 18.50, 6.50, 4.00, 4, 3, 1, 1, '1', '-', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(22, 3, 'WRP RTD CHOCOLATE 12DX400ML MALDIVES', '5205061MV', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', '-', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(23, 3, 'WRP ON THE GO CHOCOLATE 24PX200ML', '2205051', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', 'WR-OT-CO', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(24, 3, 'WRP ON THE GO COFFEE 24PX200ML', '2205050', 17.50, 18.50, 6.30, 14.00, 4, 3, 1, 1, '1', 'WR-OT-CF', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(25, 3, 'WRP ON THE GO STRAWBERRY 24PX200ML', '22050281', 17.50, 18.50, 6.30, 14.00, 4, 3, 1, 1, '1', 'WR-OT-ST', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(26, 3, 'WRP RTD ON THE GO ORIGINAL 24Px200ML', '2205000', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', 'WR-OT-OR', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(27, 2, 'HB YOGURT DRINK BLACKCURRANT 24PX200ML PROMO GUNDA', '7300651250', 15.30, 14.50, 4.35, 4.40, 5, 4, 1, 1, '1', 'HB-YD-BC-G', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(28, 3, 'WRP ON THE GO ORIGINAL 24PX200ML', '2205000', 17.50, 18.50, 6.50, 14.00, 4, 3, 1, 1, '1', 'WR-OT-OR', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(29, 5, 'NS RTD JERUK MADU 24PX200ML', '1101182250', 8.00, 9.00, 3.60, 3.90, 19, 15, 1, 1, '1', 'NS-RT-JM', '2019-04-29 04:35:44', '2019-04-29 04:35:44'),
(30, 6, 'YOBASE LOW FAT HB YOGURT ORIGINAL', '7200004', 12.00, 12.50, 6.40, 6.55, 0, 0, 0, 1, '1', 'HB-YB-OR', '2019-04-29 06:09:50', '0000-00-00 00:00:00'),
(31, 6, 'YOBASE LOW FAT HB YOGURT', '7200000', 12.00, 12.50, 6.40, 6.55, 0, 0, 0, 1, '1', 'HB-YB-LF', '2019-04-29 06:09:50', '0000-00-00 00:00:00'),
(32, 6, 'COMPOUND YOBASE HB YO', '7200002', 12.00, 12.50, 6.50, 6.55, 0, 0, 0, 1, '1', 'HB-YB-YO', '2019-04-29 06:11:43', '0000-00-00 00:00:00');

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
(5, 1, 'Nutrisari', '1', '2019-04-26 02:23:01', '2019-04-26 02:23:01');

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
  `plan_batch_size` varchar(20) NOT NULL,
  `actual_batch_size` varchar(20) DEFAULT NULL COMMENT 'batch size',
  `status` enum('0','1','2','3','4','5','6') NOT NULL COMMENT '0 = Pending ( WIP Mixing ), 1 = On Progress Mixing , 2 = WIP Fillpack , 3 = In Progress Fillpack , 4 = Done Fillpack ( Waiting For Close ) , 5. Closed, 6 = Canceled ',
  `completion_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `keterangan_1` text,
  `keterangan_2` text COMMENT 'alasan_batal',
  `keterangan_3` text,
  `revisi_formula` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wo`
--

INSERT INTO `wo` (`id`, `nomor_wo`, `produk_id`, `plan_id`, `production_plan_date`, `production_realisation_date`, `plan_batch_size`, `actual_batch_size`, `status`, `completion_date`, `keterangan_1`, `keterangan_2`, `keterangan_3`, `revisi_formula`, `created_at`, `updated_at`) VALUES
(1, 'G1904214013', 13, 3, '2019-04-29', NULL, '9956.576', NULL, '2', '2019-04-29 08:42:57', '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AJ/34.44)', '2019-04-29 06:18:08', NULL),
(2, 'G1904708003', 4, 3, '2019-04-29', NULL, '5887.11', NULL, '2', '2019-04-29 08:43:02', '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 200ML (0.2)', '2019-04-29 06:18:08', NULL),
(3, '084STTHNIIV2019/HB-YB-YO', 32, 3, '2019-04-29', NULL, '', NULL, '2', '2019-04-29 08:43:25', '-', '-', '-', '-', '2019-04-29 06:18:08', NULL),
(4, '085STTHNIIV2019/HB-YO-BB', 5, 3, '2019-04-29', NULL, '', NULL, '2', '2019-04-29 08:43:23', '-', '-', '-', '-', '2019-04-29 06:18:08', NULL),
(5, 'G1904214017', 20, 3, '2019-04-30', NULL, '9969.252', NULL, '2', '2019-04-29 08:43:15', '-', '-', '-', 'FORMULA PHANTOM HILO RTD TEEN CHOCOLATE 200ML ( AX/34.18)', '2019-04-29 06:18:08', NULL),
(6, 'G1904214018', 20, 3, '2019-04-30', NULL, '9969.252', NULL, '2', '2019-04-29 08:43:19', '-', '-', '-', 'FORMULA PHANTOM HILO RTD TEEN CHOCOLATE 200ML ( AX/34.18)', '2019-04-29 06:18:08', NULL),
(7, 'G1904214012', 13, 3, '2019-04-30', NULL, '9956.576', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AJ/34.44)', '2019-04-29 06:18:08', NULL),
(8, 'G1904214009', 13, 3, '2019-05-02', NULL, '9956.576', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AJ/34.44)', '2019-04-29 06:18:08', NULL),
(9, 'G1905214005', 13, 3, '2019-05-02', NULL, '9956.576', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AJ/34.44)', '2019-04-29 06:18:08', NULL),
(10, 'G1905214006', 13, 3, '2019-05-02', NULL, '9956.576', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AJ/34.44)', '2019-04-29 06:18:08', NULL),
(11, 'G1905702001', 11, 3, '2019-05-02', NULL, '10084.12', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT STRAWBERRY (4.4)', '2019-04-29 06:18:08', NULL),
(12, 'G1904214019', 20, 3, '2019-05-03', NULL, '9969.252', NULL, '0', NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD TEEN CHOCOLATE 200ML ( AX/34.18)', '2019-04-29 06:18:08', NULL),
(13, 'G1905214001', 20, 3, '2019-05-03', NULL, '9969.252', NULL, '0', NULL, '-', '-', '-', '-', '2019-04-29 06:18:08', NULL),
(14, 'G1905214003', 20, 3, '2019-05-03', NULL, '9969.252', NULL, '6', NULL, '-', '-', '-', '-', '2019-04-29 06:18:08', NULL),
(15, 'G1905702002', 11, 3, '2019-05-03', NULL, '10084.12', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT STRAWBERRY (4.4)', '2019-04-29 06:18:08', NULL),
(16, 'G1905702003', 11, 3, '2019-05-03', NULL, '10084.12', NULL, '6', NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT STRAWBERRY (4.4)', '2019-04-29 06:18:08', NULL);

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `cpp`
--
ALTER TABLE `cpp`
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
-- Indeks untuk tabel `lot`
--
ALTER TABLE `lot`
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
-- Indeks untuk tabel `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
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
-- AUTO_INCREMENT untuk tabel `cpp`
--
ALTER TABLE `cpp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT untuk tabel `lot`
--
ALTER TABLE `lot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mesin_filling`
--
ALTER TABLE `mesin_filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `palet`
--
ALTER TABLE `palet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `sub_brand`
--
ALTER TABLE `sub_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `wo`
--
ALTER TABLE `wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
