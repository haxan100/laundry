-- Complete Laundry System Database
-- Run this SQL to create all required tables

-- Create harga_laundry table
CREATE TABLE IF NOT EXISTS `harga_laundry` (
  `id_harga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(100) NOT NULL,
  `harga_per_kilo` decimal(10,2) NOT NULL,
  `deskripsi` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_harga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert sample laundry services
INSERT INTO `harga_laundry` (`nama_layanan`, `harga_per_kilo`, `deskripsi`) VALUES
('Cuci Kering', 5000.00, 'Cuci dan kering saja'),
('Cuci Setrika', 7000.00, 'Cuci, kering, dan setrika'),
('Cuci Express', 10000.00, 'Cuci setrika selesai 1 hari'),
('Dry Clean', 15000.00, 'Dry cleaning untuk pakaian khusus');

-- Create harga_ongkir table
CREATE TABLE IF NOT EXISTS `harga_ongkir` (
  `id_ongkir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(100) NOT NULL,
  `harga_ongkir` decimal(10,2) NOT NULL,
  `estimasi_hari` int(11) DEFAULT 1,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ongkir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert sample delivery areas
INSERT INTO `harga_ongkir` (`nama_area`, `harga_ongkir`, `estimasi_hari`) VALUES
('Dalam Kota', 5000.00, 1),
('Luar Kota', 10000.00, 2),
('Antar Jemput', 15000.00, 1);

-- Create tier_discount table
CREATE TABLE IF NOT EXISTS `tier_discount` (
  `id_tier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tier` varchar(50) NOT NULL,
  `min_transaksi` int(11) NOT NULL DEFAULT 0,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert tier discounts
INSERT INTO `tier_discount` (`nama_tier`, `min_transaksi`, `discount_percent`) VALUES
('Bronze', 0, 0.00),
('Silver', 10, 5.00),
('Gold', 25, 10.00),
('Platinum', 50, 15.00);

-- Update customers table to include tier
ALTER TABLE `customers` ADD COLUMN `tier_id` int(11) DEFAULT 1 AFTER `alamat`;
ALTER TABLE `customers` ADD COLUMN `total_transaksi` int(11) DEFAULT 0 AFTER `tier_id`;
ALTER TABLE `customers` ADD FOREIGN KEY (`tier_id`) REFERENCES `tier_discount` (`id_tier`);

-- Create transaksi table
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `customer_type` enum('tamu','customer','customer_baru') NOT NULL DEFAULT 'tamu',
  `id_customer` int(11) DEFAULT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `total_kilo` decimal(8,2) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `harga_per_kilo` decimal(10,2) NOT NULL,
  `subtotal_laundry` decimal(10,2) NOT NULL,
  `is_delivery` tinyint(1) DEFAULT 0,
  `id_ongkir` int(11) DEFAULT NULL,
  `harga_ongkir` decimal(10,2) DEFAULT 0.00,
  `discount_percent` decimal(5,2) DEFAULT 0.00,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `pajak` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `status` enum('pending','process','completed','cancelled') NOT NULL DEFAULT 'pending',
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  KEY `id_kasir` (`id_kasir`),
  KEY `id_customer` (`id_customer`),
  KEY `id_layanan` (`id_layanan`),
  KEY `id_ongkir` (`id_ongkir`),
  FOREIGN KEY (`id_kasir`) REFERENCES `admin` (`id_admin`),
  FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`),
  FOREIGN KEY (`id_layanan`) REFERENCES `harga_laundry` (`id_harga`),
  FOREIGN KEY (`id_ongkir`) REFERENCES `harga_ongkir` (`id_ongkir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;