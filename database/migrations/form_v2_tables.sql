-- Form V2 tables (run if php artisan migrate is not used)
-- Database: same as your app (e.g. banc9232_laravel)

CREATE TABLE IF NOT EXISTS `form_field_definitions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_field` varchar(100) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `label` varchar(255) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `options` json DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_field_definitions_nama_field_unique` (`nama_field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `form_v2_config` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `field_names` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_v2_config_link_unique` (`link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `form_v2_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `payload` json NOT NULL,
  `signature_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_v2_submissions_link_index` (`link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
