-- Demo table: full-featured demo/showcase table with all field types
CREATE TABLE IF NOT EXISTS `demo` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `age` int(11) NOT NULL,
  `salary` double NOT NULL,
  `email` text NOT NULL,
  `url` text NOT NULL,
  `phone` text NOT NULL,
  `pwd` text NOT NULL,
  `alphanum` text NOT NULL,
  `address` text NOT NULL,
  `info` text NOT NULL,
  `dob` date NOT NULL,
  `dt1` date NOT NULL,
  `updated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `disp` text NOT NULL,
  `cat1` int(11) NOT NULL,
  `cat2` int(11) NOT NULL,
  `cbo1` text NOT NULL,
  `cbo2` text NOT NULL,
  `rad1` text NOT NULL,
  `rad2` text NOT NULL,
  `cbx1` int(11) NOT NULL,
  `cbx2` int(11) NOT NULL,
  `cbx3` int(11) NOT NULL,
  `cbx4` int(11) NOT NULL,
  `cbx5` int(11) NOT NULL,
  `cms1` text NOT NULL,
  `cms2` longtext NOT NULL,
  `txt1` text NOT NULL,
  `txt2` text NOT NULL,
  `txt3` text NOT NULL,
  `txt4` text NOT NULL,
  `txt5` text NOT NULL,
  `txt6` text NOT NULL,
  `txt7` text NOT NULL,
  `txt8` text NOT NULL,
  `dbl1` double NOT NULL,
  `dbl2` double NOT NULL,
  `dbl3` double NOT NULL,
  `catx` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- Seed demo data
INSERT IGNORE INTO `demo` (`id`, `code`, `name`, `age`, `salary`, `email`, `url`, `phone`, `pwd`, `alphanum`, `address`, `info`, `dob`, `dt1`, `updated`, `disp`, `cat1`, `cat2`, `cbo1`, `cbo2`, `rad1`, `rad2`, `cbx1`, `cbx2`, `cbx3`, `cbx4`, `cbx5`, `cms1`, `cms2`, `txt1`, `txt2`, `txt3`, `txt4`, `txt5`, `txt6`, `txt7`, `txt8`, `dbl1`, `dbl2`, `dbl3`, `catx`) VALUES
(1, 'CCC', 'sadasdsad', 12, 12.12, 'sam@hotmail.com', 'https://google.com.my', '(123 - 123', 'abc123', 'asd123', 'address', 'information\r\nline 2\r\nline 3', '1950-05-02', '2021-01-21', '2023-12-05 18:14:30', '', 1, 1, 'AAA', '', 'Male', 'Cat', 0, 1, 1, 1, 1, '<p>abc</p>\r\n<p><span style="color: #ff0000;"><strong>def</strong></span></p>', '', '', '', 'aaa', '213213213', 'aasdsadsdsdsaddsadsadsadsadadasd', 'blue', '32 character(s)', 'cpp', 0, 0, 0, 'apple pie'),
(2, 'Code 2', 'Name 2', 0, 0, 'abc@gmail.com', 'https://google.com', '', '', '', '', '', '1950-01-02', '2020-05-18', '2023-12-05 18:17:33', '', 2, 1, 'BBB', 'EEE', 'Male', '', 0, 0, 0, 0, 0, '<p>asd</p>\r\n<p>asd</p>', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'apple pie'),
(3, 'EEEEE', 'eeeeee', 22, 0, 'ccc@ccc.com', '', '', '', '', '', '', '2020-05-10', '2020-05-18', '2023-12-05 18:18:21', '', 1, 1, 'CCC', '', 'Male', '', 0, 0, 0, 0, 0, '<p>ddeed</p>', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'apple tart'),
(4, 'fgh', '234', 0, 0, '', '', '', '', '', 'xdx, sdsds&#039; hjgjgh&quot; , kjkjjkh 2/5, dxd', '', '2020-05-04', '2020-05-18', '2023-12-05 18:46:47', 'A-00004', 1, 2, 'CCC', 'EEE', 'Male', '', 0, 1, 0, 0, 0, '<p>asdsadsadsadsadsad</p>', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'apple pie');
