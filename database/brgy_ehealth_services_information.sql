-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 06:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brgy_ehealth_services_information`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `birth_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `born_weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `born_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'place where to born',
  `born_place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `is_record_done` tinyint(1) NOT NULL DEFAULT 0,
  `record_done_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `birth_order`, `firstname`, `middlename`, `lastname`, `birthdate`, `born_weight`, `born_at`, `born_place`, `gender`, `remarks`, `parent_id`, `is_record_done`, `record_done_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'Baby', 'Dela Pena', 'Dogomeo', '2020-05-07', '45', 'hospital', 'sagay city', 'male', NULL, 1, 1, NULL, '2021-01-19 19:26:17', '2021-01-19 19:26:17', NULL),
(2, '2', 'Gylexzy', 'Awaw', 'Morados', '2021-01-26', '2005', 'Health centerx', 'Sagay Cityx', 'male', 'this is sample remarks, data marked as complete', 2, 0, NULL, '2021-01-27 23:38:46', '2021-02-03 08:59:07', NULL),
(3, '1', 'child fname 1', 'child mname 1', 'child lname 1', '2021-02-13', '20', 'hospital', 'sagay city', 'male', NULL, 1, 0, NULL, '2019-02-12 16:00:00', '2021-02-11 16:00:00', NULL),
(4, '1', 'child fname 5', 'child mname 5', 'child lname 5', '2021-02-13', '20', 'hospital', 'sagay city', 'male', NULL, 1, 0, NULL, '2019-02-12 16:00:00', '2021-02-11 16:00:00', NULL),
(5, '1', 'child fname 2', 'child mname 2', 'child lname 2', '2021-02-13', '20', 'hospital', 'sagay city', 'male', NULL, 1, 0, NULL, '2020-02-12 16:00:00', '2021-02-11 16:00:00', NULL),
(6, '1', 'child fname 3', 'child mname 3', 'child lname 3', '2021-02-13', '20', 'hospital', 'sagay city', 'male', NULL, 1, 1, NULL, '2020-02-12 16:00:00', '2021-02-11 16:00:00', NULL),
(7, '1', 'child fname 4', 'child mname 4', 'child lname 4', '2021-02-13', '20', 'hospital', 'sagay city', 'male', NULL, 1, 1, NULL, '2020-02-12 16:00:00', '2021-02-11 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fathers`
--

CREATE TABLE `fathers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fathers`
--

