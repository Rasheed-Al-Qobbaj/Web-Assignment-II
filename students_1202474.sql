-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 08:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `description`, `price`, `rating`, `image`, `quantity`) VALUES
(1, 'The Executive Blazer', 'Blazer', 'The Executive Blazer is a premium-quality, off-the-rack blazer with a modern cut and classic detailing. Suitable for both business and formal occasions, it offers a perfect blend of style and comfort.', 499.99, 5, '1.jpeg', 10),
(2, 'The Sovereign Suit', 'Suit', 'The Sovereign Suit is a hand-stitched, custom-tailored suit made from the finest Italian wool. Designed to fit the wearer’s exact measurements and style preferences, this suit offers unparalleled elegance and sophistication.', 1299.99, 4, '2.jpeg', 5),
(3, 'Azual Shirt', 'Shirt', 'Feel the cool summer breeze while wearing this very fashionable navy blue camisa. Catch some Hands', 130.00, 5, '3.jpeg', 50),
(7, 'Classic Blazer', 'Blazer', 'A timeless classic blazer perfect for any formal occasion.', 120.00, 5, '7.jpeg', 20),
(8, 'Modern Fit Suit', 'Suit', 'A modern fit suit with a sleek design.', 250.00, 4, '8.jpeg', 10),
(9, 'Cotton Dress Shirt', 'Shirt', 'A comfortable cotton dress shirt suitable for office wear.', 45.00, 4, '9.jpeg', 30),
(10, 'Leather Dress Shoes', 'Footware', 'High-quality leather dress shoes for formal events.', 90.00, 5, '10.jpeg', 15),
(11, 'Silk Tie', 'Accessory', 'A premium silk tie to complement your formal attire.', 25.00, 5, '11.jpeg', 50),
(12, 'Casual Blazer', 'Blazer', 'A casual blazer for semi-formal occasions.', 100.00, 4, '12.jpeg', 25),
(13, 'Slim Fit Suit', 'Suit', 'A slim fit suit for a contemporary look.', 275.00, 4, '13.jpeg', 8),
(14, 'Linen Shirt', 'Shirt', 'A lightweight linen shirt ideal for warm weather.', 40.00, 3, '14.jpeg', 40),
(15, 'Running Sneakers', 'Footware', 'Comfortable running sneakers for daily exercise.', 60.00, 4, '15.jpeg', 22),
(16, 'Leather Belt', 'Accessory', 'A durable leather belt to complete your outfit.', 35.00, 4, '16.jpeg', 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
