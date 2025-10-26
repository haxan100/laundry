-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2025 pada 11.30
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boilerplate`
--
CREATE DATABASE IF NOT EXISTS `boilerplate` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `boilerplate`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `id_role`, `created_at`, `updated_at`) VALUES
(1, 'hasan', 'y0xbARBZ3fn/Ptl2nUXJHTrzyVMBPz4pHE5VprVtZ+B2/4jSywEb4A2cReDgcaylZf+CvJHNLV+5z+FCpVWk9w==', 2, '2025-01-07 08:04:47', '2025-01-29 05:32:44'),
(4, 'abdul', 'SflG+siEtaLQkDGoU4F8Cwt3v5EzMHTtCIAVBTxzRNuY2526PXilNqesLOtIivumo2Wj1AhWeqKZ3bIZBW9D/Q==', 2, '2025-01-08 02:56:24', '2025-01-28 14:22:06'),
(5, 'AAAA', '5Nk6QUPtt22gFXgB9gtmWRPfV1z2dlXSQY/u1scs6s2qdRVlqlmbWBJdZsqIQyzugqBZS+y09iLZ3qebJXPXnw==', 2, '2025-01-08 02:56:57', '2025-01-08 03:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id_berita` int NOT NULL,
  `id_wartawan` int NOT NULL,
  `foto_background` varchar(255) DEFAULT NULL,
  `nama_narasumber` varchar(255) DEFAULT NULL,
  `posisi_narasumber` varchar(255) DEFAULT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `foto_berita` json DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `waktu_berita` datetime DEFAULT NULL,
  `isi_berita` text NOT NULL,
  `sumber_berita` text,
  `id_kategori_berita` int NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` enum('draft','deleted','send_to_editor','need_to_revision','approve_editor','send_to_redaksi','approve_redaksi','publish','not_suitable_for_publish','news_delayed','news_need_fixing') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `editor`
--

DROP TABLE IF EXISTS `editor`;
CREATE TABLE `editor` (
  `id_editor` int NOT NULL,
  `nama_editor` varchar(255) NOT NULL,
  `email_editor` varchar(255) NOT NULL,
  `username_editor` varchar(255) NOT NULL,
  `password_editor` varchar(255) NOT NULL,
  `foto_editor` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_admin_temp`
--

