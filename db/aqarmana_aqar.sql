-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- مضيف: localhost:3306
-- وقت الجيل: 10 ديسمبر 2025 الساعة 16:52
-- إصدار الخادم: 11.4.9-MariaDB
-- نسخة PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- قاعدة بيانات: `aqarmana_aqar`
--

-- --------------------------------------------------------

--
-- بنية الجدول `all_files`
--

CREATE TABLE `all_files` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `object_id` int(11) NOT NULL,
  `object_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `route` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `position` int(11) NOT NULL,
  `display` int(1) NOT NULL,
  `icon` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `apps`
--

INSERT INTO `apps` (`id`, `parent_id`, `name`, `route`, `action`, `position`, `display`, `icon`, `created_by`, `created_at`) VALUES
(1, 0, 'centers', 'route.page', 'action function', 1, 1, 1, 1, '2025-07-11 17:49:20');

-- --------------------------------------------------------

--
-- بنية الجدول `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admin@gmail.comad|127.0.0.1', 'i:1;', 1752777418),
('laravel_cache_admin@gmail.comad|127.0.0.1:timer', 'i:1752777418;', 1752777418);

-- --------------------------------------------------------

--
-- بنية الجدول `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `centers`
--

CREATE TABLE `centers` (
  `id` int(11) NOT NULL,
  `maincenter_id` int(11) NOT NULL,
  `center_name` text NOT NULL,
  `center_location` int(11) NOT NULL,
  `woter_no` varchar(100) DEFAULT NULL,
  `electric_no` text DEFAULT NULL,
  `left_electric_no` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `gps` text DEFAULT NULL,
  `hainame` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `Building_no` int(11) DEFAULT NULL,
  `sak_no` varchar(30) DEFAULT NULL,
  `othercontents` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `centers`
--

INSERT INTO `centers` (`id`, `maincenter_id`, `center_name`, `center_location`, `woter_no`, `electric_no`, `left_electric_no`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `notes`, `gps`, `hainame`, `street`, `Building_no`, `sak_no`, `othercontents`) VALUES
(2, 1, 'عمارة عبدالله خياط', 1, '0529611111', '30124160284', 'بدون', '2025-12-05 16:43:12', '2025-12-08 16:20:51', 1, 1, '', 'مؤجرة بالكامل شقق سكنية عوائل + محلات تجارية', NULL, 'العزيزية', 'شارع عبدالله خياط', 4325, '15', '2,3,4'),
(3, 2, 'عمارة الرباط - العزيزية', 1, '4454611111', NULL, NULL, '2025-12-08 15:46:10', '2025-12-08 15:50:04', 1, 1, '', 'العمارة مؤجرة بالكامل للمستثمر  ( محمد سليم ) 053031409 - 0540252012', NULL, 'حي الجامعة', 'شارع الملك خالد', 3516, '820120011408', '4'),
(4, 2, 'عمارة الروضة', 1, NULL, NULL, NULL, '2025-12-08 15:55:56', '2025-12-08 15:55:56', 1, NULL, '', 'غير مؤجره', NULL, 'الروضة', 'شارع المسجد الحرام', 7363, '922001000870', '3,4'),
(5, 1, 'عمارة العزيزية', 1, '4898611111', '30048665020', '30048659551', '2025-12-08 16:17:07', '2025-12-08 18:53:39', 1, 1, '', 'مؤجرة شقق سكنية عوائل', NULL, 'حي العزيزية', 'العزيزية العام - خلف فاين لوك للملابس الجاهزة', NULL, '820121014132', '2,4'),
(6, 1, 'عمارة الزاهر', 1, '0127444444', '30048664069', '30048664078', '2025-12-08 16:24:51', '2025-12-08 16:24:51', 1, NULL, '', 'مؤجرة بالكامل شقق سكنية عوائل  + محلات تجارية', NULL, 'حي العتيبية ( الزاهر )', 'العمرة', 34, '922', '2,3,4'),
(7, 3, 'عمارة مخطط البنك', 1, '0844711111', NULL, NULL, '2025-12-08 16:40:15', '2025-12-08 16:40:15', 1, NULL, 'uploads/e444f4bd-7dcc-4d91-99ea-fd6f6c9ee732.jpg', 'مؤجرة بالكامل لشركة', NULL, 'الجامعة  ( مخطط البنك )', 'حذيفة بن أسيد الغفـاري ( رضي الله عنه )', 4183, '320110009090', '2,3,4'),
(8, 4, 'عمارة بن عشان', 1, '3211531492', NULL, NULL, '2025-12-08 17:04:06', '2025-12-08 17:04:06', 1, NULL, '', 'العمارة مؤجرة بالكامل ع مستثمر', NULL, 'النسيم', 'شريح بن الحارث', 6936, '422001001942', '2,4'),
(9, 1, 'عمارة الخنساء', 1, '6553711111', NULL, NULL, '2025-12-08 17:09:11', '2025-12-08 17:09:11', 1, NULL, '', 'مؤجر منها المحلات التجارية فقط', NULL, 'الخنساء', NULL, NULL, '620121014134', '3'),
(10, 5, 'عمارة السليمانية', 2, NULL, NULL, NULL, '2025-12-08 18:39:48', '2025-12-08 18:39:48', 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 6, 'أرض', 2, NULL, NULL, NULL, '2025-12-08 18:43:16', '2025-12-08 18:43:16', 1, NULL, '', 'أرض فضاء', NULL, 'البغدادية', 'شارع حائـل', NULL, NULL, NULL),
(12, 1, 'أرض عمارة العزيزية', 1, NULL, NULL, NULL, '2025-12-08 19:04:47', '2025-12-08 19:04:47', 1, NULL, '', 'أرض فضاء ملاصقة للمبنى الرئيسي', NULL, 'العزيزية', 'العزيزية العام خلف فاين لوك', NULL, '820121014132', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `start_dateh` text DEFAULT NULL,
  `end_dateh` text DEFAULT NULL,
  `no_of_payments` int(11) NOT NULL,
  `year_amount` int(11) DEFAULT NULL,
  `services_amount` int(11) DEFAULT 0,
  `insurance_amount` int(11) DEFAULT 0,
  `center_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `renter_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1- فعال - 2 منتهي - 3 تم فسخه ',
  `maincenter_id` int(11) DEFAULT 1,
  `period_year` int(11) DEFAULT NULL,
  `period_month` int(11) DEFAULT NULL,
  `e_no` varchar(20) DEFAULT NULL COMMENT 'رقم العقد الالكتروني',
  `period_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contracts`
--

INSERT INTO `contracts` (`id`, `start_date`, `end_date`, `start_dateh`, `end_dateh`, `no_of_payments`, `year_amount`, `services_amount`, `insurance_amount`, `center_id`, `unit_id`, `renter_id`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `is_active`, `maincenter_id`, `period_year`, `period_month`, `e_no`, `period_day`) VALUES
(1, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 22000, 650, 0, 2, 2, 3, NULL, '2025-12-05 17:37:53', '2025-12-05 17:37:53', 1, NULL, '', 1, 1, 1, 0, NULL, 0),
(2, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 22000, 650, 0, 2, 3, 9, NULL, '2025-12-05 17:57:40', '2025-12-05 17:57:40', 1, NULL, '', 1, 1, 1, 0, '123654', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_no` text DEFAULT NULL,
  `nationality` int(3) DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `iban` varchar(22) DEFAULT NULL,
  `job` varchar(200) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `birthday` varchar(10) DEFAULT NULL,
  `birthdayh` varchar(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `emp_type` int(11) DEFAULT 1,
  `emp_status` int(11) DEFAULT 1,
  `join_date` varchar(10) DEFAULT NULL,
  `join_dateh` varchar(10) DEFAULT NULL,
  `maincenter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `employees`
--

INSERT INTO `employees` (`id`, `name`, `id_no`, `nationality`, `mobile_no`, `iban`, `job`, `center_id`, `salary`, `birthday`, `birthdayh`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `emp_type`, `emp_status`, `join_date`, `join_dateh`, `maincenter_id`) VALUES
(1, 'وائل شيخ', '1006096398', 121, '0509700028', '5920000001781448129940', 'المدير التنفيذي', NULL, 2000, '31/10/1975', '26/10/1395', NULL, '2025-11-28 14:06:27', '2025-12-08 18:33:07', 1, 1, 'uploads/3cdcc7c9-aac9-4333-8d3d-5daa6fdaffef.pdf', 1, 1, NULL, NULL, NULL),
(2, 'خالد دوست', '2034091815', 109, '0553577135', '4380000201608016200625', 'حارس عقار', 2, 1200, '1988/01/22', '1408/06/03', NULL, '2025-12-05 18:28:15', '2025-12-08 18:44:14', 1, 1, 'uploads/5a869c3f-1020-40da-8a27-c6f9c613c4e0.jpg', 1, 1, NULL, NULL, 1),
(3, 'عدنان بكر شيخ', '1006528242', 121, '0563880000', NULL, 'المدير العام', NULL, 50000, NULL, NULL, NULL, '2025-12-08 17:19:11', '2025-12-08 17:23:49', 1, 1, 'uploads/c1c293f6-9b4f-4ae5-83e4-e51f9019adbf.jpg', 1, NULL, NULL, NULL, NULL),
(4, 'محمد سبحان شيخ أمتياز أحمد', '2429934009', 65, '0571244998 - 0537393815', '8180000458608016060409', 'حارس عقار', 6, 1500, '1978-01-01', '1398-01-22', NULL, '2025-12-08 18:21:48', '2025-12-08 18:21:48', 1, NULL, 'uploads/519dc6fc-a1c8-4e71-8a99-cad9939e425f.jpg', 1, 1, NULL, NULL, 1),
(5, 'عبد الأمين دوست محمد', '2016514578', 109, '0500097301 - 0593131880 - 0582057932', NULL, 'حارس عقار', 5, 1200, '1978-01-01', '1398-01-22', NULL, '2025-12-08 18:38:13', '2025-12-08 18:38:13', 1, NULL, 'uploads/99057bb0-4721-47de-a06f-09d7124cafad.jpg', 1, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `emp_periods`
--

CREATE TABLE `emp_periods` (
  `id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `start_dateh` text NOT NULL,
  `end_dateh` text NOT NULL,
  `emp_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `emp_statuss`
--

CREATE TABLE `emp_statuss` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `emp_statuss`
--

INSERT INTO `emp_statuss` (`id`, `name`, `description`) VALUES
(1, 'على رأس العمل', NULL),
(2, 'اجازة', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `emp_types`
--

CREATE TABLE `emp_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `emp_types`
--

INSERT INTO `emp_types` (`id`, `name`, `description`) VALUES
(1, 'دائم', NULL),
(2, 'مؤقت', NULL),
(3, 'موسمي', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `id_types`
--

CREATE TABLE `id_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `id_types`
--

INSERT INTO `id_types` (`id`, `name`, `description`) VALUES
(1, 'هوية وطنية', NULL),
(2, 'هوية مقيم', NULL),
(3, 'جواز سفر', NULL),
(4, 'سجل تجاري', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `filesize` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'مكة المكرمة'),
(2, 'جدة');

-- --------------------------------------------------------

--
-- بنية الجدول `maincenters`
--

CREATE TABLE `maincenters` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `maincenters`
--

INSERT INTO `maincenters` (`id`, `name`, `iban`, `emp_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `notes`) VALUES
(1, 'وصية ابراهيم صدقي', 'SA', 1, '2025-12-05 06:34:22', '2025-12-05 06:34:22', 1, NULL, '', NULL),
(2, 'وقف ابراهيم صدقي الرباط', 'SA', 1, '2025-12-05 06:35:13', '2025-12-05 06:35:13', 1, NULL, '', NULL),
(3, 'وقف ابراهيم صدقي ( حارة الباب )', '5720000001022337809940', 1, '2025-12-08 16:28:09', '2025-12-08 16:28:09', 1, NULL, '', NULL),
(4, 'وقف محمد بن عبـداللـه بن عشان', '6820000001022501949941', 1, '2025-12-08 16:51:40', '2025-12-08 19:00:26', 1, 1, 'uploads/06fae469-c03d-4684-be4e-85a2d7ca5881.heic', 'العمارة مؤجرة بالكامل للمستثمر'),
(5, 'وقف السليمانية', NULL, 3, '2025-12-08 18:39:17', '2025-12-08 18:41:03', 1, 1, '', NULL),
(6, 'وقف ابراهيم صدقي ( جدة )', NULL, 3, '2025-12-08 18:41:33', '2025-12-08 18:41:33', 1, NULL, '', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_28_091923_create_permission_tables', 1),
(5, '2025_06_28_093248_create_products_table', 2),
(6, '2025_06_28_102223_create_images_table', 3);

-- --------------------------------------------------------

--
-- بنية الجدول `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `nationalities`
--

INSERT INTO `nationalities` (`id`, `name`) VALUES
(1, 'أفغاني'),
(2, 'ألباني'),
(3, 'جزائري'),
(4, 'أمريكي'),
(5, 'أندوري'),
(6, 'أنغولي'),
(7, 'أرجنتيني'),
(8, 'أرميني'),
(9, 'أسترالي'),
(10, 'نمساوي'),
(11, 'أذربيجاني'),
(12, 'باهامي'),
(13, 'بحريني'),
(14, 'بنغلاديشي'),
(15, 'باربادي'),
(16, 'بلجيكي'),
(17, 'بيلاروسي'),
(18, 'بليزي'),
(19, 'بنيني'),
(20, 'بوتاني'),
(21, 'بوليفي'),
(22, 'بوسني'),
(23, 'برازيلي'),
(24, 'بريطاني'),
(25, 'بلغاري'),
(26, 'بوركيني'),
(27, 'بوروندي'),
(28, 'كمبودي'),
(29, 'كاميروني'),
(30, 'كندي'),
(31, 'تشادي'),
(32, 'تشيلي'),
(33, 'صيني'),
(34, 'كولومبي'),
(35, 'كوموري'),
(36, 'كونغولي'),
(37, 'كوستاريكي'),
(38, 'كرواتي'),
(39, 'كوبي'),
(40, 'قبرصي'),
(41, 'تشيكي'),
(42, 'دنماركي'),
(43, 'جيبوتي'),
(44, 'دومينيكاني'),
(45, 'مصري'),
(46, 'سلفادوري'),
(47, 'إكوادوري'),
(48, 'إرتيري'),
(49, 'إستوني'),
(50, 'إثيوبي'),
(51, 'فنلندي'),
(52, 'فرنسي'),
(53, 'غابوني'),
(54, 'غامبي'),
(55, 'جورجي'),
(56, 'ألماني'),
(57, 'غاني'),
(58, 'يوناني'),
(59, 'غواتيمالي'),
(60, 'غيني'),
(61, 'هايتي'),
(62, 'هندوراسي'),
(63, 'هنغاري'),
(64, 'آيسلندي'),
(65, 'هندي'),
(66, 'إندونيسي'),
(67, 'إيراني'),
(68, 'عراقي'),
(69, 'إيرلندي'),
(70, 'إسرائيلي'),
(71, 'إيطالي'),
(72, 'ساحل العاجي'),
(73, 'جامايكي'),
(74, 'ياباني'),
(75, 'أردني'),
(76, 'كازاخستاني'),
(77, 'كيني'),
(78, 'كويتي'),
(79, 'قيرغيزي'),
(80, 'لاوسي'),
(81, 'لاتفي'),
(82, 'لبناني'),
(83, 'ليبيري'),
(84, 'ليبي'),
(85, 'ليتواني'),
(86, 'لوكسمبورغي'),
(87, 'مدغشقري'),
(88, 'مالاوي'),
(89, 'ماليزي'),
(90, 'مالي'),
(91, 'مالطي'),
(92, 'موريتاني'),
(93, 'موريشيوسي'),
(94, 'مكسيكي'),
(95, 'مولدوفي'),
(96, 'موناكي'),
(97, 'منغولي'),
(98, 'مغربي'),
(99, 'موزمبيقي'),
(100, 'ميانماري'),
(101, 'ناميبي'),
(102, 'نيبالي'),
(103, 'هولندي'),
(104, 'نيوزيلندي'),
(105, 'نيجيري'),
(106, 'نيكاراغوي'),
(107, 'نرويجي'),
(108, 'عماني'),
(109, 'باكستاني'),
(110, 'فلسطيني'),
(111, 'بنمي'),
(112, 'باراغواي'),
(113, 'بيروفي'),
(114, 'فلبيني'),
(115, 'بولندي'),
(116, 'برتغالي'),
(117, 'قطري'),
(118, 'روماني'),
(119, 'روسي'),
(120, 'رواندي'),
(121, 'سعودي'),
(122, 'سنغالي'),
(123, 'صربي'),
(124, 'سنغافوري'),
(125, 'سلوفاكي'),
(126, 'سلوفيني'),
(127, 'صومالي'),
(128, 'جنوب أفريقي'),
(129, 'إسباني'),
(130, 'سوداني'),
(131, 'سوري'),
(132, 'سويدي'),
(133, 'سويسري'),
(134, 'تايواني'),
(135, 'طاجيكي'),
(136, 'تنزاني'),
(137, 'تايلاندي'),
(138, 'تونسي'),
(139, 'تركي'),
(140, 'تركماني'),
(141, 'أوغندي'),
(142, 'أوكراني'),
(143, 'إماراتي'),
(144, 'بريطاني'),
(145, 'أوزبكي'),
(146, 'فنزويلي'),
(147, 'فيتنامي'),
(148, 'يمني'),
(149, 'زامبي'),
(150, 'زيمبابوي');

-- --------------------------------------------------------

--
-- بنية الجدول `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `notes_files`
--

CREATE TABLE `notes_files` (
  `id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` text DEFAULT NULL,
  `element_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`, `updated_at`, `url`, `element_id`) VALUES
(1, 1, 'تم صرف مبلغ : 5000', 0, '2025-12-05 10:43:32', '2025-12-05 10:43:32', 'sarfs.show', 1),
(2, 5, 'تم صرف مبلغ : 5000', 0, '2025-12-05 10:43:32', '2025-12-05 10:43:32', 'sarfs.show', 1),
(3, 1, 'تم صرف مبلغ : 1000', 0, '2025-12-05 10:46:38', '2025-12-05 10:46:38', 'sarfs.show', 2),
(4, 5, 'تم صرف مبلغ : 1000', 0, '2025-12-05 10:46:38', '2025-12-05 10:46:38', 'sarfs.show', 2),
(5, 1, 'تم تحرير عقد جديد ', 0, '2025-12-05 17:37:53', '2025-12-05 17:37:53', 'contracts.show', 1),
(6, 5, 'تم تحرير عقد جديد ', 0, '2025-12-05 17:37:53', '2025-12-05 17:37:53', 'contracts.show', 1),
(7, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-05 17:40:45', '2025-12-05 17:40:45', 'payments.show', 1),
(8, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-05 17:40:45', '2025-12-05 17:40:45', 'payments.show', 1),
(9, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-05 17:44:31', '2025-12-05 17:44:31', 'payments.show', 2),
(10, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-05 17:44:31', '2025-12-05 17:44:31', 'payments.show', 2),
(11, 1, 'تم تحرير عقد جديد ', 0, '2025-12-05 17:57:40', '2025-12-05 17:57:40', 'contracts.show', 2),
(12, 5, 'تم تحرير عقد جديد ', 0, '2025-12-05 17:57:40', '2025-12-05 17:57:40', 'contracts.show', 2),
(13, 1, 'تم صرف مبلغ : 5000', 0, '2025-12-05 18:18:14', '2025-12-05 18:18:14', 'sarfs.show', 1),
(14, 5, 'تم صرف مبلغ : 5000', 0, '2025-12-05 18:18:14', '2025-12-05 18:18:14', 'sarfs.show', 1),
(15, 1, 'تم صرف مبلغ : 550', 0, '2025-12-05 18:23:44', '2025-12-05 18:23:44', 'sarfs.show', 2),
(16, 5, 'تم صرف مبلغ : 550', 0, '2025-12-05 18:23:44', '2025-12-05 18:23:44', 'sarfs.show', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `ohdas`
--

CREATE TABLE `ohdas` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `raseed` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `maincenter_id` int(11) DEFAULT NULL,
  `masder` varchar(200) DEFAULT NULL,
  `esm_elmohawel` varchar(200) DEFAULT NULL,
  `t_date` date DEFAULT NULL,
  `tdateh` varchar(10) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `hewala_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ohdas`
--

INSERT INTO `ohdas` (`id`, `emp_id`, `purpose`, `raseed`, `created_at`, `updated_at`, `center_id`, `maincenter_id`, `masder`, `esm_elmohawel`, `t_date`, `tdateh`, `payment_type`, `hewala_no`) VALUES
(1, 1, 'عهدة وصية ابراهيم صدقي', 24450, '2025-12-05 18:04:56', '2025-12-05 18:23:44', NULL, 1, 'تحويل بنكي', 'عدنان شيخ', '2025-12-05', '1389/10/23', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `ohdas_operations`
--

CREATE TABLE `ohdas_operations` (
  `id` int(11) NOT NULL,
  `ohda_id` int(11) NOT NULL,
  `op_type` varchar(1) NOT NULL,
  `sarf_id` int(11) DEFAULT NULL,
  `amount` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_amount` int(11) DEFAULT NULL,
  `masder` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ohdas_operations`
--

INSERT INTO `ohdas_operations` (`id`, `ohda_id`, `op_type`, `sarf_id`, `amount`, `created_at`, `updated_at`, `last_amount`, `masder`) VALUES
(1, 1, '+', 1, 5000, '2025-12-05 18:18:14', '2025-12-05 18:18:14', 20000, 'مبلغ عهدة اضافي - تعزيز مبلغ العهدة'),
(2, 1, '-', 2, 550, '2025-12-05 18:23:44', '2025-12-05 18:23:44', 25000, 'فاتورة مياه شهر نوفمبر');

-- --------------------------------------------------------

--
-- بنية الجدول `othercontents`
--

CREATE TABLE `othercontents` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `othercontents`
--

INSERT INTO `othercontents` (`id`, `name`) VALUES
(1, 'ملحق'),
(2, 'بدرون'),
(3, 'محلات تجارية'),
(4, 'مصعد');

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fathylogic@hotmail.com', '$2y$12$ToaNK7h5wixjxlrsUQSrqO0e4sg7O65rMFYRFyfOgDSIUuFV4ffl2', '2025-06-28 07:10:45');

-- --------------------------------------------------------

--
-- بنية الجدول `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `p_date` varchar(10) NOT NULL,
  `p_dateh` varchar(10) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `amount_txt` text DEFAULT NULL,
  `payment_no` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `year_m` varchar(4) DEFAULT NULL,
  `year_h` varchar(4) DEFAULT NULL,
  `sereal` int(11) DEFAULT NULL,
  `actual_date` varchar(10) DEFAULT NULL,
  `actual_dateh` varchar(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `is_for_sale_product` tinyint(1) DEFAULT 0,
  `product_desc` text DEFAULT NULL,
  `maincenter_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `remender_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payments`
--

INSERT INTO `payments` (`id`, `contract_id`, `p_date`, `p_dateh`, `amount`, `amount_txt`, `payment_no`, `emp_id`, `payment_type`, `status`, `year_m`, `year_h`, `sereal`, `actual_date`, `actual_dateh`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `is_for_sale_product`, `product_desc`, `maincenter_id`, `center_id`, `unit_id`, `remender_amount`) VALUES
(1, 1, '2025-07-01', '1447/01/06', 650, 'فقط ستمائة وخمسون ريالاً لاغير', 0, NULL, 2, 1, '', '', 1, NULL, NULL, 'الخدمات', '2025-12-05 17:37:53', '2025-12-05 17:40:45', 1, 1, NULL, 0, NULL, 1, 2, 2, 0),
(2, 1, '2025-07-01', '1447/01/06', 11000, 'فقط احد عشر ألف ريال لاغير', 1, NULL, 5, 1, '25', '47', 1, '2025-07-01', '1447-01-06', NULL, '2025-12-05 17:37:53', '2025-12-05 17:44:31', 1, 1, NULL, 0, NULL, 1, 2, 2, 0),
(3, 1, '2025/12/30', '1447/07/10', 11000, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-12-05 17:37:53', '2025-12-05 17:37:53', 1, NULL, NULL, 0, NULL, 1, 2, 2, NULL),
(4, 2, '2025-07-01', '1447/01/06', 650, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, ' الخدمات  ', '2025-12-05 17:57:40', '2025-12-05 17:57:40', 1, NULL, NULL, 0, NULL, 1, 2, 3, NULL),
(5, 2, '2025-07-01', '1447/01/06', 11000, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-12-05 17:57:40', '2025-12-05 17:57:40', 1, NULL, NULL, 0, NULL, 1, 2, 3, NULL),
(6, 2, '2025/12/30', '1447/07/10', 11000, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-12-05 17:57:40', '2025-12-05 17:57:40', 1, NULL, NULL, 0, NULL, 1, 2, 3, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `description`) VALUES
(1, 'كاش', NULL),
(2, 'تحويل بنكي', NULL),
(3, 'شيك', NULL),
(4, 'بطاقة بنكية', NULL),
(5, 'سداد منصة ايجار', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `salary_year_month` varchar(7) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `other_allowance` int(11) DEFAULT 0,
  `deductions` int(11) DEFAULT 0,
  `other_allowance_purpose` text DEFAULT NULL,
  `deductions_purpose` text DEFAULT NULL,
  `net_salary` int(11) DEFAULT NULL,
  `net_salary_txt` varchar(200) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0,
  `p_date` varchar(10) DEFAULT NULL,
  `p_dateh` varchar(10) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(2, 'role-create', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(3, 'role-edit', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(4, 'role-delete', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(5, 'product-list', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(6, 'product-create', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(7, 'product-edit', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(8, 'product-delete', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'تجربة', 'test test', '2025-06-28 06:58:50', '2025-06-28 06:58:50');

-- --------------------------------------------------------

--
-- بنية الجدول `recipients`
--

CREATE TABLE `recipients` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `r_type` text DEFAULT NULL,
  `r_address` text DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `iban` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `id_no` text DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `nationality` int(3) DEFAULT NULL,
  `other_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `renters`
--

CREATE TABLE `renters` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_no` text DEFAULT NULL,
  `nationality` int(3) DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `employer` text DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `other_no` varchar(20) DEFAULT NULL,
  `work_no` varchar(20) DEFAULT NULL,
  `work_letter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `renters`
--

INSERT INTO `renters` (`id`, `name`, `id_no`, `nationality`, `mobile_no`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `employer`, `id_type`, `other_no`, `work_no`, `work_letter`) VALUES
(2, 'شركة ديار التميز', '2258867320', 148, '0550633111', NULL, '2025-12-05 15:01:56', '2025-12-05 15:13:51', 1, 1, 'uploads/5644b349-67be-44f5-9deb-830c0a5e6bcc.pdf', NULL, 2, '0555076871', NULL, ''),
(4, 'مصطفى عزمي يحي القندح', '2147452276', 131, '0503701837', NULL, '2025-12-05 15:05:49', '2025-12-05 15:05:49', 1, NULL, 'uploads/086a691e-63f2-476c-91d6-caa2e323743a.jpg', NULL, 2, NULL, NULL, ''),
(5, 'هزاع سعد مطهر المسوري', '2443651084', 148, '0555419287', NULL, '2025-12-05 15:07:28', '2025-12-05 15:07:28', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(6, 'هانــي صــادق بجـــاش', '2258867320', 148, '0550633111', NULL, '2025-12-05 15:09:25', '2025-12-05 15:09:25', 1, NULL, 'uploads/2c94f5b2-4268-4b0d-a5a8-20cf26ca7d9a.pdf', 'شركة ديار التميز لمواد البناء - شريك', 2, NULL, NULL, ''),
(7, 'عبدربــه محمد أحمد الفقيـر المصعبي', '2175659339', 148, '0508232735', NULL, '2025-12-05 15:11:40', '2025-12-05 15:11:40', 1, NULL, '', NULL, 2, '0574759812', NULL, ''),
(8, 'علوي بن عبدالله مبارك اليـامي', '1134454204', 121, '0530282675', NULL, '2025-12-05 15:26:10', '2025-12-05 15:26:10', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(9, 'نزيــه عبدالقادر وحيد نسريني', '2013666801', 131, '0505512559', NULL, '2025-12-05 15:27:02', '2025-12-05 15:27:02', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(10, 'غلام صابررنـا محمد يعقوب رنـا', '2004911109', 109, '0504771347', NULL, '2025-12-05 15:32:29', '2025-12-05 15:32:29', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(11, 'محمد حسيـن حيـانـي', '2017588860', 131, '0501610765', 'طبيب', '2025-12-05 15:34:10', '2025-12-05 15:34:10', 1, NULL, '', NULL, 2, '0555572609', NULL, ''),
(12, 'أحمد علي أمين عبدالله', '2414189296', 45, '0541896396', 'صيدلي', '2025-12-05 15:35:29', '2025-12-05 15:35:29', 1, NULL, '', 'صيدليات النهدي', 2, NULL, NULL, ''),
(13, 'مجـدي محمـد القـــدح', '2015241249', 75, '0582270974', NULL, '2025-12-05 15:36:35', '2025-12-05 15:36:35', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(14, 'شركة مجموعة خدمات الطعام', '4030050359', 121, '0563880000', 'الشريك - المهندس عدنان بن بكر شيخ', '2025-12-05 15:37:38', '2025-12-05 15:37:38', 1, NULL, '', NULL, 4, NULL, NULL, ''),
(15, 'مضوي عبدالله احمد محمد', '2156835825', 130, '0575612779 - 059336567', 'مهندس', '2025-12-05 15:39:27', '2025-12-05 15:50:07', 1, 1, '', 'مكتب الطلاق الهندسي', 2, '0575612779 أبنه', NULL, ''),
(16, 'مصطفـى حسن عزت السيد فتحي', '2057528214', 45, '0552232955', 'مهندس', '2025-12-05 15:52:01', '2025-12-05 15:52:01', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(17, 'إبراهيم لطفي إبراهيم عجلان', '2587850385', 45, '0547673835', 'طبيب أسنان', '2025-12-05 15:54:36', '2025-12-05 15:54:36', 1, NULL, '', 'مركز أبن سيناء الطبي  -  مكة  -  شارع العزيزية العام', 2, NULL, NULL, ''),
(18, 'شريف الدين دوست مراد باي', '2355838059', 1, '0568539392', NULL, '2025-12-05 15:55:39', '2025-12-05 15:55:39', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(19, 'ابراهيم باز محمد خان جاري', '2137072316', 1, '0599974545 - 0597001341', NULL, '2025-12-05 15:56:38', '2025-12-05 15:56:38', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(20, 'هاشم محمد شريف', '2046587636', 1, '0560400630', 'هويته مقيم منتهية ، ولم يجددها  ، غير متعاون', '2025-12-05 15:57:58', '2025-12-05 15:57:58', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(21, 'يحي خنيفس عيــاد المحمادي الحربي', '1013777691', 121, '0506504200', 'مستأجر قديم بالعمارة', '2025-12-05 15:59:20', '2025-12-05 15:59:20', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(22, 'صلاح محمد عبدالعزيز غنـيم', '2064287572', 45, '0545741001', 'مستأجر قديم  ، منتظم', '2025-12-05 16:00:50', '2025-12-05 16:31:25', 1, 1, 'uploads/5f56d9e5-546a-4046-9dde-a701963bea70.jpg', NULL, 2, NULL, NULL, ''),
(23, 'صبــري سعد سليمان', '2087782971', 45, '0562595050 - 0508727600', 'مستأجر منتظم', '2025-12-05 16:03:40', '2025-12-05 16:30:52', 1, 1, 'uploads/231d8219-ce91-4533-87ca-2f46fdc9af18.jpg', NULL, 2, NULL, NULL, ''),
(25, 'أحمد عبدالله أحمد علي البشـري', '2566004889', 148, '0543147004', 'مستأجره قديمة بالعمارة  ، منظمة العقد بإسم حفيدها  ، تدفع الايجار بواقع 4 دفعات إيجابية حسب موافقة الناظر', '2025-12-05 16:27:50', '2025-12-05 16:29:14', 1, 1, 'uploads/77763917-8cbe-48f1-a4eb-f487b43d43d5.jpg', NULL, 2, '0533303409', NULL, ''),
(26, 'علي محمد صالح السـقاف', '2160320087', 148, '0557012625 - 0561888005', NULL, '2025-12-05 16:36:06', '2025-12-05 16:36:06', 1, NULL, 'uploads/8ef76b2e-07df-4eb3-9db1-547530dd1fae.jpg', NULL, 2, NULL, NULL, ''),
(27, 'فهد عبدالرحمن فهد الملاعبه المطيري', '1004144935', 121, '0505226182', 'شقة شهيد الاسلام', '2025-12-05 17:47:43', '2025-12-10 16:18:19', 1, 1, 'uploads/3e540c6f-5052-4470-8edc-aa8a793b26a3.jpg', NULL, 1, '0539273551', NULL, ''),
(28, 'مهند علي معتوق لبــــــان', '1090489517', 121, '056730257', 'مطعم شهيد الاسلام', '2025-12-10 16:15:16', '2025-12-10 16:15:16', 1, NULL, 'uploads/a34a0cb1-55e6-48e1-a046-d60bf01c256d.jpg', NULL, 1, NULL, NULL, ''),
(29, 'سالمه بنت زيد ضيف الله الصبحــي', '1028388336', 121, '0561113229', 'ورشة التبريد', '2025-12-10 16:40:35', '2025-12-10 16:40:35', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(30, 'عمر محمد شهزاد محمد حسين', '2208761359', 109, '0567530528 - 0591689202 - 0530887219', NULL, '2025-12-10 16:42:21', '2025-12-10 16:44:59', 1, 1, 'uploads/ff166030-65a0-4247-aad9-88a3ec005183.jpg', NULL, 2, '0565020256', NULL, ''),
(31, 'سليمـان بن محزي بن جندوح الهلالي', '1072308602', 121, '0500173755 - 0559966739', NULL, '2025-12-10 16:50:47', '2025-12-10 16:50:47', 1, NULL, 'uploads/8886acd3-c9cf-4e57-96cb-45289fb198b1.pdf', NULL, 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-06-28 06:48:51', '2025-06-28 06:48:51'),
(2, 'enterduser', 'web', '2025-06-28 06:53:52', '2025-06-28 06:53:52');

-- --------------------------------------------------------

--
-- بنية الجدول `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(1, 2),
(2, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `sarfs`
--

CREATE TABLE `sarfs` (
  `id` int(11) NOT NULL,
  `source_type_id` int(11) NOT NULL COMMENT 'نوع مصدر الصرف',
  `p_date` varchar(10) NOT NULL,
  `p_dateh` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_txt` text DEFAULT NULL,
  `sarf_type_id` int(11) NOT NULL COMMENT 'نوع اوجه الصرف',
  `pay_role_id` int(11) DEFAULT NULL COMMENT 'رقم كشف الراتب',
  `payment_type` int(11) DEFAULT NULL,
  `year_m` varchar(4) DEFAULT NULL,
  `year_h` varchar(4) DEFAULT NULL,
  `sereal` int(11) DEFAULT NULL,
  `recipient_id` int(10) DEFAULT NULL COMMENT 'رقم المستفيد',
  `from_ohda_id` int(10) DEFAULT NULL COMMENT 'رقم العهدة اذا كان المدر عهدة',
  `to_ohda_id` int(11) DEFAULT NULL,
  `s_desc` text DEFAULT NULL COMMENT 'الغرض من الصرف ',
  `service_type_id` int(11) DEFAULT NULL COMMENT 'نوع الخدمة ',
  `maincenter_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `receved_by` text DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sarfs`
--

INSERT INTO `sarfs` (`id`, `source_type_id`, `p_date`, `p_dateh`, `amount`, `amount_txt`, `sarf_type_id`, `pay_role_id`, `payment_type`, `year_m`, `year_h`, `sereal`, `recipient_id`, `from_ohda_id`, `to_ohda_id`, `s_desc`, `service_type_id`, `maincenter_id`, `center_id`, `unit_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `receved_by`, `contract_id`) VALUES
(1, 1, '2025-12-05', '1447-06-14', 5000, 'فقط خمسة آلاف ريال لاغير', 1, NULL, 2, '25', '47', 1, NULL, NULL, 1, 'تعزيز مبلغ العهدة', NULL, 1, NULL, NULL, '2025-12-05 18:18:14', '2025-12-05 18:18:14', 1, NULL, NULL, 'وائل شيخ', NULL),
(2, 2, '2025-12-04', '1447-06-13', 550, 'فقط خمسمائة وخمسون ريالاً لاغير', 4, NULL, 2, '25', '47', 2, NULL, 1, NULL, 'فاتورة مياه شهر نوفمبر', 6, 1, 2, NULL, '2025-12-05 18:23:44', '2025-12-05 18:23:44', 1, NULL, NULL, 'شركة المياه الوطنية', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `sarf_types`
--

CREATE TABLE `sarf_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sarf_types`
--

INSERT INTO `sarf_types` (`id`, `name`) VALUES
(1, 'عهدة مالية'),
(2, 'المستفيدين'),
(3, 'رواتب موظفين'),
(4, 'خدمات');

-- --------------------------------------------------------

--
-- بنية الجدول `service_types`
--

CREATE TABLE `service_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `service_types`
--

INSERT INTO `service_types` (`id`, `name`) VALUES
(1, 'مشتريات'),
(2, 'صيانة عامة'),
(3, 'صيانة كهربائية'),
(4, 'صيانة سباكة'),
(5, 'فاتورة كهرباء'),
(6, 'فاتورة مياه'),
(7, 'صيانة مصعد'),
(8, 'تجديد عقود'),
(9, 'مخالفات'),
(10, 'أخرى');

-- --------------------------------------------------------

--
-- بنية الجدول `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ExgUN8VDv5w5mt3XoTRHvJENFGwtgt9GOFdgd6xm', NULL, '136.118.71.137', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTBpSTNkb3daRW1FTWJ1VENoNVh1bmRRMnI2QWNyTXdtM3JEMzRKMyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cHM6Ly93d3cuYXFhcm1hbmFnZXIuY29tIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LmFxYXJtYW5hZ2VyLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765385498),
('ioBVecvOCDR78eAFt5Fqj1FArFb2VhoCYDozcBpY', NULL, '136.118.71.137', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQm5wSjdkSUJZSUNkV2l4VHNaVGRpbHZWR0xSY0JsWm9wNVVBMlVHciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vd3d3LmFxYXJtYW5hZ2VyLmNvbS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765385498),
('u3KivQvF76drLZOLq3NyjMt1jHqQyUZYe5JGBdUh', 1, '77.90.217.229', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQU9sM3ZDSVVVblVldE9sTUZ0WVluQU0zbTkyTjZDTkYyVnI3ZzBPaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYXFhcm1hbmFnZXIuY29tL3JlbnRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2NTM4Mjk3NTt9fQ==', 1765385448);

-- --------------------------------------------------------

--
-- بنية الجدول `source_types`
--

CREATE TABLE `source_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `source_types`
--

INSERT INTO `source_types` (`id`, `name`) VALUES
(1, 'الايرادات'),
(2, 'العهد المالية'),
(3, 'مبيعات');

-- --------------------------------------------------------

--
-- بنية الجدول `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_type` int(11) DEFAULT NULL,
  `unit_description` text DEFAULT NULL,
  `center_id` int(11) NOT NULL,
  `woter_no` text DEFAULT NULL,
  `electric_no` text DEFAULT NULL,
  `current_renter_id` int(11) DEFAULT NULL,
  `floor_no` varchar(20) DEFAULT NULL,
  `unit_no` int(11) DEFAULT NULL,
  `maincenter_id` int(11) DEFAULT NULL,
  `no_of_rooms` varchar(20) DEFAULT NULL,
  `no_of_wc` varchar(20) DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `addad_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `units`
--

INSERT INTO `units` (`id`, `unit_type`, `unit_description`, `center_id`, `woter_no`, `electric_no`, `current_renter_id`, `floor_no`, `unit_no`, `maincenter_id`, `no_of_rooms`, `no_of_wc`, `activity`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `addad_no`) VALUES
(2, 2, NULL, 2, NULL, NULL, 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2025-12-05 17:37:53', '2025-12-05 17:37:53', 1, NULL, '', NULL),
(3, 2, 'غرفة واحدة', 2, NULL, NULL, 9, '5', 20, 1, '1', '1', 'سكن عائلي', NULL, '2025-12-05 17:57:40', '2025-12-05 17:59:21', 1, 1, '', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `unit_types`
--

CREATE TABLE `unit_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `unit_types`
--

INSERT INTO `unit_types` (`id`, `name`, `description`) VALUES
(1, 'عمارة', NULL),
(2, 'شقة سكنية', NULL),
(3, 'محل تجاري', NULL),
(4, 'ملحق سكني', NULL),
(5, 'مكتب تجاري', NULL),
(6, 'مخزن', NULL),
(7, 'دور', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `mobile_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `mobile_no`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$R.Y5nWIBK/wGmmWdICae1eRyF7ZYyQ4IbiiURLSQhhUqwJ860i3Hu', 'CxZXbEK8lSyDjNCRXrqfLlU40WVaDpjz22djQcVDzZK5inxer6q4qiWEjWJ7', '2025-06-28 06:48:51', '2025-06-28 06:48:51', 1, ''),
(2, 'fathy', 'fathylogic@hotmail.com', NULL, '$2y$12$uDJ3NOxvzmFeIKJmCJJMwOYuTefFr6wPtiz5vJoGQNB2Uj9RgWLHi', NULL, '2025-06-28 06:52:36', '2025-06-28 06:52:36', 0, ''),
(5, '‪Fathy Soliman‬', 'fsoliman@gmail.com', NULL, '$2y$12$6anF57zCiNCHwUubmBA3PulA72tezH8Bfr57J/VIvfleszZqHCYF6', NULL, '2025-07-25 14:50:43', '2025-07-25 14:50:43', 1, '0567842143');

-- --------------------------------------------------------

--
-- بنية الجدول `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `is_add` int(1) NOT NULL,
  `is_edit` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `is_show` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `user_id`, `app_id`, `is_add`, `is_edit`, `is_delete`, `is_show`, `created_by`, `created_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2025-07-11 20:10:38');

-- --------------------------------------------------------

--
-- بنية الجدول `vacations`
--

CREATE TABLE `vacations` (
  `id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `start_dateh` text NOT NULL,
  `end_dateh` text NOT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- فهارس للجدول `all_files`
--
ALTER TABLE `all_files`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- فهارس للجدول `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- فهارس للجدول `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `emp_periods`
--
ALTER TABLE `emp_periods`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `emp_statuss`
--
ALTER TABLE `emp_statuss`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `emp_types`
--
ALTER TABLE `emp_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- فهارس للجدول `id_types`
--
ALTER TABLE `id_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- فهارس للجدول `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `maincenters`
--
ALTER TABLE `maincenters`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- فهارس للجدول `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- فهارس للجدول `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `notes_files`
--
ALTER TABLE `notes_files`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `ohdas`
--
ALTER TABLE `ohdas`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `ohdas_operations`
--
ALTER TABLE `ohdas_operations`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `othercontents`
--
ALTER TABLE `othercontents`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- فهارس للجدول `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- فهارس للجدول `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `renters`
--
ALTER TABLE `renters`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- فهارس للجدول `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- فهارس للجدول `sarfs`
--
ALTER TABLE `sarfs`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `sarf_types`
--
ALTER TABLE `sarf_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- فهارس للجدول `source_types`
--
ALTER TABLE `source_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- فهارس للجدول `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_files`
--
ALTER TABLE `all_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emp_periods`
--
ALTER TABLE `emp_periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_statuss`
--
ALTER TABLE `emp_statuss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_types`
--
ALTER TABLE `emp_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_types`
--
ALTER TABLE `id_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maincenters`
--
ALTER TABLE `maincenters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes_files`
--
ALTER TABLE `notes_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ohdas`
--
ALTER TABLE `ohdas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ohdas_operations`
--
ALTER TABLE `ohdas_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `othercontents`
--
ALTER TABLE `othercontents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renters`
--
ALTER TABLE `renters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sarfs`
--
ALTER TABLE `sarfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sarf_types`
--
ALTER TABLE `sarf_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `source_types`
--
ALTER TABLE `source_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- القيود المفروضة على الجداول الملقاة
--

--
-- قيود الجداول `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
