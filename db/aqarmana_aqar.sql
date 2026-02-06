-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- مضيف: localhost:3306
-- وقت الجيل: 06 فبراير 2026 الساعة 11:28
-- إصدار الخادم: 11.4.9-MariaDB
-- نسخة PHP: 8.4.16

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

--
-- إرجاع أو استيراد بيانات الجدول `all_files`
--

INSERT INTO `all_files` (`id`, `title`, `object_id`, `object_name`, `created_at`, `updated_at`, `url`) VALUES
(1, 'مستندات هامه ومعلومات', 7, 'centers', '2025-12-19 15:46:11', '2025-12-19 15:46:11', 'uploads/a0e15871-85a9-463d-9978-25a91d4ff1e5.pdf'),
(2, 'شهادة الوقفية', 7, 'centers', '2025-12-19 15:47:22', '2025-12-19 15:47:22', 'uploads/0f891624-2899-4352-a410-e3e69edd5c66.pdf'),
(3, 'أرقام حسابات شركة الكهرباء', 7, 'centers', '2025-12-19 15:47:56', '2025-12-19 15:47:56', 'uploads/cd0d231d-94dc-48ff-8031-674161f56638.pdf'),
(4, 'رخصة البناء', 7, 'centers', '2025-12-19 15:48:31', '2025-12-19 15:48:31', 'uploads/47bc9d25-8bcc-4534-b2b3-387ba3e344f2.pdf'),
(5, 'عقد إيجار المبنى 2025 ( لقمان جمال حسين )', 7, 'centers', '2025-12-19 15:51:07', '2025-12-19 15:51:07', 'uploads/a1e13c01-2e43-4d39-8740-f02f797ca652.pdf'),
(6, 'السجل التجاري لشرك الشهاب الرائج ( لقمان جمال حسين )', 7, 'centers', '2025-12-19 15:52:13', '2025-12-19 15:52:13', 'uploads/3eb99f6c-fe00-40b0-8f53-6e7f6afbbc47.pdf'),
(7, 'هوية مقيم ( لقمان جمال حسين )', 7, 'centers', '2025-12-19 15:52:42', '2025-12-19 15:52:42', 'uploads/e5a3ada8-700e-4f98-917d-85b6925ddc09.jpg'),
(8, 'السجل التجاري لشركة الشهاب الرائج', 37, 'renters', '2025-12-19 16:26:33', '2025-12-19 16:26:33', 'uploads/04312e33-fb4c-47a3-8710-7115bf50a17e.pdf'),
(9, 'صك ملكية المبنى', 4, 'maincenters', '2025-12-20 10:55:21', '2025-12-20 10:55:21', 'uploads/b3225b8b-e167-4b39-93ed-3659bd1d2d17.pdf'),
(10, 'رخصة البناء', 4, 'maincenters', '2025-12-20 10:56:18', '2025-12-20 10:56:18', 'uploads/fe1f2406-b2bc-4ac3-b51d-cd455d410eb2.pdf'),
(11, 'جدول أرقام العدادات وحسابات سداد شركة الكهرباء', 4, 'maincenters', '2025-12-20 10:57:54', '2025-12-20 10:57:54', 'uploads/abb6454f-6aeb-4d5f-bce0-8bc0c24e3801.pdf'),
(12, 'صورة خطاب فسخ العقد القديم مع شركة العالمية للمواد الغذائية', 4, 'maincenters', '2025-12-20 10:59:57', '2025-12-20 10:59:57', 'uploads/324450ca-cd9e-4a95-881c-4f53653f3774.pdf'),
(13, 'خريطة موقع المبنى برقم القطعة', 4, 'maincenters', '2025-12-20 11:02:39', '2025-12-20 11:02:39', 'uploads/8bde949e-61a0-4797-82d4-5527208cccca.JPG'),
(14, 'صك ملكية المبنى', 3, 'centers', '2025-12-20 11:07:07', '2025-12-20 11:07:07', 'uploads/780172b5-981c-4ddd-b2ca-a0097672852a.pdf'),
(15, 'السجل التجاري للمستثمر', 3, 'centers', '2025-12-20 11:07:42', '2025-12-20 11:07:42', 'uploads/a82f94c2-f62f-489c-bb3f-1b64b321ea5b.pdf'),
(16, 'صورة الهوية الوطنية للمستثمر', 3, 'centers', '2025-12-20 11:08:15', '2025-12-20 11:08:15', 'uploads/4c317fbb-e8e9-4a9b-aced-fb5c62c6cf2b.jpg'),
(17, 'العنوان الوطني للمستثمر', 3, 'centers', '2025-12-20 11:11:15', '2025-12-20 11:11:15', 'uploads/6588b8ad-818d-49dc-a658-146f5701dcfc.pdf'),
(18, 'تصريح بناء المبنى', 6, 'centers', '2025-12-20 11:13:29', '2025-12-20 11:13:29', 'uploads/4a5fd987-3435-4029-938e-6fbd3f5cfb63.pdf'),
(19, 'صك ملكية المبنى 2025', 6, 'centers', '2025-12-20 11:16:01', '2025-12-20 11:16:01', 'uploads/c839295a-aecc-4d47-9955-73b57d81fcda.pdf'),
(20, 'شهادة تسجيل وقف بن عشان', 8, 'centers', '2025-12-20 11:19:00', '2025-12-20 11:19:00', 'uploads/accb82ad-01ff-4d38-9f46-3b13f221c808.pdf'),
(21, 'شهادة تسجيل الوقف', 4, 'maincenters', '2025-12-20 11:23:37', '2025-12-20 21:20:06', 'uploads/23a73d0a-034d-459f-9543-ba68f36c0f64.pdf'),
(22, 'شهادة تسجيل الوقف', 3, 'maincenters', '2025-12-20 11:29:56', '2025-12-20 11:29:56', 'uploads/073d0add-7132-48d8-93b4-89afd24ad927.pdf'),
(23, 'رخصة البناء', 3, 'maincenters', '2025-12-20 11:29:56', '2025-12-20 11:29:56', 'uploads/031a5fc3-8666-4f1f-bd74-a6c47a23cce5.pdf'),
(24, 'العنوان الوطني للمبنى', 3, 'maincenters', '2025-12-20 11:29:56', '2025-12-20 11:29:56', 'uploads/4f61a79c-9a76-4859-9598-6163a321b8f0.png'),
(25, 'أرقام حسابات سداد شركة الكهرباء والمياه', 3, 'maincenters', '2025-12-20 11:29:56', '2025-12-20 11:29:56', 'uploads/808f2fb3-4194-4f3b-bcea-e8c2545887bc.pdf'),
(26, 'صورة شهادة الحساب البنكي IBAN', 3, 'maincenters', '2025-12-20 11:29:56', '2025-12-20 11:29:56', 'uploads/8363b160-6b78-4c7f-9705-b45e539945a4.pdf'),
(27, 'الخرائط', 3, 'maincenters', '2025-12-20 11:29:56', '2025-12-20 11:29:56', 'uploads/e07256fe-71e3-4c9d-96bf-20af8302c8c4.pdf'),
(29, 'العقد الالكتروني لشقة محمد حسين حياني', 11, 'renters', '2025-12-22 15:47:04', '2025-12-22 15:47:04', 'uploads/8c45c63c-412a-4b24-84d3-ca23133b7525.pdf'),
(30, 'العقد الالكتروني لشقة مصطفى عزمى القنـدح', 5, 'units', '2025-12-22 16:15:41', '2025-12-22 16:15:41', 'uploads/ebb78650-6352-4843-9019-bc6c53ce27a1.pdf'),
(31, 'العقد الالكتروني لشقة حسين محمد حياني', 4, 'units', '2025-12-22 16:19:38', '2025-12-22 16:19:38', 'uploads/93fd9c54-0b03-4be7-91c0-fd1f408dabaf.pdf'),
(32, 'تفاصيل المبنى', 3, 'centers', '2025-12-23 16:12:14', '2025-12-23 16:12:14', 'uploads/7a762026-2626-4164-bf3c-5037fa445a30.pdf'),
(33, 'سند إستلام', 1, 'sarfs', '2026-01-19 15:52:01', '2026-01-19 15:52:01', 'uploads/1cafb62e-4f42-4dd2-96e0-4100293cc7f2.pdf'),
(34, 'سند صرف  + فاتورة مواد السباكة', 8, 'sarfs', '2026-01-21 15:44:34', '2026-01-21 15:44:34', 'uploads/a55b56b6-9485-4213-97f2-83d9f15be18b.pdf'),
(35, 'هوية المستثمر', 10, 'contracts', '2026-01-27 15:33:13', '2026-01-27 15:33:13', 'uploads/4d3e0b67-a6b7-42a9-bba7-ad5867b65682.jpg'),
(36, 'سند التحويل', 5, 'sarfs', '2026-01-31 12:35:58', '2026-01-31 12:35:58', 'uploads/64bb9b27-7c2d-4df6-ab5b-85d0e0884a5a.png'),
(37, 'سند التحويل', 6, 'sarfs', '2026-01-31 12:36:57', '2026-01-31 12:36:57', 'uploads/939eaf4e-9962-4b73-8870-03d2dc5eaa92.png'),
(38, 'سند التحويل', 7, 'sarfs', '2026-01-31 12:37:30', '2026-01-31 12:37:30', 'uploads/6d164230-99e3-4566-986c-a0c561f69bd7.png'),
(39, 'سند التحويل', 37, 'contracts', '2026-01-31 17:35:10', '2026-01-31 17:35:10', 'uploads/144b5f8f-0877-4e44-a89a-0bffd397336d.jpg'),
(40, 'سند التحويل', 26, 'contracts', '2026-02-01 17:55:11', '2026-02-01 17:55:11', 'uploads/b4a322ac-f663-465f-9534-6ddc8fcfaea0.pdf'),
(41, 'سند التحويل', 38, 'contracts', '2026-02-01 18:07:19', '2026-02-01 18:07:19', 'uploads/80ba6892-c850-440e-a90f-b03e54b0af13.pdf'),
(42, 'السجل التجاري', 28, 'renters', '2026-02-02 16:32:43', '2026-02-02 16:32:43', 'uploads/3a5430fa-295a-4dd5-8af3-ec4168f46361.jpg'),
(43, 'السجل التجاري', 40, 'units', '2026-02-02 16:40:12', '2026-02-02 16:40:12', 'uploads/6db8b7b1-110f-499d-9d99-721990e8db69.jpg'),
(44, 'سداد منصة إيجار 01', 43, 'contracts', '2026-02-02 16:45:17', '2026-02-02 16:45:17', 'uploads/19be42ad-9df8-4e36-90b5-643a0eb07119.jpg'),
(45, 'سداد منصة إيجار 02', 43, 'contracts', '2026-02-02 16:45:32', '2026-02-02 16:45:32', 'uploads/1241aa47-d4d6-44b7-88b2-8c0649abc87d.jpg'),
(46, 'سداد منصة إيجار 03', 43, 'contracts', '2026-02-02 17:22:53', '2026-02-02 17:22:53', 'uploads/614cbb8e-5092-49cf-a99c-99673a6cff56.jpg'),
(47, 'تحويل المنصة', 43, 'contracts', '2026-02-02 17:26:41', '2026-02-02 17:26:41', 'uploads/b620c97f-013d-47a6-9ed3-db9b276e78f1.jpg'),
(48, 'سند التحويل', 44, 'contracts', '2026-02-02 18:12:26', '2026-02-02 18:12:26', 'uploads/55f5ca6d-6b4c-447a-a045-3309045069f9.pdf'),
(51, 'سداد الدفعة الأولى', 45, 'contracts', '2026-02-02 18:39:38', '2026-02-02 18:39:38', 'uploads/9ac5affa-697a-49f3-aa07-210d072a1aae.pdf'),
(52, 'سداد الدفعة الثانية', 45, 'contracts', '2026-02-02 18:39:38', '2026-02-02 19:03:13', 'uploads/f050b27a-9725-49d2-8690-70ccb6deecec.pdf'),
(53, 'سداد الدفعة الأولى', 46, 'contracts', '2026-02-02 18:51:05', '2026-02-02 18:51:05', 'uploads/3c27b408-f194-4ef9-968a-b06f850beda9.pdf'),
(54, 'سداد الدفعة الثانية', 46, 'contracts', '2026-02-02 18:51:05', '2026-02-02 18:51:05', 'uploads/7b3a80dd-9ae0-4ba0-a8f7-ba57e0e91369.pdf');

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
(6, 1, 'عمارة الزاهر', 1, '0127444444', '30048664069', '30048664078', '2025-12-08 16:24:51', '2025-12-20 11:19:35', 1, 1, '', 'مؤجرة بالكامل شقق سكنية عوائل  + محلات تجارية', NULL, 'حي العتيبية ( الزاهر )', 'العمرة', 34, '‭‭360623003280‬‬', '2,3,4'),
(7, 3, 'عمارة مخطط البنك', 1, '0844711111', '30125944171', NULL, '2025-12-08 16:40:15', '2025-12-23 16:06:39', 1, 1, 'uploads/e444f4bd-7dcc-4d91-99ea-fd6f6c9ee732.jpg', 'مؤجرة بالكامل لشركة الشهاب الرائج', NULL, 'الجامعة  ( مخطط البنك )', 'حذيفة بن أسيد الغفـاري ( رضي الله عنه )', 4183, '320110009090', '2,3,4'),
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
  `year_amount` decimal(11,0) DEFAULT NULL,
  `services_amount` decimal(11,0) DEFAULT 0,
  `insurance_amount` decimal(11,0) DEFAULT 0,
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
  `period_day` int(11) DEFAULT NULL,
  `delay_fine` decimal(11,0) DEFAULT NULL,
  `start_payment_amount` decimal(11,0) DEFAULT NULL,
  `no_of_all_payments` int(11) DEFAULT NULL,
  `total_amount` decimal(11,0) DEFAULT NULL,
  `electric_no` text DEFAULT NULL,
  `parent_contract_id` int(11) DEFAULT NULL COMMENT 'العقد الأصلي في حالة التقبيل',
  `contract_status` enum('active','terminated','assigned','extended','expired') DEFAULT 'active',
  `water_no` text DEFAULT NULL,
  `segel_togary` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contracts`
--

INSERT INTO `contracts` (`id`, `start_date`, `end_date`, `start_dateh`, `end_dateh`, `no_of_payments`, `year_amount`, `services_amount`, `insurance_amount`, `center_id`, `unit_id`, `renter_id`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `is_active`, `maincenter_id`, `period_year`, `period_month`, `e_no`, `period_day`, `delay_fine`, `start_payment_amount`, `no_of_all_payments`, `total_amount`, `electric_no`, `parent_contract_id`, `contract_status`, `water_no`, `segel_togary`) VALUES
(7, '2025-10-23', '2030-05-31', '1447/05/01', '1452/01/29', 2, 430000, 0, 0, 7, NULL, 37, '', '2026-01-24 16:49:07', '2026-01-24 17:05:59', 6, 6, NULL, 1, 1, 4, 7, '10866644142', 9, 10000, 200000, 10, 2150000, 'SXE2020809198848 - SXE2020809196276 - SXE2020809194939 - SXE2020809196272 - SEX2020809198849 -SEX2020809198849 - LYE1920300710103 - SXE2020627003218 - SXE2020809198853 - SXE2020809194937 - SXE2020809198851 - SXE2020809198850 - SXE2020809198852 - SXE2020809194943 - SXE2020809194936 - SXE2020809196277 - SXE2020809196274 - SXE2020809196278 -SXE2020809194938 - SXE2020809194940 - SXE2020809198854 -SXE2020809196273 - SXE2020809195272 - SXE2020809196275 -SXE2020809194942 -SXE2020809196279 -SXE2020809198855 -( ارقام عدادات الكهرباء )', NULL, 'active', NULL, NULL),
(9, '2026-02-10', '2028-02-09', '1447/08/22', '1449/09/13', 2, 70000, 0, 0, 5, 36, 14, NULL, '2026-01-24 17:44:56', '2026-01-24 17:44:56', 6, NULL, 'uploads/c3cc82e2-e403-4c5f-8682-bf44118feac0.pdf', 1, 1, 2, 0, '10070218551', 0, 250, 0, 4, 164000, NULL, NULL, 'active', NULL, NULL),
(10, '2025-07-26', '2033-04-29', '1447/02/01', '1455/01/29', 2, 335010, 0, 0, 8, NULL, 40, 'مستثمر لمدة 8 سنوات', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, 'uploads/096b2000-d806-4993-9f81-c3d457dd705c.pdf', 1, 1, 7, 9, '10706635238', 4, 0, 0, 8, 2599999, '‭‭30054516277‬‬ - ‭‭30054516221‬‬ - ‭‭30054516301‬‬ - ‭‭30054516240‬‬ - ‭‭30054516160‬‬ - ‭‭30054516197‬‬ - ‭‭30054516188‬‬ - ‭‭30054516105‬‬ - GRT2220882142794', NULL, 'active', '‭‭3211531492‬‬', NULL),
(11, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 25650, 0, 0, 2, 7, 9, 'مستأجر شقة  + غرفة', '2026-01-26 16:21:26', '2026-01-26 16:21:26', 6, NULL, 'uploads/6cac66fe-9900-409c-ad16-7e326a1b1255.pdf', 1, 1, 1, 0, '10572826763', 0, 250, 0, 2, 25650, '‭‭10067038657‬‬ - ‭‭10067042195‬‬', NULL, 'active', 'بدون', NULL),
(13, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 9650, 650, 0, 2, 5, 4, NULL, '2026-01-27 15:53:54', '2026-01-27 16:59:52', 6, 6, '', 1, 1, 1, 0, '10361313235', 0, 250, 0, 2, 18650, '‭‭10067039206‬‬', NULL, 'active', 'بدون', NULL),
(15, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10650, 650, 0, 2, 9, 6, NULL, '2026-01-27 16:16:28', '2026-01-27 16:16:28', 6, NULL, 'uploads/d670feab-8a1f-49ec-b46f-c8832b387459.pdf', 1, 1, 1, 0, '10893242026', 0, 250, 0, 2, 20650, '‭‭10067042810‬‬', NULL, 'active', 'بدون', NULL),
(17, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 11650, 650, 0, 2, 8, 5, NULL, '2026-01-27 16:42:48', '2026-01-27 16:42:48', 6, NULL, 'uploads/3972ea70-4858-4b97-88f8-c1e2dd738cb8.pdf', 1, 1, 1, 0, '10315714811', 0, 250, 0, 2, 22650, '10067041161', NULL, 'active', 'بدون', NULL),
(18, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10650, 650, 0, 2, 10, 7, NULL, '2026-01-27 16:55:26', '2026-02-04 15:46:53', 6, 6, '', 1, 1, 1, 0, '10229448227', 0, 250, 0, 2, 20650, '10067041625', NULL, 'active', 'بدون', NULL),
(19, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10650, 650, 0, 2, 11, 8, NULL, '2026-01-27 17:06:52', '2026-01-27 17:06:52', 6, NULL, 'uploads/83289f97-d65e-444d-9da4-cf133b735a50.pdf', 1, 1, 1, 0, '10937888206', 0, 250, 0, 2, 20650, '‭‭10067043263‬‬', NULL, 'active', 'بدون', NULL),
(20, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10650, 650, 0, 5, 4, 11, NULL, '2026-01-27 17:42:59', '2026-01-27 17:42:59', 6, NULL, 'uploads/a6052d33-2146-471f-acf8-0f2d8671e928.pdf', 1, 1, 1, 0, '10338130849', 0, 250, 0, 2, 20650, '‭‭10066622163‬‬', NULL, 'active', 'بدون', NULL),
(21, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10650, 650, 2000, 5, 28, 12, 'تم تقبيل عقد الشقة من الدكتور ( أحمد علي أمين ) إلى المهندس ( أحمد السيد محمد مكاوي ) وقد دفع المهندس مبلغ وقدره ( 10000 ريال )  عشرة آلاف ريال فقط لا غير  ، نظير الدفعة الثانية فقط . حيث أن.           ( الدكتور أحمد علي أمين ) قام بسداد الدفعة الأولى كاملة مع مبلغ ( 650 ريال ) نظير الخدمات .', '2026-01-27 17:54:30', '2026-01-27 17:54:30', 6, NULL, 'uploads/213df0c0-d73e-4059-b85b-763711cf20eb.pdf', 1, 1, 1, 0, '10256056261', 0, 250, 0, 2, 20650, '10066620964', NULL, 'active', 'بدون', NULL),
(23, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10650, 650, 0, 5, 29, 10, NULL, '2026-01-27 18:12:25', '2026-01-27 18:12:25', 6, NULL, 'uploads/2c498108-8473-451f-b2c3-50ef3c341508.pdf', 1, 1, 1, 0, '10086726574', 0, 250, 0, 2, 20650, '‭‭10066622664‬‬', NULL, 'active', 'بدون', NULL),
(24, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10000, 650, 0, 5, 30, 13, NULL, '2026-01-31 12:52:54', '2026-01-31 12:52:54', 6, NULL, 'uploads/1b249833-7537-4538-8175-898b710b6344.pdf', 1, 1, 1, 0, '10590472252', 0, 250, 0, 2, 20650, '10066621934', NULL, 'active', 'بدون', NULL),
(25, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10000, 650, 2000, 5, 31, 17, NULL, '2026-01-31 13:05:42', '2026-01-31 13:05:42', 6, NULL, 'uploads/5233bb00-2754-4387-8bd5-482da9cf7dc6.pdf', 1, 1, 1, 0, '10603783497', 0, 250, 0, 2, 20650, '10066621193', NULL, 'active', 'بدون', NULL),
(26, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10000, 650, 2000, 5, 32, 15, NULL, '2026-01-31 13:10:52', '2026-01-31 13:10:52', 6, NULL, 'uploads/49358f47-c5bc-44b0-96ab-0f473c1f0a54.pdf', 1, 1, 1, 0, '10028928486', 0, 250, 0, 2, 20650, '10066621658', NULL, 'active', 'بدون', NULL),
(27, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 10000, 650, 2000, 5, 33, 16, NULL, '2026-01-31 13:18:57', '2026-01-31 13:18:57', 6, NULL, 'uploads/40276f07-598f-4b21-8b96-7aba930e4261.pdf', 1, 1, 1, 0, '10936372702', 0, 250, 0, 2, 20650, '‭‭10066622403‬‬', NULL, 'active', 'بدون', NULL),
(28, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 0, 6, 13, 19, NULL, '2026-01-31 15:48:21', '2026-01-31 15:48:21', 6, NULL, 'uploads/1bbcd0ee-68fa-4dca-8a1b-4cbc008b2703.pdf', 1, 1, 1, 0, '10543892801', 0, 250, 0, 2, 15650, '‭‭10064958575‬‬', NULL, 'active', 'بدون', NULL),
(29, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7825, 650, 0, 6, 15, 21, NULL, '2026-01-31 15:54:12', '2026-01-31 15:54:12', 6, NULL, 'uploads/cf56cac3-68b6-4fca-8e40-c43de0965bfd.pdf', 1, 1, 1, 0, '10755856815', 0, 250, 0, 2, 15650, '‭‭10064957907‬‬', NULL, 'active', 'بدون', NULL),
(30, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 0, 6, 17, 22, NULL, '2026-01-31 15:59:45', '2026-01-31 15:59:45', 6, NULL, 'uploads/668df71c-da24-42bd-9616-c9de1c0fe9cf.pdf', 1, 1, 1, 0, '10779902892', 0, 250, 0, 2, 15650, '‭‭10064957353‬‬', NULL, 'active', 'بدون', NULL),
(31, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 0, 6, 18, 23, NULL, '2026-01-31 16:05:44', '2026-01-31 18:12:22', 6, 6, '', 1, 1, 0, 6, '10425996338', 1, 250, 0, 2, 15650, '10064957086', NULL, 'active', 'بدون', NULL),
(32, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 4, 3750, 650, 0, 6, 19, 25, NULL, '2026-01-31 16:24:00', '2026-01-31 16:24:00', 6, NULL, 'uploads/3eeaac8b-51e0-419f-a639-e917b6e654bb.pdf', 1, 1, 1, 0, '10676332143', 0, 250, 0, 4, 15650, '10064956900', NULL, 'active', 'بدون', NULL),
(33, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 0, 6, 20, 26, NULL, '2026-01-31 16:31:51', '2026-01-31 16:31:51', 6, NULL, 'uploads/8e2c53bd-f58d-430a-9369-3eec957136bc.pdf', 1, 1, 1, 0, '10106987102', 0, 250, 0, 2, 15650, '‭‭10064956392‬‬', NULL, 'active', 'بدون', NULL),
(35, '2025-08-01', '2026-06-30', '1447/02/07', '1448/01/15', 2, 6875, 650, 0, 6, 21, 27, NULL, '2026-01-31 16:47:40', '2026-01-31 16:47:40', 6, NULL, 'uploads/3b5e6128-0cf9-466e-b3d9-e2e0b79742a7.pdf', 1, 1, 0, 11, '10138984056', 0, 250, 0, 2, 14400, '‭‭10138984056‬‬', NULL, 'active', NULL, NULL),
(37, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 0, 6, 25, 30, NULL, '2026-01-31 17:23:43', '2026-01-31 17:23:43', 6, NULL, 'uploads/e96cebc6-8040-4146-a0e4-cf10929f8f77.pdf', 1, 1, 1, 0, '10387617277', 0, 250, 0, 2, 15650, '‭‭10064955902‬‬', NULL, 'active', 'بدون', NULL),
(38, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 15650, 650, 0, 6, 35, 31, NULL, '2026-01-31 17:45:46', '2026-01-31 17:45:46', 6, NULL, 'uploads/16e5ff01-439d-44d0-97bf-3bcd93857e5c.pdf', 1, 1, 1, 0, '20706648284', 0, 250, 0, 2, 30650, '‭‭10064864826‬‬ - ‭‭10064955493‬‬ - 10064955724', NULL, 'active', 'بدون', NULL),
(39, '2025-10-01', '2027-12-31', '1447/04/09', '1449/08/03', 2, 20675, 650, 0, 6, 34, 28, NULL, '2026-01-31 18:03:29', '2026-01-31 18:03:51', 6, 6, '', 1, 1, 2, 3, '20684410641', 0, 250, 0, 4, 46462, '‭‭2020800172461‬‬ - ‭‭2420828237708‬‬', NULL, 'active', 'بدون', NULL),
(40, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 6650, 650, 1000, 9, 37, 32, NULL, '2026-02-01 18:28:13', '2026-02-01 18:28:13', 6, NULL, 'uploads/4e6430b0-0788-4361-ab43-92904eae3937.pdf', 1, 1, 1, 0, '20988462632', 0, 250, 0, 2, 12650, '30005038854', NULL, 'active', 'بدون', '5855341003'),
(41, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 15650, 650, 0, 9, 38, 33, NULL, '2026-02-01 18:36:41', '2026-02-01 18:36:41', 6, NULL, 'uploads/06642ff3-00c8-4065-9b08-e775f086c13b.pdf', 1, 1, 1, 0, '20034594964', 0, 250, 0, 2, 30650, '30005124729 - 30005113734 - 30005113743', NULL, 'active', 'بدون', '4031078208'),
(42, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7150, 650, 0, 9, 39, 34, NULL, '2026-02-01 18:42:30', '2026-02-01 18:42:30', 6, NULL, 'uploads/29779024-59fc-4edc-9ea1-1a2917064652.pdf', 1, 1, 1, 0, '20063691779', 0, 250, 0, 2, 13650, '30005124738', NULL, 'active', 'بدون', '4031102045'),
(43, '2026-02-01', '2026-12-31', '1447/08/13', '1448/07/22', 2, 6355, 650, 0, 6, 40, 28, 'سدد الدفعة الأولى على 3 دفعات سدد الأولى 6125 ريال - الثانية 25 ريال - الثالثة 205 ريال', '2026-02-02 16:44:19', '2026-02-02 17:21:36', 6, 6, '', 1, 1, 0, 11, '‭‭20461350538‬‬', 0, 250, 0, 2, 11650, 'بدون', NULL, 'active', 'بدون', '7043231153'),
(44, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 3500, 650, 0, 6, 27, 29, NULL, '2026-02-02 18:08:45', '2026-02-02 18:08:45', 6, NULL, '', 1, 1, 1, 0, 'بدون عقد إلكتروني', 0, 250, 0, 2, 9650, '10064864094', NULL, 'active', 'بدون', NULL),
(45, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 0, 6, 12, 18, NULL, '2026-02-02 18:23:25', '2026-02-02 18:23:25', 6, NULL, '', 1, 1, 1, 0, 'بدون عقد إلكتروني', 0, 0, 0, 2, 15650, '10064958950', NULL, 'active', 'بدون', NULL),
(46, '2025-07-01', '2026-06-30', '1447/01/06', '1448/01/15', 2, 7500, 650, 2000, 6, 14, 20, NULL, '2026-02-02 18:49:27', '2026-02-02 18:49:27', 6, NULL, '', 1, 1, 1, 0, 'بدون عقد إلكتروني', 0, 0, 0, 2, 15650, '10064958163', NULL, 'active', 'بدون', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `contract_events`
--

CREATE TABLE `contract_events` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `event_type` enum('terminate','assign','extend') NOT NULL,
  `event_date` date NOT NULL,
  `effective_date` date NOT NULL,
  `old_renter_id` int(11) DEFAULT NULL,
  `new_renter_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
