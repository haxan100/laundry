-- Update transaksi table to add missing columns for laundry POS system
-- Date: 2025-01-29

ALTER TABLE `transaksi` 
ADD COLUMN `total_kilo` DECIMAL(5,2) NOT NULL DEFAULT 0 AFTER `no_hp`,
ADD COLUMN `id_layanan` INT(11) NULL AFTER `total_kilo`,
ADD COLUMN `harga_per_kilo` DECIMAL(10,2) NOT NULL DEFAULT 0 AFTER `id_layanan`,
ADD COLUMN `subtotal_laundry` DECIMAL(10,2) NOT NULL DEFAULT 0 AFTER `harga_per_kilo`,
ADD COLUMN `is_delivery` TINYINT(1) NOT NULL DEFAULT 0 AFTER `subtotal_laundry`,
ADD COLUMN `id_ongkir` INT(11) NULL AFTER `is_delivery`,
ADD COLUMN `harga_ongkir` DECIMAL(10,2) NOT NULL DEFAULT 0 AFTER `id_ongkir`,
ADD COLUMN `discount_percent` DECIMAL(5,2) NOT NULL DEFAULT 0 AFTER `harga_ongkir`,
ADD COLUMN `discount_amount` DECIMAL(10,2) NOT NULL DEFAULT 0 AFTER `discount_percent`,
ADD COLUMN `catatan` TEXT NULL AFTER `payment_method`;