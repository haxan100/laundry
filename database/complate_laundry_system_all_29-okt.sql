-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 28 Okt 2025 pada 22.58
-- Versi server: 5.7.39
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_amanah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `email`, `telepon`, `id_role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@laundryamanah.com', '081234567891', 1, 'aktif', '2025-10-26 14:17:47', '2025-10-28 09:15:19'),
(2, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Kasir Laundry - hasan ', 'kasir@laundryamanah.com', '081234567892', 2, 'aktif', '2025-10-26 14:17:47', '2025-10-26 09:30:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tier_level` enum('bronze','silver','gold','platinum') DEFAULT 'bronze',
  `total_transaksi` int(11) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `last_wash` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id_customer`, `nama`, `email`, `telepon`, `password`, `tier_level`, `total_transaksi`, `last_login`, `last_wash`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@example.com', '8912345678', '5d41402abc4b2a76b9719d911017c592', 'bronze', 0, '2024-01-15 03:30:00', '2024-01-10 07:20:00', '2025-10-26 14:33:25', NULL),
(2, 'Jane Smith', 'jane@example.com', '8987654321', '5d41402abc4b2a76b9719d911017c592', 'silver', 0, '2024-01-14 02:15:00', '2024-01-12 09:45:00', '2025-10-26 14:33:25', NULL),
(3, 'Bob Wilson', 'bob@example.com', '8955555555', '5d41402abc4b2a76b9719d911017c592', 'gold', 0, '2024-01-13 04:20:00', '2024-01-11 06:30:00', '2025-10-26 14:33:25', NULL),
(4, 'Alice Brown', 'alice@example.com', '8966666666', '5d41402abc4b2a76b9719d911017c592', 'platinum', 0, '2024-01-12 08:45:00', '2024-01-09 03:15:00', '2025-10-26 14:33:25', NULL),
(5, 'Charlie Davis', 'charlie@example.com', '8977777777', '5d41402abc4b2a76b9719d911017c592', 'bronze', 0, '2024-01-11 01:30:00', '2024-01-08 05:00:00', '2025-10-26 14:33:25', NULL),
(6, 'Diana Evans', 'diana@example.com', '8988888888', '5d41402abc4b2a76b9719d911017c592', 'silver', 0, '2024-01-10 07:20:00', '2024-01-07 02:45:00', '2025-10-26 14:33:25', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_laundry`
--