DROP TABLE IF EXISTS `jawaban_admin_temp`;
CREATE TABLE `jawaban_admin_temp` (
  `id` int NOT NULL,
  `id_transaction` varchar(100) NOT NULL,
  `lcd` text,
  `baterai` text,
  `backcover` text,
  `body` text,
  `service` text,
  `kelengkapan` text,
  `software` text,
  `lainnya` text,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jawaban_admin_temp`
--

INSERT INTO `jawaban_admin_temp` (`id`, `id_transaction`, `lcd`, `baterai`, `backcover`, `body`, `service`, `kelengkapan`, `software`, `lainnya`, `updated_at`) VALUES
(7, '33', 'Lecet/Baret Kasar/Dalam (Terasa), LCD PECAH', '90% - 94%', 'Lecet/Baret Halus (Tidak Terasa), Terkelupas', 'Lecet/Baret Kasar/Dalam (Terasa), Terkelupas', 'Tidak (Garansi Resmi sudah Berakhir)', 'Handphone Saja', NULL, NULL, '2025-03-27 03:49:35'),
(9, '34', 'Normal', '100%', 'Normal', 'normal', 'Tidak (Masih Garansi Resmi)', 'Ada Box (IMEI di Box dan HP Sama)', NULL, NULL, '2025-03-27 05:30:14'),
(10, '35', 'Normal', '100%', 'Normal', 'normal', 'Tidak (Masih Garansi Resmi)', 'Ada Kaber Charger', NULL, NULL, '2025-03-27 05:34:48'),
(11, '36', 'Normal', '100%', 'Normal', 'normal', 'Tidak (Masih Garansi Resmi)', 'Handphone Saja', NULL, NULL, '2025-03-27 07:15:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_waktu_admin`
--

DROP TABLE IF EXISTS `jawaban_waktu_admin`;
CREATE TABLE `jawaban_waktu_admin` (
  `id` int NOT NULL,
  `id_transaction` varchar(100) NOT NULL,
  `id_toko` int NOT NULL,
  `waktu` int DEFAULT '0',
  `opened_at` datetime DEFAULT NULL,
  `selesai_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jawaban_waktu_admin`
--

INSERT INTO `jawaban_waktu_admin` (`id`, `id_transaction`, `id_toko`, `waktu`, `opened_at`, `selesai_at`, `created_at`) VALUES
(1, '35', 5, 72, '2025-03-27 07:13:03', '2025-03-27 07:14:15', '2025-03-27 13:13:03'),
(2, '36', 5, 19, '2025-03-27 07:15:03', '2025-03-27 07:15:22', '2025-03-27 13:15:03'),
(3, '33', 5, 20, '2025-03-27 07:16:14', '2025-03-27 07:16:34', '2025-03-27 13:16:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_berita`
--

DROP TABLE IF EXISTS `kategori_berita`;
CREATE TABLE `kategori_berita` (
  `no` int NOT NULL,
  `kategori_berita` varchar(255) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `tajuk_berita` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori_berita`
--

INSERT INTO `kategori_berita` (`no`, `kategori_berita`, `headline`, `tajuk_berita`) VALUES
(1, 'Nasional', 'Kabar Nasional', 'Kabar Politik'),
(2, 'Nasional', 'Kabar Nasional', 'Kabar Ekonomi'),
(3, 'Nasional', 'Kabar Nasional', 'Kabar Bisnis'),
(4, 'Nasional', 'Kabar Nasional', 'Kabar Wirausaha'),
(5, 'Nasional', 'Kabar Nasional', 'Kabar Perbankan'),
(6, 'Nasional', 'Kabar Nasional', 'Kabar Manajemen'),
(7, 'Nasional', 'Kabar Nasional', 'Kabar Seni'),
(8, 'Nasional', 'Kabar Nasional', 'Kabar Budaya'),
(9, 'Nasional', 'Kabar Nasional', 'Kabar HAM'),
(10, 'Nasional', 'Kabar Nasional', 'Kabar Hukum'),
(11, 'Nasional', 'Kabar Nasional', 'Kabar Lingkungan Hidup'),
(12, 'Nasional', 'Kabar Nasional', 'Kabar Hutan'),
(13, 'Nasional', 'Kabar Nasional', 'Kabar SDM'),
(14, 'Nasional', 'Kabar Nasional', 'Kabar SDA'),
(15, 'Nasional', 'Kabar Nasional', 'Kabar Kelautan'),
(16, 'Nasional', 'Kabar Agama', 'Kabar Haji'),
(17, 'Nasional', 'Kabar Agama', 'Kabar Umroh'),
(18, 'Nasional', 'Kabar Agama', 'Kabar Natal'),
(19, 'Nasional', 'Kabar Agama', 'Kabar Idul Fitri'),
(20, 'Nasional', 'Kabar Agama', 'Kabar Nyepi'),
(21, 'Nasional', 'Kabar Agama', 'Kabar Idul Adha'),
(22, 'Nasional', 'Kabar Agama', 'Kabar Waisak'),
(23, 'Nasional', 'Kabar Agama', 'Kabar Ramadhan'),
(24, 'Nasional', 'Kabar Pendidikan', 'Kabar Pendidikan Tinggi'),
(25, 'Nasional', 'Kabar Pendidikan', 'Kabar Pendidikan Menengah'),
(26, 'Nasional', 'Kabar Pendidikan', 'Kabar Pendidikan Awal'),
(27, 'Nasional', 'Kabar Pendidikan', 'Kabar Sekolah'),
(28, 'Nasional', 'Kabar Pendidikan', 'Kabar Universitas'),
(29, 'Nasional', 'Kabar Pendidikan', 'Kabar Siswa'),
(30, 'Nasional', 'Kabar Pendidikan', 'Kabar Mahasiswa'),
(31, 'Nasional', 'Kabar Pendidikan', 'Kabar Guru'),
(32, 'Nasional', 'Kabar Pendidikan', 'Kabar Dosen'),
(33, 'Nasional', 'Kabar Kriminal', 'Kabar Kriminal'),
(34, 'Nasional', 'Kabar Olah Raga', 'Kabar Sepakbola'),
(35, 'Nasional', 'Kabar Olah Raga', 'Kabar Basket'),
(36, 'Nasional', 'Kabar Olah Raga', 'Kabar Voli'),
(37, 'Nasional', 'Kabar Olah Raga', 'Kabar Bulu Tangkis'),
(38, 'Nasional', 'Kabar Olah Raga', 'Kabar Pencak Silat'),
(39, 'Nasional', 'Kabar Olah Raga', 'Kabar Futsal'),
(40, 'Nasional', 'Kabar Olah Raga', 'Kabar Renang'),
(41, 'Nasional', 'Kabar Olah Raga', 'Kabar Atletik'),
(42, 'Nasional', 'Kabar Olah Raga', 'Kabar Panjat Tebing'),
(43, 'Nasional', 'Kabar Olah Raga', 'Kabar Tenis'),
(44, 'Nasional', 'Kabar Olah Raga', 'Kabar Pingpong'),
(45, 'Nasional', 'Kabar Olah Raga', 'Kabar Voli Pantai'),
(46, 'Nasional', 'Kabar Olah Raga', 'Kabar eSport'),
(47, 'Nasional', 'Kabar Olah Raga', 'Kabar Golf'),
(48, 'Nasional', 'Kabar Olah Raga', 'Kabar Berkuda'),
(49, 'Nasional', 'Kabar Olah Raga', 'Kabar Balapan Motor'),
(50, 'Nasional', 'Kabar Olah Raga', 'Kabar Balapan Mobil'),
(51, 'Nasional', 'Kabar Olah Raga', 'Kabar Balapan Sepeda'),
(52, 'Nasional', 'Kabar Otomotif', 'Kabar Motor'),
(53, 'Nasional', 'Kabar Otomotif', 'Kabar Mobil'),
(54, 'Nasional', 'Kabar Otomotif', 'Kabar Pameran Otomotif'),
(55, 'Nasional', 'Kabar Otomotif', 'Kabar Harga Otomotif'),
(56, 'Nasional', 'Kabar Gadget', 'Kabar Smartphone'),
(57, 'Nasional', 'Kabar Gadget', 'Kabar Tablet/Kabar Pad'),
(58, 'Nasional', 'Kabar Gadget', 'Kabar Laptop'),
(59, 'Nasional', 'Kabar Gadget', 'Kabar Smartwatch'),
(60, 'Nasional', 'Kabar Gadget', 'Kabar Ear Pod'),
(61, 'Nasional', 'Kabar Elektronik', 'Kabar Televisi'),
(62, 'Nasional', 'Kabar Elektronik', 'Kabar Speaker'),
(63, 'Nasional', 'Kabar Elektronik', 'Kabar Komputer'),
(64, 'Nasional', 'Kabar ASN', 'Kabar PNS'),
(65, 'Nasional', 'Kabar ASN', 'Kabar PPPK'),
(66, 'Nasional', 'Kabar Aparatur', 'Kabar Polri'),
(67, 'Nasional', 'Kabar Aparatur', 'Kabar TNI'),
(68, 'Nasional', 'Kabar Aparatur', 'Kabar PolPP'),
(69, 'Nasional', 'Kabar Selebritis', 'Kabar Selebritis'),
(70, 'Nasional', 'Kabar Selebritis', 'Kabar Gosip'),
(71, 'Nasional', 'Kabar Viral', 'Kabar Viral'),
(72, 'Nasional', 'Kabar Opini', 'Kabar Opini'),
(73, 'Nasional', 'Kabar Gaya Hidup', 'Kabar Gaya Hidup'),
(74, 'Nasional', 'Kabar Tokoh', 'Kabar Tokoh'),
(75, 'Internasional', 'Kabar Internasional', 'Kabar Politik Internasional'),
(76, 'Internasional', 'Kabar Internasional', 'Kabar Ekonomi Internasional'),
(77, 'Internasional', 'Kabar Internasional', 'Kabar Bisnis Internasional'),
(78, 'Internasional', 'Kabar Internasional', 'Kabar Perbankan Internasional'),
(79, 'Internasional', 'Kabar Internasional', 'Kabar Seni Internasional'),
(80, 'Internasional', 'Kabar Internasional', 'Kabar Budaya Internasional'),
(81, 'Internasional', 'Kabar Internasional', 'Kabar HAM Internasional'),
(82, 'Internasional', 'Kabar Internasional', 'Kabar Hukum Internasional'),
(83, 'Internasional', 'Kabar Internasional', 'Kabar Tokoh Internasional'),
(84, 'Internasional', 'Kabar Internasional', 'Kabar Internasional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_logs`
--

DROP TABLE IF EXISTS `kategori_logs`;
CREATE TABLE `kategori_logs` (
  `id_kategori_log` int NOT NULL,
  `nama_kategori_log` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori_logs`
--

INSERT INTO `kategori_logs` (`id_kategori_log`, `nama_kategori_log`) VALUES
(10, '  Quisioner Transaction'),
(8, ' Create transaction'),
(9, ' Get transaction'),
(11, ' Input Quisioner Softwere'),
(6, 'Access Restricted Area'),
(3, 'Create Data'),
(5, 'Delete Data'),
(7, 'Lihat Harga'),
(4, 'Update Data'),
(1, 'User Login'),
(2, 'User Logout');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id_log` int NOT NULL,
  `id_kategori_log` int NOT NULL,
  `jenis_user` enum('superadmin','admin','toko','mitra') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user` int NOT NULL,
  `log_message` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id_log`, `id_kategori_log`, `jenis_user`, `id_user`, `log_message`, `created_at`) VALUES
(2, 4, '', 1, '{\"id_role\":\"\",\"updated_data\":{\"role_name\":\"Super Admin\",\"all_admin\":1,\"user_management\":1,\"product_management\":1}}', '2025-01-07 04:24:38'),
(3, 4, 'superadmin', 1, '{\"id_role\":\"3\",\"updated_data\":{\"role_name\":\"Admin Product\",\"all_admin\":0,\"user_management\":0,\"product_management\":1}}', '2025-01-07 05:22:27'),
(4, 4, 'superadmin', 1, '{\"id_role\":\"3\",\"updated_data\":{\"role_name\":\"Admin Productddddd\",\"all_admin\":0,\"user_management\":0,\"product_management\":1}}', '2025-01-07 05:22:34'),
(5, 5, 'superadmin', 1, '{\"id_role\":\"5\"}', '2025-01-07 05:27:56'),
(6, 5, 'superadmin', 1, '{\"id_role\":\"1\"}', '2025-01-07 05:28:42'),
(7, 5, 'superadmin', 1, '{\"id_role\":null}', '2025-01-07 05:29:39'),
(8, 5, 'superadmin', 1, '{\"id_role\":\"4\"}', '2025-01-07 05:31:15'),
(9, 3, 'superadmin', 1, '{\"created_data\":null}', '2025-01-07 05:35:01'),
(10, 5, 'superadmin', 1, '{\"id_role\":\"12\"}', '2025-01-07 05:37:36'),
(11, 5, 'superadmin', 1, '{\"id_role\":\"13\"}', '2025-01-07 05:38:10'),
(12, 5, 'superadmin', 1, '{\"id_role\":\"10\"}', '2025-01-07 05:38:38'),
(13, 5, 'superadmin', 1, '{\"id_role\":\"8\"}', '2025-01-07 05:39:31'),
(14, 5, 'superadmin', 1, '{\"id_role\":\"9\"}', '2025-01-07 05:39:49'),
(15, 5, 'superadmin', 1, '{\"id_role\":\"7\"}', '2025-01-07 05:40:08'),
(16, 5, 'superadmin', 1, '{\"id_role\":\"6\"}', '2025-01-07 05:40:42'),
(17, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"Admin User\",\"all_admin\":1,\"user_management\":1,\"product_management\":1}}', '2025-01-07 05:47:19'),
(18, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"verus\",\"master_admin\":0,\"master_log\":0,\"master_role\":0}}', '2025-01-08 08:52:21'),
(19, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"verus\",\"master_admin\":\"1\",\"master_log\":\"1\",\"master_role\":0}}', '2025-01-08 09:44:02'),
(20, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"verus\",\"master_admin\":\"1\",\"master_log\":\"1\",\"master_role\":0}}', '2025-01-08 09:44:02'),
(21, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"verus\",\"master_admin\":\"1\",\"master_log\":\"1\",\"master_role\":\"1\"}}', '2025-01-08 09:44:09'),
(22, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"verus\",\"master_admin\":\"1\",\"master_log\":\"1\",\"master_role\":\"1\"}}', '2025-01-08 09:44:09'),
(23, 4, 'superadmin', 1, '{\"id_role\":\"19\",\"updated_data\":{\"role_name\":\"x\",\"master_admin\":\"1\",\"master_log\":0,\"master_role\":\"1\"}}', '2025-01-08 09:52:54'),
(24, 4, 'superadmin', 1, '{\"id_role\":\"2\",\"updated_data\":{\"role_name\":\"verus\",\"master_admin\":\"1\",\"master_log\":\"1\",\"master_role\":\"1\",\"Terms\":\"1\"}}', '2025-01-08 10:26:14'),
(25, 4, 'superadmin', 1, '{\"id_role\":\"18\",\"updated_data\":{\"role_name\":\"A\",\"master_admin\":\"1\",\"master_log\":\"1\",\"master_role\":\"1\",\"Terms\":\"1\"}}', '2025-01-08 10:26:26'),
(26, 1, '', 5, 'Login Username toko-era', '2025-02-02 04:07:15'),
(27, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 04:08:24'),
(28, 7, 'toko', 1, 'Lihat Harga ', '2025-02-02 04:14:00'),
(29, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-02 04:14:55'),
(30, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 04:26:13'),
(31, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-02 04:33:27'),
(32, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 05:03:44'),
(33, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 05:05:20'),
(34, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 05:16:37'),
(35, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-02 05:18:23'),
(36, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-02 05:18:49'),
(37, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 05:24:51'),
(38, 1, 'toko', 5, 'Login Username toko-era', '2025-02-02 06:18:43'),
(39, 1, 'toko', 5, 'Login Username toko-era', '2025-02-03 15:15:33'),
(40, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:15:43'),
(41, 1, 'toko', 5, 'Login Username toko-era', '2025-02-03 15:34:17'),
(42, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:49:24'),
(43, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:50:46'),
(44, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:51:48'),
(45, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:52:02'),
(46, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:52:22'),
(47, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:54:01'),
(48, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:55:38'),
(49, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:56:36'),
(50, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:58:31'),
(51, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:58:49'),
(52, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 15:59:07'),
(53, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 16:00:00'),
(54, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 16:01:57'),
(55, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 16:02:08'),
(56, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-03 16:02:29'),
(57, 1, 'toko', 5, 'Login Username toko-era', '2025-02-03 16:35:04'),
(58, 1, 'toko', 5, 'Login Username toko-era', '2025-02-04 16:48:09'),
(59, 1, 'toko', 5, 'Login Username toko-era', '2025-02-04 17:12:41'),
(60, 1, 'toko', 5, 'Login Username toko-era', '2025-02-04 17:13:39'),
(61, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-04 17:15:35'),
(62, 1, 'toko', 5, 'Login Username toko-era', '2025-02-04 17:38:11'),
(63, 1, 'toko', 5, 'Login Username toko-era', '2025-02-04 17:52:46'),
(64, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-04 17:53:18'),
(65, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-04 17:57:12'),
(66, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-04 17:57:23'),
(67, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-04 17:57:44'),
(68, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-04 17:58:53'),
(69, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-04 17:59:14'),
(70, 1, 'toko', 5, 'Login Username toko-era', '2025-02-04 18:14:40'),
(71, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-04 18:15:35'),
(72, 1, 'toko', 5, 'Login Username toko-era', '2025-02-05 15:35:03'),
(73, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-05 15:35:17'),
(74, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-05 15:35:27'),
(75, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-02-05 15:35:56'),
(76, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-05 16:22:49'),
(77, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-05 16:24:56'),
(78, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-05 16:27:36'),
(79, 1, 'toko', 5, 'Login Username toko-era', '2025-02-05 16:42:01'),
(80, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-05 16:42:04'),
(81, 1, 'toko', 5, 'Login Username toko-era', '2025-02-06 14:13:26'),
(82, 1, 'toko', 5, 'Login Username toko-era', '2025-02-07 16:42:54'),
(83, 1, 'toko', 5, 'Login Username toko-era', '2025-02-07 16:58:53'),
(84, 8, 'toko', 5, ' Create transaction toko-era', '2025-02-07 16:59:03'),
(85, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-07 16:59:47'),
(86, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-07 16:59:49'),
(87, 10, 'toko', 5, 'Input Quisioner Transaction  AA-11', '2025-02-07 17:18:10'),
(88, 1, 'toko', 5, 'Login Username toko-era', '2025-02-07 18:17:10'),
(89, 10, 'toko', 5, 'Input Quisioner Transaction AA-11', '2025-02-07 18:22:11'),
(90, 10, 'toko', 5, 'Input Quisioner Transaction AA-11', '2025-02-07 18:27:23'),
(91, 1, 'toko', 5, 'Login Username toko-era', '2025-02-07 18:43:17'),
(92, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-07 18:47:50'),
(93, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-07 18:48:52'),
(94, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-07 18:49:04'),
(95, 10, 'toko', 5, 'Input Quisioner Transaction AA-11', '2025-02-07 18:50:39'),
(96, 10, 'toko', 5, 'Input Quisioner Transaction AA-11', '2025-02-07 18:51:17'),
(97, 11, 'toko', 5, 'Input Softwere Transaction  AA-11', '2025-02-07 18:58:44'),
(98, 11, 'toko', 5, 'Input Softwere Transaction  AA-11', '2025-02-07 19:01:02'),
(99, 1, 'toko', 5, 'Login Username toko-era', '2025-02-08 14:26:46'),
(100, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-08 14:26:49'),
(101, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-08 14:27:56'),
(102, 9, 'toko', 5, ' Get transaction toko-era', '2025-02-08 14:28:27'),
(103, 11, 'toko', 5, 'Input Software Transaction  AA-11', '2025-02-08 14:36:41'),
(104, 11, 'toko', 5, 'Input Software Transaction  AA-11', '2025-02-08 14:36:47'),
(105, 11, 'toko', 5, 'Input Software Transaction  AA-11', '2025-02-08 14:39:26'),
(106, 1, 'toko', 5, 'Login Username toko-era', '2025-02-08 17:16:50'),
(107, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 17:16:57'),
(108, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 17:24:44'),
(109, 1, 'toko', 5, 'Login Username toko-era', '2025-02-08 19:07:54'),
(110, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 19:08:08'),
(111, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 19:08:52'),
(112, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 19:09:02'),
(113, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 19:09:09'),
(114, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 19:09:41'),
(115, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 19:13:24'),
(116, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 19:21:05'),
(117, 10, 'toko', 5, 'Input Quisioner Transaction 8LZQK97', '2025-02-08 19:21:33'),
(118, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 19:23:34'),
(119, 10, 'toko', 5, 'Input Quisioner Transaction 8VOPK40', '2025-02-08 19:24:35'),
(120, 11, 'toko', 5, 'Input Software Transaction  AA-11', '2025-02-08 19:25:04'),
(121, 11, 'toko', 5, 'Input Software Transaction  AA-11', '2025-02-08 19:25:43'),
(122, 11, 'toko', 5, 'Input Software Transaction  8VOPK40', '2025-02-08 19:27:31'),
(123, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 19:29:08'),
(124, 10, 'toko', 5, 'Input Quisioner Transaction 8VOPK40', '2025-02-08 19:31:01'),
(125, 10, 'toko', 5, 'Input Quisioner Transaction 8MWID51', '2025-02-08 19:31:09'),
(126, 11, 'toko', 5, 'Input Software Transaction  8VOPK40', '2025-02-08 19:31:20'),
(127, 11, 'toko', 5, 'Input Software Transaction  8MWID51', '2025-02-08 19:31:26'),
(128, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 19:50:46'),
(129, 10, 'toko', 5, 'Input Quisioner Transaction 8CORH70', '2025-02-08 19:51:12'),
(130, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 19:52:19'),
(131, 10, 'toko', 5, 'Input Quisioner Transaction 8CORH70', '2025-02-08 19:52:43'),
(132, 10, 'toko', 5, 'Input Quisioner Transaction 8ROUI62', '2025-02-08 19:52:55'),
(133, 11, 'toko', 5, 'Input Software Transaction  8MWID51', '2025-02-08 19:53:12'),
(134, 11, 'toko', 5, 'Input Software Transaction  8MWID51', '2025-02-08 19:53:21'),
(135, 11, 'toko', 5, 'Input Software Transaction  8CORH70', '2025-02-08 19:53:34'),
(136, 11, 'toko', 5, 'Input Software Transaction  8ROUI62', '2025-02-08 19:53:45'),
(137, 1, 'toko', 5, 'Login Username toko-era', '2025-02-08 20:16:10'),
(138, 10, 'toko', 5, 'Input Quisioner Transaction 8ROUI62', '2025-02-08 20:16:27'),
(139, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:18:12'),
(140, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:18:24'),
(141, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:19:02'),
(142, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:23:39'),
(143, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:24:25'),
(144, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:24:50'),
(145, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 20:25:15'),
(146, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 20:25:30'),
(147, 10, 'toko', 5, 'Input Quisioner Transaction 8GVDN87', '2025-02-08 20:26:43'),
(148, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:26:51'),
(149, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:27:58'),
(150, 8, 'toko', 5, 'Create transaction toko-era', '2025-02-08 20:30:52'),
(151, 10, 'toko', 5, 'Input Quisioner Transaction 8YDGU64', '2025-02-08 20:31:12'),
(152, 11, 'toko', 5, 'Input Software Transaction  8YDGU64', '2025-02-08 20:31:22'),
(153, 1, 'toko', 5, 'Login Username toko-era', '2025-02-10 15:15:43'),
(154, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-22 15:39:34'),
(155, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-23 09:41:22'),
(156, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-23 09:41:22'),
(157, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-26 14:19:17'),
(158, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-28 15:35:08'),
(159, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-28 15:55:36'),
(160, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-02-28 16:08:55'),
(161, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-03 14:59:13'),
(162, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-05 14:27:02'),
(163, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-06 12:53:39'),
(164, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-15 10:05:12'),
(165, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-16 05:09:29'),
(166, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-16 08:59:36'),
(167, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-16 16:46:21'),
(168, 1, 'toko', 5, 'Login Username toko-era', '2025-03-17 06:47:43'),
(169, 8, 'toko', 5, 'Create transaction toko-era', '2025-03-17 06:48:05'),
(170, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-24 04:59:26'),
(171, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-26 03:05:10'),
(172, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-26 07:36:34'),
(173, 1, 'toko', 5, 'Login Username toko-era', '2025-03-26 08:17:36'),
(174, 7, 'toko', 5, 'Lihat Harga toko-era', '2025-03-26 08:22:34'),
(175, 8, 'toko', 5, 'Create transaction toko-era', '2025-03-26 08:22:47'),
(176, 10, 'toko', 5, 'Input Quisioner Transaction 26KRWE43', '2025-03-26 08:33:53'),
(177, 1, 'toko', 5, 'Login Username toko-era', '2025-03-26 09:31:26'),
(178, 1, 'toko', 5, 'Login Username toko-era', '2025-03-27 03:51:24'),
(185, 1, 'toko', 5, 'Login Username toko-era', '2025-03-27 04:52:28'),
(186, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:52:30'),
(187, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:53:42'),
(188, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:53:47'),
(189, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:54:01'),
(190, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:54:06'),
(191, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:56:49'),
(192, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 04:56:54'),
(193, 8, 'toko', 5, 'Create transaction toko-era', '2025-03-27 04:57:49'),
(194, 10, 'toko', 5, 'Input Quisioner Transaction 27TOIU10', '2025-03-27 04:57:56'),
(195, 10, 'toko', 5, 'Input Quisioner Transaction 27TOIU10', '2025-03-27 04:58:16'),
(196, 10, 'toko', 5, 'Input Quisioner Transaction 27TOIU10', '2025-03-27 04:58:24'),
(197, 10, 'toko', 5, 'Input Quisioner Transaction 27TOIU10', '2025-03-27 05:03:44'),
(198, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-27 05:03:59'),
(199, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:04:53'),
(200, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:05:45'),
(201, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:06:36'),
(202, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:07:12'),
(203, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:07:18'),
(204, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:07:55'),
(205, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:08:02'),
(206, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:08:14'),
(207, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:08:22'),
(208, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:08:32'),
(209, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:08:47'),
(210, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:08:59'),
(211, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:10:45'),
(212, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:13:20'),
(213, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:17:55'),
(214, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:18:36'),
(215, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:18:42'),
(216, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:18:49'),
(217, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:19:19'),
(218, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:19:26'),
(219, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:20:44'),
(220, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:20:55'),
(221, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:21:02'),
(222, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:21:26'),
(223, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:21:49'),
(224, 10, 'toko', 5, 'Input Quisioner Transaction 27TOIU10', '2025-03-27 05:26:23'),
(225, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:26:26'),
(226, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:30:31'),
(227, 11, 'toko', 5, 'Input Software Transaction  27TOIU10', '2025-03-27 05:30:59'),
(228, 8, 'toko', 5, 'Create transaction toko-era', '2025-03-27 05:31:22'),
(229, 10, 'toko', 5, 'Input Quisioner Transaction 27EUJX67', '2025-03-27 05:31:57'),
(230, 11, 'toko', 5, 'Input Software Transaction  27EUJX67', '2025-03-27 05:33:37'),
(231, 1, 'toko', 5, 'Login Username toko-era', '2025-03-27 07:14:45'),
(232, 8, 'toko', 5, 'Create transaction toko-era', '2025-03-27 07:14:48'),
(233, 10, 'toko', 5, 'Input Quisioner Transaction 27RVKA63', '2025-03-27 07:14:53'),
(234, 11, 'toko', 5, 'Input Software Transaction  27RVKA63', '2025-03-27 07:14:57'),
(235, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 07:17:45'),
(236, 11, 'toko', 5, 'Input Software Transaction  26KRWE43', '2025-03-27 07:18:53'),
(237, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-03-27 07:56:46'),
(238, 1, 'superadmin', 1, ' Login Admin  hasan', '2025-04-08 11:09:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_harga`
--

DROP TABLE IF EXISTS `master_harga`;
CREATE TABLE `master_harga` (
  `id` int NOT NULL,
  `id_mitra` int NOT NULL,
  `judul_harga` varchar(255) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_harga`
--

INSERT INTO `master_harga` (`id`, `id_mitra`, `judul_harga`, `periode_awal`, `periode_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 14, 'Harga B', '2025-03-01', '2025-03-31', '2025-01-11 23:20:42', '2025-03-26 14:20:45', NULL),
(2, 12, 'Harga AAA', '2025-01-11', '2025-01-30', '2025-01-11 23:51:16', '2025-01-19 21:14:16', '2025-01-11 18:01:00'),
(3, 0, 'Harga Produk A', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(4, 0, 'Harga Produk B', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(5, 0, 'Harga Produk C', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(6, 0, 'Harga Produk D', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(7, 0, 'Harga Produk E', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(8, 0, 'Harga Produk F', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(9, 0, 'Harga Produk G', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(10, 0, 'Harga Produk H', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(11, 0, 'Harga Produk I', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(12, 0, 'Harga Produk J', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(13, 0, 'Harga Produk K', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(14, 0, 'Harga Produk L', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(15, 0, 'Harga Produk M', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(16, 0, 'Harga Produk N', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(17, 0, 'Harga Produk O', '2025-01-01', '2025-03-31', '2025-01-12 13:56:35', '2025-01-12 13:56:35', NULL),
(18, 13, 'hargaA', '2025-01-22', '2025-04-24', '2025-01-22 15:30:56', '2025-02-02 23:14:55', '2025-02-02 17:12:55'),
(19, 14, 'Harga Season 1', '2025-01-15', '2025-11-11', '2025-01-28 09:02:03', '2025-02-02 10:11:59', NULL),
(20, 14, 'aaaa', '2025-02-07', '2025-02-27', '2025-02-02 17:17:13', '2025-02-19 22:16:08', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_harga_details`
--

DROP TABLE IF EXISTS `master_harga_details`;
CREATE TABLE `master_harga_details` (
  `id` int NOT NULL,
  `master_harga_id` int NOT NULL,
  `merk` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `harga_a` int DEFAULT NULL,
  `harga_b` int DEFAULT NULL,
  `harga_c` int DEFAULT NULL,
  `harga_d` int DEFAULT NULL,
  `harga_e` int DEFAULT NULL,
  `harga_fullset` int DEFAULT NULL,
  `harga_promotion` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_harga_details`
--

INSERT INTO `master_harga_details` (`id`, `master_harga_id`, `merk`, `model`, `type`, `storage`, `ram`, `harga_a`, `harga_b`, `harga_c`, `harga_d`, `harga_e`, `harga_fullset`, `harga_promotion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Samsung', 'Galaxy A12', 'Smartphone', '64GB', '4GB', 2500000, 2400000, 2300000, 2200000, 2100000, 3000000, 1500000, '2025-01-12 03:41:54', NULL, NULL),
(2, 1, 'Xiaomi', 'Redmi Note 10', 'Smartphone', '128GB', '6GB', 2800000, 2700000, 2600000, 2500000, 2400000, 3500000, 1800000, '2025-01-11 10:01:00', NULL, NULL),
(3, 1, 'Apple', 'iPhone 12', 'Smartphone', '128GB', '4GB', 12000000, 11800000, 11600000, 11400000, 11200000, 15000000, 10000000, '2025-01-17 08:26:59', NULL, NULL),
(4, 1, 'OPPO', 'Reno 8', 'Smartphone', '256GB', '8GB', 6000000, 5900000, 5800000, 5700000, 5600000, 8000000, 5000000, '2025-01-11 10:03:00', NULL, NULL),
(5, 1, 'Vivo', 'V21', 'Smartphone', '128GB', '6GB', 4500000, 4400000, 4300000, 4200000, 4100000, 6000000, 3500000, '2025-01-11 10:04:00', NULL, NULL),
(6, 1, 'Realme', 'Narzo 50', 'Smartphone', '64GB', '4GB', 3000000, 2900000, 2800000, 2700000, 2600000, 4000000, 2000000, '2025-01-11 10:05:00', NULL, NULL),
(7, 1, 'Samsung', 'Galaxy S21', 'Smartphone', '256GB', '12GB', 15000000, 14800000, 14600000, 14400000, 14200000, 20000000, 13000000, '2025-01-11 10:06:00', NULL, NULL),
(8, 1, 'Xiaomi', 'Poco F3', 'Smartphone', '128GB', '8GB', 4500000, 4400000, 4300000, 4200000, 4100000, 5500000, 3500000, '2025-01-11 10:07:00', NULL, NULL),
(9, 1, 'Apple', 'iPhone 13', 'Smartphone', '128GB', '4GB', 13000000, 12800000, 12600000, 12400000, 12200000, 16000000, 11000000, '2025-01-11 10:08:00', NULL, NULL),
(10, 1, 'OPPO', 'Find X5', 'Smartphone', '256GB', '12GB', 14000000, 13800000, 13600000, 13400000, 13200000, 18000000, 12000000, '2025-01-11 10:09:00', NULL, NULL),
(11, 1, 'lkjk', 'jkj', 'khg', 'kjgk', 'jhk', 87, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-12 03:06:42', NULL, NULL),
(12, 1, 'lkjk', 'jkj', 'khg', 'kjgk', 'jhk', 87, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-12 03:08:24', NULL, NULL),
(13, 1, 'lkjk', 'jkj', 'khg', 'kjgk', 'jhk', 87, 545, 4554512, 656589, 21215, 965, 0, '2025-01-12 03:10:49', NULL, NULL),
(14, 1, 'lklkl', 'kjhjh', 'ikjj', 'nbjh', 'kjjkj', 1000, 10001000, 10000, 1000, 100000, 10000000, 1000, '2025-01-12 03:12:29', NULL, NULL),
(15, 1, 'Merk1', 'Model1', 'Type1', '64GB', '4GB', 1000000, 900000, 850000, 800000, 750000, 5000000, 4500000, '2025-01-12 07:15:10', NULL, NULL),
(16, 1, 'apple', 'iphone 11 pro max', 'Smartphone', '128gb', '16gb', 2000000, 1800000, 1700000, 1600000, 1500000, 10000000, 9000000, '2025-01-12 07:15:10', NULL, NULL),
(17, 18, 'Apple', 'iphone', '12 pro max', '128 GB', '6', 1000, 900, 800, 700, 600, 20, 50, '2025-01-22 15:48:04', NULL, NULL),
(18, 19, 'APPLE', 'IPHONE XR', 'IPHONE XR 64GB', '64GB', '6GB', 4900000, 4760000, 4610000, 4410000, 4220000, 150000, 250000, '2025-01-28 09:11:55', NULL, '2025-02-02 17:16:00'),
(19, 19, 'google', 'sdk_gphone_x86', 'sdk_gphone_x86', '6gb', '2gb', 1000000, 900000, 800000, 700000, 500000, 150000, 25000, '2025-02-02 05:18:47', NULL, NULL),
(20, 19, 'APPLE', 'IPHONE XR', 'IPHONE XR 64GB', '64GB', '6GB', 4900000, 4760000, 4610000, 4410000, 4220000, 150000, 250000, '2025-02-02 16:59:51', NULL, '2025-02-02 17:17:22'),
(21, 19, 'GOOGLE', 'Pixel 4a', 'Pixel 4a 128GB', '128GB', '6GB', 4000000, 3850000, 3700000, 3550000, 3400000, 100000, 200000, '2025-02-02 16:59:51', NULL, NULL),
(22, 19, 'SAMSUNG', 'Galaxy S21', 'Galaxy S21 256GB', '256GB', '8GB', 7000000, 6850000, 6700000, 6550000, 6400000, 200000, 300000, '2025-02-02 16:59:51', NULL, NULL),
(23, 19, 'XIAOMI', 'Redmi Note 10', 'Redmi Note 10 128GB', '128GB', '4GB', 2500000, 2400000, 2300000, 2200000, 2100000, 50000, 100000, '2025-02-02 16:59:51', NULL, NULL),
(24, 19, 'ONEPLUS', 'OnePlus 9', 'OnePlus 9 256GB', '256GB', '12GB', 8000000, 7800000, 7600000, 7400000, 7200000, 250000, 350000, '2025-02-02 16:59:51', NULL, NULL),
(25, 19, 'VIVO', 'Vivo X60', 'Vivo X60 128GB', '128GB', '8GB', 5000000, 4850000, 4700000, 4550000, 4400000, 120000, 220000, '2025-02-02 16:59:51', NULL, NULL),
(26, 19, 'OPPO', 'Oppo Reno 5', 'Oppo Reno 5 128GB', '128GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 16:59:51', NULL, NULL),
(27, 19, 'REALME', 'Realme 8', 'Realme 8 128GB', '128GB', '6GB', 2700000, 2600000, 2500000, 2400000, 2300000, 60000, 160000, '2025-02-02 16:59:51', NULL, NULL),
(28, 19, 'SONY', 'Xperia 5 II', 'Xperia 5 II 256GB', '256GB', '8GB', 6000000, 5850000, 5700000, 5550000, 5400000, 150000, 250000, '2025-02-02 16:59:51', NULL, NULL),
(29, 19, 'HUAWEI', 'Huawei P40', 'Huawei P40 128GB', '128GB', '8GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 16:59:51', NULL, NULL),
(30, 19, 'NOKIA', 'Nokia 8.3', 'Nokia 8.3 128GB', '128GB', '6GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 16:59:51', NULL, NULL),
(31, 19, 'ASUS', 'ROG Phone 5', 'ROG Phone 5 256GB', '256GB', '16GB', 9000000, 8800000, 8600000, 8400000, 8200000, 300000, 400000, '2025-02-02 16:59:51', NULL, NULL),
(32, 19, 'BLACKBERRY', 'Key2', 'Key2 64GB', '64GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 16:59:51', NULL, NULL),
(33, 19, 'GOOGLE', 'Pixel 5', 'Pixel 5 128GB', '128GB', '8GB', 4500000, 4350000, 4200000, 4050000, 3900000, 110000, 210000, '2025-02-02 16:59:51', NULL, NULL),
(34, 19, 'SAMSUNG', 'Galaxy A72', 'Galaxy A72 128GB', '128GB', '6GB', 4000000, 3900000, 3800000, 3700000, 3600000, 100000, 200000, '2025-02-02 16:59:51', NULL, NULL),
(35, 19, 'XIAOMI', 'Mi 11', 'Mi 11 256GB', '256GB', '8GB', 6000000, 5800000, 5600000, 5400000, 5200000, 150000, 250000, '2025-02-02 16:59:51', NULL, NULL),
(36, 19, 'ONEPLUS', 'OnePlus 8T', 'OnePlus 8T 128GB', '128GB', '12GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 16:59:51', NULL, NULL),
(37, 19, 'VIVO', 'Vivo Y20', 'Vivo Y20 64GB', '64GB', '4GB', 1800000, 1700000, 1600000, 1500000, 1400000, 50000, 150000, '2025-02-02 16:59:51', NULL, NULL),
(38, 19, 'OPPO', 'Oppo F19', 'Oppo F19 128GB', '128GB', '6GB', 3000000, 2900000, 2800000, 2700000, 2600000, 70000, 170000, '2025-02-02 16:59:51', NULL, NULL),
(39, 19, 'REALME', 'Realme C15', 'Realme C15 64GB', '64GB', '4GB', 2000000, 1900000, 1800000, 1700000, 1600000, 60000, 160000, '2025-02-02 16:59:51', NULL, NULL),
(40, 19, 'SONY', 'Xperia 1 III', 'Xperia 1 III 256GB', '256GB', '12GB', 8500000, 8300000, 8100000, 7900000, 7700000, 270000, 370000, '2025-02-02 16:59:51', NULL, NULL),
(41, 19, 'HUAWEI', 'Huawei Nova 7i', 'Huawei Nova 7i 128GB', '128GB', '8GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 16:59:51', NULL, NULL),
(42, 19, 'NOKIA', 'Nokia 5.4', 'Nokia 5.4 64GB', '64GB', '4GB', 2200000, 2100000, 2000000, 1900000, 1800000, 50000, 150000, '2025-02-02 16:59:51', NULL, NULL),
(43, 19, 'ASUS', 'Zenfone 7', 'Zenfone 7 128GB', '128GB', '8GB', 5000000, 4800000, 4600000, 4400000, 4200000, 120000, 220000, '2025-02-02 16:59:51', NULL, NULL),
(44, 19, 'APPLE', 'IPHONE XR', 'IPHONE XR 64GB', '64GB', '6GB', 4900000, 4760000, 4610000, 4410000, 4220000, 150000, 250000, '2025-02-02 17:05:47', NULL, NULL),
(45, 19, 'GOOGLE', 'Pixel 4a', 'Pixel 4a 128GB', '128GB', '6GB', 4000000, 3850000, 3700000, 3550000, 3400000, 100000, 200000, '2025-02-02 17:05:47', NULL, NULL),
(46, 19, 'SAMSUNG', 'Galaxy S21', 'Galaxy S21 256GB', '256GB', '8GB', 7000000, 6850000, 6700000, 6550000, 6400000, 200000, 300000, '2025-02-02 17:05:47', NULL, NULL),
(47, 19, 'XIAOMI', 'Redmi Note 10', 'Redmi Note 10 128GB', '128GB', '4GB', 2500000, 2400000, 2300000, 2200000, 2100000, 50000, 100000, '2025-02-02 17:05:47', NULL, NULL),
(48, 19, 'ONEPLUS', 'OnePlus 9', 'OnePlus 9 256GB', '256GB', '12GB', 8000000, 7800000, 7600000, 7400000, 7200000, 250000, 350000, '2025-02-02 17:05:47', NULL, NULL),
(49, 19, 'VIVO', 'Vivo X60', 'Vivo X60 128GB', '128GB', '8GB', 5000000, 4850000, 4700000, 4550000, 4400000, 120000, 220000, '2025-02-02 17:05:47', NULL, NULL),
(50, 19, 'OPPO', 'Oppo Reno 5', 'Oppo Reno 5 128GB', '128GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:05:47', NULL, NULL),
(51, 19, 'REALME', 'Realme 8', 'Realme 8 128GB', '128GB', '6GB', 2700000, 2600000, 2500000, 2400000, 2300000, 60000, 160000, '2025-02-02 17:05:47', NULL, NULL),
(52, 19, 'SONY', 'Xperia 5 II', 'Xperia 5 II 256GB', '256GB', '8GB', 6000000, 5850000, 5700000, 5550000, 5400000, 150000, 250000, '2025-02-02 17:05:47', NULL, NULL),
(53, 19, 'HUAWEI', 'Huawei P40', 'Huawei P40 128GB', '128GB', '8GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:05:47', NULL, NULL),
(54, 19, 'NOKIA', 'Nokia 8.3', 'Nokia 8.3 128GB', '128GB', '6GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:05:47', NULL, NULL),
(55, 19, 'ASUS', 'ROG Phone 5', 'ROG Phone 5 256GB', '256GB', '16GB', 9000000, 8800000, 8600000, 8400000, 8200000, 300000, 400000, '2025-02-02 17:05:47', NULL, NULL),
(56, 19, 'BLACKBERRY', 'Key2', 'Key2 64GB', '64GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:05:47', NULL, NULL),
(57, 19, 'GOOGLE', 'Pixel 5', 'Pixel 5 128GB', '128GB', '8GB', 4500000, 4350000, 4200000, 4050000, 3900000, 110000, 210000, '2025-02-02 17:05:47', NULL, NULL),
(58, 19, 'SAMSUNG', 'Galaxy A72', 'Galaxy A72 128GB', '128GB', '6GB', 4000000, 3900000, 3800000, 3700000, 3600000, 100000, 200000, '2025-02-02 17:05:47', NULL, NULL),
(59, 19, 'XIAOMI', 'Mi 11', 'Mi 11 256GB', '256GB', '8GB', 6000000, 5800000, 5600000, 5400000, 5200000, 150000, 250000, '2025-02-02 17:05:47', NULL, NULL),
(60, 19, 'ONEPLUS', 'OnePlus 8T', 'OnePlus 8T 128GB', '128GB', '12GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:05:47', NULL, NULL),
(61, 19, 'VIVO', 'Vivo Y20', 'Vivo Y20 64GB', '64GB', '4GB', 1800000, 1700000, 1600000, 1500000, 1400000, 50000, 150000, '2025-02-02 17:05:47', NULL, NULL),
(62, 19, 'OPPO', 'Oppo F19', 'Oppo F19 128GB', '128GB', '6GB', 3000000, 2900000, 2800000, 2700000, 2600000, 70000, 170000, '2025-02-02 17:05:47', NULL, NULL),
(63, 19, 'REALME', 'Realme C15', 'Realme C15 64GB', '64GB', '4GB', 2000000, 1900000, 1800000, 1700000, 1600000, 60000, 160000, '2025-02-02 17:05:47', NULL, NULL),
(64, 19, 'SONY', 'Xperia 1 III', 'Xperia 1 III 256GB', '256GB', '12GB', 8500000, 8300000, 8100000, 7900000, 7700000, 270000, 370000, '2025-02-02 17:05:47', NULL, NULL),
(65, 19, 'HUAWEI', 'Huawei Nova 7i', 'Huawei Nova 7i 128GB', '128GB', '8GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:05:47', NULL, NULL),
(66, 19, 'NOKIA', 'Nokia 5.4', 'Nokia 5.4 64GB', '64GB', '4GB', 2200000, 2100000, 2000000, 1900000, 1800000, 50000, 150000, '2025-02-02 17:05:47', NULL, NULL),
(67, 19, 'ASUS', 'Zenfone 7', 'Zenfone 7 128GB', '128GB', '8GB', 5000000, 4800000, 4600000, 4400000, 4200000, 120000, 220000, '2025-02-02 17:05:47', NULL, '2025-02-02 17:18:44'),
(68, 19, 'APPLE', 'IPHONE XR', 'IPHONE XR 64GB', '64GB', '6GB', 4900000, 4760000, 4610000, 4410000, 4220000, 150000, 250000, '2025-02-02 17:06:56', NULL, NULL),
(69, 19, 'GOOGLE', 'Pixel 4a', 'Pixel 4a 128GB', '128GB', '6GB', 4000000, 3850000, 3700000, 3550000, 3400000, 100000, 200000, '2025-02-02 17:06:56', NULL, NULL),
(70, 19, 'SAMSUNG', 'Galaxy S21', 'Galaxy S21 256GB', '256GB', '8GB', 7000000, 6850000, 6700000, 6550000, 6400000, 200000, 300000, '2025-02-02 17:06:56', NULL, NULL),
(71, 19, 'XIAOMI', 'Redmi Note 10', 'Redmi Note 10 128GB', '128GB', '4GB', 2500000, 2400000, 2300000, 2200000, 2100000, 50000, 100000, '2025-02-02 17:06:56', NULL, NULL),
(72, 19, 'ONEPLUS', 'OnePlus 9', 'OnePlus 9 256GB', '256GB', '12GB', 8000000, 7800000, 7600000, 7400000, 7200000, 250000, 350000, '2025-02-02 17:06:56', NULL, NULL),
(73, 19, 'VIVO', 'Vivo X60', 'Vivo X60 128GB', '128GB', '8GB', 5000000, 4850000, 4700000, 4550000, 4400000, 120000, 220000, '2025-02-02 17:06:56', NULL, NULL),
(74, 19, 'OPPO', 'Oppo Reno 5', 'Oppo Reno 5 128GB', '128GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:06:56', NULL, NULL),
(75, 19, 'REALME', 'Realme 8', 'Realme 8 128GB', '128GB', '6GB', 2700000, 2600000, 2500000, 2400000, 2300000, 60000, 160000, '2025-02-02 17:06:56', NULL, NULL),
(76, 19, 'SONY', 'Xperia 5 II', 'Xperia 5 II 256GB', '256GB', '8GB', 6000000, 5850000, 5700000, 5550000, 5400000, 150000, 250000, '2025-02-02 17:06:56', NULL, NULL),
(77, 19, 'HUAWEI', 'Huawei P40', 'Huawei P40 128GB', '128GB', '8GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:06:56', NULL, NULL),
(78, 19, 'NOKIA', 'Nokia 8.3', 'Nokia 8.3 128GB', '128GB', '6GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:06:56', NULL, NULL),
(79, 19, 'ASUS', 'ROG Phone 5', 'ROG Phone 5 256GB', '256GB', '16GB', 9000000, 8800000, 8600000, 8400000, 8200000, 300000, 400000, '2025-02-02 17:06:56', NULL, NULL),
(80, 19, 'BLACKBERRY', 'Key2', 'Key2 64GB', '64GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:06:56', NULL, NULL),
(81, 19, 'GOOGLE', 'Pixel 5', 'Pixel 5 128GB', '128GB', '8GB', 4500000, 4350000, 4200000, 4050000, 3900000, 110000, 210000, '2025-02-02 17:06:56', NULL, NULL),
(82, 19, 'SAMSUNG', 'Galaxy A72', 'Galaxy A72 128GB', '128GB', '6GB', 4000000, 3900000, 3800000, 3700000, 3600000, 100000, 200000, '2025-02-02 17:06:56', NULL, NULL),
(83, 19, 'XIAOMI', 'Mi 11', 'Mi 11 256GB', '256GB', '8GB', 6000000, 5800000, 5600000, 5400000, 5200000, 150000, 250000, '2025-02-02 17:06:56', NULL, NULL),
(84, 19, 'ONEPLUS', 'OnePlus 8T', 'OnePlus 8T 128GB', '128GB', '12GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:06:56', NULL, NULL),
(85, 19, 'VIVO', 'Vivo Y20', 'Vivo Y20 64GB', '64GB', '4GB', 1800000, 1700000, 1600000, 1500000, 1400000, 50000, 150000, '2025-02-02 17:06:56', NULL, NULL),
(86, 19, 'OPPO', 'Oppo F19', 'Oppo F19 128GB', '128GB', '6GB', 3000000, 2900000, 2800000, 2700000, 2600000, 70000, 170000, '2025-02-02 17:06:56', NULL, NULL),
(87, 19, 'REALME', 'Realme C15', 'Realme C15 64GB', '64GB', '4GB', 2000000, 1900000, 1800000, 1700000, 1600000, 60000, 160000, '2025-02-02 17:06:56', NULL, NULL),
(88, 19, 'SONY', 'Xperia 1 III', 'Xperia 1 III 256GB', '256GB', '12GB', 8500000, 8300000, 8100000, 7900000, 7700000, 270000, 370000, '2025-02-02 17:06:56', NULL, NULL),
(89, 19, 'HUAWEI', 'Huawei Nova 7i', 'Huawei Nova 7i 128GB', '128GB', '8GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:06:56', NULL, NULL),
(90, 19, 'NOKIA', 'Nokia 5.4', 'Nokia 5.4 64GB', '64GB', '4GB', 2200000, 2100000, 2000000, 1900000, 1800000, 50000, 150000, '2025-02-02 17:06:56', NULL, NULL),
(91, 19, 'ASUS', 'Zenfone 7', 'Zenfone 7 128GB', '128GB', '8GB', 5000000, 4800000, 4600000, 4400000, 4200000, 120000, 220000, '2025-02-02 17:06:56', NULL, NULL),
(92, 19, 'APPLE', 'iPhone 11 Pro Max', 'iPhone 11 Pro Max', '4GB', '256GB', 7900000, 7760000, 7610000, 7410000, 5220000, 150000, 250000, '2025-02-05 15:36:45', NULL, NULL),
(93, 19, 'GOOGLE', 'Pixel 4a', 'Pixel 4a 128GB', '128GB', '6GB', 4000000, 3850000, 3700000, 3550000, 3400000, 100000, 200000, '2025-02-02 17:09:08', NULL, NULL),
(94, 19, 'SAMSUNG', 'Galaxy S21', 'Galaxy S21 256GB', '256GB', '8GB', 7000000, 6850000, 6700000, 6550000, 6400000, 200000, 300000, '2025-02-02 17:09:08', NULL, NULL),
(95, 19, 'XIAOMI', 'Redmi Note 10', 'Redmi Note 10 128GB', '128GB', '4GB', 2500000, 2400000, 2300000, 2200000, 2100000, 50000, 100000, '2025-02-02 17:09:08', NULL, NULL),
(96, 19, 'ONEPLUS', 'OnePlus 9', 'OnePlus 9 256GB', '256GB', '12GB', 8000000, 7800000, 7600000, 7400000, 7200000, 250000, 350000, '2025-02-02 17:09:08', NULL, NULL),
(97, 19, 'VIVO', 'Vivo X60', 'Vivo X60 128GB', '128GB', '8GB', 5000000, 4850000, 4700000, 4550000, 4400000, 120000, 220000, '2025-02-02 17:09:08', NULL, NULL),
(98, 19, 'OPPO', 'Oppo Reno 5', 'Oppo Reno 5 128GB', '128GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:09:08', NULL, NULL),
(99, 19, 'REALME', 'Realme 8', 'Realme 8 128GB', '128GB', '6GB', 2700000, 2600000, 2500000, 2400000, 2300000, 60000, 160000, '2025-02-02 17:09:08', NULL, NULL),
(100, 19, 'SONY', 'Xperia 5 II', 'Xperia 5 II 256GB', '256GB', '8GB', 6000000, 5850000, 5700000, 5550000, 5400000, 150000, 250000, '2025-02-02 17:09:08', NULL, NULL),
(101, 19, 'HUAWEI', 'Huawei P40', 'Huawei P40 128GB', '128GB', '8GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:09:08', NULL, NULL),
(102, 19, 'NOKIA', 'Nokia 8.3', 'Nokia 8.3 128GB', '128GB', '6GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:09:08', NULL, NULL),
(103, 19, 'ASUS', 'ROG Phone 5', 'ROG Phone 5 256GB', '256GB', '16GB', 9000000, 8800000, 8600000, 8400000, 8200000, 300000, 400000, '2025-02-02 17:09:08', NULL, NULL),
(104, 19, 'BLACKBERRY', 'Key2', 'Key2 64GB', '64GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:09:08', NULL, NULL),
(105, 19, 'GOOGLE', 'Pixel 5', 'Pixel 5 128GB', '128GB', '8GB', 4500000, 4350000, 4200000, 4050000, 3900000, 110000, 210000, '2025-02-02 17:09:08', NULL, NULL),
(106, 19, 'SAMSUNG', 'Galaxy A72', 'Galaxy A72 128GB', '128GB', '6GB', 4000000, 3900000, 3800000, 3700000, 3600000, 100000, 200000, '2025-02-02 17:09:08', NULL, NULL),
(107, 19, 'XIAOMI', 'Mi 11', 'Mi 11 256GB', '256GB', '8GB', 6000000, 5800000, 5600000, 5400000, 5200000, 150000, 250000, '2025-02-02 17:09:08', NULL, NULL),
(108, 19, 'ONEPLUS', 'OnePlus 8T', 'OnePlus 8T 128GB', '128GB', '12GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:09:08', NULL, NULL),
(109, 19, 'VIVO', 'Vivo Y20', 'Vivo Y20 64GB', '64GB', '4GB', 1800000, 1700000, 1600000, 1500000, 1400000, 50000, 150000, '2025-02-02 17:09:08', NULL, NULL),
(110, 19, 'OPPO', 'Oppo F19', 'Oppo F19 128GB', '128GB', '6GB', 3000000, 2900000, 2800000, 2700000, 2600000, 70000, 170000, '2025-02-02 17:09:08', NULL, NULL),
(111, 19, 'REALME', 'Realme C15', 'Realme C15 64GB', '64GB', '4GB', 2000000, 1900000, 1800000, 1700000, 1600000, 60000, 160000, '2025-02-02 17:09:08', NULL, NULL),
(112, 19, 'SONY', 'Xperia 1 III', 'Xperia 1 III 256GB', '256GB', '12GB', 8500000, 8300000, 8100000, 7900000, 7700000, 270000, 370000, '2025-02-02 17:09:08', NULL, NULL),
(113, 19, 'HUAWEI', 'Huawei Nova 7i', 'Huawei Nova 7i 128GB', '128GB', '8GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:09:08', NULL, NULL),
(114, 19, 'NOKIA', 'Nokia 5.4', 'Nokia 5.4 64GB', '64GB', '4GB', 2200000, 2100000, 2000000, 1900000, 1800000, 50000, 150000, '2025-02-02 17:09:08', NULL, NULL),
(115, 19, 'ASUS', 'Zenfone 7', 'Zenfone 7 128GB', '128GB', '8GB', 5000000, 4800000, 4600000, 4400000, 4200000, 120000, 220000, '2025-02-02 17:09:08', NULL, NULL),
(116, 19, 'APPLE', 'iPhone 16', 'iPhone 16', '128GB', '16GB', 14900000, 14760000, 14610000, 14410000, 14220000, 150000, 250000, '2025-02-05 15:34:41', NULL, NULL),
(117, 19, 'GOOGLE', 'Pixel 4a', 'Pixel 4a 128GB', '128GB', '6GB', 4000000, 3850000, 3700000, 3550000, 3400000, 100000, 200000, '2025-02-02 17:11:33', NULL, NULL),
(118, 19, 'SAMSUNG', 'Galaxy S21', 'Galaxy S21 256GB', '256GB', '8GB', 7000000, 6850000, 6700000, 6550000, 6400000, 200000, 300000, '2025-02-02 17:11:33', NULL, NULL),
(119, 19, 'XIAOMI', 'Redmi Note 10', 'Redmi Note 10 128GB', '128GB', '4GB', 2500000, 2400000, 2300000, 2200000, 2100000, 50000, 100000, '2025-02-02 17:11:33', NULL, NULL),
(120, 19, 'ONEPLUS', 'OnePlus 9', 'OnePlus 9 256GB', '256GB', '12GB', 8000000, 7800000, 7600000, 7400000, 7200000, 250000, 350000, '2025-02-02 17:11:33', NULL, NULL),
(121, 19, 'VIVO', 'Vivo X60', 'Vivo X60 128GB', '128GB', '8GB', 5000000, 4850000, 4700000, 4550000, 4400000, 120000, 220000, '2025-02-02 17:11:33', NULL, NULL),
(122, 19, 'OPPO', 'Oppo Reno 5', 'Oppo Reno 5 128GB', '128GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:11:33', NULL, NULL),
(123, 19, 'REALME', 'Realme 8', 'Realme 8 128GB', '128GB', '6GB', 2700000, 2600000, 2500000, 2400000, 2300000, 60000, 160000, '2025-02-02 17:11:33', NULL, NULL),
(124, 19, 'SONY', 'Xperia 5 II', 'Xperia 5 II 256GB', '256GB', '8GB', 6000000, 5850000, 5700000, 5550000, 5400000, 150000, 250000, '2025-02-02 17:11:33', NULL, NULL),
(125, 19, 'HUAWEI', 'Huawei P40', 'Huawei P40 128GB', '128GB', '8GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:11:33', NULL, NULL),
(126, 19, 'NOKIA', 'Nokia 8.3', 'Nokia 8.3 128GB', '128GB', '6GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:11:33', NULL, NULL),
(127, 19, 'ASUS', 'ROG Phone 5', 'ROG Phone 5 256GB', '256GB', '16GB', 9000000, 8800000, 8600000, 8400000, 8200000, 300000, 400000, '2025-02-02 17:11:33', NULL, NULL),
(128, 19, 'BLACKBERRY', 'Key2', 'Key2 64GB', '64GB', '6GB', 3500000, 3400000, 3300000, 3200000, 3100000, 80000, 180000, '2025-02-02 17:11:33', NULL, NULL),
(129, 19, 'GOOGLE', 'Pixel 5', 'Pixel 5 128GB', '128GB', '8GB', 4500000, 4350000, 4200000, 4050000, 3900000, 110000, 210000, '2025-02-02 17:11:33', NULL, NULL),
(130, 19, 'SAMSUNG', 'Galaxy A72', 'Galaxy A72 128GB', '128GB', '6GB', 4000000, 3900000, 3800000, 3700000, 3600000, 100000, 200000, '2025-02-02 17:11:33', NULL, NULL),
(131, 19, 'XIAOMI', 'Mi 11', 'Mi 11 256GB', '256GB', '8GB', 6000000, 5800000, 5600000, 5400000, 5200000, 150000, 250000, '2025-02-02 17:11:33', NULL, NULL),
(132, 19, 'ONEPLUS', 'OnePlus 8T', 'OnePlus 8T 128GB', '128GB', '12GB', 5500000, 5300000, 5100000, 4900000, 4700000, 130000, 230000, '2025-02-02 17:11:33', NULL, NULL),
(133, 19, 'VIVO', 'Vivo Y20', 'Vivo Y20 64GB', '64GB', '4GB', 1800000, 1700000, 1600000, 1500000, 1400000, 50000, 150000, '2025-02-02 17:11:33', NULL, NULL),
(134, 19, 'OPPO', 'Oppo F19', 'Oppo F19 128GB', '128GB', '6GB', 3000000, 2900000, 2800000, 2700000, 2600000, 70000, 170000, '2025-02-02 17:11:33', NULL, NULL),
(135, 19, 'REALME', 'Realme C15', 'Realme C15 64GB', '64GB', '4GB', 2000000, 1900000, 1800000, 1700000, 1600000, 60000, 160000, '2025-02-02 17:11:33', NULL, NULL),
(136, 19, 'SONY', 'Xperia 1 III', 'Xperia 1 III 256GB', '256GB', '12GB', 8500000, 8300000, 8100000, 7900000, 7700000, 270000, 370000, '2025-02-02 17:11:33', NULL, NULL),
(137, 19, 'HUAWEI', 'Huawei Nova 7i', 'Huawei Nova 7i 128GB', '128GB', '8GB', 3200000, 3100000, 3000000, 2900000, 2800000, 70000, 170000, '2025-02-02 17:11:33', NULL, NULL),
(138, 19, 'NOKIA', 'Nokia 5.4', 'Nokia 5.4 64GB', '64GB', '4GB', 2200000, 2100000, 2000000, 1900000, 1800000, 50000, 150000, '2025-02-02 17:11:33', NULL, NULL),
(139, 19, 'ASUS', 'Zenfone 7', 'Zenfone 7 128GB', '128GB', '8GB', 5000000, 4800000, 4600000, 4400000, 4200000, 120000, 220000, '2025-02-02 17:11:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_mitra`
--

DROP TABLE IF EXISTS `master_mitra`;
CREATE TABLE `master_mitra` (
  `id_master_mitra` int NOT NULL,
  `nama_mitra` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qty_toko` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_mitra`
--

INSERT INTO `master_mitra` (`id_master_mitra`, `nama_mitra`, `username`, `password`, `qty_toko`, `created_at`, `updated_at`, `last_login`, `deleted_at`) VALUES
(11, 'lkllkl', 'lklklk', 'EMKR4oNYTPnW7FVAyZ73JAv+n6xtM0rHgX7SPvp+TnUuGSULG/eMsbW/SclKxYw4rYNi0ldj8yIIww5R/h4kIA==', 0, '0000-00-00 00:00:00', NULL, NULL, '2025-01-28 07:30:20'),
(12, 'mitra Hasan', 'hasan', 'AVQ6Bfez/QR3am8PIvfNVjD7V5kNV+6uJps1/iulu9I3dlDtoE5Ao/jY6FZmxPq3ChxxRmcuiVEaQZmMbyDWSA==', 0, '0000-00-00 00:00:00', NULL, '2025-01-28 04:07:01', '2025-01-28 07:30:22'),
(13, 'abdul', 'abdul', 'F5UrHeqGwydu2fYp/thE/HZ4XnsWuDczUH3ljb2G3g9vN57VOhtawFh2+OUOGfkHGNbEROknhm2p40yg3KNQpw==', 0, '0000-00-00 00:00:00', NULL, '2025-01-27 12:59:43', '2025-01-28 07:30:17'),
(14, 'mitra-era', 'mitra-era', '8rT/kDXCho1TIbGEiV6V1kT+hSWPfoFp9VQ+vJZZVOO7RhYoPJMjaz941apM4kj6y8MjxibvrPUB7Ckh+Z2NbQ==', 0, '0000-00-00 00:00:00', NULL, '2025-03-27 07:22:16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `otp`
--

DROP TABLE IF EXISTS `otp`;
CREATE TABLE `otp` (
  `id` int NOT NULL,
  `id_toko` int NOT NULL,
  `kode_otp` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `otp`
--

INSERT INTO `otp` (`id`, `id_toko`, `kode_otp`, `created_at`, `expired_at`) VALUES
(9, 1, '144959', '2025-02-01 16:00:57', '2025-02-01 16:30:57'),
(10, 1, '279454', '2025-03-17 06:47:33', '2025-03-17 07:17:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `policies`
--

DROP TABLE IF EXISTS `policies`;
CREATE TABLE `policies` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `policies`
--

INSERT INTO `policies` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'kjkj', 'kebijakannn nih bos', '2025-01-10 00:06:40', '2025-01-09 18:07:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id_rating` int NOT NULL,
  `id_berita` int NOT NULL,
  `id_pembaca` int DEFAULT NULL,
  `rating` int NOT NULL,
  `review` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `redaksi`
--

DROP TABLE IF EXISTS `redaksi`;
CREATE TABLE `redaksi` (
  `id_redaksi` int NOT NULL,
  `nama_redaksi` varchar(255) NOT NULL,
  `email_redaksi` varchar(255) NOT NULL,
  `username_redaksi` varchar(255) NOT NULL,
  `password_redaksi` varchar(255) NOT NULL,
  `foto_redaksi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `refresh_tokens`
--

DROP TABLE IF EXISTS `refresh_tokens`;
CREATE TABLE `refresh_tokens` (
  `id` int NOT NULL,
  `id_toko` int NOT NULL,
  `refresh_token` text NOT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expired_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `refresh_tokens`
--

INSERT INTO `refresh_tokens` (`id`, `id_toko`, `refresh_token`, `revoked`, `created_at`, `expired_at`) VALUES
(1, 1, '$2y$10$9f1Fvg1gSqp5TXW9Mru.7OTUZPaudDnY1GmVZBNP.eYXUB8wIthGq', 0, '2025-01-17 07:03:56', '2025-01-24 01:03:56'),
(2, 1, '$2y$10$vr7noazV5ZFLEjqnfNiVweBfbl7knfPvlCPCGe6oDxJmICf97JC8i', 0, '2025-01-20 04:34:38', '2025-01-26 22:34:38'),
(3, 1, '$2y$10$v4p9Q8p1sjthZN5qGZHuZutUBcq4aIsKFZfPj7jpRP0IqXdwD8lpa', 0, '2025-01-20 04:44:01', '2025-01-26 22:44:01'),
(4, 1, '$2y$10$eO77IYqd6dwH6PJQ4MXs2.bXDbSsUuo4BmTYFnUusPnq6mxUSk2sC', 0, '2025-01-20 04:45:20', '2025-01-26 22:45:20'),
(5, 4, '$2y$10$LxXXpJrPRGATq7P6JyUX7OYjsSQDxH4EDGhV/xkqXv6pBnRtX4SXG', 0, '2025-01-28 07:36:13', '2025-02-04 01:36:13'),
(6, 5, '$2y$10$DH7ASpkcq.rdFQ.2Cbtvge817skVAty2fFLJD9OYSbuc6zJL/jOHu', 0, '2025-01-29 06:17:26', '2025-02-05 00:17:26'),
(7, 5, '$2y$10$P1Idd0/wqjIHw8o/G5wb2.yEPWca.nQqoB556AURTK.ZudAlb.6.y', 0, '2025-01-29 06:22:49', '2025-02-05 00:22:49'),
(8, 5, '$2y$10$3dVerHpOhN2L3GNRlZmRK.88NQUvXdAgY3OjzlyHdGVbsZV1yrgki', 0, '2025-01-29 06:24:05', '2025-02-05 00:24:05'),
(9, 5, '$2y$10$ghgIzzAQihCktbWhlXxrvevgvsUFqHMUyyyM6Ggln2YgzVXLlfHQO', 0, '2025-01-29 06:27:05', '2025-02-05 00:27:04'),
(10, 5, '$2y$10$5Zso7MbPZYN6hzrVldNgJOACRtg1ORZsjVA1j0NmByN9a/3sVMaXa', 0, '2025-01-29 06:27:26', '2025-02-05 00:27:26'),
(11, 5, '$2y$10$Cn9zAQlLf4QQs/OSfwpkV.TnYLwJX4YIwtokxRAs3Hp7bzh8wsFIG', 0, '2025-01-29 07:51:29', '2025-02-05 01:51:29'),
(12, 5, '$2y$10$JzWrFrJNltLp0mVUxIeHo.BMvii9x3yYYhht9esTZygAaKdHAyf0S', 0, '2025-01-29 10:37:16', '2025-02-05 04:37:16'),
(13, 5, '$2y$10$BG7N.LyYmWmHm5h.Ib8jTOpDy4dStuat560QD8UTIX.XbHJgViXma', 0, '2025-01-29 10:37:45', '2025-02-05 04:37:45'),
(14, 5, '$2y$10$SAwsrKEWvqibZVAMDxo3aOoyUSefxyTVPAJEAzjaheO32U3grcZmC', 0, '2025-01-29 10:58:24', '2025-02-05 04:58:24'),
(15, 5, '$2y$10$0zmECJa8Su6ztzBQpq5fFesOIS4vnE0SkLoOcM00VSXNFIQBIIC8S', 0, '2025-01-29 15:08:19', '2025-02-05 09:08:19'),
(16, 5, '$2y$10$sk7RUWMw/YGrwE4oGMWAy.Wq1ZMBhi48pvG.xUsMIvkXE18/nCHW2', 0, '2025-01-30 15:43:36', '2025-02-06 09:43:36'),
(17, 5, '$2y$10$xoaxFq30U6bJKJqyzojwpu.onzkKYWHVWDpmoBOAEIZWbnVd.2oXG', 0, '2025-01-31 15:45:01', '2025-02-07 09:45:01'),
(18, 1, '$2y$10$s.6.agHgmm5w7CvZQBv9UektqXDhcdCs1hsEGXk1xb7.Mf/vpWGBa', 0, '2025-01-31 15:47:36', '2025-02-07 09:47:36'),
(19, 5, '$2y$10$HvK1btQDy6a9Y6lWbGrX7.9D0/3zCY31/JLJKVO5ztH1sEXdGEWue', 0, '2025-02-01 15:01:19', '2025-02-08 09:01:19'),
(20, 5, '$2y$10$TVr2Hs4D72dhHFyFriUyh.TGYx.NaRFazD4BOXixhvnnfm.F4RfmK', 0, '2025-02-01 15:46:41', '2025-02-08 09:46:41'),
(21, 5, '$2y$10$BfuZ2uFPXXUCgTA.jsQp0OdahoEw6Raww.7Sa4gbS.BrfhjmBUw6i', 0, '2025-02-01 16:05:15', '2025-02-08 10:05:14'),
(22, 5, '$2y$10$UWxVar8ZpBvb1tlGQDvlfOytp5WF.Mu5s51rzTz1vOWj1kS41Laa6', 0, '2025-02-01 16:07:01', '2025-02-08 10:07:01'),
(23, 5, '$2y$10$Th23JTziRcMCsZHxOv1pGO1nE.e8A7.1pvdNrbzuxtLFyJY.SWvri', 0, '2025-02-01 16:26:14', '2025-02-08 10:26:14'),
(24, 5, '$2y$10$HFPa5j7r/UuDFToQ0.9i9.r5lbvBRkieX3NeGU3MdE.9Tyj5wF.K2', 0, '2025-02-01 16:35:23', '2025-02-08 10:35:23'),
(25, 5, '$2y$10$Ff97Ka0Pc7ja1CrJW7yOKegyBBq0Alqqc7h.qSOKHUYISqC9aQzHG', 0, '2025-02-01 16:41:07', '2025-02-08 10:41:07'),
(26, 5, '$2y$10$bIkgNZqAY/PPQkxVnwxI7u7RQRNlLRYuL2qtjO2qvA/C10W7Xtzvm', 0, '2025-02-01 16:42:28', '2025-02-08 10:42:28'),
(27, 5, '$2y$10$cGGWfDBUQnjz3pVjmwNLnu2qWNeqD1nqJ6hyy3YFkSfOqDT0W5eje', 0, '2025-02-01 17:16:12', '2025-02-08 11:16:12'),
(28, 5, '$2y$10$k3H1OKIvnWIcwPGSkI7GIuI3EijX3fYl8/oHVGBeFWUYTa00Di7bm', 0, '2025-02-01 17:19:32', '2025-02-08 11:19:32'),
(29, 5, '$2y$10$Bwfr9MrK/obhmZcYCydDduuGxj0nR8b2hRlgnaLZeWBb5bm/1A/S.', 0, '2025-02-01 17:21:14', '2025-02-08 11:21:14'),
(30, 5, '$2y$10$08aFw9CL6RaQcF5h8hx//e4PSf61oDEgEMj3AFI8/1ubpSYFo656u', 0, '2025-02-02 03:07:15', '2025-02-08 21:07:15'),
(31, 5, '$2y$10$K/KmEd9d1VEoH8J4untQ5.pRYAGkvRBSBZMo.CXDhZX4.2/QeeWdm', 0, '2025-02-02 03:08:24', '2025-02-08 21:08:24'),
(32, 5, '$2y$10$9xGFhnnBpoVa/dArssEjJO.VpmptyKjyELuxbeCAf03CRKKr4MgFG', 0, '2025-02-02 03:26:13', '2025-02-08 21:26:13'),
(33, 5, '$2y$10$7.Qnvz5ZfSrgjSAb7R24ievwFycZl0VP2h4oI2LE3IArqY69wA.hW', 0, '2025-02-02 04:03:44', '2025-02-08 22:03:44'),
(34, 5, '$2y$10$d8XJBj1xEKJtNhJGvNq/L.LDfq.HetogUOS5xWUIvoe7LqlT2WohW', 0, '2025-02-02 04:05:20', '2025-02-08 22:05:20'),
(35, 5, '$2y$10$5gnQi6.TchzfT07j6AOWSOIBDt62B1WGeS6kUx.LI4MHhck99XSfe', 0, '2025-02-02 04:16:37', '2025-02-08 22:16:37'),
(36, 5, '$2y$10$PI7t/xzXQ1n9Xqqf6UlDZem5fFxNFhG4FgttvvgGJ7nPe6Wpsu95u', 0, '2025-02-02 04:24:51', '2025-02-08 22:24:51'),
(37, 5, '$2y$10$pWriy2PJ4A3E.JdwV4XQnOJFkXdntksAaToHzfe2Oh4P2ghxmencG', 0, '2025-02-02 05:18:43', '2025-02-08 23:18:43'),
(38, 5, '$2y$10$90b1AUB3d3eh0KSdSayA8.ci/qF.JP.I1MZkxx9KRkabTVN6.BYmO', 0, '2025-02-03 14:15:33', '2025-02-10 08:15:33'),
(39, 5, '$2y$10$EGAG0Wwj13wfs.G5fb6NIueKutzVDfug6bdMZMQcwgyG1cguf2Fn6', 0, '2025-02-03 14:34:17', '2025-02-10 08:34:16'),
(40, 5, '$2y$10$H1m93.gJvo/nXH6mh/uKiOgIfngbbniC.snWEUMT/71MK5zxEo78S', 0, '2025-02-03 15:35:04', '2025-02-10 09:35:04'),
(41, 5, '$2y$10$UX1jD1RoUz1qikjBNXZgcOrzsaZgaixf42H2ET.xyTE4r0cOhHXUO', 0, '2025-02-04 15:48:09', '2025-02-11 09:48:09'),
(42, 5, '$2y$10$KZCtS6NNWg3OY48Rng5Hu.Znm2nIPs5/YtJcUNPYK7msvTnODucJ6', 0, '2025-02-04 16:12:41', '2025-02-11 10:12:41'),
(43, 5, '$2y$10$aehy4YMHBHjDHDYniGXcRO5I.Tvk3mT0P3Yr0.qz7grKeezYzM0gy', 0, '2025-02-04 16:13:39', '2025-02-11 10:13:39'),
(44, 5, '$2y$10$eO6vY8.l4nVqJZLXXqg6WOnkOTM.aLC53lb9q4U7VmTbyIKaHXvze', 0, '2025-02-04 16:38:11', '2025-02-11 10:38:11'),
(45, 5, '$2y$10$fA9Ocuyd7tSzOoyaF5u4Qu5uuVu.BY9x.ACuOR0YEfYWGQwNNFmV6', 0, '2025-02-04 16:52:46', '2025-02-11 10:52:46'),
(46, 5, '$2y$10$ViMHiNwfPYNyB4t/NPbaT.q0Qf0YxWicc1Tsor.pZm3Guz9ilm2u2', 0, '2025-02-04 17:14:40', '2025-02-11 11:14:40'),
(47, 5, '$2y$10$kSyQe7CB75VuV52IdWoKy.MtDfXwYHHRQDv7V7aQX0M0AY/mwSlq2', 0, '2025-02-05 14:35:03', '2025-02-12 08:35:03'),
(48, 5, '$2y$10$PDeQCGAzbKSml3lgER/ZeOkNND48gXT4CB34t2mAFbQDwnpkN6HG6', 0, '2025-02-05 15:42:01', '2025-02-12 09:42:01'),
(49, 5, '$2y$10$WqCeAn6JYEYntz15WAQJueNMZ3cThKJXDg9J0.BTleK/AH2JplJ2.', 0, '2025-02-06 13:13:25', '2025-02-13 07:13:25'),
(50, 5, '$2y$10$rS6bs6YakWDA7HGm1amIJ.a4aqmNTh77rZWOU2N7AUujKFGoGHaUW', 0, '2025-02-07 15:42:54', '2025-02-14 09:42:54'),
(51, 5, '$2y$10$A2ZpYeB.uue09NCms6kj1uYli8x00gjYqzvQCRsecbV4YRQ4DrTGq', 0, '2025-02-07 15:58:53', '2025-02-14 09:58:52'),
(52, 5, '$2y$10$Fj28mx61ly9p.P0oqku2aOaVR5DH32YvSpnOqBiG1iBMJIXLORgZ6', 0, '2025-02-07 17:17:10', '2025-02-14 11:17:10'),
(53, 5, '$2y$10$k7lX15bUSySDG29ogukIBej0UWM3lFGIBcIyjveDjSQY5qZsOqWFW', 0, '2025-02-07 17:43:17', '2025-02-14 11:43:17'),
(54, 5, '$2y$10$gCdjD89GmaMJLtHbM3qrC.cMSdR4zXc86x4sHUMEe64xulj5wq/JK', 0, '2025-02-08 13:26:45', '2025-02-15 07:26:45'),
(55, 5, '$2y$10$0z5Ct8j1gwYHWea23530LOvTXXlMJWlASA1fc7hXTWEUJD9qdyA2e', 0, '2025-02-08 16:16:50', '2025-02-15 10:16:50'),
(56, 5, '$2y$10$HeXoxXHm/a93rOFSSSMDnOS4fLVGPTC4eB9AZ66HTPejBRWjsb1mG', 0, '2025-02-08 18:07:54', '2025-02-15 12:07:54'),
(57, 5, '$2y$10$t2hg6u9LGA7MGw6rk0nCH.4f7nDFpS62emQlp7YTHB5KkMXDWxDRO', 0, '2025-02-08 19:16:10', '2025-02-15 13:16:09'),
(58, 5, '$2y$10$vVXiME9caIDF9muO11/6V.CVGg5p0ylWwtmiV7NAahuEPoaXUc67m', 0, '2025-02-10 14:15:43', '2025-02-17 08:15:43'),
(59, 5, '$2y$10$8rNbS19Ria01kpFlrfB2EeRU.KHfYeHntfFh6cfwGVeUywOQKiyly', 0, '2025-03-17 05:47:42', '2025-03-23 23:47:42'),
(60, 5, '$2y$10$QJNLtVAzcdqlIv9G9vqq.edF/xVOYn0hsTGVXY6O6OMxdjo5WKitK', 0, '2025-03-26 07:17:36', '2025-04-02 01:17:36'),
(61, 5, '$2y$10$ZWZ.tRrWoDeAmJzoRAsuNurz9K0zKdJNuLTxZjQbrMWjzDGBROjeO', 0, '2025-03-26 08:31:26', '2025-04-02 02:31:26'),
(62, 5, '$2y$10$eX4jSwxqp71Tzk9aqRSVNO53POLR4rA1xfOBahRX.8bPHEeDZwJXq', 0, '2025-03-27 02:51:24', '2025-04-02 20:51:24'),
(63, 5, '$2y$10$rt7Uu2J/e6BtgBUZ5SWpU.yiSv9NYTJ5vgE6g3itqymEyoAqvnolC', 0, '2025-03-27 03:52:28', '2025-04-02 21:52:28'),
(64, 5, '$2y$10$xnFbRNxrx8YgoEcRk5JJLutIqm1SDWQ1tvX8kBJH2YgunWMPq2S/G', 0, '2025-03-27 06:14:45', '2025-04-03 00:14:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi_komentar_editor`
--

DROP TABLE IF EXISTS `revisi_komentar_editor`;
CREATE TABLE `revisi_komentar_editor` (
  `id_revisi_editor` int NOT NULL,
  `id_berita` int NOT NULL,
  `revisi_ke` int NOT NULL,
  `before_revisi` text NOT NULL,
  `after_revisi` text,
  `komentar_editor` text,
  `id_editor` int DEFAULT NULL,
  `status_revisi` enum('sent_to_redaksi','approved','rejected') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi_komentar_redaksi`
--

DROP TABLE IF EXISTS `revisi_komentar_redaksi`;
CREATE TABLE `revisi_komentar_redaksi` (
  `id_revisi_redaksi` int NOT NULL,
  `id_berita` int NOT NULL,
  `revisi_ke` int NOT NULL,
  `before_revisi` text NOT NULL,
  `after_revisi` text,
  `komentar_redaksi` text,
  `id_redaksi` int DEFAULT NULL,
  `status_revisi` enum('sent_to_editor','approved','rejected') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `master_admin` tinyint(1) DEFAULT '0',
  `master_log` int NOT NULL DEFAULT '0',
  `master_role` int NOT NULL DEFAULT '0',
  `terms` tinyint(1) NOT NULL,
  `policy` tinyint(1) NOT NULL DEFAULT '1',
  `master_harga` tinyint(1) NOT NULL DEFAULT '1',
  `master_mitra` int NOT NULL DEFAULT '1',
  `need_grading` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slider` int NOT NULL DEFAULT '1',
  `setting` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role_name`, `master_admin`, `master_log`, `master_role`, `terms`, `policy`, `master_harga`, `master_mitra`, `need_grading`, `created_at`, `updated_at`, `slider`, `setting`) VALUES
(2, 'ALL', 1, 1, 1, 1, 1, 1, 1, 1, '2025-01-07 09:47:12', '2025-02-08 22:19:18', 1, 1),
(18, 'A', 1, 1, 1, 1, 1, 1, 1, 1, '2025-01-07 11:47:30', '2025-02-08 22:19:18', 1, 1),
(19, 'x', 1, 0, 1, 0, 1, 1, 0, 1, '2025-01-08 15:48:41', '2025-02-08 22:19:18', 1, 1),
(21, 'c', 1, 0, 0, 0, 1, 1, 0, 1, '2025-01-08 15:50:05', '2025-02-08 22:19:18', 1, 1),
(22, 'c', 1, 0, 0, 0, 1, 1, 0, 1, '2025-01-08 15:50:49', '2025-02-08 22:19:18', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int NOT NULL,
  `wa_admin` varchar(20) NOT NULL,
  `version_android` varchar(10) NOT NULL,
  `version_ios` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `wa_admin`, `version_android`, `version_ios`, `created_at`, `updated_at`) VALUES
(1, '89655651111', '1.1', '1.25', '2025-02-08 15:17:02', '2025-02-08 15:17:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `caption`, `created_at`) VALUES
(2, '1726914691_3c16709c4009f3c3474d.jpg', 'trade in disini! ', '2025-02-02 15:05:02'),
(3, '1727059030_5dfba0b192f049952055.png', 'Mari bertransaksi', '2025-02-02 15:10:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `superadmin`
--

DROP TABLE IF EXISTS `superadmin`;
CREATE TABLE `superadmin` (
  `id_superadmin` int NOT NULL,
  `nama_superadmin` varchar(255) NOT NULL,
  `email_superadmin` varchar(255) NOT NULL,
  `username_superadmin` varchar(255) NOT NULL,
  `password_superadmin` varchar(255) NOT NULL,
  `foto_superadmin` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `terms_conditions`
--

DROP TABLE IF EXISTS `terms_conditions`;
CREATE TABLE `terms_conditions` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `title`, `content`, `updated_at`) VALUES
(1, 'ddd', '<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">KEBIJAKAN PRIVASI &amp; SYARAT DAN\nKETENTUAN<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">APLIKASI Admin<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">KEBIJAKAN PRIVASI<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Kami percaya bahwa keamanan dan privasi merupakan hak setiap individu,\ndalam hal aplikasi Admin yaitu Aplikasi yang diperuntukan dalam menilai,\nmendiagnosa dan mengevaluasi kondisi smartphone dan sejenisnya melalui fitur\natau layanan yang telah ditentukan oleh Admin. Kami menghargai atas setiap\nkebijakan privasi dalam penggunaan aplikasi Admin dibawah naungan PT. Plus\nMinus Indonesia dengan mengedepankan pada norma hukum yang berlaku.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Akses Perizinan<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Akses pada gadget (smartphone) dan lain sebagainya dimana anda dapat\nmemilih untuk mengizinkan atau menolak aplikasi Admin yang memerlukan\nakses pada gadget (smartphone) dan lain sebagainya untuk dapat menilai,\nmendiagnosa dan mengevaluasi kondisi gadget (smartphone) dan lainnya. Adapun\nbeberapa perizinan dalam mengakses gadget (smartphone) dan sejenisnya adalah\nsebagai berikut:<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Akses yang diperlukan salah satunya kami memerlukan akses kamera untuk\nmemastikan dalam proses penilaian, diagnose dan evaluasi kondisi gadget\n(smartphone) dan sejenisnya dapat berfungsi dengan baik atau tidak. Dengan\nbegitu kami dapat memberikan hasil yang lebih baik.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Selain itu kami juga memerlukan akses pada untuk memastikan penilaian,\ndiagnosa dan evaluasi kondisi gadget (smarphone) baik hardware maupun software\nsehingga kami dapat secara adil dan transparan atas harga akhir pada penilaian\ngadget (smartphone) dan lainnya dengan benar.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Dalam proses dan pada bagian tertentu kami juga menyertakan iklan sebagai\nlayanan kami dan sebagai media promosi yang berkaitan dengan setiap lini bisnis\nAdmin maupun dari pihak lain yang telah bekerjasama dengan kami.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Transparansi<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Kami secara terus terang (transparansi) menampilkan dan membutuhkan akses\npada gadget (smartphone) dan sejenisnya yang anda miliki untuk dinilai,\ndidiagnosis dan dievaluasi kondisi baik software maupun hardware. Dalam\nprosesnya diperlukan data gadget (smartphone) secara intuitif.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Keamanan<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Selama proses penilaian, diganosa dan evaluasi kondisi gadget\n(smartphone) dan sejenisnya patuh dan tunduk pada peraturan dan ketentuan hukum\nyang berlaku di Indonesia.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Keberlanjutan <o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">Kami terus memperbaharui system keamanan aplikasi Admin untuk\nmelindungi dari ancaman dan kerentanan keamanan yang dapat diantisipasi dan\ndilindungi dengan baik.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;line-height:normal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:\nbold\">&nbsp;</span></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">SYARAT DAN KETENTUAN <o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PENGGUNAAN APLIKASI Admin<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Syarat dan\nKetentuan Penggunaan Aplikasi Admin yang ada di halaman ini segala syarat\ndan ketentuan diatur dalam (\"Syarat &amp; Ketentuan\"), setiap\npengguna aplikasi ini mengikat segala syarat dan ketentuan. <b>Admin </b>dalam syarat dan ketentuan\nini selanjutnya disebut (“Aplikasi”), baik sebagai pengguna, pihak pengunjung\naplikasi, pemasang iklan, maupun calon pengguna untuk tunduk dan patuh atas\nhal-hal yang telah ditetapkan oleh <b>Plus\nMinus Indonesia</b>.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Dengan\nmengakses dan/atau menggunakan Aplikasi, maka setiap Pengguna, Pemasang Iklan\ndan seterusnya dianggap telah menerima, memahami dan menyetujui serta sepakat\nuntuk mematuhi semua isi dalam Syarat dan Ketentuan di bawah ini. Syarat dan\nKetentuan dapat diubah dan/atau diperbaharui sewaktu-waktu oleh <b>Admin Indonesia</b> tanpa ada\npemberitahuan terlebih dahulu. Apabila Pengguna tidak setuju atas Syarat dan\nKetentuan Penggunaan Aplikasi ini, <b>Plus\nMinus Indonesia</b> mempersilahkan Pengguna untuk tidak melanjutkan penggunaan\nAplikasi dan/atau melakukan <i>uninstall</i>\naplikasi Admin.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PASAL 1<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">DEFINISI<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">“Aplikasi”</span></b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;berarti perangkat\nlunak milik Admin Indonesia yang dapat diakses melalui Ponsel Pintar yang\ndinamakan Admin yang bertujuan untuk menilai, mendiagnosa dan mengevaluasi\nkondisi gadget (smartphone) dan lainnya melalui mekanisme dan ketentuan yang\ntelah ditetapkan.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">“Kami”</span></b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;dan/atau dalam hal\nini juga bisa disebut sebagai&nbsp;<b>“Plus\nMinus Indonesia”&nbsp;</b>berarti <b>PT. Admin INDONESIA</b> yang suatu\nperseroan terbatas yang didirikan berdasarkan hukum negara Republik Indonesia,\nyang berlokasi di Jalan Talas V, Pondok Cabe, Pamulang – Kota Tangerang Selatan.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">3.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;color:black;mso-themecolor:\ntext1\">PT. Admin INDONESIA </span></b><span lang=\"EN-US\" style=\"font-family:\n&quot;Times New Roman&quot;,serif;color:black;mso-themecolor:text1\">adalah Perusahaan\nberbasis IT dan lini bisnis lainnya seperti pemberi saran dan/atau sebagai\npenilaian gadget (smartphone) dan lain sebagainya pada kondisi bekasnya dengan\nmenggunakan aplikasi dan cara penilaian lain yang ditetapkan untuk menilai (harga\njualnya) yang selanjutnya akan diserahkan kepada Pihak Lain.</span><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\"><o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">4.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">“Perangkat”</span></b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;berarti satu\nperangkat (atau lebih) yang akan dites menggunakan Aplikasi yang Bernama Plus\nMinus yang dimiliki oleh PT. Admin Indonesia;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">5.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">“Gadget”</span></b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;berarti tidak\nterbatas pada smartphone, bisa juga seperti iPad/Tab, smartwatch, MacBook,\nAirPod/Buds dan lain sebagainya dengan sistem operasi berbasis pada Android/iOS\ndan/atau sistem operasi lainnya yang dapat digunakan untuk menjalankan\nAplikasi.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">6.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">“Layanan Admin\nIndonesia”</span></b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;berarti\nlayanan yang tersedia di <b>Admin\nIndonesia</b> termasuk namun tidak terbatas pada hasil Pengecekan keadaan\nPerangkat; dan terdapat Estimasi harga jual suatu Perangkat.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">7.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">“Nilai”</span></b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;berarti nilai\n(harga) dari masing-masing Perangkat sebagaimana atas hasil penilaian, diagnose\ndan hasi evaluasi kondisi gadget anda baik software maupun hardware yang telah\nditentukan oleh <b>Admin Indonesia.</b><o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">8.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;<b>“Syarat\ndan Ketentuan“</b>&nbsp;berarti suatu aturan yang mengikat dengan pedoman yang\ntermaktub dalam Syarat dan Ketentuan Aplikasi ini yang berisikan perjanjian\nantara Pengguna dan <b>Admin</b> yang\nberisikan seperangkat peraturan yang mengatur hak, kewajiban, tanggung jawab\npengguna dan <b>Admin Indonesia</b>,\nserta tata cara penggunaan layanan <b>Plus\nMinus Indonesia</b>.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">9.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;<b>“Pengguna”</b>&nbsp;berarti\nAnda atau pihak yang menggunakan Layanan Admin Indonesia, yang tidak\nterbatas pada pengguna, calon pengguna maupun pihak lain yang sekedar\nberkunjung ke Situs atau yang menggunakan aplikasi Admin.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l1 level2 lfo1\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">10.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;<b>“Data\nPribadi”</b>&nbsp;berarti tiap dan seluruh data pribadi yang diberikan oleh\nPengguna pada aplikasi kami, yang tidak terbatas pada jenis HP, jenis sistem\noperasi, akses ke perangkat keras, dan data identitas Pengguna, serta dokumen\ndan data lainnya sebagaimana diminta pada Aplikasi.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PASAL 2<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PENGGUNAAN APLIKASI<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l5 level1 lfo2\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">1<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nwajib untuk menyampaikan informasi yang benar, tepat dan terbaru dari Perangkat\nGadget (smartphone dan jenis lainnya) yang dimiliki oleh Pengguna. Dengan\nmelakukan pengecekan Perangkat, Pengguna menyetujui dan menerima layanan Plus\nMinus Indonesia. Penerimaan tersebut berarti bahwa Pengguna telah menerima\nseluruh Syarat dan Ketentuan dengan tanpa syarat dan tanpa adanya pengecualian\ndan oleh karenanya sepakat untuk terikat oleh Ketentuan termasuk setiap\namandemen atau perubahan yang mungkin dibuat Admin Indonesia atas\nKetentuan ini di kemudian hari.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l5 level1 lfo2\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">2<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nbertanggung jawab atas akurasi dan kebaharuan informasi yang Pengguna sediakan\nkepada Kami. Data yang Pengguna sediakan akan disimpan di Admin Indonesia dan\nhanya dapat diakses oleh Pengguna dan Admin Indonesia. Kami tidak\nbertanggung jawab atas setiap kerugian yang diderita oleh Pengguna yang\ndisebabkan oleh kegagalan Pengguna untuk memperbaharui informasi Pengguna\nmelalui sistem Kami.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l5 level1 lfo2\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">3<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nmenyatakan dengan ini bahwa dirinya adalah pemilik asli dari Perangkat dan\nmemiliki hak hukum penuh atas Perangkat yang didapatkan secara legal dan tidak\nbertentangan dengan hukum, apabila dikemudian hari didapatkan fakta bahwa\nGadget (smartphone dan jenis lainnya) yang telah dibuktikan secara dan oleh\nketentuan hukum yang berlaku di Indonesia maka Pengguna membebaskan PT. Plus\nMinus Indonesia atas sebab dan akibat yang ditimbulkan atas Gadget (smartphone\ndan jenis lainnya) yang merupakan atau terindikasi hasil tindak kejahatan yang\ntidak terbatas pada pencurian, perampokan dan perbuatan yang melanggar hukum\nlainnya.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l5 level1 lfo2\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">4<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nmenyatakan dan menjamin bahwa Pengguna adalah individu atau kelompok usaha yang\nsah secara hukum untuk melakukan tindakan hukum untuk masuk ke dalam perjanjian\nyang mengikat berdasarkan hukum Republik Indonesia, secara khusus Syarat dan\nKetentuan, untuk menggunakan Aplikasi. Jika Pengguna tidak memenuhi ketentuan\ntersebut namun tetap mengakses Aplikasi, Pengguna menyatakan dan menjamin bahwa\npemakaian Aplikasi oleh Pengguna dan aktivitas lain dalam Admin Indonesia\ntelah disetujui oleh orang tua atau pengampu Pengguna. Pengguna mengesampingkan\nsetiap hak berdasarkan hukum untuk membatalkan atau mencabut setiap dan seluruh\npersetujuan yang Pengguna berikan berdasarkan Ketentuan Penggunaan pada waktu\nPengguna dianggap oleh hukum telah dewasa. Pengguna secara penuh melepaskan\nkami dan petugas kami dari kerugian atau konsekuensi yang timbul sehubungan\ndengan hal tersebut.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PASAL 3<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">KETENTUAN PENGGUNAAN<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level1 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">1<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Plus\nMinus Indonesia memberikan Layanan yang memungkinkan Pengguna untuk mengecek\nkeadaan Perangkat dan memberikan harga penjualan atas Perangkat dalam hal\nPengguna ingin menjual Perangkatnya melalui layanan&nbsp;marketplace dan\nfasilitas penjualan secara online maupun lainnya yang telah ditetapkan oleh PT.&nbsp;Plus\nMinus Indonesia.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level1 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">2<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pemeriksaan\nterhadap Perangkat akan dilakukan secara otomatis berjalan dalam rangkaian\npenggunaan aplikasinya yang terdiri dari bagian pengecekan yaitu pengecekan\nyang bersifat software dan hardware maupun kondisi fisik Smartphone.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level1 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">3<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Harga\nyang tercantum di Aplikasi adalah harga yang dianggap telah disepakati oleh\nPara Pihak (Pengguna, Toko, dan Admin Indonesia) sebagai harga yang akan\ndicantumkan oleh Admin Indonesia, dan tidak ada Pihak yang dapat merubah\natau menentang atau menolak harga yang tercantum dalam Aplikasi kecuali atas\nizin dari Admin Indonesia.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level1 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">4<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Layanan\ntersebut dapat berubah dari waktu ke waktu sebagaimana kami memperbaiki,\nmemodifikasi dan menambahkan fitur tambahan lainnya. Kami dapat menghentikan,\nmenangguhkan, merubah, atau menghilangkan Layanan pada setiap waktu tanpa\nadanya pemberitahuan kepada Pengguna. Penggunaan Pengguna secara berkelanjutan\natas PT. Admin Indonesia setelah modifikasi, variasi dan/atau perubahan\natas Ketentuan Penggunaan merupakan persetujuan dan penerimaan Pengguna atas\nmodifikasi, variasi dan/atau perubahan tersebut.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level1 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">5<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nmemahami dan setuju bahwa penggunaan Aplikasi oleh Pengguna akan tunduk pada\nKebijakan Privasi kami yang dapat diubah dari waktu ke waktu. Dengan\nmenggunakan Aplikasi.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Dengan\nmenggunakan Aplikasi ini, Pengguna setuju bahwa Pengguna akan epenuhnya\nmembebaskan kami, sebagai pemberi lisensi, afiliasi, dan masing-masing dari\npetugas, direktur, komisaris, karyawan, pengacara dan agen Kami dari dan\nterhadap setiap dan semua klaim, biaya, kerusakan, kerugian, kewajiban dan\nbiaya (termasuk biaya dan ongkos pengacara) yang timbul dari atau sehubungan\ndengan:<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l10 level1 lfo8\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Penggunaan\nlayanan dan/atau Aplikasi oleh Pengguna, hubungan Pengguna dengan penyedia\nLayanan, penyedia pihak ketiga, mitra, pemasang iklan dan/atau sponsor;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l10 level1 lfo8\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pelanggaran\natas atau tidak dipatuhinya salah satu Syarat dan Ketentuan ini atau peraturan\nperundang-undangan yang berlaku oleh Pengguna, baik yang disebutkan di sini\natau tidak;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l10 level1 lfo8\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">3.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pelanggaran\nPengguna terhadap hak-hak pihak ketiga, termasuk penyedia Layanan pihak ketiga\nyang diatur melalui Aplikasi;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l10 level1 lfo8\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">4.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Penggunaan\natau penyalahgunaan Aplikasi.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l10 level1 lfo8\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">5.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Kewajiban\npembelaan dan pemberian ganti rugi ini akan tetap berlaku untuk jangka waktu\nyang tidak ditentukan, walaupun Syarat dan Ketentuan dan penggunaan layanan\noleh Pengguna telah berakhir.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PASAL 4<o:p></o:p></span></b></p><p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom:0cm;text-align:center;\nline-height:normal\"><b><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">PENGATURAN DATA<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;line-height:\nnormal\"><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level2 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nmengerti bahwa ketika menggunakan Akun, setiap Data Pribadi yang diberikan oleh\nPengguna kepada kami sehubungan dengan penggunaan Aplikasi dapat dikumpulkan,\ndigunakan dan/atau diungkapkan oleh Kami sehingga Pengguna dapat menikmati\nlayanan Admin Indonesia sepenuhnya.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l0 level1 lfo4\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">a.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\ndengan ini memberikan persetujuan kepada Kami untuk mengumpulkan, menggunakan,\natau mengungkapkan sebagian dan/atau seluruh data atau informasi mengenai\nPengguna yang dapat diakses oleh pihak pembeli maupun pihak pengguna lain\nmelalui layanan&nbsp;aplikasi ini.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l0 level1 lfo4\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">b.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nberjanji akan memberikan data yang sebenarnya dan Pengguna memahami apabila\nPengguna memberikan data yang tidak sesuai maka Pengguna telah melakukan\nwanprestasi terhadap Perjanjian ini dan Admin Indonesia memiliki hak untuk\nmenolak pelaksanaan Admin Indonesia atas kewajiban Admin Indonesia\ndan hak Pengguna berdasarkan Perjanjian ini serta untuk menempuh langkah hukum\napapun yang dianggap perlu oleh Admin Indonesia untuk memastikan\ndiberlakukannya Perjanjian ini secara penuh dan untuk menerima ganti rugi yang\nsepantasnya atas wanprestasi yang dilakukan oleh Pengguna.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l0 level1 lfo4\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">c.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Setiap\nkerugian Pengguna akibat penyalahgunaan oleh pihak ketiga atas data/atau\ninformasi Pengguna yang bukan berasal dari Admin Indonesia (Aplikasi\ndisusupi virus, malware, hacked dan/atau lain sebagainya) yang dapat\nmengakibatkan data pengguna diambil (dicuri) bukan/tanpa sepengetahuan Plus\nMinus Indonesia bukan menjadi tanggung jawab Admin Indonesia.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l0 level1 lfo4\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">d.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Pengguna\nmemahami bahwa kami dapat diminta untuk mengungkapkan data personal Pengguna\nkepada setiap otoritas (termasuk otoritas pengadilan atau otoritas moneter)\nberdasarkan hukum dan peraturan perundang-undangan yang berlaku.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level2 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Tunduk\nkepada ketentuan Pasal 4.1, Data Pribadi dapat digunakan untuk:<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l7 level1 lfo5\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">a.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">menyediakan\ndan meningkatkan Layanan kami;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l7 level1 lfo5\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">b.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">mengatur\npenggunaan Layanan;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l7 level1 lfo5\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">c.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">lebih\nmengenal kebutuhan dan kepentingan Pengguna;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l7 level1 lfo5\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">d.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">untuk\nmelakukan personalisasi dan meningkatkan pengalaman Pengguna;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l7 level1 lfo5\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">e.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">untuk\nmenggunakan pembaharuan&nbsp;software&nbsp;dan pengumuman produk; dan<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l7 level1 lfo5\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">f.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">menerbitkan\ndan mengirimkan invoice atau faktur penjualan melalui marketplace maupun\nfasilitas lainnya atas nama Pengguna dari hasil penjualan ke pembeli.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level2 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">3.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Tunduk\nkepada ketentuan Pasal 4.1, kami berjanji untuk tidak mengungkap Data Pribadi\nPengguna kepada pihak lain (selain yang secara tegas ditentukan dalam Syarat\ndan Ketentuan ini) tanpa persetujuan sebelumnya dari Pengguna:<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l3 level1 lfo6\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">a.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Untuk\nmemperlakukan Data Pribadi dengan secara rahasia dan tidak membukanya kecuali\ndengan persetujuan Pengguna;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l3 level1 lfo6\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">b.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Apabila\nsuatu pembukaan harus dilaksanakan sesuai dengan permintaan pengadilan atau\nperintah dari otoritas pemerintah lainnya, Kami akan memberikan pemberitahuan\nmengenai pembukaan tersebut;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:0cm;margin-right:0cm;\nmargin-bottom:0cm;margin-left:18.0pt;mso-add-space:auto;text-align:justify;\ntext-indent:-18.0pt;line-height:normal;mso-list:l8 level2 lfo3\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">4.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">Kewajiban\ndi atas tidak berlaku kepada informasi yang:<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l6 level1 lfo7\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">a.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">terdapat\ndalam kekuasaan kami sebelum tanggal dimana Data tersebut diberitahukan kepada\nkami oleh Pengguna;<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom:0cm;mso-add-space:\nauto;text-align:justify;text-indent:-18.0pt;line-height:normal;mso-list:l6 level1 lfo7\"><!--[if !supportLists]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\n&quot;Times New Roman&quot;\">b.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-family:&quot;Times New Roman&quot;,serif\">telah\natau akan menjadi diketahui secara umum melalui publikasi, penggunaan secara\nkomersial atau lainnya selain daripada konsekuensi', '2025-03-26 07:37:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `id` int NOT NULL,
  `id_toko` int NOT NULL,
  `token` text NOT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tokens`
--

INSERT INTO `tokens` (`id`, `id_toko`, `token`, `revoked`, `created_at`) VALUES
(3, 1, '$2y$10$B/97KY0kOIkMSvtqDyoz/uMwyIdyuOPJt8mALHezo202JNXRpYxi2', 1, '2025-01-17 06:40:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko` (
  `id_toko` int NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `id_mitra` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `nomor_telpon` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(215) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `id_mitra`, `username`, `nomor_telpon`, `email`, `password`, `created_at`, `last_login`, `deleted_at`, `banned`) VALUES
(1, 'toko', 11, 'toko', '8123456789', 'abdul.hasan388@gmail.com', 'L9T+vl5lnLSeGUG5mGyT0Y7FSYXF8pHMOBsTz3jeu4ltsLqtYderT/GIvwq2M+4uJZ747OtFC7G3yVFQ1Dx4eg==', '2025-01-16 22:50:03', NULL, NULL, 0),
(2, 'hasanqqq', 13, 'hasan', '', 'hasan@gmail.coms', 'xLyPwPVzMPLWSl31TBAnXpivpn3/euNcLcDRAGVOaBvRDEU6FBLCSGTHth2onZQ3HS91rWd41gmfKfenOf3tvA==', '2025-01-20 14:49:36', NULL, NULL, 0),
(3, 'hasaneditwwww', 13, 'hasanw', '', 'hasan@gq.com', 'Ob36RMuqMLgX32w3LxZRuT40yjjs9ORLnORCzWDMB3OqtxzkZAW0K/eVGYl3Unv0tk+jeLIG2TmqrzAdAXHNMA==', '2025-01-20 14:51:23', NULL, NULL, 0),
(4, 'toko-mitra-cb1', 14, 'toko-mitra-cb1', '896025878754', 'toko-mitra-cb1@gmai.com', '7tkLcaadiQO3UgJ5ccE4/iIP6AIuIHJCHX4M71XPrHAF5/5264dDQcgxtdODNIdg/Jiq5PLmfVMHBichp4S9KQ==', '2025-01-28 13:34:47', NULL, NULL, 0),
(5, 'toko-era', 14, 'toko-era', '554845454', 'hasan@gmai.com', 'liyVy88to3/YLRSYExFzObaHJntHcaO3E70mGlQEDGvfkEyJwPtKfQFTBX6EhGIVQ+d20p1zJbfIwnCd04msiw==', '2025-01-28 15:19:54', '2025-03-27 07:14:45', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_tradein`
--

DROP TABLE IF EXISTS `transaction_tradein`;
CREATE TABLE `transaction_tradein` (
  `id_transaction_tradein` int NOT NULL,
  `kode_trade` varchar(10) NOT NULL,
  `transaction_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_toko` int NOT NULL,
  `id_mitra` int NOT NULL,
  `merk` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `storage` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `qrcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `quisioner_1` varchar(10) DEFAULT NULL,
  `quisioner_2` varchar(10) DEFAULT NULL,
  `quisioner_3` varchar(10) DEFAULT NULL,
  `quisioner_4` varchar(10) DEFAULT NULL,
  `quisioner_5` varchar(50) DEFAULT NULL,
  `quisioner_6` varchar(50) DEFAULT NULL,
  `imei` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fisik_2` varchar(255) DEFAULT NULL,
  `fisik_3` varchar(255) DEFAULT NULL,
  `fisik_4` varchar(255) DEFAULT NULL,
  `battery_health` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `photo_front` varchar(255) DEFAULT NULL,
  `photo_back` varchar(255) DEFAULT NULL,
  `photo_top` varchar(255) DEFAULT NULL,
  `photo_bottom` varchar(255) DEFAULT NULL,
  `photo_about_phone` varchar(255) DEFAULT NULL,
  `photo_true_tone` varchar(255) DEFAULT NULL,
  `photo_battery_health` varchar(255) DEFAULT NULL,
  `cpu` varchar(50) DEFAULT NULL,
  `hardisk` varchar(50) DEFAULT NULL,
  `battery` varchar(50) DEFAULT NULL,
  `button_silent` varchar(50) DEFAULT NULL,
  `button_volume_up` varchar(50) DEFAULT NULL,
  `button_volume_down` varchar(50) DEFAULT NULL,
  `button_power` varchar(50) DEFAULT NULL,
  `camera_back` varchar(50) DEFAULT NULL,
  `camera_front` varchar(50) DEFAULT NULL,
  `touchscreen` varchar(50) DEFAULT NULL,
  `biometric_type` varchar(255) DEFAULT NULL,
  `biometric` varchar(50) DEFAULT NULL,
  `sim_card` varchar(50) DEFAULT NULL,
  `speaker` varchar(255) NOT NULL,
  `harga` bigint NOT NULL,
  `grade` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaction_tradein`
--

INSERT INTO `transaction_tradein` (`id_transaction_tradein`, `kode_trade`, `transaction_code`, `id_toko`, `id_mitra`, `merk`, `model`, `type`, `ram`, `storage`, `status`, `qrcode`, `created_at`, `deleted_at`, `quisioner_1`, `quisioner_2`, `quisioner_3`, `quisioner_4`, `quisioner_5`, `quisioner_6`, `imei`, `fisik_2`, `fisik_3`, `fisik_4`, `battery_health`, `photo_front`, `photo_back`, `photo_top`, `photo_bottom`, `photo_about_phone`, `photo_true_tone`, `photo_battery_health`, `cpu`, `hardisk`, `battery`, `button_silent`, `button_volume_up`, `button_volume_down`, `button_power`, `camera_back`, `camera_front`, `touchscreen`, `biometric_type`, `biometric`, `sim_card`, `speaker`, `harga`, `grade`, `updated_at`) VALUES
(22, '8ROUI62', 'VJDESZYR', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'rejected', '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', '2025-02-08 19:52:19', NULL, 'y', 'y', 'y', 'y', '[\'unit_only\', \'with_box\', \'with_cable\']', 'lcd,camera', '56689565656565656', NULL, NULL, NULL, 'battery2', '22_photo_front_1739042187.jpg', '22_photo_back_1739042187.jpg', '22_photo_top_1739042187.jpeg', '22_photo_bottom_1739042187.jpg', '22_photo_about_phone_1739042187.jpg', '22_photo_true_tone_1739042187.jpeg', '22_photo_battery_health_1739042187.jpeg', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'fingerprint', 'working', 'working', 'working', 0, 'reject', '2025-02-28 16:12:56'),
(31, '8YDGU64', 'KF46N5QL', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'result_ready', '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', '2025-02-08 20:30:52', NULL, 'y', 'y', 'y', 'y', '[\'unit_only\', \'with_box\', \'with_cable\']', 'lcd,camera', '56689565656565656', NULL, NULL, NULL, 'battery2', '31_photo_front_1739043072.jpg', '31_photo_back_1739043072.jpg', '31_photo_top_1739043072.jpeg', '31_photo_bottom_1739043072.jpg', '31_photo_about_phone_1739043072.jpg', '31_photo_true_tone_1739043072.jpeg', '31_photo_battery_health_1739043072.jpeg', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'fingerprint', 'working', 'working', '', 14610000, 'C', '2025-03-03 15:31:26'),
(32, '17CTUB86', '8GQMXAP4', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'pending', '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', '2025-03-17 06:48:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '', NULL),
(33, '26KRWE43', '6ZQ3U7XW', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'result_ready', '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', '2025-03-26 08:22:46', NULL, 'y', 'y', 'y', 'y', '[\'unit_only\', \'with_box\', \'with_cable\']', 'lcd', '56689565656565656', NULL, NULL, NULL, 'battery2', '33_photo_front_1742974433.jpg', '33_photo_back_1742974433.jpg', '33_photo_top_1742974433.jpg', '33_photo_bottom_1742974433.jpg', '33_photo_about_phone_1742974433.jpg', '33_photo_true_tone_1742974433.jpg', '33_photo_battery_health_1742974433.jpg', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'fingerprint', 'working', 'working', '', 0, 'reject', NULL),
(34, '27TOIU10', 'UVMTN738', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'result_ready', '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', '2025-03-27 04:57:47', NULL, 'n', 'n', 'n', 'n', '[\'unit_only\', \'with_box\', \'with_cable\']', 'active_service_coverage', '56689565656565656', NULL, NULL, NULL, 'battery1', '34_photo_front_1743049583.jpg', '34_photo_back_1743049583.jpg', '34_photo_top_1743049583.jpg', '34_photo_bottom_1743049583.jpg', '34_photo_about_phone_1743049583.jpg', '34_photo_true_tone_1743049583.jpg', '34_photo_battery_health_1743049583.jpg', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'fingerprint', 'working', 'working', '', 14900000, 'A', NULL),
(35, '27EUJX67', '821KS9DN', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'result_ready', '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', '2025-03-27 05:31:22', NULL, 'n', 'n', 'n', 'n', '[\'unit_only\', \'with_box\', \'with_cable\']', 'active_service_coverage', '56689565656565656', NULL, NULL, NULL, 'battery1', '35_photo_front_1743049917.jpg', '35_photo_back_1743049917.jpg', '35_photo_top_1743049917.jpg', '35_photo_bottom_1743049917.jpg', '35_photo_about_phone_1743049917.jpg', '35_photo_true_tone_1743049917.jpg', '35_photo_battery_health_1743049917.jpg', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'fingerprint', 'working', 'working', '', 14900000, 'A', NULL),
(36, '27RVKA63', 'QN5WB8GV', 5, 14, 'Apple', 'iPhone 16', 'smartphone', '16GB', '128GB', 'result_ready', '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', '2025-03-27 07:14:47', NULL, 'n', 'n', 'n', 'n', '[\'unit_only\', \'with_box\', \'with_cable\']', 'active_service_coverage', '56689565656565656', NULL, NULL, NULL, 'battery1', '36_photo_front_1743056093.jpg', '36_photo_back_1743056093.jpg', '36_photo_top_1743056093.jpg', '36_photo_bottom_1743056093.jpg', '36_photo_about_phone_1743056093.jpg', '36_photo_true_tone_1743056093.jpg', '36_photo_battery_health_1743056093.jpg', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'working', 'fingerprint', 'working', 'working', '', 14900000, 'A', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `domisili` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wartawan`
--

DROP TABLE IF EXISTS `wartawan`;
CREATE TABLE `wartawan` (
  `id_wartawan` int NOT NULL,
  `nama_wartawan` varchar(255) NOT NULL,
  `email_wartawan` varchar(255) NOT NULL,
  `username_wartawan` varchar(255) NOT NULL,
  `password_wartawan` varchar(255) NOT NULL,
  `foto_wartawan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `wartawan`
--

INSERT INTO `wartawan` (`id_wartawan`, `nama_wartawan`, `email_wartawan`, `username_wartawan`, `password_wartawan`, `foto_wartawan`, `created_at`, `edited_at`, `status`) VALUES
(1, 'James Gates', 'owillis@peterson.com', 'heatherguerrero', '&iQL6SHt5&', 'https://placekitten.com/418/233', '2025-01-02 18:31:57', '2025-01-01 16:56:21', 'active'),
(2, 'Jane Vance', 'nathan38@hotmail.com', 'ocarroll', '^7DT3Rnu3f', 'https://placeimg.com/664/756/any', '2025-01-02 13:28:11', '2025-01-04 01:09:59', 'active');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id_editor`);

--
-- Indeks untuk tabel `jawaban_admin_temp`
--
ALTER TABLE `jawaban_admin_temp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaction` (`id_transaction`);

--
-- Indeks untuk tabel `jawaban_waktu_admin`
--
ALTER TABLE `jawaban_waktu_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `kategori_logs`
--
ALTER TABLE `kategori_logs`
  ADD PRIMARY KEY (`id_kategori_log`),
  ADD UNIQUE KEY `nama_kategori_log` (`nama_kategori_log`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_kategori_log` (`id_kategori_log`);

--
-- Indeks untuk tabel `master_harga`
--
ALTER TABLE `master_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_harga_details`
--
ALTER TABLE `master_harga_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_harga_id` (`master_harga_id`);

--
-- Indeks untuk tabel `master_mitra`
--
ALTER TABLE `master_mitra`
  ADD PRIMARY KEY (`id_master_mitra`);

--
-- Indeks untuk tabel `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_berita` (`id_berita`);

--
-- Indeks untuk tabel `redaksi`
--
ALTER TABLE `redaksi`
  ADD PRIMARY KEY (`id_redaksi`);

--
-- Indeks untuk tabel `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `revisi_komentar_editor`
--
ALTER TABLE `revisi_komentar_editor`
  ADD PRIMARY KEY (`id_revisi_editor`),
  ADD KEY `id_berita` (`id_berita`),
  ADD KEY `id_editor` (`id_editor`);

--
-- Indeks untuk tabel `revisi_komentar_redaksi`
--
ALTER TABLE `revisi_komentar_redaksi`
  ADD PRIMARY KEY (`id_revisi_redaksi`),
  ADD KEY `id_berita` (`id_berita`),
  ADD KEY `id_redaksi` (`id_redaksi`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id_superadmin`);

--
-- Indeks untuk tabel `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `transaction_tradein`
--
ALTER TABLE `transaction_tradein`
  ADD PRIMARY KEY (`id_transaction_tradein`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `wartawan`
--
ALTER TABLE `wartawan`
  ADD PRIMARY KEY (`id_wartawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `editor`
--
ALTER TABLE `editor`
  MODIFY `id_editor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban_admin_temp`
--
ALTER TABLE `jawaban_admin_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jawaban_waktu_admin`
--
ALTER TABLE `jawaban_waktu_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `kategori_logs`
--
ALTER TABLE `kategori_logs`
  MODIFY `id_kategori_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT untuk tabel `master_harga`
--
ALTER TABLE `master_harga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `master_harga_details`
--
ALTER TABLE `master_harga_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `master_mitra`
--
ALTER TABLE `master_mitra`
  MODIFY `id_master_mitra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `redaksi`
--
ALTER TABLE `redaksi`
  MODIFY `id_redaksi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `revisi_komentar_editor`
--
ALTER TABLE `revisi_komentar_editor`
  MODIFY `id_revisi_editor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `revisi_komentar_redaksi`
--
ALTER TABLE `revisi_komentar_redaksi`
  MODIFY `id_revisi_redaksi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id_superadmin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaction_tradein`
--
ALTER TABLE `transaction_tradein`
  MODIFY `id_transaction_tradein` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `wartawan`
--
ALTER TABLE `wartawan`
  MODIFY `id_wartawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_kategori_log`) REFERENCES `kategori_logs` (`id_kategori_log`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `master_harga_details`
--
ALTER TABLE `master_harga_details`
  ADD CONSTRAINT `master_harga_details_ibfk_1` FOREIGN KEY (`master_harga_id`) REFERENCES `master_harga` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  ADD CONSTRAINT `refresh_tokens_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `revisi_komentar_editor`
--
ALTER TABLE `revisi_komentar_editor`
  ADD CONSTRAINT `revisi_komentar_editor_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE,
  ADD CONSTRAINT `revisi_komentar_editor_ibfk_2` FOREIGN KEY (`id_editor`) REFERENCES `editor` (`id_editor`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `revisi_komentar_redaksi`
--
ALTER TABLE `revisi_komentar_redaksi`
  ADD CONSTRAINT `revisi_komentar_redaksi_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE,
  ADD CONSTRAINT `revisi_komentar_redaksi_ibfk_2` FOREIGN KEY (`id_redaksi`) REFERENCES `redaksi` (`id_redaksi`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
