-- Table for laundry service pricing
CREATE TABLE `setting_harga_laundry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(100) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `deskripsi` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for delivery pricing
CREATE TABLE `setting_harga_ongkir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `harga_per_km` decimal(10,2) NOT NULL,
  `minimum_km` int(11) NOT NULL,
  `deskripsi` varchar(255),
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data for laundry services
INSERT INTO `setting_harga_laundry` (`nama_layanan`, `harga_per_kg`, `deskripsi`, `status`) VALUES
('Cuci Kering', 5000.00, 'Cuci bersih tanpa setrika', 'aktif'),
('Cuci Setrika', 8000.00, 'Cuci bersih + setrika rapi', 'aktif'),
('Dry Clean', 15000.00, 'Cuci kering khusus pakaian premium', 'aktif');

-- Insert sample data for delivery pricing
INSERT INTO `setting_harga_ongkir` (`harga_per_km`, `minimum_km`, `deskripsi`, `status`) VALUES
(2000.00, 10, 'Tarif standar minimum 10km', 'aktif'),
(1500.00, 25, 'Tarif hemat minimum 25km', 'aktif');