CREATE TABLE `harga_laundry` (
  `id_harga` int(11) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `harga_per_kilo` decimal(10,2) NOT NULL,
  `deskripsi` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `harga_laundry`
--

INSERT INTO `harga_laundry` (`id_harga`, `nama_layanan`, `harga_per_kilo`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Kering', '55000.00', 'Cuci dan kering saja', 'active', '2025-10-26 14:35:00', NULL),
(2, 'Cuci Setrika', '7000.00', 'Cuci, kering, dan setrika', 'active', '2025-10-26 14:35:00', NULL),
(3, 'Cuci Express', '10000.00', 'Cuci setrika selesai 1 hari', 'active', '2025-10-26 14:35:00', NULL),
(4, 'Dry Clean', '15000.00', 'Dry cleaning untuk pakaian khusus', 'active', '2025-10-26 14:35:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_ongkir`
--

CREATE TABLE `harga_ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_area` varchar(100) NOT NULL,
  `harga_ongkir` decimal(10,2) NOT NULL,
  `estimasi_hari` int(11) DEFAULT '1',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `harga_ongkir`
--

INSERT INTO `harga_ongkir` (`id_ongkir`, `nama_area`, `harga_ongkir`, `estimasi_hari`, `status`, `created_at`) VALUES
(1, 'Dalam Kota', '5000.00', 1, 'active', '2025-10-26 14:35:00'),
(2, 'Luar Kota', '10000.00', 2, 'active', '2025-10-26 14:35:00'),
(3, 'Antar Jemput', '15000.00', 1, 'active', '2025-10-26 14:35:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `username`, `password`, `nama_lengkap`, `email`, `telepon`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kasir1', '29c748d4d8f4bd5cbc0f3f60cb7ed3d0', 'kasir1', 'kasir1@laundry.com', '081234567890', 'Jl. Kasir No. 1', 'aktif', '2025-10-28 15:49:42', '2025-10-28 09:10:04'),
(2, 'kasir2', 'c7911af3adbd12a035b289556d96470a', 'Kasir Dua', 'kasir2@laundry.com', '081234567891', 'Jl. Kasir No. 2', 'aktif', '2025-10-28 15:49:42', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `owners`
--

CREATE TABLE `owners` (
  `id_owner` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `owners`
--

INSERT INTO `owners` (`id_owner`, `username`, `password`, `nama_lengkap`, `email`, `telepon`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'owner', '5be057accb25758101fa5eadbbd79503', 'Owner Laundry Amanah', 'owner@laundryamanah.com', '081234567890', 'Jl. Contoh No. 123', 'aktif', '2025-10-26 14:17:47', '2025-10-26 07:50:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL,
  `deskripsi` text,
  `permissions` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`, `deskripsi`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Akses penuh sistem', '[\"master_role\",\"master_admin\",\"master_customer\",\"master_kasir\",\"master_transaksi\",\"setting_discount\",\"setting_harga\"]', '2025-10-26 14:17:47', '2025-10-28 10:00:51'),
(2, 'Admin Operasional', 'Kelola operasional laundry', '[\"master_customer\",\"master_transaksi\",\"setting_discount\"]', '2025-10-26 14:17:47', '2025-10-28 09:00:36'),
(3, 'Kasir', 'Kelola transaksi dan pembayaran', '[\"master_transaksi\"]', '2025-10-26 14:17:47', '2025-10-28 15:56:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_harga_laundry`
--

CREATE TABLE `setting_harga_laundry` (
  `id_harga_laundry` int(11) NOT NULL,
  `nama_tier` varchar(100) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `min_kg` decimal(5,2) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting_harga_laundry`
--

INSERT INTO `setting_harga_laundry` (`id_harga_laundry`, `nama_tier`, `harga_per_kg`, `min_kg`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tier 1 - Retail', '3500.00', '5.00', 'aktif', '2025-10-26 14:53:06', '2025-10-26 14:53:06'),
(2, 'Tier 2 - Grosir Kecil', '2500.00', '10.00', 'aktif', '2025-10-26 14:53:06', '2025-10-26 14:53:06'),
(3, 'Tier 3 - Grosir Besar', '2000.00', '50.00', 'aktif', '2025-10-26 14:53:06', '2025-10-26 14:53:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_harga_ongkir`
--

CREATE TABLE `setting_harga_ongkir` (
  `id_harga_ongkir` int(11) NOT NULL,
  `nama_tier` varchar(100) NOT NULL,
  `harga_per_km` decimal(10,2) NOT NULL,
  `min_km` decimal(5,2) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting_harga_ongkir`
--

INSERT INTO `setting_harga_ongkir` (`id_harga_ongkir`, `nama_tier`, `harga_per_km`, `min_km`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tier 1 - Dekat', '2000.00', '10.00', 'aktif', '2025-10-26 14:53:06', '2025-10-26 14:53:06'),
(2, 'Tier 2 - Sedang', '1500.00', '25.00', 'aktif', '2025-10-26 14:53:06', '2025-10-26 14:53:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_laundry`
--

CREATE TABLE `setting_laundry` (
  `id_setting` int(11) NOT NULL,
  `nama_laundry` varchar(255) NOT NULL DEFAULT 'LAUNDRY SYSTEM',
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL DEFAULT '(021) 1234-5678',
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting_laundry`
--

INSERT INTO `setting_laundry` (`id_setting`, `nama_laundry`, `alamat`, `telepon`, `email`, `website`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'LAUNDRY SYSTEM', 'Jl. Contoh No. 123', '(021) 1234-5678', 'info@laundry.com', NULL, NULL, '2025-10-26 15:26:17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tier_discount`
--

CREATE TABLE `tier_discount` (
  `id_tier` int(11) NOT NULL,
  `nama_tier` varchar(50) NOT NULL,
  `min_transaksi` int(11) NOT NULL DEFAULT '0',
  `discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tier_discount`
--

INSERT INTO `tier_discount` (`id_tier`, `nama_tier`, `min_transaksi`, `discount_percent`, `status`, `created_at`) VALUES
(1, 'Bronze', 0, '0.00', 'active', '2025-10-26 14:35:00'),
(2, 'Silver', 10, '5.00', 'active', '2025-10-26 14:35:00'),
(3, 'Gold', 25, '10.00', 'active', '2025-10-26 14:35:00'),
(4, 'Platinum', 50, '15.00', 'active', '2025-10-26 14:35:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tier_discounts`
--

CREATE TABLE `tier_discounts` (
  `id_discount` int(11) NOT NULL,
  `tier_level` enum('bronze','silver','gold','platinum') NOT NULL,
  `discount_amount` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tier_discounts`
--

INSERT INTO `tier_discounts` (`id_discount`, `tier_level`, `discount_amount`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bronze', 5000, 1, '2025-10-26 14:39:24', NULL),
(2, 'silver', 7000, 1, '2025-10-26 14:39:24', NULL),
(3, 'gold', 10000, 1, '2025-10-26 14:39:24', NULL),
(4, 'platinum', 15000, 1, '2025-10-26 14:39:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `customer_type` enum('tamu','customer','customer_baru') NOT NULL DEFAULT 'tamu',
  `id_customer` int(11) DEFAULT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `pajak` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `catatan` text,
  `status` enum('pending','process','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `berat_kg` decimal(5,2) DEFAULT NULL COMMENT 'Berat laundry dalam kg',
  `jarak_km` decimal(5,2) DEFAULT NULL COMMENT 'Jarak pengiriman dalam km',
  `harga_per_kg` decimal(10,2) DEFAULT NULL COMMENT 'Harga per kg yang digunakan',
  `harga_per_km` decimal(10,2) DEFAULT NULL COMMENT 'Harga per km yang digunakan',
  `tier_laundry` varchar(50) DEFAULT NULL COMMENT 'Tier laundry yang digunakan',
  `tier_ongkir` varchar(50) DEFAULT NULL COMMENT 'Tier ongkir yang digunakan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `id_kasir`, `customer_type`, `id_customer`, `nama_customer`, `no_hp`, `subtotal`, `pajak`, `total`, `payment_method`, `catatan`, `status`, `created_at`, `updated_at`, `berat_kg`, `jarak_km`, `harga_per_kg`, `harga_per_km`, `tier_laundry`, `tier_ongkir`) VALUES
(1, 'TRX20251026001', 2, 'customer', 1, 'John Doe', '8912345678', '75000.00', '0.00', '75000.00', 'cash', NULL, 'pending', '2025-10-26 15:24:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'TRX20251026002', 2, 'tamu', NULL, 'Tamu', '', '52000.00', '0.00', '52000.00', 'cash', NULL, 'pending', '2025-10-26 15:27:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'TRX20251026003', 2, 'customer', 5, 'Charlie Davis', '8977777777', '20000.00', '0.00', '20000.00', 'cash', NULL, 'pending', '2025-10-26 15:29:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'TRX20251026004', 2, 'tamu', NULL, 'Tamu', '', '52000.00', '0.00', '52000.00', 'cash', '', 'pending', '2025-10-26 15:48:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'TRX20251026005', 2, 'tamu', NULL, 'Tamu', '', '82000.00', '0.00', '82000.00', 'cash', 'dwdw', 'pending', '2025-10-26 15:49:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'TRX20251026006', 2, 'tamu', NULL, 'Tamu', '', '72500.00', '0.00', '72500.00', 'cash', 'di blok C0-71', 'pending', '2025-10-26 16:10:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'TRX20251026007', 2, 'tamu', NULL, 'Tamu', '', '87500.00', '0.00', '87500.00', 'cash', 'ini kdjdkjdkj', 'completed', '2025-10-26 16:16:04', '2025-10-28 10:37:13', '19.00', '20.00', '2500.00', '2000.00', 'Tier 2 - Grosir Kecil', 'Tier 1 - Dekat'),
(8, 'TRX20251028001', 1, 'customer', 3, 'Bob Wilson', '8955555555', '1800000.00', '0.00', '1800000.00', 'cash', 'BLOK c0-7i', 'pending', '2025-10-28 17:03:22', NULL, '900.00', '5.00', '2000.00', '2000.00', 'Tier 3 - Grosir Besar', 'Default Tier'),
(9, 'TRX20251028002', 1, 'customer', 5, 'Charlie Davis', '8977777777', '119000.00', '0.00', '119000.00', 'cash', 'baru tanggal 29', 'pending', '2025-10-28 17:05:22', NULL, '56.00', '6.00', '2000.00', '2000.00', 'Tier 3 - Grosir Besar', 'Default Tier'),
(10, 'TRX20251028003', 1, 'tamu', NULL, 'Tamu', '', '59000.00', '0.00', '59000.00', 'cash', '', 'pending', '2025-10-27 17:09:27', '2025-10-28 10:38:32', '22.00', '2.00', '2500.00', '2000.00', 'Tier 2 - Grosir Kecil', 'Default Tier'),
(11, 'TRX20251028004', 1, 'tamu', NULL, 'Tamu', '', '57500.00', '0.00', '57500.00', 'cash', '1', 'pending', '2025-10-28 17:34:25', NULL, '23.00', NULL, '2500.00', NULL, 'Tier 2 - Grosir Kecil', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `nama_service` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `harga_laundry`
--
ALTER TABLE `harga_laundry`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `harga_ongkir`
--
ALTER TABLE `harga_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id_owner`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `setting_harga_laundry`
--
ALTER TABLE `setting_harga_laundry`
  ADD PRIMARY KEY (`id_harga_laundry`);

--
-- Indeks untuk tabel `setting_harga_ongkir`
--
ALTER TABLE `setting_harga_ongkir`
  ADD PRIMARY KEY (`id_harga_ongkir`);

--
-- Indeks untuk tabel `setting_laundry`
--
ALTER TABLE `setting_laundry`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tier_discount`
--
ALTER TABLE `tier_discount`
  ADD PRIMARY KEY (`id_tier`);

--
-- Indeks untuk tabel `tier_discounts`
--
ALTER TABLE `tier_discounts`
  ADD PRIMARY KEY (`id_discount`),
  ADD UNIQUE KEY `tier_level` (`tier_level`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `id_kasir` (`id_kasir`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `harga_laundry`
--
ALTER TABLE `harga_laundry`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `harga_ongkir`
--
ALTER TABLE `harga_ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `owners`
--
ALTER TABLE `owners`
  MODIFY `id_owner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `setting_harga_laundry`
--
ALTER TABLE `setting_harga_laundry`
  MODIFY `id_harga_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `setting_harga_ongkir`
--
ALTER TABLE `setting_harga_ongkir`
  MODIFY `id_harga_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `setting_laundry`
--
ALTER TABLE `setting_laundry`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tier_discount`
--
ALTER TABLE `tier_discount`
  MODIFY `id_tier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tier_discounts`
--
ALTER TABLE `tier_discounts`
  MODIFY `id_discount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_kasir`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
