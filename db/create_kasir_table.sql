-- Create kasir table for cashier management
CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kasir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert sample kasir data
INSERT INTO `kasir` (`username`, `password`, `nama_lengkap`, `email`, `telepon`, `alamat`, `status`) VALUES
('kasir1', 'c7911af3adbd12a035b289556d96470a', 'Kasir Satu', 'kasir1@laundry.com', '081234567890', 'Jl. Kasir No. 1', 'aktif'),
('kasir2', 'c7911af3adbd12a035b289556d96470a', 'Kasir Dua', 'kasir2@laundry.com', '081234567891', 'Jl. Kasir No. 2', 'aktif');