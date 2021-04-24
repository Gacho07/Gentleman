-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2020 at 11:26 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktikum_sajt`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(3) NOT NULL,
  `article_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `original_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp(),
  `category_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_name`, `description`, `price`, `original_image`, `new_image`, `alt`, `date_posted`, `category_id`) VALUES
(1, 'Button turtle neck', 'Nice jumper with turtle neck', '87', 'assets/img/1588181050_burton_turtle_neck.jpg', 'assets/img/1588181050_burton_turtle_neck.jpg-new', 'turtle neck', '2020-04-29 19:24:10', 2),
(2, 'Classic jumper', 'Cotton black jumper for low price', '35', 'assets/img/1588181152_cotton_black.jpg', 'assets/img/1588181152_cotton_black.jpg-new', 'cotton black', '2020-04-29 19:25:52', 2),
(3, 'Floral shirt', 'Colorful and simple shirt for sunny days', '20', 'assets/img/1588181217_floral_shirt.jpg', 'assets/img/1588181217_floral_shirt.jpg-new', 'floral shirt', '2020-04-29 19:26:57', 3),
(4, 'Fred Perry shirt', 'Short sleeve shirt from newest collection ', '120', 'assets/img/1588181393_fred_perry_short_sleeve.jpg', 'assets/img/1588181393_fred_perry_short_sleeve.jpg-new', 'fred perry shirt', '2020-04-29 19:29:53', 3),
(5, 'Knitted jumper', 'Muscle fit jumper', '44', 'assets/img/1588181461_knitted_muscle_fit.jpg', 'assets/img/1588181461_knitted_muscle_fit.jpg-new', 'muscle fit jumper', '2020-04-29 19:31:01', 2),
(6, 'Classic white shirt', 'Linear white shirt for office', '35', 'assets/img/1588181534_linear_white_shirt.jpg', 'assets/img/1588181534_linear_white_shirt.jpg-new', 'white shirt', '2020-04-29 19:32:14', 3),
(7, 'Merino wool jumper', 'Warm and fit jumper for cold days', '93', 'assets/img/1588181579_merino_wool.jpg', 'assets/img/1588181579_merino_wool.jpg-new', 'merino wool jumper', '2020-04-29 19:32:59', 2),
(8, 'Nike sweatshirt', 'Zip up niky hoodie', '52', 'assets/img/1588181621_nike_zip_up.jpg', 'assets/img/1588181621_nike_zip_up.jpg-new', 'zip up sweatshirt', '2020-04-29 19:33:41', 1),
(9, 'Double layer sweatshirt', 'Oversized double layer with Ricky & Morty logo', '147', 'assets/img/1588181670_oversized_double_layer.jpg', 'assets/img/1588181670_oversized_double_layer.jpg-new', 'double layer', '2020-04-29 19:34:30', 1),
(10, 'Brown classic jumper', 'Ribbed jumper, old fashioned style', '88', 'assets/img/1588181760_ribbed_jumper.jpg', 'assets/img/1588181760_ribbed_jumper.jpg-new', 'ribbed jumper', '2020-04-29 19:36:00', 2),
(11, 'Pull Bear hoodie', 'White classic overhead sweatshirts', '77', 'assets/img/1588182540_pull_bear_overhead.jpg', 'assets/img/1588182540_pull_bear_overhead.jpg-new', 'pull bear hoodie', '2020-04-29 19:49:00', 1),
(12, 'Tom Tailor shirt', 'Navy blue shirt, brand Tom Tailor', '85', 'assets/img/1588182587_tom_tailor.jpg', 'assets/img/1588182587_tom_tailor.jpg-new', 'tom tailor shirt', '2020-04-29 19:49:47', 3),
(13, 'Tommy Hilfiger sweatshirt', 'Full zip in gray color', '130', 'assets/img/1588182697_tommy_higflinger_full_zip.jpg', 'assets/img/1588182697_tommy_higflinger_full_zip.jpg-new', 'full zip sweatshirt', '2020-04-29 19:51:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(3) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `index_number` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`, `index_number`, `description`, `image`, `alt`) VALUES
(1, 'Marko', 'Gačanović', '38/17', 'I am student in the High School of Vocational Studies for Information and Communication Technologies, the direction of Internet technology. This website is project for my PHP course.', 'assets/img/Marko.jpg', 'Marko');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Sweatshirts'),
(2, 'Jumpers'),
(3, 'Shirts');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `mail_id` int(3) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `posting_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`mail_id`, `first_name`, `last_name`, `email`, `message`, `posting_date`) VALUES
(1, 'Marko', 'Gačanović', 'gacanoviccc97@gmail.com', 'Zdravo drugari moji.', '2020-04-19 20:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(3) NOT NULL,
  `text` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `menu_group_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `text`, `link`, `menu_group_id`) VALUES
(1, 'Home', 'home', 1),
(2, 'Articles', 'articles', 1),
(3, 'Contact', 'contact', 1),
(4, 'Author', 'author', 1),
(5, 'Cart', 'cart', 2),
(6, 'Admin/Dashboard', 'admin_dashboard', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `menu_group_id` int(3) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`menu_group_id`, `name`) VALUES
(1, 'all_users'),
(2, 'authorized_users'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `purchase_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `user_id`, `purchase_date`) VALUES
(5, 2, '2020-04-29 23:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `purchase_details_id` int(3) NOT NULL,
  `article_id` int(3) NOT NULL,
  `purchase_id` int(3) NOT NULL,
  `quantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`purchase_details_id`, `article_id`, `purchase_id`, `quantity`) VALUES
(5, 2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(3) NOT NULL,
  `role_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(3) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `image`, `alt`, `description`, `category_id`) VALUES
(1, 'assets/img/slider/gray_sweatshirt.jpeg', 'sweatshirt', 'Stylish gray sweatshirt ', 1),
(2, 'assets/img/slider/shirt.jpg', 'shirt', 'Nice button up shirt and jeans\r\n', 3),
(3, 'assets/img/slider/ribbon.jpg', 'ribbon', 'Shirt with grease and jacket', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp(),
  `role_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `registration_date`, `role_id`) VALUES
(1, 'Marko', 'Gačanović', 'gacanoviccc97@gmail.com', 'c6c0d95e21b180ce7cd28ee7ced3c09a', '2020-04-14 00:00:00', 1),
(2, 'Andjelko', 'Aleksić', 'andjelko@gmail.com', '6b95aa44953c9bace8231b86d9b455e9', '2020-04-14 17:59:44', 2),
(4, 'Petar', 'Petrovic', 'gacanovicm12@yahoo.com', 'b57f795c872b88e01185227fb49890b6', '2020-04-18 17:32:07', 2),
(5, 'Stefan', 'Stefanović', 'stefanovic@gmail.com', 'b1113936ff29626ef4a8211e6fb25e4c', '2020-04-18 17:36:05', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_group_id` (`menu_group_id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`menu_group_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`purchase_details_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `mail_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `menu_group_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `purchase_details_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menu_group_id`) REFERENCES `menu_group` (`menu_group_id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`),
  ADD CONSTRAINT `purchase_details_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
