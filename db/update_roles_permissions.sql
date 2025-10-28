-- Update roles table permissions with new structure
UPDATE `roles` SET 
`permissions` = '["master_admin","master_role","master_owner","master_customer","master_kasir","master_transaksi","setting_discount","setting_harga"]'
WHERE `id_role` = 1;

UPDATE `roles` SET 
`permissions` = '["master_customer","master_transaksi"]'
WHERE `id_role` = 2;

UPDATE `roles` SET 
`permissions` = '["master_transaksi"]'
WHERE `id_role` = 3;