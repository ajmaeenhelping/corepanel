-- Employee table: stores admin panel user accounts
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL DEFAULT 0,
  `usr` text,
  `pwd` text,
  `name` text,
  `designation` text,
  `last_login` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `active` int(11) NOT NULL DEFAULT '0',
  `isadmin` int(11) NOT NULL DEFAULT '0',
  `info` text,
  `skey` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Default admin account (password: admin via MD5)
INSERT IGNORE INTO `employee` (`id`, `usr`, `pwd`, `name`, `designation`, `last_login`, `active`, `isadmin`, `info`, `skey`) VALUES
(1, 'admin', 'b4e9662fef8c7cb2149f87a439dbdd3f', 'Administrator', 'Administrator', '2022-05-26 16:24:17', 1, 1, '-', 'k6c0nvvbwjnqry9dkwf9fymr8gmjv31u');
