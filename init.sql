-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2025 at 03:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `big_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Hoodies & Sweatshirts', 'Comfortable and stylish hoodies and sweatshirts.'),
(2, 'Pants', 'A wide variety of pants for all occasions.'),
(3, 'T-Shirts', 'Cool and casual T-shirts for everyday wear.');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `more_information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image_url`, `more_information`) VALUES
(1, 1, 'Abominable Hoodie', 'Stay warm and stylish with this abominable hoodie. Perfect for chilly weather.', 69.00, 'https://demo.hyva.io/media/catalog/product/cache/d549f3be579ecf59a7336331edf35388/m/h/mh09-blue_main_1.jpg', 'Material: 80% Cotton, 20% Polyester. Care: Machine wash cold, tumble dry low.'),
(2, 1, 'Chaz Kangaroo Hoodie', 'A classic kangaroo hoodie with a modern twist. Features a large front pocket.', 52.00, 'https://magento-demo.apptonize.com/media/catalog/product/cache/c6d1e8379a2c7756411f32523e91fe46/m/h/mh08-brown_main_1.jpg', 'Material: 100% French Terry Cotton. Fit: Regular.'),
(3, 2, 'Geo Insulated Jogging Pant', 'Comfortable and warm jogging pants, perfect for your morning run or lounging.', 40.80, 'https://demo.hyva.io/media/catalog/product/cache/43b42de3ea3c4fdb855c664665d5d78f/m/p/mp03-black_main_1.jpg', 'Features: Insulated lining, elastic waistband, zippered pockets.'),
(4, 2, 'Kratos Gym Pant', 'Lightweight and breathable gym pants designed for maximum performance.', 45.00, 'https://shoptaylor.in/wp-content/uploads/2022/05/mp05-blue_main.jpg', 'Features: Moisture-wicking fabric, athletic fit.'),
(5, 1, 'Stellar Solar Jacket', 'A lightweight jacket that protects you from the elements while looking great.', 75.00, 'https://demo-m2.bird.eu/media/catalog/product/cache/00d5f4c4be32dd6972e5a4316b89309a/w/j/wj01-red_main.jpg', 'Features: Water-resistant, windproof, packable design.'),
(6, 3, 'Radiant Tee', 'A bright and comfortable tee that will make you stand out.', 22.00, 'https://magento.demo.getready.cz/media/catalog/product/cache/2d7f87443565376d33f5baaa07171e9a/w/s/ws12-orange_main_2.jpg', 'Material: 100% Combed Cotton. Fit: Slim.');

-- --------------------------------------------------------

--
-- Table structure for table `related_products`
--

CREATE TABLE `related_products` (
  `product_id` int(11) NOT NULL,
  `related_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `related_products`
--

INSERT INTO `related_products` (`product_id`, `related_product_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 5),
(3, 4),
(4, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `related_products`
--
ALTER TABLE `related_products`
  ADD PRIMARY KEY (`product_id`,`related_product_id`),
  ADD KEY `related_product_id` (`related_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `related_products`
--
ALTER TABLE `related_products`
  ADD CONSTRAINT `related_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `related_products_ibfk_2` FOREIGN KEY (`related_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
