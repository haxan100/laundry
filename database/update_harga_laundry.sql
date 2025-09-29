-- Update setting_harga_laundry table with tier pricing
TRUNCATE TABLE `setting_harga_laundry`;

-- Insert tier-based pricing
INSERT INTO `setting_harga_laundry` (`nama_layanan`, `harga_per_kilo`, `deskripsi`) VALUES
('Tier 1 (1-4kg)', 5000.00, 'Harga untuk 1-4 kilogram'),
('Tier 2 (5-9kg)', 3500.00, 'Harga untuk 5-9 kilogram'),
('Tier 3 (10-19kg)', 2500.00, 'Harga untuk 10-19 kilogram'),
('Tier 4 (20kg+)', 2000.00, 'Harga untuk 20 kilogram ke atas');