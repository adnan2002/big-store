-- Create a new database named 'gemini_store'
CREATE DATABASE IF NOT EXISTS `gemini_store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gemini_store`;

-- Table structure for table `categories`
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `categories`
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Hoodies & Sweatshirts', 'Comfortable and stylish hoodies and sweatshirts.'),
(2, 'Pants', 'A wide variety of pants for all occasions.'),
(3, 'T-Shirts', 'Cool and casual T-shirts for everyday wear.');

-- Table structure for table `products`
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `more_information` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `products`
INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image_url`, `more_information`) VALUES
(1, 1, 'Abominable Hoodie', 'Stay warm and stylish with this abominable hoodie. Perfect for chilly weather.', 69.00, 'https://placehold.co/600x600/FFC107/FFFFFF?text=Hoodie', 'Material: 80% Cotton, 20% Polyester. Care: Machine wash cold, tumble dry low.'),
(2, 1, 'Chaz Kangaroo Hoodie', 'A classic kangaroo hoodie with a modern twist. Features a large front pocket.', 52.00, 'https://placehold.co/600x600/4CAF50/FFFFFF?text=Hoodie', 'Material: 100% French Terry Cotton. Fit: Regular.'),
(3, 2, 'Geo Insulated Jogging Pant', 'Comfortable and warm jogging pants, perfect for your morning run or lounging.', 40.80, 'https://placehold.co/600x600/2196F3/FFFFFF?text=Pants', 'Features: Insulated lining, elastic waistband, zippered pockets.'),
(4, 2, 'Kratos Gym Pant', 'Lightweight and breathable gym pants designed for maximum performance.', 45.00, 'https://placehold.co/600x600/F44336/FFFFFF?text=Pants', 'Features: Moisture-wicking fabric, athletic fit.'),
(5, 1, 'Stellar Solar Jacket', 'A lightweight jacket that protects you from the elements while looking great.', 75.00, 'https://placehold.co/600x600/9C27B0/FFFFFF?text=Jacket', 'Features: Water-resistant, windproof, packable design.'),
(6, 3, 'Radiant Tee', 'A bright and comfortable tee that will make you stand out.', 22.00, 'https://placehold.co/600x600/FF9800/FFFFFF?text=Tee', 'Material: 100% Combed Cotton. Fit: Slim.');


-- Table structure for table `related_products`
CREATE TABLE `related_products` (
  `product_id` int(11) NOT NULL,
  `related_product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_product_id`),
  KEY `related_product_id` (`related_product_id`),
  CONSTRAINT `related_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `related_products_ibfk_2` FOREIGN KEY (`related_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `related_products`
INSERT INTO `related_products` (`product_id`, `related_product_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 5),
(3, 4),
(4, 3);
