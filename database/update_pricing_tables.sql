-- Update setting_harga_ongkir with distance-based pricing
TRUNCATE TABLE `setting_harga_ongkir`;
INSERT INTO `setting_harga_ongkir` (`nama_area`, `harga_ongkir`, `estimasi_hari`) VALUES
('0-5 km', 2000.00, 1),
('6-10 km', 3000.00, 1),
('11-20 km', 4000.00, 2),
('20+ km', 5000.00, 2);

-- Update tier_discounts with fixed amount discounts
TRUNCATE TABLE `tier_discounts`;
INSERT INTO `tier_discounts` (`nama_tier`, `min_transaksi`, `discount_percent`) VALUES
('bronze', 0, 5000.00),
('silver', 10, 7000.00),
('gold', 25, 10000.00),
('platinum', 50, 15000.00);