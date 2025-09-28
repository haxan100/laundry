-- Database: laundry_amanah
CREATE DATABASE IF NOT EXISTS `laundry_amanah` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `laundry_amanah`;

-- Table: roles
CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) NOT NULL,
  `deskripsi` text,
  `permissions` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: owners
CREATE TABLE `owners` (
  `id_owner` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100),
  `telepon` varchar(20),
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: admin
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100),
  `telepon` varchar(20),
  `id_role` int(11) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`),
  FOREIGN KEY (`id_role`) REFERENCES `roles`(`id_role`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert default roles
INSERT INTO `roles` (`nama_role`, `deskripsi`, `permissions`) VALUES
('Super Admin', 'Akses penuh sistem', 'all'),
('Admin Operasional', 'Kelola operasional laundry', 'orders,customers,reports'),
('Kasir', 'Kelola transaksi dan pembayaran', 'orders,payments');

-- Insert default owner (password: owner123)
INSERT INTO `owners` (`username`, `password`, `nama_lengkap`, `email`, `telepon`, `alamat`) VALUES
('owner', '5d41402abc4b2a76b9719d911017c592', 'Owner Laundry Amanah', 'owner@laundryamanah.com', '081234567890', 'Jl. Contoh No. 123');

-- Insert default admin (password: admin123)
INSERT INTO `admin` (`username`, `password`, `nama_lengkap`, `email`, `telepon`, `id_role`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'admin@laundryamanah.com', '081234567891', 1),
('kasir', 'c93ccd78b2076528346216b3b2f701e6', 'Kasir Laundry', 'kasir@laundryamanah.com', '081234567892', 3);