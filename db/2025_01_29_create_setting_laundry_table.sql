-- Create setting_laundry table for laundry business information
-- Date: 2025-01-29

CREATE TABLE `setting_laundry` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama_laundry` varchar(255) NOT NULL DEFAULT 'LAUNDRY SYSTEM',
  `alamat` text NOT NULL DEFAULT 'Jl. Contoh No. 123',
  `telepon` varchar(20) NOT NULL DEFAULT '(021) 1234-5678',
  `email` varchar(100) NULL,
  `website` varchar(100) NULL,
  `logo` varchar(255) NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default data
INSERT INTO `setting_laundry` (`nama_laundry`, `alamat`, `telepon`, `email`) VALUES
('LAUNDRY SYSTEM', 'Jl. Contoh No. 123', '(021) 1234-5678', 'info@laundry.com');