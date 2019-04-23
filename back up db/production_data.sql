-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2019 pada 10.44
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
  `plan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`id`, `brand`, `plan_id`, `created_at`, `updated_at`) VALUES
(1, 'Brand 1', 1, '2019-04-11 19:34:20', '2019-04-11 19:34:20'),
(2, 'Brand 2', 1, '2019-04-11 23:27:50', '2019-04-11 23:27:50'),
(3, 'Brand 3', 2, '2019-04-11 23:28:13', '2019-04-11 23:28:13'),
(4, 'Brand 1 Edit Edit', 1, '2019-04-11 23:41:01', '2019-04-11 23:41:01');

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
(1, 'PT. Nutrifood Indonesia', 'NFI', '1', '2019-04-10 01:59:24', '2019-03-12 00:58:00'),
(2, 'PT. Heavenly Nutrition Indonesia', 'HNI', '1', '2019-04-10 01:59:26', '2019-03-12 00:58:09'),
(3, 'Utility Online', 'ULLI', '1', '2019-04-11 06:41:15', '2019-04-11 06:41:15');

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
(1, 'Jenis 2', '2019-04-12 07:07:13', '2019-04-12 07:07:13'),
(2, 'Jenis 1', '2019-04-12 07:07:18', '2019-04-12 07:07:18');

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
(1, 'Kelompok 1', '1', '2019-04-12 08:54:12', '2019-04-12 08:54:12'),
(2, 'Kelompok 2', '1', '2019-04-12 09:13:34', '2019-04-12 09:13:34'),
(3, 'Kelompok 1', '1', '2019-04-12 09:25:46', '2019-04-12 09:25:46'),
(4, 'Kelompok 1', '1', '2019-04-12 09:28:00', '2019-04-12 09:28:00'),
(5, 'Kelompok 1', '1', '2019-04-12 09:29:52', '2019-04-12 09:29:52'),
(6, 'Kelompok 1', '1', '2019-04-12 09:29:59', '2019-04-12 09:29:59'),
(7, 'Kelompok 1', '1', '2019-04-15 01:21:07', '2019-04-15 01:21:07'),
(8, 'Kelompok 8', '1', '2019-04-15 06:09:59', '2019-04-15 06:09:59');

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
(1, 'Mesin 1 edit', '123', '0', '2019-04-12 03:25:40', '2019-04-12 07:39:18');

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
(3, 'Plan Sentul', 1, 'Sentul', '1', '2019-04-22 02:34:34', '2019-04-22 02:34:34'),
(4, 'Plan Ciawi', 1, 'Sentul', '1', '2019-04-22 02:34:43', '2019-04-22 02:34:43'),
(5, 'Plan Cibitung', 1, '-', '1', '2019-04-22 02:37:45', '2019-04-22 02:37:45'),
(6, 'Plan Jakarta', 1, 'Sentul', '1', '2019-04-22 02:37:51', '2019-04-22 02:42:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `brand_id`, `nama_produk`, `kode_oracle`, `spek_ts_min`, `spek_ts_max`, `spek_ph_min`, `spek_ph_max`, `sla`, `waktu_analisa_mikro`, `kelompok_mesin_filling_head_id`, `jenis_produk_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Produk 1 edit', 'KodeOracle1', 0.00, 1.00, 0.00, 0.00, 1, 1, 1, 1, '0', '2019-04-14 19:06:06', '2019-04-14 21:36:43'),
(2, 2, 'Produk 2 Edit', 'KodeOracle2', 0.00, 0.00, 0.00, 0.00, 1, 1, 1, 1, '1', '2019-04-14 23:02:19', '2019-04-14 23:02:28');

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
-- Indeks untuk tabel `mesin_filling`
--
ALTER TABLE `mesin_filling`
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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelompok_mesin_filling_detail`
--
ALTER TABLE `kelompok_mesin_filling_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelompok_mesin_filling_head`
--
ALTER TABLE `kelompok_mesin_filling_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mesin_filling`
--
ALTER TABLE `mesin_filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
