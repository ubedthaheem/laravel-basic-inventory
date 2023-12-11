-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 12:15 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `slug`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'mobile-phone', 'Mobile Phones', 'this is detail', '2023-12-10 10:38:17', '2023-12-10 12:29:17', NULL),
(2, NULL, 'tablets', 'Tablets', 'Tablet detail', '2023-12-10 10:45:51', '2023-12-10 11:06:51', NULL),
(3, NULL, 'accessories', 'Accessories', NULL, '2023-12-10 10:47:09', '2023-12-10 10:47:09', NULL),
(4, 3, 'ear-buds', 'Ear Buds', NULL, '2023-12-10 10:54:40', '2023-12-10 11:07:10', NULL),
(5, 3, 'laptop', 'Laptop', NULL, '2023-12-11 05:58:54', '2023-12-11 05:58:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_12_10_093847_create_categories_table', 3),
(12, '2023_12_10_093907_create_stock_table', 4),
(11, '2023_12_10_093901_create_products_table', 4),
(9, '2023_12_10_093916_create_supplier_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_product_code_unique` (`product_code`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_added_by_foreign` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `added_by`, `product_name`, `product_code`, `cost`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Samsung Galaxy A50f', 'sx50f2019', '2500.78', 'Discount is available for this phone', 'assets/images/products/1702244191_sa50f2019_a50f.webp', '2023-12-10 16:36:31', '2023-12-10 17:22:17', NULL),
(2, 5, 1, 'HP ENVY x360 15t 10th Gen', 'hp1051', '2500.00', 'Best machine for small tasks.', 'assets/images/products/1702292477_hp1051_41YHkxx3PWL._SL500_._AC_SL500_.jpg', '2023-12-11 06:01:17', '2023-12-11 06:01:17', NULL),
(3, 4, 1, 'Xiaomi Redmi Buds 3 Lite', 'buds3ze1244', '100.00', 'Highlights:\r\n\r\nBluetooth 5.2 Technology for stable connection\r\nUp to 18 hours battery life\r\nIP54 waterproof and dustproof\r\n6mm high-fidelity speakers for high definition sound quality\r\nThree different sizes of silicone pads included', 'assets/images/products/1702292642_buds3ze1244_Layer-1-212-600x600.jpg', '2023-12-11 06:04:02', '2023-12-11 06:04:02', NULL),
(4, 4, 1, 'Beats Studio Buds', 'beats1234buds', '400.00', 'Beats Custom Acoustic Platform\r\nBeats Studio Buds + custom acoustic platform packs powerful, balanced sound in a sophisticated, pocketable design. Reengineered acoustic venting improves audio precision and gently relieves pressure for a more comfortable all-day fit. Each bud is equipped with a two-layer transducer that flexes to deliver cleaner bass and ultra-low distortion. So whether you’re listening to music or taking calls, Studio Buds + deliver rich, immersive sound wherever you go.\r\n\r\nActive Noise Cancelling and Transparency Mode\r\nAt the touch of a button, two dynamic listening modes let you choose whether to keep the world out or let it in. Active Noise Cancelling (ANC) has been engineered to adapt to your personal fit, neutralizing unwanted external noise. Easily switch to Transparency mode when you need awareness of the world around you.\r\n\r\nMore Music, Less Charging\r\nWith up to 36 hours of total battery life¹ including 27 hours from the sleek, pocket-sized charging case and up to 9 hours from the earbuds, Beats Studio Buds + are ready to go whenever you are. Find yourself low on battery? A 5-minute Fast Fuel charge provides an hour of additional use² so you get more music, podcasts, and calls between every charge.\r\n\r\nEnhanced Apple and Android Compatibility\r\nBeats Studio Buds + offer a robust set of Apple and Android features including one-touch pairing and ‘Find My’ device.³\r\n\r\nEnhanced Apple Compatibility\r\nBeats Studio Buds + offer a host of native Apple features:\r\nOne-touch pairing - easy, one-touch setup instantly pairs with every device in your iCloud account⁴\r\n“Hey Siri”  - simply say “Hey Siri” to activate your voice assistant⁵\r\nFind My - locate your lost earbuds on a map based on the last known connected location⁶\r\nOver-the-air updates - receive software updates and new features automatically\r\nEnhanced Android Compatibility\r\nBeats Studio Buds + are equipped with an array of native Android features:\r\n\r\nGoogle Fast Pair - connect quickly with a single tap, and automatically pair to all Android or Chrome devices registered to your Gmail account⁷\r\nAudio Switch - seamlessly transition audio between your Android, Chromebook, and other compatible devices⁸\r\nFind My Device - easily locate your lost buds with Google Find My Device⁹\r\nFor additional features, download the Beats app to unlock access to product customization, software updates, and new features to get the most out of your headphones.\r\nClear Calls\r\nUpgraded voice-targeting microphones in Beats Studio Buds + give you high-quality call performance. These powerful microphones actively filter out background noise to enhance the clarity of your voice.\r\n\r\nFit For Better Sound\r\nBeats Studio Buds + offer a comfortable fit with a perfect acoustic seal for the best sound experience. With four eartip options (XS, S, M & L), Studio Buds + are designed to fit a wider range of ears. Simple, customizable on-ear controls give you quick access to your favorite settings and sweat and water resistance (IPX4) lets you take them anywhere you want to go.¹⁰', 'assets/images/products/1702292724_beats1234buds_MQLK3.jpeg', '2023-12-11 06:05:24', '2023-12-11 06:05:24', NULL),
(5, 5, 1, 'Apple MacBook Air 15-Inch', 'mair15i3', '3000.00', 'The big screen Apple MacBook Air 15-Inch (2023) review - The Hindu BusinessLine\r\nThe big screen Apple MacBook Air 15-Inch (2023) review - The Hindu BusinessLine\r\nThe big screen Apple MacBook Air 15-Inch (2023) review - The Hindu BusinessLine', 'assets/images/products/1702292842_mair15i3_MacBookAir 15inch_5.webp', '2023-12-11 06:07:22', '2023-12-11 06:07:22', NULL),
(6, 5, 1, 'MacBook Pro 16-inch', 'mbpro16i', '3500.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'assets/images/products/1702293111_mbpro16i_MACBOOKPRO16INCH_silver_1.jpeg', '2023-12-11 06:11:51', '2023-12-11 06:11:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_supplier_id_foreign` (`supplier_id`),
  KEY `stock_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `supplier_id`, `product_id`, `quantity`, `added_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 15, '2023-12-19', '2023-12-10 17:38:16', '2023-12-10 17:38:16'),
(2, 1, 1, 23, '2023-12-05', '2023-12-10 17:51:51', '2023-12-10 17:51:51'),
(3, 2, 2, 15, '2023-12-01', '2023-12-11 06:01:57', '2023-12-11 06:01:57'),
(4, 3, 2, 2000, '2023-06-14', '2023-12-11 06:08:57', '2023-12-11 06:08:57'),
(5, 4, 5, 63, '2023-12-05', '2023-12-11 06:09:16', '2023-12-11 06:09:16'),
(6, 2, 4, 600, '2023-12-10', '2023-12-11 06:09:36', '2023-12-11 06:09:36'),
(7, 2, 3, 800, '2023-12-10', '2023-12-11 06:09:54', '2023-12-11 06:09:54'),
(8, 4, 6, 824, '2023-12-07', '2023-12-11 06:12:14', '2023-12-11 06:12:14'),
(9, 4, 1, 30, '2023-12-15', '2023-12-11 06:48:31', '2023-12-11 06:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `supplier_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Indus Adveritinsg', '05222222223', 'indus@example.com', 'This is address', '2023-12-10 14:47:01', '2023-12-10 14:58:00', NULL),
(2, 'Supplier Group', '05123456789', 'sample@email.com', NULL, '2023-12-10 14:50:16', '2023-12-10 14:56:05', NULL),
(3, 'Hewlett Packard', '05222222225', 'info@hp.com', 'UAE', '2023-12-11 06:08:09', '2023-12-11 06:08:09', NULL),
(4, 'Apple Incorporation', '0548892138', 'info@apple.com', NULL, '2023-12-11 06:08:34', '2023-12-11 06:08:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ubaid Thaheem', 'admin@example.com', NULL, '$2y$12$./ffcSXL9NBk0GUqlJk2uuEwRtoUbVKGdNotGoaQKfoKhQomRrb7C', NULL, '2023-12-10 04:36:22', '2023-12-10 04:36:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
