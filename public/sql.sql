-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for softneos_api
CREATE DATABASE IF NOT EXISTS `softneos_api` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `softneos_api`;

-- Dumping structure for table softneos_api.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_image` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_price` decimal(8,2) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.events: ~0 rows (approximately)
INSERT INTO `events` (`id`, `created_at`, `updated_at`, `event_name`, `event_image`, `event_price`, `event_date`, `event_time`) VALUES
	(1, '2024-07-05 06:38:02', '2024-07-05 06:38:02', 'Mar i cel', 'https://teatremusical.cat/wp-content/uploads/2016/03/escanear0010.jpg', 15.00, '2024-08-05', '22:00:00'),
	(2, '2024-07-05 06:38:02', '2024-07-05 06:38:02', 'Mar i cel', 'https://teatremusical.cat/wp-content/uploads/2016/03/escanear0010.jpg', 15.00, '2024-06-05', '22:00:00'),
	(3, '2024-07-05 06:38:02', '2024-07-05 06:38:02', 'Mar i cel', 'https://teatremusical.cat/wp-content/uploads/2016/03/escanear0010.jpg', 15.00, '2024-07-05', '22:00:00');

-- Dumping structure for table softneos_api.event_seats
CREATE TABLE IF NOT EXISTS `event_seats` (
  `id` bigint unsigned NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `seat_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  `seatstatus_id` bigint unsigned NOT NULL,
  `session_id` mediumint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`seat_id`,`event_id`) USING BTREE,
  KEY `event_seats_event_id_foreign` (`event_id`),
  KEY `event_seats_seatstatus_id_foreign` (`seatstatus_id`),
  CONSTRAINT `event_seats_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_seats_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_seats_seatstatus_id_foreign` FOREIGN KEY (`seatstatus_id`) REFERENCES `seatstatus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.event_seats: ~0 rows (approximately)
INSERT INTO `event_seats` (`id`, `created_at`, `updated_at`, `seat_id`, `event_id`, `seatstatus_id`, `session_id`) VALUES
	(2, '2024-07-05 07:49:08.000000', '2024-07-05 12:23:43.000000', 3, 1, 5, 234),
	(3, '2024-07-05 07:50:07.000000', '2024-07-05 12:23:43.000000', 12, 1, 5, 234),
	(4, '2024-07-05 08:01:43.000000', '2024-07-05 12:23:43.000000', 18, 1, 5, 234);

-- Dumping structure for table softneos_api.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table softneos_api.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_07_05_053615_create_events_table', 1),
	(6, '2024_07_05_053756_create_seats_table', 1),
	(7, '2024_07_05_053858_create_event_seats_table', 1),
	(8, '2024_07_05_054203_create_tickets_table', 1),
	(9, '2024_07_05_054339_create_orders_table', 1),
	(10, '2024_07_05_054549_create_order_tickets_table', 1),
	(11, '2024_07_05_055142_create_seat_statuses_table', 1);

-- Dumping structure for table softneos_api.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mail_send` tinyint(1) NOT NULL DEFAULT '0',
  `order_userEmail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `order_userName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.orders: ~1 rows (approximately)
INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `mail_send`, `order_userEmail`, `order_userName`) VALUES
	(5, '2024-07-05 12:23:43', '2024-07-05 12:23:43', 0, 'hotmail@hotmail.com', 'Comprador');

-- Dumping structure for table softneos_api.order_tickets
CREATE TABLE IF NOT EXISTS `order_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` bigint unsigned NOT NULL,
  `ticket_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_tickets_order_id_foreign` (`order_id`),
  KEY `order_tickets_ticket_id_foreign` (`ticket_id`),
  CONSTRAINT `order_tickets_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_tickets_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.order_tickets: ~0 rows (approximately)
INSERT INTO `order_tickets` (`id`, `created_at`, `updated_at`, `order_id`, `ticket_id`) VALUES
	(13, NULL, NULL, 5, 42),
	(14, NULL, NULL, 5, 43),
	(15, NULL, NULL, 5, 44);

-- Dumping structure for table softneos_api.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table softneos_api.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table softneos_api.seats
CREATE TABLE IF NOT EXISTS `seats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seat_col` tinyint NOT NULL,
  `seat_row` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.seats: ~0 rows (approximately)
INSERT INTO `seats` (`id`, `created_at`, `updated_at`, `seat_col`, `seat_row`) VALUES
	(1, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 1),
	(2, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 2),
	(3, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 3),
	(4, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 4),
	(5, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 5),
	(6, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 6),
	(7, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 7),
	(8, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 8),
	(9, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 9),
	(10, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 1, 10),
	(11, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 1),
	(12, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 2),
	(13, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 3),
	(14, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 4),
	(15, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 5),
	(16, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 6),
	(17, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 7),
	(18, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 8),
	(19, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 9),
	(20, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 2, 10),
	(21, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 1),
	(22, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 2),
	(23, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 3),
	(24, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 4),
	(25, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 5),
	(26, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 6),
	(27, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 7),
	(28, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 8),
	(29, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 9),
	(30, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 3, 10),
	(31, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 1),
	(32, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 2),
	(33, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 3),
	(34, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 4),
	(35, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 5),
	(36, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 6),
	(37, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 7),
	(38, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 8),
	(39, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 9),
	(40, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 4, 10),
	(41, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 1),
	(42, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 2),
	(43, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 3),
	(44, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 4),
	(45, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 5),
	(46, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 6),
	(47, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 7),
	(48, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 8),
	(49, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 9),
	(50, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 5, 10),
	(51, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 1),
	(52, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 2),
	(53, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 3),
	(54, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 4),
	(55, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 5),
	(56, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 6),
	(57, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 7),
	(58, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 8),
	(59, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 9),
	(60, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 6, 10),
	(61, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 1),
	(62, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 2),
	(63, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 3),
	(64, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 4),
	(65, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 5),
	(66, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 6),
	(67, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 7),
	(68, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 8),
	(69, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 9),
	(70, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 7, 10),
	(71, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 1),
	(72, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 2),
	(73, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 3),
	(74, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 4),
	(75, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 5),
	(76, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 6),
	(77, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 7),
	(78, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 8),
	(79, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 9),
	(80, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 8, 10),
	(81, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 1),
	(82, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 2),
	(83, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 3),
	(84, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 4),
	(85, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 5),
	(86, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 6),
	(87, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 7),
	(88, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 8),
	(89, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 9),
	(90, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 9, 10),
	(91, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 1),
	(92, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 2),
	(93, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 3),
	(94, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 4),
	(95, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 5),
	(96, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 6),
	(97, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 7),
	(98, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 8),
	(99, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 9),
	(100, '2024-07-05 07:45:56', '2024-07-05 07:45:56', 10, 10);

-- Dumping structure for table softneos_api.seatstatus
CREATE TABLE IF NOT EXISTS `seatstatus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.seatstatus: ~0 rows (approximately)
INSERT INTO `seatstatus` (`id`, `created_at`, `updated_at`, `status_name`, `status_color`) VALUES
	(1, '2024-07-05 07:47:20', '2024-07-05 07:47:20', 'Passadís', 'white'),
	(2, '2024-07-05 07:47:35', '2024-07-05 07:47:34', 'Disponible', 'green'),
	(3, '2024-07-05 07:47:53', '2024-07-05 07:47:52', 'Reservada', 'grey'),
	(4, '2024-07-05 07:48:08', '2024-07-05 07:48:07', 'Assignada', 'yellow'),
	(5, '2024-07-05 07:48:21', '2024-07-05 07:48:22', 'Comprada', 'red');

-- Dumping structure for table softneos_api.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seat_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seat_id` (`seat_id`,`event_id`),
  UNIQUE KEY `seat_id_2` (`seat_id`,`event_id`),
  KEY `tickets_event_id_foreign` (`event_id`),
  CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.tickets: ~0 rows (approximately)
INSERT INTO `tickets` (`id`, `created_at`, `updated_at`, `seat_id`, `event_id`) VALUES
	(42, NULL, NULL, 3, 1),
	(43, NULL, NULL, 12, 1),
	(44, NULL, NULL, 18, 1);

-- Dumping structure for table softneos_api.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table softneos_api.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
