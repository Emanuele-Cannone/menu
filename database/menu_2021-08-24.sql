-- Create syntax for TABLE 'conservations'
CREATE TABLE `conservations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'diet_ingredient'
CREATE TABLE `diet_ingredient` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `diet_ID` int(11) unsigned NOT NULL,
  `ingredient_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `intollerance_ID` (`diet_ID`),
  KEY `ingredient_ID` (`ingredient_ID`),
  CONSTRAINT `diet_ingredient_ibfk_2` FOREIGN KEY (`ingredient_ID`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `diet_ingredient_ibfk_3` FOREIGN KEY (`diet_ID`) REFERENCES `diets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'diets'
CREATE TABLE `diets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'dishes'
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
  PRIMARY KEY (`id`),
  KEY `type_ID` (`type_ID`),
  CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`type_ID`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'failed_jobs'
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create syntax for TABLE 'images'
CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dish_ID` int(11) unsigned NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `dish_ID` (`dish_ID`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`dish_ID`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'ingredient_dish'
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

-- Create syntax for TABLE 'ingredient_intollerance'
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

-- Create syntax for TABLE 'ingredients'
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'intollerances'
CREATE TABLE `intollerances` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'migrations'
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create syntax for TABLE 'password_resets'
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create syntax for TABLE 'types'
CREATE TABLE `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'users'
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;