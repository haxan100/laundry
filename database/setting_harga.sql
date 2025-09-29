-- Tabel untuk setting harga laundry berdasarkan tier
CREATE TABLE `setting_harga_laundry` (
  `id_harga_laundry` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tier` varchar(100) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `min_kg` decimal(5,2) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_harga_laundry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk setting harga ongkir berdasarkan tier
CREATE TABLE `setting_harga_ongkir` (
  `id_harga_ongkir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tier` varchar(100) NOT NULL,
  `harga_per_km` decimal(10,2) NOT NULL,
  `min_km` decimal(5,2) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_harga_ongkir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data default harga laundry
INSERT INTO `setting_harga_laundry` (`nama_tier`, `harga_per_kg`, `min_kg`, `status`) VALUES
('Tier 1 - Retail', 3500.00, 5.00, 'aktif'),
('Tier 2 - Grosir Kecil', 2500.00, 10.00, 'aktif'),
('Tier 3 - Grosir Besar', 2000.00, 50.00, 'aktif');

-- Insert data default harga ongkir
INSERT INTO `setting_harga_ongkir` (`nama_tier`, `harga_per_km`, `min_km`, `status`) VALUES
('Tier 1 - Dekat', 2000.00, 10.00, 'aktif'),
('Tier 2 - Sedang', 1500.00, 25.00, 'aktif');