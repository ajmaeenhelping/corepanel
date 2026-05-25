-- Cat table: stores categories (used by itm and other modules)
CREATE TABLE IF NOT EXISTS `cat` (
  `id` int(11) NOT NULL DEFAULT 0,
  `code` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- Seed category data
INSERT IGNORE INTO `cat` (`id`, `code`, `name`) VALUES
(1, 'C1', 'Category 1'),
(2, 'C2', 'Category 2x');
