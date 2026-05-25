-- Migration 009: Add BM and ZH language columns to content tables
-- Activates the $lg column-suffix pattern for email_template and page tables.

-- email_template: heading + data per language (Separated to allow individual skips)
ALTER TABLE `email_template` ADD COLUMN `heading_bm` TEXT NULL AFTER `heading`;
ALTER TABLE `email_template` ADD COLUMN `heading_zh` TEXT NULL AFTER `heading_bm`;
ALTER TABLE `email_template` ADD COLUMN `data_bm` LONGTEXT NULL AFTER `data`;
ALTER TABLE `email_template` ADD COLUMN `data_zh` LONGTEXT NULL AFTER `data_bm`;

-- page: data per language (Separated to allow individual skips)
ALTER TABLE `page` ADD COLUMN `data_bm` LONGTEXT NULL AFTER `data`;
ALTER TABLE `page` ADD COLUMN `data_zh` LONGTEXT NULL AFTER `data_bm`;