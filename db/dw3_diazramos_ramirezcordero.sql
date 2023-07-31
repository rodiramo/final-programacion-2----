-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 02:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dw3_diazramos_ramirezcordero`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Indoors'),
(2, 'Exotic'),
(3, 'Tropical'),
(4, 'Flower'),
(5, 'Suculent');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `family_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`family_id`, `name`) VALUES
(1, 'Anthurium'),
(2, 'Philodendron'),
(3, 'Anthurium'),
(4, 'Adansonii'),
(5, 'Caladium'),
(6, 'Calathea'),
(7, 'Dypsis'),
(8, 'Fittonia'),
(9, 'Monstera'),
(10, 'Cactus');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_fk` int(10) UNSIGNED NOT NULL,
  `category_fk` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `price` varchar(30) NOT NULL,
  `img` varchar(50) NOT NULL,
  `img_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `user_fk`, `category_fk`, `name`, `category`, `type`, `description`, `price`, `img`, `img_desc`) VALUES
(1, 2, 1, 'Hookeri Variegated', 'Indoors', 'Anthurium', 'This is the Anthurium Hookeri Variegata, better known as ‘Birdnest Anthurium’. She is a very special plant with long and narrow leaves. These leaves are bright green and are covered with cream with splashes. The pattern on every leaf will differ, which makes every leaf an art piece of its one. ', '24', 'hookeri.webp', 'Anthurium Hookeri Plant'),
(2, 2, 1, 'Melanochrysum', 'Indoors', 'Philodendron', 'Philodendron Melanochrysum is striking even among the stunning lineup that is the Philodendron family and is sometimes referred to as the Black Gold Philodendron because of the beautiful gold accents on her leaves. Her leaves, which start out like a fleshy pink before turning almost black with age.', '30', 'melanochrysum.webp', 'Philodendron Melanochrysum Plant'),
(3, 2, 1, 'Verrucosum', 'Indoors', 'Philodendron', 'Philodendron Verrucosum is a rare gem among the Philodendrons, with so many unique characteristics that we could write a book about it! Her beautiful deep green heart-shaped leaves boast bright veins which seem to jump out from their surfaces.', '21', 'verrucosum.webp', 'Philodendron Verrucosum Plant'),
(4, 2, 1, 'Pink Princess', 'Indoors', 'Philodendron', 'Isn’t she pretty and cute! The Philodendron Pink Princess baby. She has beautiful dark green leaves, in the shape of arrows, that are decorated with an explosion of pink colour. Even the undersides of her leaves have an amazing red/coppery hue. She really is a living work of art.', '10', 'phil.webp', 'Philodendron Pink Princess Plant'),
(5, 2, 1, 'Silver Bushy', 'Indoors', 'Anthurium', 'Stunning heart shaped green leaves with a silver pattern on top, this is the amazing Anthurium Silver Blush. Juvenile leaves will start with a red or violet tone to them, which eventually fades down in a medium green colour. She is a cousin of the beloved Anthurium Crystallinum.', '40', 'anthurium.webp', 'Anthurium Silver Bush Plant'),
(6, 2, 3, 'Monstera', 'Tropical Plant', 'Adansonii', 'The baby Monstera Adansonii, sometimes known as a Swiss cheese plant or a monkey mask, is a natural climber. If you give her a bit of space in your living room you will quickly see roots emerging to try to find things to grab hold of.', '4', 'babymonstera.webp', 'Baby Monstera Plant'),
(7, 2, 3, 'Caladium Tuber - White Queen', 'Tropical Plant', 'Caladium', 'The Caladium is a tropical plant originating from Central and Southern America, particularly Brazil and the Amazon, that grows in the jungle. Caladiums are beautiful plants that grow from bulbs.', '5', 'caladium.webp', 'Caladium White Queen Plant'),
(8, 2, 4, 'Orbifolia', 'Flower Plant', 'Calathea', 'The Calathea Orbifolia is an impressive lady. She overrules the other Calatheas when it comes to the width of leaves. These oversized green leaves are decorated with pretty silvery strokes. Just like many Calatheas the Orbifolia is also known as ‘The Living Plant’.', '100', 'calath.webp', 'Calathea Orbifolia Plant'),
(9, 2, 4, 'Medallion', 'Flower Plant', 'Calathea', 'The Calathea medallion has a memorable appearance with her bold patterned leaves and beautiful deep purple underside. During the day she lets her leaves stand open, but when night falls she closes them up and reveals the deep purple colour on their underside. ', '21.82', 'calathea.webp', 'Medallion Calathea Plant'),
(10, 2, 2, 'Lutescens', 'Outdoors', 'Dypsis', 'Are you a Blommar lover that fancies something big and bold? This Dypsis Lutescens is everything you are longing for! This plant consists of multiple ‘palms’ inside one pot, together they form this massive plant! She will definitely brighten up your house with her bright green pinnate leaves.', '100', 'dypsis.webp', 'Lutensces Dypsis Plant'),
(11, 2, 3, 'Verschaffeltii', 'Tropical Plant', 'Fittonia', 'Fittonia Verschaffeltii (Fittonia \"Mont Blanc\"), is a striking plant by its decorative leaves. The Fittonia is also known as a nerve or mosaic plant. The Fittonia is a tropical houseplant that originally comes from South America. It is an easy plant that needs little care.', '3', 'fittonia.webp', 'Baby Verschaffeltii Fittonia Plant'),
(12, 2, 3, 'Deliciosa', 'Tropical Plant', 'Monstera', 'The Monstera Deliciosa is a large, popular and lush plant often called a Swiss cheese plant, on account of her leaves which are full of large holes. The Monstera is a strong, powerful vine that grows easily, and in her native South American jungles she grows many meters tall. If long strings grow out', '100', 'monstera.webp', 'Deliciosa Monstera Plant');

