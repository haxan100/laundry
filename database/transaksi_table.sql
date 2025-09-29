-- Create transaksi table
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `customer_type` enum('tamu','customer','customer_baru') NOT NULL DEFAULT 'tamu',
  `id_customer` int(11) DEFAULT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `pajak` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `status` enum('pending','process','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  KEY `id_kasir` (`id_kasir`),
  KEY `id_customer` (`id_customer`),
  FOREIGN KEY (`id_kasir`) REFERENCES `admin` (`id_admin`),
  FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create transaksi_detail table
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `nama_service` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detail`),
  KEY `id_transaksi` (`id_transaksi`),
  FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;