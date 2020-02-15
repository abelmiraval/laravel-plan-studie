-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for plan-studies
CREATE DATABASE IF NOT EXISTS `plan-studies` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `plan-studies`;

-- Dumping structure for table plan-studies.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.areas: ~3 rows (approximately)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `code`, `name`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'A01', 'Formación General', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(2, 'A02', 'Formación Específica', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(3, 'A03', 'Formación Especializada', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;

-- Dumping structure for table plan-studies.capacities
CREATE TABLE IF NOT EXISTS `capacities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9488 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.capacities: ~10 rows (approximately)
/*!40000 ALTER TABLE `capacities` DISABLE KEYS */;
INSERT INTO `capacities` (`id`, `code`, `name`, `state`, `created_at`, `updated_at`) VALUES
	(497, '04755500', 'Asumir una visión conservacionista de los recursos naturales y del medio ambiente.', 1, '2019-06-15 03:57:55', '2019-06-15 11:57:08'),
	(3309, '35988311', 'Tessie Runolfsdottir', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(4512, '70871623', 'Mr. Caleb Cartwright III', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(4552, '56322873', 'Ervin Beier Jr.', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(5414, '18716146', 'Brionna Mann', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(6051, '40053363', 'Larissa Daugherty', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(6507, '59767473', 'Karina Wiegand', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(7287, '05916078', 'Anibal Gerhold', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(7773, '31089883', 'Ara O\'Kon', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55'),
	(9487, '40196596', 'Mrs. Shanelle Murray', 1, '2019-06-15 03:57:55', '2019-06-15 03:57:55');
/*!40000 ALTER TABLE `capacities` ENABLE KEYS */;

-- Dumping structure for table plan-studies.capacity_topic
CREATE TABLE IF NOT EXISTS `capacity_topic` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `capacity_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.capacity_topic: ~6 rows (approximately)
/*!40000 ALTER TABLE `capacity_topic` DISABLE KEYS */;
INSERT INTO `capacity_topic` (`id`, `capacity_id`, `topic_id`, `created_at`, `updated_at`) VALUES
	(1, 7287, 1, NULL, NULL),
	(2, 7773, 1, NULL, NULL),
	(3, 7287, 2, NULL, NULL),
	(4, 7773, 2, NULL, NULL),
	(5, 7287, 3, NULL, NULL),
	(6, 7773, 3, NULL, NULL);
/*!40000 ALTER TABLE `capacity_topic` ENABLE KEYS */;

-- Dumping structure for table plan-studies.contents
CREATE TABLE IF NOT EXISTS `contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9773 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.contents: ~10 rows (approximately)
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` (`id`, `code`, `name`, `state`, `created_at`, `updated_at`) VALUES
	(34, '42412670', 'Jarred Legros IV', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(2320, '69566776', 'Miss Daisha Hill', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(2650, '52574146', 'Marcos Balistreri', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(3952, '87793826', 'Ms. Jayda Schroeder', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(4914, '08652713', 'Kira McKenzie', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(5583, '37172305', 'Ellsworth Wuckert', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(6934, '59688396', 'Anya Runolfsdottir', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(8253, '60979551', 'Onie Kris', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(9730, '35174905', 'Alayna Klein', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(9772, '76578649', 'Darby Lebsack', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;

-- Dumping structure for table plan-studies.content_topic
CREATE TABLE IF NOT EXISTS `content_topic` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.content_topic: ~0 rows (approximately)
/*!40000 ALTER TABLE `content_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_topic` ENABLE KEYS */;

-- Dumping structure for table plan-studies.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `nature_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `main_objective` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_objective` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theoretical_hours` int(11) NOT NULL,
  `practical_hours` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.courses: ~5 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `code`, `name`, `area_id`, `nature_id`, `term_id`, `main_objective`, `secondary_objective`, `theoretical_hours`, `practical_hours`, `credits`, `level`, `created_at`, `updated_at`) VALUES
	(1, 'asda', 'sdsadas', 2, 1, 1, 'dasdas', 'dasdas', 2, 2, 2, '2das-d', '2019-06-15 04:07:46', '2019-06-15 04:07:46'),
	(2, 'dsadsa', '21dasda', 2, 3, 1, 'dasdas', 'dasdas', 2, 3, 45, '1222-2', '2019-06-15 04:08:58', '2019-06-15 04:08:58'),
	(3, 'Soy primario', 'Soy primario', 2, 1, 1, 'fsafds', 'sfdafas', 2, 22, 3, '3sd', '2019-06-15 04:11:29', '2019-06-15 13:39:28'),
	(4, '02', 'Curso que tiene requerimient', 1, 1, 1, 'sdfsd', 'sfdsf', 2, 2, 2, '3', '2019-06-15 13:41:21', '2019-06-16 01:16:58'),
	(5, 'asdas', 'dasdas', 1, 3, 1, 'dasda', 'dasdas', 2, 1, 1, '11', '2019-06-16 00:14:48', '2019-06-16 00:14:48');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Dumping structure for table plan-studies.course_topic
CREATE TABLE IF NOT EXISTS `course_topic` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.course_topic: ~4 rows (approximately)
/*!40000 ALTER TABLE `course_topic` DISABLE KEYS */;
INSERT INTO `course_topic` (`id`, `course_id`, `topic_id`, `created_at`, `updated_at`) VALUES
	(9, 5, 1, NULL, NULL),
	(14, 5, 3, NULL, NULL),
	(15, 5, 2, NULL, NULL),
	(17, 4, 3, NULL, NULL);
/*!40000 ALTER TABLE `course_topic` ENABLE KEYS */;

-- Dumping structure for table plan-studies.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.migrations: ~15 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_03_17_182721_create_capacities_table', 1),
	(4, '2019_03_17_182744_create_contents_table', 1),
	(5, '2019_03_17_182801_create_topics_table', 1),
	(6, '2019_03_17_193118_create_capacity_topic_table', 1),
	(7, '2019_03_20_124326_create_content_topic_table', 1),
	(8, '2019_03_21_012838_create_areas_table', 1),
	(9, '2019_03_21_013051_create_natures_table', 1),
	(10, '2019_03_22_145210_create_terms_table', 1),
	(11, '2019_03_22_174214_create_courses_table', 1),
	(12, '2019_05_04_050351_create_requeriment_course_table', 1),
	(13, '2019_05_04_153732_create_course_topic_table', 1),
	(14, '2019_05_05_193439_create_plans_table', 1),
	(15, '2019_06_15_031412_add_content_to_topics', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table plan-studies.natures
CREATE TABLE IF NOT EXISTS `natures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.natures: ~3 rows (approximately)
/*!40000 ALTER TABLE `natures` DISABLE KEYS */;
INSERT INTO `natures` (`id`, `code`, `name`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'N01', 'Téorico', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(2, 'N02', 'Práctico', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(3, 'N03', 'Téorico-Práctico', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56');
/*!40000 ALTER TABLE `natures` ENABLE KEYS */;

-- Dumping structure for table plan-studies.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table plan-studies.plans
CREATE TABLE IF NOT EXISTS `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `number_times` int(10) unsigned NOT NULL,
  `curriculum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.plans: ~5 rows (approximately)
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` (`id`, `course_id`, `number_times`, `curriculum`, `created_at`, `updated_at`) VALUES
	(1, 1, 0, '2das-d', '2019-06-15 04:07:46', '2019-06-15 04:07:46'),
	(2, 2, 0, '1222-2', '2019-06-15 04:08:59', '2019-06-15 04:08:59'),
	(3, 3, 0, '3sd', '2019-06-15 04:11:30', '2019-06-15 04:11:30'),
	(4, 4, 0, '3', '2019-06-15 13:41:21', '2019-06-15 13:41:21'),
	(5, 5, 0, '11', '2019-06-16 00:14:48', '2019-06-16 00:14:48');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;

-- Dumping structure for table plan-studies.requeriment_course
CREATE TABLE IF NOT EXISTS `requeriment_course` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `course_id_requeriment` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.requeriment_course: ~1 rows (approximately)
/*!40000 ALTER TABLE `requeriment_course` DISABLE KEYS */;
INSERT INTO `requeriment_course` (`id`, `course_id`, `course_id_requeriment`, `created_at`, `updated_at`) VALUES
	(2, 3, 1, '2019-06-15 13:35:03', '2019-06-15 13:35:03');
/*!40000 ALTER TABLE `requeriment_course` ENABLE KEYS */;

-- Dumping structure for table plan-studies.terms
CREATE TABLE IF NOT EXISTS `terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.terms: ~2 rows (approximately)
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` (`id`, `code`, `name`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'T01', 'Obligatorio', 1, '2019-06-15 03:57:56', '2019-06-15 03:57:56'),
	(2, 'T02', 'Electivo', 1, '2019-06-15 03:57:57', '2019-06-15 03:57:57');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;

-- Dumping structure for table plan-studies.topics
CREATE TABLE IF NOT EXISTS `topics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `knowledge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specific` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.topics: ~3 rows (approximately)
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`id`, `code`, `name`, `knowledge`, `specific`, `content`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'dsad', 'adas', 'abel', 'asdas', 'abel sauldsffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 1, '2019-06-15 04:03:02', '2019-06-15 04:03:20'),
	(2, 'asdas', 'dasdas', 'dasda', 'dasdas', 'dadas', 1, '2019-06-16 00:13:54', '2019-06-16 00:13:54'),
	(3, 'nuevo', 'tema', 'sdf', 'sdfa', 'sdafs', 1, '2019-06-16 00:19:44', '2019-06-16 00:19:44');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;

-- Dumping structure for table plan-studies.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plan-studies.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
