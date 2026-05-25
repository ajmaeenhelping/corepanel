-- Banner table: stores banner image entries
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL DEFAULT 0,
  `name` mediumtext NOT NULL,
  `image` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- Seed banner data
INSERT IGNORE INTO `banner` (`id`, `name`, `image`) VALUES
(1, 'Banner1', '../uploads/3ums7uxwatpmz637.jpg'),
(2, 'Banner 2', '../uploads/y1e321aspmhnnat8.jpg');