(3, 'عدنان بكر شيخ', '1006528242', 121, '0563880000', NULL, 'المدير العام', NULL, 0, '08/10/1973', '1393/09/12', NULL, '2025-12-08 17:19:11', '2026-01-15 17:48:30', 1, 1, 'uploads/c1c293f6-9b4f-4ae5-83e4-e51f9019adbf.jpg', 1, NULL, NULL, NULL, NULL),
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
(1, 'وصية ابراهيم صدقي', '911000006170000000320', 1, '2025-12-05 06:34:22', '2025-12-21 18:02:45', 1, 1, '', NULL),
(2, 'وقف ابراهيم صدقي الرباط', '5720000001022337809940', 1, '2025-12-05 06:35:13', '2025-12-23 16:15:17', 1, 1, '', NULL),
(3, 'وقف ابراهيم صدقي ( حارة الباب )', '5720000001022337809940', 1, '2025-12-08 16:28:09', '2025-12-22 15:32:45', 1, 1, 'uploads/0fdefab5-8967-48d5-9779-a6aa6cc1661f.jpg', NULL),
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
(16, 5, 'تم صرف مبلغ : 550', 0, '2025-12-05 18:23:44', '2025-12-05 18:23:44', 'sarfs.show', 2),
(17, 1, 'تم تحرير عقد جديد ', 0, '2025-12-10 18:17:49', '2025-12-10 18:17:49', 'contracts.show', 3),
(18, 5, 'تم تحرير عقد جديد ', 0, '2025-12-10 18:17:49', '2025-12-10 18:17:49', 'contracts.show', 3),
(19, 1, 'تم تحرير عقد جديد ', 0, '2025-12-21 18:27:07', '2025-12-21 18:27:07', 'contracts.show', 4),
(20, 5, 'تم تحرير عقد جديد ', 0, '2025-12-21 18:27:07', '2025-12-21 18:27:07', 'contracts.show', 4),
(21, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-21 18:30:21', '2025-12-21 18:30:21', 'payments.show', 11),
(22, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-21 18:30:21', '2025-12-21 18:30:21', 'payments.show', 11),
(23, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-21 18:33:39', '2025-12-21 18:33:39', 'payments.show', 12),
(24, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-21 18:33:39', '2025-12-21 18:33:39', 'payments.show', 12),
(25, 1, 'تم تحرير عقد جديد ', 0, '2025-12-21 18:42:44', '2025-12-21 18:42:44', 'contracts.show', 5),
(26, 5, 'تم تحرير عقد جديد ', 0, '2025-12-21 18:42:44', '2025-12-21 18:42:44', 'contracts.show', 5),
(27, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-21 18:45:55', '2025-12-21 18:45:55', 'payments.show', 14),
(28, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-21 18:45:55', '2025-12-21 18:45:55', 'payments.show', 14),
(29, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-22 15:36:40', '2025-12-22 15:36:40', 'payments.show', 7),
(30, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-22 15:36:40', '2025-12-22 15:36:40', 'payments.show', 7),
(31, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-22 15:37:06', '2025-12-22 15:37:06', 'payments.show', 8),
(32, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-22 15:37:06', '2025-12-22 15:37:06', 'payments.show', 8),
(33, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-22 15:38:13', '2025-12-22 15:38:13', 'payments.show', 9),
(34, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-22 15:38:13', '2025-12-22 15:38:13', 'payments.show', 9),
(35, 1, 'تم تحرير عقد جديد ', 0, '2025-12-23 15:50:54', '2025-12-23 15:50:54', 'contracts.show', 6),
(36, 5, 'تم تحرير عقد جديد ', 0, '2025-12-23 15:50:54', '2025-12-23 15:50:54', 'contracts.show', 6),
(37, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-23 15:53:28', '2025-12-23 15:53:28', 'payments.show', 16),
(38, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-23 15:53:28', '2025-12-23 15:53:28', 'payments.show', 16),
(39, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-23 16:28:42', '2025-12-23 16:28:42', 'payments.show', 4),
(40, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-23 16:28:42', '2025-12-23 16:28:42', 'payments.show', 4),
(41, 1, 'تم تحرير عقد جديد ', 0, '2025-12-23 17:11:32', '2025-12-23 17:11:32', 'contracts.show', 7),
(42, 5, 'تم تحرير عقد جديد ', 0, '2025-12-23 17:11:32', '2025-12-23 17:11:32', 'contracts.show', 7),
(43, 1, 'تم استلام مبلغ نقدي', 0, '2025-12-23 17:21:19', '2025-12-23 17:21:19', 'payments.show', 26),
(44, 5, 'تم استلام مبلغ نقدي', 0, '2025-12-23 17:21:19', '2025-12-23 17:21:19', 'payments.show', 26),
(45, 1, 'تم تحرير عقد جديد ', 0, '2025-12-24 17:31:59', '2025-12-24 17:31:59', 'contracts.show', 8),
(46, 5, 'تم تحرير عقد جديد ', 0, '2025-12-24 17:31:59', '2025-12-24 17:31:59', 'contracts.show', 8),
(47, 1, 'تم صرف مبلغ : 7000', 0, '2026-01-12 09:21:06', '2026-01-12 09:21:06', 'sarfs.show', 1),
(48, 5, 'تم صرف مبلغ : 7000', 0, '2026-01-12 09:21:06', '2026-01-12 09:21:06', 'sarfs.show', 1),
(49, 1, 'تم تحرير عقد جديد ', 0, '2026-01-15 17:10:48', '2026-01-15 17:10:48', 'contracts.show', 1),
(50, 5, 'تم تحرير عقد جديد ', 0, '2026-01-15 17:10:48', '2026-01-15 17:10:48', 'contracts.show', 1),
(51, 1, 'تم صرف مبلغ : 317', 0, '2026-01-15 18:00:29', '2026-01-15 18:00:29', 'sarfs.show', 2),
(52, 5, 'تم صرف مبلغ : 317', 0, '2026-01-15 18:00:29', '2026-01-15 18:00:29', 'sarfs.show', 2),
(53, 1, 'تم صرف مبلغ : 2000', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 3),
(54, 5, 'تم صرف مبلغ : 2000', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 3),
(55, 1, 'تم صرف مبلغ : 1200', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 4),
(56, 5, 'تم صرف مبلغ : 1200', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 4),
(57, 1, 'تم صرف مبلغ : 1500', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 5),
(58, 5, 'تم صرف مبلغ : 1500', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 5),
(59, 1, 'تم صرف مبلغ : 1200', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 6),
(60, 5, 'تم صرف مبلغ : 1200', 0, '2026-01-15 18:06:43', '2026-01-15 18:06:43', 'sarfs.show', 6),
(61, 1, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:03:09', '2026-01-16 16:03:09', 'contracts.show', 2),
(62, 5, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:03:09', '2026-01-16 16:03:09', 'contracts.show', 2),
(63, 6, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:03:09', '2026-01-16 16:03:09', 'contracts.show', 2),
(64, 1, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:09:34', '2026-01-16 16:09:34', 'contracts.show', 3),
(65, 5, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:09:34', '2026-01-16 16:09:34', 'contracts.show', 3),
(66, 6, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:09:34', '2026-01-16 16:09:34', 'contracts.show', 3),
(67, 1, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:14:38', '2026-01-16 16:14:38', 'contracts.show', 4),
(68, 5, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:14:38', '2026-01-16 16:14:38', 'contracts.show', 4),
(69, 6, 'تم تحرير عقد جديد ', 0, '2026-01-16 16:14:38', '2026-01-16 16:14:38', 'contracts.show', 4),
(70, 1, 'تم تحرير عقد جديد ', 0, '2026-01-16 17:48:02', '2026-01-16 17:48:02', 'contracts.show', 5),
(71, 5, 'تم تحرير عقد جديد ', 0, '2026-01-16 17:48:02', '2026-01-16 17:48:02', 'contracts.show', 5),
(72, 6, 'تم تحرير عقد جديد ', 0, '2026-01-16 17:48:02', '2026-01-16 17:48:02', 'contracts.show', 5),
(73, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-16 18:20:46', '2026-01-16 18:20:46', 'payments.show', 18),
(74, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-16 18:20:46', '2026-01-16 18:20:46', 'payments.show', 18),
(75, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-16 18:20:46', '2026-01-16 18:20:46', 'payments.show', 18),
(76, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-16 18:21:10', '2026-01-16 18:21:10', 'payments.show', 19),
(77, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-16 18:21:10', '2026-01-16 18:21:10', 'payments.show', 19),
(78, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-16 18:21:10', '2026-01-16 18:21:10', 'payments.show', 19),
(79, 1, 'تم صرف مبلغ : 1565.80', 0, '2026-01-19 15:55:01', '2026-01-19 15:55:01', 'sarfs.show', 7),
(80, 5, 'تم صرف مبلغ : 1565.80', 0, '2026-01-19 15:55:01', '2026-01-19 15:55:01', 'sarfs.show', 7),
(81, 6, 'تم صرف مبلغ : 1565.80', 0, '2026-01-19 15:55:01', '2026-01-19 15:55:01', 'sarfs.show', 7),
(82, 1, 'تم صرف مبلغ : 1300', 0, '2026-01-21 15:40:50', '2026-01-21 15:40:50', 'sarfs.show', 8),
(83, 5, 'تم صرف مبلغ : 1300', 0, '2026-01-21 15:40:50', '2026-01-21 15:40:50', 'sarfs.show', 8),
(84, 6, 'تم صرف مبلغ : 1300', 1, '2026-01-21 15:40:50', '2026-01-22 17:21:09', 'sarfs.show', 8),
(85, 1, 'تم صرف مبلغ : 7000', 0, '2026-01-23 16:27:27', '2026-01-23 16:27:27', 'sarfs.show', 1),
(86, 5, 'تم صرف مبلغ : 7000', 0, '2026-01-23 16:27:27', '2026-01-23 16:27:27', 'sarfs.show', 1),
(87, 6, 'تم صرف مبلغ : 7000', 0, '2026-01-23 16:27:27', '2026-01-23 16:27:27', 'sarfs.show', 1),
(88, 1, 'تم صرف مبلغ : 1300', 0, '2026-01-23 16:35:36', '2026-01-23 16:35:36', 'sarfs.show', 2),
(89, 5, 'تم صرف مبلغ : 1300', 0, '2026-01-23 16:35:36', '2026-01-23 16:35:36', 'sarfs.show', 2),
(90, 6, 'تم صرف مبلغ : 1300', 0, '2026-01-23 16:35:36', '2026-01-23 16:35:36', 'sarfs.show', 2),
(91, 1, 'تم صرف مبلغ : 50', 0, '2026-01-23 16:38:15', '2026-01-23 16:38:15', 'sarfs.show', 3),
(92, 5, 'تم صرف مبلغ : 50', 0, '2026-01-23 16:38:15', '2026-01-23 16:38:15', 'sarfs.show', 3),
(93, 6, 'تم صرف مبلغ : 50', 0, '2026-01-23 16:38:15', '2026-01-23 16:38:15', 'sarfs.show', 3),
(94, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-24 16:53:23', '2026-01-24 16:53:23', 'payments.show', 22),
(95, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-24 16:53:23', '2026-01-24 16:53:23', 'payments.show', 22),
(96, 6, 'تم استلام مبلغ نقدي', 1, '2026-01-24 16:53:23', '2026-01-24 18:09:13', 'payments.show', 22),
(97, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-24 17:46:35', '2026-01-24 17:46:35', 'payments.show', 40),
(98, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-24 17:46:35', '2026-01-24 17:46:35', 'payments.show', 40),
(99, 6, 'تم استلام مبلغ نقدي', 1, '2026-01-24 17:46:35', '2026-01-24 18:09:04', 'payments.show', 40),
(100, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-26 16:22:11', '2026-01-26 16:22:11', 'payments.show', 53),
(101, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-26 16:22:11', '2026-01-26 16:22:11', 'payments.show', 53),
(102, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-26 16:22:11', '2026-01-26 16:22:11', 'payments.show', 53),
(103, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-26 16:22:51', '2026-01-26 16:22:51', 'payments.show', 54),
(104, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-26 16:22:51', '2026-01-26 16:22:51', 'payments.show', 54),
(105, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-26 16:22:51', '2026-01-26 16:22:51', 'payments.show', 54),
(106, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 15:56:06', '2026-01-27 15:56:06', 'payments.show', 57),
(107, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 15:56:06', '2026-01-27 15:56:06', 'payments.show', 57),
(108, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 15:56:06', '2026-01-27 15:56:06', 'payments.show', 57),
(109, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 15:56:41', '2026-01-27 15:56:41', 'payments.show', 58),
(110, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 15:56:41', '2026-01-27 15:56:41', 'payments.show', 58),
(111, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 15:56:41', '2026-01-27 15:56:41', 'payments.show', 58),
(112, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:24:23', '2026-01-27 16:24:23', 'payments.show', 66),
(113, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:24:23', '2026-01-27 16:24:23', 'payments.show', 66),
(114, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:24:23', '2026-01-27 16:24:23', 'payments.show', 66),
(115, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:30:15', '2026-01-27 16:30:15', 'payments.show', 67),
(116, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:30:15', '2026-01-27 16:30:15', 'payments.show', 67),
(117, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:30:15', '2026-01-27 16:30:15', 'payments.show', 67),
(118, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:43:12', '2026-01-27 16:43:12', 'payments.show', 69),
(119, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:43:12', '2026-01-27 16:43:12', 'payments.show', 69),
(120, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:43:12', '2026-01-27 16:43:12', 'payments.show', 69),
(121, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:43:59', '2026-01-27 16:43:59', 'payments.show', 70),
(122, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:43:59', '2026-01-27 16:43:59', 'payments.show', 70),
(123, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 16:43:59', '2026-01-27 16:43:59', 'payments.show', 70),
(124, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:07:30', '2026-01-27 17:07:30', 'payments.show', 79),
(125, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:07:30', '2026-01-27 17:07:30', 'payments.show', 79),
(126, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:07:30', '2026-01-27 17:07:30', 'payments.show', 79),
(127, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:07:48', '2026-01-27 17:07:48', 'payments.show', 80),
(128, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:07:48', '2026-01-27 17:07:48', 'payments.show', 80),
(129, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:07:48', '2026-01-27 17:07:48', 'payments.show', 80),
(130, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:43:33', '2026-01-27 17:43:33', 'payments.show', 82),
(131, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:43:33', '2026-01-27 17:43:33', 'payments.show', 82),
(132, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:43:33', '2026-01-27 17:43:33', 'payments.show', 82),
(133, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:43:56', '2026-01-27 17:43:56', 'payments.show', 83),
(134, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:43:56', '2026-01-27 17:43:56', 'payments.show', 83),
(135, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:43:56', '2026-01-27 17:43:56', 'payments.show', 83),
(136, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:55:17', '2026-01-27 17:55:17', 'payments.show', 85),
(137, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:55:17', '2026-01-27 17:55:17', 'payments.show', 85),
(138, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:55:17', '2026-01-27 17:55:17', 'payments.show', 85),
(139, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:55:39', '2026-01-27 17:55:39', 'payments.show', 86),
(140, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:55:39', '2026-01-27 17:55:39', 'payments.show', 86),
(141, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 17:55:39', '2026-01-27 17:55:39', 'payments.show', 86),
(142, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:04:53', '2026-01-27 18:04:53', 'payments.show', 88),
(143, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:04:53', '2026-01-27 18:04:53', 'payments.show', 88),
(144, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:04:53', '2026-01-27 18:04:53', 'payments.show', 88),
(145, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:05:06', '2026-01-27 18:05:06', 'payments.show', 89),
(146, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:05:06', '2026-01-27 18:05:06', 'payments.show', 89),
(147, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:05:06', '2026-01-27 18:05:06', 'payments.show', 89),
(148, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:12:49', '2026-01-27 18:12:49', 'payments.show', 91),
(149, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:12:49', '2026-01-27 18:12:49', 'payments.show', 91),
(150, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-27 18:12:49', '2026-01-27 18:12:49', 'payments.show', 91),
(151, 1, 'تم صرف مبلغ : 2000', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 4),
(152, 5, 'تم صرف مبلغ : 2000', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 4),
(153, 6, 'تم صرف مبلغ : 2000', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 4),
(154, 1, 'تم صرف مبلغ : 1200', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 5),
(155, 5, 'تم صرف مبلغ : 1200', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 5),
(156, 6, 'تم صرف مبلغ : 1200', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 5),
(157, 1, 'تم صرف مبلغ : 1500', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 6),
(158, 5, 'تم صرف مبلغ : 1500', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 6),
(159, 6, 'تم صرف مبلغ : 1500', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 6),
(160, 1, 'تم صرف مبلغ : 1200', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 7),
(161, 5, 'تم صرف مبلغ : 1200', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 7),
(162, 6, 'تم صرف مبلغ : 1200', 0, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 'sarfs.show', 7),
(163, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 12:53:59', '2026-01-31 12:53:59', 'payments.show', 94),
(164, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 12:53:59', '2026-01-31 12:53:59', 'payments.show', 94),
(165, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 12:53:59', '2026-01-31 12:53:59', 'payments.show', 94),
(166, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 12:54:18', '2026-01-31 12:54:18', 'payments.show', 95),
(167, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 12:54:18', '2026-01-31 12:54:18', 'payments.show', 95),
(168, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 12:54:18', '2026-01-31 12:54:18', 'payments.show', 95),
(169, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:06:31', '2026-01-31 13:06:31', 'payments.show', 96),
(170, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:06:31', '2026-01-31 13:06:31', 'payments.show', 96),
(171, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:06:31', '2026-01-31 13:06:31', 'payments.show', 96),
(172, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:06:50', '2026-01-31 13:06:50', 'payments.show', 97),
(173, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:06:50', '2026-01-31 13:06:50', 'payments.show', 97),
(174, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:06:50', '2026-01-31 13:06:50', 'payments.show', 97),
(175, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:11:29', '2026-01-31 13:11:29', 'payments.show', 98),
(176, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:11:29', '2026-01-31 13:11:29', 'payments.show', 98),
(177, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:11:29', '2026-01-31 13:11:29', 'payments.show', 98),
(178, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:19:22', '2026-01-31 13:19:22', 'payments.show', 100),
(179, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:19:22', '2026-01-31 13:19:22', 'payments.show', 100),
(180, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:19:22', '2026-01-31 13:19:22', 'payments.show', 100),
(181, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:19:37', '2026-01-31 13:19:37', 'payments.show', 101),
(182, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:19:37', '2026-01-31 13:19:37', 'payments.show', 101),
(183, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 13:19:37', '2026-01-31 13:19:37', 'payments.show', 101),
(184, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 15:48:50', '2026-01-31 15:48:50', 'payments.show', 102),
(185, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 15:48:50', '2026-01-31 15:48:50', 'payments.show', 102),
(186, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 15:48:50', '2026-01-31 15:48:50', 'payments.show', 102),
(187, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 15:50:43', '2026-01-31 15:50:43', 'payments.show', 103),
(188, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 15:50:43', '2026-01-31 15:50:43', 'payments.show', 103),
(189, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 15:50:43', '2026-01-31 15:50:43', 'payments.show', 103),
(190, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:00:28', '2026-01-31 16:00:28', 'payments.show', 106),
(191, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:00:28', '2026-01-31 16:00:28', 'payments.show', 106),
(192, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:00:28', '2026-01-31 16:00:28', 'payments.show', 106),
(193, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:00:56', '2026-01-31 16:00:56', 'payments.show', 107),
(194, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:00:56', '2026-01-31 16:00:56', 'payments.show', 107),
(195, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:00:56', '2026-01-31 16:00:56', 'payments.show', 107),
(196, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:06:37', '2026-01-31 16:06:37', 'payments.show', 108),
(197, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:06:37', '2026-01-31 16:06:37', 'payments.show', 108),
(198, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:06:37', '2026-01-31 16:06:37', 'payments.show', 108),
(199, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:07:23', '2026-01-31 16:07:23', 'payments.show', 109),
(200, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:07:23', '2026-01-31 16:07:23', 'payments.show', 109),
(201, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:07:23', '2026-01-31 16:07:23', 'payments.show', 109),
(202, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:24:34', '2026-01-31 16:24:34', 'payments.show', 110),
(203, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:24:34', '2026-01-31 16:24:34', 'payments.show', 110),
(204, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:24:34', '2026-01-31 16:24:34', 'payments.show', 110),
(205, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:24:55', '2026-01-31 16:24:55', 'payments.show', 111),
(206, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:24:55', '2026-01-31 16:24:55', 'payments.show', 111),
(207, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:24:55', '2026-01-31 16:24:55', 'payments.show', 111),
(208, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:25:21', '2026-01-31 16:25:21', 'payments.show', 112),
(209, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:25:21', '2026-01-31 16:25:21', 'payments.show', 112),
(210, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:25:21', '2026-01-31 16:25:21', 'payments.show', 112),
(211, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:32:40', '2026-01-31 16:32:40', 'payments.show', 114),
(212, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:32:40', '2026-01-31 16:32:40', 'payments.show', 114),
(213, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:32:40', '2026-01-31 16:32:40', 'payments.show', 114),
(214, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:33:10', '2026-01-31 16:33:10', 'payments.show', 115),
(215, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:33:10', '2026-01-31 16:33:10', 'payments.show', 115),
(216, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:33:10', '2026-01-31 16:33:10', 'payments.show', 115),
(217, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:48:34', '2026-01-31 16:48:34', 'payments.show', 118),
(218, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:48:34', '2026-01-31 16:48:34', 'payments.show', 118),
(219, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 16:48:34', '2026-01-31 16:48:34', 'payments.show', 118),
(220, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:25:01', '2026-01-31 17:25:01', 'payments.show', 122),
(221, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:25:01', '2026-01-31 17:25:01', 'payments.show', 122),
(222, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:25:01', '2026-01-31 17:25:01', 'payments.show', 122),
(223, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:25:21', '2026-01-31 17:25:21', 'payments.show', 123),
(224, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:25:21', '2026-01-31 17:25:21', 'payments.show', 123),
(225, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:25:21', '2026-01-31 17:25:21', 'payments.show', 123),
(226, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:47:02', '2026-01-31 17:47:02', 'payments.show', 124),
(227, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:47:02', '2026-01-31 17:47:02', 'payments.show', 124),
(228, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:47:02', '2026-01-31 17:47:02', 'payments.show', 124),
(229, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:47:31', '2026-01-31 17:47:31', 'payments.show', 125),
(230, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:47:31', '2026-01-31 17:47:31', 'payments.show', 125),
(231, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 17:47:31', '2026-01-31 17:47:31', 'payments.show', 125),
(232, 1, 'تم استلام مبلغ نقدي', 0, '2026-01-31 18:08:54', '2026-01-31 18:08:54', 'payments.show', 126),
(233, 5, 'تم استلام مبلغ نقدي', 0, '2026-01-31 18:08:54', '2026-01-31 18:08:54', 'payments.show', 126),
(234, 6, 'تم استلام مبلغ نقدي', 0, '2026-01-31 18:08:54', '2026-01-31 18:08:54', 'payments.show', 126),
(235, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 17:53:49', '2026-02-01 17:53:49', 'payments.show', 92),
(236, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 17:53:49', '2026-02-01 17:53:49', 'payments.show', 92),
(237, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 17:53:49', '2026-02-01 17:53:49', 'payments.show', 92),
(238, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 17:54:23', '2026-02-01 17:54:23', 'payments.show', 99),
(239, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 17:54:23', '2026-02-01 17:54:23', 'payments.show', 99),
(240, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 17:54:23', '2026-02-01 17:54:23', 'payments.show', 99),
(241, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:29:20', '2026-02-01 18:29:20', 'payments.show', 130),
(242, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:29:20', '2026-02-01 18:29:20', 'payments.show', 130),
(243, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:29:20', '2026-02-01 18:29:20', 'payments.show', 130),
(244, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:29:38', '2026-02-01 18:29:38', 'payments.show', 131),
(245, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:29:38', '2026-02-01 18:29:38', 'payments.show', 131),
(246, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:29:38', '2026-02-01 18:29:38', 'payments.show', 131),
(247, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:37:36', '2026-02-01 18:37:36', 'payments.show', 132),
(248, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:37:36', '2026-02-01 18:37:36', 'payments.show', 132),
(249, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:37:36', '2026-02-01 18:37:36', 'payments.show', 132),
(250, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:37:55', '2026-02-01 18:37:55', 'payments.show', 133),
(251, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:37:55', '2026-02-01 18:37:55', 'payments.show', 133),
(252, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:37:55', '2026-02-01 18:37:55', 'payments.show', 133),
(253, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:42:52', '2026-02-01 18:42:52', 'payments.show', 134),
(254, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:42:52', '2026-02-01 18:42:52', 'payments.show', 134),
(255, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:42:52', '2026-02-01 18:42:52', 'payments.show', 134),
(256, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:43:07', '2026-02-01 18:43:07', 'payments.show', 135),
(257, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:43:07', '2026-02-01 18:43:07', 'payments.show', 135),
(258, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-01 18:43:07', '2026-02-01 18:43:07', 'payments.show', 135),
(259, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 16:46:08', '2026-02-02 16:46:08', 'payments.show', 136),
(260, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 16:46:08', '2026-02-02 16:46:08', 'payments.show', 136),
(261, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 16:46:08', '2026-02-02 16:46:08', 'payments.show', 136),
(262, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:09:21', '2026-02-02 18:09:21', 'payments.show', 138),
(263, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:09:21', '2026-02-02 18:09:21', 'payments.show', 138),
(264, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:09:21', '2026-02-02 18:09:21', 'payments.show', 138),
(265, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:10:33', '2026-02-02 18:10:33', 'payments.show', 139),
(266, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:10:33', '2026-02-02 18:10:33', 'payments.show', 139),
(267, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:10:33', '2026-02-02 18:10:33', 'payments.show', 139),
(268, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:46:08', '2026-02-02 18:46:08', 'payments.show', 141),
(269, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:46:08', '2026-02-02 18:46:08', 'payments.show', 141),
(270, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:46:08', '2026-02-02 18:46:08', 'payments.show', 141),
(271, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:46:31', '2026-02-02 18:46:31', 'payments.show', 142),
(272, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:46:31', '2026-02-02 18:46:31', 'payments.show', 142),
(273, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:46:31', '2026-02-02 18:46:31', 'payments.show', 142),
(274, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:51:36', '2026-02-02 18:51:36', 'payments.show', 143),
(275, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:51:36', '2026-02-02 18:51:36', 'payments.show', 143),
(276, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:51:36', '2026-02-02 18:51:36', 'payments.show', 143),
(277, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:53:26', '2026-02-02 18:53:26', 'payments.show', 144),
(278, 5, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:53:26', '2026-02-02 18:53:26', 'payments.show', 144),
(279, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-02 18:53:26', '2026-02-02 18:53:26', 'payments.show', 144),
(280, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:10:48', '2026-02-04 15:10:48', 'payments.show', 63),
(281, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:10:48', '2026-02-04 15:10:48', 'payments.show', 63),
(282, 7, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:10:48', '2026-02-04 15:10:48', 'payments.show', 63),
(283, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:48:15', '2026-02-04 15:48:15', 'payments.show', 104),
(284, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:48:15', '2026-02-04 15:48:15', 'payments.show', 104),
(285, 7, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:48:15', '2026-02-04 15:48:15', 'payments.show', 104),
(286, 1, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:50:31', '2026-02-04 15:50:31', 'payments.show', 145),
(287, 6, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:50:31', '2026-02-04 15:50:31', 'payments.show', 145),
(288, 7, 'تم استلام مبلغ نقدي', 0, '2026-02-04 15:50:31', '2026-02-04 15:50:31', 'payments.show', 145);

-- --------------------------------------------------------

--
-- بنية الجدول `ohdas`
--

CREATE TABLE `ohdas` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `raseed` decimal(11,0) NOT NULL DEFAULT 0,
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
(1, 1, 'عهدة شهر يناير 2026', 15850, '2026-01-23 16:22:47', '2026-01-31 12:34:47', NULL, NULL, 'حساب وصية صدقي', 'م/  عدنان شيخ', '2026-01-03', '1389/10/23', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `ohdas_operations`
--

CREATE TABLE `ohdas_operations` (
  `id` int(11) NOT NULL,
  `ohda_id` int(11) NOT NULL,
  `op_type` varchar(1) NOT NULL,
  `sarf_id` int(11) DEFAULT NULL,
  `amount` decimal(11,0) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_amount` decimal(11,0) DEFAULT NULL,
  `masder` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ohdas_operations`
--

INSERT INTO `ohdas_operations` (`id`, `ohda_id`, `op_type`, `sarf_id`, `amount`, `created_at`, `updated_at`, `last_amount`, `masder`) VALUES
(1, 1, '-', 1, 7000, '2026-01-23 16:27:27', '2026-01-23 16:27:27', 30000, 'الدفعة الثانية من تعاقد إنشـــاء وتصميم برنامج إدارة أملاك أوقاف إبراهيم صدقي .'),
(2, 1, '-', 2, 1300, '2026-01-23 16:35:36', '2026-01-23 16:35:36', 23000, 'نظير أعمال تغير ماسورة الصرف بطول 6 متر شاملة أجور التغير والتركيب و مواد السباكة ، عمارة العزيزية خلف فاين لوك .'),
(3, 1, '+', 3, 50, '2026-01-23 16:38:15', '2026-01-23 16:38:15', 21700, 'بيع مواد - بيع أسلاك رفع كابينة المصعد حديد تالف ( عمارة عبدالله خيـاط ) .'),
(4, 1, '-', 4, 2000, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 21750, NULL),
(5, 1, '-', 5, 1200, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 19750, NULL),
(6, 1, '-', 6, 1500, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 18550, NULL),
(7, 1, '-', 7, 1200, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 17050, NULL);

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
  `amount` decimal(11,0) NOT NULL,
  `amount_txt` text DEFAULT NULL,
  `payment_no` int(11) DEFAULT NULL,
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
  `remender_amount` decimal(11,0) DEFAULT NULL,
  `payment_for` int(11) DEFAULT NULL,
  `payment_status` enum('pending','paid','cancelled') DEFAULT 'pending',
  `cancel_reason` varchar(100) DEFAULT NULL,
  `receved_by` text DEFAULT 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payments`
--

INSERT INTO `payments` (`id`, `contract_id`, `p_date`, `p_dateh`, `amount`, `amount_txt`, `payment_no`, `emp_id`, `payment_type`, `status`, `year_m`, `year_h`, `sereal`, `actual_date`, `actual_dateh`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `is_for_sale_product`, `product_desc`, `maincenter_id`, `center_id`, `unit_id`, `remender_amount`, `payment_for`, `payment_status`, `cancel_reason`, `receved_by`) VALUES
(22, 7, '2025-10-23', '1447/05/01', 200000, ' مئتان ألف ريال لاغير', 1, NULL, 1, 1, '23', '45', 1, '2023-10-23', '1445-04-08', 'الدفعة المقدمة (العربون)', '2026-01-24 16:49:07', '2026-01-24 16:53:23', 6, 6, NULL, 0, NULL, 3, 7, NULL, 0, 5, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(24, 7, '2026-04-23', '1447/11/06', 230000, ' مئتان وثلاثون ألف ريال لاغير', 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(25, 7, '2026-10-22', '1448/05/11', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(26, 7, '2027-04-22', '1448/11/15', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 5, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(27, 7, '2027-10-21', '1449/05/21', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 6, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(28, 7, '2028-04-20', '1449/11/25', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 7, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(29, 7, '2028-10-19', '1450/06/01', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 8, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(30, 7, '2029-04-19', '1450/12/05', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 9, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(31, 7, '2029-10-18', '1451/06/10', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 10, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(32, 7, '2030-04-18', '1451/12/15', 215000, ' مئتان وخمسة عشر ألفًا ريال لاغير', 11, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 16:49:07', '2026-01-24 16:49:07', 6, NULL, NULL, 0, NULL, 3, 7, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(40, 9, '2026-02-10', '1447/08/22', 41000, ' احد أربعون ألف ريال لاغير', 1, NULL, 2, 1, '26', '47', 1, '2026-01-20', '1447-08-01', 'دفعة ايجار', '2026-01-24 17:44:56', '2026-01-24 17:46:35', 6, 6, NULL, 0, NULL, 1, 5, 36, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(41, 9, '2026-08-10', '1448/02/27', 41000, ' احد أربعون ألف ريال لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 17:44:56', '2026-01-24 17:44:56', 6, NULL, NULL, 0, NULL, 1, 5, 36, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(42, 9, '2027-02-10', '1448/09/03', 41000, ' احد أربعون ألف ريال لاغير', 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 17:44:56', '2026-01-24 17:44:56', 6, NULL, NULL, 0, NULL, 1, 5, 36, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(43, 9, '2027-08-10', '1449/03/08', 41000, ' احد أربعون ألف ريال لاغير', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-24 17:44:56', '2026-01-24 17:44:56', 6, NULL, NULL, 0, NULL, 1, 5, 36, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(44, 10, '2025-07-26', '1447/02/01', 335010, ' ثلاثمائة وخمسة وثلاثون ألفًا وعشرة ريال لاغير', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(45, 10, '2026-07-26', '1448/02/12', 323569, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وتسعة وستون ريالاً لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(46, 10, '2027-07-26', '1449/02/22', 323569, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وتسعة وستون ريالاً لاغير', 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(47, 10, '2028-07-26', '1450/03/04', 323569, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وتسعة وستون ريالاً لاغير', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(48, 10, '2029-07-26', '1451/03/14', 323569, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وتسعة وستون ريالاً لاغير', 5, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(49, 10, '2030-07-26', '1452/03/25', 323569, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وتسعة وستون ريالاً لاغير', 6, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(50, 10, '2031-07-26', '1453/04/06', 323569, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وتسعة وستون ريالاً لاغير', 7, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(51, 10, '2032-07-26', '1454/04/18', 323575, ' ثلاثمائة وثلاثة وعشرون ألفًا وخمسمائة وخمسة وسبعون ريالاً لاغير', 8, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-26 16:02:24', '2026-01-26 16:02:24', 6, NULL, NULL, 0, NULL, 4, 8, NULL, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(53, 11, '2025-07-01', '1447/01/06', 13150, ' ثلاثة عشر ألفًا ومائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 1, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-26 16:21:26', '2026-01-26 16:22:11', 6, 6, NULL, 0, NULL, 1, 2, 7, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(54, 11, '2026-01-01', '1447/07/12', 12500, ' اثنا عشر ألفًا وخمسمائة ريال لاغير', 2, NULL, 5, 1, '26', '47', 2, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-26 16:21:26', '2026-01-26 16:22:51', 6, 6, NULL, 0, NULL, 1, 2, 7, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(57, 13, '2025-07-01', '1447/01/06', 9650, ' تسعة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 2, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 15:53:54', '2026-01-27 15:56:06', 6, 6, NULL, 0, NULL, 1, 2, 5, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(58, 13, '2026-01-01', '1447-07-12', 9000, ' تسعة آلاف ريال لاغير', 2, NULL, NULL, 1, '26', '47', 3, '2026-01-10', '1447-07-21', 'دفعة ايجار', '2026-01-27 15:53:54', '2026-01-27 16:17:37', 6, 6, NULL, 0, NULL, 1, 2, 5, -9000, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(63, 15, '2025-07-01', '1447/01/06', 10650, 'فقط عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 30, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 16:16:28', '2026-02-04 15:10:48', 6, 6, NULL, 0, NULL, 1, 2, 9, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(64, 15, '2026-01-01', '1447/07/12', 10000, ' عشرة آلاف ريال لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-27 16:16:28', '2026-01-27 16:16:28', 6, NULL, NULL, 0, NULL, 1, 2, 9, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(69, 17, '2025-07-01', '1447/01/06', 11650, ' احد عشر ألفًا وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 4, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 16:42:48', '2026-01-27 16:43:12', 6, 6, NULL, 0, NULL, 1, 2, 8, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(70, 17, '2026-01-01', '1447/07/12', 11000, ' احد عشر ألف ريال لاغير', 2, NULL, 5, 1, '26', '47', 5, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-27 16:42:48', '2026-01-27 16:43:59', 6, 6, NULL, 0, NULL, 1, 2, 8, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(79, 19, '2025-07-01', '1447/01/06', 10650, ' عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 5, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 17:06:52', '2026-01-27 17:07:30', 6, 6, NULL, 0, NULL, 1, 2, 11, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(80, 19, '2026-01-01', '1447/07/12', 10000, ' عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 6, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-27 17:06:52', '2026-01-27 17:07:48', 6, 6, NULL, 0, NULL, 1, 2, 11, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(82, 20, '2025-07-01', '1447/01/06', 10650, ' عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 6, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 17:42:59', '2026-01-27 17:43:33', 6, 6, NULL, 0, NULL, 1, 5, 4, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(83, 20, '2026-01-01', '1447/07/12', 10000, ' عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 7, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-27 17:42:59', '2026-01-27 17:43:56', 6, 6, NULL, 0, NULL, 1, 5, 4, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(85, 21, '2025-07-01', '1447/01/06', 10650, ' عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 7, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 17:54:30', '2026-01-27 17:55:17', 6, 6, NULL, 0, NULL, 1, 5, 28, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(86, 21, '2026-01-01', '1447/07/12', 10000, ' عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 8, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-27 17:54:30', '2026-01-27 17:55:39', 6, 6, NULL, 0, NULL, 1, 5, 28, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(91, 23, '2025-07-01', '1447/01/06', 10650, ' عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 8, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-27 18:12:25', '2026-01-27 18:12:49', 6, 6, NULL, 0, NULL, 1, 5, 29, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(92, 23, '2026-01-01', '1447/07/12', 10000, 'فقط عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 18, '2026-01-31', '1447-08-12', 'دفعة ايجار', '2026-01-27 18:12:25', '2026-02-01 17:53:49', 6, 6, NULL, 0, NULL, 1, 5, 29, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(94, 24, '2025-07-01', '1447/01/06', 10650, 'فقط عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 9, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-31 12:52:54', '2026-01-31 12:53:59', 6, 6, NULL, 0, NULL, 1, 5, 30, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(95, 24, '2026-01-01', '1447/07/12', 10000, 'فقط عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 9, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-31 12:52:54', '2026-01-31 12:54:18', 6, 6, NULL, 0, NULL, 1, 5, 30, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(96, 25, '2025-07-01', '1447/01/06', 10650, 'فقط عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 10, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-31 13:05:42', '2026-01-31 13:06:31', 6, 6, NULL, 0, NULL, 1, 5, 31, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(97, 25, '2025-12-30', '1447/07/10', 10000, 'فقط عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 10, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-31 13:05:42', '2026-01-31 13:06:50', 6, 6, NULL, 0, NULL, 1, 5, 31, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(98, 26, '2025-07-01', '1447/01/06', 10650, 'فقط عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 2, 1, '25', '47', 11, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-31 13:10:52', '2026-01-31 13:11:29', 6, 6, NULL, 0, NULL, 1, 5, 32, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(99, 26, '2025-12-30', '1447/07/10', 10000, 'فقط عشرة آلاف ريال لاغير', 2, NULL, 2, 1, '26', '47', 19, '2026-01-31', '1447-08-12', 'دفعة ايجار', '2026-01-31 13:10:52', '2026-02-01 17:54:23', 6, 6, NULL, 0, NULL, 1, 5, 32, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(100, 27, '2025-07-01', '1447/01/06', 10650, 'فقط عشرة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 12, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-31 13:18:57', '2026-01-31 13:19:22', 6, 6, NULL, 0, NULL, 1, 5, 33, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(101, 27, '2025-12-30', '1447/07/10', 10000, 'فقط عشرة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 11, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-01-31 13:18:57', '2026-01-31 13:19:37', 6, 6, NULL, 0, NULL, 1, 5, 33, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(102, 28, '2025-07-01', '1447/01/06', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 2, 1, '25', '47', 13, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-31 15:48:21', '2026-01-31 15:48:50', 6, 6, NULL, 0, NULL, 1, 6, 13, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(103, 28, '2025-12-30', '1447/07/10', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 2, NULL, 2, 1, '26', '47', 12, '2026-01-13', '1447-07-24', 'دفعة ايجار', '2026-01-31 15:48:21', '2026-01-31 15:50:43', 6, 6, NULL, 0, NULL, 1, 6, 13, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(104, 29, '2025-07-01', '1447/01/06', 7825, 'فقط سبعة آلاف وثمانمائة وخمسة وعشرون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 31, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-01-31 15:54:12', '2026-02-04 15:48:15', 6, 6, NULL, 0, NULL, 1, 6, 15, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(105, 29, '2026-01-01', '1447/07/12', 7825, 'فقط سبعة آلاف وثمانمائة وخمسة وعشرون ريالاً لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-31 15:54:12', '2026-01-31 15:54:12', 6, NULL, NULL, 0, NULL, 1, 6, 15, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(106, 30, '2025-07-01', '1447/01/06', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 14, '2025-07-26', '1447-02-01', 'دفعة ايجار', '2026-01-31 15:59:45', '2026-01-31 16:00:28', 6, 6, NULL, 0, NULL, 1, 6, 17, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(107, 30, '2026-01-01', '1447/07/12', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 2, NULL, 5, 1, '26', '47', 13, '2026-01-18', '1447-07-29', 'دفعة ايجار', '2026-01-31 15:59:45', '2026-01-31 16:00:56', 6, 6, NULL, 0, NULL, 1, 6, 17, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(108, 31, '2025-07-01', '1447/01/06', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 15, '2025-07-16', '1447-01-21', 'دفعة ايجار', '2026-01-31 16:05:44', '2026-01-31 16:06:37', 6, 6, NULL, 0, NULL, 1, 6, 18, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(109, 31, '2026-01-01', '1447/07/12', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 2, NULL, 5, 1, '26', '47', 14, '2026-01-04', '1447-07-15', 'دفعة ايجار', '2026-01-31 16:05:44', '2026-01-31 16:07:23', 6, 6, NULL, 0, NULL, 1, 6, 18, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(110, 32, '2025-10-01', '1447/04/09', 4400, 'فقط أربعة آلاف وأربعمائة ريال لاغير', 1, NULL, 5, 1, '25', '47', 16, '2025-07-11', '1447-01-16', 'دفعة ايجار', '2026-01-31 16:24:00', '2026-01-31 16:24:34', 6, 6, NULL, 0, NULL, 1, 6, 19, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(111, 32, '2026-01-01', '1447/07/12', 3750, 'فقط ثلاثة آلاف وسبعمائة وخمسون ريالاً لاغير', 2, NULL, 5, 1, '25', '47', 17, '2025-09-14', '1447-03-22', 'دفعة ايجار', '2026-01-31 16:24:00', '2026-01-31 16:24:55', 6, 6, NULL, 0, NULL, 1, 6, 19, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(112, 32, '2026-04-01', '1447/10/13', 3750, 'فقط ثلاثة آلاف وسبعمائة وخمسون ريالاً لاغير', 3, NULL, 5, 1, '25', '47', 18, '2025-12-13', '1447-06-22', 'دفعة ايجار', '2026-01-31 16:24:00', '2026-01-31 16:25:21', 6, 6, NULL, 0, NULL, 1, 6, 19, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(113, 32, '2026-07-01', '1448/01/16', 3750, 'فقط ثلاثة آلاف وسبعمائة وخمسون ريالاً لاغير', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-31 16:24:00', '2026-01-31 16:24:00', 6, NULL, NULL, 0, NULL, 1, 6, 19, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(114, 33, '2025-07-01', '1447/01/06', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 19, '2025-07-14', '1447-01-19', 'دفعة ايجار', '2026-01-31 16:31:51', '2026-01-31 16:32:40', 6, 6, NULL, 0, NULL, 1, 6, 20, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(115, 33, '2026-01-01', '1447/07/12', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 2, NULL, 5, 1, '26', '47', 15, '2026-01-07', '1447-07-18', 'دفعة ايجار', '2026-01-31 16:31:51', '2026-01-31 16:33:10', 6, 6, NULL, 0, NULL, 1, 6, 20, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(118, 35, '2025-08-01', '1447/02/07', 7525, 'فقط سبعة آلاف وخمسمائة وخمسة وعشرون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 20, '2025-08-02', '1447-02-08', 'دفعة ايجار', '2026-01-31 16:47:40', '2026-01-31 16:48:34', 6, 6, NULL, 0, NULL, 1, 6, 21, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(119, 35, '2026-02-01', '1447/08/13', 6875, 'فقط ستة آلاف وثمانمائة وخمسة وسبعون ريالاً لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-31 16:47:40', '2026-01-31 16:47:40', 6, NULL, NULL, 0, NULL, 1, 6, 21, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(122, 37, '2025-07-01', '1447/01/06', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 1, NULL, 5, 1, '25', '47', 21, '2025-09-03', '1447-03-11', 'دفعة ايجار', '2026-01-31 17:23:43', '2026-01-31 17:25:01', 6, 6, NULL, 0, NULL, 1, 6, 25, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(123, 37, '2026-01-01', '1447/07/12', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 2, NULL, 5, 1, '26', '47', 16, '2026-01-22', '1447-08-03', 'دفعة ايجار', '2026-01-31 17:23:43', '2026-01-31 17:25:21', 6, 6, NULL, 0, NULL, 1, 6, 25, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(124, 38, '2025-07-01', '1447/01/06', 15650, 'فقط خمسة عشر ألفًا وستمائة وخمسون ريالاً لاغير', 1, NULL, 2, 1, '25', '47', 22, '2025-07-31', '1447-02-06', 'دفعة ايجار', '2026-01-31 17:45:46', '2026-01-31 17:47:02', 6, 6, NULL, 0, NULL, 1, 6, 35, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(125, 38, '2026-01-01', '1447/07/12', 15000, 'فقط خمسة عشر ألف ريال لاغير', 2, NULL, 2, 1, '26', '47', 17, '2026-01-18', '1447-07-29', 'دفعة ايجار', '2026-01-31 17:45:46', '2026-01-31 17:47:31', 6, 6, NULL, 0, NULL, 1, 6, 35, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(126, 39, '2025-10-01', '1447/04/09', 15487, 'فقط خمسة عشر ألفًا وأربعمائة وسبعة وثمانون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 23, '2025-10-11', '1447-04-19', 'دفعة ايجار', '2026-01-31 18:03:29', '2026-01-31 18:08:54', 6, 6, NULL, 0, NULL, 1, 6, 34, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(127, 39, '2026-07-01', '1448/01/16', 10325, 'فقط عشرة آلاف وثلاثمائة وخمسة وعشرون ريالاً لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-31 18:03:29', '2026-01-31 18:03:29', 6, NULL, NULL, 0, NULL, 1, 6, 34, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(128, 39, '2027-01-01', '1448/07/23', 10325, 'فقط عشرة آلاف وثلاثمائة وخمسة وعشرون ريالاً لاغير', 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-31 18:03:29', '2026-01-31 18:03:29', 6, NULL, NULL, 0, NULL, 1, 6, 34, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(129, 39, '2027-07-01', '1449/01/26', 10325, 'فقط عشرة آلاف وثلاثمائة وخمسة وعشرون ريالاً لاغير', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-01-31 18:03:29', '2026-01-31 18:03:29', 6, NULL, NULL, 0, NULL, 1, 6, 34, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(130, 40, '2025-07-01', '1447/01/06', 6650, 'فقط ستة آلاف وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 24, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-02-01 18:28:13', '2026-02-01 18:29:20', 6, 6, NULL, 0, NULL, 1, 9, 37, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(131, 40, '2025-12-30', '1447/07/10', 6000, 'فقط ستة آلاف ريال لاغير', 2, NULL, 5, 1, '26', '47', 20, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-02-01 18:28:13', '2026-02-01 18:29:38', 6, 6, NULL, 0, NULL, 1, 9, 37, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(132, 41, '2025-07-01', '1447/01/06', 15650, 'فقط خمسة عشر ألفًا وستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 25, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-02-01 18:36:41', '2026-02-01 18:37:36', 6, 6, NULL, 0, NULL, 1, 9, 38, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(133, 41, '2026-01-01', '1447/07/12', 15000, 'فقط خمسة عشر ألف ريال لاغير', 2, NULL, 5, 1, '26', '47', 21, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-02-01 18:36:41', '2026-02-01 18:37:55', 6, 6, NULL, 0, NULL, 1, 9, 38, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(134, 42, '2025-07-01', '1447/01/06', 7150, 'فقط سبعة آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 26, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-02-01 18:42:30', '2026-02-01 18:42:52', 6, 6, NULL, 0, NULL, 1, 9, 39, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(135, 42, '2026-01-01', '1447/07/12', 6500, 'فقط ستة آلاف وخمسمائة ريال لاغير', 2, NULL, 5, 1, '26', '47', 22, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-02-01 18:42:30', '2026-02-01 18:43:07', 6, 6, NULL, 0, NULL, 1, 9, 39, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(136, 43, '2026-02-01', '1447-08-13', 6355, 'فقط ستة آلاف وثلاثمائة وخمسة وخمسون ريالاً لاغير', 1, NULL, NULL, 1, '26', '47', 23, '2026-02-01', '1447-08-13', 'دفعة ايجار', '2026-02-02 16:44:19', '2026-02-02 17:10:48', 6, 6, NULL, 0, NULL, 1, 6, 40, -6355, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(137, 43, '2026-08-01', '1448-02-18', 5295, 'فقط خمسة آلاف ومئتان وخمسة وتسعون ريالاً لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-02-02 16:44:19', '2026-02-02 17:11:50', 6, 6, NULL, 0, NULL, 1, 6, 40, -5295, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(138, 44, '2025-07-01', '1447-01-06', 5150, 'فقط خمسة آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, NULL, 1, '25', '47', 27, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-02-02 18:08:45', '2026-02-02 18:09:57', 6, 6, NULL, 0, NULL, 1, 6, 27, -5150, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(139, 44, '2026-01-01', '1447/07/12', 4140, 'فقط أربعة آلاف ومائة وأربعون ريالاً لاغير', 2, NULL, 2, 1, '26', '47', 24, '2026-02-02', '1447-08-14', 'دفعة ايجار', '2026-02-02 18:08:45', '2026-02-02 18:10:33', 6, 6, NULL, 0, NULL, 1, 6, 27, 360, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(140, 44, '2026-01-01', '1447/07/12', 360, 'فقط أربعة آلاف وخمسمائة ريال لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة ايجار', '2026-02-02 18:10:33', '2026-02-02 18:10:33', 6, NULL, NULL, 0, NULL, 1, 6, 27, 360, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(141, 45, '2025-07-01', '1447/01/06', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 2, 1, '25', '47', 28, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-02-02 18:23:25', '2026-02-02 18:46:08', 6, 6, NULL, 0, NULL, 1, 6, 12, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(142, 45, '2026-01-01', '1447/07/12', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 2, NULL, 2, 1, '26', '47', 25, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-02-02 18:23:25', '2026-02-02 18:46:31', 6, 6, NULL, 0, NULL, 1, 6, 12, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(143, 46, '2025-07-01', '1447/01/06', 8150, 'فقط ثمانية آلاف ومائة وخمسون ريالاً لاغير', 1, NULL, 2, 1, '25', '47', 29, '2025-07-01', '1447-01-06', 'دفعة ايجار', '2026-02-02 18:49:27', '2026-02-02 18:51:36', 6, 6, NULL, 0, NULL, 1, 6, 14, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(144, 46, '2026-01-01', '1447/07/12', 7500, 'فقط سبعة آلاف وخمسمائة ريال لاغير', 2, NULL, 2, 1, '26', '47', 26, '2026-01-01', '1447-07-12', 'دفعة ايجار', '2026-02-02 18:49:27', '2026-02-02 18:53:26', 6, 6, NULL, 0, NULL, 1, 6, 14, 0, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(145, 18, '2025-07-01', '1447/01/06', 650, 'فقط ستمائة وخمسون ريالاً لاغير', 1, NULL, 5, 1, '25', '47', 32, '2025-07-01', '1447-01-06', 'قيمة الخدمات', '2026-02-04 15:46:53', '2026-02-04 15:50:31', 6, 6, NULL, 0, NULL, 1, 2, 10, 0, 3, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(146, 18, '2025-07-01', '1447/01/06', 5325, 'فقط خمسة آلاف وثلاثمائة وخمسة وعشرون ريالاً لاغير', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة إيجار', '2026-02-04 15:46:53', '2026-02-04 15:46:53', 6, NULL, NULL, 0, NULL, 1, 2, 10, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(147, 18, '2025-12-30', '1447/07/10', 5325, 'فقط خمسة آلاف وثلاثمائة وخمسة وعشرون ريالاً لاغير', 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة إيجار', '2026-02-04 15:46:53', '2026-02-04 15:46:53', 6, NULL, NULL, 0, NULL, 1, 2, 10, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي'),
(148, 18, '2026-06-30', '1448/01/15', 10000, 'فقط عشرة آلاف ريال لاغير', 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'دفعة إيجار', '2026-02-04 15:46:53', '2026-02-04 15:46:53', 6, NULL, NULL, 0, NULL, 1, 2, 10, NULL, 1, 'pending', NULL, 'وصية أوقاف إبراهيم صدقي محمد سعيد أفندي');

-- --------------------------------------------------------

--
-- بنية الجدول `payment_for`
--

CREATE TABLE `payment_for` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payment_for`
--

INSERT INTO `payment_for` (`id`, `name`, `description`) VALUES
(1, 'دفعة ايجار', NULL),
(2, 'مبلغ تأمين', NULL),
(3, 'قيمة الخدمات', NULL),
(4, 'غرامة التأخير', NULL),
(5, 'دفعة مقدمة عربون', NULL);

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
(5, 'سداد منصة ايجار', NULL),
(6, 'محفظة الكترونية', NULL),
(7, 'سند صرف', NULL);

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

--
-- إرجاع أو استيراد بيانات الجدول `payrolls`
--

INSERT INTO `payrolls` (`id`, `emp_id`, `salary_year_month`, `basic_salary`, `other_allowance`, `deductions`, `other_allowance_purpose`, `deductions_purpose`, `net_salary`, `net_salary_txt`, `payment_type`, `payment_status`, `p_date`, `p_dateh`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2026/01', 2000, 0, 0, NULL, NULL, 2000, 'فقط ألفان ريال لاغير', 6, 1, '2026/01/31', '1447/08/12', 6, '2026-01-31 12:34:47', '2026-01-31 12:34:47'),
(2, 2, '2026/01', 1200, 0, 0, NULL, NULL, 1200, 'فقط ألف ومئتان ريال لاغير', 6, 1, '2026/01/31', '1447/08/12', 6, '2026-01-31 12:34:47', '2026-01-31 12:34:47'),
(3, 4, '2026/01', 1500, 0, 0, NULL, NULL, 1500, 'فقط ألف وخمسمائة ريال لاغير', 6, 1, '2026/01/31', '1447/08/12', 6, '2026-01-31 12:34:47', '2026-01-31 12:34:47'),
(4, 5, '2026/01', 1200, 0, 0, NULL, NULL, 1200, 'فقط ألف ومئتان ريال لاغير', 6, 1, '2026/01/31', '1447/08/12', 6, '2026-01-31 12:34:47', '2026-01-31 12:34:47');

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
  `other_no` varchar(250) DEFAULT NULL,
  `work_no` varchar(20) DEFAULT NULL,
  `work_letter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `renters`
--

INSERT INTO `renters` (`id`, `name`, `id_no`, `nationality`, `mobile_no`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `employer`, `id_type`, `other_no`, `work_no`, `work_letter`) VALUES
(2, 'شركة ديار التميز لمواد البناء', '4031273103', 148, '0550633111', 'مستأجر لعدد 3 محلات تجارية بعمارة عبدالله خيـاط', '2025-12-05 15:01:56', '2025-12-11 17:05:34', 1, 1, 'uploads/6331890b-b030-4302-a1bf-573322581695.pdf', NULL, 4, '0555076871', NULL, ''),
(4, 'مصطفى عزمي يحي القندح', '2147452276', 131, '0503701837', NULL, '2025-12-05 15:05:49', '2025-12-05 15:05:49', 1, NULL, 'uploads/086a691e-63f2-476c-91d6-caa2e323743a.jpg', NULL, 2, NULL, NULL, ''),
(5, 'هزاع سعد مطهر المسوري', '2443651084', 148, '0555419287', NULL, '2025-12-05 15:07:28', '2025-12-05 15:07:28', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(6, 'هانــي صــادق بجـــاش', '2258867320', 148, '0550633111', NULL, '2025-12-05 15:09:25', '2025-12-05 15:09:25', 1, NULL, 'uploads/2c94f5b2-4268-4b0d-a5a8-20cf26ca7d9a.pdf', 'شركة ديار التميز لمواد البناء - شريك', 2, NULL, NULL, ''),
(7, 'عبدربــه محمد أحمد الفقيـر المصعبي', '2175659339', 148, '0508232735', NULL, '2025-12-05 15:11:40', '2025-12-05 15:11:40', 1, NULL, '', NULL, 2, '0574759812', NULL, ''),
(8, 'علوي بن عبدالله مبارك اليـامي', '1134454204', 121, '0530282675', NULL, '2025-12-05 15:26:10', '2025-12-05 15:26:10', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(9, 'نزيــه عبدالقادر وحيد نسريني', '2013666801', 131, '0505512559', NULL, '2025-12-05 15:27:02', '2025-12-05 15:27:02', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(10, 'غلام صابررنـا محمد يعقوب رنـا', '2004911109', 109, '0504771347', NULL, '2025-12-05 15:32:29', '2025-12-05 15:32:29', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(11, 'حسين محمد حياني', '2017588860', 131, '0501610765', 'طبيب', '2025-12-05 15:34:10', '2026-01-27 17:16:27', 1, 6, 'uploads/27fed05b-a10b-4662-821c-d7eba42dc40f.jpg', NULL, 2, '0555572609', NULL, ''),
(12, 'أحمد السيد محمد مكـــــــاوي', '2312974385', 45, '0591624666', 'تم تقبيل عقد الايجار بينه وبين الدكتور أحمد أمين', '2025-12-05 15:35:29', '2026-01-18 17:00:53', 1, 6, 'uploads/7931dde8-e081-43dc-88a1-ef4a6df880fb.jpg', 'مهندس بشركة بن لادن', 2, '0', '0', ''),
(13, 'مجـدي محمـد القـــدح', '2015241249', 75, '0582270974 - 0555626836 - 0503564965', NULL, '2025-12-05 15:36:35', '2026-01-18 17:52:40', 1, 6, '', NULL, 2, NULL, NULL, ''),
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
(25, 'أحمد عبدالله أحمد علي البشـري', '2566004889', 148, '0543147004 - 0533303409', 'مستأجره قديمة بالعمارة  ، منظمة العقد بإسم حفيدها  ، تدفع الايجار بواقع 4 دفعات إيجابية حسب موافقة الناظر', '2025-12-05 16:27:50', '2026-01-18 17:53:54', 1, 6, 'uploads/31e45ac6-1915-4947-8aa1-b94cd476527b.jpg', NULL, 2, '0533303409', NULL, ''),
(26, 'علي محمد صالح السـقاف', '2160320087', 148, '0557012625 - 0561888005', NULL, '2025-12-05 16:36:06', '2025-12-05 16:36:06', 1, NULL, 'uploads/8ef76b2e-07df-4eb3-9db1-547530dd1fae.jpg', NULL, 2, NULL, NULL, ''),
(27, 'فهد عبدالرحمن فهد الملاعبه المطيري', '1004144935', 121, '0505226182', 'شقة شهيد الاسلام', '2025-12-05 17:47:43', '2025-12-10 16:18:19', 1, 1, 'uploads/3e540c6f-5052-4470-8edc-aa8a793b26a3.jpg', NULL, 1, '0539273551', NULL, ''),
(28, 'مهند علي معتوق لبــــــان', '1090489517', 121, '056730257', 'مطعم شهيد الاسلام', '2025-12-10 16:15:16', '2025-12-10 16:15:16', 1, NULL, 'uploads/a34a0cb1-55e6-48e1-a046-d60bf01c256d.jpg', NULL, 1, NULL, NULL, ''),
(29, 'سالمه بنت زيد ضيف الله الصبحــي', '1028388336', 121, '0561113229', 'ورشة التبريد', '2025-12-10 16:40:35', '2025-12-10 16:40:35', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(30, 'عمر محمد شهزاد محمد حسين', '2208761359', 109, '0567530528 - 0591689202 - 0530887219', NULL, '2025-12-10 16:42:21', '2025-12-10 17:08:05', 1, 1, 'uploads/ff166030-65a0-4247-aad9-88a3ec005183.jpg', NULL, 2, '0565020256 ( أخوه فوزان ) - 0509077556 ( جوال والدهم )', NULL, ''),
(31, 'سليمـان بن محزي بن جندوح الهلالي', '1072308602', 121, '0500173755 - 0559966739', NULL, '2025-12-10 16:50:47', '2025-12-10 16:50:47', 1, NULL, 'uploads/8886acd3-c9cf-4e57-96cb-45289fb198b1.pdf', NULL, 1, NULL, NULL, ''),
(32, 'عبيـد برغش عبيـد ظافـرال سرح الشهرانـي', '1004573737', 121, '0555741653 - 0583666246', 'صالون حلاقة', '2025-12-10 16:54:31', '2025-12-10 16:54:31', 1, NULL, 'uploads/a1904e99-ee87-4d6f-b1d7-0703e43a3832.JPG', NULL, 1, NULL, NULL, ''),
(33, 'ثامر مسعود مزيد الشلوي الحارثي', '‭‭1089207185‬‬', 121, '0555558840', 'بقالة الخنساء المتميزة للمواد الغذائية', '2025-12-10 17:30:28', '2025-12-10 17:30:28', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(34, 'خالد مسعود مزيد الشلوي الحارثي', '‭‭1007666603‬‬', 121, '0555558765', 'مطعم البروست', '2025-12-10 17:35:05', '2025-12-10 17:35:05', 1, NULL, 'uploads/05c4fb0b-eee3-4929-8356-c3cc413afec8.jpg', NULL, 1, NULL, NULL, ''),
(35, 'شركة مجموعة خدمات الطعــــام', '4030050359', 121, '0563880000', NULL, '2025-12-10 17:47:46', '2025-12-10 17:47:46', 1, NULL, '', NULL, 4, NULL, NULL, ''),
(36, 'نزيه عبدالقادر وحيد نسريني', '2013666801', 131, '0505512559', 'مستأجر شقة و غرفة لصالح أخيه', '2025-12-11 17:01:26', '2025-12-11 17:01:26', 1, NULL, '', NULL, 2, NULL, NULL, ''),
(37, 'شركة الشهاب الرائج', '2257050548', 14, '0510042037 - 0538244167', NULL, '2025-12-19 16:00:45', '2025-12-19 16:00:45', 1, NULL, 'uploads/16c6ad41-c025-4943-aa1e-73111a427718.jpg', 'شركة الشهاب الرائج', 2, NULL, NULL, ''),
(38, 'مراد بن مرزوق بن مبروك المطيرى', '1007619461', 121, '0560056955 - 0530314049 - 0540252012', 'مستثمر عمارة العزيزية  -  شارع الملك خالد ( الربـــــاط )', '2025-12-23 16:56:06', '2025-12-23 16:57:48', 1, 1, 'uploads/da0cc6d8-f87a-42aa-a157-b9b5fcedd761.jpg', NULL, 1, '0530314049 - 0540252012', NULL, ''),
(39, 'شركة مجموعة خدمات الطعام', '1006528242', 121, '0563880000', NULL, '2026-01-15 17:07:12', '2026-01-15 17:07:12', 1, NULL, '', NULL, 1, NULL, NULL, ''),
(40, 'محمد بن سعد بن جميل القرشي', '‭‭1001889417‬‬', 121, '0555554887', NULL, '2026-01-26 15:32:58', '2026-01-26 16:06:35', 6, 6, '', NULL, 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- بنية الجدول `renter_contacts`
--

CREATE TABLE `renter_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `renter_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `amount` decimal(11,0) NOT NULL,
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
(1, 2, '2026-01-10', '1447-07-21', 7000, ' سبعة آلاف ريال لاغير', 4, NULL, 1, '26', '47', 1, NULL, 1, NULL, 'الدفعة الثانية من تعاقد إنشـــاء وتصميم برنامج إدارة أملاك أوقاف إبراهيم صدقي .', 10, NULL, NULL, NULL, '2026-01-23 16:27:27', '2026-01-23 16:27:27', 6, NULL, 'uploads/b776c7ab-f0f5-45fa-931f-71eb8f0939fb.pdf', 'م /  فتحي محمـد سليمـان الخشــن', NULL),
(2, 2, '2026-01-19', '1447-07-30', 1300, ' ألف وثلاثمائة ريال لاغير', 4, NULL, 1, '26', '47', 2, NULL, 1, NULL, 'نظير أعمال تغير ماسورة الصرف بطول 6 متر شاملة أجور التغير والتركيب و مواد السباكة ، عمارة العزيزية خلف فاين لوك .', 2, NULL, 5, NULL, '2026-01-23 16:35:36', '2026-01-23 16:35:36', 6, NULL, 'uploads/4b9d1f0f-9b3f-4cf4-befc-b9a6186e76eb.pdf', 'عبدالرحمن الشرعبي -  السباك', NULL),
(3, 1, '2026-01-20', '1447-08-01', 50, ' خمسون ريالاً لاغير', 1, NULL, 1, '26', '47', 3, NULL, NULL, 1, 'بيع أسلاك رفع كابينة المصعد حديد تالف ( عمارة عبدالله خيـاط ) .', NULL, NULL, NULL, NULL, '2026-01-23 16:38:15', '2026-01-23 16:38:15', 6, NULL, NULL, 'وائل شيخ', NULL),
(4, 2, '2026/01/31', '1447/08/12', 2000, 'فقط ألفان ريال لاغير', 3, 1, 6, '26', '47', 4, NULL, 1, NULL, 'راتب شهر 2026/01', NULL, NULL, NULL, NULL, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 6, NULL, NULL, 'وائل شيخ', NULL),
(5, 2, '2026/01/31', '1447/08/12', 1200, 'فقط ألف ومئتان ريال لاغير', 3, 2, 6, '26', '47', 5, NULL, 1, NULL, 'راتب شهر 2026/01', NULL, NULL, NULL, NULL, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 6, NULL, NULL, 'خالد دوست', NULL),
(6, 2, '2026/01/31', '1447/08/12', 1500, 'فقط ألف وخمسمائة ريال لاغير', 3, 3, 6, '26', '47', 6, NULL, 1, NULL, 'راتب شهر 2026/01', NULL, NULL, NULL, NULL, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 6, NULL, NULL, 'محمد سبحان شيخ أمتياز أحمد', NULL),
(7, 2, '2026/01/31', '1447/08/12', 1200, 'فقط ألف ومئتان ريال لاغير', 3, 4, 6, '26', '47', 7, NULL, 1, NULL, 'راتب شهر 2026/01', NULL, NULL, NULL, NULL, '2026-01-31 12:34:47', '2026-01-31 12:34:47', 6, NULL, NULL, 'عبد الأمين دوست محمد', NULL);

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
(4, 'خدمات'),
(5, 'سلفة للموظف');

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
('1Nt3hahfODMexIgoHOwOcAOgwPxySlfW6ULzRI4E', NULL, '173.212.234.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRk4xZlQ0em1iaXRPdmFXdm9RM3U0bkVZMjJVN3RZRXN5bXR1TWNtSiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cHM6Ly9tYWlsLmFxYXJtYW5hZ2VyLmNvbSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwczovL21haWwuYXFhcm1hbmFnZXIuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770373982),
('IttediIkJs988TwtGnnM3ok6yrJNPJmXmsNfi5j2', NULL, '173.212.234.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlFkb0FCNHdWSGFXTTlSMkZTbG4ySUFGeGtNclc0cjVIRmRTMVdXeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFpbC5hcWFybWFuYWdlci5jb20vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1770373982),
('TMMI95XJ8OAV0L0TlgimUEWMTwJ7ZQ9IEVPFOw1t', NULL, '173.212.234.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTZPZm9rMlZtdEJKekEwd0JGWGh4aG1IRllzUUU2ZnRhcVlEd0oyeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vYXFhcm1hbmFnZXIuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770373980),
('VxPxSWhr4yzYEvzi49tgLAZMYvlg9zaWknu1sVZI', NULL, '173.212.234.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiallHU2RwbDNOVlp1ZlYyN0Z6c2x4VmxCbE9uSlZ4aW1UMmRPVVdVWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMzoiaHR0cHM6Ly9hcWFybWFuYWdlci5jb20iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMzoiaHR0cHM6Ly9hcWFybWFuYWdlci5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1770373980);

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
-- بنية الجدول `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `todos`
--

INSERT INTO `todos` (`id`, `title`, `description`, `is_done`, `due_date`, `created_at`, `updated_at`) VALUES
(3, 'تحصيل مبلغ تأمين شقة المهندس أحمد مكاوي', NULL, 0, '2026-03-05', '2026-02-04 15:39:46', '2026-02-04 15:39:46'),
(4, 'تحصيل مبلغ 360 ريال من ( نعمان ) ورشة التبريد بالزاهر باقي من ايجار الدفعة الثانية 2026', NULL, 0, '2026-02-08', '2026-02-04 15:40:50', '2026-02-04 15:40:50'),
(5, 'تذكير المهندس فتحي بخصوص فلتر ( السكان ) ممن دفع الدفعة الاولى أو الثانية أو كلاهما', NULL, 0, '2026-02-01', '2026-02-04 15:42:10', '2026-02-04 15:42:10');

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
(3, 2, 'غرفة واحدة', 2, NULL, '10067038657', 9, 'الأرضي', 1, 1, '1', '١', 'سكن عائلي', 'غرفة يسكن بهـا أخوه', '2025-12-05 17:57:40', '2026-01-16 15:46:41', 1, 6, '', NULL),
(4, 2, 'شقة عوائل', 5, NULL, '10066622163', 11, '1', 2, 1, '4', '2', NULL, NULL, '2025-12-10 18:08:20', '2026-01-27 17:17:48', 1, 6, 'uploads/0e4b30a1-b151-4410-9033-7a8c1cf02add.jpg', NULL),
(5, 2, 'سكن عوائل', 2, NULL, '10067039206', 4, 'الارضي', 2, 1, NULL, NULL, 'سكن عوائل', NULL, '2025-12-19 16:30:16', '2026-01-16 15:41:11', 1, 6, 'uploads/db302bdc-888a-4022-8699-ed553990c21f.jpg', NULL),
(6, 3, 'محلات تجارية', 2, NULL, '10067040234-10067037991-10067039725', 2, 'الأرضي', 3, 1, NULL, NULL, NULL, 'مستأجر لعدد3 محلات تجارية', '2026-01-15 17:35:32', '2026-01-15 17:37:43', 1, 1, '', NULL),
(7, 2, 'شقة سكنية', 2, '0', '10067042195', 36, '3', 7, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 15:40:10', '2026-01-16 15:50:18', 6, 6, '', NULL),
(8, 2, 'شقة سكنية', 2, NULL, '10067041161', 5, '1', 3, 1, '5', '3', 'سكن عائلي', NULL, '2026-01-16 15:54:43', '2026-01-16 15:54:43', 6, NULL, '', NULL),
(9, 2, 'شقة سكنية', 2, NULL, '10067042810', 6, '1', 4, 1, '5', '3', 'سكن عائلي', NULL, '2026-01-16 15:56:21', '2026-01-16 15:56:21', 6, NULL, '', NULL),
(10, 2, 'شقة سكنية', 2, NULL, '10067041625', 7, '2', 5, 1, '5', '3', 'سكن عائلي', NULL, '2026-01-16 15:57:36', '2026-01-16 15:57:36', 6, NULL, '', NULL),
(11, 2, 'شقة سكنية', 2, NULL, '10067043263', 8, '2', 6, 1, '5', '3', 'سكن عائلي', NULL, '2026-01-16 15:58:21', '2026-01-16 15:58:21', 6, NULL, '', NULL),
(12, 2, 'شقة سكنية', 6, NULL, '10064958950', 18, '1', 1, 1, '3', '2', 'سكن عوائل', 'المستأجر بدون عقد إلكتروني حتى تاريخ 30/06/2026', '2026-01-16 16:26:06', '2026-01-16 16:50:11', 6, 6, 'uploads/a902e124-4619-4c40-b012-eb6913870bb2.jpg', NULL),
(13, 2, 'شقة سكنية', 6, NULL, '10064958575', 19, '1', 2, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 16:27:28', '2026-01-16 16:27:28', 6, NULL, '', NULL),
(14, 2, 'شقة سكنية', 6, NULL, '10064958163', 20, '1', 3, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 16:32:11', '2026-01-16 16:32:11', 6, NULL, '', NULL),
(15, 2, 'شقة سكنية', 6, NULL, '10064957907', 21, '1', 4, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 16:33:47', '2026-01-16 16:33:47', 6, NULL, '', NULL),
(16, 2, 'شقة سكنية', 6, NULL, '10064957630', NULL, '2', 5, 1, '3', '2', 'سكن عائلي', 'شقة شاغرة', '2026-01-16 16:45:58', '2026-01-16 16:45:58', 6, NULL, '', NULL),
(17, 2, 'شقة سكنية', 6, NULL, '10064957353', 22, '2', 6, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 16:53:22', '2026-01-16 16:53:22', 6, NULL, 'uploads/77eab694-a19d-4d66-a4f9-09d56a0f6e7d.jpg', NULL),
(18, 2, 'شقة سكنية', 6, NULL, '10064957086', 23, '2', 7, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 16:57:46', '2026-01-16 16:57:46', 6, NULL, 'uploads/a606bc62-1b0d-41fa-b30d-9ee7176335ee.jpg', NULL),
(19, 2, 'شقة سكنية', 6, NULL, '10064956900', 25, '2', 8, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 16:59:41', '2026-01-16 16:59:41', 6, NULL, 'uploads/9c3f46a1-cbf2-412e-98f0-bece9a67300b.jpg', NULL),
(20, 2, 'شقة سكنية', 6, NULL, '10064956614', 26, '3', 9, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 17:00:53', '2026-01-16 17:00:53', 6, NULL, 'uploads/772dbbcc-25f0-4ee6-befe-6aec56e1df75.jpg', NULL),
(21, 2, 'شقة سكنية', 6, NULL, '10064956392', 27, '3', 10, 1, '3', '2', 'سكن عائلي', 'الساكن الفعلي شهيد الاسلام', '2026-01-16 17:33:37', '2026-01-16 17:33:37', 6, NULL, 'uploads/ee7e4b9a-cbb0-4711-8f6b-bcef0f021b1b.jpg', NULL),
(24, 2, 'شقة سكنية', 6, NULL, '10064956150', NULL, '3', 11, 1, '3', '2', 'سكن عائلي', 'شقة شاغرة', '2026-01-16 17:39:24', '2026-01-16 17:39:24', 6, NULL, '', NULL),
(25, 2, 'شقة سكنية', 6, NULL, '10064955902', 30, '3', 12, 1, '3', '2', 'سكن عائلي', NULL, '2026-01-16 17:41:09', '2026-01-16 17:41:09', 6, NULL, 'uploads/2d8f1c5e-b26c-4313-966b-36ef01994f19.jpg', NULL),
(27, 3, 'ورشة تبريـد', 6, '0', '10064864094', 29, 'الارضي', 1, 1, '0', '0', 'ورشة تبريـد', 'العامل نعمـــان 0592135890', '2026-01-18 16:41:24', '2026-02-02 17:32:56', 6, 6, '', NULL),
(28, 2, 'شقة سكنية', 5, NULL, '10066620964', 12, '1', 3, 1, '4', '2', 'سكن عائلي', 'تم تقبيل العقد بينه وبين الدكتور أحمد أمين لمدة 6 أشهر حتى تاريخ 30/06/2026', '2026-01-18 17:13:19', '2026-01-18 17:13:19', 6, NULL, 'uploads/1a0570ff-5f56-40fb-a82b-7023ee62be51.jpg', NULL),
(29, 2, 'شقة سكنية', 5, '0', '10066622664', 10, '2', 4, 1, '4', '2', 'سكن عائلي', NULL, '2026-01-18 17:14:56', '2026-01-18 17:14:56', 6, NULL, 'uploads/1350316c-d203-4f55-bedd-88f1a2cd8bc2.jpg', NULL),
(30, 2, 'شقة سكنية', 5, '0', '10066622664', 13, '2', 5, 1, '4', '2', 'سكن عائلي', NULL, '2026-01-18 17:17:56', '2026-01-18 17:17:56', 6, NULL, 'uploads/71650018-72b5-4bd1-9f38-ca114abc8b3f.jpg', NULL),
(31, 2, 'شقة سكنية', 5, '0', '10066621193', 17, '3', 6, 1, '4', '2', 'سكن عائلي', NULL, '2026-01-18 17:29:52', '2026-01-18 17:29:52', 6, NULL, 'uploads/db944723-e1f8-47d7-8fce-6493302981e1.jpg', NULL),
(32, 2, 'شقة سكنية', 5, '0', '10066621658', 15, '3', 7, 1, '4', '2', 'سكن عائلي', NULL, '2026-01-18 17:31:05', '2026-01-18 17:31:05', 6, NULL, '', NULL),
(33, 4, 'ملحق بالسطح', 5, '0', '10066622403', 16, 'ملحق', 8, 1, '2', '1', 'سكن عائلي', NULL, '2026-01-18 17:33:21', '2026-01-18 17:33:21', 6, NULL, '', NULL),
(34, 3, 'مطعم', 6, NULL, '30141342979 - 30141351001', 28, 'الارضي', 8, 1, '0', '0', 'مطعم مأكولات باكستانية', NULL, '2026-01-18 18:01:10', '2026-01-18 18:01:10', 6, NULL, 'uploads/fe7270e4-e425-40d4-b6bb-2a852d142832.jpg', NULL),
(35, 3, 'بقالة', 6, '0', '10064955493 - 10064864826 - 10064955724', 31, 'الارضي', 4, 1, '0', '0', 'بيع مواد غذائية', NULL, '2026-01-18 18:04:21', '2026-01-18 18:04:21', 6, NULL, '', NULL),
(36, 2, 'شركة خدمات الطعام', 5, NULL, '10066620731', 14, 'الأرضي', 1, 1, NULL, NULL, 'سكن عمال', NULL, '2026-01-24 17:37:30', '2026-01-24 17:37:30', 6, NULL, '', NULL),
(37, 3, 'محل تجاري', 9, '0', '30005038854', 32, 'الارضي', 2, 1, '0', '0', 'حلاق رجالي', NULL, '2026-02-01 18:19:51', '2026-02-01 18:19:51', 6, NULL, '', NULL),
(38, 3, 'محل تجاري', 9, '0', '30005124729 - 30005113734 - 30005113743', 33, 'الارضي', 1, 1, '0', '0', 'بقالة مواد غذائية', NULL, '2026-02-01 18:21:27', '2026-02-01 18:21:27', 6, NULL, '', NULL),
(39, 3, 'محل تجاري', 9, '0', '30005124738', 34, 'الارضي', 3, 1, '0', '0', 'مطعم بروست', NULL, '2026-02-01 18:22:33', '2026-02-01 18:22:33', 6, NULL, '', NULL),
(40, 6, 'مستودع', 6, '0', '0', 28, 'الارضي', 7, 1, '0', '0', 'مستودع +  سكن عمال', NULL, '2026-02-02 16:39:07', '2026-02-02 16:39:07', 6, NULL, '', NULL);

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
(6, 'مستودع', NULL),
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
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$R.Y5nWIBK/wGmmWdICae1eRyF7ZYyQ4IbiiURLSQhhUqwJ860i3Hu', 'IhcImouXOMhoKgdeen3DgqkhwdfbD3EFjvY7H8vnPnnUktwmT8gfgOgCyi1q', '2025-06-28 06:48:51', '2025-06-28 06:48:51', 1, ''),
(6, 'وائل شيخ', 'im-wael@hotmail.com', NULL, '$2y$12$hg5RLkr2N5n2qSq.11bbO.eEPFtsDXuOsJj41LgogeCZO4g5d0sM2', '8Et8aVzsbUzSX38EBkICUDLauRLhYHv6OuwA4G4WMObZMuu979N0qw4IEY9W', '2026-01-15 18:37:39', '2026-01-15 18:37:39', 1, '0509700028'),
(7, '‪Fathy Soliman‬', 'fathylogic@gmail.com', NULL, '$2y$12$EdWAghLYO5InIF10bASMoOqhx1RXqnhA0ub6xhclPALTrAwCEOu3G', NULL, '2026-02-03 17:32:31', '2026-02-03 17:32:31', 1, '0567842143');

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
-- فهارس للجدول `contract_events`
--
ALTER TABLE `contract_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id` (`contract_id`);

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
-- فهارس للجدول `payment_for`
--
ALTER TABLE `payment_for`
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
-- فهارس للجدول `renter_contacts`
--
ALTER TABLE `renter_contacts`
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
-- فهارس للجدول `todos`
--
ALTER TABLE `todos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `contract_events`
--
ALTER TABLE `contract_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `ohdas`
--
ALTER TABLE `ohdas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ohdas_operations`
--
ALTER TABLE `ohdas_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `othercontents`
--
ALTER TABLE `othercontents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `payment_for`
--
ALTER TABLE `payment_for`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `renter_contacts`
--
ALTER TABLE `renter_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sarfs`
--
ALTER TABLE `sarfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