INSERT INTO `fathers` (`id`, `firstname`, `middlename`, `lastname`, `birthdate`, `address`, `contact`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ronald', 'Recibido', 'Dogomeo', '1994-05-07', 'Sagay City, Neg. Occ.', '09469572178', '2021-01-08 06:21:54', '2021-01-08 06:21:54', NULL),
(2, 'kadong', 'naldo', 'Morados', '1994-05-07', 'wala lang', '325345', '2021-01-11 05:24:06', '2021-01-11 05:24:06', NULL),
(3, 'Ronaldo', 'Dogdog', 'Recibidos', '1998-04-18', 'Toboso, Neg. Occ.', '09469572178', '2021-01-11 19:33:41', '2021-01-18 18:21:30', NULL),
(4, 'Ronaldo', 'Dogdog', 'Recibido', '1998-04-18', 'Toboso, Neg. Occ.', '09787778668', '2021-01-11 22:00:37', '2021-01-11 22:00:37', NULL),
(5, 'Navin', 'unknown', 'Bendicio', '1992-10-20', 'Toboso, Neg. Occ.', '09469572178', '2021-01-16 20:31:41', '2021-01-16 20:31:41', NULL),
(6, 'Ronald', 'Recibido', 'sample1', '1994-05-07', 'Sagay City, neg. occ.', '09469572178', '2021-01-19 23:07:27', '2021-01-19 23:07:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_date` date DEFAULT NULL,
  `date_conduct` date DEFAULT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_at` enum('1st','2nd','3rd','4th','5th','6th') COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_status` enum('no-data','with-data') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'with-data',
  `children_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `immunizations`
--

INSERT INTO `immunizations` (`id`, `return_date`, `date_conduct`, `data`, `record_at`, `record_status`, `children_id`, `created_at`, `updated_at`) VALUES
(17, '2021-02-22', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-25\",\"return_date\":\"2021-02-22\",\"tags\":\"bcg\",\"vaccine_title\":\"BCG\",\"vaccine_dose\":\"1st\",\"baby_age\":\"Just born\",\"remarks\":null}', '1st', 'with-data', 2, '2021-01-31 04:35:51', '2021-01-31 04:47:10'),
(18, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"hepab\",\"vaccine_title\":\"HEPATITIS B\",\"vaccine_dose\":\"1st\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 2, '2021-01-31 04:35:56', '2021-01-31 04:35:56'),
(19, '2021-02-22', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-11\",\"return_date\":\"2021-02-22\",\"tags\":\"pv\",\"vaccine_title\":\"PENTAVALENT VACCINE (DPT-Hep B-HiB)\",\"vaccine_dose\":\"1st\",\"baby_age\":\"2 1\\/2 Months\",\"remarks\":\"<div>this is sample&nbsp;<\\/div>\"}', '1st', 'with-data', 2, '2021-01-31 04:36:20', '2021-02-02 02:24:50'),
(20, '2021-02-23', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-05\",\"return_date\":\"2021-02-23\",\"tags\":\"pv\",\"vaccine_title\":\"PENTAVALENT VACCINE (DPT-Hep B-HiB)\",\"vaccine_dose\":\"2nd\",\"baby_age\":\"2 1\\/2 Months\",\"remarks\":\"other sample\"}', '1st', 'with-data', 2, '2021-01-31 04:36:28', '2021-02-02 02:25:40'),
(21, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"pv\",\"vaccine_title\":\"PENTAVALENT VACCINE (DPT-Hep B-HiB)\",\"vaccine_dose\":\"3rd\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 2, '2021-01-31 04:36:33', '2021-01-31 04:36:33'),
(22, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"opv\",\"vaccine_title\":\"ORAL POLIO VACCINE (OPV)\",\"vaccine_dose\":\"1st\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 2, '2021-01-31 04:36:40', '2021-01-31 04:36:40'),
(23, '2021-02-22', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-20\",\"return_date\":\"2021-02-22\",\"tags\":\"opv\",\"vaccine_title\":\"ORAL POLIO VACCINE (OPV)\",\"vaccine_dose\":\"2nd\",\"baby_age\":\"2 1\\/2 Months\",\"remarks\":null}', '1st', 'with-data', 2, '2021-01-31 04:36:47', '2021-02-02 00:44:13'),
(24, '2021-02-14', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"0021-12-12\",\"return_date\":\"2021-02-14\",\"tags\":\"opv\",\"vaccine_title\":\"ORAL POLIO VACCINE (OPV)\",\"vaccine_dose\":\"3rd\",\"baby_age\":\"3 1\\/2 Months\",\"remarks\":null}', '1st', 'with-data', 2, '2021-01-31 04:36:52', '2021-02-02 00:42:02'),
(25, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"ipv\",\"vaccine_title\":\"INACTIVE POLIO VACCINE (IPV)\",\"vaccine_dose\":\"1st\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 2, '2021-01-31 04:36:58', '2021-01-31 04:36:58'),
(26, '2021-02-25', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-31\",\"return_date\":\"2021-02-25\",\"tags\":\"pcv\",\"vaccine_title\":\"PNEUMOCOCCAL CONJUGATE VACCINE (PCV)\",\"vaccine_dose\":\"1st\",\"baby_age\":\"3 1\\/2 Months\",\"remarks\":null}', '1st', 'with-data', 2, '2021-01-31 04:37:15', '2021-01-31 04:37:15'),
(27, '2021-02-25', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-31\",\"return_date\":\"2021-02-25\",\"tags\":\"pcv\",\"vaccine_title\":\"PNEUMOCOCCAL CONJUGATE VACCINE (PCV)\",\"vaccine_dose\":\"2nd\",\"baby_age\":\"3 1\\/2 Months\",\"remarks\":\"<ol><li>ronald<\\/li><li>dogomeo<\\/li><\\/ol>\"}', '1st', 'with-data', 2, '2021-01-31 04:37:21', '2021-01-31 04:48:28'),
(28, '2021-02-26', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-28\",\"return_date\":\"2021-02-26\",\"tags\":\"pcv\",\"vaccine_title\":\"PNEUMOCOCCAL CONJUGATE VACCINE (PCV)\",\"vaccine_dose\":\"3rd\",\"baby_age\":\"2 1\\/2 Months\",\"remarks\":null}', '1st', 'with-data', 2, '2021-01-31 04:37:27', '2021-01-31 04:47:36'),
(29, '2021-02-20', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-25\",\"return_date\":\"2021-02-20\",\"tags\":\"mmr\",\"vaccine_title\":\"MEASLES, MUMPS, RUBELLA (MMR)\",\"vaccine_dose\":\"1st\",\"baby_age\":\"1 Year\",\"remarks\":\"<ol><li>abcd<\\/li><li>efgh<\\/li><\\/ol>\"}', '1st', 'with-data', 2, '2021-01-31 04:37:32', '2021-01-31 04:46:42'),
(30, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"mmr\",\"vaccine_title\":\"MEASLES, MUMPS, RUBELLA (MMR)\",\"vaccine_dose\":\"2nd\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 2, '2021-01-31 04:37:40', '2021-01-31 04:37:40'),
(31, '2021-02-15', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-31\",\"return_date\":\"2021-02-15\",\"tags\":\"rv\",\"vaccine_title\":\"Ronald Vaccine\",\"vaccine_dose\":\"1st\",\"baby_age\":\"5 1\\/2 months\",\"remarks\":null}', '1st', 'with-data', 2, '2021-01-31 04:38:11', '2021-01-31 04:38:11'),
(32, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"bcg\",\"vaccine_title\":\"BCG\",\"vaccine_dose\":\"1st\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 1, '2021-01-31 04:49:16', '2021-01-31 04:49:16'),
(33, '2021-02-22', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-31\",\"return_date\":\"2021-02-22\",\"tags\":\"hepab\",\"vaccine_title\":\"HEPATITIS B\",\"vaccine_dose\":\"1st\",\"baby_age\":\"Just born\",\"remarks\":\"<ol><li>Honey Bee<\\/li><li>Dogomeo<\\/li><\\/ol>\"}', '1st', 'with-data', 1, '2021-01-31 04:49:56', '2021-01-31 04:49:56'),
(34, '2021-02-23', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-25\",\"return_date\":\"2021-02-23\",\"tags\":\"pv\",\"vaccine_title\":\"PENTAVALENT VACCINE (DPT-Hep B-HiB)\",\"vaccine_dose\":\"1st\",\"baby_age\":\"2 1\\/2 Months\",\"remarks\":null}', '1st', 'with-data', 1, '2021-01-31 05:54:05', '2021-01-31 05:56:58'),
(35, '2021-02-28', '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"2021-01-31\",\"return_date\":\"2021-02-28\",\"tags\":\"pv\",\"vaccine_title\":\"PENTAVALENT VACCINE (DPT-Hep B-HiB)\",\"vaccine_dose\":\"2nd\",\"baby_age\":\"2 1\\/2 Months\",\"remarks\":\"<ol><li>vsdfsdgsdfg<\\/li><li>sdfgsdfgsdfg<\\/li><li>sdgsdf<\\/li><\\/ol>\"}', '1st', 'with-data', 1, '2021-01-31 05:57:26', '2021-01-31 05:57:36'),
(36, NULL, '2021-01-31', '{\"date\":\"2021-01-31\",\"vaccine_date\":\"\",\"return_date\":\"\",\"tags\":\"pv\",\"vaccine_title\":\"PENTAVALENT VACCINE (DPT-Hep B-HiB)\",\"vaccine_dose\":\"3rd\",\"baby_age\":\"\",\"remarks\":\"\"}', '1st', 'no-data', 1, '2021-01-31 05:57:47', '2021-01-31 05:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_use` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_01_03_092150_create_child_table', 1),
(4, '2021_01_03_092646_create_parents_table', 1),
(5, '2021_01_03_092711_create_immunizations_table', 1),
(6, '2021_01_03_092733_create_prenatals_table', 1),
(7, '2021_01_03_092757_create_settings_table', 1),
(8, '2021_01_03_092818_create_messages_table', 1),
(9, '2021_01_03_092842_create_activities_table', 1),
(10, '2021_01_03_092844_create_fathers_table', 1),
(11, '2021_01_03_092846_create_mothers_table', 1),
(12, '2021_01_03_092848_create_pregnants_table', 1),
(13, '2021_01_03_092850_create_vaccine_doses_table', 1),
(14, '2021_01_03_092852_create_reset_passwords_table', 1),
(15, '2021_01_03_092890_create_foreign_keys', 1),
(16, '2021_01_20_073408_create_sample_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` enum('single','married','widowed','separated') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mothers`
--

INSERT INTO `mothers` (`id`, `firstname`, `middlename`, `lastname`, `birthdate`, `address`, `contact`, `civil_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Honey Bee', 'Dela Pena', 'Dogomeo', '1998-04-18', 'Sagay City, Neg. Occ.', '09096217580', 'married', '2021-01-08 06:21:54', '2021-01-08 06:21:54', NULL),
(2, 'Ronalda', 'Awaw', 'Morados', '1994-05-07', 'wala lang', '34563456', 'married', '2021-01-11 05:24:05', '2021-01-11 05:24:05', NULL),
(3, 'ronalda', 'Recibido', 'Dogomeo', '1992-09-16', 'Toboso, Neg. Occ.', '09098767878', 'married', '2021-01-11 19:33:41', '2021-01-18 07:09:08', NULL),
(4, 'Theresa', 'Recibido', 'Dogomeo', '1992-09-16', 'Toboso, Neg. Occ.', '0909878778', 'single', '2021-01-16 20:31:40', '2021-01-16 20:31:40', NULL),
(5, 'sample fname', 'sample mname', 'sample1', '1998-04-18', 'Sagay City, neg. occ.', '1212122121212', 'married', '2021-01-19 23:07:27', '2021-01-19 23:07:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mother_id` bigint(20) UNSIGNED NOT NULL,
  `father_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `mother_id`, `father_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-01-08 06:21:55', '2021-01-08 06:21:55'),
(2, 2, 2, '2021-01-11 05:24:06', '2021-01-11 05:24:06'),
(3, 3, 3, '2021-01-11 19:33:41', '2021-01-11 19:33:41'),
(4, 3, 4, '2021-01-11 22:00:37', '2021-01-11 22:00:37'),
(5, 4, 5, '2021-01-16 20:31:41', '2021-01-16 20:31:41'),
(6, 5, 6, '2021-01-19 23:07:27', '2021-01-19 23:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `pregnants`
--

CREATE TABLE `pregnants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pregnant_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_period` date NOT NULL,
  `expected_delivery` date NOT NULL,
  `is_labored` tinyint(1) NOT NULL DEFAULT 0,
  `is_record_done` tinyint(1) NOT NULL DEFAULT 0,
  `labor_date` date DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pregnants`
--

INSERT INTO `pregnants` (`id`, `pregnant_no`, `weight`, `last_period`, `expected_delivery`, `is_labored`, `is_record_done`, `labor_date`, `remarks`, `mother_id`, `created_at`, `updated_at`) VALUES
(1, 'dXnrPxdyEKNAacA', '47', '2020-08-26', '2021-06-02', 0, 0, NULL, NULL, 1, '2021-01-08 06:21:55', '2021-01-19 03:18:44'),
(2, '9FIE92xXa1Vdc0r', '55', '2020-08-26', '2021-06-02', 0, 0, NULL, 'sdgfsdgdf', 2, '2019-01-10 16:00:00', '2021-01-17 00:20:51'),
(3, 'iCv7S0LOmNAVQIZ', '56', '2020-01-10', '2021-06-02', 0, 0, NULL, NULL, 3, '2020-01-11 19:33:42', '2021-01-11 19:33:42'),
(4, 'SCvbsL9mYHdTHX9', '60', '2020-08-26', '2021-06-02', 0, 0, NULL, NULL, 3, '2021-01-11 22:00:37', '2021-01-19 18:21:56'),
(5, 'JpXJgKJfbaJxnat', '45', '2020-10-20', '2021-07-27', 0, 0, NULL, NULL, 4, '2021-01-16 20:31:41', '2021-01-16 20:31:41'),
(6, 'EwIEQ5ZxnRwEJGH', '45', '2020-08-26', '2021-06-02', 1, 1, '2021-01-20', 'sdfsg', 5, '2021-01-19 23:07:27', '2021-01-19 23:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `prenatals`
--

CREATE TABLE `prenatals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_date` date DEFAULT NULL,
  `date_conduct` date DEFAULT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkup_order` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `trimester` enum('1st','2nd','3rd') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pregnant_id` bigint(20) UNSIGNED NOT NULL,
  `record_status` enum('done','no-data','with-data') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'done',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prenatals`
--

INSERT INTO `prenatals` (`id`, `return_date`, `date_conduct`, `data`, `checkup_order`, `trimester`, `pregnant_id`, `record_status`, `created_at`, `updated_at`) VALUES
(39, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '1', '1st', 2, 'no-data', '2021-01-17 00:14:20', '2021-01-17 00:14:20'),
(40, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '2', '1st', 2, 'no-data', '2021-01-17 00:14:25', '2021-01-17 00:14:25'),
(41, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-17\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"22\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Normal\",\"return_date\":\"2021-01-21\",\"health_service_provider\":\"dfsdfsfad\",\"hospital_referral\":\"asdfasfasf\",\"dental_checkup\":null,\"urinalysis\":\"3123\",\"treatments\":\"Syphilis\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"make_a_birth_plan\":\"<ul><li>1111<\\/li><li>2222<\\/li><li>3333<\\/li><\\/ul>\",\"hemoglobin_count\":\"2132\",\"stool_examination\":\"12321\",\"acetic_acid_wash\":\"123\",\"tetanus_containing_vaccine\":\"45235\",\"date_given\":\"2020-01-02\",\"stis_sundromic_aaproach\":{\"syphilis\":\"true\",\"hiv\":\"true\",\"hepatits_b\":\"true\"},\"discussion_services_given\":{\"avoid_alcohol\":\"true\",\"advises_foods\":\"true\",\"advises_sex_safe\":\"true\",\"right_use_of_insecticide\":\"true\",\"birth_plan\":\"false\"}}', '3', '1st', 2, 'with-data', '2021-01-17 00:15:12', '2021-01-17 00:15:12'),
(42, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"etiologic_test_if_needed\":\"\",\"pap_smear_if_needed\":\"\",\"gestational_diabetes_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false}}', '1', '2nd', 2, 'no-data', '2021-01-17 00:15:18', '2021-01-17 00:15:18'),
(43, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-17\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"23\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Over Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":\"dfsdfsfad\",\"hospital_referral\":\"asdfasfasf\",\"dental_checkup\":null,\"urinalysis\":\"3123\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"changes_birthplan\":null,\"pregnant_situation\":null,\"advice_given\":\"<ul><li>abc<\\/li><li>aaaa<\\/li><li>cccc<\\/li><\\/ul>\",\"etiologic_test_if_needed\":\"bgbgb\",\"pap_smear_if_needed\":\"fbdfbf\",\"gestational_diabetes_if_needed\":null,\"bacteriuria_if_needed\":\"dfgbdf\",\"treatments\":\"Antiretroviral (ARV)\",\"discussion_services_given\":{\"reminder_previous_discussion\":\"true\"}}', '2', '2nd', 2, 'with-data', '2021-01-17 00:18:06', '2021-01-17 00:18:06'),
(44, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"etiologic_test_if_needed\":\"\",\"pap_smear_if_needed\":\"\",\"gestational_diabetes_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false}}', '3', '2nd', 2, 'no-data', '2021-01-17 00:18:11', '2021-01-17 00:18:11'),
(45, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '1', '3rd', 2, 'no-data', '2021-01-17 00:19:12', '2021-01-17 00:19:12'),
(46, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '2', '3rd', 2, 'no-data', '2021-01-17 00:19:17', '2021-01-17 00:19:17'),
(47, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-17\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"22\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":null,\"return_date\":\"2021-01-21\",\"health_service_provider\":\"dfsdfsfad\",\"hospital_referral\":\"asdfasfasf\",\"dental_checkup\":null,\"urinalysis\":\"3123\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"changes_birthplan\":null,\"pregnant_situation\":null,\"advice_given\":null,\"blood_rh_if_needed\":\"refwere\",\"bacteriuria_if_needed\":\"dfgbdf\",\"treatments\":null,\"discussion_services_given\":{\"reminder_previous_discussion\":\"false\",\"dsg_reminder_postpartum\":\"false\",\"dsg_agwat_ng_anak\":\"false\",\"dsg_tetanus_follow_up\":\"false\"}}', '3', '3rd', 2, 'with-data', '2021-01-17 00:20:43', '2021-01-17 00:20:43'),
(48, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-18\",\"weight\":\"60\",\"height\":\"6\",\"age_of_gestation\":\"25\",\"blood_pressure\":null,\"nutritional_status\":\"Over Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":null,\"hospital_referral\":null,\"dental_checkup\":null,\"urinalysis\":\"aa\",\"treatments\":\"Syphilis\",\"complete_blood_count\":\"aa\",\"laboratory_test_done\":\"<ol><li>aaaa<\\/li><li>bb<\\/li><\\/ol>\",\"make_a_birth_plan\":\"<ul><li>1223434<\\/li><li>sfsdfsd<\\/li><\\/ul>\",\"hemoglobin_count\":\"aa\",\"stool_examination\":\"aa\",\"acetic_acid_wash\":\"aa\",\"tetanus_containing_vaccine\":\"aa\",\"date_given\":null,\"stis_sundromic_aaproach\":{\"syphilis\":\"true\",\"hiv\":\"true\",\"hepatits_b\":\"false\"},\"discussion_services_given\":{\"avoid_alcohol\":\"false\",\"advises_foods\":\"false\",\"advises_sex_safe\":\"true\",\"right_use_of_insecticide\":\"false\",\"birth_plan\":\"false\"}}', '1', '1st', 3, 'with-data', '2021-01-17 00:29:45', '2021-01-17 19:53:57'),
(49, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-18\",\"weight\":\"10\",\"height\":\"6\",\"age_of_gestation\":\"25\",\"blood_pressure\":null,\"nutritional_status\":\"Under Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":null,\"hospital_referral\":null,\"dental_checkup\":\"<ul><li>sadsadfas<\\/li><li>sadfasf<\\/li><\\/ul>\",\"urinalysis\":null,\"treatments\":null,\"complete_blood_count\":null,\"laboratory_test_done\":null,\"make_a_birth_plan\":\"<ul><li>qweqe<\\/li><li>qwefqwef<\\/li><\\/ul>\",\"hemoglobin_count\":null,\"stool_examination\":null,\"acetic_acid_wash\":null,\"tetanus_containing_vaccine\":null,\"date_given\":null,\"stis_sundromic_aaproach\":{\"syphilis\":\"false\",\"hiv\":\"false\",\"hepatits_b\":\"false\"},\"discussion_services_given\":{\"avoid_alcohol\":\"false\",\"advises_foods\":\"false\",\"advises_sex_safe\":\"false\",\"right_use_of_insecticide\":\"true\",\"birth_plan\":\"false\"}}', '2', '1st', 3, 'with-data', '2021-01-17 00:29:49', '2021-01-17 19:54:16'),
(50, NULL, '2021-01-17', '{\"date\":\"\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '3', '1st', 3, 'no-data', '2021-01-17 00:29:53', '2021-01-17 00:29:53'),
(51, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-17\",\"weight\":\"45\",\"height\":\"7\",\"age_of_gestation\":\"22\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Under Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":\"sdfsadf\",\"hospital_referral\":\"asdfas\",\"dental_checkup\":\"<ul><li>fgsdgsd<\\/li><li>sdgsdgsdfg<\\/li><\\/ul>\",\"urinalysis\":\"3123\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"changes_birthplan\":\"<ul><li>asdasdfasdf<\\/li><li>asdfasdf<\\/li><\\/ul>\",\"pregnant_situation\":\"<ul><li>111111<\\/li><li>22222<\\/li><\\/ul>\",\"advice_given\":\"<ul><li>2343423<\\/li><li>asdfasdf<\\/li><\\/ul>\",\"etiologic_test_if_needed\":\"asfasf\",\"pap_smear_if_needed\":\"asdfaf\",\"gestational_diabetes_if_needed\":null,\"bacteriuria_if_needed\":\"asdfa\",\"treatments\":\"Deworming\",\"discussion_services_given\":{\"reminder_previous_discussion\":\"true\"}}', '1', '2nd', 3, 'with-data', '2021-01-17 01:01:56', '2021-01-17 07:52:47'),
(52, '2021-01-21', '2021-01-17', '{\"date\":\"2021-01-17\",\"weight\":\"46\",\"height\":\"7\",\"age_of_gestation\":\"23\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Over Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":\"dfsdfsfad\",\"hospital_referral\":\"asdfasfasf\",\"dental_checkup\":null,\"urinalysis\":\"3123\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"changes_birthplan\":\"<ul><li>fdsfbsdfb<\\/li><li>sdf<\\/li><li>bsdbsdb<\\/li><\\/ul>\",\"pregnant_situation\":\"<ul><li>werqwerwer<\\/li><li>qwerwrew<\\/li><\\/ul>\",\"advice_given\":\"<ul><li>bdfgbdbs<\\/li><li>sdfbsdb<\\/li><\\/ul>\",\"etiologic_test_if_needed\":\"bgbgb\",\"pap_smear_if_needed\":\"fbdfbf\",\"gestational_diabetes_if_needed\":null,\"bacteriuria_if_needed\":\"dfgbdf\",\"treatments\":\"Anemia\",\"discussion_services_given\":{\"reminder_previous_discussion\":\"false\"}}', '2', '2nd', 3, 'with-data', '2021-01-17 01:04:41', '2021-01-17 07:32:07'),
(53, '2021-01-21', '2021-01-18', '{\"date\":\"2021-01-18\",\"weight\":\"50\",\"height\":\"60\",\"age_of_gestation\":\"40\",\"blood_pressure\":\"100\\/80\",\"nutritional_status\":\"Under Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":\"zzz\",\"hospital_referral\":\"zzzz\",\"dental_checkup\":\"<ul><li>4<\\/li><\\/ul>\",\"urinalysis\":\"zzz\",\"complete_blood_count\":\"zzzz\",\"laboratory_test_done\":\"<ul><li>5<\\/li><\\/ul>\",\"changes_birthplan\":\"<ul><li>3<\\/li><\\/ul>\",\"pregnant_situation\":\"<ul><li>1<\\/li><\\/ul>\",\"advice_given\":\"<ul><li>2<\\/li><\\/ul>\",\"etiologic_test_if_needed\":\"zzz\",\"pap_smear_if_needed\":\"zz\",\"gestational_diabetes_if_needed\":null,\"bacteriuria_if_needed\":\"zz\",\"treatments\":\"Anemia\",\"discussion_services_given\":{\"reminder_previous_discussion\":\"true\"}}', '3', '2nd', 3, 'with-data', '2021-01-17 19:55:46', '2021-01-17 19:56:20'),
(54, NULL, '2021-01-18', '{\"date\":\"2021-01-18\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '1', '3rd', 3, 'no-data', '2021-01-17 19:58:24', '2021-01-17 19:58:24'),
(55, '2021-02-22', '2021-01-18', '{\"date\":\"2021-01-18\",\"weight\":\"46\",\"height\":\"7\",\"age_of_gestation\":\"33\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Under Weight\",\"return_date\":\"2021-02-22\",\"health_service_provider\":\"dfsdfsfad\",\"hospital_referral\":\"zzzz\",\"dental_checkup\":null,\"urinalysis\":null,\"complete_blood_count\":null,\"laboratory_test_done\":\"<ul><li>234<\\/li><\\/ul>\",\"changes_birthplan\":null,\"pregnant_situation\":null,\"advice_given\":null,\"blood_rh_if_needed\":null,\"bacteriuria_if_needed\":null,\"treatments\":\"Bacteriuria\",\"discussion_services_given\":{\"reminder_previous_discussion\":\"false\",\"dsg_reminder_postpartum\":\"false\",\"dsg_agwat_ng_anak\":\"true\",\"dsg_tetanus_follow_up\":\"false\"}}', '2', '3rd', 3, 'with-data', '2021-01-17 19:58:56', '2021-01-17 20:01:01'),
(56, NULL, '2021-01-18', '{\"date\":\"2021-01-18\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '3', '3rd', 3, 'no-data', '2021-01-17 20:05:26', '2021-01-17 20:05:26'),
(57, NULL, '2021-01-19', '{\"date\":\"2021-01-19\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '1', '1st', 1, 'no-data', '2021-01-18 23:24:24', '2021-01-18 23:24:24'),
(58, '2021-03-30', '2021-01-19', '{\"date\":\"2021-01-19\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"23\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Over Weight\",\"return_date\":\"2021-03-30\",\"health_service_provider\":\"errrtrtrtrtr\",\"hospital_referral\":\"rtrtr\",\"dental_checkup\":null,\"urinalysis\":null,\"treatments\":null,\"complete_blood_count\":null,\"laboratory_test_done\":null,\"make_a_birth_plan\":\"<ul><li>123r43<\\/li><li>fght5y5674ht<\\/li><\\/ul>\",\"hemoglobin_count\":null,\"stool_examination\":null,\"acetic_acid_wash\":null,\"tetanus_containing_vaccine\":null,\"date_given\":null,\"stis_sundromic_aaproach\":{\"syphilis\":\"true\",\"hiv\":\"true\",\"hepatits_b\":\"false\"},\"discussion_services_given\":{\"avoid_alcohol\":\"false\",\"advises_foods\":\"false\",\"advises_sex_safe\":\"false\",\"right_use_of_insecticide\":\"false\",\"birth_plan\":\"true\"}}', '2', '1st', 1, 'with-data', '2021-01-18 23:25:10', '2021-01-18 23:25:10'),
(59, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '1', '1st', 4, 'no-data', '2021-01-19 18:19:50', '2021-01-19 18:19:50'),
(60, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '2', '1st', 4, 'no-data', '2021-01-19 18:19:54', '2021-01-19 18:19:54'),
(61, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '3', '1st', 4, 'no-data', '2021-01-19 18:19:58', '2021-01-19 18:19:58'),
(62, '2021-01-21', '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"22\",\"blood_pressure\":\"100\\/80\",\"nutritional_status\":\"Normal\",\"return_date\":\"2021-01-21\",\"health_service_provider\":null,\"hospital_referral\":null,\"dental_checkup\":null,\"urinalysis\":\"3123\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"changes_birthplan\":null,\"pregnant_situation\":\"<ul><li>good condition<\\/li><\\/ul>\",\"advice_given\":null,\"etiologic_test_if_needed\":\"bgbgb\",\"pap_smear_if_needed\":\"fbdfbf\",\"gestational_diabetes_if_needed\":null,\"bacteriuria_if_needed\":null,\"treatments\":null,\"discussion_services_given\":{\"reminder_previous_discussion\":\"false\"}}', '1', '2nd', 4, 'with-data', '2021-01-19 18:20:06', '2021-01-19 18:21:03'),
(63, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '1', '1st', 6, 'no-data', '2021-01-19 23:08:59', '2021-01-19 23:08:59'),
(64, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '2', '1st', 6, 'no-data', '2021-01-19 23:09:04', '2021-01-19 23:09:04'),
(65, '2021-01-21', '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"22\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Under Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":null,\"hospital_referral\":null,\"dental_checkup\":null,\"urinalysis\":null,\"treatments\":null,\"complete_blood_count\":null,\"laboratory_test_done\":null,\"make_a_birth_plan\":null,\"hemoglobin_count\":null,\"stool_examination\":null,\"acetic_acid_wash\":null,\"tetanus_containing_vaccine\":null,\"date_given\":null,\"stis_sundromic_aaproach\":{\"syphilis\":\"false\",\"hiv\":\"false\",\"hepatits_b\":\"false\"},\"discussion_services_given\":{\"avoid_alcohol\":\"false\",\"advises_foods\":\"false\",\"advises_sex_safe\":\"false\",\"right_use_of_insecticide\":\"false\",\"birth_plan\":\"false\"}}', '3', '1st', 6, 'with-data', '2021-01-19 23:09:07', '2021-01-19 23:10:51'),
(66, '2021-01-21', '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"45\",\"height\":\"6\",\"age_of_gestation\":\"22\",\"blood_pressure\":\"90\\/80\",\"nutritional_status\":\"Under Weight\",\"return_date\":\"2021-01-21\",\"health_service_provider\":null,\"hospital_referral\":null,\"dental_checkup\":null,\"urinalysis\":\"3123\",\"complete_blood_count\":\"12321\",\"laboratory_test_done\":null,\"changes_birthplan\":null,\"pregnant_situation\":\"<ul><li>1222<\\/li><li>feff<\\/li><\\/ul>\",\"advice_given\":null,\"etiologic_test_if_needed\":\"bgbgb\",\"pap_smear_if_needed\":\"fbdfbf\",\"gestational_diabetes_if_needed\":null,\"bacteriuria_if_needed\":\"dfgbdf\",\"treatments\":\"Bacteriuria\",\"discussion_services_given\":{\"reminder_previous_discussion\":\"false\"}}', '1', '2nd', 6, 'with-data', '2021-01-19 23:10:15', '2021-01-19 23:10:15'),
(67, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"etiologic_test_if_needed\":\"\",\"pap_smear_if_needed\":\"\",\"gestational_diabetes_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false}}', '2', '2nd', 6, 'no-data', '2021-01-19 23:11:05', '2021-01-19 23:11:05'),
(68, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"etiologic_test_if_needed\":\"\",\"pap_smear_if_needed\":\"\",\"gestational_diabetes_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false}}', '3', '2nd', 6, 'no-data', '2021-01-19 23:11:09', '2021-01-19 23:11:09'),
(69, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '1', '3rd', 6, 'no-data', '2021-01-19 23:11:12', '2021-01-19 23:11:12'),
(70, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '2', '3rd', 6, 'no-data', '2021-01-19 23:11:18', '2021-01-19 23:11:18'),
(71, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"changes_birthplan\":\"\",\"pregnant_situation\":\"\",\"advice_given\":\"\",\"blood_rh_if_needed\":\"\",\"bacteriuria_if_needed\":\"\",\"treatments\":\"\",\"discussion_services_given\":{\"reminder_previous_discussion\":false,\"dsg_reminder_postpartum\":false,\"dsg_agwat_ng_anak\":false,\"dsg_tetanus_follow_up\":false}}', '3', '3rd', 6, 'no-data', '2021-01-19 23:11:22', '2021-01-19 23:11:22'),
(72, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '1', '1st', 5, 'no-data', '2021-01-19 23:15:20', '2021-01-19 23:15:20'),
(73, NULL, '2021-01-20', '{\"date\":\"2021-01-20\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '2', '1st', 5, 'no-data', '2021-01-19 23:15:24', '2021-01-19 23:15:24'),
(74, '2021-02-22', '2021-01-20', '{\"date\":\"2021-01-20\",\"sample\":\"2020-02-20\",\"weight\":\"46\",\"height\":\"6\",\"age_of_gestation\":\"22\",\"blood_pressure\":null,\"nutritional_status\":null,\"return_date\":\"2021-02-22\",\"health_service_provider\":null,\"hospital_referral\":null,\"dental_checkup\":null,\"urinalysis\":null,\"treatments\":null,\"complete_blood_count\":null,\"laboratory_test_done\":null,\"make_a_birth_plan\":null,\"hemoglobin_count\":null,\"stool_examination\":null,\"acetic_acid_wash\":null,\"tetanus_containing_vaccine\":null,\"date_given\":null,\"stis_sundromic_aaproach\":{\"syphilis\":\"false\",\"hiv\":\"false\",\"hepatits_b\":\"false\"},\"discussion_services_given\":{\"avoid_alcohol\":\"false\",\"advises_foods\":\"false\",\"advises_sex_safe\":\"false\",\"right_use_of_insecticide\":\"false\",\"birth_plan\":\"false\"}}', '3', '1st', 5, 'with-data', '2021-01-19 23:15:28', '2021-01-19 23:19:27'),
(75, NULL, '2021-02-01', '{\"date\":\"2021-02-01\",\"weight\":\"\",\"height\":\"\",\"age_of_gestation\":\"\",\"blood_pressure\":\"\",\"nutritional_status\":\"\",\"return_date\":\"\",\"health_service_provider\":\"\",\"hospital_referral\":\"\",\"dental_checkup\":\"\",\"urinalysis\":\"\",\"treatments\":\"\",\"complete_blood_count\":\"\",\"laboratory_test_done\":\"\",\"make_a_birth_plan\":\"\",\"hemoglobin_count\":\"\",\"stool_examination\":\"\",\"acetic_acid_wash\":\"\",\"tetanus_containing_vaccine\":\"\",\"date_given\":\"\",\"stis_sundromic_aaproach\":{\"syphilis\":false,\"hiv\":false,\"hepatits_b\":false},\"discussion_services_given\":{\"avoid_alcohol\":false,\"advises_foods\":false,\"advises_sex_safe\":false,\"right_use_of_insecticide\":false,\"birth_plan\":false}}', '3', '1st', 1, 'no-data', '2021-01-31 23:12:26', '2021-01-31 23:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `reset_passwords`
--

CREATE TABLE `reset_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reset_token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_expired` tinyint(1) NOT NULL DEFAULT 0,
  `is_resetted` tinyint(1) NOT NULL DEFAULT 0,
  `expired_date` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_passwords`
--

INSERT INTO `reset_passwords` (`id`, `reset_token`, `new_password`, `is_expired`, `is_resetted`, `expired_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '3ade09c9828efca9a5628c85562e9fc4937a74ebd514bad80a0a35bb26460c2c', NULL, 0, 1, NULL, 2, '2021-01-10 22:56:06', '2021-01-10 22:57:26'),
(2, '9adf7656b1dda89e1fd9309563a71598a18eaf0345e0889a9ff12615e30bfe0c', NULL, 0, 1, NULL, 4, '2021-01-11 19:10:58', '2021-01-11 19:11:16'),
(3, '2eca561548d88e9880de18bf60b84f49220b29791aa5dad6e3bdf7b3ec190512', NULL, 0, 1, NULL, 4, '2021-01-19 18:26:42', '2021-01-19 18:27:10'),
(4, 'fa5c9cdd732fbc1fea8f351300d820e2b18f526044680dfedd0d9430c48c5124', NULL, 0, 1, NULL, 4, '2021-01-19 23:30:50', '2021-01-19 23:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('system-status') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `remarks`, `data`, `created_at`, `updated_at`) VALUES
(1, 'system-status', 'System is Active!', '{\"system-status\":\"Active\",\"date-update\":\"2021-02-11 18:02:18\"}', '2021-02-11 09:43:39', '2021-02-11 10:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hired_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `email_verified_at`, `password`, `profile`, `employee_id`, `fullname`, `birthdate`, `address`, `contact`, `hired_date`, `is_active`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@system.app', '102014', NULL, '$2y$10$idIxN/7ncKufWd1JfbF9i.ZdjJRsOvNCqhk5/6eQZHgIeR3mDsgLO', 'public/uploaded/profile/c4ca4238a0b923820dcc509a6f75849b/f886a3086dab40c21d85893effbfe63a.png', '102014', 'Ronald R. Dogomeo', '1994-05-07', 'Toboso, Neg. Occ.', '09006217580', '2019-11-12', 1, 'admin', 'QfVlYI8kHMxRv8n1cjhQMqddH2K3KdRTRZ9N8zDZyf1ybOvmORNARN9nOgNu', '2021-01-08 06:04:59', '2021-02-10 09:18:12'),
(2, 'naldo@user.dev', 'USER102014', NULL, '$2y$10$z41mJHdwoPZidhQl5m60Ce/6nAAQbC7Jz/4vNsCu9jFBnDP.fCI0C', 'public/uploaded/profile/c81e728d9d4c2f636f067f89cc14862c/51a6dcc1b2b33fdd720fa591fe54156d.png', 'USER102014', 'Naldo A. Recibido', '1994-05-07', 'Sagay City, Neg. Occ.', '09469572178', '2014-10-20', 1, 'user', 'ZDmk5I2pL38sXSuRj65SVOvCBhipxng9yVIUS5lb8LUwtJ1XG6y8bac9RHJX', '2021-01-08 06:08:20', '2021-02-03 05:44:26'),
(3, 'ron@user.dev', 'USER574', NULL, '$2y$10$TqdlnlCZAVp5QNvSv81NnuqnKVbeoT6h4o0.maVQe/1GArBsRYZq2', NULL, 'USER574', 'Ron ron', '1994-05-07', 'Sagay City, neg. occ.', '09098765163', '2014-10-20', 1, 'user', NULL, '2021-01-10 23:06:23', '2021-02-03 08:14:54'),
(4, 'dogomeo@prog.dev', 'USER5794102014', NULL, '$2y$10$ozawa.trC64aePy543AgGeSxgXmMdvTU5oZvzs6oOE9REjD7h4SvS', 'public/uploaded/profile/a87ff679a2f3e71d9181a67b7542122c/3fad5fb94c381d2867a1930e3764ec67.png', 'USER5794102014', 'Ronaldo Dogomeo', '1994-05-07', 'Sagay City, neg. occ.xxx', '09098735216', '2020-12-31', 1, 'user', 'Xd3ycRDYogZ10reSOwvtnDTCzm4pPoKzziQoDiKcI8RXgQkW3ix0sekcMOvA', '2021-01-10 23:09:28', '2021-01-19 23:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_doses`
--

CREATE TABLE `vaccine_doses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_given` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `when_to_return` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `children_parent_id_index` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fathers`
--
ALTER TABLE `fathers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immunizations_children_id_index` (`children_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mothers`
--
ALTER TABLE `mothers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parents_mother_id_index` (`mother_id`),
  ADD KEY `parents_father_id_index` (`father_id`);

--
-- Indexes for table `pregnants`
--
ALTER TABLE `pregnants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pregnants_pregnant_no_unique` (`pregnant_no`),
  ADD KEY `pregnants_mother_id_index` (`mother_id`);

--
-- Indexes for table `prenatals`
--
ALTER TABLE `prenatals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prenatals_pregnant_id_index` (`pregnant_id`);

--
-- Indexes for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reset_passwords_user_id_index` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_employee_id_unique` (`employee_id`);

--
-- Indexes for table `vaccine_doses`
--
ALTER TABLE `vaccine_doses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fathers`
--
ALTER TABLE `fathers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mothers`
--
ALTER TABLE `mothers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pregnants`
--
ALTER TABLE `pregnants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prenatals`
--
ALTER TABLE `prenatals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vaccine_doses`
--
ALTER TABLE `vaccine_doses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `immunizations_ibfk_1` FOREIGN KEY (`children_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_father_id_foreign` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parents_mother_id_foreign` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pregnants`
--
ALTER TABLE `pregnants`
  ADD CONSTRAINT `pregnants_mother_id_foreign` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prenatals`
--
ALTER TABLE `prenatals`
  ADD CONSTRAINT `prenatals_pregnant_id_foreign` FOREIGN KEY (`pregnant_id`) REFERENCES `pregnants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD CONSTRAINT `reset_passwords_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
