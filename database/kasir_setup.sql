-- Create roles table if not exists
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) NOT NULL,
  `permissions` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert basic roles
INSERT INTO `roles` (`id_role`, `nama_role`, `permissions`) VALUES
(1, 'Super Admin', 'all'),
(2, 'Admin', 'admin_access'),
(3, 'Kasir', 'pos_access');

-- Create admin table if not exists
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_role` (`id_role`),
  FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert test kasir user (password: 123456 - use MD5 for simplicity)
INSERT INTO `admin` (`username`, `password`, `nama_lengkap`, `id_role`) VALUES
('kasir1', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir Test', 3);

-- Create owner table if not exists
CREATE TABLE IF NOT EXISTS `owner` (
  `id_owner` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert test owner (password: 123456 - MD5)
INSERT INTO `owner` (`username`, `password`, `nama_lengkap`, `email`) VALUES
('owner1', 'e10adc3949ba59abbe56e057f20f883e', 'Owner Test', 'owner@test.com');

-- Create master_harga table if not exists
CREATE TABLE IF NOT EXISTS `master_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_harga` varchar(100) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `id_mitra` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create master_harga_details table if not exists
CREATE TABLE IF NOT EXISTS `master_harga_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master_harga_id` int(11) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `storage` varchar(20) DEFAULT NULL,
  `ram` varchar(20) DEFAULT NULL,
  `harga_a` decimal(10,2) NOT NULL,
  `harga_b` decimal(10,2) DEFAULT NULL,
  `harga_c` decimal(10,2) DEFAULT NULL,
  `harga_d` decimal(10,2) DEFAULT NULL,
  `harga_e` decimal(10,2) DEFAULT NULL,
  `harga_fullset` decimal(10,2) DEFAULT NULL,
  `harga_promotion` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_harga_id` (`master_harga_id`),
  FOREIGN KEY (`master_harga_id`) REFERENCES `master_harga` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert sample laundry services
INSERT INTO `master_harga` (`judul_harga`, `periode_awal`, `periode_akhir`) VALUES
('Harga Laundry 2024', '2024-01-01', '2024-12-31');

INSERT INTO `master_harga_details` (`master_harga_id`, `merk`, `model`, `type`, `storage`, `ram`, `harga_a`) VALUES
(1, 'Cuci', 'Reguler', 'Kiloan', '1kg', 'Normal', 5000.00),
(1, 'Cuci', 'Express', 'Kiloan', '1kg', 'Cepat', 8000.00),
(1, 'Cuci', 'Setrika', 'Kiloan', '1kg', 'Normal', 7000.00),
(1, 'Cuci', 'Kering', 'Kiloan', '1kg', 'Normal', 4000.00),
(1, 'Sepatu', 'Cuci', 'Pasang', '1 Pasang', 'Normal', 15000.00),
(1, 'Tas', 'Cuci', 'Unit', '1 Unit', 'Normal', 20000.00);