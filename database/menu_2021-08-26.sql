# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.5.9-MariaDB)
# Database: menu
# Generation Time: 2021-08-26 09:07:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table conservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `conservations`;

CREATE TABLE `conservations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `conservations` WRITE;
/*!40000 ALTER TABLE `conservations` DISABLE KEYS */;

INSERT INTO `conservations` (`id`, `name`, `logo`)
VALUES
	(1,'fresco',NULL),
	(2,'surgelato',NULL),
	(3,'congelato',NULL);

/*!40000 ALTER TABLE `conservations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table diet_ingredient
# ------------------------------------------------------------

DROP TABLE IF EXISTS `diet_ingredient`;

CREATE TABLE `diet_ingredient` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `diet_ID` int(11) unsigned NOT NULL,
  `ingredient_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `intollerance_ID` (`diet_ID`),
  KEY `ingredient_ID` (`ingredient_ID`),
  CONSTRAINT `diet_ingredient_ibfk_2` FOREIGN KEY (`ingredient_ID`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `diet_ingredient_ibfk_3` FOREIGN KEY (`diet_ID`) REFERENCES `diets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `diet_ingredient` WRITE;
/*!40000 ALTER TABLE `diet_ingredient` DISABLE KEYS */;

INSERT INTO `diet_ingredient` (`id`, `diet_ID`, `ingredient_ID`)
VALUES
	(83,1,23),
	(84,1,24),
	(85,1,25),
	(86,2,25);

/*!40000 ALTER TABLE `diet_ingredient` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table diets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `diets`;

CREATE TABLE `diets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `diets` WRITE;
/*!40000 ALTER TABLE `diets` DISABLE KEYS */;

INSERT INTO `diets` (`id`, `name`, `logo`, `updated_at`, `created_at`)
VALUES
	(1,'vegetariano','a',NULL,NULL),
	(2,'vegano','b',NULL,NULL);

/*!40000 ALTER TABLE `diets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dishes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dishes`;

CREATE TABLE `dishes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_ID` int(11) unsigned NOT NULL,
  `name` varchar(100) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `availability` tinyint(1) NOT NULL,
  `promo` tinyint(1) NOT NULL,
  `price` double(11,2) DEFAULT NULL,
  `major_price` double(11,2) DEFAULT NULL,
  `take_away` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_ID` (`type_ID`),
  CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`type_ID`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `dishes` WRITE;
/*!40000 ALTER TABLE `dishes` DISABLE KEYS */;

INSERT INTO `dishes` (`id`, `type_ID`, `name`, `description`, `availability`, `promo`, `price`, `major_price`, `take_away`, `created_at`, `updated_at`, `images`, `video`)
VALUES
	(47,7,'frittata',NULL,0,0,NULL,NULL,0,'2021-08-26 08:27:20','2021-08-26 08:27:20','[]',NULL),
	(48,7,'panino con prosciutto',NULL,0,0,NULL,NULL,0,'2021-08-26 08:28:01','2021-08-26 08:28:01','[]',NULL);

/*!40000 ALTER TABLE `dishes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dish_ID` int(11) unsigned NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;

INSERT INTO `images` (`id`, `dish_ID`, `path`, `created_at`, `updated_at`)
VALUES
	(2,0,'endex.jpg|index.jpg',NULL,NULL),
	(3,31,'endex.jpg',NULL,NULL),
	(4,32,'endex.jpg',NULL,NULL),
	(5,33,'endex.jpg|index.jpg',NULL,NULL),
	(6,33,'index.jpg',NULL,NULL),
	(7,33,'index.jpg',NULL,NULL),
	(8,33,'endex.jpg',NULL,NULL),
	(9,33,'endex.jpg|index.jpg',NULL,NULL),
	(10,34,'/private/var/folders/0n/ltvh77c14_jbv2p8cmknm99c0000gp/T/php5utJFf',NULL,NULL),
	(11,35,'endex.jpg|index.jpg',NULL,NULL);

/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ingredient_dish
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ingredient_dish`;

CREATE TABLE `ingredient_dish` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ingredient_ID` int(11) unsigned NOT NULL,
  `dish_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ingredient_ID` (`ingredient_ID`),
  KEY `dish_ID` (`dish_ID`),
  CONSTRAINT `ingredient_dish_ibfk_1` FOREIGN KEY (`ingredient_ID`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingredient_dish_ibfk_2` FOREIGN KEY (`dish_ID`) REFERENCES `dishes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ingredient_dish` WRITE;
/*!40000 ALTER TABLE `ingredient_dish` DISABLE KEYS */;