-- --------------------------------------------------------

--
-- Table structure for table `products_have_families`
--

CREATE TABLE `products_have_families` (
  `product_fk` int(10) UNSIGNED NOT NULL,
  `family_fk` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_have_families`
--

INSERT INTO `products_have_families` (`product_fk`, `family_fk`) VALUES
(1, 7),
(2, 1),
(2, 2),
(2, 10),
(3, 1),
(3, 2),
(3, 9),
(4, 1),
(4, 2),
(4, 6),
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `reset_passwords`
--

CREATE TABLE `reset_passwords` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `fecha_expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`rol_id`, `name`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Editor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `rol_fk` tinyint(3) UNSIGNED NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `rol_fk`, `email`, `password`, `name`, `surname`, `avatar`) VALUES
(1, 1, 'tomas.ramirez@davinci.edu.ar', '$2y$10$3nWqdNxMysqWDu9HspNtz.kjo2D62yYMBV2IzxVDuBa0iJJMA3ZKu', 'Tomas', 'Ramirez', NULL),
(2, 1, 'rocio.diazr@davinci.edu.ar', '$2y$10$3nWqdNxMysqWDu9HspNtz.kjo2D62yYMBV2IzxVDuBa0iJJMA3ZKu', 'Rocio', 'Diaz Ramos', NULL),
(8, 2, 'helloimuser@user.com', '$2y$10$RqJn5HNqQ5vbwUb7Yq92F.PGEUypote52vOt1GqSJxqcXmzPMxiZW', 'Hello', 'I am User', NULL),
(9, 2, 'rocio.diazr@davinci.edu', '$2y$10$9q8YKDrxEKmRUEC68pxd1elK.93Ag1/IaW.lxugNA5vrbNQvJxioy', NULL, NULL, NULL);


--
-- Table structure for table `cart_finally`
--
CREATE TABLE `cart_finally` (
  `cartFinally_id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `finally_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartProducts_finally`
--
CREATE TABLE `cartProducts_finally` (
  `cartProductsFinally_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `cant` int NOT NULL,
  `price` varchar(50) NOT NULL,
  `cartFinally_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart` (
  `cart_byUser_id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `cant` int NOT NULL,
  `price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`family_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_users_idx` (`user_fk`),
  ADD KEY `fk_products_categories_idx` (`category_fk`);

--
-- Indexes for table `products_have_families`
--
ALTER TABLE `products_have_families`
  ADD PRIMARY KEY (`product_fk`,`family_fk`),
  ADD KEY `fk_products_has_families_families1_idx` (`family_fk`),
  ADD KEY `fk_products_has_families_products1_idx` (`product_fk`);

--
-- Indexes for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_users_roles1_idx` (`rol_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
