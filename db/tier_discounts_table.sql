-- Table: tier_discounts
CREATE TABLE `tier_discounts` (
  `id_discount` int(11) NOT NULL AUTO_INCREMENT,
  `tier_level` enum('bronze','silver','gold','platinum') NOT NULL UNIQUE,
  `discount_amount` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_discount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert default tier discounts
INSERT INTO `tier_discounts` (`tier_level`, `discount_amount`) VALUES
('bronze', 5000),
('silver', 7000),
('gold', 10000),
('platinum', 15000);