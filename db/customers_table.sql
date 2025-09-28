-- Table: customers
CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) UNIQUE,
  `telepon` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tier_level` enum('bronze','silver','gold','platinum') DEFAULT 'bronze',
  `last_login` timestamp NULL DEFAULT NULL,
  `last_wash` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert sample customers
INSERT INTO `customers` (`nama`, `email`, `telepon`, `password`, `tier_level`) VALUES
('John Doe', 'john@example.com', '8912345678', '5d41402abc4b2a76b9719d911017c592', 'bronze'),
('Jane Smith', 'jane@example.com', '8987654321', '5d41402abc4b2a76b9719d911017c592', 'silver'),
('Bob Wilson', 'bob@example.com', '8955555555', '5d41402abc4b2a76b9719d911017c592', 'gold');