INSERT INTO `ingredient_dish` (`id`, `ingredient_ID`, `dish_ID`)
VALUES
	(29,23,47),
	(30,25,48),
	(31,26,48);

/*!40000 ALTER TABLE `ingredient_dish` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ingredient_intollerance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ingredient_intollerance`;

CREATE TABLE `ingredient_intollerance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `intollerance_ID` int(11) unsigned NOT NULL,
  `ingredient_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `intollerance_ID` (`intollerance_ID`),
  KEY `ingredient_ID` (`ingredient_ID`),
  CONSTRAINT `ingredient_intollerance_ibfk_1` FOREIGN KEY (`intollerance_ID`) REFERENCES `intollerances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingredient_intollerance_ibfk_2` FOREIGN KEY (`ingredient_ID`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ingredient_intollerance` WRITE;
/*!40000 ALTER TABLE `ingredient_intollerance` DISABLE KEYS */;

INSERT INTO `ingredient_intollerance` (`id`, `intollerance_ID`, `ingredient_ID`)
VALUES
	(8,4,23),
	(9,8,24);

/*!40000 ALTER TABLE `ingredient_intollerance` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ingredients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ingredients`;

CREATE TABLE `ingredients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `availability` tinyint(1) NOT NULL,
  `conservation_ID` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conservation_ID` (`conservation_ID`),
  CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`conservation_ID`) REFERENCES `conservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;

INSERT INTO `ingredients` (`id`, `name`, `availability`, `conservation_ID`, `created_at`, `updated_at`)
VALUES
	(23,'uova',0,1,'2021-08-26 08:25:26','2021-08-26 08:25:26'),
	(24,'latte',0,1,'2021-08-26 08:25:40','2021-08-26 08:25:40'),
	(25,'pane',0,1,'2021-08-26 08:25:57','2021-08-26 08:25:57'),
	(26,'prosciutto',0,1,'2021-08-26 08:27:38','2021-08-26 08:27:38');

/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table intollerances
# ------------------------------------------------------------

DROP TABLE IF EXISTS `intollerances`;

CREATE TABLE `intollerances` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `intollerances` WRITE;
/*!40000 ALTER TABLE `intollerances` DISABLE KEYS */;

INSERT INTO `intollerances` (`id`, `name`, `logo`)
VALUES
	(3,'Cereali contenenti glutine',NULL),
	(4,'Crostacei',NULL),
	(5,'Uova',NULL),
	(6,'Pesce',NULL),
	(7,'Arachidi',NULL),
	(8,'Soia',NULL),
	(9,'Latte e lattosio',NULL),
	(10,'Frutta a guscio',NULL),
	(11,'Sedano',NULL),
	(12,'Senape',NULL),
	(13,'Semi di sesamo',NULL),
	(14,'Anidride solforosa e solfiti',NULL),
	(15,'Lupini',NULL),
	(16,'Molluschi',NULL);

/*!40000 ALTER TABLE `intollerances` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(6,'antipasti',NULL,NULL),
	(7,'primi piatti',NULL,NULL);

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'emanuele','e.cannone@itlike.it',NULL,'$2y$10$CLFOLFw8jdIfGj6KqWIQRO3jrKay3n/2podoVzHN5KFtppt3yyRLK',NULL,'2021-08-24 09:54:31','2021-08-24 09:54:31');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
