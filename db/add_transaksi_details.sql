-- Add columns to transaksi table for detailed transaction information
ALTER TABLE `transaksi` 
ADD COLUMN `berat_kg` DECIMAL(5,2) NULL COMMENT 'Berat laundry dalam kg' AFTER `catatan`,
ADD COLUMN `jarak_km` DECIMAL(5,2) NULL COMMENT 'Jarak pengiriman dalam km' AFTER `berat_kg`,
ADD COLUMN `harga_per_kg` DECIMAL(10,2) NULL COMMENT 'Harga per kg yang digunakan' AFTER `jarak_km`,
ADD COLUMN `harga_per_km` DECIMAL(10,2) NULL COMMENT 'Harga per km yang digunakan' AFTER `harga_per_kg`,
ADD COLUMN `tier_laundry` VARCHAR(50) NULL COMMENT 'Tier laundry yang digunakan' AFTER `harga_per_km`,
ADD COLUMN `tier_ongkir` VARCHAR(50) NULL COMMENT 'Tier ongkir yang digunakan' AFTER `tier_laundry`;