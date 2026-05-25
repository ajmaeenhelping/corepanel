-- Page table: stores static CMS page content
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- Seed page data
INSERT IGNORE INTO `page` (`id`, `name`, `data`) VALUES
(1, 'home', '<p>sample</p>'),
(2, 'test', '<p>test</p>');
