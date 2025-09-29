-- Create customers table if it doesn't exist
CREATE TABLE IF NOT EXISTS `customers` (
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

-- Insert sample customers (password: hello for all)
INSERT INTO `customers` (`nama`, `email`, `telepon`, `password`, `tier_level`, `last_login`, `last_wash`) VALUES
('John Doe', 'john@example.com', '8912345678', '5d41402abc4b2a76b9719d911017c592', 'bronze', '2024-01-15 10:30:00', '2024-01-10 14:20:00'),
('Jane Smith', 'jane@example.com', '8987654321', '5d41402abc4b2a76b9719d911017c592', 'silver', '2024-01-14 09:15:00', '2024-01-12 16:45:00'),
('Bob Wilson', 'bob@example.com', '8955555555', '5d41402abc4b2a76b9719d911017c592', 'gold', '2024-01-13 11:20:00', '2024-01-11 13:30:00'),
('Alice Brown', 'alice@example.com', '8966666666', '5d41402abc4b2a76b9719d911017c592', 'platinum', '2024-01-12 15:45:00', '2024-01-09 10:15:00'),
('Charlie Davis', 'charlie@example.com', '8977777777', '5d41402abc4b2a76b9719d911017c592', 'bronze', '2024-01-11 08:30:00', '2024-01-08 12:00:00'),
('Diana Evans', 'diana@example.com', '8988888888', '5d41402abc4b2a76b9719d911017c592', 'silver', '2024-01-10 14:20:00', '2024-01-07 09:45:00');