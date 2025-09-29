-- Update customers table to add total_transaksi column
-- Date: 2025-01-29

ALTER TABLE `customers` 
ADD COLUMN `total_transaksi` INT(11) NOT NULL DEFAULT 0 AFTER `tier_level`;