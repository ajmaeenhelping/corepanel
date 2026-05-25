-- Itm table: stores items linked to categories (depends on cat table)
CREATE TABLE IF NOT EXISTS `itm` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `itm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_itm_cat_id` (`cat_id`);

ALTER TABLE `itm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

ALTER TABLE `itm`
  ADD CONSTRAINT `FK_itm_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Seed item data
INSERT IGNORE INTO `itm` (`id`, `cat_id`, `code`, `name`, `qty`) VALUES
(1, 1, 'I100', 'Item A', 33),
(2, 2, 'I101', 'Item B', 0),
(3, 1, 'I200', 'Item C', 1000),
(4, 1, 'I205', 'Item Dx', 0),
(5, 5, 'I600', 'Item Exx', 331313),
(6, 4, 'I999', 'Caterpillar', 0),
(7, 1, 'I988', 'Football', 0),
(8, 2, 'I876', 'Ice-Cream', 0),
(9, 1, 'I763', 'Juice', 0),
(10, 1, 'I663', 'Mattress', 0),
(13, 5, 'asd', 'asd', 133232),
(14, 9, 'hgjhgjgj', 'gjghjghj', 666),
(15, 9, 'asddddd', 'asdjjjjjjj', 22),
(17, 9, 'der', 'evr', 21),
(18, 11, 'cpp', 'cplus', 1),
(19, 11, 'm3', 'mathxxx', 6),
(20, 1, '7777', 'Seven', 3),
(21, 1, 'aa', 'aaa', 1),
(22, 1, 'bbb', 'bbb', 2),
(23, 1, 'ccc', 'cc', 3),
(24, 1, 'ddd', 'ddd', 4),
(27, 1, 'xxx', 'aaa', 111),
(30, 12, 'test', '111', 222),
(31, 15, '1234ffff', 'a', 121),
(33, 15, '1234567890', 'testing', 12),
(36, 15, 'sads', 'd', 0),
(37, 1, 'z999', 'pineapple xxx', 222),
(38, 11, 'dsdsd', 'sds', 23),
(41, 15, 'dededede', '333', 3),
(43, 30, 'harun', 'itm_harun', 2);
