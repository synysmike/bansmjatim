-- Run this SQL manually if php artisan migrate fails (e.g. Table 'form_templates' doesn't exist)
-- MySQL / MariaDB. Use database banc9232_laravel (or your .env DB_DATABASE).
-- IMPORTANT: Table name must be exactly form_templates (with letter "p", not form_temlates).

-- USE banc9232_laravel;   -- uncomment and run first if needed

CREATE TABLE IF NOT EXISTS `form_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Form name / identifier',
  `slug` varchar(255) DEFAULT NULL COMMENT 'URL-friendly slug',
  `form_data` json DEFAULT NULL COMMENT 'formBuilder JSON definition',
  `description` text,
  `is_active` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_templates_name_unique` (`name`),
  UNIQUE KEY `form_templates_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- After creating the table by SQL (not by migrate), register the migration so Laravel won't run it again:
INSERT INTO migrations (migration, batch)
SELECT '2026_01_30_000001_create_form_templates_table', COALESCE(MAX(batch), 0) + 1 FROM migrations;
