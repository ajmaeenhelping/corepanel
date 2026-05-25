-- Product table: stores products linked to categories (depends on cat table)
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `name` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_product_slug` (`slug`),
  ADD KEY `FK_product_cat_id` (`cat_id`);

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Seed product data
INSERT IGNORE INTO `product` (`id`, `slug`, `name`, `cat_id`, `price`, `stock`) VALUES
(1, 'sample-widget',   'Sample Widget',   1, 19.90,  50),
(2, 'demo-gadget',     'Demo Gadget',     1, 49.00,  12),
(3, 'starter-kit',     'Starter Kit',     2, 129.00,  5),
(4, 'premium-bundle',  'Premium Bundle',  2, 299.00,  0);
