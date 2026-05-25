-- Setup table: stores global system configuration values
CREATE TABLE IF NOT EXISTS `setup` (
  `id` int(11) NOT NULL DEFAULT 0,
  `num1` int(11) NOT NULL DEFAULT 0,
  `txt1` text NOT NULL,
  `primarycolor` text,
  `secondarycolor` text,
  `time1` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `setup`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Default setup row
INSERT IGNORE INTO `setup` (`id`, `num1`, `txt1`, `primarycolor`, `secondarycolor`, `time1`) VALUES
(1, 2, 'example', '#01a0c8', '#00dc9f', '00:00:00');
