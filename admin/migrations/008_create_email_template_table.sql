-- Email template table: used by sendMail() in common.lib
-- Columns 'heading' and 'data' map to $e["heading".$lg] and $e["data".$lg]
-- where $lg defaults to empty string (single language setup)
CREATE TABLE IF NOT EXISTS `email_template` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `heading` text NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
