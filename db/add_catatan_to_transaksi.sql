-- Menambahkan kolom catatan ke tabel transaksi
ALTER TABLE `transaksi` ADD COLUMN `catatan` TEXT NULL AFTER `payment_method`;