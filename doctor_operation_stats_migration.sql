-- ===================================================
-- Migration: إنشاء جدول doctor_operation_stats
-- شغّله مباشرة في phpMyAdmin أو على السيرفر
-- ===================================================

CREATE TABLE IF NOT EXISTS `doctor_operation_stats` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `doctor_id` BIGINT UNSIGNED NOT NULL,
    `operation_name_id` BIGINT UNSIGNED NOT NULL,
    `classification` VARCHAR(255) NULL DEFAULT NULL,
    `quantity` INT UNSIGNED NOT NULL DEFAULT 0,
    `stat_month` DATE NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `doc_op_month_unique` (`doctor_id`, `operation_name_id`, `stat_month`),
    CONSTRAINT `dos_doctor_fk` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
    CONSTRAINT `dos_opname_fk` FOREIGN KEY (`operation_name_id`) REFERENCES `operation_names` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- أضف سجلاً في جدول migrations
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_04_000001_create_doctor_operation_stats_table', COALESCE(MAX(`batch`), 0) + 1
FROM `migrations`
WHERE NOT EXISTS (
    SELECT 1 FROM `migrations` WHERE `migration` = '2026_07_04_000001_create_doctor_operation_stats_table'
);
